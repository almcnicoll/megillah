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
			<h1><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-push-2">
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
<?php
	if (App::import('Model', $plugin . '.' . $modelClass) || App::import('Model', $modelClass)) {
		$relationModel = new $modelClass;
	}
	$skipFields = array('id', 'password', 'slug', 'lft', 'rght', 'is_archived', 'archived_date', 'created', 'modified', 'created_by', 'modified_by', 'approved_by', 'deleted_by');
	if (isset($relationModel) && property_exists($relationModel, 'scaffoldSkipFields')) {
		$skipFields = array_merge($skipFields, (array)$relationModel->scaffoldSkipFields);
	}
?>
<?php
  foreach ($fields as $field):
	// Don't display primaryKeys
	if (in_array($field, $skipFields) || (!empty($schema[$field]['key']) && $schema[$field]['key'] === 'primary') || ($field === 'sort' && $upDown)) {
		continue;
	}
?>
          <th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php endforeach; ?>
          <th><?php echo "<?php echo __(''); ?>"; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php echo "<?php if (empty(\${$pluralVar})): ?>\n"; ?>
        <tr>
          <td class="text-center" colspan="<?php echo count(array_diff(array_unique(array_merge($fields, $skipFields)), $skipFields)) + 1; ?>">
            <span><?php echo "<?php echo __('No {$pluralHumanName} Found'); ?>"; ?></span>
          </td>
        </tr>
<?php
  echo "\t\t\t\t<?php else: ?>\n";
	echo "\t\t\t\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t\t\t\t<tr>\n";
	foreach ($fields as $field) {
		// Don't display primaryKeys
		if (in_array($field, $skipFields) || (!empty($schema[$field]['key']) && $schema[$field]['key'] === 'primary') || ($field === 'sort' && $upDown)) {
			continue;
		}

		$isKey = false;
		if (!empty($associations['belongsTo'])) {
			foreach ($associations['belongsTo'] as $alias => $details) {
				if ($field === $details['foreignKey']) {
					$isKey = true;
					echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t\t</td>\n";
					break;
				}
			}
		}
		if ($isKey !== true) {
			if ($field === 'created' || $field === 'modified' || $schema[$field]['type'] === 'datetime') {
				// Localize date/time output
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Time->format(\${$singularVar}['{$modelClass}']['{$field}'], '%A, %d %B %Y, %H:%M'); ?>\n\t\t\t\t\t</td>\n";

			} elseif ($schema[$field]['type'] === 'date') {
				// Localize date only output
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Time->format(\${$singularVar}['{$modelClass}']['{$field}'], '%A, %d %B %Y, %H:%M'); ?>\n\t\t\t\t\t</td>\n";

			} elseif ($schema[$field]['type'] === 'text') {
				// Newlines in textareas
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo nl2br(h(\${$singularVar}['{$modelClass}']['{$field}'])); ?>\n\t\t\t\t\t</td>\n";

			} elseif ($schema[$field]['type'] === 'integer' && method_exists($modelClass, $enumMethod = lcfirst(Inflector::camelize(Inflector::pluralize($field))))) {
				// Handle Tools "enums"
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo " . $modelClass . "::" . $enumMethod . "(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t\t</td>\n";

			} elseif ($schema[$field]['type'] === 'decimal' || $schema[$field]['type'] === 'float' && strpos($schema[$field]['length'], ',2') !== false) {
				// Money formatting
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Number->format(\${$singularVar}['{$modelClass}']['{$field}'], array('places' => 2)); ?>\n\t\t\t\t\t</td>\n";

			} elseif ($schema[$field]['type'] === 'float' && strpos($schema[$field]['length'], ',') !== false) {
				// Generic float value handling
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Number->format(\${$singularVar}['{$modelClass}']['{$field}'], array('places' => 2)); ?>\n\t\t\t\t\t</td>\n";

			} else {
				// Protection against js injection by using h() function)
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t\t</td>\n";
			}
		}
	}
	echo "\t\t\t\t\t<td class=\"text-right\">\n\t\t\t\t\t\t<?php echo \$this->Html->link(__('View Details'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n\t\t\t\t\t</td>\n";

	echo "\t\t\t\t</tr>\n";
	echo "\t\t\t\t<?php endforeach; ?>\n";
	echo "\t\t\t\t<?php endif; ?>\n";
?>
      </tbody>
    </table>
    <?php echo "<?php echo \$this->element('Tools.pagination'); ?>\n"; ?>
  </div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo "<?php echo \$this->Html->link(__('New %s', __('{$singularHumanName}')), array('action' => 'add')); ?>"; ?></li>
		</ul>
	</div>
</div>
