<?php
$controllers = array(
	'clients'  => array( 'title' => __( 'Client Details' ), 'hidden' => false ),
	'people'   => array( 'title' => __( 'People' ), 'hidden' => false ),
	'finances' => array( 'title' => __( 'Income & Expenditure' ), 'hidden' => false ),
	'assets'   => array( 'title' => __( 'Assets' ), 'hidden' => false ),
	'debts'    => array( 'title' => __( 'Debts' ), 'hidden' => false ),
	'actions'  => array( 'title' => __( 'Progress Log' ), 'hidden' => false )
);

$controllers[ $controller ]['hidden'] = true;
$active                               = $controllers[ $controller ];
?>

<ul class="nav nav-tabs nav-justified" role="tablist">
	<li class="dropdown visible-xs">
		<a class="dropdown-toggle" role="tab" data-toggle="dropdown" href="javascript:void(0)">
			<?php echo __( '%s', $active['title'] ); ?>&nbsp;<span class="caret"></span> </a>
		<ul class="dropdown-menu">
			<?php foreach ( $controllers as $key => $controller ): ?>
				<?php if ( ! $controller['hidden'] ): ?>
					<?php if ( $key === 'clients' ): ?>
						<li><?php echo $this->Html->link( $controller['title'],
								array( 'controller' => $key, 'action' => 'view', $id ) ); ?></li>
					<?php else: ?>
						<li><?php echo $this->Html->link( $controller['title'],
								array( 'controller' => $key, 'action' => 'manage', $id ) ); ?></li>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php foreach ( $controllers as $key => $controller ): ?>
		<?php if ( $key === 'clients' ): ?>
			<li class="hidden-xs <?php echo( $controller['hidden'] ? 'active' : '' ); ?>"><?php echo $this->Html->link( $controller['title'],
					array( 'controller' => $key, 'action' => 'view', $id ), array( 'role' => 'tab' ) ); ?></li>
		<?php else: ?>
			<li class="hidden-xs <?php echo( $controller['hidden'] ? 'active' : '' ); ?>"><?php echo $this->Html->link( $controller['title'],
					array( 'controller' => $key, 'action' => 'manage', $id ), array( 'role' => 'tab' ) ); ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
