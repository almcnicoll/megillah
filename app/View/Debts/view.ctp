<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $debt['Client']['code'], $debt['Client']['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
								'controller' 		 => $this->params['controller'],
								'id'                 => $debt['Client']['id'],
                                'cfs_licence_number' => $debt['Client']['Centre']['cfs_licence_number'],
                                'centre_id'          => $debt['Client']['Centre']['id'],
                                'client_code'        => $debt['Client']['code']
			) ); ?>
		<br/>

		<div class="row">
			<div class="col-lg-6">
				<div class="alert alert-info">
					<?php echo __( '%s Debt', ( ! empty( $debt['Debt']['is_priority'] ) ? __( 'Priority' ) : __( 'Non-Priority' ) ) ); ?>
				</div>
				<?php
				if ( ! empty( $debt['Debt']['is_judgment'] ) ):
					?>
					<div class="alert alert-info">
						<?php echo __( 'Judgment' ); ?>
					</div>
				<?php
				endif;
				?>
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Creditor' ); ?></dt>
					<dd>
						<?php echo $this->Html->link( $debt['Creditor']['display'],
							array( 'controller' => 'creditors', 'action' => 'view', $debt['Creditor']['id'] ) ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Debt Category' ); ?></dt>
					<dd>
						<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
							<?php echo $this->Html->link( $debt['DebtCategory']['name'], array(
								'controller' => 'debt_categories',
								'action'     => 'view',
								$debt['DebtCategory']['id']
							) ); ?>
						<?php else: ?>
							<?php echo h( $debt['DebtCategory']['name'] ); ?>
						<?php endif; ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Amount' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $debt['Debt']['amount'],
							$debt['Client']['Country']['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $debt['Debt']['account_code'] ) ): ?>
						<dt><?php echo __( 'Account Number' ); ?></dt>
						<dd>
							<?php echo h( $debt['Debt']['account_code'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $debt['Debt']['reference'] ) ): ?>
						<dt><?php echo __( 'Reference' ); ?></dt>
						<dd>
							<?php echo h( $debt['Debt']['reference'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $debt['Debt']['offer'] ) || ! empty( $debt['Debt']['is_pro_rata'] ) ): ?>
						<dt><?php echo __( 'Offer' ); ?></dt>
						<dd>
							<?php
							if ( empty( $debt['Debt']['is_pro_rata'] ) ) {
								echo __( '%s %s', $this->Number->currency( $debt['Debt']['offer'],
									$debt['Client']['Country']['Currency']['code'] ),
									Debt::frequencies( $debt['Debt']['offer_frequency'] ) );
							} else {
								echo __( 'Pro Rata' );
							}
							?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( empty( $parents ) ): ?>
						<dt><?php echo __( 'Created' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $debt['Debt']['created'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php else: ?>
						<dt><?php echo __( 'Transferred' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $debt['Debt']['transfer_date'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( $debt['Debt']['created'] !== $debt['Debt']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $debt['Debt']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<?php if ( ! empty( $parents ) ): ?>
					<hr/>
					<h3><?php echo __( 'Previous %s', __( 'Creditors' ) ); ?></h3>
					<table class="table table-condensed table-hover">
						<thead>
						<tr>
							<th><?php echo __( 'Name' ); ?></th>
							<th><?php echo __( 'From' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ( $parents as $parent ): ?>
							<tr>
								<td>
									<?php echo h( $parent['Creditor']['display'] ); ?>
								</td>
								<td>
									<?php echo $this->Time->format( (empty($parent['Debt']['transfer_date'])?$parent['Debt']['created']:$parent['Debt']['transfer_date']),
										'%A, %d %B %Y, %H:%M' ); ?>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Notes' ); ?></h3>
				<?php if ( empty( $debt['DebtNote'] ) ): ?>
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
					<?php foreach ( $debt['DebtNote'] as $debtNote ): ?>
						<blockquote class="note-container">
							<p class="note-text" data-note-id="<?php echo h( $debtNote['id'] ); ?>"
							   data-note-date="<?php echo h( $debtNote['date'] ); ?>"><?php echo h( $debtNote['text'] ); ?></p>
							<footer><?php
								$modifyUser = '';
								if ( ! empty( $debtNote['CreatedBy'] ) ) {
									$modifyUser = __( ' by %s', $debtNote['CreatedBy']['full_name'] );
								}
								echo __( 'On %s%s%s',
									$this->Time->format( $debtNote['created'], '%A, %d %B %Y, %H:%M' ),
									$modifyUser,
									$this->Html->tag( 'span', __( ' - %s - %s',
										$this->Html->link( __( 'Edit' ), 'javascript:void(0)', array( 'class' => 'edit-note-link' ) ),
										$this->Form->postLink( __( 'Delete' ), array(
											'controller' => 'debt_notes',
											'action'     => 'delete',
											$debtNote['id']
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
			<li><?php echo $this->Html->link( __( 'Export %s', __( 'Notes' ) ),
					array(
						'action' => 'export_notes',
						'ext'    => 'pdf',
						$debt['Debt']['id']
					), array( 'target' => '_blank' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Debt' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-debt-modal' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Debt' ) ),
					array( 'action' => 'edit', $debt['Debt']['id'] ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Transfer %s', __( 'Debt' ) ), 'javascript:void(0)',
					array( 'id' => 'open-transfer-debt-modal' ) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Debt' ) ),
					array( 'action' => 'delete', $debt['Debt']['id'] ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this debt?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Debts' ) ),
					array( 'action' => 'manage', $debt['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php
				echo $this->element( 'clientsidenavigation', array(
										'id'                 => $debt['Client']['id'],
										'cfs_licence_number' => $debt['Client']['Centre']['cfs_licence_number'],
										'centre_id'          => $debt['Client']['Centre']['id'],
										'client_code'        => $debt['Client']['code'],
										)
									); ?>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_DEBT_NOTE, 'foreignID' => $debt['Debt']['id']) ); ?>

<div class="modal fade" id="add-debt-modal" tabindex="-1" role="dialog" aria-labelledby="add-debt-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="add-debt-modal-label"><?php echo __( 'New Debt' ); ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Html->link( __( 'Priority %s', __( 'Debt' ) ),
					array( 'action' => 'add', $debt['Client']['id'], 'priority' => true ),
					array( 'class' => 'btn btn-primary btn-block' ) ); ?>
				<br/>
				<?php echo $this->Html->link( __( 'Non-Priority %s', __( 'Debt' ) ),
					array( 'action' => 'add', $debt['Client']['id'], 'priority' => false ),
					array( 'class' => 'btn btn-primary btn-block' ) ); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="transfer-debt-modal" tabindex="-1" role="dialog" aria-labelledby="transfer-debt-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<?php echo $this->Form->create( 'Debt', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'action' => 'transfer', $debt['Debt']['id'] ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="transfer-debt-modal-label"><?php echo __( 'Transfer Debt' ); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<?php echo $this->Form->input( 'creditor_id', array( 'empty' => true ) ); ?>
					<div id="creditor-address" class="hide">
						<hr/>
						<div class="well well-sm"></div>
					</div>
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
$getCreditorURL = $this->Html->url( array( 'controller' => 'creditors', 'action' => 'details', 'ext' => 'json' ) );

$script = <<<EOT
	$('#open-add-debt-modal').on('click', function(event) {
		$('#add-debt-modal').modal();
	});

	$('#open-transfer-debt-modal').on('click', function(event) {
		$('#transfer-debt-modal').modal();
	});

	$('#DebtCreditorId').on('change', function(event) {
		var creditorID = $(this).val();
		if (creditorID) {
			$.ajax({
				async: true,
				data: { creditor_id: creditorID },
				type: 'POST',
				url: '{$getCreditorURL}'
			}).done(function(json) {
				if (json.content) {
					$('#creditor-address').removeClass('hide');
					var address = '';
					if (json.content.address_line_1) {
						address += json.content.address_line_1 + '<br/>';
					}
					if (json.content.address_line_2) {
						address += json.content.address_line_2 + '<br/>';
					}
					if (json.content.address_line_3) {
						address += json.content.address_line_3 + '<br/>';
					}
					if (json.content.city) {
						address += json.content.city + '<br/>';
					}
					if (json.content.county) {
						address += json.content.county + '<br/>';
					}
					if (json.content.postcode) {
						address += json.content.postcode + '<br/>';
					}
					$('#creditor-address > div.well').html(address);
				} else {
					alert('Error: No Content.');
				}
			});
		} else {
			$('#creditor-address').addClass('hide');
		}
	});
EOT;

$this->Js->buffer( $script );
?>
