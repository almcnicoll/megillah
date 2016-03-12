<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Logged back in' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h3>You have successfully logged back in.</h3>
		<h4>This tab will close in 10 seconds, after which you can return to your work.</h4>
		<p>If the tab fails to close, you can do so manually.</p>
	</div>
</div>
<?php
	$this->Js->buffer(
<<<EOS
window.closer = setTimeout('window.close();', 10*1000);
EOS
	);
?>