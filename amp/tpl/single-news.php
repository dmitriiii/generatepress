<?php require get_template_directory() . "/libs/didom/vendor/autoload.php";
use DiDom\Document;
use DiDom\Element;
$q_o = get_queried_object();
$k8_can = get_the_permalink( $q_o->ID );
$k8_optz_amp_ga = get_field('k8_optz_amp_ga','option');
$k8_menu = K8Help::getMenuArray('primary');

function k8_amp_callback($buffer) {
	$buffer = str_replace("!important", "", $buffer);
	$document = new Document($buffer);
	#Replacing Images
	$imgzz = $document->find('img');
	if( count($imgzz) > 0 ):
		foreach ($imgzz as $img) :
			$attrz = array();
			if($img->hasAttribute('src')){
				$attrz['src'] = $img->getAttribute('src');
			}
			if($img->hasAttribute('alt')){
				$attrz['alt'] = $img->getAttribute('alt');
			}

			if($img->hasAttribute('width')):
				$attrz['width'] = $img->getAttribute('width');
			else:
				$attrz['width'] = 400;
			endif;

			if($img->hasAttribute('height')):
				$attrz['height'] = $img->getAttribute('height');
			else:
				$attrz['height'] = 300;
			endif;

			// $attrz['width'] = 1.5;
			// $attrz['height'] = 1;

			if($img->hasAttribute('title')){
				$attrz['title'] = $img->getAttribute('title');
			}
			$attrz['layout'] = 'responsive';
			$amp_img = new Element('amp-img', '', $attrz);
			$img->replace($amp_img);
		endforeach;
	endif;

	#remove noscript tag
	$noscript = $document->find('noscript');
	if( count($noscript) > 0 ):
		foreach ($noscript as $scrpt) :
			if($scrpt->hasAttribute('data-k8req'))
				continue;
			$scrpt->remove();
		endforeach;
	endif;

	#remove scripts except AMP
	$scriptzz = $document->find('script');
	if( count($scriptzz) > 0 ):
		foreach ($scriptzz as $scrpt) :
			if( $scrpt->hasAttribute('type') && $scrpt->getAttribute('type') == 'application/ld+json' )
				continue;
			if($scrpt->hasAttribute('data-k8req'))
				continue;
			$scrpt->remove();
		endforeach;
	endif;

	#remove styles except amp-boilerplate
	$stylezz = $document->find('style');
	if( count($stylezz) > 0 ):
		foreach ($stylezz as $stl) :
			if($stl->hasAttribute('amp-boilerplate'))
				continue;
			if($stl->hasAttribute('data-k8req'))
				continue;
			$stl->remove();
		endforeach;
	endif;

	#remove additional canonicals
	$canzz = $document->find('link[rel=canonical]');
	if( count($canzz) > 0 ):
		foreach ($canzz as $can) :
			if($can->hasAttribute('data-k8req'))
				continue;
			$can->remove();
		endforeach;
	endif;

	#remove social share cont
	$share = $document->find('.wc-share-buttons-container');
	if( count($share) > 0 ) :
		foreach ($share as $sh) :
			$sh->remove();
		endforeach;
	endif;



	return $document->format()->html();
}
ob_start("k8_amp_callback");
?>
<!doctype html>
<html amp lang="en">
	<head>
		<meta charset="utf-8">
		<script data-k8req async src="https://cdn.ampproject.org/v0.js"></script>
		<script data-k8req async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
		<script data-k8req async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		

		<link rel="canonical" href="<?php echo $k8_can; ?>" data-k8req>
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript data-k8req><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		
		<!-- <link href="https://fonts.googleapis.com/css?family=Lora:700|Ubuntu&display=swap&subset=latin-ext" rel="stylesheet"> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<?php wp_head(); ?>
		<style amp-custom data-k8req>
			body{
				font-family: Helvetica, sans-serif;
				box-sizing: border-box;
				line-height: 1.5;
				font-size: 15px;
				/* font-family: 'Open Sans', sans-serif; */
				/* font-family: 'Ubuntu', sans-serif; */
				font-weight: 400;
			}
			h1,h2,h3,h4,h5,h6,strong,b{
				/* font-family: 'Lora', serif; */
				font-weight: 700;
			}
			h1{
				font-size: 28px;
			}
			h2{
				font-size: 26px;
			}
			h3{
				font-size: 24px;
			}
			h4{
				font-size: 22px;
			}
			h5{
				font-size: 20px;
			}
			h6{
				font-size: 18px;
			}
			a{
				color: #00b2e2;
			}
			amp-img{
				max-width: 100%;
				height: auto;
			}
			amp-sidebar{
				padding: 20px 20px;
				background-color: #418bca;
				color: #fff;
			}
			amp-sidebar a{
				color: #fff;
				text-decoration: none;
			}
			.fa{
				font-display: swap;
			}
			.k8amp-wrr{
				padding: 50px 10px 30px;
			}
			.k8amp-head{
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				padding: 0 10px;
				background-color: #00B2E2;
				z-index: 99;
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				display: -o-flex;
				display: flex;
				justify-content: space-between;
				-ms-align-items: center;
				align-items: center;
			}

			.k8amp-head__link{
				display: block;
				width: 160px;
				z-index: 999;
			}
			.k8amp-hamb{
				font-size: 25px;
				line-height: 25px;
				color: #fff;
			}
			
			.k8amp-menu{
				list-style-type: none;
				padding: 0;
				font-weight: bold;
			}
			.k8amp-menu li{
				margin-bottom: 15px;
				border-bottom: 1px solid #ccc;
			}
			.close-sidebar{
				margin-left: auto;
			}
			/* Buttons */
			.dwnd__butt {
		    color: #ffffff;
		    background-color: #0284db;
		    text-shadow: 0px 0px 10px rgba(255,255,255,1);
		    -webkit-box-shadow: 0 0 10px #cccccc;
		    box-shadow: 0 0 10px #cccccc;
		   	text-align: center;
		   	text-decoration: none;
		    padding: 13px 20px;
		    border-radius: 4px;
		    /* font-weight: bold; */
		    text-transform: uppercase;
		    /* font-size: 18px; */
		    max-width: 250px;
		    margin-left: auto;
		    margin-right: auto;
		    display: -webkit-flex;
		    display: -moz-flex;
		    display: -ms-flex;
		    display: -o-flex;
		    display: flex;
		    -ms-align-items: center;
		    align-items: center;
		    justify-content: space-between;
		    letter-spacing: 2px;
		    -webkit-transition: all 0.5s ease;
		    -o-transition: all 0.5s ease;
		    transition: all 0.5s ease;
		    background-size: 200% auto;
			}
			.dwnd__butt.sm {
		  	/* font-size: 14px; */
		    background-image: linear-gradient(to right, #56CCF2 0%, #2F80ED 51%, #56CCF2 100%);
			}
			.dwnd__butt.sm:active {
			  background-position: right center;
			}
		</style>
	</head>
	<body>
		<div class="k8amp-head headerbar">
			<a href="<?php echo home_url('/'); ?>" class="k8amp-head__link">
				<img width="200" height="57" src="<?php echo bloginfo('template_directory')?>/k8/assets/img/vpn-logo-wh-200-fin.png" alt="Vpntester">
			</a>
			<div role="button" on="tap:sidebar1.toggle" tabindex="0" class="k8amp-hamb">☰</div>
		</div>
		<amp-sidebar id="sidebar1" layout="nodisplay" side="left">
			<div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div>
			<?php 
			if ( is_array($k8_menu) && count($k8_menu) > 0 ) :?>
				<ul class="k8amp-menu">
					<?php
					foreach ($k8_menu as $item): 
						echo "<li><a href='" . $item['url'] . "'>" . $item['title'] . "</a></li>";
					endforeach;?>
				</ul>
			<?php 
			endif; ?>
		</amp-sidebar>

		<div class="k8amp-wrr">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				echo '<h1>' . get_the_title() . '</h1>';
				echo '<hr>';
				the_content();
				// echo "<h4>See more details at <a href='" . $k8_can . "'>" . get_site_url() . "</a></h4>";
				echo '<p><a class="dwnd__butt sm" tabindex="0" href="' . $k8_can . '"><span>Quelle einlesen</span> <span>&#10147;</span></a></p>';
			endwhile;
			endif;?>
			<!-- <div class="k8amp-sb"> -->
				<?php // get_sidebar(); ?>
			<!-- </div> -->
		</div>
		<?php
		wp_footer();

		if( $k8_optz_amp_ga ) : ?>
			<amp-analytics type="gtag" data-credentials="include">
				<script data-k8req type="application/json">
				{
					"vars" : {
						"gtag_id": "<?php echo $k8_optz_amp_ga; ?>",
						"config" : {
							"<?php echo $k8_optz_amp_ga; ?>": { "groups": "default" }
						}
					}
				}
				</script>
			</amp-analytics>
		<?php
		endif; ?>
	</body>
</html>
<?php ob_end_flush(); ?> 