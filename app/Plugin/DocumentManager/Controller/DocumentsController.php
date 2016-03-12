<?php

App::uses('Folder', 'Utility');

/**
 * Documents Controller
 *
 * @property Document $Document
 */
class DocumentsController extends DocumentManagerAppController {

	public function beforeFilter() {
		$this->Security->unlockedActions = array('upload_file', 'create_subfolder', 'rename_file', 'delete_file', 'delete_folder');
		parent::beforeFilter();
	}

	/**
	 * Displays a mini file explorer, rooted at app/webroot/files
	 * Current subfolder path is a folder name indexed array, i.e. the function arguments
	 * E.g. for the folder "/files/funny/images/lolCats/", $this->passedArgs must be:
	 * array(
	 *     0 => 'funny',
	 *     1 => 'images',
	 *     2 => 'lolCats',
	 * )
	 */
	public function index() {
		if (!empty($this->passedArgs)) {
			// If last_client_id passed in, set to session so we can do "back to client"
			if (!empty($this->passedArgs['last_client_id'])) {
				$this->Session->write('Documents.last_client_id',$this->passedArgs['last_client_id']);
				unset($this->passedArgs['last_client_id']);
			}
		}
		$this->set('pathFolderNames', $this->passedArgs);
		$contents = $this->Document->readFolder($this->passedArgs);
		$path = $this->Document->getFullPath($this->Document->getPathFolderNames($this->passedArgs));
		if (!is_dir($path)) {
			// No such directory - if it's directly within a centre folder, create it, as it's probably a client whose files we haven't accessed before
			if ((preg_match('/centre(?P<centre_id>\d{8})/', $this->passedArgs[0]) == 1) && (count($this->passedArgs) == 2)) {
				mkdir($path, 0777, true);
			} else {
				throw NotFoundException();
			}
		}
		//echo "<pre>".print_r($this->passedArgs,true)."{$path}</pre>";
		//echo "<pre>".print_r($contents,true)."</pre>";
		//die();
		$matches = array();
		if (preg_match('/centre(?P<centre_id>\d{8})/', $this->passedArgs[0], $matches) == 1) {
			$this->loadModel('Centre');
			$centre = $this->Centre->find('first',
											array(
												'conditions'	=>	array(
													'Centre.id'	=>	$matches['centre_id'],
												)
											)
										);
			$this->set('centre', $centre);
		}
		$this->loadModel('Client');
		$client = $this->Client->find('first',
										array(
											'contain'		=>	array(
												'Person'		=>	array('conditions'	=>	array('Person.role'	=>	1)),
											),
											'conditions'	=>	array(
												'Client.code'	=>	$this->passedArgs[count($this->passedArgs)-1],
												//'Person.role'	=>	1,
											),
										)
									);
		$this->set('client', $client);
		$this->set($contents);
	}

	/**
	 * Creates a subfolder in the current folder of the mini explorer
	 */
	public function create_subfolder() {
		if (substr($this->request->data('folderName'), 0, 1) == '.') {
			$this->Session->setFlash(__d("document_manager", "Le nom d'un dossier ne peut pas commencer par un point."));
		} else {
			if ($error = $this->Document->createSubFolder($this->passedArgs, $this->request->data('folderName'))) {
				$this->Session->setFlash($error, 'flash', array('class' => 'alert alert-danger'));
			}
		}
		$this->redirect(array_merge($this->passedArgs, array('action' => 'index')));
	}

	/**
	 * Uploads a file to the current folder of the mini explorer
	 */
	public function upload_file() {
		if (!function_exists('getallheaders')) {
			$headers = $this->getHeaders();
		} else {
			$headers = getallheaders();
		}
		$message = $this->Document->saveDocument($this->request->data, $this->passedArgs, $this->getUserId(), $headers);
		if (!empty($message)) {
			$this->Session->setFlash($message, 'flash', array('class' => 'alert alert-danger'));
		}
		$this->redirect(array_merge($this->passedArgs, array('action' => 'index')));
	}

	/**
	 * Renames a file from the current folder of the mini explorer
	 */
	public function rename_file() {
		// Set starting vars
		$fileNameParts = explode('.', $fileName = $this->request->data['file']);
		$newFileNameParts = explode('.', $newFileName = $this->request->data['newFile']);

		// Check permission
		$pathFolderNames = $this->Document->getPathFolderNames($this->passedArgs);
		$fullPath = implode('/',$pathFolderNames).'/'.$fileName;
		if ($this->Document->userHasWriteAccess($fullPath)) {
			// Check if former extension is present in new file name
			if (count($fileNameParts) > 1 && $fileNameParts[count($fileNameParts) - 1] != $newFileNameParts[count($newFileNameParts) - 1]) {
				// Extension omitted: add it
				$newFileName = $newFileName . '.' . $fileNameParts[count($fileNameParts) - 1];
			}

			$file = $this->Document->renameFile($pathFolderNames, $fileName, $newFileName, $this->getUserId());
			if (!empty($file['error'])) { // Error
				// Send JSON-encoded error message
				$this->viewClass = 'Json';
				$this->set($file);
				$this->set('_serialize', array_keys($file));
			} else { // Success
				// Display file element
				$this->set(compact('pathFolderNames', 'file'));
			}
		} else {
			$this->viewClass = 'Json';
			$file = array();
			$file['error'] = "You do not have rename permission for this file.";
			$file['remove'] = false;
			$this->set($file);
			$this->set('_serialize', array_keys($file));
		}

	}

	/**
	 * Deletes a file from the current folder of the mini explorer
	 */
	public function delete_file() {
		$this->viewClass = 'Json';

		$path = $this->Document->getFullPath($this->Document->getPathFolderNames($this->passedArgs), $this->passedArgs['file']);
		//die("<pre>".__FUNCTION__."\n".print_r($this->request,true)."</pre>");
		$document = $this->Document->findByUrl($this->Document->fileToUrl($path));
		// NB - PDF extension sometimes gets stripped off by PDF-handling code
		if (empty($document)) {
			$document = $this->Document->findByUrl($this->Document->fileToUrl($path).'.pdf');
			$path .= '.pdf';
		}
		//error_log("Attempting to delete file '{$path}'");
		//error_log(print_r($document,true));
		//if ($this->hasAdminRights() || $this->fileBelongsToUser(@$document['Document']['user_id'])) {
		if (/*$this->hasAdminRights() ||*/ $this->Document->userHasWriteAccess($path)) {
			//error_log('User has write access');
			$error = $this->Document->deleteFile($path) ?
				null : __d("document_manager", "Le fichier n'a pu être supprimé.");
		} else {
			//error_log("User DOESN'T have write access");
			$error = __d("document_manager", "Ce fichier ne vous appartient pas.");
		}

		$json = array('remove' => ($error === null), 'error' => $error);
		//error_log(print_r($json, true));
		$this->set(compact('json'));
		$this->set('_serialize', array('json'));
	}

	/**
	 * Deletes a subfolder from the current folder of the mini explorer
	 */
	public function delete_folder() {
		$this->viewClass = 'Json';

		$path = $this->Document->getFullPath($this->Document->getPathFolderNames($this->passedArgs), $this->passedArgs['folder']);
		$folder = new Folder($path);
		// Don't delete folders with files in them
		$contents = $folder->read(true, true, false);
		$content_count = count($contents[0])+count($contents[1]);
		//if (/*$this->hasAdminRights() ||*/ $this->folderBelongsToUser($path)) {
		if ($content_count == 0) {
			$error = $this->Document->deleteFolder($path) ? null : __d("document_manager", "Le dossier n'a pu être supprimé.");
		} else {
			$error = __d("document_manager", "Ce dossier contient des fichiers.");
		}

		$json = array('remove' => (empty($error) ? 'true' : 'false'), 'error' => $error);
		$this->set(compact('json'));
		$this->set('_serialize', array('json'));
	}

	/**
	 * Custom function in case apache is not deployed
	 * @return type
	 */
	public function getHeaders() {
       $headers = '';
       foreach ($_SERVER as $name => $value) {
           if (substr($name, 0, 5) == 'HTTP_') {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
       }
       return $headers;
    }

	/**
	 * Custom function by ARM - serve a file using internal file-read, so we can lock down the client_files folder with .htaccess and REQUIRE cake-authenticated access
	 * Doesn't render a view - just serves the file as-is
	 */
	public function serve() {
		//$docMan = ClassRegistry::init('DocumentManagerAppModel');
		//$this->loadModel('DocumentManagerAppModel');
		$this->autoRender = false;
		if (isset($this->params['named']['file']) && (!empty($this->params['named']['file']))) {
			$fname = ltrim(base64_decode($this->params['named']['file']),'/');
			header('Content-Type: application/octet-stream');
			// Handle PDF via download, as in-browser seems to break
			if (strtolower(substr($fname,-4)) == '.pdf') {
				$fname_parts = explode('/',str_replace('\\','/',$fname));
				$fname_short = $fname_parts[count($fname_parts)-1];
				header('Content-Disposition: attachment; filename="'.$fname_short.'"');
			} else {
				header('Content-Disposition: attachment; filename="'.$fname.'"');
			}
			header('Content-Transfer-Encoding: binary');
			//header('Content-Length: '.sprintf('%d', $filesize));
			header('Expires: 0');

			// check for IE only headers
			if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
			  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			  header('Pragma: public');
			} else {
			  header('Pragma: no-cache');
			}


			if ($this->Document->userHasReadAccess($fname)) {
				ob_start();
				readfile($fname);
				ob_end_flush();
			} else {
				throw new ForbiddenException();
			}
		} else {
			header('Location: ../');
		}
		die();
	   /*echo "<pre>";
	   print_r($this->request);
	   echo "</pre>";*/
    }

}