<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Client', array(
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
			<legend><?php echo __( 'Add' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->hidden( 'Person.0.role', array( 'value' => 1 ) ); ?>
					<div class="form-group <?php echo $this->Form->error( 'code' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'code', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'code' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.title' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.title', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.title',
								array( 'options' => Person::titles() ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.forename' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.forename', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.forename' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'Person.0.middle_names' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.middle_names', __( 'Middle Name(s)' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.middle_names' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.surname' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.surname', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.surname' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.gender' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.gender', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.gender',
								array( 'options' => Person::genders() ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.date_of_birth' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.date_of_birth', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group date">
								<?php echo $this->Form->input( 'Person.0.date_of_birth', array(
									'type'        => 'text',
									'placeholder' => 'yyyy-mm-dd'
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.phone' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.phone', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.phone' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.mobile' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.mobile', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.mobile' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.email' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.email', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.email' ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
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
						<?php echo $this->Form->label( 'address_line_2',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'address_line_2' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'address_line_3' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'address_line_3',
							null,
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
						<?php echo $this->Form->label( 'county',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'county' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'country_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'country_id',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'country_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'postcode' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'postcode',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'postcode' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'Person.0.national_insurance_number' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'Person.0.national_insurance_number',
							__( 'NI Number' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'Person.0.national_insurance_number' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'number_of_cars' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'number_of_cars',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'number_of_cars',
								array( 'min' => 0, 'value' => 0 ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'centre_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'centre_id',
							null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'centre_id' ); ?>
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
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Clients' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<?php
echo $this->Html->script( 'bootstrap.datepicker', array( 'block' => 'script-two' ) );

$adult = strtotime( '-18 years' ) * 1000;

$script = <<<EOT
	$('.date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
		startView: 2,
		clearBtn: true,
		endDate: new Date({$adult})
	});
EOT;

$this->Js->buffer( $script );
?>
