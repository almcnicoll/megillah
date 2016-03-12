<?php
/* /app/View/Helper/ViewPlusHelper.php */
App::uses('AppHelper', 'View/Helper');

class ViewPlusHelper extends AppHelper {
	public $helpers = array('Html', 'Time');
	
	/* DateTime - default formatters */
    public function fmtDate($date) {
		return $this->Time->format($date, Configure::read( 'DateTime.default_date_format' ));
	}
    public function fmtTime($date) {
		return $this->Time->format($date, Configure::read( 'DateTime.default_time_format' ));
	}
	
	/* Permissions-dependent links */
	public function linkIfCan($title, $url = null, $options = array(), $confirmMessage = false) {
		if ($user = Auth::user()) {
			$checkString = 'User::' . $user['id'];
		} else {
			$checkString = 'Role::0';
		}
		// We only check permissions if $url is a routing array
		if (is_array($url)) {
			// It's a routing array - do we have permission?
			if (isset($url['controller'])) {
				$controller = $url['controller'];
			} else {
				$controller = $this->params['controller'];
			}
			if (isset($url['action'])) {
				$action = $url['action'];
			} else {
				$action = $this->params['action'];
			}
			if (AuthComponent::check($checkString, $controller, $action)) {
				return "OK";
			} else {
				return "NO PERMS";
			}
		} else {
			// Otherwise, just return the link as normal
			return $this->Html->link($title, $url, $options, $confirmMessage);
		}
	}
}