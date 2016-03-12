<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Clients' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Client', array(
			'inputDefaults' => array(
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'url'           => $this->params['pass']
		) ); ?>
		<div class="well well-sm">
			<div class="row">
				<div class="col-lg-8">
					<?php echo $this->Form->input( 'Client.search' ); ?>
				</div>
				<div class="col-lg-2">
					<?php echo $this->Form->input( 'Client.status', array(
						'options'  => Client::statuses(),
						'empty'    => __( '- Select Client Status -' ),
						'required' => false
					) ); ?>
				</div>
				<div class="col-lg-2">
					<div class="btn-group btn-group-justified">
						<div class="btn-group">
							<button type="submit" class="btn btn-primary"><?php echo __( 'Filter' ); ?></button>
						</div>
						<div class="btn-group">
							<?php echo $this->Html->link( __( 'Reset' ), array(
								'action' => 'index'
							), array( 'class' => 'btn btn-default' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'code' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'PrimaryPerson.full_name', __( 'Name' ) ); ?></th>
				<th><?php echo __( 'Address' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'created', __( 'Created Date' ) ); ?></th>
				<th><?php echo $this->Paginator->sort( 'status' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $clients ) ): ?>
				<tr>
					<td class="text-center" colspan="6">
						<span><?php echo __( 'No Clients Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $clients as $client ): ?>
					<tr>
						<td><?php echo h( $client['Client']['code'] ); ?></td>
						<td><?php echo h( $client['PrimaryPerson']['full_name'] ); ?></td>
						<td><?php if ( ! empty( $client['Client']['address_line_1'] ) ): ?>
								<?php echo h( $client['Client']['address_line_1'] ); ?>&#44;
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['address_line_2'] ) ): ?>
								<?php echo h( $client['Client']['address_line_2'] ); ?>&#44;
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['address_line_3'] ) ): ?>
								<?php echo h( $client['Client']['address_line_3'] ); ?>&#44;
							<?php endif; ?>
							<?php if ( ! empty( $client['Client']['city'] ) ): ?>
								<?php echo h( $client['Client']['city'] ); ?>
							<?php endif; ?>
						</td>
						<td>
							<?php echo $this->Time->format( $client['Client']['created'], '%d %B %Y' ); ?>
						</td>
						<td>
							<?php echo Client::statuses( $client['Client']['status'] ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$client['Client']['id']
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Client' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
