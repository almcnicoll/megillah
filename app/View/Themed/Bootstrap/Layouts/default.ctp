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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$siteTitle = __( 'KST Library' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo $title_for_layout; ?> - <?php echo $siteTitle ?></title>
	<?php
	echo $this->Html->meta( 'icon', 'favicon.ico' );
	echo $this->Html->meta(array(
		'rel' => 'apple-touch-icon',
		'sizes' => '57x57',
		'link' => '/img/apple-touch-icon.png',
	));
	echo $this->Html->meta(array(
		'rel' => 'apple-touch-icon',
		'sizes' => '152x152',
		'link' => '/img/apple-touch-icon-152x152.png',
	));
	if ( ! empty( $siteTheme['Theme'] ) ) {
		echo $this->Html->css( array( __( '%s.min', $siteTheme['Theme']['code'] ) ) );
	} else {
		//echo $this->Html->css( array( 'united.min' ) );
		echo $this->Html->css( array( 'kst.min' ) );
	}
	echo $this->Html->css( array( 'bootstrap-datepicker', 'app' ) );
	echo $this->Html->css('../js/jquery-ui/jquery-ui.min.css');
	echo $this->Html->css('misc.css');
	echo $this->fetch( 'css' );
	?>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
				<span class="sr-only"><?php echo __( 'Toggle Navigation' ); ?></span> <span class="icon-bar"></span>
				<span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link( $siteTitle,
				array( 'plugin' => null, 'controller' => 'dashboards', 'action' => '' ),
				array( 'class' => 'navbar-brand' ) ); ?>
		</div>
		<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
			<?php if ( Auth::user() ): ?>
				<ul class="nav navbar-nav">
					<?php $currentUser = Auth::user(); ?>
				
					<li><?php echo $this->Html->link( __( 'Borrow' ),
						array( 'plugin' => null, 'controller' => 'dashboards', 'action' => 'borrower' ) ); ?></li>
					<?php if (Auth::hasRole(Configure::read('Role.super'))||Auth::hasRole(Configure::read('Role.administrator'))||Auth::hasRole(Configure::read('Role.manager'))||Auth::hasRole(Configure::read('Role.supervisor'))): ?>
					<li><?php echo $this->Html->link( __( 'Check In' ),
						array( 'plugin' => null, 'controller' => 'loans', 'action' => 'checkin' ) ); ?></li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Reports <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link( __( 'Overdue Loans' ),
						array( 'plugin' => null, 'controller' => 'reports', 'action' => 'overdue' ) ); ?></li>
						</ul>
					</li>
					<?php endif; ?>
					<!--
					<li><?php echo $this->Html->link( __( 'Creditors' ),
							array(
								'plugin'     => null,
								'controller' => 'creditors',
								'action'     => 'index'
							) ); ?></li>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropdown-toggle"
						   data-toggle="dropdown"><?php echo __( 'Administration' ); ?>
							&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ): ?>
								<li><?php echo $this->Html->link( __( 'Templates' ),
										array(
											'plugin'     => null,
											'controller' => 'templates',
											'action'     => 'index'
										) ); ?></li>
								<li class="divider"></li>
							<?php endif; ?>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) ): ?>
								<li><?php echo $this->Html->link( __( 'Countries' ), array(
										'plugin'     => null,
										'controller' => 'countries',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Currencies' ), array(
										'plugin'     => null,
										'controller' => 'currencies',
										'action'     => 'index'
									) ); ?></li>
								<li class="divider"></li>
								<li><?php echo $this->Html->link( __( 'Debt Categories' ), array(
										'plugin'     => null,
										'controller' => 'debt_categories',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Income Categories' ), array(
										'plugin'     => null,
										'controller' => 'income_categories',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Expense Categories' ), array(
										'plugin'     => null,
										'controller' => 'expense_categories',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Finance Categories' ), array(
										'plugin'     => null,
										'controller' => 'finance_categories',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Trigger Categories' ), array(
										'plugin'     => null,
										'controller' => 'trigger_categories',
										'action'     => 'index'
									) ); ?></li>
								<li class="divider"></li>
							<?php endif; ?>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) ): ?>
								<li><?php echo $this->Html->link( __( 'Questions' ), array(
										'plugin'     => null,
										'controller' => 'questions',
										'action'     => 'index'
									) ); ?></li>
								<li class="divider"></li>
								<li><?php echo $this->Html->link( __( 'Organisation(s)' ), array(
										'plugin'     => null,
										'controller' => 'organisations',
										'action'     => 'index'
									) ); ?></li>
							<?php endif; ?>
							<?php if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ): ?>
								<li><?php echo $this->Html->link( __( 'Centre(s)' ), array(
										'plugin'     => null,
										'controller' => 'centres',
										'action'     => 'index'
									) ); ?></li>
								<li><?php echo $this->Html->link( __( 'Advisers' ),
										array(
											'plugin'     => null,
											'controller' => 'users',
											'action'     => 'index'
										) ); ?></li>
								<li class="divider"></li>
							<?php endif; ?>
							<li><?php echo $this->Html->link( __( 'Trigger Figures' ),
									array(
										'plugin'     => null,
										'controller' => 'trigger_figures',
										'action'     => 'index'
									) ); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link( __( 'Debt Statistics' ),
									array( 'plugin' => null, 'controller' => 'actions', 'action' => 'debt_statistics' ) ); ?></li>
							<li><?php echo $this->Html->link( __( 'Audit Trail' ),
									array( 'plugin' => null, 'controller' => 'logs', 'action' => 'index' ) ); ?></li>
						</ul>
					</li>
					<li><?php echo $this->Html->link( __( 'Help & Support' ),
							array( 'plugin' => null, 'controller' => 'requests', 'action' => 'index' ) ); ?></li>
					-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropdown-toggle"
						   data-toggle="dropdown"><?php echo h( Auth::user( 'full_name' ) ); ?>
							&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link( __( 'Profile' ), array(
									'plugin'     => null,
									'controller' => 'users',
									'action'     => 'view',
									Auth::id()
								) ); ?></li>
							<li><?php echo $this->Html->link( __( 'Change Email' ), array(
									'plugin'     => null,
									'controller' => 'users',
									'action'     => 'change_email',
									Auth::id()
								) ); ?></li>
							<li><?php echo $this->Html->link( __( 'Change Password' ), array(
									'plugin'     => null,
									'controller' => 'users',
									'action'     => 'change_password',
									Auth::id()
								) ); ?></li>
							<li><?php echo $this->Html->link( __( 'Change Theme' ), array(
									'plugin'     => null,
									'controller' => 'users',
									'action'     => 'change_theme',
									Auth::id()
								) ); ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link( __( 'Logout' ), array(
									'plugin'     => null,
									'controller' => 'accounts',
									'action'     => 'logout'
								) ); ?></li>
						</ul>
					</li>
				</ul>
			<?php else: ?>
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo $this->Html->link( __( 'Sign In' ),
							array( 'plugin' => null, 'controller' => 'accounts', 'action' => 'login' ) ); ?></li>
				</ul>
			<?php endif; ?>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
<div id="notification-container" class="container-fluid">
	<!-- Notification List -->
	<?php echo $this->Flash->flash(); ?>
</div>
<div class="container-fluid">
	<!-- Content -->
	<?php echo $this->fetch( 'content' ); ?>
</div>
<div id="footer">
	<div class="container">
		<hr/>
		<p class="text-muted">Megillah 1.0.0 &copy; <?php echo date( 'Y' ); ?> Al McNicoll. All rights reserved.</p>
	</div>
</div>
<!-- Included JS Files (Compressed) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<?php
echo $this->Html->script( array( 'bootstrap.min' ) );
//load autocomplete script
echo $this->Html->script('autocomplete/autocomplete.js');
echo $this->Html->script('autoajax/autoajax.js');
echo $this->fetch( 'script' );
echo $this->fetch( 'script-two' );
echo $this->Html->script('jquery-ui/jquery-ui.min.js');

$webrootForJS = $this->webroot;

$script = <<<EOS
		var webrootURL = '{$webrootForJS}';
EOS;
$script .= <<<'EOT'

        $('.alert').alert();

        window.setTimeout(function() {
          $('#notification-container .alert').slideUp(500, function(event) {
						$(this).alert('close');
					});
        }, 5000);

        $('#cfs-licence-link').on('click', function(event) {
            alert('Please edit your Centre and enter your CFS Licence Number to use the Trigger Figures functionality.');
        });

		window.checkTimeout = function() {
			$.post(webrootURL + 'users/ping', null, function( data ) {
				if (data.session == 0) {
					//alert('Your session has timed out!');
					$('#timeout-modal').modal( 'show' );
					window.timeout_check = setTimeout('checkTimeout();', 60*1000);
				} else {
					$('#timeout-modal').modal( 'hide' );
					$('#log-back-in-link').text('Log back in');
					window.timeout_check = setTimeout('checkTimeout();', 10*1000);
				}
			}, 'json');
		}
EOT;

// Only trigger timeout checking if the user was logged in at page load
if (AuthComponent::user('id')) {
	$script .= "\n\nwindow.timeout_check = setTimeout('checkTimeout();', 31*60*1000);";
}

$this->Js->buffer( $script );
echo $this->Js->writeBuffer();
?>
</body>
</html>
