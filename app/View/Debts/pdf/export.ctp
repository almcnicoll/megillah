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
			<span class="text-bold text-largest"><?php echo __( 'Client Debts' ); ?></span>
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

<table>
	<thead>
	<tr>
		<th><span><?php echo __( 'Creditor' ); ?></span></th>
		<th><span><?php echo __( 'Reference' ); ?></span></th>
		<th><span><?php echo __( 'Amount' ); ?></span></th>
		<th><span><?php echo __( 'Debt Category' ); ?></span></th>
	</tr>
	</thead>
	<tbody>
	<?php if ( empty( $debts ) ): ?>
		<tr>
			<td class="text-center">
				<span><?php echo __( 'No Debt Records Found' ); ?></span>
			</td>
		</tr>
	<?php else: ?>
		<?php foreach ( $debts as $debt ): ?>
			<tr>
				<td><span><?php echo h( $debt['Creditor']['name'] ); ?></span></td>
				<td><span><?php echo h( $debt['Debt']['reference'] ); ?></span></td>
				<td><span><?php echo $this->Number->currency( $debt['Debt']['amount'],
							$client['Country']['Currency']['code'] ); ?></span></td>
				<td><span><?php echo h( $debt['DebtCategory']['name'] ); ?></span></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>
</body>
</html>
