<?php
/**
 * Base Helper file for Plugin DocumentManager
 * Modify getUserId() and isAdmin() to match your Users management method  
 */

App::uses('AppHelper', 'View/Helper');

class DocumentManagerHelper extends AppHelper {
	//public $helpers = array('Html', 'Authake.Authake');

	public function sanitiseName($original) {
		// Replace any invalid characters in the filenames
		$finds = array('/','\\','%',"\0");
		$replaces = array();
		foreach ($finds as $k=>$v) {
			$replaces[$k] = str_replace('%','~',urlencode($v)).'~~';
		}
		return str_replace($finds, $replaces, $original);
	}
	
	public function desanitiseName($original) {
		// Now put back any invalid characters in the filenames
		$pattern = '/~(?P<hex>[0-9A-Fa-f]{2})~~/i';
		$matches = array();
		$returnValue = $original;
		$result = preg_match_all($pattern, $original, $matches);
		if ($result) {
			foreach ($matches['hex'] as $k=>$v) {
				$returnValue = str_replace("~{$v}~~", urldecode("%{$v}"), $returnValue);
			}
		}
		
		return $returnValue;
	}
	
	public function hasAdminRights() {
		if($this->isAdmin()) {// User has admin rights
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
