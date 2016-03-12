<div class="row">
	<div class="col-md-9 col-md-push-3">
		<h1><?php echo __( 'Answer' ); ?></h1>
		<?php echo $this->Form->create( 'Answer', array(
			'class'         => 'form-horizontal',
			'inputDefaults' => array(
				'class' => 'form-control',
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form'
		) ); ?>
		<fieldset>
			<legend><?php echo __( 'Add' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<div
						class="form-group <?php echo $this->Form->error( 'question_id' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'question_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'question_id' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo $this->Form->error( 'value' ) !== null ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'value', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'value' ); ?>
						</div>
					</div>
					<br/>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit"
							        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Submit' ); ?></button>
							<button type="submit"
							        class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Submit' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-3 col-md-pull-9">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Answers' ) ), array( 'action' => 'index' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Questions' ) ), array(
					'controller' => 'questions',
					'action'     => 'index'
				) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Client Responses' ) ), array(
					'controller' => 'client_responses',
					'action'     => 'index'
				) ); ?></li>
		</ul>
	</div>
</div>
