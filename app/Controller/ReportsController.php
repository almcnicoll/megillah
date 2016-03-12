<?php
App::uses( 'AppController', 'Controller' );

/**
 * Reports Controller
 *
 * @property User               $User
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {

	/**
	 * This controller does not use a model by default
	 *
	 * @var array
	 */
	public $useModel = false;
	public $uses = array();

	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function overdue() {
		$this->loadModel('Loan');
		$loans = $this->Loan->find('all', array(
			'contain' => array(
				'User',
				'Copy' => array(
					'Book' => array(
						'Author',
					),
				),
			),
			'conditions' => array(
				'returned_date IS NULL',
				"due_date > '".date('Y-m-d')."'",
			),
			'order' => array(
				'User.last_name',
				'User.first_name',
				'Loan.due_date',
			),
		));
		
		$this->set(compact('loans'));
	}

	public function all_loans() {
		
	}
}
