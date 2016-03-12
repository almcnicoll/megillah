<?php
	ob_start();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<style>
		html {
			margin: 20px;
		}

		body {
			font-family: 'Helvetica', 'Calibri', sans-serif;
			font-size: 8pt;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			vertical-align: top;
			padding: 2px;
		}

		th {
			text-align: left;
		}

		.text-largest {
			font-size: 12pt;
		}

		.text-bold {
			font-weight: bold;
		}

		.text-center {
			text-align: center;
		}

		.text-middle {
			vertical-align: middle;
		}

		.text-right {
			text-align: right;
		}

		.line-break {
			margin-bottom: 20px;
		}

		.left-column, .right-column {
			width: 50%;
		}

		.head-column {
			width: 33%;
		}

		.address-left-column {
			width: 30%;
		}

		.address-right-column {
			width: 70%;
		}

		.index-column {
			width: 7%;
			text-align: center;
		}

		.number-column {
			width: 18%;
		}

		.check-column {
			width: 8%;
		}

		.full-border {
			border: 1px solid #000000;
		}

		.side-border {
			border-left: 1px solid #000000;
			border-right: 1px solid #000000;
		}

		.bottom-border {
			border-bottom: 1px solid #000000;
		}
	</style>
</head>
<body>
<table class="line-break">
	<tbody>
	<tr>
		<td class="head-column">
			<span class="text-bold text-largest"><?php echo __( 'Common Financial Statement' ); ?></span>
		</td>
		<td class="head-column text-center">
			<span class="text-largest text-bold"><?php echo __( 'Summary' ); ?></span><br/>
			<span class="text-bold"><?php echo __( 'All amounts are monthly' ); ?></span><br/>
			<span class="text-bold"><?php echo __( '%s', date( 'd F Y' ) ); ?></span>
		</td>
		<td class="head-column">
			<!-- Logos -->
			<table>
				<tbody>
				<tr>
					<td class="head-column text-center"><?php echo $this->Html->image( 'mat-logo.jpg',
							array( 'alt' => 'MAT', 'fullBase' => true ) );
						?></td>
					<td class="head-column text-center"><?php echo $this->Html->image( 'bba-logo.jpg',
							array( 'alt' => 'BBA', 'fullBase' => true ) ); ?></td>
					<td class="head-column text-center"><?php echo $this->Html->image( 'fla-logo.jpg',
							array( 'alt' => 'FLA', 'fullBase' => true ) ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column">
			<!-- Client Address + Case Reference -->
			<table>
				<tbody>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Client Address' ); ?></td>
					<td class="full-border address-right-column" style="height: 100px">
						<span><?php echo h( $client['PrimaryPerson']['full_name'] ); ?></span><br/>
						<?php if ( ! empty( $client['Client']['address_line_1'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_1'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['address_line_2'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_2'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['address_line_3'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_3'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['city'] ) ): ?>
							<?php if ( ! empty( $client['Client']['county'] ) ): ?>
								<span><?php echo __( '%s, %s', $client['Client']['city'],
										$client['Client']['county'] ); ?></span><br/>
							<?php else: ?>
								<span><?php echo h( $client['Client']['city'] ); ?></span><br/>
							<?php endif; ?>
						<?php endif; ?>
						<span><?php echo h( $client['Client']['postcode'] ); ?></span>
					</td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Case Reference' ); ?></td>
					<td class="full-border address-right-column"><?php echo h( $client['Client']['code'] ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
		<td class="right-column">
			<!-- Agency, Caseworker + Licence Number -->
			<table>
				<tbody>
				<tr>
					<?php
						$use_centre_address = false;
						if ( ! empty( $centre['Organisation']['use_centre_address'] ) ) {
							$use_centre_address = ($centre['Organisation']['use_centre_address'] == 1);
						}
						$address = array();
						if ($use_centre_address) {
							$address = $centre['Centre'];
						} else {
							$address = $centre['Organisation'];
						}
					?>
					<td class="text-bold address-left-column"><?php echo __( 'Agency Address' ); ?></td>
					<td class="full-border address-right-column" style="height: 100px">
						<span><?php echo h( $address['name'] ); ?></span><br/>
						<?php if ( ! empty( $address['address_line_1'] ) ): ?>
							<span><?php echo h( $address['address_line_1'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['address_line_2'] ) ): ?>
							<span><?php echo h( $address['address_line_2'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['address_line_3'] ) ): ?>
							<span><?php echo h( $address['address_line_3'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['city'] ) ): ?>
							<?php if ( ! empty( $address['county'] ) ): ?>
								<span><?php echo __( '%s, %s', $address['city'],
										$address['county'] ); ?></span><br/>
							<?php else: ?>
								<span><?php echo h( $address['city'] ); ?></span><br/>
							<?php endif; ?>
						<?php endif; ?>
						<span><?php echo h( $address['postcode'] ); ?></span>
					</td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Caseworker' ); ?></td>
					<td class="full-border address-right-column"><?php echo h( Auth::user( 'full_name' ) ); ?></td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Licence #' ); ?></td>
					<td class="full-border address-right-column"><?php echo( empty( $centre['Centre']['cfs_licence_number'] ) ? __( 'N/A' ) : h( $centre['Centre']['cfs_licence_number'] ) ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column">
			<!-- Household -->
			<table>
				<tbody>
				<tr>
					<td class="text-bold"><?php echo __( 'Number in household' ); ?></td>
					<td class="full-border number-column text-center"><?php echo h( count( $client['Person'] ) ); ?></td>
				</tr>
				<tr>
					<td class="text-bold"><?php echo __( 'Number of vehicles in household' ); ?></td>
					<td class="full-border number-column text-center"><?php echo h( $client['Client']['number_of_cars'] ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
		<td class="right-column">
			<!-- Children -->
			<?php
			$under14 = 0;
			$over14  = 0;
			foreach ( $client['Person'] as $person ) {
				if ( (int) $person['role'] === Person::ROLE_DEPENDANT && (int) $person['age'] < 18 ) {
					if ( (int) $person['age'] < 14 ) {
						$under14 ++;
					} else {
						$over14 ++;
					}
				}
			}
			?>
			<table>
				<tbody>
				<tr>
					<td class="text-bold"><?php echo __( 'Number of dependent children under 14' ); ?></td>
					<td class="full-border number-column text-center"><?php echo h( $under14 ); ?></td>
				</tr>
				<tr>
					<td class="text-bold"><?php echo __( 'Number of dependent children aged 14+' ); ?></td>
					<td class="full-border number-column text-center"><?php echo h( $over14 ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>

<?php
$totalIncome  = 0;
$totalExpense = 0;
?>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column">
			<!-- Income -->
			<table class="line-break">
				<thead>
				<tr>
					<th class="full-border" colspan="2"><?php echo __( 'Monthly Income' ); ?></th>
					<th class="full-border"><?php echo __( 'Amount' ); ?>&nbsp;&#40;&pound;&#41;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $incomes as $income ): ?>
					<tr>
						<td class="side-border index-column"><?php echo h( $income['FinanceCategory']['code'] ); ?></td>
						<td class="side-border"><?php echo __('%s %s', __('Monthly Total'), $income['FinanceCategory']['name'] ); ?></td>
						<td class="side-border number-column text-right">
							<?php
							$totalIncome += (float) $income['FinanceCategory']['monthly_amount'];
							echo __( '%s', number_format( (float) $income['FinanceCategory']['monthly_amount'], 2 ) );
							?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				<tfoot>
				<tr>
					<td style="border-top: 1px solid #000;">&nbsp;</td>
					<td class="full-border text-bold"><?php echo __( 'Monthly Total Income' ); ?></td>
					<td class="full-border number-column text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalIncome, 2 ) ); ?></td>
				</tr>
				</tfoot>
			</table>
			<!-- Confirm Assets -->
			<table class="line-break">
				<tbody>
				<tr>
					<td>
						<span><?php echo __( 'Have you discussed the use of any assets to make lump sum payments?' ); ?></span>
					</td>
					<td class="number-column text-middle text-center"><?php echo __( 'Yes' ); ?></td>
				</tr>
				</tbody>
			</table>
			<!-- Expenditure -->
			<table class="line-break">
				<thead>
				<tr>
					<th class="full-border" colspan="2"><?php echo __( 'Monthly Expenditure' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Amount' ); ?>&nbsp;&#40;&pound;&#41;</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $essentialExpenses as $essentialExpense ): ?>
					<tr>
						<td class="side-border index-column"><?php echo h( $essentialExpense['ExpenseCategory']['code'] ); ?></td>
						<td class="side-border"><?php
						if ( ! empty( $essentialExpense['ExpenseCategory']['is_customisable'] ) && ! empty( $essentialExpense['Expense']['name'] ) ) {
							echo __('%s (%s)', $essentialExpense['ExpenseCategory']['name'], $essentialExpense['Expense']['name'] );
						} else {
							echo h( $essentialExpense['ExpenseCategory']['name'] );
						}
						?></td>
						<td class="side-border text-right">
							<?php
							$totalExpense += (float) $essentialExpense['Expense']['monthly_amount'];
							echo __( '%s',
								number_format( (float) $essentialExpense['Expense']['monthly_amount'],
									2 ) );
							?>
						</td>
					</tr>
				<?php
				endforeach;
				?>
				<?php foreach ( $financeCategoryTotals as $financeCategoryTotal ): ?>
					<tr>
						<td class="side-border index-column"><?php echo h( $financeCategoryTotal['FinanceCategory']['code'] ); ?></td>
						<td class="side-border"><?php echo __( 'Monthly Total %s',
								$financeCategoryTotal['FinanceCategory']['name'] ); ?></td>
						<td class="side-border text-right">
							<?php
							$totalExpense += (float) $financeCategoryTotal['FinanceCategory']['monthly_amount'];
							echo __( '%s',
								number_format( (float) $financeCategoryTotal['FinanceCategory']['monthly_amount'],
									2 ) );
							?>
						</td>
					</tr>
				<?php
				endforeach;
				?>
				</tbody>
				<tfoot>
				<tr>
					<td style="border-top: 1px solid #000;">&nbsp;</td>
					<td class="full-border text-bold"><?php echo __( 'Monthly Total Expenditure' ); ?></td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalExpense, 2 ) ); ?></td>
				</tr>
				</tfoot>
			</table>
			<!-- Totals -->
			<table class="line-break">
				<tbody>
				<tr>
					<td class="text-bold"><?php echo __( 'Total Available For Creditors' ); ?>
						&nbsp;&#40;&pound;&#41;</td>
					<td class="full-border number-column text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalIncome - $totalExpense, 2 ) ); ?></td>
				</tr>
				<tr>
					<td class="text-bold"><?php echo __( 'Total For Non-Priority Creditors' ); ?>
						&nbsp;&#40;&pound;&#41;</td>
					<td class="full-border number-column text-bold text-right"><?php echo __( '%s',
							number_format( (float) ( $totalIncome - $totalExpense - $totalPriorityDebtOffer ),
								2 ) ); ?></td>
				</tr>
				</tbody>
			</table>
			<!-- Accuracy Statement -->
			<table>
				<tbody>
				<tr>
					<td>
						<span><?php echo __( 'This financial statement is an accurate record of the information provided by our client(s).' ); ?></span>
					</td>
				</tr>
				</tbody>
			</table>
		</td>
		<td class="right-column">
			<!-- Priority Debts -->
			<?php
			$totalPriorityOwed  = 0;
			$totalPriorityOffer = 0;
			$count              = 88;
			?>
			<table class="line-break">
				<thead>
				<tr>
					<th class="full-border" colspan="2"><?php echo __( 'Priority Debts' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Owed' ); ?>&nbsp;&#40;&pound;&#41;</th>
					<th class="full-border check-column">&nbsp;</th>
					<th class="full-border number-column"><?php echo __( 'Offer' ); ?>&nbsp;&#40;&pound;&#41;</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$priorityDebtsByDebtCatId	= array();
				$priorityDebtsToRemove 		= array();
				// Iterate over priority debts to group children into parents.
				foreach ( $priorityDebts as $id => $priorityDebt ) {
					// Set a lookup to find a priority debt from its category id.
					$priorityDebtsByDebtCatId[ $priorityDebt['DebtCategory']['id'] ] = $id;
					if ( ! empty( $priorityDebt['DebtCategory']['parent_id'] ) ) {
						// If we have a parent id, add it into the parent's amount/offer.
						$parent_id_db  = $priorityDebt['DebtCategory']['parent_id'];
						$debt_of_parent_cat = $priorityDebtsByDebtCatId[ $parent_id_db ];
						$priorityDebts[ $debt_of_parent_cat ]['DebtCategory']['amount'] += $priorityDebt['DebtCategory']['amount'];
						$priorityDebts[ $debt_of_parent_cat ]['DebtCategory']['monthly_offer'] += $priorityDebt['DebtCategory']['monthly_offer'];
						// If we have a parent id, queue the original debt for removal from the array.
						array_unshift( $priorityDebtsToRemove, $id ); // Prepend so we remove in reverse order (avoids messing with indices).
					}
				}
				foreach ( $priorityDebtsToRemove as $id ) {
					unset( $priorityDebts[ $id ] );
				}
				foreach ( $priorityDebts as $priorityDebt ):
					?>
					<tr>
						<td class="side-border index-column"><?php echo h( $count ); ?></td>
						<td class="side-border">
							<?php echo h( $priorityDebt['DebtCategory']['name'] ); ?>
						</td>
						<td class="side-border text-right">
							<?php
							if ( ! empty( $priorityDebt['DebtCategory']['amount'] ) ) {
								$totalPriorityOwed += (float) $priorityDebt['DebtCategory']['amount'];
								echo __( '%s', number_format( (float) $priorityDebt['DebtCategory']['amount'], 2 ) );
							} else {
								echo number_format( 0, 2 );
							}
							?>
						</td>
						<td class="side-border">&nbsp;</td>
						<td class="side-border text-right">
							<?php
							if ( ! empty( $priorityDebt['DebtCategory']['monthly_offer'] ) ) {
								$totalPriorityOffer += (float) $priorityDebt['DebtCategory']['monthly_offer'];
								echo __( '%s',
									number_format( (float) $priorityDebt['DebtCategory']['monthly_offer'], 2 ) );
							} else {
								echo number_format( 0, 2 );
							}
							?>
						</td>
					</tr>
					<?php
					$count ++;
				endforeach;
				?>
				<tr>
					<td class="side-border index-column"><?php echo h( $count ); ?></td>
					<td class="side-border">
						<?php
						echo __( 'Other' );
						?>
					</td>
					<td class="side-border text-right">
						<?php
						echo number_format( 0, 2 );
						?>
					</td>
					<td class="side-border">
						<?php
						echo __( '' );
						?>
					</td>
					<td class="side-border text-right">
						<?php
						echo number_format( 0, 2 );
						?>
					</td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td style="border-top: 1px solid #000;">&nbsp;</td>
					<td class="full-border text-bold"><?php echo __( 'Total Priority Debts' ); ?></td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalPriorityOwed, 2 ) ); ?></td>
					<td class="full-border">&nbsp;</td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalPriorityOffer, 2 ) ); ?></td>
				</tr>
				</tfoot>
			</table>
			<!-- Non-Priority Debts -->
			<?php
			$totalNonPriorityOwed  = 0;
			$totalNonPriorityOffer = 0;
			$count                 = 101;
			?>
			<table class="line-break">
				<thead>
				<tr>
					<th class="full-border" colspan="2"><?php echo __( 'Non-Priority Debts' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Owed' ); ?>&nbsp;&#40;&pound;&#41;</th>
					<th class="full-border check-column"><?php echo __( 'CCJ' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Offer' ); ?>&nbsp;&#40;&pound;&#41;</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$proRataOfferTotal = $totalIncome - $totalExpense - $totalPriorityDebtOffer;
				// Calculate funds available for pro rata debts by subtracting existing offers.
				foreach ( $nonPriorityDebts as $nonPriorityDebt ) {
					if ( empty( $nonPriorityDebt['Debt']['is_pro_rata'] ) ) {
						$proRataOfferTotal -= $nonPriorityDebt['Debt']['monthly_offer'];
					}
				}
				$proRataOfferTotal = ( $proRataOfferTotal < 0 ? 0 : $proRataOfferTotal );
				$proRataDebtTotal  = 0;
				// Calculate total value of pro rata debts.
				foreach ( $nonPriorityDebts as $nonPriorityDebt ) {
					if ( ! empty( $nonPriorityDebt['Debt']['is_pro_rata'] ) ) {
						$proRataDebtTotal += $nonPriorityDebt['Debt']['amount'];
					}
				}
				// Cap the pro rata offer total to prevent making an offer over the amount owed.
				$proRataOfferTotal = ( $proRataOfferTotal > $proRataDebtTotal ? $proRataDebtTotal : $proRataOfferTotal );
				// Calculate an offer for each pro rata debt.
				foreach ( $nonPriorityDebts as &$nonPriorityDebt ) {
					if ( ! empty( $nonPriorityDebt['Debt']['is_pro_rata'] ) ) {
						if ( $proRataDebtTotal > 0 ) { // Prevents a divide-by-zero error.
							$nonPriorityDebt['Debt']['monthly_offer'] = ( $proRataOfferTotal * $nonPriorityDebt['Debt']['amount'] ) / $proRataDebtTotal;
							if (($nonPriorityDebt['Debt']['monthly_offer'] < 1) && ($nonPriorityDebt['Debt']['amount'] > 0)) { $nonPriorityDebt['Debt']['monthly_offer'] = 1; } // Minimum pro-rata offer is £1
						} else {
							$nonPriorityDebt['Debt']['monthly_offer'] = 0;
						}
					}
				}
				unset( $nonPriorityDebt );
				for ( $i = 0; $i < 20; $i ++ ):
					?>
					<tr>
						<td class="side-border index-column"><?php echo h( $count ); ?></td>
						<td class="side-border">
							<?php
							if ( ! empty( $nonPriorityDebts[ $i ]['Creditor']['name'] ) ) {
								echo h( $nonPriorityDebts[ $i ]['Creditor']['name'] );
							} else {
								echo __( '' );
							}
							?>
						</td>
						<td class="side-border text-right">
							<?php
							if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['amount'] ) ) {
								$totalNonPriorityOwed += (float) $nonPriorityDebts[ $i ]['Debt']['amount'];
								echo __( '%s', number_format( (float) $nonPriorityDebts[ $i ]['Debt']['amount'], 2 ) );
							} else {
								echo number_format( 0, 2 );
							}
							?>
						</td>
						<td class="side-border text-center">
							<?php
							if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['is_judgment'] ) ) {
								echo __( 'Yes' );
							} else {
								echo __( '' );
							}
							?>
						</td>
						<td class="side-border text-right">
							<?php
							if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['monthly_offer'] ) ) {
								$totalNonPriorityOffer += (float) $nonPriorityDebts[ $i ]['Debt']['monthly_offer'];
								echo __( '%s',
									number_format( (float) $nonPriorityDebts[ $i ]['Debt']['monthly_offer'], 2 ) );
							} else {
								echo number_format( 0, 2 );
							}
							?>
						</td>
					</tr>
					<?php
					$count ++;
				endfor;
				?>
				</tbody>
				<tfoot>
				<tr>
					<td style="border-top: 1px solid #000;">&nbsp;</td>
					<td class="full-border text-bold">
						<?php
						if ( count( $nonPriorityDebts ) > 20 ) {
							echo __( 'Subtotal Non-Priority Debts' );
						} else {
							echo __( 'Total Non-Priority Debts' );
						}
						?>
					</td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalNonPriorityOwed, 2 ) ); ?></td>
					<td class="full-border">&nbsp;</td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalNonPriorityOffer, 2 ) ); ?></td>
				</tr>
				</tfoot>
			</table>
			<table>
				<tbody>
				<tr>
					<td class="index-column">&nbsp;</td>
					<td class="number-column text-bold"><?php echo __( 'Signed' ); ?></td>
					<td class="bottom-border">&nbsp;</td>
				</tr>
				<tr>
					<td class="index-column">&nbsp;</td>
					<td class="number-column text-bold"><?php echo __( 'Date' ); ?></td>
					<td class="bottom-border">&nbsp;</td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>
<?php
if ( count( $nonPriorityDebts ) > 20 ):
?>
<table class="line-break" style="page-break-before: always;">
	<tbody>
	<tr>
		<td class="head-column">
			<span class="text-bold text-largest"><?php echo __( 'Common Financial Statement' ); ?></span>
		</td>
		<td class="head-column text-center">
			<span class="text-largest text-bold"><?php echo __( 'Summary' ); ?></span><br/>
			<span class="text-bold"><?php echo __( 'All amounts are monthly' ); ?></span><br/>
			<span class="text-bold"><?php echo __( '%s', date( 'd F Y' ) ); ?></span>
		</td>
		<td class="head-column">
			<!-- Logos -->
			<table>
				<tbody>
				<tr>
					<td class="head-column text-center"><?php echo $this->Html->image( 'mat-logo.jpg',
							array( 'alt' => 'MAT', 'fullBase' => true ) );
						?></td>
					<td class="head-column text-center"><?php echo $this->Html->image( 'bba-logo.jpg',
							array( 'alt' => 'BBA', 'fullBase' => true ) ); ?></td>
					<td class="head-column text-center"><?php echo $this->Html->image( 'fla-logo.jpg',
							array( 'alt' => 'FLA', 'fullBase' => true ) ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column">
			<!-- Client Address + Case Reference -->
			<table>
				<tbody>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Client Address' ); ?></td>
					<td class="full-border address-right-column" style="height: 100px">
						<span><?php echo h( $client['PrimaryPerson']['full_name'] ); ?></span><br/>
						<?php if ( ! empty( $client['Client']['address_line_1'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_1'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['address_line_2'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_2'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['address_line_3'] ) ): ?>
							<span><?php echo h( $client['Client']['address_line_3'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $client['Client']['city'] ) ): ?>
							<?php if ( ! empty( $client['Client']['county'] ) ): ?>
								<span><?php echo __( '%s, %s', $client['Client']['city'],
										$client['Client']['county'] ); ?></span><br/>
							<?php else: ?>
								<span><?php echo h( $client['Client']['city'] ); ?></span><br/>
							<?php endif; ?>
						<?php endif; ?>
						<span><?php echo h( $client['Client']['postcode'] ); ?></span>
					</td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Case Reference' ); ?></td>
					<td class="full-border address-right-column"><?php echo h( $client['Client']['code'] ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
		<td class="right-column">
			<!-- Agency, Caseworker + Licence Number -->
			<table>
				<tbody>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Agency Address' ); ?></td>
					<td class="full-border address-right-column" style="height: 100px">
						<span><?php echo h( $address['name'] ); ?></span><br/>
						<?php if ( ! empty( $address['address_line_1'] ) ): ?>
							<span><?php echo h( $address['address_line_1'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['address_line_2'] ) ): ?>
							<span><?php echo h( $address['address_line_2'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['address_line_3'] ) ): ?>
							<span><?php echo h( $address['address_line_3'] ); ?></span><br/>
						<?php endif; ?>
						<?php if ( ! empty( $address['city'] ) ): ?>
							<?php if ( ! empty( $address['county'] ) ): ?>
								<span><?php echo __( '%s, %s', $address['city'],
										$address['county'] ); ?></span><br/>
							<?php else: ?>
								<span><?php echo h( $address['city'] ); ?></span><br/>
							<?php endif; ?>
						<?php endif; ?>
						<span><?php echo h( $address['postcode'] ); ?></span>
					</td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Caseworker' ); ?></td>
					<td class="full-border address-right-column"><?php echo h( Auth::user( 'full_name' ) ); ?></td>
				</tr>
				<tr>
					<td class="text-bold address-left-column"><?php echo __( 'Licence #' ); ?></td>
					<td class="full-border address-right-column"><?php echo( empty( $centre['Centre']['cfs_licence_number'] ) ? __( 'N/A' ) : h( $centre['Centre']['cfs_licence_number'] ) ); ?></td>
				</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column">
		</td>
		<td class="right-column">
			<table class="line-break">
				<thead>
				<tr>
					<th class="full-border" colspan="2"><?php echo __( 'Non-Priority Debts - Continued' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Owed' ); ?>&nbsp;&#40;&pound;&#41;</th>
					<th class="full-border check-column"><?php echo __( 'CCJ' ); ?></th>
					<th class="full-border number-column"><?php echo __( 'Offer' ); ?>&nbsp;&#40;&pound;&#41;</th>
				</tr>
				</thead>
				<tbody>
				<?php
				if ( count( $nonPriorityDebts ) > 40 ) {
					$combinedDebt = array(
						'Creditor' => array( 'name' => 'Other (Combined)' ),
						'Debt'     => array( 'amount' => 0, 'monthly_offer' => 0 )
					);
					for ( $i = 39; $i < count( $nonPriorityDebts ); $i ++ ) {
						$combinedDebt['Debt']['amount'] += $nonPriorityDebts[ $i ]['Debt']['amount'];
						$combinedDebt['Debt']['monthly_offer'] += $nonPriorityDebts[ $i ]['Debt']['monthly_offer'];
					}
					$nonPriorityDebts[39] = $combinedDebt;
				}
				for( $i = 20; $i < 40; $i ++ ):
				?>
				<tr>
					<td class="side-border index-column"><?php echo h( $count ); ?></td>
					<td class="side-border">
						<?php
						if ( ! empty( $nonPriorityDebts[ $i ]['Creditor']['name'] ) ) {
							echo h( $nonPriorityDebts[ $i ]['Creditor']['name'] );
						} else {
							echo __( '' );
						}
						?>
					</td>
					<td class="side-border text-right">
						<?php
						if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['amount'] ) ) {
							$totalNonPriorityOwed += (float) $nonPriorityDebts[ $i ]['Debt']['amount'];
							echo __( '%s', number_format( (float) $nonPriorityDebts[ $i ]['Debt']['amount'], 2 ) );
						} else {
							echo number_format( 0, 2 );
						}
						?>
					</td>
					<td class="side-border text-center">
						<?php
						if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['is_judgment'] ) ) {
							echo __( 'Yes' );
						} else {
							echo __( '' );
						}
						?>
					</td>
					<td class="side-border text-right">
						<?php
						if ( ! empty( $nonPriorityDebts[ $i ]['Debt']['monthly_offer'] ) ) {
							$totalNonPriorityOffer += (float) $nonPriorityDebts[ $i ]['Debt']['monthly_offer'];
							echo __( '%s',
								number_format( (float) $nonPriorityDebts[ $i ]['Debt']['monthly_offer'], 2 ) );
						} else {
							echo number_format( 0, 2 );
						}
						?>
					</td>
				</tr>
				<?php
					$count ++;
				endfor;
				?>
				</tbody>
				<tfoot>
				<tr>
					<td style="border-top: 1px solid #000;">&nbsp;</td>
					<td class="full-border text-bold"><?php echo __( 'Total Non-Priority Debts' ); ?></td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalNonPriorityOwed, 2 ) ); ?></td>
					<td class="full-border">&nbsp;</td>
					<td class="full-border text-bold text-right"><?php echo __( '%s',
							number_format( (float) $totalNonPriorityOffer, 2 ) ); ?></td>
				</tr>
				</tfoot>
			</table>
		</td>
	</tr>
	</tbody>
</table>
<?php
endif;
?>
</body>
</html>
<?php
if (false) {
	$output = ob_get_contents();
	error_log($output);
	error_log(error_get_last());
}
ob_end_flush();
?>