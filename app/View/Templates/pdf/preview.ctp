<html>
<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style>
@page {
margin: 1in;
}
body {
font-family: 'Helvetica', 'Calibri', sans-serif;
font-size: 10pt;
}
#header { position: fixed; top: -50px; width: 100%; text-align: center; }
#footer { position: fixed; bottom: -50px; height: 50px; color: #404040; }
</style>
</head>
<body>
<div id="header">
¦CentreHeader¦
</div>
<div id="footer">
<table style="width: 100%;">
<tbody>
<tr>
<td style="width: 75%;"><p style="margin: 0;">Authorised and regulated by the Financial Conduct Authority</p></td>
<td style="text-align: right; width: 25%;"><?php echo $this->Html->image('cma-logo.jpg', array('width' => 110, 'height' => 60)); ?></td>
</tr>
</tbody>
</table>
</div>
<?php echo $template['Template']['content']; ?>
</body>
</html>
