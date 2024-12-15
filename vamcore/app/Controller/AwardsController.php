<?php
	App::uses('AppController', 'Controller');
	/**
	 * Awards Controller
	 *
	 * @property Award $Award
	 */
	class AwardsController extends AppController {

		/**
		 * index method
		 *
		 * @return void
		 */
		public function index() {
			$this->Award->recursive = 0;
			$this->set('awards', $this->paginate());
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
			if (!$this->Award->exists($id)) {
				throw new NotFoundException(__('Invalid award'));
			}

			$options = array('conditions' => array('Award.' . $this->Award->primaryKey => $id));
			$this->set('award', $this->Award->find('first', $options));
		}

		/**
		 * add method
		 *
		 * @return void
		 */
		public function add() {
			if ($this->request->is('post')) {
				$this->Award->create();
				if ($this->Award->save($this->request->data)) {
					$this->Session->setFlash(__('The award has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The award could not be saved. Please, try again.'));
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
			if (!$this->Award->exists($id)) {
				throw new NotFoundException(__('Invalid award'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Award->save($this->request->data)) {
					$this->Session->setFlash(__('The award has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The award could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Award.' . $this->Award->primaryKey => $id));
				$this->request->data = $this->Award->find('first', $options);
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
			$this->Award->id = $id;
			if (!$this->Award->exists()) {
				throw new NotFoundException(__('Invalid award'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Award->delete()) {
				$this->Session->setFlash(__('Award deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Award was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
