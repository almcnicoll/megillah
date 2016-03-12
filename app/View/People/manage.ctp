<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $client['Client']['code'], $client['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $client['Client']['id']
		) ); ?>
		<br/>
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'complete_name', 'Name' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'role' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'age' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $people ) ): ?>
				<tr>
					<td class="text-center" colspan="4">
						<span><?php echo __( 'No Related People Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $people as $person ): ?>
					<tr>
						<td><?php echo h( $person['Person']['complete_name'] ); ?></td>
						<td><?php echo Person::roles( $person['Person']['role'] ); ?></td>
						<td><?php echo h( $person['Person']['age'] ); ?></td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ),
								array( 'action' => 'view', $person['Person']['id'] ) ); ?>
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Person' ) ),
					array( 'action' => 'add', $client['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
                                'cfs_licence_number' => $client['Centre']['cfs_licence_number'],
                                'centre_id'          => $client['Centre']['id'],
                                'client_code'        => $client['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>
