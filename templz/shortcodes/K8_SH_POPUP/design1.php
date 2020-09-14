<? $c_post = get_post($atts['id']);
$cnt = $c_post->post_content;
$m5_acf_pop_url = get_field('m5_acf_pop_url',$atts['id']);
// $cnt = apply_filters('the_content', $cnt);
// $cnt = str_replace(']]>', ']]&gt;', $cnt);
?>
<div class="popup-wrapper">
	<a href="<?= $m5_acf_pop_url; ?>" target="_blank" rel="nofollow" class="popup__link">&nbsp;</a>
	<section id="sales" class="popup popup--white" data-delay data-times="<?= get_field('m5_acf_pop_times', $atts['id']); ?>">
		<?= get_the_post_thumbnail( $atts['id'], 'large', ['class'=>'popup__bg'] ); ?>
		<button class="popup__btn-close" aria-label="close" data-redirect="<?= $m5_acf_pop_url; ?>">
			<i class="fas fa-times"></i>
		</button>
		<div class="popup__inner popup__inner--centered">
			<?= wp_get_attachment_image( get_field('m5_acf_pop_logo',$atts['id']), 'medium' ); ?>
			<h2 class="popup__title">
				<?= $c_post->post_title; ?>
			</h2>
			<div class="popup__content">
				<p><?= $cnt; ?></p>
				<div class="timer" data-date="<?
					$date = new DateTime( get_field('m5_acf_pop_date_to', $atts['id']) );
					$date->setTime(14, 55, 24);
					echo $date->format('Y-m-d H:i:s');
				?>">
					<div class="timer__tt"><span class="timer__dd">00</span><span class="timer__tooltip">days</span></div>
					<div class="timer__delimiter">:</div>
					<div class="timer__tt"><span class="timer__hh">00</span><span class="timer__tooltip">hours</span></div>
					<div class="timer__delimiter">:</div>
					<div class="timer__tt"><span class="timer__mm">00</span><span class="timer__tooltip">minutes</span></div>
					<div class="timer__delimiter">:</div>
					<div class="timer__tt"><span class="timer__ss">00</span><span class="timer__tooltip">seconds</span></div>
				</div>
			</div>
			<div class="popup__actions">
				<a href="<?= $m5_acf_pop_url); ?>" target="_blank" rel="nofollow" class="button button--red">
					Jetzt sichern!
				</a>
			</div>
		</div>
	</section>
</div>