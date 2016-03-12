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

		<div class="row">
			<div class="col-lg-12">
				<!-- Filter -->
				<?php echo $this->Form->create( 'Action', array(
					'inputDefaults' => array(
						'div'   => false,
						'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
						'label' => false,
					),
					//'type' 			=> 'get',
					'role'          => 'form'
				) ); ?>
				<div class="well well-sm">
					<div class="row">
						<div class="col-md-3">
							<?php echo $this->Form->input( 'DateRange',
								array( 'options' => Action::dateRanges(), 'default' => Action::RANGE_DEFAULT ) ); ?>
						</div>
						<div class="col-md-3">
							<?php echo $this->Form->input( 'Client.id',
								array( 'value' => $client['Client']['id'] ) ); ?>
							<?php echo $this->Form->input( 'Action.model',
								array( 'options' => Action::models(), 'empty' => __( '- Select Category -' ) ) ); ?>
						</div>
						<div class="col-md-3">
							<?php echo $this->Form->input( 'Action.debt_id',
								array( 'empty' => __( '- Select Debt -' ) ) ); ?>
						</div>
						<div class="col-md-3">
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
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<!-- Letter Generation -->
				<?php echo $this->Form->create( 'Letter', array(
					'inputDefaults' => array(
						'div'   => false,
						'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
						'label' => false
					),
					'role'          => 'form',
					'url'           => array(
						'controller' => 'letters',
						'action'     => 'client',
						$client['Client']['id']
					)
				) );
				?>
				<div class="well well-sm">
					<div class="row">
						<div class="col-lg-10 col-lg-push-2 col-md-9 col-md-push-3">
							<?php echo $this->Form->input( 'Client.id',
								array( 'value' => $client['Client']['id'] ) ); ?>
							<?php echo $this->Form->input( 'Letter.template_id' ); ?>
							<?php echo $this->Form->hidden( 'Letter.date', array('disabled' => true) ); ?>
						</div>
						<div class="col-lg-2 col-lg-pull-10 col-md-3 col-md-pull-9">
							<button id="add-letters-button"
							        class="btn btn-primary btn-block"><?php echo __( 'Generate %s',
									__( 'Letter' ) ); ?></button>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<!-- Progress Log Table -->
				<table class="table table-condensed table-hover">
					<thead>
					<tr>
						<th><?php //echo $this->Paginator->sort( 'CONCAT(title,text)', __('Action') ); ?></th>
						<th><?php //echo $this->Paginator->sort( 'created', __( 'Created Date' ) ); ?></th>
						<th><?php echo __( '' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if ( empty( $actions ) ): ?>
						<tr>
							<td class="text-center" colspan="4">
								<span><?php echo __( 'No Client Actions Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $actions as $action ): ?>
							<tr class="<?php echo( (int) $action['Action']['model'] === Action::MODEL_LETTER ? 'info' : '' ); ?>">
								<td>
									<span style="font-weight: bold;"><?php
										echo Action::models( $action['Action']['model'] );
										if ( ! empty( $action['Action']['title'] ) ):
											echo __( ' (%s)', $action['Action']['title'] );
										endif;
										?></span> <br/>
									<?php echo nl2br( $action['Action']['text'] ); ?>
								</td>
								<td class="text-center" style="width: 25%;">
									<?php echo $this->Time->format( $action['Action']['modified'],
										'%A, %d %B %Y, %H:%M' ); ?>
								</td>
								<td class="text-right" style="width: 10%;">
									<?php
									$linkController = 'clients';
									switch ( (int) $action['Action']['model'] ) {
										case 1:
											$linkController = 'assets';
											break;
										case 3:
											$linkController = 'debts';
											break;
										case 4:
											$linkController = 'people';
											break;
									}
									if ( (int) $action['Action']['model'] === 5 ) {
										echo $this->Html->link( __( 'View' ), array(
											'controller' => 'letters',
											'action'     => 'view',
											$action['Action']['foreign_id'],
											'ext'        => 'pdf'
										) );
									} else {
										echo $this->Html->link( __( 'View' ), array(
											'controller' => $linkController,
											'action'     => 'view',
											$action['Action']['foreign_id']
										) );
									}
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
				<?php echo $this->element( 'Tools.pagination' ); ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<?php
					echo $this->Form->create( 'Action', array(
						'action' => 'export/'.$client['Client']['id'].'.pdf',
						'id' => 'ActionExportForm',
						'target' => '_blank',
						'inputDefaults' => array(
							'div'   => false,
							'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
							'label' => false
						),
						'role'          => 'form'
					) );
					echo $this->Form->hidden( 'DateRange', array( /*'options' => Action::dateRanges(),*/ 'default' => Action::RANGE_DEFAULT ) );
					echo $this->Form->hidden( 'Client.id', array( 'value' => $client['Client']['id'] ) );
					echo $this->Form->hidden( 'Action.model', array( /*'options' => Action::models(),*/ 'empty' => __( '- Select Category -' ) ) );
					echo $this->Form->end();					
					echo $this->Html->link( __( 'Export %s', __( 'Progress Log' ) ), 'javascript:document.forms["ActionExportForm"].submit();', array(  ) );
					
				?>
			</li>
			<!-- <li><?php echo $this->Html->link( __( 'Export %s', __( 'Progress Log' ) ),
					array(
						'action' => 'export',
						'ext'    => 'pdf',
						$client['Client']['id']
					), array( 'target' => '_blank' ) ); ?></li> -->
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
				'cfs_licence_number' => $client['Centre']['cfs_licence_number'], 'centre_id' => $client['Centre']['id'], 'client_code' => $client['Client']['code']
			) ); ?>
		</ul>
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
							'id'          			=> 'AddLetterDate',
							'type'        			=> 'text',
							'placeholder' 			=> 'yyyy-mm-dd',
							'value'       			=> date( 'Y-m-d', strtotime( '+1 week' ) ),
							'disabled'    			=> true,
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
