<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Debt Category' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<dl class="dl-horizontal">
			<dt><?php echo __( 'Name' ); ?></dt>
			<dd>
				<?php echo h( $debtCategory['DebtCategory']['name'] ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Type' ); ?></dt>
			<dd>
				<?php echo DebtCategory::types( $debtCategory['DebtCategory']['type'] ); ?>
				&nbsp;
			</dd>
			<dt><?php echo __( 'Created' ); ?></dt>
			<dd>
				<?php echo $this->Time->format( $debtCategory['DebtCategory']['created'], '%A, %d %B %Y, %H:%M' ); ?>
				&nbsp;
			</dd>
			<?php if ( $debtCategory['DebtCategory']['created'] !== $debtCategory['DebtCategory']['modified'] ) { ?>
				<dt><?php echo __( 'Modified' ); ?></dt>
				<dd>
					<?php echo $this->Time->format( $debtCategory['DebtCategory']['modified'], '%A, %d %B %Y, %H:%M' ); ?>
					&nbsp;
				</dd>
			<?php } ?>
		</dl>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Debt Category' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Debt Category' ) ), array(
					'action' => 'edit',
					$debtCategory['DebtCategory']['id']
				) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Debt Category' ) ), array(
					'action' => 'delete',
					$debtCategory['DebtCategory']['id']
				), array( 'class' => 'text-danger' ), __( 'Are you sure you want to delete this debt category?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Debt Categories' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
