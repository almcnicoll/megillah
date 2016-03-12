<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Debt Statistics' ); ?>
			</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
<?php
	
	$last_org_id = 0;
	$last_org_name = '';
	$in_panel = false;
	$org_totals = array(
						'recent_clients' => array(),
						'active_clients' => array(),
						'active_debt' => array(),
						'active_debt_formatted' => array(),
					);
	$org_total_active_debt = 0;
	
	function closePanels($in_panel, $last_org_id, $last_org_name, $org_totals) {
		switch ($in_panel) {
			case 'organisation':
				echo <<<END_FOOTER
						<div class='row'>
							<h3 class='panel-footer col-md-12'>Total for {$last_org_name}</h3>
						</div>
						<div class='row'>
							<div class='col-md-6'>Number of new cases (last 12 months)</div>
							<div class='col-md-6'>{$org_totals['recent_clients'][$last_org_id]}</div>
						</div>
						<div class='row'>
							<div class='col-md-6'>Number of current live cases</div>
							<div class='col-md-6'>{$org_totals['active_clients'][$last_org_id]}</div>
						</div>
						<div class='row'>
							<div class='col-md-6'>Total debt for all active cases</div>
							<div class='col-md-6'>{$org_totals['active_debt_formatted'][$last_org_id]}</div>
						</div>\n
END_FOOTER;
				echo "\t\t\t\t\t</div>\n";
				echo "\t\t\t\t</div>\n";
				break;
			case 'centre':
				echo "\t\t\t\t\t</div>\n";
				echo "\t\t\t\t</div>\n";
				break;
		}
		$in_panel = false;
	}
	foreach ($centres as $centre):
?>
<?php
					if ($centre['Organisation']['id'] != $last_org_id) {
						// Close out any existing panels
						closePanels($in_panel, $last_org_id, $last_org_name, $org_totals);
					}
					$total_active_debt = $this->Number->currency( $centre['Centre']['total_active_debt'] , $centre['Centre']['currency_code']);
					if ($centre['Organisation']['centre_count'] == 1) {
						// Print centre name as only title
						echo "\t\t\t\t<div class='panel panel-default'>\n";
						$in_panel = 'centre';
						echo "\t\t\t\t\t<h3 class='panel-heading' id='centre-id-'>{$centre['Centre']['name']} </h3>\n";
						echo "\t\t\t\t\t<div class='panel panel-body'>\n";
					} else {
						// If new org, print org name in h3
						if ($centre['Organisation']['id'] != $last_org_id) {
							echo "\t\t\t\t<div class='panel panel-default'>\n";
							$in_panel = 'organisation';
							echo "\t\t\t\t\t<h3 class='panel-heading' id='organisation-id-'>{$centre['Organisation']['name']} </h3>\n";
							echo "\t\t\t\t\t<div class='panel panel-body'>\n";
							$org_totals['recent_clients'][$centre['Organisation']['id']] = 0;
							$org_totals['active_clients'][$centre['Organisation']['id']] = 0;
							$org_totals['active_debt'][$centre['Organisation']['id']] = 0;
							$org_totals['active_debt_formatted'][$centre['Organisation']['id']] = $this->Number->currency( 0 , $centre['Centre']['currency_code']);
						}
						echo "\t\t\t\t\t\t<h4 id='centre-id-'>{$centre['Centre']['name']} </h4>\n";
						$org_totals['recent_clients'][$centre['Organisation']['id']] += $centre['Centre']['recent_clients'];
						$org_totals['active_clients'][$centre['Organisation']['id']] += $centre['Centre']['active_clients'];
						$org_totals['active_debt'][$centre['Organisation']['id']] += $centre['Centre']['total_active_debt'];
						$org_totals['active_debt_formatted'][$centre['Organisation']['id']] = $this->Number->currency( $org_totals['active_debt'][$centre['Organisation']['id']] , $centre['Centre']['currency_code']);
					}
					echo <<<END_TBL
						<div class="row">
							<div class="col-md-6">Number of new cases (last 12 months)</div>
							<div class="col-md-6">{$centre['Centre']['recent_clients']}</div>
						</div>
						<div class="row">
							<div class="col-md-6">Number of current live cases</div>
							<div class="col-md-6">{$centre['Centre']['active_clients']}</div>
						</div>
						<div class="row">
							<div class="col-md-6">Total debt for all active cases</div>
							<div class="col-md-6">{$total_active_debt}</div>
						</div>

END_TBL;
?>
<?php
	$last_org_id = $centre['Organisation']['id'];
	$last_org_name = $centre['Organisation']['name'];
	endforeach;
	if (count($centres) > 0) {
		closePanels($in_panel, $last_org_id, $last_org_name, $org_totals);
	}
?>

			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Back to Clients' ),
					array( 'controller' => 'clients', 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>
<?php
	if (false) {
		echo "\n<pre>\n";
		print_r($centres);
		echo "\n</pre>\n";
	}
?>