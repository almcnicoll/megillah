<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Trigger Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'TriggerCategory', array(
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
					<div class="form-group <?php echo ( $this->Form->error( 'name' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'name', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'name' ); ?>
						</div>
					</div>
					<br/>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary' ) ); ?>
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
					$this->Form->value( 'TriggerCategory.id' )
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this trigger category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Trigger Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
