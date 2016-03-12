<?php
/**
 * Controller bake template file
 *
 * Allows templating of Controllers generated from bake.
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

echo "<?php\n";
echo "App::uses('{$plugin}AppController', '{$pluginPath}Controller');\n\n";
?>
/**
 * <?php echo $controllerName; ?> Controller
 *
<?php
if (!$isScaffold) {
	$defaultModel = Inflector::singularize($controllerName);
	echo " * @property {$defaultModel} \${$defaultModel}\n";
	if (!empty($components)) {
		foreach ($components as $component) {
			echo " * @property {$component}Component \${$component}\n";
		}
	}
}
?>
 */
class <?php echo $controllerName; ?>Controller extends <?php echo $plugin; ?>AppController {

<?php if ($isScaffold): ?>
	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;
<?php else: ?>
<?php
if (count($helpers)):
	echo "\tpublic \$helpers = array(";
	for ($i = 0, $len = count($helpers); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($helpers[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($helpers[$i]) . "'";
		endif;
	endfor;
	echo ");\n";
endif;

// Remove paginator again for now.
if (in_array('Paginator', $components)) {
	$key = array_keys($components);
	$key = array_shift($key);
	unset($components[$key]);
	$comps = $components;
	$components = array();
	foreach ($comps as $comp) {
		$components[] = $comp;
	}
}

if (count($components)):
	echo "\tpublic \$components = array(";
	for ($i = 0, $len = count($components); $i < $len; $i++):
		if ($i != $len - 1):
			echo "'" . Inflector::camelize($components[$i]) . "', ";
		else:
			echo "'" . Inflector::camelize($components[$i]) . "'";
		endif;
	endfor;
	echo ");\n";
endif;


/** CORE-MOD 2008-12-01 **/
if (isset($orderBy) && count($orderBy) > 0) {
	echo "\tpublic \$paginate = array('order'=>array(";
	echo "\n\t";

	foreach ($orderBy as $order => $mode) {
		echo "\t";
		var_export($order);
		echo ' => ';
		var_export($mode);
		echo ",\n\t";
	}
	echo "));\n\n"; //'".$currentModelName.".modified'=>'DESC'

} else {
	echo "\tpublic \$paginate = array();\n\n";
}

echo "\tpublic function beforeFilter() {\n";
echo "\t\tparent::beforeFilter();\n";
echo "\t}\n\n";


echo trim($actions);

/** CORE-MOD END **/

endif; ?>

}
