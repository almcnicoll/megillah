<div class="row">
	<div class='col-xs-12'>
		<h3><?php echo h($copy['Book']['title']); ?></h3>
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
						foreach ($copy['Book']['Author'] as $author) {
							echo $sep . "<span class='nowrap'>" . $this->html->link( $author['full_name'], array('controller' => 'author', 'action' => 'view', $author['id']) ) . "</span>";
							$sep = ' / ';
						}
					?>
				</dd>
				<dt><?php echo __('Publisher'); ?></dt>
				<dd>
					<?php
					if (empty($copy['Book']['Imprint']['name'])) {
						echo h('Unknown');
					} else {
						echo h($copy['Book']['Imprint']['name']);
						if ( (!empty($copy['Book']['Imprint']['Publisher']['name'])) 
						 && ($copy['Book']['Imprint']['name'] != $copy['Book']['Imprint']['Publisher']['name']) ) {
							echo h(" ({$copy['Book']['Imprint']['name']})");
						}
					}
					?>
				</dd>
				<dt><?php echo __('Published'); ?></dt>
				<dd>
					<?php echo h($copy['Book']['year']); ?>
				</dd>
				<dt><?php echo __('Classification'); ?></dt>
				<dd>
					<?php echo h($copy['Book']['classification']); ?>
				</dd>
				<dt><?php echo __('ISBN'); ?></dt>
				<dd>
					<?php echo h($copy['Book']['ISBN']); ?>
				</dd>
			</dl>
		</div>
	</div>
	<div class='col-md-9'>
		<div class='row'>
			<h3>Recent Loans</h3>
			<table class='table'>
				<tr>
					<th>Borrowed</th>
					<th>Status</th>
					<th>Due back</th>
				</tr>
				<?php
					foreach ($copy['Loan'] as $loan) {
						echo "\t\t\t\t<tr>\n";
						echo "\t\t\t\t\t<td>" . $this->ViewPlus->fmtDate($loan['start_date']) . "</td>\n";
						if (empty($loan['returned_date'])) {
							$available = false;
							$borrower = $loan['User'];
							break;
						} else {
							$available = true;
							$borrower = '';
						}
							
						if ($available) {
							echo "\t\t\t\t\t<td>Returned</td>\n";
							echo "\t\t\t\t\t<td>&mdash;</td>\n";
						} else {
							echo "\t\t\t\t\t<td>On loan to {$borrower['full_name']}</td>\n";
							echo "\t\t\t\t\t<td>".$this->ViewPlus->fmtDate($loan['due_date'])."</td>\n";
						}						
						echo "\t\t\t\t</tr>\n";
					}
				?>
			</table>
		</div>
	</div>
</div>
<?php
	//echo "<pre>"; print_r($book); echo "</pre>";
?>