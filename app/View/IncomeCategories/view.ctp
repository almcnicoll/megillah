<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Income Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<dl class="dl-horizontal">
			<dt><?php echo __( 'Name' ); ?></dt>
			<dd>
				<?php echo h( $incomeCategory['IncomeCategory']['name'] ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Finance Category' ); ?></dt>
			<dd>
				<?php echo $this->Html->link( $incomeCategory['FinanceCategory']['name'], array(
					'controller' => 'finance_categories',
					'action'     => 'view',
					$incomeCategory['FinanceCategory']['id']
				) ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Created' ); ?></dt>
			<dd>
				<?php echo $this->Time->format( $incomeCategory['IncomeCategory']['created'], '%A, %d %B %Y, %H:%M' ); ?>
				&nbsp;
			</dd>
			<?php if ( $incomeCategory['IncomeCategory']['created'] !== $incomeCategory['IncomeCategory']['modified'] ) { ?>
				<dt><?php echo __( 'Modified' ); ?></dt>
				<dd>
					<?php echo $this->Time->format( $incomeCategory['IncomeCategory']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
					&nbsp;
				</dd>
			<?php } ?>
		</dl>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Income Category' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Income Category' ) ), array(
					'action' => 'edit',
					$incomeCategory['IncomeCategory']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Income Category' ) ), array(
					'action' => 'delete',
					$incomeCategory['IncomeCategory']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this income category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Income Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
