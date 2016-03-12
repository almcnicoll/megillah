<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Advisers' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'User', array(
			'inputDefaults' => array(
				'div' => false,
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
						<?php echo $this->Form->input( 'User.search' ); ?>
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
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?php echo $this->Paginator->sort( 'full_name', 'Name' ); ?></th>
				<th><?php echo $this->Paginator->sort( 'username' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $users ) ): ?>
				<tr>
					<td class="text-center" colspan="3">
						<span><?php echo __( 'No Users Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $users as $user ): ?>
					<tr>
						<td>
							<?php echo h( $user['User']['full_name'] ); ?>
						</td>
						<td>
							<?php echo h( $user['User']['username'] ); ?>
						</td>
						<td class="text-right">
							<?php echo $this->Html->link( __( 'View Details' ), array(
								'action' => 'view',
								$user['User']['id']
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
			<li><?php echo $this->Html->link( __( 'New %s', __( 'User' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
