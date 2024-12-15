<?php
App::uses('AppController', 'Controller');
/**
 * Fleettypes Controller
 *
 * @property Fleettype $Fleettype
 */
class FleettypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Fleettype->recursive = 0;
		$this->set('fleettypes', $this->paginate());
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
		if (!$this->Fleettype->exists($id)) {
			throw new NotFoundException(__('Invalid fleettype'));
		}
		$options = array('conditions' => array('Fleettype.' . $this->Fleettype->primaryKey => $id));
		$this->set('fleettype', $this->Fleettype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Fleettype->create();
			if ($this->Fleettype->save($this->request->data)) {
				$this->Session->setFlash(__('The fleettype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleettype could not be saved. Please, try again.'));
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
		if (!$this->Fleettype->exists($id)) {
			throw new NotFoundException(__('Invalid fleettype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Fleettype->save($this->request->data)) {
				$this->Session->setFlash(__('The fleettype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleettype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Fleettype.' . $this->Fleettype->primaryKey => $id));
			$this->request->data = $this->Fleettype->find('first', $options);
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
		$this->Fleettype->id = $id;
		if (!$this->Fleettype->exists()) {
			throw new NotFoundException(__('Invalid fleettype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Fleettype->delete()) {
			$this->Session->setFlash(__('Fleettype deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fleettype was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
