<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 */
class DashboardsController extends AppController {
	public $useModel = false;
	public $uses = array('Loan');
	
	public function beforeFilter() {
		
	}
	
	public function index() {
		$this->redirect(array('action' => 'borrower'));
		die();
	}
	
	public function login() {
		
	}
	
	public function borrower() {
		//$this->loadModel('Loan');
		//$this->Loan->recursive = 0;
		$this->paginate['Loan'] =  array(
			'contain' => array(
				'Copy' => array(
					'Book',
				)
			),
			'conditions' => array(
				'Loan.returned_date IS NULL',
			),
		);
		$this->set('loans', $this->paginate('Loan'));
	}
	
	public function admin() {
		
	}
	
	public function setup() {
		
	}
	
	public function tech() {
		
	}
}
