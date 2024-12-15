<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Fleets Controller
 *
 * @property Fleet $Fleet
 */
class FleetsController extends AppController {



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Fleet->recursive = 0;
		$this->set('fleets', $this->paginate());
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
		$this->Fleet->id = $id;
		if (!$this->Fleet->exists()) {
			throw new NotFoundException(__('Invalid fleet'));
		}
		$this->set('fleet', $this->Fleet->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$fleettypes = $this->Fleet->Fleettype->find('list');
		$this->set(compact('fleettypes'));
		
		$hubs = $this->Fleet->Hub->find('list');
		$this->set(compact('hubs'));
		
		if ($this->request->is('post')) {
				include ('../../../vam/db_login.php');
				$fleettype_id=$this->data['Fleet']['fleettype_id'];
				$registry=$this->data['Fleet']['registry'];
				$name=$this->data['Fleet']['name'];
				$type='';
				$aircraftvalue=0;
				$db = new mysqli($db_host , $db_username , $db_password , $db_database);
				$db->set_charset("utf8");
				if ($db->connect_errno > 0) {
					die('Unable to connect to database [' . $db->connect_error . ']');
				}
				$sql = "select * from fleettypes where fleettype_id=$fleettype_id";
				if (!$result = $db->query($sql)) 
				{
					die('There was an error running the query  [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()) 
				{
					$aircraftvalue = -1 * $row['unit_price'];
					$type = $row['plane_icao'];
				}


				$description = $type. ' ' . $registry . ' ' . $name;
			 	$sql = "insert into va_finances (finance_date,amount,description,report_type) values (now(),$aircraftvalue,'$description','New Aircraft')";
				if (!$result = $db->query($sql)) 
				{
					die('There was an error running the query  [' . $db->error . ']');
				}

			$this->Fleet->create();
			if ($this->Fleet->save($this->request->data)) {
				$this->Session->setFlash(__('The fleet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleet could not be saved. Please, try again.'));
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
		$fleettypes = $this->Fleet->Fleettype->find('list');
		$this->set(compact('fleettypes'));
		
		$hubs = $this->Fleet->Hub->find('list');
		$this->set(compact('hubs'));
		
		$this->Fleet->id = $id;
		if (!$this->Fleet->exists()) {
			throw new NotFoundException(__('Invalid fleet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Fleet->save($this->request->data)) {
				$this->Session->setFlash(__('The fleet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fleet could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Fleet->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Fleet->id = $id;
		if (!$this->Fleet->exists()) {
			throw new NotFoundException(__('Invalid fleet'));
		}
		if ($this->Fleet->delete()) {
			$this->Session->setFlash(__('Fleet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fleet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
