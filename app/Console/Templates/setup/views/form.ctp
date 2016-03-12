<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
	/** MOD for preventing addition of "Admin " **/
	$displayAction = Inflector::humanize($action);
	if (strpos($displayAction, 'Admin ') === 0) {
		$displayAction = ucfirst(trim(substr($displayAction, 6)));
	} else {
		$displayAction = ucfirst($action);
	}
?>
<div class="row">
  <div class="col-xs-12">
    <div class="page-header">
			<h1><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-push-2">
    <?php echo "<?php echo \$this->Form->create('{$modelClass}', array('class' => 'form-horizontal', 'inputDefaults' => array('class' => 'form-control', 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')), 'label' => false), 'role' => 'form')); ?>\n"; ?>
    <fieldset>
      <legend><?php echo "<?php echo __('" . $displayAction . "'); ?>"; ?></legend>
      <div class="row">
        <div class="col-lg-6">
<?php
  if (App::import('Model', $plugin . '.' . $modelClass) || App::import('Model', $modelClass)) {
    $relationModel = new $modelClass;
  }
  $skipFields = array('slug', 'lft', 'rght', 'created', 'modified', 'approved', 'deleted', 'archived', 'is_archived', 'archived_date', 'created_by', 'modified_by', 'approved_by', 'deleted_by');
  if (isset($relationModel) && property_exists($relationModel, 'scaffoldSkipFields')) {
    $skipFields = array_merge($skipFields, (array)$relationModel->scaffoldSkipFields);
  }
?>
<?php
  // display "empty" default value for belongsTo relations
  $relations = array();
  if (!empty($associations['belongsTo'])) {
    foreach ($associations['belongsTo'] as $rel) {
      $relations[] = $rel['foreignKey'];
    }
  }
  foreach ($fields as $field):
    $emptyValue = "__('')";
    if (!empty($schema[$field]['null'])) {
      $emptyValue = "__('')";
    }

    if ($field === $primaryKey):
      if (strpos($action, 'add') !== false) {
        continue;
      } else {
        echo "\t\t\t\t\t<?php echo \$this->Form->input('{$field}'); ?>\n";
      }

    elseif (in_array($field, $skipFields) || ($field === 'sort' && $upDown)):
      continue;

    elseif (in_array($schema[$field]['type'], array('date'))): // Currently unable to handle the 'datetime' type.
?>
          <?php echo "<?php if (\$this->Form->error('{$field}') !== null): ?>"; ?><div class="form-group has-error"><?php echo "<?php else: ?>"; ?><div class="form-group"><?php echo "<?php endif; ?>\n"; ?>
            <?php echo "<?php echo \$this->Form->label('{$field}', null, array('class' => 'col-sm-3 control-label')); ?>\n"; ?>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->day('{$field}', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->month('{$field}', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->year('{$field}', 2010, date('Y') + 1, array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
              </div>
            </div>
          </div>
<?php
    elseif (in_array($schema[$field]['type'], array('time'))):
?>
          <?php echo "<?php if (\$this->Form->error('{$field}') !== null): ?>"; ?><div class="form-group has-error"><?php echo "<?php else: ?>"; ?><div class="form-group"><?php echo "<?php endif; ?>\n"; ?>
            <?php echo "<?php echo \$this->Form->label('{$field}', null, array('class' => 'col-sm-3 control-label')); ?>\n"; ?>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->hour('{$field}', false, array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->minute('{$field}', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
                <div class="col-xs-4">
                  <?php echo "<?php echo \$this->Form->meridian('{$field}', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>\n"; ?>
                </div>
              </div>
            </div>
          </div>
<?php elseif ($schema[$field]['type'] === 'integer' && method_exists($modelClass, $enumMethod = lcfirst(Inflector::camelize(Inflector::pluralize($field))))): ?>
          <?php echo "<?php if (\$this->Form->error('{$field}') !== null): ?>"; ?><div class="form-group has-error"><?php echo "<?php else: ?>"; ?><div class="form-group"><?php echo "<?php endif; ?>\n"; ?>
            <?php echo "<?php echo \$this->Form->label('{$field}', null, array('class' => 'col-sm-3 control-label')); ?>\n"; ?>
            <div class="col-sm-9">
              <?php echo "<?php echo \$this->Form->input('{$field}', array('options' => " . Inflector::camelize($modelClass) . "::" . $enumMethod . "(), 'empty' => Configure::read('Select.defaultBefore') . $emptyValue . Configure::read('Select.defaultAfter'))); ?>\n"; ?>
            </div>
          </div>
<?php else: ?>
          <?php echo "<?php if (\$this->Form->error('{$field}') !== null): ?>"; ?><div class="form-group has-error"><?php echo "<?php else: ?>"; ?><div class="form-group"><?php echo "<?php endif; ?>\n"; ?>
            <?php echo "<?php echo \$this->Form->label('{$field}', null, array('class' => 'col-sm-3 control-label')); ?>\n"; ?>
            <div class="col-sm-9">
              <?php echo "<?php echo \$this->Form->input('{$field}'); ?>\n"; ?>
            </div>
          </div>
<?php
  endif;
  endforeach;
?>
          <br />
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
							<?php echo "<?php echo \$this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>\n"; ?>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
    <?php echo "<?php echo \$this->Form->end(); ?>\n"; ?>
  </div>
  <div class="col-md-2 col-md-pull-10">
    <ul class="nav nav-pills nav-stacked">
<?php if (strpos($action, 'add') === false): ?>
      <li><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array('class' => 'text-danger'), __('Are you sure you want to delete this " . strtolower($singularHumanName) . "?')); ?>"; ?></li>
<?php endif;?>
      <li><?php echo "<?php echo \$this->Html->link(__('List %s', __('{$pluralHumanName}')), array('action' => 'index')); ?>"; ?></li>
    </ul>
  </div>
</div>
