<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Centre' ); ?></h1>
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
						<?php echo h( $centre['Centre']['name'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $centre['Centre']['code'] ) ): ?>
						<dt><?php echo __( 'Code' ); ?></dt>
						<dd>
							<?php echo h( $centre['Centre']['code'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Address' ); ?></dt>
					<dd>
						<address>
							<?php if ( ! empty( $centre['Centre']['address_line_1'] ) ): ?>
								<?php echo h( $centre['Centre']['address_line_1'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $centre['Centre']['address_line_2'] ) ): ?>
								<?php echo h( $centre['Centre']['address_line_2'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $centre['Centre']['address_line_3'] ) ): ?>
								<?php echo h( $centre['Centre']['address_line_3'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $centre['Centre']['city'] ) ): ?>
								<?php echo h( $centre['Centre']['city'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $centre['Centre']['county'] ) ): ?>
								<?php echo h( $centre['Centre']['county'] ); ?><br/>
							<?php endif; ?>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
								<?php echo $this->Html->link( $centre['Country']['name'], array(
									'controller' => 'countries',
									'action'     => 'view',
									$centre['Country']['id']
								) ); ?><br/>
							<?php else: ?>
								<?php echo h( $centre['Country']['name'] ); ?><br/>
							<?php endif; ?>
							<?php echo h( $centre['Centre']['postcode'] ); ?>
						</address>
					</dd>
					<dt><?php echo __( 'Organisation' ); ?></dt>
					<dd>
						<?php if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) ): ?>
							<?php echo $this->Html->link( $centre['Organisation']['name'], array(
								'controller' => 'organisations',
								'action'     => 'edit',
								$centre['Organisation']['id']
							) ); ?>
						<?php else: ?>
							<?php echo h( $centre['Organisation']['name'] ); ?>
						<?php endif; ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Email' ); ?></dt>
					<dd>
						<?php echo $this->Text->autoLinkEmails( $centre['Centre']['email'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $centre['Centre']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $centre['Centre']['created'] !== $centre['Centre']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $centre['Centre']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<hr/>
				<h3><?php echo __( '%s', __( 'Advisers' ) ); ?></h3>
				<table class="table table-condensed table-hover">
					<thead>
					<tr>
						<th><?php echo __( 'Name' ); ?></th>
						<th><?php echo __( 'Username' ); ?></th>
						<th><?php echo __( 'Expiry Date' ); ?></th>
						<th><?php echo __( '' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if ( empty( $members ) ): ?>
						<tr>
							<td class="text-center" colspan="4">
								<span><?php echo __( 'No Advisers Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $members as $member ): ?>
							<tr class="<?php echo( ! empty( $member['CentreMembership']['expiry_date'] ) ? 'warning' : '' ); ?>">
								<td><?php echo h( $member['User']['full_name'] ); ?></td>
								<td><?php echo h( $member['User']['username'] ); ?></td>
								<td><?php echo $this->Time->format( $member['CentreMembership']['expiry_date'], '%A, %d %B %Y, %H:%M' ); ?></td>
								<td class="text-right">
									<div class="dropdown">
										<a data-toggle="dropdown"
										   href="javascript:void(0)"><?php echo __( 'Actions' ); ?>
											&nbsp;<span class="caret"></span></a>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><?php echo $this->Html->link( __( 'View Details' ), array(
													'controller' => 'users',
													'action'     => 'view',
													$member['User']['id']
												), array( 'role' => 'menuitem' ) ); ?></li>
											<?php if ( empty( $member['CentreMembership']['expiry_date'] ) ): ?>
												<li><?php echo $this->Form->postLink( __( 'Expire' ), array(
														'controller' => 'centre_memberships',
														'action'     => 'expire',
														$member['CentreMembership']['id']
													), array( 'role' => 'menuitem' ),
														__( 'Are you sure you want to expire this user\'s membership to this centre?' ) ); ?></li>
											<?php else: ?>
												<li><?php echo $this->Form->postLink( __( 'Renew' ), array(
														'controller' => 'centre_memberships',
														'action'     => 'renew',
														$member['CentreMembership']['id']
													), array( 'role' => 'menuitem' ),
														__( 'Are you sure you want to renew this user\'s membership to this centre?' ) ); ?></li>
											<?php endif; ?>
											<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ): ?>
												<li><?php echo $this->Form->postLink( __( 'Remove' ), array(
														'controller' => 'centre_memberships',
														'action'     => 'delete',
														$member['CentreMembership']['id']
													), array( 'role' => 'menuitem' ),
														__( 'Are you sure you want to remove this user from this centre?' ) ); ?></li>
											<?php endif; ?>
										</ul>
									</div>
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
			<li><?php echo $this->Html->link( __( 'Add %s', __( 'Adviser' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-member-modal' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Centre' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Centre' ) ),
					array( 'action' => 'edit', $centre['Centre']['id'] ) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Centre' ) ),
					array( 'action' => 'delete', $centre['Centre']['id'] ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this centre?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Centres' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<div class="modal fade" id="add-member-modal" tabindex="-1" role="dialog" aria-labelledby="add-member-modal-label"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo $this->Form->create( 'CentreMembership', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array(
					'controller' => 'centre_memberships',
					'action'     => 'add',
					$centre['Centre']['id']
				),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="add-member-modal-label"><?php echo __( 'Add Adviser' ); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<?php echo $this->Form->input( 'user_id' ); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
				<button type="submit" class="btn btn-primary"><?php echo __( 'Save' ); ?></button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<?php
$script = <<<EOT
	$('#open-add-member-modal').on('click', function(event) {
		$('#add-member-modal').modal();
	});
EOT;

$this->Js->buffer( $script );
?>
