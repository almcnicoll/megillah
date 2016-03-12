<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Help & Support' ); ?>&nbsp;
				<small><?php echo __( 'My Requests' ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'subject' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'status' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'created' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $requests ) ): ?>
				<tr>
					<td class="text-center" colspan="4">
						<span><?php echo __( 'No Requests Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $requests as $request ): ?>
					<tr>
						<td>
							<?php echo h( $request['Request']['subject'] ); ?>
						</td>
						<td>
							<?php echo Request::statuses( $request['Request']['status'] ); ?>
						</td>
						<td>
							<?php echo $this->Time->format( $request['Request']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ),
								array( 'action' => 'view', $request['Request']['id'] ) ); ?>
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
			<li><?php echo $this->Html->link( __( 'Request Support' ),
					array( 'action' => 'add', 'type' => 2 ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Send Feedback' ), array( 'action' => 'add', 'type' => 1 ) ); ?></li>
			<li class="nav-divider"></li>
			<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) { ?>
				<li><?php echo $this->Html->link( __( 'List Requests for All Users' ), array( 'action' => 'manage' ) ); ?></li>
			<?php } ?>
		</ul>
	</div>
</div>
