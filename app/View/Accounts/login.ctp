<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
		<?php echo $this->Form->create( 'User', array(
			'class'         => 'form-horizontal',
			'inputDefaults' => array( 'class' => 'form-control', 'div' => false, 'label' => false ),
			'role'          => 'form'
		) ); ?>
		<fieldset>
			<legend><?php echo __( 'Sign In' ); ?></legend>
			<div class="form-group">
				<?php echo $this->Form->label( 'login', 'Username', array( 'class' => 'col-sm-3 control-label' ) ); ?>
				<div class="col-sm-9">
					<?php echo $this->Form->input( 'login', array(
						'autofocus'   => 'autofocus',
						'placeholder' => 'Username'
					) ); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $this->Form->label( 'password', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
				<div class="col-sm-9">
					<?php echo $this->Form->input( 'password', array( 'placeholder' => 'Password' ) ); ?>
				</div>
			</div>
			<br/>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary' ) ); ?>
				</div>
			</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
