<?php /*echo $this->Html->script('jquery-highlight/jquery-highlight.js', array('inline' => false));*/ ?>
<?php
	function highlightKeyword($haystack, $needles, $class = 'highlight') {
		$needle = implode('|',$needles);
		$bare_text = strip_tags($haystack);
		$safe_haystack = str_replace($bare_text, '{{string}}', $haystack);
		$styled_text = preg_replace("/({$needle})/i", sprintf('<span class="%s">$1</span>', $class), $bare_text);
		return str_replace('{{string}}', $styled_text, $safe_haystack);
		//return preg_replace("/({$needle})/i", sprintf('<span class="%s">$1</span>', $class), $haystack ); // This is not tag-safe
	}
	
	$results_categories = array(
		'title' => 'Results by title',
		'author' => 'Results by author',
		'taxonomy' => 'Results by keyword',
	);
	
	if (isset($results)) {
		$search_terms = explode(' ',$this->request->query['search_string']);
		echo "<h3>".__('Search results for ')."\"{$this->request->query['search_string']}\"</h3>\n";
		foreach ($results_categories as $key => $descriptor) {
			if (isset($results[$key]) && (count($results[$key])>0)) {
				echo "<h4>{$descriptor} (".count($results[$key]).")</h4>\n";
				echo "<table id='search-results-{$key}' class='table table-hover search-results'>\n";
				echo "\t<tr>\n";
				echo "\t\t<th>Book</th>\n";
				echo "\t\t<th>Author(s)</th>\n";
				echo "\t\t<th>Copies<br />Avail./Total</th>\n";
				echo "\t</tr>\n";
				foreach ($results[$key] as $result) {
					echo "\t<tr>\n";
					echo "\t\t<td>".highlightKeyword($this->Html->link($result['Book']['title'], array('controller' => 'books', 'action' => 'view', $result['Book']['id'])), $search_terms, 'text-primary highlight')."</td>\n";
					/*$author_ids = explode(',', $result[0]['AuthorId']);
					$author_first_names = explode(',', $result[0]['AuthorFirstNames']);
					$author_last_names = explode(',', $result[0]['AuthorLastName']);*/
					echo "\t\t<td>";
					$sep = '';
					foreach ($result['Author'] as $author) {
					//for($i=0; $i<count($author_ids); $i++) {
						//echo $sep . highlightKeyword($this->Html->link($author_last_names[$i].', '.$author_first_names[$i], array('controller' => 'authors', 'action' => 'view', $author_ids[$i])), $search_terms, 'text-primary highlight');
						echo $sep . highlightKeyword($this->Html->link($author['last_name'].', '.$author['first_names'], array('controller' => 'authors', 'action' => 'view', $author['id'])), $search_terms, 'text-primary highlight');
						$sep = ' / ';
					}
					$total_copies = 0; $available_copies = 0;
					foreach ($result['Copy'] as $copy) {
						$total_copies++;
						$on_loan = false;
						foreach ($copy['Loan'] as $loan) {
							$on_loan |= (empty($loan['returned_date']));
						}
						if (!$on_loan) { $available_copies++; }
					}
					echo "</td>\n";
					echo "\t\t<td>".($available_copies)." / ".($total_copies)."</td>\n";
					echo "\t</tr>\n";
				}
				echo "</table>";
			}
		}
		//echo "<pre>".print_r($results,true)."</pre>";
		/*echo $this->Html->scriptBlock(<<<END_SCRIPT
	$('.search-results td').highlight('read');
END_SCRIPT
			, array('inline' => false));*/
	}
?>
<div class='row'>
	<div class='col-md-6'>
		<div class="books form">
		<?php echo $this->Form->create('Book', array( 'type' => 'post' )); ?>
			<fieldset>
				<legend><?php echo __('Quick lookup'); ?></legend>
				<?php
					echo $this->Form->input('book_title', array(
					'type' => 'text',
					'label' => false,
					'class' => 'autocomplete-ui autocomplete form-control',
					'data-autocomplete-source' => '/megillah/books/lookup?available=1',
					'data-autocomplete-delay' => 500,
					'data-autocomplete-select' => <<<END_JS
		function (event, ui) {
			$("#BookBookTitle").val(stripHTML(ui.item.label));
			$("#BookBookId").val(ui.item.value);
			$('#BookSearchForm').submit();
			return false;
		}
END_JS
				));
				echo $this->Form->input('book_id',
					array(
						'type' => 'hidden',
					)
				);
				?>
			</fieldset>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class='col-md-6'>
		<div class="search form">
		<?php echo $this->Form->create('Search', array( 'type' => 'get' )); ?>
			<fieldset>
				<legend><?php echo __('Library Search'); ?></legend>
				<div class='input-group'>
					<?php
						echo $this->Form->input('search_string', array('label' => false));
					?>
					<span class='input-group-btn'><button type='submit' class='btn btn-primary'>Search</button></span>
				</div>
			</fieldset>
			
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Loan'), array('controller' => 'loans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Authors'), array('controller' => 'authors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author'), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Taxonomies'), array('controller' => 'taxonomies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Taxonomy'), array('controller' => 'taxonomies', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->