<?php
	$this->Helpers->load('DocumentManager.DocumentManager');
//echo "<pre>"; print_r($pathFolderNames); print_r($folder); echo "</pre>";
	$foldername = $folder['name'];
?>
<div class="name-index folder span6">
	<?php echo $this->Html->link(
		$this->DocumentManager->desanitiseName($foldername) . '/',
		array_merge(
			$pathFolderNames,
			array($foldername)
		)
	); ?>
</div>
<div class="folder-actions btn-group span6">
	<?php echo $this->Html->link(
		__d("document_manager", "Ouvrir"),
		array_merge(
			$pathFolderNames,
			array($foldername)
		),
		array('class' => 'btn edit')
	); ?>
	<?php if ($folder['writeable']) { echo $this->Html->link(
		__d("document_manager", "Supprimer"),
		array_merge(
			$pathFolderNames,
			array(
				'action' => 'delete_folder',
				'folder' => $folder['name'],
			)
		),
		array('class' => 'btn btn-danger ajax-delete confirm', 'title' => __d("document_manager", "Etes-vous certain de vouloir supprimer cette entrée ?"))
	); } ?>
</div>
<div class="clear"></div>
