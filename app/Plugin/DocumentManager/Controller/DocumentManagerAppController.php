<?php
/**
 * Base Controller file for Plugin DocumentManager
 * Modify getUserId() and isAdmin() to match your Users management method
 */

class DocumentManagerAppController extends AppController {
	public $helpers = array('DocumentManager.DocumentManager');

	/**
	 * Checks if the current User has Admin rights or not
	 */
	public function hasAdminRights() {
		if( !Configure::read('DocumentManager.authentification') || $this->isAdmin()) {// User has admin rights
			return true;
		};
		return false;
	}

	/**
	 * Checks if a folder belongs to a User, i.e. all files in these folder belongs to him
	 */
	public function folderBelongsToUser($path) {
		$base = Configure::read('DocumentManager.baseDir');
		$relPath = trim(trim(str_replace($base,'',  str_replace(WWW_ROOT,'',$path)  ), '\\'), '/');

		if (strlen($relPath) == strlen('centre00000000')) {
			//return 'own centre';
			return false; // never say that they own their centre folder, in case they delete it!
		}

		$matches = array();
		$match = preg_match('/centre(?P<centre_id>\d{8})/', $relPath, $matches);

		if ($match) {
			$centre_id = (int)$matches['centre_id'];
		} else {
			//return 'not under';
			return false; // If not under a centre folder, deny access
		}
		//die('test');
		$this->loadModel('User');
		if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
		$valid_memberships = $this->User->find(
									'count',
									array(
										'contain' => array(
											'CentreMembership'
										),
										'conditions' => array(
											'User.id' => $this->getUserId(), 'FilterCentre2.centre_id' => $centre_id
										)
									)
								);
		} else {
			$valid_memberships = $this->User->find(
									'count',
									array(
										'contain' => array(
											'CentreMembership'
										),
										'conditions' => array(
											'User.id' => $this->getUserId(), 'FilterCentreMembership2.centre_id' => $centre_id
										)
									)
								);
		}
		//echo "User: {$this->getUserId()}, Centre: {$centre_id}<br />".print_r($valid_memberships,true)."<br />";
		if ($valid_memberships == 0) {
			//return 'no membership';
			return false; // They don't belong to the right centre
		}
		if (!isset($this->Document)) {
			return true; // No document entry
		}
		if($this->Document->checkFolder($path, $this->getUserId())) {// file can be changed by current user
			return true;
		};
		return false;
	}

	/**
	 * Checks if the file belongs to a User
	 */
	public function fileBelongsToUser($user_id) {
		return ($this->getUserId() !== null); // If they're under the correct centre directory, we want them to see everything
		/*if($this->getUserId() == $user_id) {// file can be changed by current user
			return true;
		};
		return false;*/
	}

	/**
	 * Returns the logged user id, if not logged, return null
	 */
	public function getUserId() {
		if(!Configure::read('DocumentManager.authentification')) {// If there is no authentification, user_id is null
			return null;
		}
		//return $this->Authake->getUserId();
		return Auth::id();
	}

	public function isAdmin() {
		if(!Configure::read('DocumentManager.authentification')) {// If there is no authentification, everyone has all the rights
			return true;
		}
		return false; // Dont' want admins having rights to see everything
		//return $this->Authake->isMemberOf(1);
	}

}

