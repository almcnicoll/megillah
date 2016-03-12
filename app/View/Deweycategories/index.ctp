<div class="deweycategories index">
	<h2><?php echo __('Deweycategories'); ?></h2>
	
	<?php
	function RecursiveCategories($obj,$array) {
		if (count($array)) {
			echo "\n<ul>\n";
			foreach ($array as $vals) {
						echo "<li id=\"".$vals['Deweycategory']['id']."\">"
							.$obj->Html->link(
								$vals['Deweycategory']['classification'].': '.$vals['Deweycategory']['description'],
								array('action' => 'view', $vals['Deweycategory']['id'])
							)
							;
						if (count($vals['children'])) {
								RecursiveCategories($obj, $vals['children']);
						}
						echo "</li>\n";
			}
			echo "</ul>\n";
		}
	}
	?>
	<?= RecursiveCategories($this, $deweycategories) ?>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Deweycategory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Deweycategories'), array('controller' => 'deweycategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent'), array('controller' => 'deweycategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxonomy'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
	</ul>
</div>
