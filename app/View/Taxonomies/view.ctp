<div class="taxonomies view">
<h2><?php echo __('Taxonomy'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Term'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['term']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Archived'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['is_archived']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archived Date'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['archived_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($taxonomy['Parent']['term'], array('controller' => 'taxonomies', 'action' => 'view', $taxonomy['Parent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($taxonomy['Taxonomy']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Taxonomy'), array('action' => 'edit', $taxonomy['Taxonomy']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Taxonomy'), array('action' => 'delete', $taxonomy['Taxonomy']['id']), array(), __('Are you sure you want to delete # %s?', $taxonomy['Taxonomy']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxonomy'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Taxonomies'); ?></h3>
	<?php if (!empty($taxonomy['Child'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Term'); ?></th>
		<th><?php echo __('Is Archived'); ?></th>
		<th><?php echo __('Archived Date'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxonomy['Child'] as $child): ?>
		<tr>
			<td><?php echo $child['id']; ?></td>
			<td><?php echo $child['term']; ?></td>
			<td><?php echo $child['is_archived']; ?></td>
			<td><?php echo $child['archived_date']; ?></td>
			<td><?php echo $child['parent_id']; ?></td>
			<td><?php echo $child['lft']; ?></td>
			<td><?php echo $child['rght']; ?></td>
			<td><?php echo $child['created']; ?></td>
			<td><?php echo $child['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxonomies', 'action' => 'view', $child['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxonomies', 'action' => 'edit', $child['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxonomies', 'action' => 'delete', $child['id']), array(), __('Are you sure you want to delete # %s?', $child['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Books'); ?></h3>
	<?php if (!empty($taxonomy['Book'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Subtitle'); ?></th>
		<th><?php echo __('Classification'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('ISBN'); ?></th>
		<th><?php echo __('Imprint Id'); ?></th>
		<th><?php echo __('Is Archived'); ?></th>
		<th><?php echo __('Archived Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Import Ref'); ?></th>
		<th><?php echo __('Additional Fields'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($taxonomy['Book'] as $book): ?>
		<tr>
			<td><?php echo $book['id']; ?></td>
			<td><?php echo $book['title']; ?></td>
			<td><?php echo $book['subtitle']; ?></td>
			<td><?php echo $book['classification']; ?></td>
			<td><?php echo $book['type']; ?></td>
			<td><?php echo $book['year']; ?></td>
			<td><?php echo $book['ISBN']; ?></td>
			<td><?php echo $book['imprint_id']; ?></td>
			<td><?php echo $book['is_archived']; ?></td>
			<td><?php echo $book['archived_date']; ?></td>
			<td><?php echo $book['created']; ?></td>
			<td><?php echo $book['modified']; ?></td>
			<td><?php echo $book['import_ref']; ?></td>
			<td><?php echo $book['additional_fields']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'books', 'action' => 'view', $book['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'books', 'action' => 'edit', $book['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'books', 'action' => 'delete', $book['id']), array(), __('Are you sure you want to delete # %s?', $book['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
