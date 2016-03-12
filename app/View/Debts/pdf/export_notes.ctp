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
			<span class="text-bold text-largest"><?php echo __( 'Client Progress' ); ?></span>
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
			<span><?php echo __( '%s - %s', $debt['Client']['code'], $debt['Client']['PrimaryPerson']['full_name'] ); ?></span>
		</td>
	</tr>
	</tbody>
</table>

<table>
	<tbody>
	<?php if ( empty( $debt['DebtNote'] ) ): ?>
		<tr>
			<td class="text-center">
				<span><?php echo __( 'No Progress Activity Found' ); ?></span>
			</td>
		</tr>
	<?php else: ?>
		<?php foreach ( $debt['DebtNote'] as $debtNote ): ?>
			<tr>
				<td class="left-column">
					<span
						class="text-bold"><?php echo __( 'Date:' ); ?></span>&nbsp;<?php echo $this->Time->format( $debtNote['created'],
						'%d/%m/%Y %H:%M' ); ?>
				</td>
				<td class="right-column">
					<p><?php echo nl2br( $debtNote['text'] ); ?></p>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>
</body>
</html>
