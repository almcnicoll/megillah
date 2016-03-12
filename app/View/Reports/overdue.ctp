<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Overdue Reports' ); ?></h1>
		</div>
	</div>
</div>
<!--
<pre>
<?php
print_r($loans);
//die();
?>
-->
</pre>
<div class="row">
	<div class="col-xs-12">
		<div class='table-responsive'>
			<table class='table table-striped table-hover table-condensed' style='width: 100%;'>
				<tr>
					<th>User</th>
					<th>Book</th>
					<th>Due back</th>
				</tr>
			<?php
				foreach($loans as $loan) {
					$authors = array();
					foreach ($loan['Copy']['Book']['Author'] as $author) {
						$authors[] = $author['full_name'];
					}
					if (count($authors)==0) {
						$authors = '';
					} else {
						$authors = ' (' . implode(', ',$authors) . ')';
					}
					echo "\t\t\t\t<tr>\n";
					echo "\t\t\t\t\t<td>{$loan['User']['last_name']}, {$loan['User']['first_name']} (#{$loan['User']['id']})</td>\n";
					echo "\t\t\t\t\t<td>{$loan['Copy']['Book']['title']}{$authors} (copy {$loan['Copy']['id']} / book #{$loan['Copy']['legacy_book_number']})</td>\n";
					echo "\t\t\t\t\t<td>".date('jS M Y',strtotime($loan['Loan']['due_date']))."</td>\n";
					echo "\t\t\t\t</tr>\n";
				}
			?>
			</table>
		</div>
	</div>
</div>
