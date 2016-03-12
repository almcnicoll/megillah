<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<style>
		html {
			margin: 0.5in;
		}

		body {
			font-family: 'Helvetica', 'Calibri', sans-serif;
			font-size: 10pt;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			vertical-align: top;
			padding: 1px 2px;
		}

		th {
			text-align: left;
		}

		p {
			margin-top: 0;
		}

		.text-large {
			font-size: 12pt;
		}

		.text-largest {
			font-size: 14pt;
		}

		.text-bold {
			font-weight: bold;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.line-break {
			margin-bottom: 14px;
		}

		.left-column {
			width: 25%;
		}

		.right-column {
			width: 75%;
		}
	</style>
</head>
<body>
<table class="line-break">
	<tbody>
	<tr>
		<td>
			<span class="text-bold text-largest"><?php echo __( 'Client Financials - Income & Expenses' ); ?></span>
		</td>
		<td class="text-right">
			<span><?php echo __( 'Report Created: %s', date( 'd/m/Y H:i' ) ); ?></span>
		</td>
	</tr>
	</tbody>
</table>

<table class="line-break">
	<tbody>
	<tr>
		<td class="left-column text-bold text-large">
			<span><?php echo __( 'Client:' ); ?></span>
		</td>
		<td class="right-column text-bold text-large">
			<span><?php echo __( '%s - %s', $client['Client']['code'], $client['PrimaryPerson']['full_name'] ); ?></span>
		</td>
	</tr>
	</tbody>
</table>

<?php
$financeCategories = array();
foreach ( $incomes as $income ) {
	$financeCategories[ $income['FinanceCategory']['id'] ]['Data'][] = array(
		'Income'         => $income['Income'],
		'IncomeCategory' => $income['IncomeCategory']
	);
	if ( empty( $financeCategories[ $income['FinanceCategory']['id'] ]['FinanceCategory'] ) ) {
		$financeCategories[ $income['FinanceCategory']['id'] ]['FinanceCategory'] = $income['FinanceCategory'];
	}
}
foreach ( $financeCategories as $financeCategory ):
	?>
	<span class="text-bold text-large"><?php echo h( $financeCategory['FinanceCategory']['name'] ); ?></span>
	<table class="line-break">
		<tbody>
		<?php foreach ( $financeCategory['Data'] as $income ): ?>
			<tr>
				<td style="width: 40%;"><?php echo h( $income['IncomeCategory']['name'] ); ?></td>
				<td style="width: 10%;"
				    class="text-center"><?php
					if ( ! empty( $income['Income']['frequency'] ) ) {
						echo h( Income::frequencies( $income['Income']['frequency'] ) );
					} else {
						echo h( Income::frequencies( Income::FREQUENCY_MONTHLY ) );
					}
					?></td>
				<td style="width: 10%;"
				    class="text-right">&pound;<?php echo( ! empty( $income['Income']['id'] ) ? NumberLib::precision( $income['Income']['amount'], 2 ) : '0.00' ); ?></td>
				<td style="width: 40%; padding-left: 20px;"><?php echo h( $income['Income']['comment'] ); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>

<?php
$categories = array(
	'Essential' => array(
		'TriggerCategory' => array(
			'id'              => '0',
			'name'            => 'Essential',
			'FinanceCategory' => array(),
		),
	),
);
foreach ( $triggerCategories as $triggerCategory ) {
	$categories[ $triggerCategory['TriggerCategory']['id'] ] = array(
		'TriggerCategory' => array(
			'id'              => $triggerCategory['TriggerCategory']['id'],
			'name'            => $triggerCategory['TriggerCategory']['name'],
			'FinanceCategory' => array(),
		),
	);
}
foreach ( $expenses as $expense ) {
	if ( ! empty( $expense['TriggerCategory']['id'] ) ) {
		if ( empty( $categories[ $expense['TriggerCategory']['id'] ]['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ] ) ) {
			$categories[ $expense['TriggerCategory']['id'] ]['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ] = $expense['FinanceCategory'];
		}
		$categories[ $expense['TriggerCategory']['id'] ]['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ]['Data'][] = array(
			'Expense'         => $expense['Expense'],
			'ExpenseCategory' => $expense['ExpenseCategory'],
		);
	} else {
		if ( empty( $categories['Essential']['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ] ) ) {
			$categories['Essential']['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ] = $expense['FinanceCategory'];
		}
		$categories['Essential']['TriggerCategory']['FinanceCategory'][ $expense['FinanceCategory']['id'] ]['Data'][] = array(
			'Expense'         => $expense['Expense'],
			'ExpenseCategory' => $expense['ExpenseCategory'],
		);
	}
}
foreach ( $categories as $category ):
	?>
	<span class="text-bold text-large"><?php echo h( $category['TriggerCategory']['name'] ); ?></span>
	<table class="line-break">
		<tbody>
		<?php foreach ( $category['TriggerCategory']['FinanceCategory'] as $financeCategory ): ?>
			<?php foreach ( $financeCategory['Data'] as $expense ): ?>
				<tr>
					<td style="width: 40%;"><?php echo h( $expense['ExpenseCategory']['name'] ); ?></td>
					<td style="width: 10%;"
					    class="text-center"><?php
						if ( ! empty( $expense['Expense']['frequency'] ) ) {
							echo h( Expense::frequencies( $expense['Expense']['frequency'] ) );
						} else {
							echo h( Expense::frequencies( Expense::FREQUENCY_MONTHLY ) );
						}
						?></td>
					<td style="width: 10%;"
					    class="text-right">&pound;<?php echo( ! empty( $expense['Expense']['id'] ) ? NumberLib::precision( $expense['Expense']['amount'], 2 ) : '0.00' ); ?></td>
					<td style="width: 40%; padding-left: 20px;"><?php echo h( $expense['Expense']['comment'] ); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>
</body>
</html>
