<?php
class DocumentManagerAppModel extends AppModel {
	
	/**
	 * @brief returns the absolute path to the file of given URL (absolute or relative)
	 */
	public function urlToFile($url) {
		$url = explode('/files/', $url);
		return APP . WEBROOT_DIR . DS . 'files' . DS . implode(DS, explode('/', @$url[1]));
	}
	
	/**
	 * @brief returns the relative URL of the file described by given absolute path
	 */
	public function fileToUrl($path) {
		$path = explode(DS . 'files' . DS, $path);
		return '/files/' . implode('/', explode(DS, @$path[1]));
	}
	
	/**
	 * Deletes a file without generating warnings
	 * If file doesn't exist, deletion is considered successful
	 * @param string $path
	 * @return true on success, false otherwise
	 */
	function unlinkSafe($path) {
		//die($path);
		return !file_exists($path) || @unlink($path);
	}
	
	public function userHasReadAccess($path) {
		switch ($this->getFilePermissions($path)) {
			case 'R':
			case 'RW':
				return true;
				break;
			default:
				return false;
				break;
		}
	}	
	public function userHasWriteAccess($path) {
		switch ($this->getFilePermissions($path)) {
			case 'W':
			case 'RW':
				return true;
				break;
			default:
				return false;
				break;
		}
	}
	/**
	 * @param string $path
	 * Returns R, W, RW indicating user's permissions
	 * depending on various criteria
	 */
	public function getFilePermissions($path) {
		$haveRead = true;
		$haveWrite = true;
		
		$base = Configure::read('DocumentManager.baseDir');
		$relPath = trim(trim(str_replace($base,'',  str_replace(WWW_ROOT,'',$path)  ), '\\'), '/');
		
		if (strlen($relPath) == strlen('centre00000000')) {
			//Debugger::log('own centre');
			$haveWrite = false; // never say that they own their centre folder, in case they delete it!
		}
		
		$matches = array();
		$match = preg_match('/centre(?P<centre_id>\d{8})/', $relPath, $matches);
		
		if ($match) {
			$centre_id = (int)$matches['centre_id'];
		} else {
			//Debugger::log('not under centre folder');
			 // If not under a centre folder, deny access
			$haveRead = false;
			$haveWrite = false;
			$centre_id = -1;
		}
		//die('test');
		//$this->loadModel('User');
		$userInstance = ClassRegistry::init('User');
		$filterCommentary = '';
		if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) ) {
		$valid_memberships = $userInstance->find(
									'count',
									array(
										'contain' => array(
											'CentreMembership'
										),
										'conditions' => array(
											'User.id' => Auth::id(), 'FilterCentreMembership.centre_id' => $centre_id
										)
									)
								);
			$filterCommentary = "(filtering on User.id = ".Auth::id()." AND FilterCentre2.id = {$centre_id})";
		} else {
			$valid_memberships = $userInstance->find(
									'count',
									array(
										'contain' => array(
											'CentreMembership'
										),
										'conditions' => array(
											'User.id' => Auth::id(), 'FilterCentreMembership2.centre_id' => $centre_id
										)
									)
								);
			$filterCommentary = "(filtering on User.id = ".Auth::id()." AND FilterCentreMembership2.centre_id = {$centre_id})";
		}
		//echo "User: {$this->getUserId()}, Centre: {$centre_id}<br />".print_r($valid_memberships,true)."<br />";
		if ($valid_memberships == 0) {
			//Debugger::log("no membership {$filterCommentary}");
			// They don't belong to the right centre
			$haveRead = false;
			$haveWrite = false;
		}
		
		return (($haveRead)?'R':'').(($haveWrite)?'W':'');
	}
}
?>
