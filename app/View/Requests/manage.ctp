<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Help & Support' ); ?>&nbsp;
				<small><?php echo __( 'All Requests' ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Request', array(
			'inputDefaults' => array(
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'url'           => $this->params['pass']
		) ); ?>
		<div class="well well-sm">
			<div class="row">
				<div class="col-md-3">
					<?php echo $this->Form->input( 'Request.user_id',
						array( 'empty' => __( '- Select User -' ), 'required' => false ) ); ?>
				</div>
				<div class="col-md-3">
					<?php echo $this->Form->input( 'Request.type', array(
						'options'  => Request::types(),
						'empty'    => __( '- Select Type -' ),
						'required' => false
					) ); ?>
				</div>
				<div class="col-md-3">
					<?php echo $this->Form->input( 'Request.status', array(
						'options'  => Request::statuses(),
						'empty'    => __( '- Select Status -' ),
						'required' => false
					) ); ?>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<?php echo $this->Form->input( 'Request.search' ); ?>
						<span class="input-group-btn">
									<button type="submit" class="btn btn-primary"><?php echo __( 'Search' ); ?></button>
							<?php echo $this->Html->link( __( 'Reset' ), array(
								'action' => 'manage'
							), array( 'class' => 'btn btn-default' ) ); ?>
								</span>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'user_id' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'type' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'subject' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'status' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'created' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $requests ) ): ?>
				<tr>
					<td class="text-center" colspan="6">
						<span><?php echo __( 'No Requests Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $requests as $request ): ?>
					<tr>
						<td>
							<?php echo $this->Html->link( $request['User']['full_name'],
								array( 'controller' => 'users', 'action' => 'view', $request['User']['id'] ) ); ?>
						</td>
						<td>
							<?php echo Request::types( $request['Request']['type'] ); ?>
						</td>
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
			<li><?php echo $this->Html->link( __( 'List My Requests' ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
