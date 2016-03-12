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
		<div class="row">
			<div class="col-lg-6">
				<h3><?php echo __( 'Statistics Reporting' ); ?></h3>

				<p><?php echo __( 'Answers to the following questions should be input whenever a client\'s case is reviewed. Typically every six months, and at a minimum annually. Input data will build to create a statistical report for your centre for use in local marketing, fundraising and PR, and for the CMA network as a whole for vital national reporting.' ); ?></p>

				<?php echo $this->Form->create( 'ClientResponse', array(
					'inputDefaults' => array(
						'div'   => false,
						'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
						'label' => false
					),
					'role'          => 'form',
					'url'           => array(
						'controller' => 'client_responses',
						'action'     => 'update',
						$client['Client']['id']
					)
				) ); ?>
				<h3><?php echo __( 'Adviser Questions' ); ?></h3>
				<?php $count = 0; ?>
				<table class="table table-condensed table-hover">
					<tbody>
					<?php foreach ( $adviserQuestions as $adviserQuestion ): ?>
						<tr>
							<td class="text-center">
								<?php if ( ! empty( $adviserQuestion['ClientResponse']['id'] ) ): ?>
									<?php echo $this->Form->hidden( __( 'ClientResponse.%d.id', $count ),
										array( 'value' => $adviserQuestion['ClientResponse']['id'] ) ); ?>
								<?php endif; ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.question_id', $count ),
									array( 'value' => $adviserQuestion['Question']['id'] ) ); ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.client_id', $count ),
									array( 'value' => $client['Client']['id'] ) ); ?>
								<?php echo $this->Form->checkbox( __( 'ClientResponse.%d.value', $count ),
									array(
										'class'   => 'letter-checkbox',
										'checked' => ! empty( $adviserQuestion['ClientResponse']['value'] ),
									) ); ?>
							</td>
							<td><?php echo $adviserQuestion['Question']['text']; ?></td>
						</tr>
						<?php $count ++; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
				<h3><?php echo __( 'Client Questions' ); ?></h3>

				<p><?php echo __( 'Best practice is that these questions are handed to the client on a slip (or by electronic means) and they are asked to be completely honest in their replies. If their replies are negative the adviser should obviously seek to resolve that through discussion and extra support as appropriate, but MUST be reported as given at the time of that review.' ); ?></p>

				<table class="table table-condensed table-hover">
					<tbody>
					<?php foreach ( $clientQuestions as $clientQuestion ): ?>
						<tr>
							<td class="text-center">
								<?php if ( ! empty( $clientQuestion['ClientResponse']['id'] ) ): ?>
									<?php echo $this->Form->hidden( __( 'ClientResponse.%d.id', $count ),
										array( 'value' => $clientQuestion['ClientResponse']['id'] ) ); ?>
								<?php endif; ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.question_id', $count ),
									array( 'value' => $clientQuestion['Question']['id'] ) ); ?>
								<?php echo $this->Form->hidden( __( 'ClientResponse.%d.client_id', $count ),
									array( 'value' => $client['Client']['id'] ) ); ?>
								<?php echo $this->Form->checkbox( __( 'ClientResponse.%d.value', $count ),
									array(
										'class'   => 'letter-checkbox',
										'checked' => ! empty( $clientQuestion['ClientResponse']['value'] ),
									) ); ?>
							</td>
							<td><?php echo $clientQuestion['Question']['text']; ?></td>
						</tr>
						<?php $count ++; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
				<button type="submit"
				        class="btn btn-primary btn-block visible-xs visible-sm"><?php echo __( 'Save' ); ?></button>
				<button type="submit" class="btn btn-primary hidden-xs hidden-sm"><?php echo __( 'Save' ); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'Back to Client' ),
					array( 'action' => 'view', $client['Client']['id'] ) ); ?></li>
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
