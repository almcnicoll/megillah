<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $person['Client']['code'], $person['Client']['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $person['Client']['id']
		) ); ?>
		<br/>

		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<?php if ( ! empty( $person['Person']['title'] ) ): ?>
						<dt><?php echo __( 'Title' ); ?></dt>
						<dd>
							<?php echo Person::titles( $person['Person']['title'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $person['Person']['complete_name'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $person['Person']['phone'] ) ): ?>
						<dt><?php echo __( 'Phone' ); ?></dt>
						<dd>
							<?php echo h( $person['Person']['phone'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $person['Person']['mobile'] ) ): ?>
						<dt><?php echo __( 'Mobile' ); ?></dt>
						<dd>
							<?php echo h( $person['Person']['mobile'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $person['Person']['email'] ) ): ?>
						<dt><?php echo __( 'Email' ); ?></dt>
						<dd>
							<?php echo $this->Text->autoLinkEmails( $person['Person']['email'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Date Of Birth' ); ?></dt>
					<dd>
						<?php echo __( '%s (%d)', $this->Time->format( $person['Person']['date_of_birth'], '%d %B %Y' ), $person['Person']['age'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Gender' ); ?></dt>
					<dd>
						<?php echo Person::genders( $person['Person']['gender'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Relationship' ); ?></dt>
					<dd>
						<?php echo Person::roles( $person['Person']['role'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $person['Person']['national_insurance_number'] ) ): ?>
						<dt><?php echo __( 'NI Number' ); ?></dt>
						<dd>
							<?php echo h( $person['Person']['national_insurance_number'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $person['Person']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $person['Person']['created'] !== $person['Person']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $person['Person']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Notes' ); ?></h3>
				<?php if ( empty( $person['PersonNote'] ) ): ?>
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
					<?php foreach ( $person['PersonNote'] as $personNote ): ?>
						<blockquote class="note-container">
							<p class="note-text" data-note-id="<?php echo h( $personNote['id'] ); ?>"
							   data-note-date="<?php echo h( $personNote['date'] ); ?>"><?php echo h( $personNote['text'] ); ?></p>
							<footer><?php
								$modifyUser = '';
								if ( ! empty( $personNote['CreatedBy'] ) ) {
									$modifyUser = __( ' by %s', $personNote['CreatedBy']['full_name'] );
								}
								echo __( 'On %s%s%s',
									$this->Time->format( $personNote['created'], '%A, %d %B %Y, %H:%M' ),
									$modifyUser,
									$this->Html->tag( 'span', __( ' - %s - %s',
										$this->Html->link( __( 'Edit' ), 'javascript:void(0)', array( 'class' => 'edit-note-link' ) ),
										$this->Form->postLink( __( 'Delete' ), array(
											'controller' => 'person_notes',
											'action'     => 'delete',
											$personNote['id']
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
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Person' ) ),
					array( 'action' => 'add', $person['Client']['id'] ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Person' ) ),
					array( 'action' => 'edit', $person['Person']['id'] ) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Person' ) ),
					array( 'action' => 'delete', $person['Person']['id'] ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this person?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'People' ) ),
					array( 'action' => 'manage', $person['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
								'id'                 => $person['Client']['id'],
                                'cfs_licence_number' => $person['Client']['Centre']['cfs_licence_number'],
                                'centre_id'          => $person['Client']['Centre']['id'],
                                'client_code'        => $person['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_PERSON_NOTE, 'foreignID' => $person['Person']['id']) ); ?>
