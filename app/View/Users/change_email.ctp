<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Adviser' ); ?></h1>
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
			<legend><?php echo __( 'Change Email' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<div class="alert alert-info" style="margin: 0;">
								<?php echo __( 'Please enter your email address in the box below. It is critical that you enter it correctly to ensure that you receive responses to any support requests.' ); ?>
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
					<div class="form-group <?php echo ( $this->Form->error( 'email' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'email', __( 'Email' ), array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'email', array( 'type' => 'email' ) ); ?>
							<?php echo $this->Form->input( 'back_url', array( 'type' => 'hidden', 'value' => base64_encode(serialize($this->request->referer() ))) ); ?>
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
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Advisers' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
