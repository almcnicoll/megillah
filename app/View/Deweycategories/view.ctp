<div class="deweycategories view">
<h2><?php echo __('Deweycategory'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classification'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['classification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Search String'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['search_string']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Archived'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['is_archived']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archived Date'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['archived_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deweycategory['Parent']['classification'], array('controller' => 'deweycategories', 'action' => 'view', $deweycategory['Parent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($deweycategory['Deweycategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Deweycategory'), array('action' => 'edit', $deweycategory['Deweycategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Deweycategory'), array('action' => 'delete', $deweycategory['Deweycategory']['id']), array(), __('Are you sure you want to delete # %s?', $deweycategory['Deweycategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Deweycategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deweycategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deweycategories'), array('controller' => 'deweycategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent'), array('controller' => 'deweycategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxonomy'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Deweycategories'); ?></h3>
	<?php if (!empty($deweycategory['Child'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Classification'); ?></th>
		<th><?php echo __('Search String'); ?></th>
		<th><?php echo __('Is Archived'); ?></th>
		<th><?php echo __('Archived Date'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($deweycategory['Child'] as $child): ?>
		<tr>
			<td><?php echo $child['id']; ?></td>
			<td><?php echo $child['classification']; ?></td>
			<td><?php echo $child['search_string']; ?></td>
			<td><?php echo $child['is_archived']; ?></td>
			<td><?php echo $child['archived_date']; ?></td>
			<td><?php echo $child['parent_id']; ?></td>
			<td><?php echo $child['lft']; ?></td>
			<td><?php echo $child['rght']; ?></td>
			<td><?php echo $child['created']; ?></td>
			<td><?php echo $child['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'deweycategories', 'action' => 'view', $child['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'deweycategories', 'action' => 'edit', $child['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'deweycategories', 'action' => 'delete', $child['id']), array(), __('Are you sure you want to delete # %s?', $child['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child'), array('controller' => 'deweycategories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Books'); ?></h3>
	<?php if (!empty($deweycategory['Book'])): ?>
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
	<?php foreach ($deweycategory['Book'] as $book): ?>
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
<div class="related">
	<h3><?php echo __('Related Taxonomies'); ?></h3>
	<?php if (!empty($deweycategory['Taxonomy'])): ?>
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
	<?php foreach ($deweycategory['Taxonomy'] as $taxonomy): ?>
		<tr>
			<td><?php echo $taxonomy['id']; ?></td>
			<td><?php echo $taxonomy['term']; ?></td>
			<td><?php echo $taxonomy['is_archived']; ?></td>
			<td><?php echo $taxonomy['archived_date']; ?></td>
			<td><?php echo $taxonomy['parent_id']; ?></td>
			<td><?php echo $taxonomy['lft']; ?></td>
			<td><?php echo $taxonomy['rght']; ?></td>
			<td><?php echo $taxonomy['created']; ?></td>
			<td><?php echo $taxonomy['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'taxonomies', 'action' => 'view', $taxonomy['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'taxonomies', 'action' => 'edit', $taxonomy['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'taxonomies', 'action' => 'delete', $taxonomy['id']), array(), __('Are you sure you want to delete # %s?', $taxonomy['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Taxonomy'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
