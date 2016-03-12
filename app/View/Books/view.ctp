<div class="row">
	<div class='col-xs-12'>
		<h3><?php echo h($book['Book']['title']); ?></h3>
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
						foreach ($book['Author'] as $author) {
							echo $sep . "<span class='nowrap'>" . $this->html->link( $author['full_name'], array('controller' => 'author', 'action' => 'view', $author['id']) ) . "</span>";
							$sep = ' / ';
						}
					?>
				</dd>
				<dt><?php echo __('Publisher'); ?></dt>
				<dd>
					<?php
					if (empty($book['Imprint']['name'])) {
						echo h('Unknown');
					} else {
						echo h($book['Imprint']['name']);
						if ( (!empty($book['Imprint']['Publisher']['name'])) 
						 && ($book['Imprint']['name'] != $book['Imprint']['Publisher']['name']) ) {
							echo h(" ({$book['Imprint']['name']})");
						}
					}
					?>
				</dd>
				<dt><?php echo __('Published'); ?></dt>
				<dd>
					<?php echo h($book['Book']['year']); ?>
				</dd>
				<dt><?php echo __('Classification'); ?></dt>
				<dd>
					<?php echo h($book['Book']['classification']); ?>
				</dd>
				<dt><?php echo __('ISBN'); ?></dt>
				<dd>
					<?php echo h($book['Book']['ISBN']); ?>
				</dd>
			</dl>
		</div>
	</div>
	<div class='col-md-9'>
		<div class='row'>
			<h3>Copies</h3>
			<table class='table'>
				<tr>
					<th>Book #</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php
					foreach ($book['Copy'] as $copy) {
						echo "\t\t\t\t<tr>\n";
						echo "\t\t\t\t\t<td>" . $this->html->link( $copy['legacy_book_number'], array('controller' => 'copies', 'action' => 'view', $copy['id']) ) . "</td>\n";
						$available = true;
						$borrower = null;
						foreach ($copy['Loan'] as $loan) {
							if (empty($loan['returned_date'])) {
								$available = false;
								$borrower = $loan['User'];
								break;
							}
						}
						if ($available) {
							echo "\t\t\t\t\t<td>Available</td>\n";
							echo "\t\t\t\t\t<td>Borrow</td>\n";
						} else {
							echo "\t\t\t\t\t<td>On loan to {$borrower['full_name']}</td>\n";
							echo "\t\t\t\t\t<td>Reserve</td>\n";
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