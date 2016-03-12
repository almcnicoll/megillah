<?php
$this->TinyMCE->editor( array(
	'theme'    => 'modern',
	'selector' => 'textarea.mce',
	'plugins'  => 'fullscreen, preview',
	'toolbar'  => 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | fontselect | fontsizeselect | bullist numlist | fullscreen | preview'
) );
?>

<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo h( $client['Client']['code'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->Form->create( 'Letter', array(
			'inputDefaults' => array(
				'div'   => false,
				'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
				'label' => false
			),
			'role'          => 'form',
			'url'           => array(
				'controller' => 'letters',
				'action'     => 'download',
				$client['Client']['id']
			)
		) );
		$this->Form->unlockField( 'Export.format' );
		?>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="well well-sm">
					<div class="row">
						<?php echo $this->Form->input( 'Client.id', array( 'value' => $client['Client']['id'] ) ); ?>
						<div class="col-md-6 text-center">
							<?php
							echo $this->Form->select( 'Export.format', array(
								'DOC',
								'PDF'
							), array( 'class' => 'form-control', 'empty' => false ) );
							?>
						</div>
						<div class="col-md-6">
							<button id="download-letters-button" type="submit"
							        class="btn btn-primary btn-block disabled"><?php echo __( 'Download %s',
									__( 'Letters' ) ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="text-center"><input type="checkbox" id="check-all-letters" autocomplete="off"></th>
				<th><?php echo __( 'Letter' ); ?></th>
				<th><?php echo __( 'Created' ); ?></th>
				<th><?php echo __( '' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ( empty( $letters ) ): ?>
				<tr>
					<td class="text-center" colspan="4">
						<span><?php echo __( 'No Recent Letters Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $letters as $key => $letter ): ?>
					<tr>
						<td class="text-center">
							<?php echo $this->Form->checkbox( 'Letter.' . $key . '.id',
								array(
									'class'        => 'letter-checkbox',
									'value'        => $letter['Letter']['id'],
									'autocomplete' => 'off'
								) ); ?>
						</td>
						<td><?php echo h( $letter['Letter']['description'] ); ?></td>
						<td style="width: 25%;">
							<?php echo $this->Time->format( $letter['Letter']['created'],
								'%A, %d %B %Y, %H:%M' ); ?>
						</td>
						<td class="text-right" style="width: 10%;">
							<div class="dropdown">
								<a data-toggle="dropdown"
								   href="javascript:void(0)"><?php echo __( 'Actions' ); ?>
									&nbsp;<span class="caret"></span></a>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><?php echo $this->Html->link( __( 'View' ), array(
											'action' => 'view',
											$letter['Letter']['id'],
											'ext'    => 'pdf'
										), array( 'role' => 'menuitem', 'target' => '_blank' ) ); ?></li>
									<li><?php echo $this->Html->link( __( 'Edit' ), 'javascript:void(0)', array(
											'class'          => 'edit-letter',
											'data-letter-id' => $letter['Letter']['id'],
											'role'           => 'menuitem'
										) ); ?></li>
								</ul>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Back to Client' ),
					array( 'controller' => 'clients', 'action' => 'view', $client['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
				'cfs_licence_number' => $client['Centre']['cfs_licence_number'], 'centre_id' => $client['Centre']['id'], 'client_code' => $client['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<div class="modal fade" id="content-modal" tabindex="-1" role="dialog" aria-labelledby="content-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="content-modal-label"><?php echo __( 'Edit Letter Content' ); ?></h4>
			</div>
			<div class="modal-body" style="height: 75vh;">
				<div class="form-group">
					<?php echo $this->Form->hidden( 'Letter.id', array( 'required' => true ) ); ?>
					<?php echo $this->Form->input( 'Letter.content', array( 'class' => 'mce', 'required' => true ) ); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
				<button id="edit-letter-submit" type="button"
				        class="btn btn-primary"><?php echo __( 'Save' ); ?></button>
			</div>
		</div>
	</div>
</div>

<?php
$editLetterURL = $this->Html->url( array( 'action' => 'edit', 'ext' => 'json' ) );

$script = <<<EOT
	$('.letter-checkbox').on('change', function(event) {
		if ($('.letter-checkbox:checked').length !== 0) {
			$('#download-letters-button').removeClass('disabled');
		} else {
			$('#download-letters-button').addClass('disabled');
		}
	});

	$('#check-all-letters').on('change', function(event) {
		if ($(this).prop('checked')) {
			$('.letter-checkbox').prop('checked', true).change();
		} else {
			$('.letter-checkbox').prop('checked', false).change();
		}
	});

	$('.edit-letter').on('click', function(event) {
		var letterID = $(this).data('letter-id');
		$('#LetterId').val(letterID);
		$.ajax({
			async: true,
			data: { letter_id: letterID },
			type: 'POST',
			url: '{$editLetterURL}'
		}).done(function(json) {
			if (json.content) {
				tinymce.activeEditor.setContent(json.content.Letter.content);
				tinymce.activeEditor.dom.hide(tinymce.activeEditor.dom.select('#letter-header'));
				tinymce.activeEditor.dom.hide(tinymce.activeEditor.dom.select('#letter-footer'));
				$('#content-modal').modal();
			} else {
				alert('Error: No Content.');
			}
		});
	});

	$('#edit-letter-submit').on('click', function(event) {
		tinymce.activeEditor.dom.show(tinymce.activeEditor.dom.select('#letter-header'));
		tinymce.activeEditor.dom.show(tinymce.activeEditor.dom.select('#letter-footer'));
		var post = $.post('{$editLetterURL}', { letter_id: $('#LetterId').val(), content: tinymce.activeEditor.getContent() });
		$('#content-modal').modal('hide');
	});
EOT;

$this->Js->buffer( $script );
?>
