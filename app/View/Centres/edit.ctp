<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Centre' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Centre', array(
			'class'         => 'form-horizontal',
			'inputDefaults' => array(
				'class' => 'form-control',
				'div'   => false,
				'error' => array(
					'attributes' => array(
						'wrap'  => 'span',
						'class' => 'help-block'
					)
				),
				'label' => false
			),
			'role'          => 'form',
			'type'          => 'file'
		) ); ?>
		<fieldset>
			<legend><?php echo __( 'Edit' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div class="form-group <?php echo $this->Form->error( 'name' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'name', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'name' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'code' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'code', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'code' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'organisation_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'organisation_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'organisation_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'email' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'email', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'email' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'cfs_licence_number' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'cfs_licence_number', __( 'CFS Licence #' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'cfs_licence_number' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'header' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'header', __( 'Letter Header Image' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<?php
									if ( ! empty( $this->request->data['Centre']['header_dir'] ) && ! empty( $this->request->data['Centre']['header'] ) ):
										echo $this->Html->image( '../files/centre/header/' . $this->request->data['Centre']['header_dir'] . '/' . $this->request->data['Centre']['header'], array(
											'alt'   => 'Letter Header',
											'class' => 'img-responsive img-thumbnail',
											'style' => 'width: 100%;'
										) );
										?>
										<hr/>
									<?php endif; ?>
								</div>
							</div>
							<div class="input-group">
								<?php echo $this->Form->input( 'header', array(
									'type'     => 'file',
									'accept'   => 'image/*',
									'required' => false
								) ); ?>
								<span class="input-group-btn"><button class="btn btn-info"
								                                      type="button" data-toggle="modal"
								                                      data-target="#image-help-modal"><?php echo __( 'Help' ); ?></button></span>
							</div>
							<?php echo $this->Form->input( 'header_dir', array( 'type' => 'hidden' ) ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_1' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_1', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_1' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_2' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_2', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_2' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_3' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_3', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_3' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'city' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'city', __( 'Town/City' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'city' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'county' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'county', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'county' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'country_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'country_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'country_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'postcode' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'postcode', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'postcode' ); ?>
						</div>
					</div>
					<br/>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit"
							        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Save' ); ?></button>
							<button type="submit"
							        class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Save' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Form->postLink( __( 'Remove Header' ), array(
					'action' => 'remove_header',
					$this->Form->value( 'Centre.id' )
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to remove the header image from this centre?' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Form->postLink( __( 'Delete' ), array(
					'action' => 'delete',
					$this->Form->value( 'Centre.id' )
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this centre?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Centres' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<div class="modal fade" id="image-help-modal" tabindex="-1" role="dialog" aria-labelledby="image-help-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="image-help-modal-label"><?php echo __( 'Letter Header Help' ); ?></h4>
			</div>
			<div class="modal-body">
				<?php echo __( 'Any image you insert here will be stretched to fit the full width of the page. You should therefore try to upload an image that is approximately 1000 pixels wide. If your logo is narrower, you should create a copy with white space to the right of the logo, to fill out the 1000 pixels. A simple utility such as Paint will be able to do this.' ); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
			</div>
		</div>
	</div>
</div>
