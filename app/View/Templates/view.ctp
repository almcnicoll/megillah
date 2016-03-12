<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Template' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<?php
				if ( empty( $template['Template']['organisation_id'] ) ):
					?>
					<div class="alert alert-info">
						<?php echo __( 'Default Template' ); ?>
					</div>
				<?php
				endif;
				?>
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Name' ); ?></dt>
					<dd>
						<?php echo h( $template['Template']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Code' ); ?></dt>
					<dd>
						<?php echo h( $template['Template']['code'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $template['Template']['description'] ) ): ?>
						<dt><?php echo __( 'Description' ); ?></dt>
						<dd>
							<?php echo h( $template['Template']['description'] ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Type' ); ?></dt>
					<dd>
						<?php echo h( $template['TemplateType']['name'] ); ?>
						&nbsp;
					</dd>
					<?php if ( ! empty( $template['Template']['organisation_id'] ) && ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ): ?>
						<dt><?php echo __( 'Organisation' ); ?></dt>
						<dd>
							<?php echo $this->Html->link( $template['Organisation']['name'], array(
								'controller' => 'organisations',
								'action'     => 'view',
								$template['Organisation']['id']
							) ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $template['Template']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $template['Template']['created'] !== $template['Template']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $template['Template']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Preview %s', __( 'Template' ) ), array(
					'action' => 'preview',
					$template['Template']['id'],
					'ext'    => 'pdf'
				), array( 'target' => '_blank' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Template' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Template' ) ), array(
					'action' => 'edit',
					$template['Template']['id']
				) ); ?></li>
			<?php if ( ( empty( $template['Template']['organisation_id'] ) && ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) ) || ! empty( $template['Template']['organisation_id'] ) ): ?>
				<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Template' ) ), array(
						'action' => 'delete',
						$template['Template']['id']
					), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this template?' ) ); ?></li>
			<?php endif; ?>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Templates' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
