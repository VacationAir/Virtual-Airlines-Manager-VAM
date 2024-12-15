<?php
App::uses('AppController', 'Controller');
/**
 * VamacarsParameters Controller
 *
 * @property VamacarsParameter $VamacarsParameter
 */
class VamacarsParametersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->VamacarsParameter->recursive = 0;
		$this->set('vamacarsParameters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VamacarsParameter->exists($id)) {
			throw new NotFoundException(__('Invalid vamacars parameter'));
		}
		$options = array('conditions' => array('VamacarsParameter.' . $this->VamacarsParameter->primaryKey => $id));
		$this->set('vamacarsParameter', $this->VamacarsParameter->find('first', $options));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VamacarsParameter->exists($id)) {
			throw new NotFoundException(__('Invalid vamacars parameter'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->VamacarsParameter->save($this->request->data)) {
				$this->Session->setFlash(__('The vamacars parameter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vamacars parameter could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VamacarsParameter.' . $this->VamacarsParameter->primaryKey => $id));
			$this->request->data = $this->VamacarsParameter->find('first', $options);
		}
		
	}


}