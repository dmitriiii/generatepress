<? $c_post = get_post($atts['id']);
$cnt = $c_post->post_content;
$m5_acf_pop_url = get_field('m5_acf_pop_url',$atts['id']);
global $wp;?>
<div class="pupop-wrapper" data-type="<?= get_field('m5_acf_pop_type', $atts['id']); ?>">
	<a data-red="<?= get_site_url() . $m5_acf_pop_url; ?>" href="<?= home_url( $wp->request ); ?>" rel="nofollow" target="_blank" class="pupop__link">&nbsp;</a>
	<section id="sales" class="pupop pupop--white" data-delay data-times="<?= get_field('m5_acf_pop_times', $atts['id']); ?>">
		<?= get_the_post_thumbnail( $atts['id'], 'large', ['class'=>'pupop__bg'] ); ?>
		<a class="pupop__btn-close" aria-label="close" data-red="<?= get_site_url() . $m5_acf_pop_url; ?>" href="<?= home_url( $wp->request ); ?>" target="_blank" rel="nofollow">
			<i class="fas fa-times"></i>
		</a>
		<div class="pupop__inner pupop__inner--centered">
			<?= wp_get_attachment_image( get_field('m5_acf_pop_logo',$atts['id']), 'medium' ); ?>
			<h2 class="pupop__title">
				<?= $c_post->post_title; ?>
			</h2>
			<div class="pupop__content">
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
			<div class="pupop__actions">
				<a href="<?= $m5_acf_pop_url; ?>" target="_blank" rel="nofollow" class="button button--red pupop__button">
					Jetzt sichern!
				</a>
			</div>
		</div>
	</section>
</div>