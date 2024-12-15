<?php
App::uses('AppController', 'Controller');
/**
 * VaFinances Controller
 *
 * @property VaFinance $VaFinance
 */
class VaFinancessController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->VaFinance->recursive = 0;
		$this->set('vaFinances', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VaFinance->exists($id)) {
			throw new NotFoundException(__('Invalid va finance'));
		}
		$options = array('conditions' => array('VaFinance.' . $this->VaFinance->primaryKey => $id));
		$this->set('vaFinance', $this->VaFinance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */

	public function add() {
		if ($this->request->is('post')) {
			$this->VaFinance->create();
			if ($this->VaFinance->save($this->request->data)) {
				$this->Session->setFlash(__('The va finance has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The va finance could not be saved. Please, try again.'));
			}
		}
	}



}