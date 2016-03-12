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
<div class="row">
  <div class="col-xs-12">
    <div class="page-header">
			<h1><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-push-2">
    <div class="row">
      <div class="col-lg-6">
				<dl class="dl-horizontal">
<?php
  if (App::import('Model', $plugin . '.' . $modelClass) || App::import('Model', $modelClass)) {
    $relationModel = new $modelClass;
  }
  $skipFields = array('id', 'password', 'slug', 'lft', 'rght', 'archived', 'is_archived', 'archived_date', 'created_by', 'modified_by', 'approved_by', 'deleted_by');
  if (isset($relationModel) && property_exists($relationModel, 'scaffoldSkipFields')) {
    $skipFields = array_merge($skipFields, (array)$relationModel->scaffoldSkipFields);
  }

  foreach ($fields as $field) {
    // Prevents id fields to be displayed (not needed!)
    if (in_array($field, $skipFields) || (!empty($schema[$field]['key']) && $schema[$field]['key'] === 'primary') || ($field === 'sort' && $upDown)) {
      continue;
    }

    $isKey = false;
    if (!empty($associations['belongsTo'])) {
      foreach ($associations['belongsTo'] as $alias => $details) {
        if ($field === $details['foreignKey']) {
          $isKey = true;
          echo "\t\t\t\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
          echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";
          break;
        }
      }
    }
    if ($isKey !== true) {
      if ($field === 'modified' && !empty($fieldCreated)) {
        echo "\t\t\t\t\t<?php if (\${$singularVar}['{$modelClass}']['created'] !== \${$singularVar}['{$modelClass}']['{$field}']): ?>\n";
      }

      echo "\t\t\t\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";

      if ($field === 'created' || $field === 'modified' || $schema[$field]['type'] === 'datetime') {
        // Localize date/time output
        if ($field === 'created') {
          $fieldCreated = true;
        }

        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo ";
        echo "\$this->Time->format(\${$singularVar}['{$modelClass}']['{$field}'], '%A, %d %B %Y, %H:%M')";
        echo "; ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";

        if ($field === 'modified' && !empty($fieldCreated)) {
          echo "\t\t\t\t\t<?php endif; ?>\n";
        }

      } elseif ($schema[$field]['type'] === 'date') {
        // Localize date only output
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo ";
        echo "\$this->Time->format(\${$singularVar}['{$modelClass}']['{$field}'], '%A, %d %B %Y, %H:%M')";
        echo "; ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";

      } elseif ($schema[$field]['type'] === 'text') {
        // Newlines in textareas
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo nl2br(h(\${$singularVar}['{$modelClass}']['{$field}'])); ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";

      } elseif ($schema[$field]['type'] === 'integer' && method_exists($modelClass, $enumMethod = lcfirst(Inflector::camelize(Inflector::pluralize($field))))) {
        // Handle Tools "enums"
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo " . Inflector::camelize($modelClass) . "::" . $enumMethod . "(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";

      } elseif ($schema[$field]['type'] === 'decimal' || $schema[$field]['type'] === 'float' && strpos($schema[$field]['length'], ',2') !== false) {
        // Money formatting
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo \$this->Number->format(\${$singularVar}['{$modelClass}']['{$field}'], array('places' => 2)); ?>\n\t\t\t\t\t</dd>\n";

      } elseif ($schema[$field]['type'] === 'float' && strpos($schema[$field]['length'], ',') !== false) {
        // Generic float value handling
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo \$this->Number->format(\${$singularVar}['{$modelClass}']['{$field}'], array('places' => 2)); ?>\n\t\t\t\t\t</dd>\n";

      } else {
        // Protection against js injection by using h() function)
        echo "\t\t\t\t\t<dd>\n\t\t\t\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t\t\t&nbsp;\n\t\t\t\t\t</dd>\n";
      }
    }
  }
?>
				</dl>
			</div>
		</div>
  </div>
  <div class="col-md-2 col-md-pull-10">
    <ul class="nav nav-pills nav-stacked">
<?php
	echo "\t\t\t<li><?php echo \$this->Html->link(__('New %s', __('{$singularHumanName}')), array('action' => 'add')); ?></li>\n";
	echo "\t\t\t<li><?php echo \$this->Html->link(__('Edit %s', __('{$singularHumanName}')), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?></li>\n";
	echo "\t\t\t<li><?php echo \$this->Form->postLink(__('Delete %s', __('{$singularHumanName}')), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'text-danger'), __('Are you sure you want to delete this " . strtolower($singularHumanName) . "?')); ?></li>\n";
	echo "\t\t\t<li><?php echo \$this->Html->link(__('List %s', __('{$pluralHumanName}')), array('action' => 'index')); ?></li>\n";
?>
    </ul>
  </div>
</div>
