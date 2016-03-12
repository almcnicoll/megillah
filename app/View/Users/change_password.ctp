<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'User' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'User', array(
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
			<legend><?php echo __( 'Change Password' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<div class="alert alert-info" style="margin: 0;">
								<?php echo __( 'Please enter your chosen password in the boxes below. You should ensure that you do not have Caps Lock on. You may want to type the password into notepad or Word, and then to copy-paste it into this box so that you can see that you have entered it correctly.' ); ?>
							</div>
						</div>
					</div>
					<?php if ( $this->Form->value( 'User.id' ) !== Auth::id() ): ?>
						<div
							class="form-group <?php echo ( $this->Form->error( 'full_name' ) !== null ) ? 'has-error' : ''; ?>">
							<?php echo $this->Form->label( 'full_name', __( 'Name' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'full_name', array( 'disabled' => true ) ); ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group <?php echo ( $this->Form->error( 'pwd' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'pwd', __( 'Password' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'pwd', array( 'type' => 'password' ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'pwd_repeat' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'pwd_repeat', __( 'Confirm' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'pwd_repeat', array( 'type' => 'password' ) ); ?>
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
			<!-- <li><?php echo $this->Html->link( __( 'List %s', __( 'Users' ) ), array( 'action' => 'index' ) ); ?></li> -->
		</ul>
	</div>
</div>
