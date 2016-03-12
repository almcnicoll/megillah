<?php
$topMargin = 0;
if ( ! empty( $letter['Client']['Centre']['header_dir'] ) && ! empty( $letter['Client']['Centre']['header'] ) && ($letter['Letter']['description'] != 'Client Financial Statement')) {
	$header = WWW_ROOT . 'files' . DS . 'centre' . DS . 'header/' . (string) $letter['Client']['Centre']['header_dir'] . DS . $letter['Client']['Centre']['header'];
	$headerSize = getimagesize($header);
	$dpi = 72;
	$a4width = 8.3;
	$sideMargin = 1;
	$topMargin += ($dpi * ($a4width - ($sideMargin * 2)) / $headerSize[0]) * $headerSize[1] + 10;
}
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style>
@page {
margin: 1in;
}
body {
font-family: 'Helvetica', 'Calibri', sans-serif;
font-size: 10pt;
margin-top: <?php echo ceil($topMargin); ?>px;
}
#header { position: fixed; top: -50px; width: 100%; text-align: center; }
#footer { position: fixed; bottom: -50px; height: 50px; color: #808080; }
</style>
</head>
<body>
<div id="header">
<?php
	if ( ! empty( $letter['Client']['Centre']['header_dir'] ) && ! empty( $letter['Client']['Centre']['header'] ) && ($letter['Letter']['description'] != 'Client Financial Statement') ) {
		echo '<img src="' . $header . '" width="100%" />';
	}
?>
</div>
<div id="footer">
<table style="width: 100%;">
<tbody>
<tr>
<td style="width: 75%;"><p style="margin: 0;">Authorised and regulated by the Financial Conduct Authority</p></td>
<td style="text-align: right; width: 25%;"><?php echo $this->Html->image('cma-logo.jpg', array('width' => 125, 'height' => 70)); ?></td>
</tr>
</tbody>
</table>
</div>
<?php echo $letter['Letter']['content']; ?>
</body>
</html>
