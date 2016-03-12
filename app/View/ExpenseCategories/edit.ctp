<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Expense Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'ExpenseCategory', array(
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
					<div class="form-group <?php echo ( $this->Form->error( 'code' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'code', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'code' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'finance_category_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'finance_category_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'finance_category_id' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'trigger_category_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'trigger_category_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'trigger_category_id' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'is_customisable' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'is_customisable', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->checkbox( 'is_customisable' ); ?>
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
					$this->Form->value( 'ExpenseCategory.id' )
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this expense category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Expense Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
