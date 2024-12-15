<?php
App::uses('AppController', 'Controller');
/**
 * Hubs Controller
 *
 * @property Hub $Hub
 */
class HubsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Hub->recursive = 0;
		$this->set('hubs', $this->paginate());
	}
	public $paginate = array(
	'limit' => 30
    );	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Hub->exists($id)) {
			throw new NotFoundException(__('Invalid hub'));
		}
		$options = array('conditions' => array('Hub.' . $this->Hub->primaryKey => $id));
		$this->set('hub', $this->Hub->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Hub->create();
			if ($this->Hub->save($this->request->data)) {
				$this->Session->setFlash(__('The hub has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hub could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Hub->exists($id)) {
			throw new NotFoundException(__('Invalid hub'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Hub->save($this->request->data)) {
				$this->Session->setFlash(__('The hub has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hub could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Hub.' . $this->Hub->primaryKey => $id));
			$this->request->data = $this->Hub->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Hub->id = $id;
		if (!$this->Hub->exists()) {
			throw new NotFoundException(__('Invalid hub'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Hub->delete()) {
			$this->Session->setFlash(__('Hub deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Hub was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
