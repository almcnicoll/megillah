<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Borrower Centre' ); ?></h1>
		</div>
	</div>
</div>
<!-- <pre>
<?php
print_r($loans);
?>
</pre> -->
<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="well well-sm">
			<div class="row">
				<div class="col-md-12"><h3>
					<?php echo __('Current Loans'); ?>
				</h3></div>
			</div>
			<?php
			if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ):
				?>
				<!-- Admin-only stuff here -->
			<?php
			endif;
			?>
			<table class="table table-condensed table-hover">
				<thead>
				<tr>
					<th><?php echo $this->Paginator->sort( 'due_date' ); ?></th>
					<th><?php echo $this->Paginator->sort( 'name' ); ?></th>
					<th><?php echo __( '' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php if ( empty( $loans ) ): ?>
					<tr>
						<td class="text-center" colspan="3">
							<span><?php echo __( 'You do not currently have any books on loan' ); ?></span>
						</td>
					</tr>
				<?php else: ?>
					<?php foreach ( $loans as $loan ): ?>
						<tr>
							<td>
								<?php
									if (strtotime($loan['Loan']['due_date']) < time()) {
										// Overdue
										echo "<span style='color: red;' class='overdue'>" . h( $loan['Loan']['due_date'] ) . "</span>";
									} else {
										// Not yet due
										echo h( $loan['Loan']['due_date'] );
									}
								?>
							</td>
							<td>
								<?php echo h( $loan['Copy']['Book']['title'] ); ?>
							</td>
							<td class="text-right">
								<?php echo $this->Html->link( __( 'View Details' ),
									array( 'controller' => 'loans', 'action' => 'view', $loan['Loan']['id'] ) ); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<?php
			
			?>
			<?php echo $this->element( 'Tools.pagination' ); ?>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Check out Books' ), array( 'controller' => 'loans', 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Search Library' ), array( 'controller' => 'books', 'action' => 'search' ) ); ?></li>
		</ul>
	</div>
</div>
