<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Audit Trail' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'description', __( 'Action' ) ); ?></th>
				<th><?php echo $this->Paginator->sort( 'created', __( 'Date' ) ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $logs ) ): ?>
				<tr>
					<td class="text-center" colspan="3">
						<span><?php echo __( 'No Actions Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php
				foreach ( $logs as $log ):
					$actionClass = 'info';
					switch ( $log['Log']['action'] ) {
						case 'add':
							$actionClass = 'success';
							break;
						case 'edit':
							$actionClass = 'info';
							break;
						case 'archive':
							$actionClass = 'warning';
							break;
						case 'delete':
							$actionClass = 'danger';
							break;
					}
					?>
					<tr class="<?php echo h( $actionClass ); ?>">
						<td>
							<?php echo h( $log['Log']['description'] ); ?>
						</td>
						<td>
							<?php echo __( '%s', date( 'l, jS F, Y H:i', strtotime( $log['Log']['created'] ) ) ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$log['Log']['id']
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
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Advisers' ) ), array(
					'controller' => 'users',
					'action'     => 'index'
				) ); ?></li>
		</ul>
	</div>
</div>
