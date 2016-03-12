<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Expense Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<dl class="dl-horizontal">
			<dt><?php echo __( 'Name' ); ?></dt>
			<dd>
				<?php echo h( $expenseCategory['ExpenseCategory']['name'] ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Code' ); ?></dt>
			<dd>
				<?php echo h( $expenseCategory['ExpenseCategory']['code'] ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Finance Category' ); ?></dt>
			<dd>
				<?php echo $this->Html->link( $expenseCategory['FinanceCategory']['name'], array(
					'controller' => 'finance_categories',
					'action'     => 'view',
					$expenseCategory['FinanceCategory']['id']
				) ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Trigger Category' ); ?></dt>
			<dd>
				<?php echo $this->Html->link( $expenseCategory['TriggerCategory']['name'], array(
					'controller' => 'trigger_categories',
					'action'     => 'view',
					$expenseCategory['TriggerCategory']['id']
				) ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Created' ); ?></dt>
			<dd>
				<?php echo $this->Time->format( $expenseCategory['ExpenseCategory']['created'], '%A, %d %B %Y, %H:%M' ); ?>
				&nbsp;
			</dd>
			<?php if ( $expenseCategory['ExpenseCategory']['created'] !== $expenseCategory['ExpenseCategory']['modified'] ) { ?>
				<dt><?php echo __( 'Modified' ); ?></dt>
				<dd>
					<?php echo $this->Time->format( $expenseCategory['ExpenseCategory']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
					&nbsp;
				</dd>
			<?php } ?>
		</dl>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Expense Category' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Expense Category' ) ), array(
					'action' => 'edit',
					$expenseCategory['ExpenseCategory']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Expense Category' ) ), array(
					'action' => 'delete',
					$expenseCategory['ExpenseCategory']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this expense category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Expense Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
