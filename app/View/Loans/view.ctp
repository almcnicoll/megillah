<?php
//	print_r($loan['Copy']);
	$copy = $loan['Copy'];
	$available = true;
	$borrower = null;
	
	if (empty($loan['Loan']['returned_date'])) {
		$available = false;
		$borrower = $loan['User'];
	}
?>
<div class="row">
	<div class='col-xs-12'>
		<h3><?php echo h($loan['Copy']['Book']['title']); ?></h3>
		<h4><?php echo "On loan to {$borrower['full_name']}"; ?></h4>
		<?php
			if (empty($loan['Loan']['returned_date'])) {
		?>
		<h4>
		Due back: <?php echo (new DateTime($loan['Loan']['due_date']))->format('d M Y'); ?>
		<?php
				if ((strtotime($loan['Loan']['due_date']) - time()) <= (7 * 24 * 60 * 60)) {
					echo " ("
						.$this->html->link( __('Renew'), array('controller' => 'loan', 'action' => 'renew', $loan['Loan']['id']))
						.")";
				}
			} else {
		?>
		</h4>
		<h4>Returned: <?php echo (new DateTime($loan['Loan']['returned_date']))->format('d M Y'); ?></h4>
		<?php
			}
		?>
	</div>
</div>
<div class="row">
	<div class='col-md-3'>
		<!-- <img src='img/no_image_available.png' /> -->
		<div style='text-align: center;'>
		<?php
			echo $this->Html->image( 'no_image_available.png', array( 'alt' => 'no image', 'width' => '200' ) );
		?>
		</div>
		
		<div class='row'>
			<dl class='dl-horizontal'>
				<dt><?php echo __('Author(s)'); ?></dt>
				<dd>
					<?php
						$sep = '';
						foreach ($loan['Copy']['Book']['Author'] as $author) {
							echo $sep . "<span class='nowrap'>" . $this->html->link( $author['full_name'], array('controller' => 'author', 'action' => 'view', $author['id']) ) . "</span>";
							$sep = ' / ';
						}
					?>
				</dd>
				<dt><?php echo __('Publisher'); ?></dt>
				<dd>
					<?php
					if (empty($loan['Imprint']['name'])) {
						echo h('Unknown');
					} else {
						echo h($loan['Imprint']['name']);
						if ( (!empty($loan['Imprint']['Publisher']['name'])) 
						 && ($loan['Imprint']['name'] != $loan['Imprint']['Publisher']['name']) ) {
							echo h(" ({$loan['Imprint']['name']})");
						}
					}
					?>
				</dd>
				<dt><?php echo __('Published'); ?></dt>
				<dd>
					<?php echo h($loan['Copy']['Book']['year']); ?>
				</dd>
				<dt><?php echo __('Classification'); ?></dt>
				<dd>
					<?php echo h($loan['Copy']['Book']['classification']); ?>
				</dd>
				<dt><?php echo __('ISBN'); ?></dt>
				<dd>
					<?php echo h($loan['Copy']['Book']['ISBN']); ?>
				</dd>
			</dl>
		</div>
	</div>
	
</div>
<?php
	//echo "<pre>"; print_r($loan); echo "</pre>";
?>