<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Trigger Category' ); ?></h1>
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
						<?php echo h( $triggerCategory['TriggerCategory']['name'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $triggerCategory['TriggerCategory']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $triggerCategory['TriggerCategory']['created'] !== $triggerCategory['TriggerCategory']['modified'] ): ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $triggerCategory['TriggerCategory']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php endif; ?>
				</dl>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Trigger Category' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Trigger Category' ) ), array(
					'action' => 'edit',
					$triggerCategory['TriggerCategory']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Trigger Category' ) ), array(
					'action' => 'delete',
					$triggerCategory['TriggerCategory']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this trigger category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Trigger Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
