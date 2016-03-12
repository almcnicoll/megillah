<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Centre(s)' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Centre', array(
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
						<?php echo $this->Form->input( 'Centre.search' ); ?>
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
		<?php if ( empty( $centres ) ): ?>
			<table class="table table-condensed table-hover">
				<tbody>
				<tr>
					<td class="text-center">
						<span><?php echo __( 'No Centres Found' ); ?></span>
					</td>
				</tr>
				</tbody>
			</table>
		<?php else: ?>
			<?php foreach ( $centres as $centre ): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?php
							if ( empty( $centre['Centre']['code'] ) ) {
								echo $this->Html->link( $centre['Centre']['name'], array(
									'action' => 'view',
									$centre['Centre']['id'],
								),
								array(
									'class' => 'emphasise-link',
								)
								);
							} else {
								echo $this->Html->link( __( '%s (%s)', $centre['Centre']['name'], $centre['Centre']['code'] ), array(
									'action' => 'view',
									$centre['Centre']['id']
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
											<?php endif; ?>
											<?php echo h( $centre['Centre']['postcode'] ); ?>
										</address>
									</dd>
									<dt><?php echo __( 'Email' ); ?></dt>
									<dd>
										<?php echo $this->Text->autoLinkEmails( $centre['Centre']['email'] ); ?>
										&nbsp;
									</dd>
								</dl>
							</div>
							<div class="col-md-6">
								<h4><?php echo __( 'Manager(s)' ); ?></h4>
								<?php
								$centreUsers = array();
								foreach ( $centre['CentreMembership'] as $centreMember ) {
									if ( ! empty( $centreMember['User'] ) ) {
										if ( ( (int) $centreMember['User']['role_id'] === Configure::read( 'Role.supervisor' )
										       || (int) $centreMember['User']['role_id'] === Configure::read( 'Role.manager' )
										       || (int) $centreMember['User']['role_id'] === Configure::read( 'Role.administrator' )
										       || (int) $centreMember['User']['role_id'] === Configure::read( 'Role.super' ) )
										     && empty( $centreMember['expiry_date'] )
										) {
											$centreUsers[] = $centreMember;
										}
									}
								}
								?>
								<table class="table table-condensed table-hover">
									<tbody>
									<?php if ( empty( $centreUsers ) ): ?>
										<tr>
											<td class="text-center">
												<span><?php echo __( 'No Users Found' ); ?></span>
											</td>
										</tr>
									<?php else: ?>
										<?php foreach ( $centreUsers as $centreUser ): ?>
											<tr>
												<td>
													<?php echo h( $centreUser['User']['full_name'] ); ?>
												</td>
												<td>
													<?php echo h( $centreUser['User']['username'] ); ?>
												</td>
												<td class="text-right">
													<?php echo $this->Html->link( __( 'View Details' ), array(
														'controller' => 'users',
														'action'     => 'view',
														$centreUser['User']['id']
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
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Centre' ) ), array(
					'controller' => 'centres',
					'action'     => 'add'
				) ); ?></li>
		</ul>
	</div>
</div>
