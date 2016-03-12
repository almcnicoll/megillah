<?php
	$this->Helpers->load('DocumentManager.DocumentManager');
?>
<li><?php echo $this->Html->link( __( 'New %s', __( 'Client' ) ),
		array( 'controller' => 'clients', 'action' => 'add' ) ); ?></li>
<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Client' ) ),
		array( 'controller' => 'clients', 'action' => 'edit', $id ) ); ?></li>
<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ): ?>
	<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Client' ) ),
			array( 'controller' => 'clients', 'action' => 'delete', $id ), array( 'class' => 'text-danger' ),
			__( 'Are you sure you want to delete this client?' ) ); ?></li>
<?php endif; ?>
<li><?php echo $this->Html->link( __( 'List %s', __( 'Clients' ) ),
		array( 'controller' => 'clients', 'action' => 'index' ) ); ?></li>
<li class="nav-divider"></li>
<?php if ( ! empty( $cfs_licence_number ) ): ?>
	<li><?php echo $this->Html->link( __( 'Financial Statement (CFS)' ),
			array(
				'controller' => 'finances',
				'action'     => 'statement',
				$id,
				'ext'        => 'pdf'
			), array( 'target' => '_blank' ) ); ?></li>
<?php else: ?>
	<li><?php echo $this->Html->link( __( 'Financial Statement (CFS)' ),
			'javascript:void(0)', array( 'id' => 'cfs-licence-link' ) ); ?></li>
<?php endif; ?>
<li><?php
		if ( ! empty( $centre_id) ) {
			$centre_text = 'centre' . str_pad($centre_id, 8, '0', STR_PAD_LEFT);
			echo $this->Html->link( __( 'Client Files' ), array( 'controller' => 'document_manager/documents', 'action' => 'index', $centre_text, $this->DocumentManager->sanitiseName($client_code), 'last_client_id' => $id ) );
		}
	?></li>
<li class="nav-divider"></li>
<li><?php echo $this->Html->link( __( 'Review Questions' ),
		array( 'controller' => 'clients', 'action' => 'review', $id ) ); ?></li>
<li><?php echo $this->Html->link( __( 'Recently Generated Letters' ),
		array( 'controller' => 'letters', 'action' => 'manage', $id ) ); ?></li>
