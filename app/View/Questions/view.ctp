<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			<h1><?php echo __( 'Question' ); ?></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-2">
		<div class="row">
			<div class="col-lg-6">
				<?php
				if ( ! empty( $question['Question']['is_active'] ) ): ?>
					<div class="alert alert-info">
						<?php echo __( 'Active' ); ?>
					</div>
				<?php endif; ?>
				<dl class="dl-horizontal">
					<dt><?php echo __( 'Question' ); ?></dt>
					<dd>
						<?php echo h( $question['Question']['text'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Type' ); ?></dt>
					<dd>
						<?php echo Question::types( $question['Question']['type'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Role' ); ?></dt>
					<dd>
						<?php echo Question::roles( $question['Question']['role'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Rank' ); ?></dt>
					<dd>
						<?php echo h( $question['Question']['rank'] ); ?>
						&nbsp;
					</dd>
					<dt><?php echo __( 'Created' ); ?></dt>
					<dd>
						<?php echo $this->Time->format( $question['Question']['created'], '%A, %d %B %Y, %H:%M' ); ?>
						&nbsp;
					</dd>
					<?php if ( $question['Question']['created'] !== $question['Question']['modified'] ) { ?>
						<dt><?php echo __( 'Modified' ); ?></dt>
						<dd>
							<?php echo $this->Time->format( $question['Question']['modified'],
								'%A, %d %B %Y, %H:%M' ); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
				<?php if ( (int) $question['Question']['type'] === Question::TYPE_CUSTOM ): ?>
					<hr/>
					<h3><?php echo __( 'Related %s', __( 'Answers' ) ); ?></h3>
					<table class="table table-condensed table-hover">
						<thead>
						<tr>
							<th><?php echo __( 'Text' ); ?></th>
							<th><?php echo __( 'Value' ); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php if ( empty( $question['Answer'] ) ): ?>
							<tr>
								<td class="text-center" colspan="3">
									<span><?php echo __( 'No Related Answer Found' ); ?></span>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ( $question['Answer'] as $answer ): ?>
								<tr>
									<td><?php echo $answer['text']; ?></td>
									<td><?php echo $answer['value']; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-md-pull-10">
		<ul class="nav nav-pills nav-stacked">
			<?php if ( (int) $question['Question']['type'] === Question::TYPE_CUSTOM ): ?>
				<li><?php echo $this->Html->link( __( 'New %s', __( 'Answer' ) ), 'javascript:void(0)',
						array( 'id' => 'open-add-answer-modal' ) ); ?></li>
				<li class="nav-divider"></li>
			<?php endif; ?>
			<li><?php echo $this->Html->link( __( 'New %s', __( 'Question' ) ), array( 'action' => 'add' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'Edit %s', __( 'Question' ) ),
					array( 'action' => 'edit', $question['Question']['id'] ) ); ?></li>
			<li><?php echo $this->Form->postLink( __( 'Delete %s', __( 'Question' ) ),
					array( 'action' => 'delete', $question['Question']['id'] ), array( 'class' => 'text-danger' ),
					__( 'Are you sure you want to delete this question?' ) ); ?></li>
			<li><?php echo $this->Html->link( __( 'List %s', __( 'Questions' ) ),
					array( 'action' => 'index' ) ); ?></li>
		</ul>
	</div>
</div>

<div class="modal fade" id="add-answer-modal" tabindex="-1" role="dialog" aria-labelledby="add-answer-modal-label"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php echo $this->Form->create( 'Answer', array(
				'inputDefaults' => array(
					'class' => 'form-control',
					'div'   => false,
					'error' => array( 'attributes' => array( 'wrap' => 'span', 'class' => 'help-block' ) ),
					'label' => false
				),
				'url'           => array( 'controller' => 'answers', 'action' => 'add', $question['Question']['id'] ),
				'role'          => 'form'
			) ); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="add-note-modal-label"><?php echo __( 'New Answer' ); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<?php echo $this->Form->input( 'value', array( 'id' => 'AddAnswerValue' ) ); ?>
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
    $('#open-add-answer-modal').on('click', function(event) {
      $('#add-answer-modal').modal();
    });
EOT;

$this->Js->buffer( $script );
?>
