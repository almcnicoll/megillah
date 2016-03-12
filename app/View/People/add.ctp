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
		<?php echo $this->Form->create( 'Person', array(
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
			<legend><?php echo __( 'Add Person' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<div
						class="form-group <?php echo ( $this->Form->error( 'title' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'title', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'title', array( 'options' => Person::titles() ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'forename' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'forename', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'forename' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'middle_names' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'middle_names', __( 'Middle Name(s)' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'middle_names' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'surname' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'surname', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'surname' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'phone' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'phone', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'phone' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'mobile' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'mobile', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'mobile' ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div
						class="form-group <?php echo ( $this->Form->error( 'email' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'email', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'email' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'date_of_birth' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'date_of_birth', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group date">
								<?php echo $this->Form->input( 'date_of_birth', array(
									'type'        => 'text',
									'placeholder' => 'yyyy-mm-dd'
								) ); ?>
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'gender' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'gender', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'gender',
								array( 'options' => Person::genders() ) ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'role' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'role', __( 'Relationship' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'role',
								array( 'options' => Person::roles() ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'national_insurance_number' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'national_insurance_number',
							__( 'NI Number' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'national_insurance_number' ); ?>
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
			<li><?php echo $this->Html->link( __( 'List %s', __( 'People' ) ),
					array( 'action' => 'manage', $client['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
                                'cfs_licence_number' => $client['Centre']['cfs_licence_number'],
                                'centre_id'          => $client['Centre']['id'],
                                'client_code'        => $client['Client']['code']
			) ); ?>
		</ul>
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
		clearBtn: true,
		endDate: new Date()
	});
EOT;

$this->Js->buffer( $script );
?>
