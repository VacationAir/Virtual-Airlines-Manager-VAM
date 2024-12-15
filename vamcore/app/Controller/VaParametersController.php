<?php
App::uses('AppController', 'Controller');
/**
 * VaParameters Controller
 *
 * @property VaParameter $VaParameter
 */
class VaParametersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->VaParameter->recursive = 0;
		$this->set('vaParameters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VaParameter->exists($id)) {
			throw new NotFoundException(__('Invalid va parameter'));
		}
		$options = array('conditions' => array('VaParameter.' . $this->VaParameter->primaryKey => $id));
		$this->set('vaParameter', $this->VaParameter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
 /*
	public function add() {
		if ($this->request->is('post')) {
			$this->VaParameter->create();
			if ($this->VaParameter->save($this->request->data)) {
				$this->Session->setFlash(__('The va parameter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The va parameter could not be saved. Please, try again.'));
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
		if (!$this->VaParameter->exists($id)) {
			throw new NotFoundException(__('Invalid va parameter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// update activation finance module date 
			$mod=$this->data['VaParameter']['activate_finance_module'];
            $mod_old=$this->data['VaParameter']['activate_finance_module_old'];
            if ($mod ==1)
            {
            	$db = $this->VaParameter->getDataSource(); 
            	$fecha= $db->expression('NOW()');
            	$sql_date = date("Y-m-d H:m:s");
            	//$this->request->data['VaParameter']['date_activation_finance_module']=$db->expression('NOW()');
            	$sql_date = date("Y-m-d H:m:s");
  				$this->request->data['VaParameter']['date_activation_finance_module'] = $sql_date;
            	//$this->VaParameter->updateAll(array('date_activation_finance_module' => NOW()));
			}


			if ($this->VaParameter->save($this->request->data)) {
				$this->Session->setFlash(__('The va parameter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The va parameter could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VaParameter.' . $this->VaParameter->primaryKey => $id));
			$this->request->data = $this->VaParameter->find('first', $options);
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
		$this->VaParameter->id = $id;
		if (!$this->VaParameter->exists()) {
			throw new NotFoundException(__('Invalid va parameter'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VaParameter->delete()) {
			$this->Session->setFlash(__('Va parameter deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Va parameter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	*/
}