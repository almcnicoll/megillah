<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $client['Client']['code'], $client['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
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
		<?php echo $this->Form->create( 'Debt', array(
			'inputDefaults' => array(
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'url'           => $this->params['pass']
		) ); ?>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="well well-sm">
					<div class="row">
						<div class="col-md-4">
							<?php echo $this->Form->input( 'Debt.creditor_id',
								array( 'empty' => __( '- Select Creditor -' ), 'required' => false ) ); ?>
						</div>
						<div class="col-md-4">
							<?php echo $this->Form->input( 'Debt.debt_category_id',
								array( 'empty' => __( '- Select Debt Category -' ), 'required' => false ) ); ?>
						</div>
						<div class="col-md-4">
							<div class="btn-group btn-group-justified">
								<div class="btn-group">
									<button type="submit" class="btn btn-primary"><?php echo __( 'Filter' ); ?></button>
								</div>
								<div class="btn-group">
									<?php echo $this->Html->link( __( 'Reset' ), array(
										'action' => 'manage',
										$client['Client']['id']
									), array( 'class' => 'btn btn-default' ) ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->Form->create( 'Letter', array(
			'inputDefaults' => array(
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'url'           => array(
				'controller' => 'letters',
				'action'     => 'creditor',
				$client['Client']['id']
			)
		) );
		?>
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="text-center"><input type="checkbox" id="check-all-debts" autocomplete="off"></th>
				<th><?php echo __( 'Creditor' ); ?></th>
				<th><?php echo __( 'Reference' ); ?></th>
				<th><?php echo __( 'Amount' ); ?></th>
				<th><?php echo __( 'Debt Category' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $debts ) ): ?>
				<tr>
					<td class="text-center" colspan="6">
						<span><?php echo __( 'No Debts Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php
				foreach ( $debts as $key => $debt ):
					$actionClass = 'info';
					if ( ! empty( $debt['Debt']['is_priority'] ) ) {
						$actionClass = 'danger';
					} else {
						$actionClass = 'warning';
					}
					?>
					<tr class="<?php echo h( $actionClass ); ?>">
						<td class="text-center">
							<?php echo $this->Form->checkbox( 'Debt.' . $key . '.id',
								array(
									'class'        => 'letter-checkbox',
									'value'        => $debt['Debt']['id'],
									'autocomplete' => 'off'
								) ); ?>
						</td>
						<td>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
								<?php echo $this->Html->link( $debt['Creditor']['display'], array(
									'controller' => 'creditors',
									'action'     => 'view',
									$debt['Creditor']['id']
								) ); ?>
							<?php else: ?>
								<?php echo h( $debt['Creditor']['display'] ); ?><br/>
							<?php endif; ?>
						</td>
						<td>
							<?php echo h( $debt['Debt']['reference'] ); ?>
						</td>
						<td>
							<?php echo $this->Number->currency( $debt['Debt']['amount'],
								$client['Country']['Currency']['code'] ); ?>
						</td>
						<td>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
								<?php echo $this->Html->link( $debt['DebtCategory']['name'], array(
									'controller' => 'debt_categories',
									'action'     => 'view',
									$debt['DebtCategory']['id']
								) ); ?>
							<?php else: ?>
								<?php echo h( $debt['DebtCategory']['name'] ); ?><br/>
							<?php endif; ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ),
								array( 'action' => 'view', $debt['Debt']['id'] ) ); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="well well-sm">
					<div class="row">
						<div class="col-lg-9 col-lg-push-3 col-md-8 col-md-push-4">
							<?php echo $this->Form->input( 'Client.id', array( 'value' => $client['Client']['id'] ) ); ?>
							<?php echo $this->Form->input( 'Letter.template_id' ); ?>
							<?php echo $this->Form->hidden( 'Letter.date', array('disabled' => true) ); ?>
						</div>
						<div class="col-lg-3 col-lg-pull-9 col-md-4 col-md-pull-8">
							<button id="add-letters-button"
							        class="btn btn-primary btn-block disabled"><?php echo __( 'Generate %s',
									__( 'Letters' ) ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Debt' ) ), 'javascript:void(0)',
					array( 'id' => 'open-debt-modal' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Export %s', __( 'Debts' ) ),
					array(
						'action' => 'export',
						'ext'    => 'pdf',
						$client['Client']['id']
					), array( 'target' => '_blank' ) ); ?></li>
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

<div class="modal fade" id="debt-modal" tabindex="-1" role="dialog" aria-labelledby="debt-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="debt-modal-label"><?php echo __( 'New Debt' ); ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Html->link( __( 'Priority %s', __( 'Debt' ) ),
					array( 'action' => 'add', $client['Client']['id'], 'priority' => true ),
					array( 'class' => 'btn btn-primary btn-block' ) ); ?>
				<br/>
				<?php echo $this->Html->link( __( 'Non-Priority %s', __( 'Debt' ) ),
					array( 'action' => 'add', $client['Client']['id'], 'priority' => false ),
					array( 'class' => 'btn btn-primary btn-block' ) ); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="letter-reminder-modal" tabindex="-1" role="dialog" aria-labelledby="letter-reminder-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="letter-reminder-modal-label"><?php echo __( 'Set Reminder?' ); ?></h4>
			</div>
			<div class="modal-body">
				<div class="btn-group btn-group-justified" role="group">
					<a id="open-add-reminder-container" href="javascript:void(0)" class="btn btn-primary"><?php echo __('Yes'); ?></a>
					<a id="no-reminder-submit" href="javascript:void(0)" class="btn btn-default"><?php echo __('No'); ?></a>
				</div>
				<br />
				<div id="add-reminder-container" class="form-group hide">
					<div class="input-group date">
						<?php echo $this->Form->input( 'date', array(
							'id'          => 'AddLetterDate',
							'type'        => 'text',
							'placeholder' => 'yyyy-mm-dd',
							'value'       => date( 'Y-m-d', strtotime( '+1 week' ) ),
							'disabled'    => true,
							'data-date-format'		=> 'yyyy-mm-dd',
						) ); ?>
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
					<br />
					<button id="set-letter-reminder" type="button" class="btn btn-primary btn-block"><?php echo __('OK'); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo $this->Html->script( 'bootstrap.datepicker', array( 'block' => 'script-two' ) );
$getTemplateURL = $this->Html->url( array( 'controller' => 'templates', 'action' => 'details', 'ext' => 'json' ) );

$script = <<<EOT
	$('.date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
		startView: 2,
		weekStart: 1,
		clearBtn: true
	});

	$('#open-debt-modal').on('click', function(event) {
		$('#debt-modal').modal();
	});

	$('#add-letters-button').on('click', function(event) {
		event.preventDefault();
		var templateID = $('#LetterTemplateId').val();
		if (templateID) {
			$.ajax({
				async: true,
				data: { template_id: templateID },
				method: 'POST',
				url: '{$getTemplateURL}'
			}).done(function(json) {
				if (json.content) {
					if (json.content.reminder_date) {
						$('#AddLetterDate').datepicker('setDate', new Date(json.content.reminder_date));
						$('#AddLetterDate').datepicker('setFormat', 'yyyy-mm-dd');
					}
				} else {
					alert('Error: No Content.');
				}
				$('#letter-reminder-modal').modal();
			});
		} else {
			alert('Invalid Template!');
		}
	});

	$('.letter-checkbox').on('change', function(event) {
		if ($('.letter-checkbox:checked').length !== 0) {
			$('#add-letters-button').removeClass('disabled');
		} else {
			$('#add-letters-button').addClass('disabled');
		}
	});

	$('#check-all-debts').on('change', function(event) {
		if ($(this).prop('checked')) {
			$('.letter-checkbox').prop('checked', true).change();
		} else {
			$('.letter-checkbox').prop('checked', false).change();
		}
	});

	$('#no-reminder-submit').on('click', function(event) {
		$('#LetterDate').prop('disabled', true);
		$('#LetterManageForm').submit();
	});

	$('#open-add-reminder-container').on('click', function(event) {
		$('#add-reminder-container').removeClass('hide');
		$('#AddLetterDate').prop('disabled', false);
	});

	$('#set-letter-reminder').on('click', function(event) {
		$('#LetterDate').prop('disabled', false).val($('#AddLetterDate').val());
		$('#letter-reminder-modal').modal('hide');
		$('#LetterManageForm').submit();
	});
EOT;

$this->Js->buffer( $script );
?>
