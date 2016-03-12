<div class="row">
	<div class="col-xs-12 loans form">
	<?php echo $this->Form->create('Loan'); ?>
		<fieldset>
			<legend><?php echo __('Check Out Book'); ?></legend>
			<div class='row'>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('confirm', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('start_date', array('type' => 'hidden', 'value' => date('Y-m-d H:i:s'))); ?>
				<?php echo $this->Form->input('user_id',  array('type' => 'hidden', 'value' => $user['id'])); ?>
				<div class='col-sm-6'><?php echo $this->Form->input('legacy_book_number', array('label' => 'Book Number', 'type' => 'number', 'id' => 'legacy_book_number', 'class' => 'autoajax form-control', 'data-autoajax-url' => '/megillah/copies/lookup', 'data-autoajax-post-fields' => 'legacy_book_number,legacy_check_number,available_only')); ?></div>
				<div class='col-sm-6'><?php echo $this->Form->input('legacy_check_number', array('label' => 'Check Number', 'type' => 'number', 'id' => 'legacy_check_number', 'class' => 'autoajax form-control', 'data-autoajax-url' => '/megillah/copies/lookup', 'data-autoajax-post-fields' => 'legacy_book_number,legacy_check_number,available_only')); ?></div>
				<?php echo $this->Form->input('available_only', array('type' => 'hidden', 'id' => 'available_only', 'value' => true)); ?>
				<?php echo $this->Form->input('copy_id',  array('type' => 'hidden', 'value' => 0)); ?>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h3 class='panel-title'><a href='#' onclick='return false;'><span class='glyphicon glyphicon-chevron-right'></span>Verify</a></h3>
					</div>
					<div class='panel-body'>
						<div id='LookupSuccessMessage' class='label label-success'></div>
						<div id='LookupErrorMessage' class='label label-danger'></div>
					</div>
				</div>
			</div>
		</fieldset>
		
		
		<?php
			$submit_options = array('label' => 'Check Out', 'class' => 'hidden', 'id' => 'check_in_submit', 'div' => false);
			echo $this->Form->end($submit_options);
		?>
	</div>
</div>