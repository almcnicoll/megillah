<?php
	$item_limit = 500;
	$item_count = count($actions);
	$truncate_warning = null;
	if (count($actions) > $item_limit) {
		$actions = array_splice($actions, 0, $item_limit); // Shorten array ...
		$truncate_warning = " (latest {$item_limit} of {$item_count} entries)"; // ... and warn them
	}
?>
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
			<span class="text-bold text-largest"><?php echo __( 'Client Progress' ); if ($truncate_warning != null) { echo $truncate_warning; } ?></span>
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
	<tbody>
	<?php if ( empty( $actions ) ): ?>
		<tr>
			<td class="text-center">
				<span><?php echo __( 'No Client Actions Found' ); ?></span>
			</td>
		</tr>
	<?php else: ?>
		<?php foreach ( $actions as $action ): ?>
			<tr>
				<td class="left-column">
					<span
						class="text-bold"><?php echo __( 'Date:' ); ?></span>&nbsp;<?php echo $this->Time->format( $action['Action']['created'],
						'%d/%m/%Y %H:%M' ); ?>
				</td>
				<td class="right-column">
					<span class="text-bold"><?php
						$text = null;
						if ( ! empty( $action['Action']['title'] ) ) {
							$text = __( '%s - (%s)', Action::models( $action['Action']['model'] ),
								$action['Action']['title'] );
						} else {
							$text = h( Action::models( $action['Action']['model'] ) );
						}
						echo __( '%s', $text );
						?></span>
					<?php if ( ! empty( $action['Action']['text'] ) ): ?>
						<p><?php echo nl2br( $action['Action']['text'] ); ?></p>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>
</body>
</html>
