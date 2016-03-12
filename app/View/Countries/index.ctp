<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Countries' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'code' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $countries ) ): ?>
				<tr>
					<td class="text-center" colspan="3">
						<span><?php echo __( 'No Countries Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $countries as $country ): ?>
					<tr>
						<td>
							<?php echo h( $country['Country']['name'] ); ?>
						</td>
						<td>
							<?php echo h( $country['Country']['code'] ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$country['Country']['id']
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Country' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
