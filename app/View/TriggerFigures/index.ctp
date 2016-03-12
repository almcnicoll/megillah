<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Trigger Figures' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo __( 'Category' ); ?></th>
				<th><?php echo h( TriggerFigure::types( TriggerFigure::TYPE_FIRST_ADULT ) ); ?></th>
				<th><?php echo h( TriggerFigure::types( TriggerFigure::TYPE_ADDITIONAL_ADULT ) ); ?></th>
				<th><?php echo h( TriggerFigure::types( TriggerFigure::TYPE_CHILD_OVER_14 ) ); ?></th>
				<th><?php echo h( TriggerFigure::types( TriggerFigure::TYPE_CHILD_UNDER_14 ) ); ?></th>
				<th><?php echo h( TriggerFigure::types( TriggerFigure::TYPE_CAR ) ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $triggerCategories ) ): ?>
				<tr>
					<td class="text-center" colspan="2">
						<span><?php echo __( 'No Trigger Figures Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $triggerCategories as $triggerCategory ): ?>
					<tr>
						<td>
							<?php echo h( $triggerCategory['TriggerCategory']['name'] ); ?>
						</td>
						<?php for ( $i = 0; $i < 5; $i ++ ): ?>
							<td>
								<?php
								if ( ! empty( $triggerCategory['TriggerFigure'][ $i ] ) ) {
									echo $this->Number->currency( $triggerCategory['TriggerFigure'][ $i ]['value'], $triggerCategory['TriggerFigure'][ $i ]['Country']['Currency']['code'] );
								} else {
									echo $this->Number->currency( 0, 'GBP' );
								}
								?>
							</td>
						<?php endfor; ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<h4><?php echo __( 'Last Updated: %s', $this->Time->format( strtotime( '2015-08-03' ), '%d %B %Y' ) ); ?></h4>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Trigger Categories' ) ), array(
					'controller' => 'trigger_categories',
					'action'     => 'index'
				) ); ?></li>
		</ul>
	</div>
</div>
