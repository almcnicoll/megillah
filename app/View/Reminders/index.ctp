<?php
$entries = array();
foreach ( $reminders as $reminder ) {
	$entries[ $reminder['Reminder']['date'] ][] = $reminder;
}
?>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Diary' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-8">
				<?php echo $this->Form->create( 'Reminder', array(
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
								<div class="col-md-6">
									<?php echo $this->Form->input( 'Reminder.client_id',
										array( 'empty' => __( '- Select Client -' ), 'required' => false ) ); ?>
								</div>
								<div class="col-md-6">
									<div class="btn-group btn-group-justified">
										<div class="btn-group">
											<button type="submit"
											        class="btn btn-primary"><?php echo __( 'Filter' ); ?></button>
										</div>
										<div class="btn-group">
											<?php echo $this->Html->link( __( 'Reset' ), array(
												'action' => 'index'
											), array( 'class' => 'btn btn-default' ) ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
				<?php if ( ! empty( $entries ) ): ?>
					<h5 style='float:left;'>Sort by: <?php echo $this->Paginator->sort('date').' ('.$this->Paginator->sortDir('Reminder').')'; ?></h5>
					<?php echo $this->element( 'Tools.pagination' ); ?>
					<?php foreach ( $entries as $key => $entry ): ?>
						<h4><?php echo $this->Time->format( $key,
								'%A, %d %B %Y' ); ?></h4>
						<table class="table table-condensed table-hover">
							<tbody>
							<?php foreach ( $entry as $reminder ): ?>
								<?php
								$rowClass = '';
								if ( strtotime( 'now' ) > strtotime( $key ) ) {
									$rowClass = 'warning';
								}
								if ( (int) $reminder['Reminder']['status'] === Reminder::STATUS_COMPLETE ) {
									$rowClass = 'success complete';
								} else {
									if ( (int) $reminder['Reminder']['model'] === Reminder::MODEL_NOTE ) {
										$rowClass = 'info';
									}
								}
								?>
								<tr class="<?php echo h( $rowClass ); ?>">
									<td><?php
										// Display appropriate icon
										if ($reminder['Reminder']['model'] == Reminder::MODEL_NOTE) {
											if (empty($reminder['Reminder']['centre_id'])) {
												// Personal message
												echo "<span class='glyphicon glyphicon-user'></span>&nbsp;";
											} else {
												// Group message
												echo "<span class='glyphicon glyphicon-bullhorn'></span>&nbsp;";
											}
										}
										// Now display title
										if ( ! empty( $reminder['Client']['id'] ) ):
											if ( ! empty( $reminder['Reminder']['title'] ) ):
												?>
												<span
													style="font-weight: bold;"><?php echo __( '%s - %s (%s)', $reminder['Client']['code'], $reminder['Client']['PrimaryPerson']['full_name'], $reminder['Reminder']['title'] ); ?></span>
											<?php else: ?>
												<span
													style="font-weight: bold;"><?php echo __( '%s - %s', $reminder['Client']['code'], $reminder['Client']['PrimaryPerson']['full_name'] ); ?></span>
											<?php endif; ?>
											<br/>
										<?php elseif
										( ! empty( $reminder['Reminder']['title'] )
										): ?>
											<span style="font-weight: bold;"><?php echo h( $reminder['Reminder']['title'] ); ?></span>
											<br/>
										<?php endif; ?>
										
										<p class="reminder-text" style="margin: 0;" data-note-id="<?php echo h( $reminder['Reminder']['id_in_model'] ); ?>" data-note-date="<?php echo h( $reminder['Reminder']['date'] ); ?>" data-note-time="<?php echo h( $reminder['Reminder']['time'] ); ?>" <?php if (!empty($reminder['Reminder']['created_by'])) { echo 'data-note-user_id='.$reminder['Reminder']['created_by']; } ?> <?php if (!empty($reminder['Reminder']['centre_id'])) { echo 'data-note-centre_id='.$reminder['Reminder']['centre_id']; } ?>><?php 
											echo nl2br( $reminder['Reminder']['text'] );
										?></p>
									</td>
									<td class="text-right" style="width: 15%">
										<?php
										$viewController   = 'assets';
										$actionController = 'asset_notes';
										switch ( (int) $reminder['Reminder']['model'] ) {
											case 2:
												$viewController   = 'clients';
												$actionController = 'client_notes';
												break;
											case 3:
												$viewController   = 'creditors';
												$actionController = 'creditor_notes';
												break;
											case 4:
												$viewController   = 'debts';
												$actionController = 'debt_notes';
												break;
											case 5:
												$viewController   = 'people';
												$actionController = 'person_notes';
												break;
											case 6:
												$viewController   = null;
												$actionController = 'notes';
												break;
											case 7:
												$viewController   = 'letters';
												$actionController = 'letters';
												break;
										}
										?>
										<div class="dropdown">
											<a data-toggle="dropdown"
											   href="javascript:void(0)"><?php echo __( 'Actions' ); ?>
												&nbsp;<span class="caret"></span></a>
											<ul class="dropdown-menu pull-right" role="menu">
												<?php if ( (int) $reminder['Reminder']['model'] !== Reminder::MODEL_NOTE ): ?>
													<?php if ( (int) $reminder['Reminder']['model'] === Reminder::MODEL_LETTER ): ?>
													<li><?php echo $this->Html->link( __( 'View Details' ), array(
															'controller' => $viewController,
															'action'     => 'view',
															$reminder['Reminder']['foreign_id'],
															'ext' => 'pdf'
														), array('target' => '_blank') ); ?></li>
													<?php else: ?>
													<li><?php echo $this->Html->link( __( 'View Details' ), array(
															'controller' => $viewController,
															'action'     => 'view',
															$reminder['Reminder']['foreign_id']
														) ); ?></li>
													<?php endif; ?>
												<?php endif; ?>
												<?php if ( (int) $reminder['Reminder']['status'] === Reminder::STATUS_DEFAULT ): ?>
													<li><?php echo $this->Form->postLink( __( 'Mark Complete' ),
															array(
																'controller' => 'reminders',//$actionController,
																'action'     => 'mark_complete',
																$reminder['Reminder']['id_and_model'],
															), null,
															__( 'Are you sure you want to mark this action as complete?' ) ); ?></li>
													<?php if ( (int) $reminder['Reminder']['model'] === Reminder::MODEL_NOTE ): ?>
														<li><?php echo $this->Html->link( __( 'Edit' ), 'javascript:void(0)',
																array(
																	'class'          => 'edit-note-dropdown-link'
																) ); ?></li>
													<?php endif; ?>
												<?php else: ?>
													<li><?php echo $this->Form->postLink( __( 'Mark as Outstanding' ),
															array(
																'controller' => 'reminders',//$actionController,
																'action'     => 'mark_complete',
																$reminder['Reminder']['id_and_model'],
																Reminder::STATUS_DEFAULT,
															), null,
															__( 'Are you sure you want to mark this action as complete?' ) ); ?></li>
												<?php endif; ?>
												<?php if ( (int) $reminder['Reminder']['model'] !== Reminder::MODEL_LETTER ): ?>
												<li><?php echo $this->Form->postLink( __( 'Delete' ),
														array(
															'controller' => $actionController,
															'action'     => 'delete',
															$reminder['Reminder']['id']
														), null,
														__( 'Are you sure you want to delete this action?' ) ); ?></li>
												<?php endif; ?>
											</ul>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
						<?php if ( $entry !== end( $entries ) ): ?>
							<hr/><?php endif; ?>
					<?php endforeach; ?>
					<?php echo $this->element( 'Tools.pagination' ); ?>
				<?php else: ?>
					<table class="table table-condensed table-hover">
						<tbody>
						<tr>
							<td class="text-center">
								<span><?php echo __( 'No Reminders Found' ); ?></span>
							</td>
						</tr>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
			<div class="col-lg-4">
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
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Reminder' ) ), 'javascript:void(0)',
					array( 'id' => 'open-add-note-modal' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Clients' ) ),
					array( 'controller' => 'clients', 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_NOTE, 'foreignID' => null) ); ?>
