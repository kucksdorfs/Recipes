<?php
App::uses('AppController', 'Controller');
/**
 * Directions Controller
 *
 * @property Direction $Direction
 */
class DirectionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Direction->recursive = 0;
		$this->set('directions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Direction->exists($id)) {
			throw new NotFoundException(__('Invalid direction'));
		}
		$options = array('conditions' => array('Direction.' . $this->Direction->primaryKey => $id));
		$this->set('direction', $this->Direction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Direction->create();
			if ($this->Direction->save($this->request->data)) {
				$this->Session->setFlash(__('The direction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The direction could not be saved. Please, try again.'));
			}
		}
		$recipes = $this->Direction->Recipe->find('list');
		$this->set(compact('recipes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Direction->exists($id)) {
			throw new NotFoundException(__('Invalid direction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Direction->save($this->request->data)) {
				$this->Session->setFlash(__('The direction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The direction could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Direction.' . $this->Direction->primaryKey => $id));
			$this->request->data = $this->Direction->find('first', $options);
		}
		$recipes = $this->Direction->Recipe->find('list');
		$this->set(compact('recipes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Direction->id = $id;
		if (!$this->Direction->exists()) {
			throw new NotFoundException(__('Invalid direction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Direction->delete()) {
			$this->Session->setFlash(__('Direction deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Direction was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
