<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Questions' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Question', array(
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
					<div class="form-group <?php echo ( $this->Form->error( 'text' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'text', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'text' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'type' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'type', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'type', array( 'options' => Question::types() ) ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'role' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'role', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'role',
								array( 'options' => Question::roles() ) ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'rank' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'rank', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'rank' ); ?>
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
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Questions' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
