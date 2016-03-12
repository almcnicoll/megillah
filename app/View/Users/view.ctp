<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'User' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $user['User']['full_name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Username' ); ?></dt>
					<dd>
						<?php echo h( $user['User']['username'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Role' ); ?></dt>
					<dd>
						<?php
						$roles = array_flip( Configure::read( 'Role' ) );
						echo h( ucfirst( $roles[ $user['User']['role_id'] ] ) );
						?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Email' ); ?></dt>
					<dd>
						<?php echo $this->Text->autoLinkEmails( $user['User']['email'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $user['User']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $user['User']['created'] !== $user['User']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $user['User']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Recent %s', __( 'Loans' ) ); ?></h3>
				<table class="table table-condensed table-hover">
					<tbody>
					<?php if ( empty( $user['Loan'] ) ): ?>
						<tr>
							<td class="text-center">
								<span><?php echo __( 'No Recent Loans Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $user['Loan'] as $loan ): ?>
							<tr>
								<?php
									$span_end = '</span>';
									if (empty($loan['returned_date'])) {
										if (time() > strtotime($loan['due_date'])) {
											$span_start = "<span style='color: red;'>";
										} else {
											$span_start = "<span>";
										}
									} else {
										$span_start = "<span style='text-decoration: line-through;'>";
									}
								?>
								<td><?php echo $span_start . h( $loan['Copy']['Book']['title'] ) . $span_end; ?></td>
								<td><?php
									echo $span_start . date('jS M Y', strtotime( $loan['due_date'] )) . $span_end;
								?></td>
								<td class="text-right">
									<?php echo $this->Html->link( __( 'View' ), array(
										'controller' => 'loans',
										'action'     => 'view',
										$loan['id']
									) ); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Change Password' ), array(
					'action' => 'change_password',
					$user['User']['id']
				) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Change Theme' ), array(
					'action' => 'change_theme',
					$user['User']['id']
				) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'User' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'User' ) ), array(
					'action' => 'edit',
					$user['User']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'User' ) ), array(
					'action' => 'delete',
					$user['User']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this adviser?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Users' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
