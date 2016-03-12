<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Action' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php
		$action = null;
		switch ( $log['Log']['action'] ) {
			case 'add':
				$action = 'added';
				break;
			case 'edit':
				$action = 'edited';
				break;
			case 'delete':
				$action = 'deleted';
				break;
			case 'archive':
				$action = 'archived';
				break;
		}
		$changes = unserialize( $log['Log']['change'] );
		?>
		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Description' ); ?></dt>
					<dd>
						<?php
						$modelLink = $this->Html->link( $log['Log']['model'], array(
							'controller' => Inflector::tableize( $log['Log']['model'] ),
							'action'     => 'view',
							$log['Log']['foreign_id']
						) );
						$userLink  = 'System';
						if ( ! empty( $log['Log']['user_id'] ) ) {
							$userLink = $this->Html->link( $log['User']['full_name'], array(
								'controller' => 'users',
								'action'     => 'view',
								$log['User']['id']
							) );
						}
						echo __( '%s %s by %s', $modelLink, $action, $userLink );
						?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Date' ); ?></dt>
					<dd>
						<?php echo __( '%s', date( 'l, jS F, Y H:i', strtotime( $log['Log']['created'] ) ) ); ?>
						&nbsp;
					</dd>
				</dl>
				<?php if ( $log['Log']['action'] === 'edit' ): ?>
					<hr/>
					<h3><?php echo __( 'Changes' ); ?></h3>
					<table class="table table-condensed table-hover">
						<thead>
						<tr>
							<th><?php echo __( 'Field' ); ?></th>
							<th><?php echo __( 'Old Value' ); ?></th>
							<th><?php echo __( 'New Value' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php if ( empty( $changes ) ): ?>
							<tr>
								<td class="text-center" colspan="3">
									<span><?php echo __( 'No Changes Found' ); ?></span>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ( $changes as $key => $change ): ?>
								<tr>
									<td>
										<?php echo h( $key ); ?>
									</td>
									<td>
										<?php echo h( $change['old'] ); ?>
									</td>
									<td>
										<?php echo h( $change['value'] ); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Logs' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
