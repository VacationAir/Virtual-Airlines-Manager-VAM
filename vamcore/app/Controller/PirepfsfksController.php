<?php
App::uses('AppController', 'Controller');
/**
 * Pirepfsfks Controller
 *
 * @property Pirepfsfk $Pirepfsfk
 */
class PirepfsfksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pirepfsfk->recursive = 0;
		$this->set('pirepfsfks', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pirepfsfk->exists($id)) {
			throw new NotFoundException(__('Invalid pirepfsfk'));
		}
		$options = array('conditions' => array('Pirepfsfk.' . $this->Pirepfsfk->primaryKey => $id));
		$this->set('pirepfsfk', $this->Pirepfsfk->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pirepfsfk->create();
			if ($this->Pirepfsfk->save($this->request->data)) {
				$this->Session->setFlash(__('The pirepfsfk has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pirepfsfk could not be saved. Please, try again.'));
			}
		}
		$gvausers = $this->Pirepfsfk->Gvauser->find('list');
		$this->set(compact('gvausers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pirepfsfk->exists($id)) {
			throw new NotFoundException(__('Invalid pirepfsfk'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pirepfsfk->save($this->request->data)) {
				$this->Session->setFlash(__('The pirepfsfk has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pirepfsfk could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pirepfsfk.' . $this->Pirepfsfk->primaryKey => $id));
			$this->request->data = $this->Pirepfsfk->find('first', $options);
		}
		$gvausers = $this->Pirepfsfk->Gvauser->find('list');
		$this->set(compact('gvausers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pirepfsfk->id = $id;
		if (!$this->Pirepfsfk->exists()) {
			throw new NotFoundException(__('Invalid pirepfsfk'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pirepfsfk->delete()) {
			$this->Session->setFlash(__('Pirepfsfk deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pirepfsfk was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
