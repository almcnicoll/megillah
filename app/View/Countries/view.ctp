<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Country' ); ?></h1>
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
						<?php echo h( $country['Country']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Code' ); ?></dt>
					<dd>
						<?php echo h( $country['Country']['code'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Currency' ); ?></dt>
					<dd>
						<?php echo $this->Html->link( $country['Currency']['name'], array(
							'controller' => 'currencies',
							'action'     => 'view',
							$country['Currency']['id']
						) ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $country['Country']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $country['Country']['created'] !== $country['Country']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $country['Country']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<hr/>
				<h3><?php echo __( 'Related %s', __( 'Organisations' ) ); ?></h3>
				<table class="table table-condensed table-hover">
					<thead>
					<tr>
						<th><?php echo __( 'Name' ); ?></th>
						<th><?php echo __( 'Code' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if ( empty( $country['Organisation'] ) ): ?>
						<tr>
							<td class="text-center" colspan="3">
								<span><?php echo __( 'No Related Organisation Found' ); ?></span>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ( $country['Organisation'] as $organisation ): ?>
							<tr>
								<td><?php echo $organisation['name']; ?></td>
								<td><?php echo $organisation['code']; ?></td>
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Country' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Country' ) ), array(
					'action' => 'edit',
					$country['Country']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Country' ) ), array(
					'action' => 'delete',
					$country['Country']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this country?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Countries' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
