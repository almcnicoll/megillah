<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $client['Client']['code'], $client['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $client['Client']['id']
		) ); ?>
		<br/>

		<div class="row">
			<div class="col-lg-6">
				<div id="income-warning" class="alert alert-warning alert-dismissible hide" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __( 'Close' ); ?></span>
					</button>
					<strong><?php echo __( 'Warning!' ); ?></strong>&nbsp;<?php echo __( 'Unsaved Income Data.' ); ?>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __( 'Income (%s Monthly Total)',
								$this->Number->currency( $totalIncome,
									$client['Country']['Currency']['code'] ) ); ?></h3>
					</div>
					<?php if ( ! empty( $topIncomes ) ): ?>
						<table class="table">
							<thead>
							<tr>
								<th><?php echo __( 'Top Incomes (Monthly)' ); ?></th>
								<th><?php echo __( '' ); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ( $topIncomes as $income ): ?>
								<tr>
									<td><?php echo h( $income['IncomeCategory']['name'] ); ?></td>
									<td class="text-right"><?php echo $this->Number->currency( $income['Income']['monthly_amount'],
											$client['Country']['Currency']['code'] ); ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="panel-body">
							<p><?php echo __( 'No Incomes Found' ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-6">
				<div id="expense-warning" class="alert alert-warning alert-dismissible hide" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __( 'Close' ); ?></span>
					</button>
					<strong><?php echo __( 'Warning!' ); ?></strong>&nbsp;<?php echo __( 'Unsaved Expense Data.' ); ?>
				</div>
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __( 'Expenditure (%s Monthly Total)',
								$this->Number->currency( $totalExpense,
									$client['Country']['Currency']['code'] ) ); ?></h3>
					</div>
					<?php if ( ! empty( $topExpenses ) ): ?>
						<table class="table">
							<thead>
							<tr>
								<th><?php echo __( 'Top Expenses (Monthly)' ); ?></th>
								<th><?php echo __( '' ); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ( $topExpenses as $expense ): ?>
								<tr>
									<td><?php echo h( $expense['ExpenseCategory']['name'] ); ?></td>
									<td class="text-right"><?php echo $this->Number->currency( $expense['Expense']['monthly_amount'],
											$client['Country']['Currency']['code'] ); ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="panel-body">
							<p><?php echo __( 'No Expenses Found' ); ?></p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- Trigger Figures -->
		<div class="row">
			<div class="col-lg-12">
				<h3><?php echo __( 'Trigger Figures' ); ?></h3>
				<?php if ( ! empty( $client['Centre']['cfs_licence_number'] ) ): ?>
					<table class="table">
						<thead>
						<tr>
							<th><?php echo __( '' ); ?></th>
							<th><?php echo __( 'Spend' ); ?></th>
							<th><?php echo __( 'Trigger' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ( $triggerCategories as $triggerCategory ): ?>
							<?php
							$spend = 0;
							foreach ( $expenses as $expense ) {
								if ( $triggerCategory['TriggerCategory']['id'] === $expense['TriggerCategory']['id'] ) {
									$spend += $expense['Expense']['monthly_amount'];
								}
							}
							$trigger    = 0;
							$clientRead = false; // Hack to handle data imported with more than one client person.
							foreach ( $client['Person'] as $person ) {
								if ( (int) $person['age'] >= 18 ) {
									if ( ! $clientRead ) {
										if ( (int) $person['role'] === 1 ) {
											$trigger += $triggerCategory['TriggerFigure'][0]['value'];
											$clientRead = true;
										} else {
											$trigger += $triggerCategory['TriggerFigure'][1]['value'];
										}
									} else {
										$trigger += $triggerCategory['TriggerFigure'][1]['value'];
									}
								} else {
									if ( (int) $person['age'] >= 14 ) {
										$trigger += $triggerCategory['TriggerFigure'][2]['value'];
									} else {
										$trigger += $triggerCategory['TriggerFigure'][3]['value'];
									}
								}
							}
							if ( ! empty( $triggerCategory['TriggerFigure'][4]['value'] ) ) {
								$trigger += $triggerCategory['TriggerFigure'][4]['value'] * $client['Client']['number_of_cars'];
							}
							?>
							<?php if ( $spend > $trigger ): ?>
								<tr class="danger">
							<?php elseif ( $spend > ( $trigger / 100 ) * 80 ): ?>
								<tr class="warning">
							<?php
							else: ?>
								<tr class="success">
							<?php endif; ?>
							<td><?php echo h( $triggerCategory['TriggerCategory']['name'] ); ?></td>
							<td><?php echo $this->Number->currency( $spend,
									$client['Country']['Currency']['code'] ); ?></td>
							<td><?php echo $this->Number->currency( $trigger,
									$client['Country']['Currency']['code'] ); ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p><?php echo __( 'Please edit your Centre and enter your CFS Licence Number to use the Trigger Figures functionality.' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Manage %s', __( 'Income' ) ), 'javascript:void(0)',
					array( 'id' => 'open-income-modal', 'oncontextmenu' => 'return false;' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Manage %s', __( 'Expenditure' ) ), 'javascript:void(0)',
					array( 'id' => 'open-expense-modal', 'oncontextmenu' => 'return false;' ) ); ?></li>
			<li class="nav-divider"></li>
			<li><?php echo $this->Html->link( __( 'Export %s', __( 'Finances' ) ), array(
					'action' => 'export',
					$client['Client']['id'],
					'ext'    => 'pdf'
				), array( 'target' => '_blank' ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $client['Client']['id'],
                                'cfs_licence_number' => $client['Centre']['cfs_licence_number'],
                                'centre_id'          => $client['Centre']['id'],
                                'client_code'        => $client['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<div class="modal fade" id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="expense-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<?php echo $this->Form->create( 'Expense', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => 'expenses', 'action' => 'update', $client['Client']['id'] ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="expense-modal-label"><?php echo __( 'Manage Expenditure' ); ?></h4>
			</div>
			<div class="modal-body">
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
				?>
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<?php foreach ( $categories as $category ): ?>
						<li class="<?php if ( $category === reset( $categories ) ) {
							echo __( 'active' );
						} ?>"><a href="#<?php echo __( 'expense%s%d',
								strtolower( preg_replace( '/[^A-Za-z0-9]|(\s+)/', '',
									$category['TriggerCategory']['name'] ) ),
								$category['TriggerCategory']['id'] ); ?>" role="tab"
						         data-toggle="tab"><?php echo h( $category['TriggerCategory']['name'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php $count = 0; ?>
					<?php foreach ( $categories as $category ): ?>
						<div class="tab-pane <?php if ( $category === reset( $categories ) ) {
							echo __( 'active' );
						} ?>" id="<?php echo __( 'expense%s%d', strtolower( preg_replace( '/[^A-Za-z0-9]|(\s+)/', '',
							$category['TriggerCategory']['name'] ) ), $category['TriggerCategory']['id'] ); ?>">
							<br/>

							<?php foreach ( $category['TriggerCategory']['FinanceCategory'] as $financeCategory ): ?>
								<?php if ( count( $category['TriggerCategory']['FinanceCategory'] ) > 1 ): ?>
									<div class="row">
										<div class="col-lg-12">
											<h4><?php echo h( $financeCategory['name'] ); ?></h4>
										</div>
									</div>
								<?php endif; ?>
								<div class="row">
									<div class="col-lg-6">
										<?php $break = $count + ceil( count( $financeCategory['Data'] ) / 2 ); ?>
										<?php foreach ($financeCategory['Data'] as $expense): ?>
										<?php if ($count === (int) $break): ?>
									</div>
									<div class="col-lg-6">
										<?php endif; ?>
										<?php if ( ! empty( $expense['Expense']['id'] ) ): ?>
											<?php echo $this->Form->hidden( __( 'Expense.%d.id', $count ),
												array( 'value' => $expense['Expense']['id'] ) ); ?>
										<?php endif; ?>
										<?php echo $this->Form->hidden( __( 'Expense.%d.client_id', $count ),
											array( 'value' => $client['Client']['id'] ) ); ?>
										<?php echo $this->Form->hidden( __( 'Expense.%d.expense_category_id', $count ),
											array( 'value' => $expense['ExpenseCategory']['id'] ) ); ?>
										<div class="form-group finance-container">
											<?php echo $this->Form->label( __( 'Expense.%d.amount', $count ),
												__( '%s. %s', $expense['ExpenseCategory']['code'],
													$expense['ExpenseCategory']['name'] ),
												array( 'class' => 'control-label' ) ); ?>
											<div class="row">
												<div class="col-xs-7">
													<div class="input-group">
														<div class="input-group-addon">&pound;</div>
														<?php echo $this->Form->input( __( 'Expense.%d.amount',
															$count ), array(
															'value' => ( ! empty( $expense['Expense']['id'] ) ? NumberLib::precision( $expense['Expense']['amount'],
																2 ) : '0.00' ),
															'min'   => 0,
															'step'  => '0.01'
														) ); ?>
														<span class="input-group-btn">
													<?php
													$button = 'default';
													if ( ! empty( $expense['Expense']['comment'] ) ) {
														$button = 'info';
													}
													?>
															<button
																class="btn btn-<?php echo h( $button ); ?> add-comment"
																type="button">
																<span class="glyphicon glyphicon-pencil"></span>
															</button>
												</span>
													</div>
												</div>
												<div class="col-xs-5">
													<?php echo $this->Form->input( __( 'Expense.%d.frequency', $count ),
														array(
															'options' => Expense::frequencies(),
															'value'   => ( ! empty( $expense['Expense']['id'] ) ? $expense['Expense']['frequency'] : 4 )
														) ); ?>
												</div>
											</div>
											<div class="row <?php echo ( empty( $expense['ExpenseCategory']['is_customisable'] ) ? __('hide comment-container') : __('') ); ?>">
												<?php
												if ( ! empty( $expense['ExpenseCategory']['is_customisable'] ) ):
												?>
												<div class="col-xs-5">
													<br/>
													<?php echo $this->Form->input( __( 'Expense.%d.name', $count ),
														array( 'value' => $expense['Expense']['name'], 'placeholder' => __('CFS Label') ) ); ?>
												</div>
												<div class="col-xs-7">
													<br/>
													<?php echo $this->Form->input( __( 'Expense.%d.comment', $count ),
														array( 'value' => $expense['Expense']['comment'], 'placeholder' => __('Comment') ) ); ?>
												</div>
												<?php
												else:
												?>
												<div class="col-xs-12">
													<br/>
													<?php echo $this->Form->input( __( 'Expense.%d.comment', $count ),
														array( 'value' => $expense['Expense']['comment'] ) ); ?>
												</div>
												<?php
												endif;
												?>
											</div>
										</div>
										<?php $count ++; ?>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
				<button type="submit" class="btn btn-primary"><?php echo __( 'Save' ); ?></button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<div class="modal fade" id="income-modal" tabindex="-1" role="dialog" aria-labelledby="income-modal-label"
     aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<?php echo $this->Form->create( 'Income', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => 'incomes', 'action' => 'update', $client['Client']['id'] ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="income-modal-label"><?php echo __( 'Manage Incomes' ); ?></h4>
			</div>
			<div class="modal-body">
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
				?>
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<?php foreach ( $financeCategories as $financeCategory ): ?>
						<li class="<?php if ( $financeCategory === reset( $financeCategories ) ) {
							echo __( 'active' );
						} ?>"><a href="<?php echo __( '#income%s%d',
								strtolower( preg_replace( '/[^A-Za-z0-9]|(\s+)/', '',
									$financeCategory['FinanceCategory']['name'] ) ),
								$financeCategory['FinanceCategory']['id'] ); ?>" role="tab"
						         data-toggle="tab"><?php echo h( $financeCategory['FinanceCategory']['name'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php $count = 0; ?>
					<?php foreach ( $financeCategories as $financeCategory ): ?>
						<div class="tab-pane <?php if ( $financeCategory === reset( $financeCategories ) ) {
							echo __( 'active' );
						} ?>" id="<?php echo __( 'income%s%d', strtolower( preg_replace( '/[^A-Za-z0-9]|(\s+)/', '',
							$financeCategory['FinanceCategory']['name'] ) ),
							$financeCategory['FinanceCategory']['id'] ); ?>">
							<br/>

							<div class="row">
								<div class="col-lg-6">
									<?php $break = $count + ceil( count( $financeCategory['Data'] ) / 2 ); ?>
									<?php foreach ($financeCategory['Data'] as $income): ?>
									<?php if ($count === (int) $break): ?>
								</div>
								<div class="col-lg-6">
									<?php endif; ?>
									<?php if ( ! empty( $income['Income']['id'] ) ): ?>
										<?php echo $this->Form->hidden( __( 'Income.%d.id', $count ),
											array( 'value' => $income['Income']['id'] ) ); ?>
									<?php endif; ?>
									<?php echo $this->Form->hidden( __( 'Income.%d.client_id', $count ),
										array( 'value' => $client['Client']['id'] ) ); ?>
									<?php echo $this->Form->hidden( __( 'Income.%d.income_category_id', $count ),
										array( 'value' => $income['IncomeCategory']['id'] ) ); ?>
									<div class="form-group finance-container">
										<?php echo $this->Form->label( __( 'Income.%d.amount', $count ),
											__( '%s. %s', $income['IncomeCategory']['code'],
												$income['IncomeCategory']['name'] ),
											array( 'class' => 'control-label' ) ); ?>
										<div class="row">
											<div class="col-xs-7">
												<div class="input-group">
													<div class="input-group-addon">&pound;</div>
													<?php echo $this->Form->input( __( 'Income.%d.amount', $count ),
														array(
															'value' => ( ! empty( $income['Income']['id'] ) ? NumberLib::precision( $income['Income']['amount'],
																2 ) : '0.00' ),
															'min'   => 0,
															'step'  => '0.01'
														) ); ?>
													<span class="input-group-btn">
													<?php
													$button = 'default';
													if ( ! empty( $income['Income']['comment'] ) ) {
														$button = 'info';
													}
													?>
														<button class="btn btn-<?php echo h( $button ); ?> add-comment"
														        type="button">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
												</span>
												</div>
											</div>
											<div class="col-xs-5">
												<?php echo $this->Form->input( __( 'Income.%d.frequency', $count ),
													array(
														'options' => Income::frequencies(),
														'value'   => ( ! empty( $income['Income']['id'] ) ? $income['Income']['frequency'] : 4 )
													) ); ?>
											</div>
										</div>
										<div class="row hide comment-container">
											<div class="col-xs-12">
												<br/>
												<?php echo $this->Form->input( __( 'Income.%d.comment', $count ),
													array( 'value' => $income['Income']['comment'] ) ); ?>
											</div>
										</div>
									</div>
									<?php $count ++; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
				<button type="submit" class="btn btn-primary"><?php echo __( 'Save' ); ?></button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<?php
$script = <<<EOT
    var unsavedExpenses = false;
    var unsavedIncomes = false;

    $('#open-expense-modal').on('click', function(event) {
        $('#expense-modal').modal();
    });

    $('#open-income-modal').on('click', function(event) {
        $('#income-modal').modal();
    });

    $('#expense-modal .form-control').on('change', function(event) {
        unsavedExpenses = true;
    });

    $('#income-modal .form-control').on('change', function(event) {
        unsavedIncomes = true;
    });

    $('#expense-modal').on('hide.bs.modal', function (event) {
			if (unsavedExpenses) {
				if (!window.confirm('Warning! Unsaved Data. Are you sure that you wish to exit without saving?')) {
					event.preventDefault();
				} else {
					document.location.reload(true);
				}
			}
    });

    $('#income-modal').on('hide.bs.modal', function (event) {
			if (unsavedIncomes) {
				if (!window.confirm('Warning! Unsaved Data. Are you sure that you wish to exit without saving?')) {
					event.preventDefault();
				} else {
					document.location.reload(true);
				}
			}
    });

    $('#expense-modal').on('hidden.bs.modal', function (event) {
        if (unsavedExpenses) {
            $('#expense-warning').removeClass('hide');
        }
    });

    $('#income-modal').on('hidden.bs.modal', function (event) {
        if (unsavedIncomes) {
            $('#income-warning').removeClass('hide');
        }
    });

    $('.add-comment').on('click', function(event) {
        $(this).parents('div.finance-container').find('div.comment-container').toggleClass('hide');
    });
EOT;

$this->Js->buffer( $script );
?>
