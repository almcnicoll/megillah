<?php
App::uses( 'AppController', 'Controller' );

/**
 * Accounts Controller
 *
 * @property Account            $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

	public $uses = array( 'User' );

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow( 'login', 'logout' );
	}

	/**
	 * AccountController::login()
	 *
	 * @return void
	 */
	public function login() {
		if ( $this->Common->isPosted() ) {
			if ( ClassRegistry::init( 'Attempt' )->find( 'count', array(
					'conditions' => array(
						'ip_address' => $this->request->clientIp( false ),
						'controller' => 'accounts',
						'action'     => 'login',
						'created >=' => date( 'Y-m-d H:i:s', strtotime( '-5 minutes' ) )
					)
				) ) < 5
			) {
				if ( $this->Auth->login() ) {
					$this->Flash->message( __( 'Welcome!' ), 'success' );
					$u = Auth::user();
					$beta_programme_level = 0;
					$u['beta_programme_level'] = $beta_programme_level;
					$this->Session->write('Auth.User', $u);
					$this->redirect( $this->Auth->redirectUrl() );
				}
				sleep( 2 ); // Basic counter to brute force attacks.
				$this->Flash->message( __( 'Your credentials do not match a known user. Please check your details and try again.' ), 'danger' );
			} else {
				$this->Flash->message( __( 'Too many login attempts. Please wait five minutes and try again.' ), 'danger' );
			}
			// Save failed login attempt.
			ClassRegistry::init( 'Attempt' )->create();
			ClassRegistry::init( 'Attempt' )->save( array(
				'ip_address' => $this->request->clientIp( false ),
				'controller' => 'accounts',
				'action'     => 'login'
			) );
			$this->request->data['User']['password'] = '';
		} else {
			if ( Auth::user() ) {
				// Remove the "not authorised" message
				$this->Session->delete('Message');
				$this->redirect( array('controller' => 'dashboards', 'action' => '') );
			} else {
				if ( $username = $this->request->query( 'username' ) ) {
					$this->request->data['User']['login'] = $username;
				}
			}
		}
	}

	/**
	 * AccountController::logout()
	 *
	 * @return void
	 */
	public function logout() {
		$whereTo = $this->Auth->logout();
		$this->Flash->message( __( 'Goodbye!' ), 'success' );
		$this->redirect( $whereTo );
	}
}
