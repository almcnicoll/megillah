<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$<?php echo $pluralName ?> = $this->paginate();
		$this->set(compact('<?php echo $pluralName ?>'));
	}

	/**
	 * View method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function <?php echo $admin ?>view($id = null) {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		if (empty($id) || !($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.id' => $id))))) {
			$this->Common->flashMessage(__('You do not have permission to view this record, or it has been deleted.'), 'danger');
			return $this->Common->autoRedirect(array('action' => 'index'));
		}
		$this->set(compact('<?php echo $singularName; ?>'));
	}

<?php $compact = array(); ?>
	/**
	 * Add method
	 *
	 * @return void
	 */
	public function <?php echo $admin ?>add() {
		if ($this->Common->isPosted()) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
				$this->Common->flashMessage(__('The record was saved'), 'success');
				return $this->Common->postRedirect(array('action' => 'index'));
			}
			$this->Common->flashMessage(__('The form is incomplete or has errors. Please check the form again.'), 'danger');
<?php if (!empty($modelObj->scaffoldDefaultValues)): ?>
		} else {
<?php
	foreach ($modelObj->scaffoldDefaultValues as $field => $value) {
		echo "\t\t\t\$this->request->data['{$currentModelName}']['$field'] = $value;\n";
	}
?>
		}
<?php else: ?>
		}
<?php endif; ?>
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc) {
		foreach ($modelObj->{$assoc} as $associationName => $relation) {
			if (!empty($associationName)) {
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				App::uses($relation['className'], ($plugin ? $plugin . '.' : '') . 'Model');

				if (class_exists($relation['className'])) {
					$relationModel = new $relation['className'];
					if (!empty($relationModel->actsAs) && in_array('Tree', $relationModel->actsAs)) {
						if ($otherPluralName === 'parent'.Inflector::pluralize($currentModelName)) {
							$otherPluralName = 'parents';
						}
						echo "\t\t\${$otherPluralName} = array(0 => __('Root') + \$this->{$currentModelName}->{$otherModelName}->generateTreeList(null, null, null, '� ');\n";
					} else {
						echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					}
				} else {
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				}
				$compact[] = "'{$otherPluralName}'";
			}
		}
	}
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
	/**
	 * Edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function <?php echo $admin; ?>edit($id = null) {
		if (empty($id) || !($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.<?php echo $primaryKey; ?>' => $id))))) {
			$this->Common->flashMessage(__('You do not have permission to view this record, or it has been deleted.'), 'danger');
			return $this->Common->autoRedirect(array('action' => 'index'));
		}
		if ($this->Common->isPosted()) {
			if ($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->save($this->request->data)) {
				$this->Common->flashMessage(__('Record updated'), 'success');
				return $this->Common->postRedirect(array('action' => 'view', $<?php echo $singularName; ?>['<?php echo $currentModelName; ?>']['<?php echo $primaryKey; ?>']));
			}
			$this->Common->flashMessage(__('The form is incomplete or has errors. Please check the form again.'), 'danger');
		} else {
			$this->request->data = $<?php echo $singularName; ?>;
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)) {
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					App::uses($relation['className'], ($plugin ? $plugin . '.' : '') . 'Model');
					if (class_exists($relation['className'])) {
						$relationModel = new $relation['className'];
						if (!empty($relationModel->actsAs) && in_array('Tree', $relationModel->actsAs)) {
							if ($otherPluralName === 'parent'.Inflector::pluralize($currentModelName)) {
								$otherPluralName = 'parents';
							}
							echo "\t\t\${$otherPluralName} = array(0 => __('Root') + \$this->{$currentModelName}->{$otherModelName}->generateTreeList(null, null, null, '� ');\n";
						} else {
							echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
						}
					} else {
						echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					}
					$compact[] = "'{$otherPluralName}'";
				}
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

	/**
	 * Delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function <?php echo $admin; ?>delete($id = null) {
		$this->request->onlyAllow('post', 'delete');
		if (empty($id) || !($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.<?php echo $primaryKey; ?>' => $id), 'fields' => array('<?php echo $primaryKey; ?>'))))) {
			$this->Common->flashMessage(__('You do not have permission to view this record, or it has been deleted.'), 'danger');
			return $this->Common->autoRedirect(array('action' => 'index'));
		}
		if ($this-><?php echo $currentModelName; ?>->delete($id)) {
			$this->Common->flashMessage(__('Record deleted'), 'success');
			return $this->Common->postRedirect(array('action' => 'index'));
		}
		$this->Common->flashMessage(__('Record could not be deleted'), 'danger');
		return $this->Common->autoRedirect(array('action' => 'index'));
	}

<?php if (!empty($upAndDown)) { ?>
	/**
	 * Up method
	 *
	 * @param string $id
	 * @return void
	 */
	public function <?php echo $admin; ?>up($id = null) {
		if (empty($id) || !($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.<?php echo $primaryKey; ?>'=>$id), 'fields' => array('<?php echo $primaryKey; ?>'<?php echo ($displayField!=$primaryKey?', \''.$displayField.'\'':'')?>))))) {
			$this->Common->flashMessage(__('You do not have permission to view this record, or it has been deleted.'), 'danger');
			return $this->Common->autoRedirect(array('action' => 'index'));
		}
		$this-><?php echo $currentModelName; ?>->moveUp($id, 1);
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Down method
	 *
	 * @param string $id
	 * @return void
	 */
	public function <?php echo $admin; ?>down($id = null) {
		if (empty($id) || !($<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.<?php echo $primaryKey; ?>'=>$id), 'fields' => array('<?php echo $primaryKey; ?>'<?php echo ($displayField!=$primaryKey?', \''.$displayField.'\'':'')?>))))) {
			$this->Common->flashMessage(__('You do not have permission to view this record, or it has been deleted.'), 'danger');
			return $this->Common->autoRedirect(array('action' => 'index'));
		}
		$this-><?php echo $currentModelName; ?>->moveDown($id, 1);
		return $this->redirect(array('action' => 'index'));
	}
<?php }; ?>
