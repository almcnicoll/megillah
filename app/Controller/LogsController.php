<?php
App::uses( 'AppController', 'Controller' );

/**
 * Logs Controller
 *
 * @property Log                $Log
 * @property PaginatorComponent $Paginator
 */
class LogsController extends AppController {

	public $paginate = array();

	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Log->recursive = 0;
		$logs                 = $this->paginate();
		$this->set( compact( 'logs' ) );
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
		$this->Log->recursive = 0;
		if ( empty( $id ) || ! ( $log = $this->Log->find( 'first', array( 'conditions' => array( 'Log.id' => $id ) ) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			return $this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		$this->set( compact( 'log' ) );
	}
}
