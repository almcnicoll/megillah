<?php	
	$this->Helpers->load('DocumentManager.DocumentManager');
?>
<?php $this->Html->css('DocumentManager.style', null, array('block' => 'css')); ?>
<?php $this->Html->script(array(
	'DocumentManager.script',
	'DocumentManager.jquery.zclip.min'
) , array('block' => 'script')); ?>
<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
		<h1><?php
			echo __d("document_manager", "Gestion des documents");
			if (!empty($client['Person'][0]['id'])) {
				echo " :: {$client['Person'][0]['forename']} {$client['Person'][0]['surname']}";
			}
		?></h1>
		</div>
	</div>
</div>
<div class="row" id="files-top">
	<div class="col-md-10 col-md-push-2">
		<?php /* echo __d("document_manager", "Dossier: ") . $this->Html->link(
			sprintf("/ %s /", Configure::read('DocumentManager.baseDir')),
			array('action' => 'index')); */ ?>
<?php foreach ($pathFolderNames as $i => $pathFolderName): ?>
		<?php echo $this->Html->link(
			'[' . $this->DocumentManager->desanitiseName($pathFolderName) . ']',
			array_slice($pathFolderNames, 0, $i + 1)
		) . ' /'; ?>
<?php endforeach; ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Back to %s', __( 'Client' ) ), array( 'controller' => '../clients', 'action' => 'view', $this->Session->read('Documents.last_client_id') ) ); ?></li>
		</ul>
	</div>
	<div class="col-md-10 col-md-push-2 wrapper name-row even">
		<table class="table table-condensed table-hover"><tbody>
<?php if (count($pathFolderNames)): ?>
			<tr>
			<?php
				echo '<td>'.$this->Html->link(
					__d("document_manager", "Remonter dans l'arborescence"),
					count($pathFolderNames) > 1 ? array_slice($pathFolderNames, 0, count($pathFolderNames) - 1) : array('action' => 'index'),
					array('class' => 'backlink name-index')
				).'</td>';
			?>
			</tr>
<?php endif; ?>
<?php $i = 0; ?>
<?php foreach ($folders as $folder): ?>
			<tr class="<?php echo ++$i % 2  ? 'odd' : 'even'; ?>">
	<td>
		<?php echo $this->element('folder', compact('pathFolderNames', 'folder')); ?>
	</td>
			</tr>
<?php endforeach; ?>

<?php	foreach ($files as $file): ?>
			<tr class="<?php echo ++$i % 2  ? 'odd' : 'even'; ?>">
				<td>
					<?php echo $this->element('file', compact('pathFolderNames', 'file')); ?>
				</td>
			</tr>
<?php	endforeach; ?>
		</tbody></table>
	</div>
	<div class="col-md-10 col-md-push-2 wrapper name-row even">
		<!-- <?php echo $this->Form->create(false, array(
			'url' => array_merge(
				$pathFolderNames,
				array('action' => 'create_subfolder')
			)
		));
		$this->Form->unlockField('file');
		$this->Form->unlockField('newFile');
		?>
		<fieldset>
			<legend><?php echo __d("document_manager", "Créer un nouveau dossier"); ?></legend>
			<?php echo $this->Form->input('folderName', array(
				'div'=>'input text',
				'label' => __d("document_manager", "Nom du dossier"),
				'title' => __d("document_manager", "Choisissez un nom de dossier puis appuyez sur le bouton créer."),
				)); ?>
			<?php echo $this->Form->submit(__d("document_manager", "Créer"), array('div' => false, 'class' => 'btn')); ?>
			<div class="clear"></div>
		</fieldset>
		<?php echo $this->Form->end(); ?> -->


<?php if (!(empty($pathFolderNames) && Configure::read('DocumentManager.excludeRootFiles'))): ?>
		<?php echo $this->Form->create(false, array(
			'url' => array_merge(
				$pathFolderNames,
				array('action' => 'upload_file')
			),
			'enctype' => 'multipart/form-data'
		));
		/*$this->Form->unlockField('file');
		$this->Form->unlockField('newFile');*/
		?>
		<fieldset>
			<legend><?php echo __d("document_manager", "Ajouter un fichier"); ?></legend>
			<div class="control-group">
				<label class="control-label"><?php echo __d("document_manager", "Ajouter un fichier"); ?></label>
				<div class="controls">

					<?php echo $this->Form->file('file'); ?>
				</div>
			</div>
			<?php /*echo $this->Form->input('comments', array('type' => 'textarea', 'label' => __d("document_manager", "Description du fichier")));*/ ?>
			<?php echo $this->Form->submit(__d("document_manager", "Mettre en ligne"), array('div' => false, 'class' => 'btn')); ?>
			<div class="clear"></div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
<?php endif; ?>
	</div>
</div>