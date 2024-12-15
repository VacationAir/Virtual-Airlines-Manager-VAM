<?php
App::uses('AppController', 'Controller');
/**
 * Routes Controller
 *
 * @property Route $Route
 */
class RoutesController extends AppController {

	public $paginate = array(
   'limit' => 200
    );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Route->recursive = 0;
		$this->set('routes', $this->paginate());

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Route->exists($id)) {
			throw new NotFoundException(__('Invalid route'));
		}
		$options = array('conditions' => array('Route.' . $this->Route->primaryKey => $id));
		$this->set('route', $this->Route->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$hubs = $this->Route->Hub->find('list');
		$this->set(compact('hubs'));

		if ($this->request->is('post')) {
			$this->Route->create();
			if ($this->Route->save($this->request->data)) {
				$this->Session->setFlash(__('The Route has been saved'));
				$this->redirect(array('action' => 'index'));
			// VAM	$this->flash(__('Route saved.'), array('action' => 'index'));
			} else {
			}
		}
		$fleettypes = $this->Route->Fleettype->find('list');
		$this->set(compact('fleettypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 


	public function edit($id = null) {
		$hubs = $this->Route->Hub->find('list');
		$this->set(compact('hubs'));

		if (!$this->Route->exists($id)) {
			throw new NotFoundException(__('Invalid route'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Route->save($this->request->data)) {
				$this->Session->setFlash(__('The Route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('Route.' . $this->Route->primaryKey => $id));
			$this->request->data = $this->Route->find('first', $options);
		}
		$fleettypes = $this->Route->Fleettype->find('list');
		$this->set(compact('fleettypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Route->id = $id;
		if (!$this->Route->exists()) {
			throw new NotFoundException(__('Invalid route'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Route->delete()) {
			$this->flash(__('Route deleted'), array('action' => 'index'));
		}
		$this->flash(__('Route was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
