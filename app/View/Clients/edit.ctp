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
			<legend><?php echo __( 'Edit' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div class="form-group <?php echo $this->Form->error( 'code' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'code', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'code' ); ?>
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
					<div
						class="form-group <?php echo $this->Form->error( 'number_of_cars' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'number_of_cars', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'number_of_cars',
								array( 'min' => 0 ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'centre_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'centre_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'centre_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'status' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'status', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'status',
								array( 'options' => Client::statuses() ) ); ?>
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
					array( 'action' => 'delete', $this->Form->value( 'Client.id' ) ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this client?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Clients' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
