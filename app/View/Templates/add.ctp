<?php
$this->TinyMCE->editor( array(
	'theme'    => 'modern',
	'selector' => 'textarea.mce',
	'plugins'  => 'fullscreen, preview, paste',
	'toolbar'  => 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | fontselect | fontsizeselect | bullist numlist | fullscreen | preview',
	'paste_as_text' => true
) );
?>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Template' ); ?></h1>
		</div>
	</div>
</div>

<?php echo $this->Form->create( 'Template', array(
	'class'         => 'form-horizontal',
	'inputDefaults' => array(
		'class' => 'form-control',
		'div'   => false,
		'error' => array(
			'attributes' => array(
				'wrap'  => 'span',
				'class' => 'help-block'
			)
		),
		'label' => false
	),
	'role'          => 'form'
) ); ?>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<fieldset>
			<legend><?php echo __( 'Add' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group <?php echo ( $this->Form->error( 'name' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'name', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'name' ); ?>
						</div>
					</div>
					<div class="form-group <?php echo ( $this->Form->error( 'code' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'code', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'code' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'description' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'description', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'description', array( 'type' => 'textarea' ) ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'reminder_delay' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'reminder_delay', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group">
								<?php echo $this->Form->input( 'reminder_delay', array( 'aria-describedby' => 'days-addon', 'min' => 0 ) ); ?>
								<span class="input-group-addon" id="days-addon"><?php echo __('Days'); ?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button id="open-content-modal" type="button"
							        class="btn btn-primary btn-block"><?php echo __( 'Edit Template Content' ); ?></button>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'template_type_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'template_type_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'template_type_id' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'organisation_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'organisation_id', null, array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php
							$allowEmpty = false;
							if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ) {
								$allowEmpty = true;
							}
							echo $this->Form->input( 'organisation_id', array( 'empty' => $allowEmpty ) );
							?>
						</div>
					</div>
					<br/>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit"
							        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Submit' ); ?></button>
							<button type="submit"
							        class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Submit' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Templates' ) ), array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<div class="modal fade" id="content-modal" tabindex="-1" role="dialog" aria-labelledby="content-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="content-modal-label"><?php echo __( 'Edit Template Content' ); ?></h4>
			</div>
			<div class="modal-body" style="height: 75vh;">
				<div class="form-group">
					<div class="panel-group" id="key-accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#key-accordion" href="#collapseOne">
										<?php echo __( 'Merge Field Key' ); ?>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
									<dl class="dl-horizontal" style="margin: 0;">
										<?php foreach ( $mergeFields as $mergeField ): ?>
											<dt><?php echo h( $mergeField['MergeField']['name'] ); ?></dt>
											<dd>&brvbar;<?php echo h( $mergeField['MergeField']['code'] ); ?>&brvbar;</dd>
										<?php endforeach; ?>
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input( 'content', array( 'class' => 'mce', 'required' => false ) ); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Done' ); ?></button>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Form->end(); ?>

<?php
$script = <<<EOT
    $('#open-content-modal').on('click', function(event) {
      $('#content-modal').modal();
    });
EOT;

$this->Js->buffer( $script );
?>
