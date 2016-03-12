<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<!--[if gte mso 9]><xml>
<w:WordDocument>
<w:View>Print</w:View>
<w:Zoom>100</w:Zoom>
<w:DoNotOptimizeForBrowser/>
</w:WordDocument>
</xml><![endif]-->
<style>
p.MsoFooter, li.MsoFooter, div.MsoFooter
{
margin: 0in;
margin-bottom: 0.0001pt;
mso-pagination: widow-orphan;
tab-stops: left 3.0in right 6.0in;
tab-stops: center 3.0in right 6.0in;
tab-stops: right 3.0in right 6.0in;
}
@page Section1
{
font-family: 'Helvetica', 'Calibri', sans-serif;
font-size: 10pt;
mso-header-margin: 0.5in;
mso-footer-margin: 0.5in;
mso-header: h1;
mso-footer: f1;
mso-paper-source: 0;
}
div.Section1
{
page: Section1;
}
table#hrdftrtbl
{
margin: 0in 0in 0in 9in;
}
</style>
</head>
<body>
<div class="Section1">
<?php echo $letter['Letter']['content']; ?>
<br clear="all" />
<table id="hrdftrtbl" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<div style="mso-element:header" id="h1">
<p class="MsoHeader" style="color: #FFFFFF;"><?php
if ( ! empty( $letter['Client']['Centre']['header_dir'] ) && ! empty( $letter['Client']['Centre']['header'] ) ) {
	$header = WWW_ROOT . 'files' . DS . 'centre' . DS . 'header' . DS . (string) $letter['Client']['Centre']['header_dir'] . DS . $letter['Client']['Centre']['header'];
	$headerSize = getimagesize($header);
	$dpi = 96;
	$a4width = 8.3;
	$sideMargin = 1;
	$scaledWidth = $dpi * ($a4width - ($sideMargin * 2));
	$scaledHeight = ($dpi * ($a4width - ($sideMargin * 2)) / $headerSize[0]) * $headerSize[1];
	echo '<img src="' . Router::fullbaseUrl() . '/files/centre/header/' . (string) $letter['Client']['Centre']['header_dir'] . '/' . $letter['Client']['Centre']['header'] . '" width="' . $scaledWidth . '" height="' . $scaledHeight . '" />';
}
?></p>
</div>
</td>
<td>
<div style="mso-element:footer" id="f1">
<p class="MsoFooter">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="70%" style="font-family: 'Helvetica', 'Calibri', sans-serif; font-size: 10pt;">
Authorised and regulated by the Financial Conduct Authority
</td>
<td align="right" width="30%">
<img src="<?php echo Router::fullbaseUrl() . '/img/cma-logo.jpg'; ?>" width="125" height="70" />
</td>
</tr>
</table>
</p>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
