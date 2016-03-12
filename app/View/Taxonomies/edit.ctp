<div class="taxonomies form">
<?php echo $this->Form->create('Taxonomy'); ?>
	<fieldset>
		<legend><?php echo __('Edit Taxonomy'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('term');
		echo $this->Form->input('is_archived');
		echo $this->Form->input('archived_date');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('Book');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Taxonomy.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Taxonomy.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
	</ul>
</div>
