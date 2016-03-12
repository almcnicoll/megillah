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
		<?php echo $this->Form->create( 'Asset', array(
			'class'         => 'form-horizontal',
			'inputDefaults' => array(
				'class' => 'form-control',
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'novalidate'    => true
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
					<div class="form-group <?php echo $this->Form->error( 'value' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'value', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon"><?php echo __( '£' ); ?></span>
								<?php echo $this->Form->input( 'value', array( 'min' => 0, 'step' => 0.001 ) ); ?>
							</div>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'creditor_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'creditor_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'creditor_id', array( 'empty' => true ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo $this->Form->error( 'outstanding_amount' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'outstanding_amount', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon"><?php echo __( '£' ); ?></span>
								<?php echo $this->Form->input( 'outstanding_amount', array(
									'min'  => 0,
									'step' => 0.001, 
									'formnovalidate' => ''
								) ); ?>
							</div>
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
			<li><?php echo $this->Form->postLink( __( 'Delete' ), array(
					'action' => 'delete',
					$this->Form->value( 'Asset.id' )
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
