<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Currency' ); ?></h1>
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
						<?php echo h( $currency['Currency']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Code' ); ?></dt>
					<dd>
						<?php echo h( $currency['Currency']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $currency['Currency']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $currency['Currency']['created'] !== $currency['Currency']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $currency['Currency']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<h3><?php echo __( 'Related %s', __( 'Countries' ) ); ?></h3>
				<table class="table table-condensed table-hover">
					<thead>
					<tr>
						<th><?php echo __( 'Name' ); ?></th>
						<th><?php echo __( 'Code' ); ?></th>
						<th><?php echo __( '' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if ( empty( $currency['Country'] ) ): ?>
						<tr>
							<td class="text-center" colspan="3">
								<span><?php echo __( 'No Related Country Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $currency['Country'] as $country ): ?>
							<tr>
								<td><?php echo $country['name']; ?></td>
								<td><?php echo $country['code']; ?></td>
								<td class="text-right">
									<?php echo $this->Html->link( __( 'View Details' ), array(
										'controller' => 'countries',
										'action'     => 'view',
										$country['id']
									) ); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Currency' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Currency' ) ), array(
					'action' => 'edit',
					$currency['Currency']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Currency' ) ), array(
					'action' => 'delete',
					$currency['Currency']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this currency?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Currencies' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
