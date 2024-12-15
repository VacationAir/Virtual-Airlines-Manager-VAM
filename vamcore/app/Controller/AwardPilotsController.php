<?php
App::uses('AppController', 'Controller');
/**
 */
class AwardPilotsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AwardPilot->recursive = 0;
		$this->set('awardPilots', $this->paginate());
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
		if (!$this->AwardPilot->exists($id)) {
			throw new NotFoundException(__('Invalid Award Pilot'));
		}
		$options = array('conditions' => array('AwardPilot.' . $this->AwardPilot->primaryKey => $id));
		$this->set('awardPilot', $this->AwardPilot->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$awards = $this->AwardPilot->Award->find('list');
		////$gvausers = $this->AwardPilot->Gvauser->find('list');
		////$gvausers = $this->AwardPilot->Gvauser->find('list', array('fields' => array('gvauser_id', 'name_surname')));
		$gvausers = $this->AwardPilot->Gvauser->find(
			'list', 
			array('fields' => array('gvauser_id', 'name_surname'),
				  'order'=>'name_surname ASC')
			);

		$this->set(compact('awards')); // Populate dropdown for Awards in edit page
		$this->set(compact('gvausers')); // Populate dropdown for pilots in edit page
		
		
		if ($this->request->is('post')) {
			$this->AwardPilot->create();
			$db = $this->AwardPilot->getDataSource();
			$this->request->data['AwardPilot']['award_date'] =  $db->expression('NOW()');
			if ($this->AwardPilot->save($this->request->data)) {
				$this->Session->setFlash(__('The Award Pilot assignation has been saved'));
				$this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The Award Pilot assignation could not be saved. Please, try again.'));
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
		$awards = $this->AwardPilot->Award->find('list');
		//$gvausers = $this->AwardPilot->Gvauser->find('list');
		$gvausers = $this->AwardPilot->Gvauser->find(
			'list', 
			array('fields' => array('gvauser_id', 'name_surname'),
				  'order'=>'name_surname ASC')
		);
		$this->set(compact('awards')); // Populate dropdown for Awards in edit page
		$this->set(compact('gvausers')); // Populate dropdown for pilots in edit page

		if (!$this->AwardPilot->exists($id)) {
			throw new NotFoundException(__('Invalid Award Pilot assignation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AwardPilot->save($this->request->data)) {
				$this->Session->setFlash(__('The Award Pilot assignation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Award Pilot assignation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AwardPilot.' . $this->AwardPilot->primaryKey => $id));
			$this->request->data = $this->AwardPilot->find('first', $options);
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
		$this->AwardPilot->id = $id;
		if (!$this->AwardPilot->exists()) {
			throw new NotFoundException(__('Invalid Award Leg '));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AwardPilot->delete()) {
			$this->Session->setFlash(__('Award Leg deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Award Leg  was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
