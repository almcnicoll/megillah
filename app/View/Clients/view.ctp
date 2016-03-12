<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $client['Client']['id']
		) ); ?>
		<br/>

		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Code' ); ?></dt>
					<dd>
						<?php echo h( $client['Client']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $client['PrimaryPerson']['complete_name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Address' ); ?></dt>
					<dd>
						<address>
							<?php if ( ! empty( $client['Client']['address_line_1'] ) ): ?>
								<?php echo h( $client['Client']['address_line_1'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['address_line_2'] ) ): ?>
								<?php echo h( $client['Client']['address_line_2'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['address_line_3'] ) ): ?>
								<?php echo h( $client['Client']['address_line_3'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['city'] ) ): ?>
								<?php echo h( $client['Client']['city'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['county'] ) ): ?>
								<?php echo h( $client['Client']['county'] ); ?><br/>
							<?php endif; ?>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
								<?php echo $this->Html->link( $client['Country']['name'], array(
									'controller' => 'countries',
									'action'     => 'view',
									$client['Country']['id']
								) ); ?><br/>
							<?php endif; ?>
							<?php echo h( $client['Client']['postcode'] ); ?>
						</address>
					</dd>
					<dt><?php echo __( 'Date Of Birth' ); ?></dt>
					<dd>
						<?php echo __( '%s (%d)', $this->Time->format( $client['PrimaryPerson']['date_of_birth'], '%d %B %Y' ), $client['PrimaryPerson']['age'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'NI Number' ); ?></dt>
					<dd>
						<?php echo h( $client['PrimaryPerson']['national_insurance_number'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $client['PrimaryPerson']['phone'] ) ): ?>
						<dt><?php echo __( 'Phone' ); ?></dt>
						<dd>
							<?php echo h( $client['PrimaryPerson']['phone'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $client['PrimaryPerson']['mobile'] ) ): ?>
						<dt><?php echo __( 'Mobile' ); ?></dt>
						<dd>
							<?php echo h( $client['PrimaryPerson']['mobile'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $client['PrimaryPerson']['email'] ) ): ?>
						<dt><?php echo __( 'Email' ); ?></dt>
						<dd>
							<?php echo h( $client['PrimaryPerson']['email'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Number Of Cars' ); ?></dt>
					<dd>
						<?php echo h( $client['Client']['number_of_cars'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Centre' ); ?></dt>
					<dd>
						<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ): ?>
							<?php echo $this->Html->link( $client['Centre']['name'], array(
								'controller' => 'centres',
								'action'     => 'view',
								$client['Centre']['id']
							) ); ?>
						<?php else: ?>
							<?php echo h( $client['Centre']['name'] ); ?>
						<?php endif; ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Status' ); ?></dt>
					<dd>
						<?php echo Client::statuses( $client['Client']['status'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Case Opened' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $client['Client']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
				</dl>
				<hr/>
				<h3><?php echo __( 'Financial Status' ); ?></h3>
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Monthly Income' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $totalIncome,
							$client['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Monthly Expenditure' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $totalExpense,
							$client['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Total Priority Debt' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $totalPriorityDebt,
							$client['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Total Non-Priority Debt' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $totalNonPriorityDebt,
							$client['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Total Debt' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $totalPriorityDebt + $totalNonPriorityDebt,
							$client['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
				</dl>
				<hr/>
				<h3><?php echo __( 'Checklist' ); ?></h3>
				<?php echo $this->Form->create( 'ClientResponse', array(
					'inputDefaults' => array(
						'div'   => false,
						'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
						'label' => false
					),
					'role'          => 'form',
					'url'           => array(
						'controller' => 'client_responses',
						'action'     => 'update',
						$client['Client']['id']
					)
				) ); ?>
				<table class="table table-condensed table-hover">
					<tbody>
					<?php foreach ( $questions as $key => $question ): ?>
						<tr>
							<td class="text-center">
								<?php if ( ! empty( $question['ClientResponse']['id'] ) ): ?>
									<?php echo $this->Form->hidden( __( 'ClientResponse.%d.id', $key ),
										array( 'value' => $question['ClientResponse']['id'] ) ); ?>
								<?php endif; ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.question_id', $key ),
									array( 'value' => $question['Question']['id'] ) ); ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.client_id', $key ),
									array( 'value' => $client['Client']['id'] ) ); ?>
								<?php echo $this->Form->checkbox( __( 'ClientResponse.%d.value', $key ),
									array(
										'class'   => 'letter-checkbox',
										'checked' => ! empty( $question['ClientResponse']['value'] ),
									) ); ?>
							</td>
							<td><?php echo $question['Question']['text']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<button type="submit"
				        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Save' ); ?></button>
				<button type="submit" class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Save' ); ?></button>
				<?php echo $this->Form->end(); ?>
				<hr/>
				<h3><?php echo __( 'Adviser(s)' ); ?></h3>
				<table class="table table-condensed table-hover">
					<tbody>
					<?php if ( empty( $client['ClientCounsellor'] ) ): ?>
						<tr>
							<td class="text-center" colspan="2">
								<span><?php echo __( 'No Advisers Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $client['ClientCounsellor'] as $counsellor ): ?>
							<tr>
								<td>
									<?php echo h( $counsellor['User']['full_name'] ); ?>
								</td>
								<td class="text-right">
									<div class="dropdown">
										<a data-toggle="dropdown"
										   href="javascript:void(0)"><?php echo __( 'Actions' ); ?>
											&nbsp;<span class="caret"></span></a>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><?php echo $this->Html->link( __( 'View Details' ), array(
													'controller' => 'users',
													'action'     => 'view',
													$counsellor['User']['id']
												), array( 'role' => 'menuitem' ) ); ?></li>
											<li><?php echo $this->Form->postLink( __( 'Remove' ),
													array(
														'controller' => 'client_counsellors',
														'action'     => 'delete',
														$counsellor['id']
													), null,
													__( 'Are you sure you want to remove this adviser from the client?' ) ); ?></li>
										</ul>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Notes' ); ?></h3>
				<?php if ( empty( $client['ClientNote'] ) ): ?>
					<table class="table table-condensed table-hover">
						<tbody>
						<tr>
							<td class="text-center">
								<span><?php echo __( 'No Notes Found' ); ?></span>
							</td>
						</tr>
						</tbody>
					</table>
				<?php else: ?>
					<?php foreach ( $client['ClientNote'] as $clientNote ): ?>
						<blockquote class="note-container">
							<p class="note-text" data-note-id="<?php echo h( $clientNote['id'] ); ?>"
							   data-note-date="<?php echo h( $clientNote['date'] ); ?>"><?php echo h( $clientNote['text'] ); ?></p>
							<footer><?php
								$modifyUser = '';
								if ( ! empty( $clientNote['CreatedBy'] ) ) {
									$modifyUser = __( ' by %s', $clientNote['CreatedBy']['full_name'] );
								}
								echo __( 'On %s%s%s',
									$this->Time->format( $clientNote['created'], '%A, %d %B %Y, %H:%M' ),
									$modifyUser,
									$this->Html->tag( 'span', __( ' - %s - %s',
										$this->Html->link( __( 'Edit' ), 'javascript:void(0)', array( 'class' => 'edit-note-link' ) ),
										$this->Form->postLink( __( 'Delete' ), array(
											'controller' => 'client_notes',
											'action'     => 'delete',
											$clientNote['id']
										), array( 'class' => 'text-danger' ),
											__( 'Are you sure you want to delete this note?' ) ) ), array(
										'class' => 'hide note-controls',
									) ) );
								?></footer>
						</blockquote>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Note' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-note-modal' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Add %s', __( 'Adviser' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-adviser-modal' ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
                                'cfs_licence_number' => $client['Centre']['cfs_licence_number'],
                                'centre_id'          => $client['Centre']['id'],
                                'client_code'        => $client['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_CLIENT_NOTE, 'foreignID' => $client['Client']['id']) ); ?>

<div class="modal fade" id="add-adviser-modal" tabindex="-1" role="dialog" aria-labelledby="add-adviser-modal-label"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo $this->Form->create( 'ClientCounsellor', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array(
					'controller' => 'client_counsellors',
					'action'     => 'add',
					$client['Client']['id']
				),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="add-adviser-modal-label"><?php echo __( 'New Adviser' ); ?></h4>
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
	$('#open-add-adviser-modal').on('click', function(event) {
		$('#add-adviser-modal').modal();
	});
EOT;

$this->Js->buffer( $script );
?>
