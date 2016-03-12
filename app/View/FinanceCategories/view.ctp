<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Finance Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $financeCategory['FinanceCategory']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Code' ); ?></dt>
					<dd>
						<?php echo h( $financeCategory['FinanceCategory']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Type' ); ?></dt>
					<dd>
						<?php echo FinanceCategory::types( $financeCategory['FinanceCategory']['type'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $financeCategory['FinanceCategory']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $financeCategory['FinanceCategory']['created'] !== $financeCategory['FinanceCategory']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $financeCategory['FinanceCategory']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<?php if ( ! empty( $financeCategory['TriggerFigure'] ) ): ?>
					<hr/>
					<h3><?php echo __( 'Trigger Figures' ); ?></h3>
					<dl class="dl-horizontal">
						<?php foreach ( $financeCategory['TriggerFigure'] as $triggerFigure ): ?>
							<dt><?php echo TriggerFigure::types( $triggerFigure['type'] ); ?></dt>
							<dd>
								<?php echo $this->Number->currency( $triggerFigure['value'], $triggerFigure['Country']['Currency']['code'] ); ?>
								&nbsp;
							</dd>
						<?php endforeach; ?>
					</dl>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Finance Category' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Finance Category' ) ), array(
					'action' => 'edit',
					$financeCategory['FinanceCategory']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Finance Category' ) ), array(
					'action' => 'delete',
					$financeCategory['FinanceCategory']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this finance category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Finance Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
