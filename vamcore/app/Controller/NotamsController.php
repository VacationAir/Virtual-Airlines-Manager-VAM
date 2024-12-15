<?php
App::uses('AppController', 'Controller');
/**
 * Notams Controller
 *
 * @property Notam $Notam
 */
class NotamsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Notam->recursive = 0;
		$this->set('notams', $this->paginate());
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
		if (!$this->Notam->exists($id)) {
			throw new NotFoundException(__('Invalid notam'));
		}
		$options = array('conditions' => array('Notam.' . $this->Notam->primaryKey => $id));
		$this->set('notam', $this->Notam->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notam->create();
			if ($this->Notam->save($this->request->data)) {
				$this->Session->setFlash(__('The notam has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notam could not be saved. Please, try again.'));
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
		if (!$this->Notam->exists($id)) {
			throw new NotFoundException(__('Invalid notam'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Notam->save($this->request->data)) {
				$this->Session->setFlash(__('The notam has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notam could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notam.' . $this->Notam->primaryKey => $id));
			$this->request->data = $this->Notam->find('first', $options);
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
		$this->Notam->id = $id;
		if (!$this->Notam->exists()) {
			throw new NotFoundException(__('Invalid notam'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notam->delete()) {
			$this->Session->setFlash(__('Notam deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Notam was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
