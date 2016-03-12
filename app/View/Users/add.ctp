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
			<legend><?php echo __( 'Add' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<div
						class="form-group <?php echo ( $this->Form->error( 'username' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'username', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'username' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'pwd' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'pwd', __( 'Password' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'pwd', array( 'type' => 'password' ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'pwd_repeat' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'pwd_repeat', __( 'Confirm' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'pwd_repeat', array( 'type' => 'password' ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'role_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'role_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php
							$roles = array_flip( Configure::read( 'Role' ) );
							foreach ( $roles as $key => $role ) {
								if ( $key < (int) Auth::user( 'role_id' ) ) {
									unset( $roles[ $key ] );
								}
							}
							echo $this->Form->input( 'role_id', array(
								'options' => array_reverse( $roles, true ),
								'empty'   => false
							) );
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div
						class="form-group <?php echo ( $this->Form->error( 'first_name' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'first_name', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'first_name' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'last_name' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'last_name', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'last_name' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'email' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'email', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'email' ); ?>
						</div>
					</div>
					<?php /*
					<div
						class="form-group <?php echo ( $this->Form->error( 'CentreMembership.0.centre_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'CentreMembership.0.centre_id',
							__( 'Primary Centre' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php
							echo $this->Form->select( 'CentreMembership.0.centre_id', $centres, array(
								'class'       => 'form-control',
								'empty'       => false,
								'showParents' => true
							) );
							?>
						</div>
					</div>
					<br/>
					*/ ?>

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
