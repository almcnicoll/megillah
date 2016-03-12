<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Client' ); ?>&nbsp;
				<small><?php echo __( '%s - %s', $debt['Client']['code'], $debt['Client']['PrimaryPerson']['full_name'] ); ?></small>
			</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<?php echo $this->element( 'clienttabnavigation', array(
			'controller' => $this->params['controller'],
			'id'         => $debt['Client']['id']
		) ); ?>
		<br/>
		<?php echo $this->Form->create( 'Debt', array(
			'class'         => 'form-horizontal',
			'inputDefaults' => array(
				'class' => 'form-control',
				'div'   => false,
				'error' => array(
					'attributes' => array(
						'wrap'  => 'span',
						'class' => 'help-block'
					)
				),
				'label' => false
			),
			'role'          => 'form',
			'novalidate'    => true
		) ); ?>
		<fieldset>
			<legend><?php echo __( 'Edit' ); ?></legend>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Form->input( 'id' ); ?>
					<div
						class="form-group <?php echo ( $this->Form->error( 'creditor_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'creditor_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group">
								<?php echo $this->Form->input( 'creditor_id' ); ?>
								<span class="input-group-btn">
									<button id="show-add-creditor-container" class="btn btn-default"
									        type="button"><?php echo __( 'New' ); ?></button>
								</span>
							</div>
							<div id="creditor-address">
								<hr/>
								<div class="well well-sm">
									<?php if ( ! empty( $debt['Creditor']['address_line_1'] ) ): ?>
										<?php echo h( $debt['Creditor']['address_line_1'] ); ?><br/>
									<?php endif; ?>
									<?php if ( ! empty( $debt['Creditor']['address_line_2'] ) ): ?>
										<?php echo h( $debt['Creditor']['address_line_2'] ); ?><br/>
									<?php endif; ?>
									<?php if ( ! empty( $debt['Creditor']['address_line_3'] ) ): ?>
										<?php echo h( $debt['Creditor']['address_line_3'] ); ?><br/>
									<?php endif; ?>
									<?php if ( ! empty( $debt['Creditor']['city'] ) ): ?>
										<?php echo h( $debt['Creditor']['city'] ); ?><br/>
									<?php endif; ?>
									<?php if ( ! empty( $debt['Creditor']['county'] ) ): ?>
										<?php echo h( $debt['Creditor']['county'] ); ?><br/>
									<?php endif; ?>
									<?php echo h( $debt['Creditor']['postcode'] ); ?>
								</div>
							</div>
						</div>
					</div>
					<div id="add-creditor-container" class="hide">
						<hr/>
						<div class="form-group">
							<div class="col-sm-9 col-sm-push-3">
								<h4><?php echo __( 'Add Creditor' ); ?></h4>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.name', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.name',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.display_name', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.display_name',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.address_line_1', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.address_line_1',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.address_line_2', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.address_line_2',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.address_line_3', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.address_line_3',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.city', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.city',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.county', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.county',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.postcode', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.postcode',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.phone', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.phone',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.mobile', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.mobile',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.email', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.email',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.website', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.website',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.country_id', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.country_id',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->Form->label( 'Creditor.organisation_id', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->input( 'Creditor.organisation_id',
									array( 'disabled' => true, 'class' => 'form-control debt-creditor-input' ) ); ?>
							</div>
						</div>
						<hr/>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'debt_category_id' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'debt_category_id', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'debt_category_id' ); ?>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'amount' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'amount', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">&pound;</span>
								<?php echo $this->Form->input( 'amount',
									array( 'min' => 0, 'step' => 0.001 ) ); ?>
							</div>
						</div>
					</div>
					<div
						class="form-group <?php echo ( $this->Form->error( 'account_code' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'account_code', __( 'Account Number' ),
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'account_code' ); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div
						class="form-group <?php echo ( $this->Form->error( 'reference' ) !== null ) ? 'has-error' : ''; ?>">
						<?php echo $this->Form->label( 'reference', null,
							array( 'class' => 'col-sm-3 control-label' ) ); ?>
						<div class="col-sm-9">
							<?php echo $this->Form->input( 'reference' ); ?>
						</div>
					</div>
					<?php if ( empty( $debt['Debt']['is_priority'] ) ): ?>
						<div
							class="form-group <?php echo ( $this->Form->error( 'is_pro_rata' ) !== null ) ? 'has-error' : ''; ?>">
							<?php echo $this->Form->label( 'is_pro_rata', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->checkbox( 'is_pro_rata' ); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $this->request->data['Debt']['is_pro_rata'] )): ?>
					<div id="offer-container" class="hidden">
						<?php else: ?>
						<div id="offer-container">
							<?php endif; ?>
							<div
								class="form-group <?php echo ( $this->Form->error( 'offer' ) !== null ) ? 'has-error' : ''; ?>">
								<?php echo $this->Form->label( 'offer', null,
									array( 'class' => 'col-sm-3 control-label' ) ); ?>
								<div class="col-sm-9">
									<div class="input-group">
										<span class="input-group-addon">&pound;</span>
										<?php echo $this->Form->input( 'offer',
											array( 'min' => 0, 'step' => 0.001 ) ); ?>
									</div>
								</div>
							</div>
							<div
								class="form-group <?php echo ( $this->Form->error( 'offer_frequency' ) !== null ) ? 'has-error' : ''; ?>">
								<?php echo $this->Form->label( 'offer_frequency', null,
									array( 'class' => 'col-sm-3 control-label' ) ); ?>
								<div class="col-sm-9">
									<?php echo $this->Form->input( 'offer_frequency',
										array( 'options' => Debt::frequencies() ) ); ?>
								</div>
							</div>
						</div>
						<div
							class="form-group <?php echo ( $this->Form->error( 'is_judgment' ) !== null ) ? 'has-error' : ''; ?>">
							<?php echo $this->Form->label( 'is_judgment', null,
								array( 'class' => 'col-sm-3 control-label' ) ); ?>
							<div class="col-sm-9">
								<?php echo $this->Form->checkbox( 'is_judgment' ); ?>
							</div>
						</div>
						<br/>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit"
								        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Save' ); ?></button>
								<button type="submit"
								        class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Save' ); ?></button>
							</div>
						</div>
					</div>
				</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Form->postLink( __( 'Delete' ),
					array( 'action' => 'delete', $this->Form->value( 'Debt.id' ) ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this debt?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Debts' ) ),
					array( 'action' => 'manage', $debt['Client']['id'] ) ); ?></li>
			<li class="nav-divider"></li>
			<?php echo $this->element( 'clientsidenavigation', array(
				'id'                 => $debt['Client']['id'],
                                'cfs_licence_number' => $debt['Client']['Centre']['cfs_licence_number'],
                                'centre_id'          => $debt['Client']['Centre']['id'],
                                'client_code'        => $debt['Client']['code']
			) ); ?>
		</ul>
	</div>
</div>

<?php
$getCreditorURL = $this->Html->url( array( 'controller' => 'creditors', 'action' => 'details', 'ext' => 'json' ) );

$script = <<<EOT
	$('#DebtIsProRata').change(function() {
		if ($('#DebtIsProRata').is(':checked')) {
			$('#offer-container').addClass('hidden');
		} else {
			$('#offer-container').removeClass('hidden');
		}
	});

	$('#show-add-creditor-container').on('click', function(event) {
		if ($('#add-creditor-container').hasClass('hide')) {
			$('#add-creditor-container').removeClass('hide');
			$('#DebtCreditorId').prop('disabled', true);
			$('.debt-creditor-input').prop('disabled', false);
			$(this).text('Cancel');
		} else {
			$('#add-creditor-container').addClass('hide');
			$('#DebtCreditorId').prop('disabled', false);
			$('.debt-creditor-input').prop('disabled', true);
			$(this).text('New');
		}
	});

	$('#DebtCreditorId').on('change', function(event) {
		var creditorID = $(this).val();
		if (creditorID) {
			$.ajax({
				async: true,
				data: { creditor_id: creditorID },
				type: 'POST',
				url: '{$getCreditorURL}'
			}).done(function(json) {
				if (json.content) {
					$('#creditor-address').removeClass('hide');
					var address = '';
					if (json.content.address_line_1) {
						address += json.content.address_line_1 + '<br/>';
					}
					if (json.content.address_line_2) {
						address += json.content.address_line_2 + '<br/>';
					}
					if (json.content.address_line_3) {
						address += json.content.address_line_3 + '<br/>';
					}
					if (json.content.city) {
						address += json.content.city + '<br/>';
					}
					if (json.content.county) {
						address += json.content.county + '<br/>';
					}
					if (json.content.postcode) {
						address += json.content.postcode + '<br/>';
					}
					$('#creditor-address > div.well').html(address);
				} else {
					alert('Error: No Content.');
				}
			});
		} else {
			$('#creditor-address').addClass('hide');
		}
	});
EOT;

$this->Js->buffer( $script );
?>
