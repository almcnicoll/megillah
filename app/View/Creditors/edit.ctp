<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Creditor' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Creditor', array(
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
			'role'          => 'form'
		) ); ?>
		<fieldset>
			<legend><?php echo __( 'Edit' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div class="form-group <?php echo $this->Form->error( 'name' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'name', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'name' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'display_name' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'display_name', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'display_name' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_1' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_1', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_1' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_2' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_2', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_2' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_3' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_3', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_3' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'city' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'city', __( 'Town/City' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'city' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'county' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'county', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'county' ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div
						class="form-group <?php echo $this->Form->error( 'country_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'country_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'country_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'postcode' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'postcode', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'postcode' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'phone' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'phone', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'phone' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'mobile' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'mobile', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'mobile' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'email' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'email', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'email' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'website' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'website', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'website' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'organisation_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'organisation_id',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php
							$allowEmpty = false;
							if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) {
								$allowEmpty = true;
							}
							echo $this->Form->input( 'organisation_id', array( 'empty' => $allowEmpty ) );
							?>
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
			<li><?php echo $this->Form->postLink( __( 'Delete' ),
					array( 'action' => 'delete', $this->Form->value( 'Creditor.id' ) ),
					array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this creditor?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Creditors' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
