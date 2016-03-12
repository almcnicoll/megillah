<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Request' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Subject' ); ?></dt>
					<dd>
						<?php echo h( $request['Request']['subject'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Message' ); ?></dt>
					<dd>
						<?php echo nl2br( h( $request['Request']['text'] ) ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Status' ); ?></dt>
					<dd>
						<?php echo Request::statuses( $request['Request']['status'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Type' ); ?></dt>
					<dd>
						<?php echo Request::types( $request['Request']['type'] ); ?>
						&nbsp;
					</dd>
					<?php if ( $request['Request']['user_id'] !== Auth::id() || ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ): ?>
						<dt><?php echo __( 'User' ); ?></dt>
						<dd>
							<?php echo $this->Html->link( $request['User']['full_name'],
								array( 'controller' => 'users', 'action' => 'view', $request['User']['id'] ) ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $request['Request']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $request['Request']['created'] !== $request['Request']['modified'] ): ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $request['Request']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
				</dl>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ): ?>
				<?php if ( (int) $request['Request']['status'] === Request::STATUS_OPEN ): ?>
					<li><?php echo $this->Form->postLink( __( 'Close %s', __( 'Request' ) ),
							array( 'action' => 'close', $request['Request']['id'] ), array( 'class' => 'text-danger' ),
							__( 'Are you sure you want to close this request?' ) ); ?></li>
				<?php else: ?>
					<li><?php echo $this->Form->postLink( __( 'Open %s', __( 'Request' ) ),
							array( 'action' => 'open', $request['Request']['id'] ), array( 'class' => 'text-danger' ),
							__( 'Are you sure you want to open this request?' ) ); ?></li>
				<?php endif; ?>
			<?php endif; ?>
			<li><?php echo $this->Html->link( __( 'List Support %s', __( 'Requests' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
