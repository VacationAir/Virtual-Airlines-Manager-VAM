<?php
App::uses('AppController', 'Controller');
/**
 * Ranks Controller
 *
 * @property Rank $Rank
 */
class RanksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rank->recursive = 0;
		$this->set('ranks', $this->paginate());
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
		if (!$this->Rank->exists($id)) {
			throw new NotFoundException(__('Invalid rank'));
		}
		$options = array('conditions' => array('Rank.' . $this->Rank->primaryKey => $id));
		$this->set('rank', $this->Rank->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rank->create();
			if ($this->Rank->save($this->request->data)) {
				$this->Session->setFlash(__('The rank has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rank could not be saved. Please, try again.'));
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
		if (!$this->Rank->exists($id)) {
			throw new NotFoundException(__('Invalid rank'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rank->save($this->request->data)) {
				$this->Session->setFlash(__('The rank has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rank could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rank.' . $this->Rank->primaryKey => $id));
			$this->request->data = $this->Rank->find('first', $options);
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
		$this->Rank->id = $id;
		if (!$this->Rank->exists()) {
			throw new NotFoundException(__('Invalid rank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rank->delete()) {
			$this->Session->setFlash(__('Rank deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rank was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}