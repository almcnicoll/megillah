<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $asset['Client']['code'], $asset['Client']['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $asset['Client']['id']
		) ); ?>
		<br/>

		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $asset['Asset']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Value' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $asset['Asset']['value'],
							$asset['Client']['Country']['Currency']['code'] ); ?>
					</dd>
					<dt><?php echo __( 'Creditor' ); ?></dt>
					<dd>
						<?php echo $this->Html->link( $asset['Creditor']['display'], array(
							'controller' => 'creditors',
							'action'     => 'view',
							$asset['Creditor']['id']
						) ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Outstanding' ); ?></dt>
					<dd>
						<?php echo $this->Number->currency( $asset['Asset']['outstanding_amount'],
							$asset['Client']['Country']['Currency']['code'] ); ?>
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $asset['Asset']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $asset['Asset']['created'] !== $asset['Asset']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $asset['Asset']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</div>
			<div class="col-lg-6">
				<h3><?php echo __( 'Notes' ); ?></h3>
				<?php if ( empty( $asset['AssetNote'] ) ): ?>
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
					<?php foreach ( $asset['AssetNote'] as $assetNote ): ?>
						<blockquote class="note-container">
							<p class="note-text" data-note-id="<?php echo h( $assetNote['id'] ); ?>"
							   data-note-date="<?php echo h( $assetNote['date'] ); ?>"><?php echo h( $assetNote['text'] ); ?></p>
							<footer><?php
								$modifyUser = '';
								if ( ! empty( $assetNote['CreatedBy'] ) ) {
									$modifyUser = __( ' by %s', $assetNote['CreatedBy']['full_name'] );
								}
								echo __( 'On %s%s%s',
									$this->Time->format( $assetNote['created'], '%A, %d %B %Y, %H:%M' ),
									$modifyUser,
									$this->Html->tag( 'span', __( ' - %s - %s',
										$this->Html->link( __( 'Edit' ), 'javascript:void(0)', array( 'class' => 'edit-note-link' ) ),
										$this->Form->postLink( __( 'Delete' ), array(
											'controller' => 'asset_notes',
											'action'     => 'delete',
											$assetNote['id']
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Asset' ) ), array(
					'action' => 'add',
					$asset['Client']['id']
				) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Asset' ) ), array(
					'action' => 'edit',
					$asset['Asset']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Asset' ) ), array(
					'action' => 'delete',
					$asset['Asset']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this asset?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Assets' ) ), array(
					'action' => 'manage',
					$asset['Client']['id']
				) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $asset['Client']['id'],
                                'cfs_licence_number' => $asset['Client']['Centre']['cfs_licence_number'],
                                'centre_id'          => $asset['Client']['Centre']['id'],
                                'client_code'        => $asset['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<?php echo $this->element( 'managenotes', array('type' => Reminder::MODEL_ASSET_NOTE, 'foreignID' => $asset['Asset']['id']) ); ?>
