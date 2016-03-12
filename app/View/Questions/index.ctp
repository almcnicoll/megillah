<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Questions' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<table class="table table-condensed table-hover">
			<tbody>
			<?php if ( empty( $questions ) ): ?>
				<tr>
					<td class="text-center" colspan="2">
						<span><?php echo __( 'No Questions Found' ); ?></span>
					</td>
				</tr>
			<?php else: ?>
				<?php foreach ( $questions as $question ): ?>
					<?php if ( ! empty( $question['Question']['is_active'] ) ): ?>
						<tr>
					<?php else: ?>
						<tr class="danger">
					<?php endif; ?>
					<td>
						<?php echo h( $question['Question']['text'] ); ?>
					</td>
					<td>
						<?php echo Question::roles( $question['Question']['role'] ); ?>
					</td>
					<td class="text-right">
						<div class="dropdown">
							<a data-toggle="dropdown" href="javascript:void(0)"><?php echo __( 'Actions' ); ?>
								&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><?php echo $this->Html->link( __( 'View Details' ),
										array( 'action' => 'view', $question['Question']['id'] ) ); ?></li>
								<li class="divider"></li>
								<?php if ( empty( $question['Question']['is_active'] ) ): ?>
									<li><?php echo $this->Form->postLink( __( 'Activate' ),
											array( 'action' => 'activate', $question['Question']['id'] ),
											array( 'class' => 'text-danger' ),
											__( 'Are you sure you want to activate this question?' ) ); ?></li>
								<?php else: ?>
									<li><?php echo $this->Form->postLink( __( 'Deactivate' ),
											array( 'action' => 'deactivate', $question['Question']['id'] ),
											array( 'class' => 'text-danger' ),
											__( 'Are you sure you want to deactivate this question?' ) ); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php echo $this->element( 'Tools.pagination' ); ?>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Question' ) ), array( 'action' => 'add' ) ); ?></li>
		</ul>
	</div>
</div>
