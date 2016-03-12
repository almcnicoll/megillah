<?php
App::uses( 'AppController', 'Controller' );

/**
 * Users Controller
 *
 * @property User               $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $components = array(
		'Search.Prg',
		'Cookie',
	);

	public $paginate = array();

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('ping');
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions' => $this->User->parseCriteria( $this->Prg->parsedParams() )
		);
		$users          = $this->paginate();
		$this->set( compact( 'users' ) );
	}

	/**
	 * View method
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function view( $id = null ) {
		/* TODO - use this code for library membership
		$centres = ClassRegistry::init( 'Centre' )->find( 'all', array(
			'joins'      => array(
				array(
					'alias'      => 'CentreMembership',
					'table'      => 'centres_users',
					'type'       => 'INNER',
					'conditions' => array( 'CentreMembership.centre_id = Centre.id' ),
				),
			),
			'conditions' => array(
				'CentreMembership.user_id' => $id,
				'CentreMembership.expiry_date IS NULL'
			)
		) );
		*/
		
		if ($id == null) {
			$this->Flash->message( __( 'No such user' ), 'warning' );
			$this->Common->postRedirect( array( 'action' => 'index' ) );
			return;
		}
		
		$user = $this->User->find('first', array(
			'contain' => array(
				'Loan' => array(
					'Copy' => array(
						'Book',
					),
				),
			),
			'conditions' => array(
				'User.id' => $id,
			),
		));
		$this->set( compact( 'user'/*, 'centres'*/ ) );
	}

	/**
	 * Add method
	 *
	 * @return void
	 */
	public function add() {
		$this->User->Behaviors->load( 'Tools.Passwordable', array() );
		if ( $this->Common->isPosted() ) {
			$this->User->create();
			if ( $this->User->saveAll( $this->request->data ) ) {
				$this->Flash->message( __( 'User created successfully' ), 'success' );
				$this->Common->postRedirect( array( 'action' => 'index' ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
			unset( $this->request->data['User']['pwd'] );
			unset( $this->request->data['User']['pwd_repeat'] );
		}
		/*
		TODO - Replace code below with library membership
		ClassRegistry::init( 'Centre' )->virtualFields['orgName'] = "CONCAT('- ',Organisation.name)";
		$centres = ClassRegistry::init( 'Centre' )->find( 'list', array(
			'fields' => array(
				'Centre.id',
				'Centre.name',
				'Organisation.name'
			),
			'joins'  => array(
				array(
					'alias'      => 'Organisation',
					'table'      => 'organisations',
					'type'       => 'INNER',
					'conditions' => array( 'Organisation.id = Centre.organisation_id', ),
				),
			),
		) );
		$this->set( compact( 'centres' ) );*/
	}

	/**
	 * Change Password
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function change_password( $id = null ) {
		$this->User->Behaviors->load( 'Tools.Passwordable', array() );
		if ( empty( $id ) || ! ( $user = $this->User->find( 'first',
				array( 'conditions' => array( 'User.id' => $id ) ) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			$this->Common->postRedirect( array( 'controller' => 'requests', 'action' => 'index' ) );
		}
		if ( $this->Common->isPosted() ) {
			if ( $this->User->save( $this->request->data, array(
				'fieldList' => array(
					'id',
					'pwd',
					'pwd_repeat'
				)
			) )
			) {
				$this->Flash->message( __( 'User password changed' ), 'success' );

				$this->Common->postRedirect( array( 'action' => 'view', $id ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
			unset( $this->request->data['User']['pwd'] );
			unset( $this->request->data['User']['pwd_repeat'] );
		} else {
			$this->request->data = $user;
		}
	}

	/**
	 * Change Email
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function change_email( $id = null ) {
		if ( empty( $id ) || ! ( $user = $this->User->find( 'first',
				array( 'conditions' => array( 'User.id' => $id ) ) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			$this->Common->postRedirect( array( 'controller' => 'requests', 'action' => 'index' ) );
		}
		if ( $this->Common->isPosted() ) {
			if ( $this->User->save( $this->request->data, array(
				'fieldList' => array(
					'id',
					'email',
				)
			) )
			) {
				// Refresh auth data
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
				
				$this->Flash->message( __( 'User email changed' ), 'success' );

				// Return where you came from - if set
				if (isset($this->request->data['User']['back_url'])) {
					$redir_arr = unserialize(base64_decode($this->request->data['User']['back_url']));
					$this->redirect($redir_arr);
				} else {
					$this->Common->postRedirect( array( 'action' => 'view', $id ) );
				}
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
		} else {
			$this->request->data = $user;
		}
	}

	/**
	 * Change Theme
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function change_theme( $id = null ) {
		if ( empty( $id ) || ! ( $user = $this->User->find( 'first',
				array( 'conditions' => array( 'User.id' => $id ) ) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			$this->Common->postRedirect( array( 'controller' => 'requests', 'action' => 'index' ) );
		}
		if ( $this->Common->isPosted() ) {
			if ( $newUser = $this->User->save( $this->request->data, array(
				'fieldList' => array(
					'id',
					'theme_id'
				)
			) )
			) {
				$this->Flash->message( __( 'User theme changed' ), 'success' );
				if ( $newUser['User']['id'] === Auth::id() ) {
					$newUser['User'] += $user['User'];
					if ( ! $this->Auth->login( $newUser['User'] ) ) {
						throw new CakeException( 'Error: Unable to update user authentication data.' );
					}
				}

				$this->Common->postRedirect( array( 'action' => 'view', $id ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
		} else {
			$this->request->data = $user;
		}
		$themes = $this->User->Theme->find( 'list' );
		$this->set( compact( 'themes' ) );
	}

	/**
	 * Edit method
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function edit( $id = null ) {
		$this->User->Behaviors->attach( 'Tools.Passwordable', array( 'require' => false ) );
		if ( empty( $id ) || ! ( $user = $this->User->find( 'first',
				array( 'conditions' => array( 'User.id' => $id ) ) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			$this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		if ( $this->Common->isPosted() ) {
			if ( $newUser = $this->User->save( $this->request->data ) ) {
				$this->Flash->message( __( 'User updated' ), 'success' );
				if ( $newUser['User']['id'] === Auth::id() ) {
					$newUser['User'] += $user['User'];
					if ( ! $this->Auth->login( $newUser['User'] ) ) {
						throw new CakeException( 'Error: Unable to update user authentication data.' );
					}
				}

				$this->Common->postRedirect( array( 'action' => 'view', $id ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
			unset( $this->request->data['User']['pwd'] );
			unset( $this->request->data['User']['pwd_repeat'] );
		} else {
			$this->request->data = $user;
		}
		$themes = $this->User->Theme->find( 'list' );
		$this->set( compact( 'themes' ) );
	}

	/**
	 * Delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function delete( $id = null ) {
		$this->request->allowMethod( 'post', 'delete' );
		if ( empty( $id ) || ! ( $user = $this->User->find( 'first', array(
				'conditions' => array( 'User.id' => $id ),
				'fields'     => array( 'id' )
			) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			$this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		if ( $this->User->delete( $id ) ) {
			$this->Flash->message( __( 'User deleted' ), 'success' );

			$this->Common->postRedirect( array( 'action' => 'index' ) );
		}
		$this->Flash->message( __( 'User could not be deleted' ), 'danger' );

		$this->Common->autoRedirect( array( 'action' => 'view', $id ) );
	}

	public function ping() {
		$this->autoRender = false;
		$u = Auth::user();
		if ($u === null) {
			$data = array(
				'user'		=>	null,
				'session'	=>	0,
			);
		} else {
			$data = array(
				'user'		=>	$u['id'],
				'session'	=>	1,
			);
			// Log last username
			if (isset($u['username'])) {
				$this->Cookie->write('last_user', $u['username']);
			}
		}
		if ($this->Cookie->check('last_user')) {
			$data['last_user'] = $this->Cookie->read('last_user');
		}
		return json_encode($data);
	}
	
	public function login() {
		$this->redirect( array('controller' => 'accounts', 'action' => 'login') );
	}
	
	public function log_back_in() {
		
	}
}
