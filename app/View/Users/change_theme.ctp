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
			<legend><?php echo __( 'Change Theme' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<?php if ( $this->Form->value( 'User.id' ) !== Auth::id() ): ?>
						<div
							class="form-group <?php echo ( $this->Form->error( 'full_name' ) !== null ) ? 'has-error' : ''; ?>">
							<?php echo $this->Form->label( 'full_name', __( 'Name' ),
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'full_name', array( 'disabled' => true ) ); ?>
							</div>
						</div>
					<?php endif; ?>
					<div
						class="form-group <?php echo ( $this->Form->error( 'theme_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'theme_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'theme_id', array() ); ?>
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
					array( 'action' => 'delete', $this->Form->value( 'User.id' ) ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this user?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Advisers' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
