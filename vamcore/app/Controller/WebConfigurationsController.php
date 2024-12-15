<?php
App::uses('AppController', 'Controller');
/**
 * WebConfiguration Controller
 *
 * @property WebConfiguration $WebConfiguration
 */
class WebConfigurationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WebConfiguration->recursive = 0;
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
		if (!$this->WebConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid config email'));
		}
		$options = array('conditions' => array('WebConfiguration.' . $this->WebConfiguration->primaryKey => $id));
		$this->set('webConfiguration', $this->WebConfiguration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
 /*

	*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WebConfiguration->exists($id)) {
			throw new NotFoundException(__('Invalid Web Configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WebConfiguration->save($this->request->data)) {
				$this->Session->setFlash(__('The Web Configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Web Configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WebConfiguration.' . $this->WebConfiguration->primaryKey => $id));
			$this->request->data = $this->WebConfiguration->find('first', $options);
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

    */
}
