<?php
App::uses( 'AppController', 'Controller' );

/**
 * Countries Controller
 *
 * @property Country            $Country
 * @property PaginatorComponent $Paginator
 */
class CountriesController extends AppController {

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
		$this->Country->recursive = - 1;
		$countries                = $this->paginate();
		$this->set( compact( 'countries' ) );
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
		$this->Country->recursive = 0;
		if ( empty( $id ) || ! ( $country = $this->Country->find( 'first', array(
				'contain'    => array(
					'Currency',
					'Organisation'
				),
				'conditions' => array( 'Country.id' => $id )
			) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			return $this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		$this->set( compact( 'country' ) );
	}

	/**
	 * Add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->Common->isPosted() ) {
			$this->Country->create();
			if ( $this->Country->save( $this->request->data ) ) {
				$this->Flash->message( __( 'The record was saved' ), 'success' );

				return $this->Common->postRedirect( array( 'action' => 'index' ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
		}
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
		if ( empty( $id ) || ! ( $country = $this->Country->find( 'first', array(
				'contain'    => array( 'Organisation' ),
				'conditions' => array( 'Country.id' => $id )
			) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			return $this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		if ( $this->Common->isPosted() ) {
			if ( $this->Country->save( $this->request->data ) ) {
				$this->Flash->message( __( 'Country updated' ), 'success' );

				return $this->Common->postRedirect( array( 'action' => 'view', $id ) );
			}
			$this->Flash->message( __( 'The form is incomplete or has errors. Please check the form again.' ), 'danger' );
		} else {
			$this->request->data = $country;
		}
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
		if ( empty( $id ) || ! ( $country = $this->Country->find( 'first', array(
				'conditions' => array( 'Country.id' => $id ),
				'fields'     => array( 'id' )
			) ) )
		) {
			$this->Flash->message( __( 'You do not have permission to view this record, or it has been deleted.' ), 'danger' );

			return $this->Common->autoRedirect( array( 'action' => 'index' ) );
		}
		if ( $this->Country->delete( $id ) ) {
			$this->Flash->message( __( 'Country deleted' ), 'success' );

			return $this->Common->postRedirect( array( 'action' => 'index' ) );
		}
		$this->Flash->message( __( 'Country could not be deleted' ), 'danger' );

		return $this->Common->autoRedirect( array( 'action' => 'view', $id ) );
	}
}
