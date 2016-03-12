<?php
$modalType = 0;
$note = array();
switch ($type) {
	case Reminder::MODEL_ASSET_NOTE:
		$note['model'] = 'AssetNote';
		$note['controller'] = 'asset_notes';
		break;
	case Reminder::MODEL_CLIENT_NOTE:
		$note['model'] = 'ClientNote';
		$note['controller'] = 'client_notes';
		break;
	case Reminder::MODEL_CREDITOR_NOTE:
		$note['model'] = 'CreditorNote';
		$note['controller'] = 'creditor_notes';
		break;
	case Reminder::MODEL_DEBT_NOTE:
		$note['model'] = 'DebtNote';
		$note['controller'] = 'debt_notes';
		break;
	case Reminder::MODEL_PERSON_NOTE:
		$note['model'] = 'PersonNote';
		$note['controller'] = 'person_notes';
		break;
	case Reminder::MODEL_NOTE:
		$note['model'] = 'Note';
		$note['controller'] = 'notes';
		$modalType = 1;
		break;
	case Reminder::MODEL_LETTER:
		$note['model'] = 'Letter';
		$note['controller'] = 'reminders';
		$note['action'] = 'index';
		break;
}

if (empty($note)):
?>

<?php
else:
?>

<div class="modal fade" id="add-note-modal" tabindex="-1" role="dialog" aria-labelledby="add-note-modal-label"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo $this->Form->create( $note['model'], array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => $note['controller'], 'action' => 'add', $foreignID ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="add-note-modal-label"><?php echo __( 'New %s', (empty($modalType) ? __('Note') : __('Reminder')) ); ?></h4>
			</div>
			<div class="modal-body">
				<?php if (!empty($modalType)): ?>
				<div class="form-group">
					<div class='row'>
						<div class="col-xs-12">
							<div class="input-group">
								<div class="input-group-addon" style="text-align: left;">
									<label for='AddNoteLink'>Remind:</label>&nbsp;
									<?php
										$selectOptions = array();
										$selectOptions['Users'] = array(
											'user_id-'.Auth::id()	=>	'Only me',
										);
										foreach ($userCentres as $centre) {
											$selectOptions['Centres']['centre_id-'.$centre['Centre']['id']] = $centre['Centre']['name'];
										}
										echo $this->Form->select( 'AddNoteLink', $selectOptions, array(
											'id'           => 'AddNoteLink',
											'empty'        => false,
											'value'        => $selectOptions['Users']['user_id-'.Auth::id()],
											'selected'     => $selectOptions['Users']['user_id-'.Auth::id()],
											'legend'       => false,
										) );
									?>
									<!-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				endif;
				echo $this->Form->hidden( 'status', array( 'value' => 2 ) );
				echo $this->Form->hidden( 'type', array( 'value' => 1 ) );
				?>
				<div class="form-group">
					<?php echo $this->Form->input( 'text', array( 'id' => 'AddNoteText' ) ); ?>
				</div>
				<?php if (empty($modalType)): ?>
				<div class="checkbox">
					<label> <input type="checkbox" id="set-add-reminder">&nbsp;<?php echo __( 'Set Reminder?' ); ?>
					</label>
				</div>
				<div id="add-reminder-container" class="form-group hide">
					<div class="input-group date">
						<?php echo $this->Form->input( 'date', array(
							'id'          => 'AddNoteDate',
							'type'        => 'text',
							'placeholder' => 'yyyy-mm-dd',
							'value'       => date( 'Y-m-d', strtotime( 'today' ) ),
							'disabled'    => true
						) ); ?>
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
				</div>
				<?php else: ?>
				<div class="form-group">
					<div class='row'>
						<div class="col-xs-6">
							<div class="input-group date">
								<?php echo $this->Form->input( 'date', array(
									'id'          => 'AddNoteDate',
									'type'        => 'text',
									'placeholder' => 'yyyy-mm-dd',
									'value'       => date( 'Y-m-d', strtotime( 'today' ) ),
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="input-group time">
								<?php echo $this->Form->input( 'time', array(
									'id'          => 'AddNoteTime',
									'type'        => 'text',
									'placeholder' => 'HH:mm',
									'value'       => date( 'H:i', strtotime( 'now' ) ),
									'style'       => 'width: auto;',
									'interval'    => 5,
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="form-group">
					<div class='row'>
						<div class="col-xs-12">
							<div class="input-group">
								<div class="input-group-addon" style="text-align: left;">
									<?php
										$radioOptions = array(
											'1'	=>	'&nbsp;Standard priority',
											'2'	=>	'&nbsp;High priority',
										);
										echo $this->Form->radio( 'type', $radioOptions, array(
											'id'           => 'AddNoteType',
											'value'        => '1',
											'separator'    => '<br />',
											'legend'       => false,
										) );
									?>
									<!-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> -->
								</div>
							</div>
						</div>
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

<div class="modal fade" id="edit-note-modal" tabindex="-1" role="dialog" aria-labelledby="edit-note-modal-label"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo $this->Form->create( $note['model'], array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => $note['controller'], 'action' => 'edit', $foreignID ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="edit-note-modal-label"><?php echo __( 'Edit %s', (empty($modalType) ? __('Note') : __('Reminder')) ); ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Form->input( 'id', array( 'id' => 'NoteId', 'type' => 'text', 'class' => 'hide' ) ); ?>
				<div class="form-group">
					<?php echo $this->Form->input( 'text', array( 'id' => 'EditNoteText' ) ); ?>
				</div>
				<?php if (empty($modalType)): ?>
				<div class="checkbox">
					<label> <input type="checkbox" id="set-edit-reminder">&nbsp;<?php echo __( 'Set Reminder?' ); ?>
					</label>
				</div>
				<div id="edit-reminder-container" class="hide">
					<div class="input-group date">
						<?php echo $this->Form->input( 'date', array(
							'id'          => 'EditNoteDate',
							'type'        => 'text',
							'placeholder' => 'yyyy-mm-dd',
							'disabled'    => true
						) ); ?>
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
				</div>
				<?php else: ?>
				<div class="form-group">
					<div class='row'>
						<div class="col-xs-6">
							<div class="input-group date">
								<?php echo $this->Form->input( 'date', array(
									'id'          => 'EditNoteDate',
									'type'        => 'text',
									'placeholder' => 'yyyy-mm-dd',
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="input-group time">
								<?php echo $this->Form->input( 'time', array(
									'id'          => 'EditNoteTime',
									'type'        => 'text',
									'placeholder' => 'HH:mm',
									'value'       => date( 'H:i', strtotime( '+1 week' ) ),
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
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
echo $this->Html->script( 'bootstrap.datepicker', array( 'block' => 'script-two' ) );

$script = <<<EOT
	$('.date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
		startView: 2,
		weekStart: 1,
		clearBtn: true
	});

	$('#open-add-note-modal').on('click', function(event) {
		$('#add-note-modal').modal();
	});

	$('.note-text').on('click', function(event) {
		editNote($(this));
	});

	$('.edit-note-link').on('click', function(event) {
		editNote($(this).parents('footer').siblings('p.note-text'));
	});

	$('.edit-note-dropdown-link').on('click', function(event) {
		editNote($(this).parents('tr:first').children('td:first').children('p.reminder-text:first'));
	});

	function editNote(noteData) {
		$('#edit-note-modal').modal();
		$('#NoteId').val(noteData.data('note-id'));
		$('#EditNoteDate').val(noteData.data('note-date'));
		$('#EditNoteTime').val(noteData.data('note-time'));
		if (noteData.data('note-user_id')) {
			$('#EditNoteLink').val('user_id-'+noteData.data('note-user_id'));
		}
		if (noteData.data('note-centre_id')) {
			$('#EditNoteLink').val('centre_id-'+noteData.data('note-centre_id'));
		}
		if (noteData.data('note-date') !== '') {
			$('#set-edit-reminder').prop('checked', true).trigger('change');
			$('#EditNoteDate').prop('disabled', false);
			$('#EditNoteTime').prop('disabled', false);
		} else {
			$('#set-edit-reminder').prop('checked', false).trigger('change');
		}
		$('#EditNoteText').val(noteData.text());
	}

	$('.note-container').on({
		mouseenter: function(event) {
			$('.note-controls', this).removeClass('hide');
		},
		mouseleave: function(event) {
			$('.note-controls', this).addClass('hide');
		}
	});

	$('#set-add-reminder').change(function() {
		if ($('#set-add-reminder').is(':checked')) {
			$('#AddNoteDate').prop('disabled', false);
			$('#add-reminder-container').removeClass('hide');
		} else {
			$('#add-reminder-container').addClass('hide');
			$('#AddNoteDate').prop('disabled', true);
		}
	});

	$('#set-edit-reminder').change(function() {
		if ($('#set-edit-reminder').is(':checked')) {
			$('#EditNoteDate').prop('disabled', false);
			$('#edit-reminder-container').removeClass('hide');
		} else {
			$('#edit-reminder-container').addClass('hide');
			$('#EditNoteDate').prop('disabled', true);
		}
	});
EOT;

$this->Js->buffer( $script );
?>

<?php
endif;
?>
