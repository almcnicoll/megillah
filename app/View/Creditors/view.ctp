<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Creditor' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<?php
				if ( empty( $creditor['Creditor']['organisation_id'] ) && ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ):
					?>
					<div class="alert alert-info">
						<?php echo __( 'Default Creditor' ); ?>
					</div>
				<?php
				endif;
				?>
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $creditor['Creditor']['name'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $creditor['Creditor']['display_name'] ) ): ?>
					<dt><?php echo __( 'Display Name' ); ?></dt>
					<dd>
						<?php echo h( $creditor['Creditor']['display_name'] ); ?>
						&nbsp;
					</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Address' ); ?></dt>
					<dd>
						<address>
							<?php if ( ! empty( $creditor['Creditor']['address_line_1'] ) ): ?>
								<?php echo h( $creditor['Creditor']['address_line_1'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $creditor['Creditor']['address_line_2'] ) ): ?>
								<?php echo h( $creditor['Creditor']['address_line_2'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $creditor['Creditor']['address_line_3'] ) ): ?>
								<?php echo h( $creditor['Creditor']['address_line_3'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $creditor['Creditor']['city'] ) ): ?>
								<?php echo h( $creditor['Creditor']['city'] ); ?><br/>
							<?php endif; ?>
							<?php if ( ! empty( $creditor['Creditor']['county'] ) ): ?>
								<?php echo h( $creditor['Creditor']['county'] ); ?><br/>
							<?php endif; ?>
							<?php echo $this->Html->link( $creditor['Country']['name'], array(
								'controller' => 'countries',
								'action'     => 'view',
								$creditor['Country']['id']
							) ); ?><br/>
							<?php echo h( $creditor['Creditor']['postcode'] ); ?>
						</address>
					</dd>
					<?php if ( ! empty( $creditor['Creditor']['phone'] ) ): ?>
						<dt><?php echo __( 'Phone' ); ?></dt>
						<dd>
							<?php echo h( $creditor['Creditor']['phone'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $creditor['Creditor']['mobile'] ) ): ?>
						<dt><?php echo __( 'Mobile' ); ?></dt>
						<dd>
							<?php echo h( $creditor['Creditor']['mobile'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $creditor['Creditor']['email'] ) ): ?>
						<dt><?php echo __( 'Email' ); ?></dt>
						<dd>
							<?php echo $this->Text->autoLinkEmails( $creditor['Creditor']['email'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php if ( ! empty( $creditor['Creditor']['website'] ) ): ?>
						<dt><?php echo __( 'Website' ); ?></dt>
						<dd>
							<?php echo $this->Text->autoLinkUrls( $creditor['Creditor']['website'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<?php
					if ( ! empty( $creditor['Creditor']['organisation_id'] ) && ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ):
						?>
						<dt><?php echo __( 'Organisation' ); ?></dt>
						<dd>
							<?php echo $this->Html->link( $creditor['Organisation']['name'], array(
								'controller' => 'organisations',
								'action'     => 'view',
								$creditor['Creditor']['organisation_id']
							) ); ?>
							&nbsp;
						</dd>
					<?php
					endif;
					?>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $creditor['Creditor']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $creditor['Creditor']['created'] !== $creditor['Creditor']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $creditor['Creditor']['modified'],
								'%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Notes' ); ?></h3>
				<?php if ( empty( $creditor['CreditorNote'] ) ): ?>
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
					<?php foreach ( $creditor['CreditorNote'] as $creditorNote ): ?>
						<blockquote class="note-container">
							<p class="note-text" data-note-id="<?php echo h( $creditorNote['id'] ); ?>"
							   data-note-date="<?php echo h( $creditorNote['date'] ); ?>"><?php echo h( $creditorNote['text'] ); ?></p>
							<footer><?php
								$modifyUser = '';
								if ( ! empty( $creditorNote['CreatedBy'] ) ) {
									$modifyUser = __( ' by %s', $creditorNote['CreatedBy']['full_name'] );
								}
								echo __( 'On %s%s%s',
									$this->Time->format( $creditorNote['created'], '%A, %d %B %Y, %H:%M' ),
									$modifyUser,
									$this->Html->tag( 'span', __( ' - %s - %s',
										$this->Html->link( __( 'Edit' ), 'javascript:void(0)', array( 'class' => 'edit-note-link' ) ),
										$this->Form->postLink( __( 'Delete' ), array(
											'controller' => 'creditor_notes',
											'action'     => 'delete',
											$creditorNote['id']
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Creditor' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Creditor' ) ),
					array( 'action' => 'edit', $creditor['Creditor']['id'] ) ); ?></li>
			<?php if ( ( empty( $creditor['Creditor']['organisation_id'] ) && ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ) || ! empty( $creditor['Creditor']['organisation_id'] ) ): ?>
				<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Creditor' ) ),
						array( 'action' => 'delete', $creditor['Creditor']['id'] ), array( 'class' => 'text-danger' ),
						__( 'Are you sure you want to delete this creditor?' ) ); ?></li>
			<?php endif; ?>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Creditors' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_CREDITOR_NOTE, 'foreignID' => $creditor['Creditor']['id']) ); ?>
