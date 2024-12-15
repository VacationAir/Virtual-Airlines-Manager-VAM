<?php
App::uses('AppController', 'Controller');
/**
 * Vampireps Controller
 *
 * @property Vampirep $Vampirep
 */
class VampirepsController extends AppController {
	public $paginate = array(
   'limit' => 10
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Vampirep->recursive = 0;

		$this->set('vampireps', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vampirep->exists($id)) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		$options = array('conditions' => array('Vampirep.' . $this->Vampirep->primaryKey => $id));
		$this->set('vampirep', $this->Vampirep->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vampirep->exists($id)) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Vampirep->save($this->request->data)) {
				$this->Session->setFlash(__('The pirep has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pirep could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vampirep.' . $this->Vampirep->primaryKey => $id));
			$this->request->data = $this->Vampirep->find('first', $options);
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
		$this->Vampirep->id = $id;
		if (!$this->Vampirep->exists()) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vampirep->delete()) {
			$this->Session->setFlash(__('Flight deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Flight was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}