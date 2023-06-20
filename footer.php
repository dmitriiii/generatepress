<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (!is_page_template('k8tpl-passgen.php') && !is_page_template('k8tpl-test.php')): ?>
	</div><!-- #content -->
</div><!-- #page --><?php
endif;

/**
 * generate_before_footer hook.
 *
 * @since 0.1
 */
do_action('mira_snackbar_bot', ['static', 'sticky']);
do_action( 'generate_before_footer' );
?>

<div <?php generate_do_element_classes( 'footer' ); ?>>
	<?php
	/**
	 * generate_before_footer_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_before_footer_content' );

	/**
	 * generate_footer hook.
	 *
	 * @since 1.3.42
	 *
	 * @hooked generate_construct_footer_widgets - 5
	 * @hooked generate_construct_footer - 10
	 */
	do_action( 'generate_footer' );

	/**
	 * generate_after_footer_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_after_footer_content' );
	?>
</div><!-- .site-footer -->


<?php
if( is_page_template( 'k8tpl-post-vpn-security.php' ) ): ?>
	<div class="modd" id="modd_safe">
		<div class="modd__content">
			<div class="modd__clz">
				<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 475.2 475.2" style="enable-background:new 0 0 475.2 475.2;" xml:space="preserve">
					<g>
						<g>
							<path d="M405.6,69.6C360.7,24.7,301.1,0,237.6,0s-123.1,24.7-168,69.6S0,174.1,0,237.6s24.7,123.1,69.6,168s104.5,69.6,168,69.6
								s123.1-24.7,168-69.6s69.6-104.5,69.6-168S450.5,114.5,405.6,69.6z M386.5,386.5c-39.8,39.8-92.7,61.7-148.9,61.7
								s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7,0-297.8C128.5,48.9,181.4,27,237.6,27s109.1,21.9,148.9,61.7
								C468.6,170.8,468.6,304.4,386.5,386.5z"/>
							<path d="M342.3,132.9c-5.3-5.3-13.8-5.3-19.1,0l-85.6,85.6L152,132.9c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1
								l85.6,85.6l-85.6,85.6c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.6-85.6l85.6,85.6c2.6,2.6,6.1,4,9.5,4
								c3.5,0,6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1l-85.4-85.6l85.6-85.6C347.6,146.7,347.6,138.2,342.3,132.9z"/>
						</g>
					</g>
				</svg>
			</div>
			<div class="modd__loader">
				<div class="lds-spinner">
					<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
				</div>
			</div>
			<div class="modd__txt"></div>
	  </div>
	</div>
<?php
endif ?>




<?php
$k8_acf_ifr_url = get_field('k8_acf_ifr_url', get_the_ID());
if( is_array( $k8_acf_ifr_url ) && count($k8_acf_ifr_url) > 0 ):
	foreach ($k8_acf_ifr_url as $item): ?>
		<div class="k8_acf_ifr_url" data-url="<?php echo $item['url']; ?>"></div>
	<?php
	endforeach;
endif;
/**
 * generate_after_footer hook.
 *
 * @since 2.1
 */
do_action( 'generate_after_footer' );

wp_footer();


?>
<div class="k8side__wraper" style="display: none;" data-txt="<?php _e( 'Inhaltsverzeichnis', 'k8lang_domain' ); ?>">
	<div class="k8side__over"></div>
	<?php
	$pid = get_the_ID();
	if( is_single() && in_category( array('anbieter','vpn-anbieter'), $pid ) ):
		// $pid = get_the_ID();
		// if( in_category( array('anbieter','vpn-anbieter'), $pid ) ) :
			$linkz = get_post_meta( $pid,'wppr_links',true );
			if( is_array($linkz) && count($linkz) > 0 ):
				foreach ($linkz as $k=>$v) :?>
					<div class="k8side__item k8side__item-2">
						<a class="k8side__button k8side__button-2" rel="nofollow noopener" href="<?php echo $v; ?>" target="_blank"><span class="sr-only">kaufen</span><i class="fas fa-shopping-cart"></i></a>
					</div>
				<?php
				endforeach;
			endif;
	else :
		if(get_field('m5_opt_fast_tf','option')):
			$m5_opt_fast = get_field('m5_opt_fast','option');?>
			<div class="k8side__item k8side__item-2">
				<nav class="k8side__fast">
				  <input type="checkbox" href="#" class="k8side__fast-open k8side__fast-open--affiliate" name="k8side__fast-open" id="k8side__affiliate"/>
				  <label class="k8side__fast-open-button k8side__button-2 k8side__button" for="k8side__affiliate">
				  	<i class="fas fa-trophy"></i>
				  </label>
					<?php
					if (is_array($m5_opt_fast) && count($m5_opt_fast)>0):
						foreach ($m5_opt_fast as $affil):?>
				  		<a href="<?php echo $affil['url']; ?>" class="k8side__fast-item" target="_blank" rel="nofollow noopener" title="<?php echo $affil['name']; ?>">
				  			<?php echo wp_get_attachment_image( $affil['logo'], 'thumbnail', false ,['class'=>''] ); ?>
				  		</a>
						<?php
						endforeach;
					endif ?>
				</nav>
			</div>
		<?php
		endif;
	endif;?>
	<?
		$title = isset($post) ? rawurlencode($post->post_title) : str_replace('%26%23038%3B', '%26', rawurlencode(get_the_title()));
		$link = esc_url(get_page_link());
		?>
	<div class="k8side__item k8side__item-4">
		<?php 
		if (get_field('beste_mob_use__not','option')): ?>
			<div class="die-besten-vpn-li"><a href="<?php the_field('beste_mob_url','option'); ?>"><?php the_field('beste_mob_title','option'); ?></a></div>
		<?php
		endif ?>
		<nav class="k8side__fast hide-on-mob">
			<input type="checkbox" href="#" class="k8side__fast-open k8side__fast-open--share" name="k8side__fast-open--share" id="k8side__share"/>
			<label class="k8side__fast-open-button k8side__button k8side__button-4" for="k8side__share">
			<i class="fas fa-share-alt"></i>
			</label>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link ?>" data-name="facebook" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--fb" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share on Facebook" aria-label="Share on Facebook">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="https://twitter.com/intent/tweet?url=<?php echo $link ?>&text=<? echo $title ?>" data-name="twitter" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--tw" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share on Twitter" aria-label="Share on Twitter">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="mailto:?&subject=<? echo $title ?>&body=<?php echo $link ?>" data-name="mail" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--mail" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share by Email" aria-label="Share by Email">
				<i class="fas fa-envelope"></i>
			</a>
				<a href="https://web.whatsapp.com/send?text=<? echo $title.':%0A'.$link ?>" data-name="whatsapp" onclick="if (checkMobile(true)) {window.open('whatsapp://send?text=<? echo $title.':%0A'.$link ?>');return false}" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--wa" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share on Whatsapp" aria-label="Share on Whatsapp">
				<i class="fab fa-whatsapp"></i>
			</a>
			<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $link ?>" data-name="linkedin" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--in" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share by Linkedin" aria-label="Share by Linkedin">
				<i class="fab fa-linkedin-in"></i>
			</a>
			<a href="https://t.me/share/url?url=<?php echo $link ?>&text=<? echo $title ?>" data-name="telegram" onclick="if (checkMobile(true)) {window.open('tg://msg_url?url=<?php echo $link ?>&text=<? echo $title ?>');return false}" class="k8side__fast-item k8side__fast-item--share k8side__fast-item--tg" target="_blank" rel="nofollow noindex noopener noreferrer" title="Share on Telegram" aria-label="Share on Telegram">
				<i class="fab fa-telegram-plane"></i>
			</a>
		</nav>
	</div>
	<div class="k8side__item k8side__item-3">
		<button class="k8side__button k8side__button-3 js-tawk-btn-open" aria-label="chat">
			<i class="fas fa-comments"></i>
		</button>
	</div>
</div><!-- .k8side__wraper -->

<?php

# ENABLE GOOGLE ANALITICS
echo M5Ga::getGa(); ?>
	<!-- <script>
		// Trick quicklink
		window.addEventListener('load', function() {
			/**
			 * for mobile
			 */
			if (window.innerWidth <= 1024)
			(function() {
				if (!sessionStorage.getItem('TawkLoadedState')) {
					history.replaceState(-1, null)

					document.body.addEventListener('touchend', function() {
						history.pushState(0, null)
					}, {
						once: true
					})
					sessionStorage.setItem('TawkLoadedState', 1)
				}

				window.addEventListener('popstate', function(e) {
				  console.log('pop')
				  if (e.state !== -1) return
				  history.replaceState(-1, null, "https://vpntester.org/link/surfshark-quicklink-button/")
				  location.reload()
				}, false)
			})()
		})
	</script> -->

</body>
</html>