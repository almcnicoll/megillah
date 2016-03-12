<?php
/*echo "<pre>";
print_r($books);
die();*/
?>
<div class="row">
	<div class="col-xs-12">
		<h3><?php echo __('Book Listing'); ?></h3>
		<table class="table table-condensed table-hover">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('title'); ?></th>
					<th><?php echo $this->Paginator->sort('classification'); ?></th>
					<th><?php echo __('legacy_book_number'); ?></th>

					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($books as $book): ?>
			<?php for ($ci=0; $ci<count($book['Copy']); $ci++): ?>
			<tr>
				<td><?php echo h($book['Book']['id']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($book['Book']['title'], array('controller' => 'book', 'action' => 'view', $book['Book']['id'])); ?>&nbsp;</td>
				<td><?php echo h($book['Book']['classification']); ?>&nbsp;</td>
				<td><?php echo h($book['Copy'][$ci]['legacy_book_number']); ?>&nbsp;</td>
				<td class="actions">Book: 
					<?php echo $this->Html->link(__('View'), array('controller' => 'book', 'action' => 'view', $book['Copy'][$ci]['id'])); ?> |
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'book', 'action' => 'edit', $book['Book']['id'])); ?> |
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'book', 'action' => 'delete', $book['Book']['id']), null, __('Are you sure you want to delete # %s?', $book['Book']['id'])); ?>
					<br />Copy:
					<?php echo $this->Html->link(__('View'), array('controller' => 'copy', 'action' => 'view', $book['Copy'][$ci]['id'])); ?> |
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'copy', 'action' => 'edit', $book['Book']['id'])); ?> |
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'copy', 'action' => 'delete', $book['Book']['id']), null, __('Are you sure you want to delete # %s?', $book['Book']['id'])); ?>
				</td>
			</tr>
			<?php endfor; ?>
			<?php endforeach; ?>
		</table>
		<p>
		<?php echo $this->element( 'Tools.pagination' ); ?>
		</p>
	</div>
</div>