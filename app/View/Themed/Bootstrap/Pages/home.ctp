<?php
/**
 * Catalyst Home
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="jumbotron">
			<h1>Welcome to Catalyst!</h1>

			<p>The Community Money Advice debt advice software solution, developed by Integritec (UK) Ltd.</p>

			<p>Keep up to date with any changes we make to the system by visiting
			   our <?php echo $this->Html->link( __( 'changelog' ),
					array( 'controller' => 'pages', 'action' => 'changelog' ) ); ?>.</p>

			<p><?php
				if ( Auth::user() ) {
					echo $this->Html->link( __( 'Get Started!' ),
						array( 'plugin' => null, 'controller' => 'clients', 'action' => 'index' ),
						array( 'class' => 'btn btn-primary btn-lg', 'role' => 'button' ) );
				} else {
					echo $this->Html->link( __( 'Get Started!' ),
						array( 'plugin' => null, 'controller' => 'accounts', 'action' => 'login' ),
						array( 'class' => 'btn btn-primary btn-lg', 'role' => 'button' ) );
				}
				?></p>
		</div>
	</div>
</div>
