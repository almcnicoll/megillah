<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Creditors' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Creditor', array(
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
				<div class="col-md-12">
					<div class="input-group">
						<?php echo $this->Form->input( 'Creditor.search' ); ?>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary"><?php echo __( 'Search' ); ?></button>
							<?php echo $this->Html->link( __( 'Reset' ), array(
								'action' => 'index',
							), array( 'class' => 'btn btn-default' ) ); ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<?php
		if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ):
			?>
			<table class="table table-condensed table-hover">
				<thead>
				<tr>
					<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
					<th><?php echo $this->Paginator->sort( 'display_name' ); ?></th>
					<th><?php echo $this->Paginator->sort( 'Organisation.name' ); ?></th>
					<th><?php echo __( '' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if ( empty( $creditors ) ): ?>
					<tr>
						<td class="text-center" colspan="3">
							<span><?php echo __( 'No Creditors Found' ); ?></span>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach ( $creditors as $creditor ): ?>
						<tr>
							<td>
								<?php echo h( $creditor['Creditor']['name'] ); ?>
							</td>
							<td>
								<?php echo h( $creditor['Creditor']['display_name'] ); ?>
							</td>
							<td>
								<?php echo h( $creditor['Organisation']['name'] ); ?>
							</td>
							<td class="text-right">
								<?php echo $this->Html->link( __( 'View Details' ),
									array( 'action' => 'view', $creditor['Creditor']['id'] ) ); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		<?php
		else:
			?>
			<table class="table table-condensed table-hover">
				<thead>
				<tr>
					<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
					<th><?php echo $this->Paginator->sort( 'display_name' ); ?></th>
					<th><?php echo __( '' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if ( empty( $creditors ) ): ?>
					<tr>
						<td class="text-center" colspan="3">
							<span><?php echo __( 'No Creditors Found' ); ?></span>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach ( $creditors as $creditor ): ?>
						<tr>
							<td>
								<?php echo h( $creditor['Creditor']['name'] ); ?>
							</td>
							<td>
								<?php echo h( $creditor['Creditor']['display_name'] ); ?>
							</td>
							<td class="text-right">
								<?php echo $this->Html->link( __( 'View Details' ),
									array( 'action' => 'view', $creditor['Creditor']['id'] ) ); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		<?php
		endif;
		?>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Creditor' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
