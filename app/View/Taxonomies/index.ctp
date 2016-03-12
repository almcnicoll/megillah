<div class="taxonomies index">
	<h2><?php echo __('Taxonomies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('term'); ?></th>
			<th><?php echo $this->Paginator->sort('is_archived'); ?></th>
			<th><?php echo $this->Paginator->sort('archived_date'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($taxonomies as $taxonomy): ?>
	<tr>
		<td><?php echo h($taxonomy['Taxonomy']['id']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['term']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['is_archived']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['archived_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($taxonomy['Parent']['term'], array('controller' => 'taxonomies', 'action' => 'view', $taxonomy['Parent']['id'])); ?>
		</td>
		<td><?php echo h($taxonomy['Taxonomy']['lft']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['rght']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['created']); ?>&nbsp;</td>
		<td><?php echo h($taxonomy['Taxonomy']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $taxonomy['Taxonomy']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $taxonomy['Taxonomy']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $taxonomy['Taxonomy']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $taxonomy['Taxonomy']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Taxonomy'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
	</ul>
</div>
