<?php
App::uses('AppController', 'Controller');
/**
 * ConfigEmails Controller
 *
 * @property ConfigEmail $ConfigEmail
 */
class ConfigEmailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ConfigEmail->recursive = 0;
		$this->set('configEmails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConfigEmail->exists($id)) {
			throw new NotFoundException(__('Invalid config email'));
		}
		$options = array('conditions' => array('ConfigEmail.' . $this->ConfigEmail->primaryKey => $id));
		$this->set('configEmail', $this->ConfigEmail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
 /*
	public function add() {
		if ($this->request->is('post')) {
			$this->ConfigEmail->create();
			if ($this->ConfigEmail->save($this->request->data)) {
				$this->Session->setFlash(__('The config email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config email could not be saved. Please, try again.'));
			}
		}
	}
	*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ConfigEmail->exists($id)) {
			throw new NotFoundException(__('Invalid config email'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ConfigEmail->save($this->request->data)) {
				$this->Session->setFlash(__('The config email has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config email could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConfigEmail.' . $this->ConfigEmail->primaryKey => $id));
			$this->request->data = $this->ConfigEmail->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    /*
	public function delete($id = null) {
		$this->ConfigEmail->id = $id;
		if (!$this->ConfigEmail->exists()) {
			throw new NotFoundException(__('Invalid config email'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConfigEmail->delete()) {
			$this->Session->setFlash(__('Config email deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Config email was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
    */
}
