<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Organisations' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Organisation', array(
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
				<div class="col-md-12">
					<div class="input-group">
						<?php echo $this->Form->input( 'Organisation.search' ); ?>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary"><?php echo __( 'Search' ); ?></button>
							<?php echo $this->Html->link( __( 'Reset' ), array(
								'action' => 'index',
							), array( 'class' => 'btn btn-default' ) ); ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<?php if ( empty( $organisations ) ): ?>
			<table class="table table-condensed table-hover">
				<tbody>
				<tr>
					<td class="text-center">
						<span><?php echo __( 'No Organisations Found' ); ?></span>
					</td>
				</tr>
				</tbody>
			</table>
		<?php else: ?>
			<?php foreach ( $organisations as $organisation ): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php
							if ( empty( $organisation['Organisation']['code'] ) ) {
								echo $this->Html->link( $organisation['Organisation']['name'], array(
									'action' => 'edit',
									$organisation['Organisation']['id']
								) );
							} else {
								echo $this->Html->link( __( '%s (%s)', $organisation['Organisation']['name'], $organisation['Organisation']['code'] ), array(
									'action' => 'edit',
									$organisation['Organisation']['id']
								) );
							}
							?>
						</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<dl class="dl-horizontal">
									<dt><?php echo __( 'Address' ); ?></dt>
									<dd>
										<address>
											<?php if ( ! empty( $organisation['Organisation']['address_line_1'] ) ): ?>
												<?php echo h( $organisation['Organisation']['address_line_1'] ); ?><br/>
											<?php endif; ?>
											<?php if ( ! empty( $organisation['Organisation']['address_line_2'] ) ): ?>
												<?php echo h( $organisation['Organisation']['address_line_2'] ); ?><br/>
											<?php endif; ?>
											<?php if ( ! empty( $organisation['Organisation']['address_line_3'] ) ): ?>
												<?php echo h( $organisation['Organisation']['address_line_3'] ); ?><br/>
											<?php endif; ?>
											<?php if ( ! empty( $organisation['Organisation']['city'] ) ): ?>
												<?php echo h( $organisation['Organisation']['city'] ); ?><br/>
											<?php endif; ?>
											<?php if ( ! empty( $organisation['Organisation']['county'] ) ): ?>
												<?php echo h( $organisation['Organisation']['county'] ); ?><br/>
											<?php endif; ?>
											<?php echo $this->Html->link( $organisation['Country']['name'], array(
												'controller' => 'countries',
												'action'     => 'view',
												$organisation['Country']['id']
											) ); ?><br/>
											<?php echo h( $organisation['Organisation']['postcode'] ); ?>
										</address>
									</dd>
									<dt><?php echo __( 'Email' ); ?></dt>
									<dd>
										<?php echo $this->Text->autoLinkEmails( $organisation['Organisation']['email'] ); ?>
										&nbsp;
									</dd>
								</dl>
							</div>
							<div class="col-md-6">
								<h4><?php echo __( 'Manager(s)' ); ?></h4>
								<?php
								$organisationUsers = array();
								foreach ( $organisation['Centre'] as $centre ) {
									foreach ( $centre['CentreMembership'] as $centreMember ) {
										if ( ! empty( $centreMember['User'] ) ) {
											if ( ( (int) $centreMember['User']['role_id'] === Configure::read( 'Role.manager' )
											       || (int) $centreMember['User']['role_id'] === Configure::read( 'Role.administrator' )
											       || (int) $centreMember['User']['role_id'] === Configure::read( 'Role.super' ) )
											     && empty( $centreMember['expiry_date'] )
											) {
												$organisationUsers[] = $centreMember;
											}
										}
									}
								}
								?>
								<table class="table table-condensed table-hover">
									<tbody>
									<?php if ( empty( $organisationUsers ) ): ?>
										<tr>
											<td class="text-center">
												<span><?php echo __( 'No Users Found' ); ?></span>
											</td>
										</tr>
									<?php else: ?>
										<?php foreach ( $organisationUsers as $organisationUser ): ?>
											<tr>
												<td>
													<?php echo h( $organisationUser['User']['full_name'] ); ?>
												</td>
												<td>
													<?php echo h( $organisationUser['User']['username'] ); ?>
												</td>
												<td class="text-right">
													<?php echo $this->Html->link( __( 'View Details' ), array(
														'controller' => 'users',
														'action'     => 'view',
														$organisationUser['User']['id']
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
					<table class="table table-condensed table-hover">
						<thead>
						<tr>
							<th><?php echo __( 'Name' ); ?></th>
							<th><?php echo __( 'Code' ); ?></th>
							<th><?php echo __( '' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php if ( empty( $organisation['Centre'] ) ): ?>
							<tr>
								<td class="text-center" colspan="3">
									<span><?php echo __( 'No Centres Found' ); ?></span>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ( $organisation['Centre'] as $centre ): ?>
								<tr>
									<td>
										<?php echo h( $centre['name'] ); ?>
									</td>
									<td>
										<?php echo h( $centre['code'] ); ?>
									</td>
									<td class="text-right">
										<?php echo $this->Html->link( __( 'View Details' ), array(
											'controller' => 'centres',
											'action'     => 'view',
											$centre['id']
										) ); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Organisation' ) ), array( 'action' => 'add' ) ); ?></li>
			<?php if ( ! empty( $organisations ) ): ?>
				<li><?php echo $this->Html->link( __( 'New %s', __( 'Centre' ) ), array(
						'controller' => 'centres',
						'action'     => 'add'
					) ); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
