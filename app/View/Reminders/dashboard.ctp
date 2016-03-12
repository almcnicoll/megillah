<?php echo $this->Html->css('/bootstrap-calendar/css/calendar.css', array('inline' => false)); ?>

<?php /*echo $this->Html->script('/bootstrap-calendar/js/vendor/underscore-min.js', array('inline' => false));*/ ?>
<?php echo $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js', array('inline' => false)); ?>

<?php echo $this->Html->script('/bootstrap-calendar/js/calendar.js', array('inline' => false)); ?>

<!-- Inline script must appear in JS block, so catch it with output buffering -->
<?php ob_start(); ?>
	var defaultCalendarView = $.cookie('default-view');
	if ((defaultCalendarView === undefined) || (defaultCalendarView == null) || (defaultCalendarView == '')) { defaultCalendarView = 'week'; }
	var defaultCalendarDay = $.cookie('default-day');
	if ((defaultCalendarDay === undefined) || (defaultCalendarDay == null) || (defaultCalendarDay == '')) { defaultCalendarDay = '<?php echo date('Y-m-d'); ?>'; }
	$(document).ready( function() {
	var calendar = $("#calendar").calendar(	{
		tmpl_path: "../bootstrap-calendar/tmpls/",
		events_source: './eventlist',
		modal: '#events-modal',
		modal_type: 'template',
		modal_title: function(evt) { return evt.description; },
		first_day: 1,
		view: defaultCalendarView,
		day: defaultCalendarDay,
		onAfterViewLoad: function(view) {
			$('h3#calendar-header').html(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
			$.cookie('default-day', this.options.day);
		},
	});
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			var newView = $this.data('calendar-view');
			$.cookie('default-view', newView, { expires: 365 });
			calendar.view(newView);
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});
	
	$('#catch-up-link').click( function(event) {
		event.preventDefault();
		event.stopPropagation();
		
		$('#catch-up-modal').modal( 'show' );
		
		return false;
	} );
	
	$('.overdue-event-row').click( function(event) {
		event.preventDefault();
		event.stopPropagation();
		
		var event_id = $(this).data('event-id');
		//alert(event_id);
		//$('#events-modal').modal( { show: false } );
		calendar._loadTemplate("modal");
		var modal = $('#events-modal-reminders'); //$(calendar.options.modal);
		var modal_body = $('#events-modal-reminders .modal-body');
		var event = new Array();
		
		var json = $.getJSON('./eventlist?id='+event_id, function( data ) {
			if ((data['result'] === undefined) || (data['result'].length == 0)) {
				alert('Cannot load entry');
				return false;
			}
			var event = data['result'][0];
			
			var templateHTML = calendar.options.templates["modal"]({"event": event, "calendar": calendar});
			
			modal_body.html(templateHTML);
			if(_.isFunction(calendar.options.modal_title)) {
				modal.find("h3").html(calendar.options.modal_title(event)); //+"<br /><small>"+event.client+"</small>");
			}
			modal.modal( 'show' );
		});
				
		return false;
	});
	
	} );
<?php
	$jscript = ob_get_contents();
	ob_end_clean();
	$this->Html->scriptBlock($jscript, array('inline' => false, 'safe' => true));
?>

<div class='row'>
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'My Catalyst' ); ?></h1>
		</div>
	</div>
</div>

<!-- Catch-up modal -->
<div class="modal fade" id="catch-up-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Complete old entries</h3>
			</div>
			<div class="modal-body" style="height: 400px">
				<div class='alert'>
					This will mark as complete <strong>all the entries <em>before</em> the date shown below</strong>. The entries will remain in the system, but will not be shown as "outstanding".<br /><br />
					This operation <strong>applies to all your centres</strong> (see below), and <strong>cannot be undone</strong>.<br /><br />
					<strong>Centres affected:</strong>
					<ul>
						<?php
							if (count($userCentres) == 0) {
								echo "<li><em>You have no centres linked to your user</em></li>\n";
							} else {
								foreach ($userCentres as $userCentre) {
									echo "<li>{$userCentre['Centre']['name']}</li>";
								}
							}
						?>
					</ul>
					<?php
						if (count($userCentres) > 1) {
							echo "<br /><div>To catch-up only one of these centres, log in as a user who only has access to one centre (you may need to create one).</div>";
						}
					?>
					<br /><br />
					If you are unsure, please click <strong>Cancel</strong> below and contact support.
				</div>
				<?php echo $this->Form->create( 'Reminder', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => 'reminders', 'action' => 'bulk_complete' ),
				'role'          => 'form'
			) ); ?>
			<div class="form-group">
				<div class='row'>
					<div class="col-xs-6">
						<div class="input-group date">
							<?php echo $this->Form->input( 'BulkCompleteDate', array(
								'id'          => 'BulkCompleteDate',
								'type'        => 'text',
								'placeholder' => 'yyyy-mm-dd',
								'value'       => date( 'Y-m-d', strtotime( 'today' ) ),
							) ); ?>
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel' ); ?></button>
				<button type="submit" class="btn btn-primary"><?php echo __( 'Update' ); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<!-- Events display modal - calendar -->
<div class="modal fade" id="events-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Event</h3>
			</div>
			<div class="modal-body" style="height: 300px">
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
			</div>
		</div>
	</div>
</div>
<!-- End events display modal -->

<!-- Events display modal - reminders -->
<div class="modal fade" id="events-modal-reminders">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Event</h3>
			</div>
			<div class="modal-body" style="height: 300px">
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
			</div>
		</div>
	</div>
</div>
<!-- End events display modal -->

<div class='row'>
	<!-- LHS - calendar -->
	<div class='col-sm-10 col-sm-push-2 col-md-5 col-md-push-2'>
		<h3 id='calendar-header' style='display: inline;'>Calendar</h3>
		<div class='btn-group' style='float: right;'>
			<button class="btn btn-warning" data-calendar-view="month">Month</button>
			<button class="btn btn-warning" data-calendar-view="week">Week</button>
			<button class="btn btn-warning" data-calendar-view="day">Day</button>
		</div>
		<div class='btn-group' style='float: right;'>
			<button class="btn btn-info" style='visibility: hidden;'>&nbsp;</button>
		</div>
		<div class='btn-group' style='float: right;'>
			<button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt;</button>
			<button class="btn" data-calendar-nav="today">[Today]</button>
			<button class="btn btn-primary" data-calendar-nav="next">&gt;&gt;</button>
		</div>
		<div style='clear: right;'></div>
		<div id="calendar"></div>
	</div>
	<div class='clearfix visible-sm-block'></div>
	<!-- RHS - overdue tasks & recent clients -->
	<!-- <div class='col-sm-10 col-sm-push-2 col-md-5 col-md-push-2'> -->
	<div class='col-sm-12 col-md-5 col-md-push-2'>
		<div class='row'>
			<!-- Overdue tasks -->
			<div class='col-xs-12'>
				<h3 style='display: inline;'>Overdue Entries<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ) { echo " <small><a href='#' id='catch-up-link'>(catch me up...)</a></small></h3>"; } ?>
				<div class='btn-group' style='float: right;'>
					<button class="btn btn-info" style='visibility: hidden;'>&nbsp;</button>
				</div>
				<div style='clear: right;'></div>
				<div class='cal-row-fluid cal-row-head'>
					<div class='cal-cell1'>&nbsp;</div>
					<table class='table table-striped'>
					<tbody>
					<?php
					$row_class = 'default';
					foreach ( $reminders as $reminder ) {
						$event_id = ($reminder['Reminder']['id_in_model']*100) + $reminder['Reminder']['model'];
						if ($row_class == 'default') {
							$row_class = 'info';
						} else {
							$row_class = 'default';
						}
						if (!isset($reminder['Reminder']['title'])) {
							$reminder['Reminder']['title'] = Reminder::models($reminder['Reminder']['model']);
						}
						$date_formatted = date('d-M-Y', strtotime($reminder['Reminder']['date']));
						if (!empty($reminder['Reminder']['time'])) {
							$date_formatted .= "<br />".substr($reminder['Reminder']['time'],0,5);
						}
						$text_formatted = nl2br($reminder['Reminder']['text']);
						$icon_span = '';
						// Determine appropriate icon
						if ($reminder['Reminder']['model'] == Reminder::MODEL_NOTE) {
							if (empty($reminder['Reminder']['centre_id'])) {
								// Personal message
								$icon_span = "<span class='glyphicon glyphicon-user'></span>&nbsp;";
							} else {
								// Group message
								$icon_span = "<span class='glyphicon glyphicon-bullhorn'></span>&nbsp;";
							}
						}
						echo <<<END_HTML
			<tr class='overdue-event-row' id='overdue-event-{$event_id}' data-event-id='{$event_id}' style='cursor: pointer;'>
				<td style="width: 100px;">{$date_formatted}</td>
				<td>{$icon_span}{$reminder['Reminder']['title']}<br /><small>{$text_formatted}</small></td>
			</tr>

END_HTML;
					}
					?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	
		<div class='row'>
			<!-- Recent clients -->
			<div class='col-xs-12'>
				<h3><?php echo __( 'Recent Clients' ); ?></h3>
				<table class="table table-condensed table-hover">
					<tbody>
					<?php if ( empty( $recentClients ) ): ?>
						<tr>
							<td class="text-center" colspan="2">
								<span><?php echo __( 'No Clients Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $recentClients as $client ): ?>
							<tr>
								<td><?php echo h( $client['Client']['code'] ); ?></td>
								<td><?php echo h( $client['PrimaryPerson']['full_name'] ); ?></td>
								<td class="text-right">
									<?php echo $this->Html->link( __( 'View Details' ), array(
										'controller' => 'clients',
										'action'     => 'view',
										$client['Client']['id']
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

	
	<div class="col-sm-2 col-sm-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Entry' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-note-modal' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Clients' ) ),
					array( 'controller' => 'clients', 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_NOTE, 'foreignID' => null) ); ?>