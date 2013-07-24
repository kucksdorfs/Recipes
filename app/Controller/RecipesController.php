<?php
App::uses('AppController', 'Controller');
/**
 * Recipes Controller
 *
 * @property Recipe $Recipe
*/
class RecipesController extends AppController {

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Recipe->recursive = 0;
		$this->set('recipes', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
		$this->set('recipe', $this->Recipe->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Recipe->create();
			$recipe = $this->Recipe->save($this->request->data["Recipe"]);
			$ingredients = $this->request->data['Ingredient'];
			if (!is_null($ingredients)) {
				foreach ($ingredients as $ingredient) {
					$ingredient['recipe_id'] = $recipe['Recipe']['id'];
					$this->Recipe->Ingredient->create();
					$this->Recipe->Ingredient->save($ingredient);
				}
			}
			$directions = $this->request->data['Direction'];
			if (!is_null($directions))
			{
				foreach ($directions as $direction) {
					$direction['recipe_id'] = $recipe['Recipe']['id'];
					$this->Recipe->Direction->create();
					$this->Recipe->Direction->save($direction);
				}
			}
			if (!empty($recipe)) {
				$this->Session->setFlash(__('The recipe has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
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
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$recipe = $this->Recipe->save($this->request->data['Recipe']);
			if ($recipe) {
				$ingredients = $this->request->data['Ingredient'];
				if (!is_null($ingredients)) {
					foreach ($ingredients as $ingredient) {
						$ingredient['recipe_id'] = $recipe['Recipe']['id'];
						if (!array_key_exists('optional', $ingredient)) {
							$ingredient['optional'] = 0;
						}
						
						$test = $this->Recipe->Ingredient->save($ingredient);
					}
				}
				$directions = $this->request->data['Direction'];
				if (!is_null($directions)) {
					foreach ($directions as $direction) {
						$direction['recipe_id'] = $recipe['Recipe']['id'];
						if (strlen($direction['id']) == 0) {
							$this->Recipe->Direction->create();
						}
						$this->Recipe->Direction->save($direction);
					}
				}

				$this->Session->setFlash(__('The recipe has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
			$this->request->data = $this->Recipe->find('first', $options);
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
		$this->Recipe->id = $id;
		if (!$this->Recipe->exists()) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Recipe->delete()) {
			$this->Session->setFlash(__('Recipe deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Recipe was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
