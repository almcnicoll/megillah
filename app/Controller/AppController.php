<?php
/**
 * Application level Controller
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses( 'MyController', 'Tools.Controller' );

/**
 * Application Controller
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link           http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends MyController {

	public $components = array( 'Session', 'RequestHandler', 'Tools.Common', 'Tools.Flash', 'Auth', 'Security' );

	public $helpers = array(
		'Session',
		'Html',
		'Time',
		'Form' => array( 'className' => 'Tools.FormExt' ),
		'Tools.Common',
		'Tools.Format',
		'Tools.Datetime',
		'Tools.Numeric',
		'Tools.Flash',
		'ViewPlus',
	);

	public $theme = 'Bootstrap';

	/**
	 * AppController::constructClasses()
	 *
	 * @return void
	 */
	public function constructClasses() {
		if ( CakePlugin::loaded( 'DebugKit' ) && Configure::read( 'debug' ) ) {
			$this->components[] = 'DebugKit.Toolbar';
		}
		parent::constructClasses();
	}

	/**
	 * AppController::beforeFilter()
	 *
	 * @return void
	 */
	public function beforeFilter() {
		/*
		// Require SSL
		if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT']) != 443) {
			$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$redirect}");
			die();
		}
		*/
		
		parent::beforeFilter();
		$this->Security->blackHoleCallback = 'blackhole';
		$this->Auth->allow( 'display' );
		$this->Auth->authenticate   = array(
			'Authenticate.MultiColumn' => array(
				'fields'    => array(
					'username' => 'login',
					'password' => 'password'
				),
				'columns'   => array( 'username' ),
				'userModel' => 'User',
			)
		);
		$this->Auth->authorize      = array( 'Tools.Tiny' => array(), );
		$this->Auth->logoutRedirect = array(
			'plugin'     => false,
			'admin'      => false,
			'controller' => 'pages',
			'action'     => 'display',
			'home'
		);
		$this->Auth->loginRedirect  = array(
			'plugin'     => false,
			'admin'      => false,
			'controller' => 'dashboards',
			'action'     => 'borrower'
		);
		$this->Auth->loginAction    = array(
			'plugin'     => false,
			'admin'      => false,
			'controller' => 'accounts',
			'action'     => 'login'
		);
		if ( Auth::user() ) {
			$siteTheme = ClassRegistry::init( 'Theme' )->find( 'first',
				array( 'conditions' => array( 'Theme.id' => Auth::user( 'theme_id' ) ) ) );
			$this->set( compact( 'siteTheme' ) );
		}
		if ( $this->request->is( 'ajax' ) ) {
			$this->disableCache();
		}
		$this->paginate['paramType'] = 'querystring';
	}

	public function blackhole( $type ) {
		Debugger::log( __( 'Black Hole Error Type: %s URL: %s User ID: %s', $type, Router::url( null, true ), Auth::user( 'username' ) ) ); // Catch blackhole types for debugging purposes.
	}
}
