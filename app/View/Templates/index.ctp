<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Templates' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Template', array(
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
						<?php echo $this->Form->input( 'Template.search' ); ?>
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
					<th><?php echo $this->Paginator->sort( 'code' ); ?></th>
					<th><?php echo $this->Paginator->sort( 'Organisation.name' ); ?></th>
					<th><?php echo __( '' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if ( empty( $templates ) ): ?>
					<tr>
						<td class="text-center" colspan="4">
							<span><?php echo __( 'No Templates Found' ); ?></span>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach ( $templates as $template ): ?>
						<tr>
							<td>
								<?php echo h( $template['Template']['name'] ); ?>
							</td>
							<td>
								<?php echo h( $template['Template']['code'] ); ?>
							</td>
							<td>
								<?php echo $this->Html->link( $template['Organisation']['name'], array(
									'controller' => 'organisations',
									'action'     => 'edit',
									$template['Organisation']['id']
								) ); ?>
							</td>
							<td class="text-right">
								<?php echo $this->Html->link( __( 'View Details' ), array(
									'action' => 'view',
									$template['Template']['id']
								) ); ?>
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
					<th><?php echo $this->Paginator->sort( 'code' ); ?></th>
					<th><?php echo __( '' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if ( empty( $templates ) ): ?>
					<tr>
						<td class="text-center" colspan="3">
							<span><?php echo __( 'No Templates Found' ); ?></span>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach ( $templates as $template ): ?>
						<tr>
							<td>
								<?php echo h( $template['Template']['name'] ); ?>
							</td>
							<td>
								<?php echo h( $template['Template']['code'] ); ?>
							</td>
							<td class="text-right">
								<?php echo $this->Html->link( __( 'View Details' ), array(
									'action' => 'view',
									$template['Template']['id']
								) ); ?>
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Template' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
