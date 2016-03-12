<?php
App::uses('AppController', 'Controller');
/**
 * Taxonomies Controller
 *
 * @property Taxonomy $Taxonomy
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TaxonomiesController extends AppController {

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
		$this->Taxonomy->recursive = 0;
		$this->set('taxonomies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Taxonomy->exists($id)) {
			throw new NotFoundException(__('Invalid taxonomy'));
		}
		$options = array('conditions' => array('Taxonomy.' . $this->Taxonomy->primaryKey => $id));
		$this->set('taxonomy', $this->Taxonomy->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Taxonomy->create();
			if ($this->Taxonomy->save($this->request->data)) {
				$this->Session->setFlash(__('The taxonomy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The taxonomy could not be saved. Please, try again.'));
			}
		}
		$parents = $this->Taxonomy->Parent->find('list');
		$books = $this->Taxonomy->Book->find('list');
		$this->set(compact('parents', 'books'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Taxonomy->exists($id)) {
			throw new NotFoundException(__('Invalid taxonomy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Taxonomy->save($this->request->data)) {
				$this->Session->setFlash(__('The taxonomy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The taxonomy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Taxonomy.' . $this->Taxonomy->primaryKey => $id));
			$this->request->data = $this->Taxonomy->find('first', $options);
		}
		$parents = $this->Taxonomy->Parent->find('list');
		$books = $this->Taxonomy->Book->find('list');
		$this->set(compact('parents', 'books'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Taxonomy->id = $id;
		if (!$this->Taxonomy->exists()) {
			throw new NotFoundException(__('Invalid taxonomy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Taxonomy->delete()) {
			$this->Session->setFlash(__('The taxonomy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The taxonomy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
