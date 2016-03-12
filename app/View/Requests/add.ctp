<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<?php if ( ! empty( $this->request->params['named']['type'] ) ): ?>
				<?php if ( $this->request->params['named']['type'] === '1' ): ?>
					<h1><?php echo __( 'Feedback' ); ?></h1>
				<?php else: ?>
					<h1><?php echo __( 'Support Request' ); ?></h1>
				<?php endif; ?>
			<?php else: ?>
				<h1><?php echo __( 'Support Request' ); ?></h1>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Request', array(
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
			<?php
				$email = Auth::user('email');
				if (empty($email) || (trim($email) == '')):
			?>
			<div class="row">
				<div class="col-lg-12 alert alert-danger">
					You have not set up an email address on Catalyst, so the support team will be unable to reply to your request. Please <?php
						$user_id = Auth::user('id');
						echo $this->Html->link( __( 'edit your profile' ), array( 'controller' => 'users', 'action' => 'change_email', $user_id ), array('class' => 'alert-link') );
					?> to rectify this.<!-- <br />
					If you cannot add an email address at this time, please include contact details in your request. -->
				</div>
			</div>
			<?php
				else:
			?>
			<div class="row">
				<div class="col-lg-6">
					<?php
						$current_user = Auth::user();
						
					?>
					<div class="form-group">
						<?php echo $this->Form->label( 'from', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'from', array('disabled' => 'disabled', 'value' => "{$current_user['forename']} {$current_user['surname']} <{$current_user['email']}> ({$all_centres})") ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'subject' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'subject', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'subject' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'text' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'text', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'text' ); ?>
						</div>
					</div>
					<br/>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit"
							        class="btn btn-primary btn-block btn-lg visible-xs visible-sm"><?php echo __( 'Submit' ); ?></button>
							<button type="submit"
							        class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Submit' ); ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
			?>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List Support %s', __( 'Requests' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
