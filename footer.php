<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * generate_before_footer hook.
 *
 * @since 0.1
 */
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

<div class="k8side__wraper"></div>
<div class="k8side__over"></div>

<?php
if( K8Help::hasShort(['shortcode'=>'k8coupon_mng_form']) ): ?>
	<div class="k8-prld">
		<div class="k8-prld__inn">
			<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
		</div>
	</div>
	<div class="modd" id="modd__err">
		<div class="modd__content">
			<div class="modd__clz">&times;</div>
			<!-- <div class="modd__title" style="color: red;">
				Fehler bei <br> der Übermittlung.
			</div> -->
			<div class="modd__txt" style="color: red;"></div>
	  </div>
	</div>
	<div class="modd" id="modd__succ">
		<div class="modd__content">
			<div class="modd__clz">&times;</div>
			<!-- <div class="modd__title" style="color: green;">
				Erfolgreich.
			</div> -->
			<div class="modd__txt" style="color: green;">
				<p>
					Coupon wurde erfolgreich gesendet.
				</p>
				<p>
					Nimm Dein Telefon zu Hand.
				</p>
			</div>
	  </div>
	</div>
<?php
endif; 

if (get_site_url() == 'https://vpn-anbieter-vergleich-test.de') : ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-55894537-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-55894537-1');
</script>
<?php
endif; ?>

</body>
</html>