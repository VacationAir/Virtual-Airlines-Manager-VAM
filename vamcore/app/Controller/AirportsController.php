<?php
App::uses('AppController', 'Controller');
/**
 * Airports Controller
 *
 * @property Airport $Airport
 */
class AirportsController extends AppController {
	public $paginate = array(
   'limit' => 300
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->Airport->recursive = 0;

		$this->set('airports', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Airport->exists($id)) {
			throw new NotFoundException(__('Invalid airport'));
		}
		$options = array('conditions' => array('Airport.' . $this->Airport->primaryKey => $id));
		$this->set('airport', $this->Airport->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Airport->create();
			if ($this->Airport->save($this->request->data)) {
				$this->Session->setFlash(__('The airport has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The airport could not be saved. Please, try again.'));
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
		if (!$this->Airport->exists($id)) {
			throw new NotFoundException(__('Invalid airport'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Airport->save($this->request->data)) {
				$this->Session->setFlash(__('The airport has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The airport could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Airport.' . $this->Airport->primaryKey => $id));
			$this->request->data = $this->Airport->find('first', $options);
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
		$this->Airport->id = $id;
		if (!$this->Airport->exists()) {
			throw new NotFoundException(__('Invalid airport'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Airport->delete()) {
			$this->Session->setFlash(__('Airport deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Airport was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}