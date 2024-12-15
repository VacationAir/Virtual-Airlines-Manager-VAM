<?php
App::uses('AppController', 'Controller');
/**
 * FinancialParameters Controller
 *
 * @property FinancialParameter $FinancialParameter
 */
class FinancialParametersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FinancialParameter->recursive = 0;
		$this->set('FinancialParameters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FinancialParameter->exists($id)) {
			throw new NotFoundException(__('Invalid Financial parameter'));
		}
		$options = array('conditions' => array('FinancialParameter.' . $this->FinancialParameter->primaryKey => $id));
		$this->set('FinancialParameter', $this->FinancialParameter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
 
	public function add() {
		if ($this->request->is('post')) {
			$this->FinancialParameter->create();
			if ($this->FinancialParameter->save($this->request->data)) {
				$this->Session->setFlash(__('The parameter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parameter could not be saved. Please, try again.'));
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
		if (!$this->FinancialParameter->exists($id)) {
			throw new NotFoundException(__('Invalid parameter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FinancialParameter->save($this->request->data)) {
				$this->Session->setFlash(__('The parameter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parameter could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FinancialParameter.' . $this->FinancialParameter->primaryKey => $id));
			$this->request->data = $this->FinancialParameter->find('first', $options);
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
		echo '33333';
		$this->FinancialParameter->id = $id;
		if (!$this->FinancialParameter->exists()) {
			throw new NotFoundException(__('Invalid  parameter'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FinancialParameter->delete()) {
			$this->Session->setFlash(__('Financial parameter deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Financial parameter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
}
