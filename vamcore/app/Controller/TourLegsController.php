<?php
App::uses('AppController', 'Controller');
/**
 * TourLegs Controller
 *
 * @property TourLeg $TourLegs
 */
class TourLegsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TourLeg->recursive = 0;
		$this->set('tourLegs', $this->paginate());
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
		if (!$this->TourLeg->exists($id)) {
			throw new NotFoundException(__('Invalid tourlegs route'));
		}
		$options = array('conditions' => array('TourLeg.' . $this->TourLeg->primaryKey => $id));
		$this->set('tourLeg', $this->TourLeg->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$tours = $this->TourLeg->Tour->find('list');
		
			
		$this->set(compact('tours'));

		if ($this->request->is('post')) {
			$this->TourLeg->create();
			if ($this->TourLeg->save($this->request->data)) {
				$this->Session->setFlash(__('The tourlegs route has been saved'));
				$this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The tourlegs route could not be saved. Please, try again.'));
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
		$tours = $this->TourLeg->Tour->find('list');
		$this->set(compact('tours'));
		if (!$this->TourLeg->exists($id)) {
			throw new NotFoundException(__('Invalid tourlegs route'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TourLeg->save($this->request->data)) {
				$this->Session->setFlash(__('The tourlegs route has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tourlegs route could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TourLeg.' . $this->TourLeg->primaryKey => $id));
			$this->request->data = $this->TourLeg->find('first', $options);
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
		$this->TourLeg->id = $id;
		if (!$this->TourLeg->exists()) {
			throw new NotFoundException(__('Invalid Tour Leg '));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TourLeg->delete()) {
			$this->Session->setFlash(__('Tour Leg deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tour Leg  was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
