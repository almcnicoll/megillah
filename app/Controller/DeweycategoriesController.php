<?php
App::uses('AppController', 'Controller');
/**
 * Deweycategories Controller
 *
 * @property Deweycategory $Deweycategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DeweycategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Deweycategory->recursive = 0;
		$this->set('deweycategories', $this->Deweycategory->find('threaded', array(
			'order'	=>	'Deweycategory.lft',
		)));
	}

/**
 * index_table method
 *
 * @return void
 */
	public function index_table() {
		$this->Deweycategory->recursive = 0;
		$this->set('deweycategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Deweycategory->exists($id)) {
			throw new NotFoundException(__('Invalid deweycategory'));
		}
		$options = array('conditions' => array('Deweycategory.' . $this->Deweycategory->primaryKey => $id));
		$this->set('deweycategory', $this->Deweycategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Deweycategory->create();
			if ($this->Deweycategory->save($this->request->data)) {
				$this->Session->setFlash(__('The deweycategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deweycategory could not be saved. Please, try again.'));
			}
		}
		$parents = $this->Deweycategory->Parent->find('list');
		$taxonomies = $this->Deweycategory->Taxonomy->find('list');
		$this->set(compact('parents', 'taxonomies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Deweycategory->exists($id)) {
			throw new NotFoundException(__('Invalid deweycategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Deweycategory->save($this->request->data)) {
				$this->Session->setFlash(__('The deweycategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deweycategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Deweycategory.' . $this->Deweycategory->primaryKey => $id));
			$this->request->data = $this->Deweycategory->find('first', $options);
		}
		$parents = $this->Deweycategory->Parent->find('list');
		$taxonomies = $this->Deweycategory->Taxonomy->find('list');
		$this->set(compact('parents', 'taxonomies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Deweycategory->id = $id;
		if (!$this->Deweycategory->exists()) {
			throw new NotFoundException(__('Invalid deweycategory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Deweycategory->delete()) {
			$this->Session->setFlash(__('The deweycategory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The deweycategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
