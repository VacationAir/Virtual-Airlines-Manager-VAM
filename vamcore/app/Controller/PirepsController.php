<?php
App::uses('AppController', 'Controller');
/**
 * Pireps Controller
 *
 * @property Pirep $Pirep
 */
class PirepsController extends AppController {
	public $paginate = array(
   'limit' => 300
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->Pirep->recursive = 0;

		$this->set('pireps', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pirep->exists($id)) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		$options = array('conditions' => array('Pirep.' . $this->Pirep->primaryKey => $id));
		$this->set('pirep', $this->Pirep->find('first', $options));
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
		if (!$this->Pirep->exists($id)) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pirep->save($this->request->data)) {
				$this->Session->setFlash(__('The pirep has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pirep could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pirep.' . $this->Pirep->primaryKey => $id));
			$this->request->data = $this->Pirep->find('first', $options);
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
		$this->Pirep->id = $id;
		if (!$this->Pirep->exists()) {
			throw new NotFoundException(__('Invalid pirep'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pirep->delete()) {
			$this->Session->setFlash(__('Pirep deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pirep was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}