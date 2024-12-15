<?php
App::uses('AppController', 'Controller');
/**
 * FleettypesRoutes Controller
 *
 * @property FleettypesRoute $FleettypesRoute
 */
class FleettypesRoutesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FleettypesRoute->recursive = 0;
		$this->set('fleettypesRoutes', $this->paginate());
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
		if (!$this->FleettypesRoute->exists($id)) {
			throw new NotFoundException(__('Invalid fleettypes route'));
		}
		$options = array('conditions' => array('FleettypesRoute.' . $this->FleettypesRoute->primaryKey => $id));
		$this->set('fleettypesRoute', $this->FleettypesRoute->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FleettypesRoute->create();
			if ($this->FleettypesRoute->save($this->request->data)) {
				$this->Session->setFlash(__('The fleettypes route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleettypes route could not be saved. Please, try again.'));
			}
		}
		$routes = $this->FleettypesRoute->Route->find('list');
		$fleettypes = $this->FleettypesRoute->Fleettype->find('list');
		$this->set(compact('routes', 'fleettypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FleettypesRoute->exists($id)) {
			throw new NotFoundException(__('Invalid fleettypes route'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FleettypesRoute->save($this->request->data)) {
				$this->Session->setFlash(__('The fleettypes route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleettypes route could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FleettypesRoute.' . $this->FleettypesRoute->primaryKey => $id));
			$this->request->data = $this->FleettypesRoute->find('first', $options);
		}
		$routes = $this->FleettypesRoute->Route->find('list');
		$fleettypes = $this->FleettypesRoute->Fleettype->find('list');
		$this->set(compact('routes', 'fleettypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FleettypesRoute->id = $id;
		if (!$this->FleettypesRoute->exists()) {
			throw new NotFoundException(__('Invalid fleettypes route'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FleettypesRoute->delete()) {
			$this->Session->setFlash(__('Fleettypes route deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fleettypes route was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
