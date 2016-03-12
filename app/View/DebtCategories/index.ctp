<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Debt Categories' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'type' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $debtCategories ) ): ?>
				<tr>
					<td class="text-center" colspan="3">
						<span><?php echo __( 'No Debt Categories Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $debtCategories as $debtCategory ): ?>
					<tr>
						<td>
							<?php echo h( $debtCategory['DebtCategory']['name'] ); ?>
						</td>
						<td>
							<?php echo DebtCategory::types( $debtCategory['DebtCategory']['type'] ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$debtCategory['DebtCategory']['id']
							) ); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Debt Category' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
