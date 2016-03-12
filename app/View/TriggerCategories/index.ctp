<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Trigger Categories' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $triggerCategories ) ): ?>
				<tr>
					<td class="text-center" colspan="2">
						<span><?php echo __( 'No Trigger Categories Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $triggerCategories as $triggerCategory ): ?>
					<tr>
						<td>
							<?php echo h( $triggerCategory['TriggerCategory']['name'] ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$triggerCategory['TriggerCategory']['id']
							) ); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Trigger Category' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
