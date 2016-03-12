<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<h2>Sorry - something went wrong</h2>
<p>Sorry, but it looks like there was a temporary glitch. I'm afraid it's possible that data you entered on the previous screen may not have been saved.</p>
<p>We recommend that you <a href='javascript:history.go(-1);'>go back and check</a>.</p>
<p style='cursor:pointer;' id='error-details-toggle'><small><a href='#'>Click here for more information</a></small></p>
<pre id='error-details' style='display:none;'>
<?php
	error_log('Missing View exception');
	error_log(print_r($_SERVER,true));
	error_log(print_r($this->request,true));
	echo "** Server-side info **\n";
	print_r($_SERVER);
	echo "** Request **\n";
	print_r($this->request);
?>
</pre>
<?php
	$this->Html->scriptBlock(<<<END_SCRIPT
	$(document).ready( function() {
		$('#error-details-toggle').click( function() {
			$('#error-details').toggle();
		} );
	} );
END_SCRIPT
,array('block' => 'script'));
?>