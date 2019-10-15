<?php
/**
 * Template for question list item.
 *
 * @link    https://anspress.io
 * @since   0.1
 * @license GPL 2+
 * @package AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

$clearfix_class = array( 'ap-questions-item clearfix' );


$qid = get_the_ID();
global $answers;
$answrs = ap_get_answers(array('question_id' => $qid )); ?>

<script type="application/ld+json">
	<?php 
	echo K8Schema::getQAPage([
		'qid' => $qid,
		'quest' => get_post( $qid ),
		'answrs'=> $answrs
	]); ?>
</script>


<div id="question-<?php the_ID(); ?>" <?php post_class( $clearfix_class ); ?>>
	<div class="ap-questions-inner">
		<div class="ap-avatar ap-pull-left">
			<a href="<?php ap_profile_link(); ?>">
				<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>
		<div class="ap-list-counts">
			<!-- Votes count -->
			<?php if ( ! ap_opt( 'disable_voting_on_question' ) ) : ?>
				<span class="ap-questions-count ap-questions-vcount">
					<span><?php ap_votes_net(); ?></span>
					<?php _e( 'Votes', 'anspress-question-answer' ); ?>
				</span>
			<?php endif; ?>

			<!-- Answer Count -->
			<a class="ap-questions-count ap-questions-acount" href="<?php echo ap_answers_link(); ?>">
				<span><?php ap_answers_count(); ?></span>
				<?php _e( 'Ans', 'anspress-question-answer' ); ?>
			</a>
		</div>

		<div class="ap-questions-summery">
			<span class="ap-questions-title">
				<?php ap_question_status(); ?>
				<a class="ap-questions-hyperlink" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</span>
			<div class="ap-display-question-meta">
				<?php echo ap_question_metas(); ?>
			</div>
		</div>
	</div>
</div><!-- list item -->
