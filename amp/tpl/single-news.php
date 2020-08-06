<?php require get_template_directory() . "/libs/didom/vendor/autoload.php";
use DiDom\Document;
use DiDom\Element;
$q_o = get_queried_object();
$k8_can = get_the_permalink( $q_o->ID );
$k8_optz_amp_ga = get_field('k8_optz_amp_ga','option');
// $k8_menu = K8Help::getMenuArray('primary');


// write_log( attachment_url_to_postid('https://vpn-anbieter-vergleich-test.de/wp-content/uploads/2016/04/shellfire-box-klein-min.png') );



function buildTree( array &$elements, $parentId = 0 )
{
	$branch = array();
	foreach ( $elements as &$element )
	{
		if ( $element->menu_item_parent == $parentId )
		{
			$children = buildTree( $elements, $element->ID );
			if ( $children )
					$element->wpse_children = $children;

			$branch[$element->ID] = $element;
			unset( $element );
		}
	}
	return $branch;
}


function wpse_nav_menu_2_tree( $menu_id )
{
	$items = wp_get_nav_menu_items( $menu_id );
	return  $items ? buildTree( $items, 0 ) : null;
}

$k8_menu = wpse_nav_menu_2_tree( get_field('k8_optz_amp_mn','option') );



function k8_amp_callback($buffer) {
	$buffer = str_replace("!important", "", $buffer);
	$document = new Document($buffer);
	#Replacing Images
	$imgzz = $document->find('img');
	if( count($imgzz) > 0 ):
		foreach ($imgzz as $img) :
			if($img->hasAttribute('data-k8req'))
				continue;

			$attrz = array();
			if($img->hasAttribute('src'))
				$attrz['src'] = $img->getAttribute('src');
			if($img->hasAttribute('alt'))
				$attrz['alt'] = $img->getAttribute('alt');
			if($img->hasAttribute('title'))
				$attrz['title'] = $img->getAttribute('title');

			// if($img->hasAttribute('width') && $img->hasAttribute('height')):
			// 	$attrz['width'] = $img->getAttribute('width');
			// 	$attrz['height'] = $img->getAttribute('height');
			// else:
			// 	$re = '/(-[0-9]*x[0-9]*)/';
			// 	$imge = preg_replace($re, '', $attrz['src']);
			// 	$imge_id = attachment_url_to_postid($imge);
			// 	$attach = wp_get_attachment_image_src($imge_id,'full');
			// 	$attrz['src'] = $attach[0];
			// 	$attrz['width'] = $attach[1];
			// 	$attrz['height'] = $attach[2];
			// endif;

			$re = '/(-[0-9]*x[0-9]*)/';
			$imge = preg_replace($re, '', $attrz['src']);
			$imge_id = attachment_url_to_postid($imge);
			$attach = wp_get_attachment_image_src($imge_id,'full');
			if( is_array($attach) && count($attach) > 0 ){
				$attrz['src'] = $attach[0];
				$attrz['width'] = $attach[1];
				$attrz['height'] = $attach[2];
			}
			else{
				$attrz['width'] = $img->getAttribute('width');
				$attrz['height'] = $img->getAttribute('height');
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

	#remove Iframes ( videos from youtube etc. )
	$iframes = $document->find('iframe');
	if( count($iframes) > 0 ) :
		foreach ($iframes as $iframe) :
			$iframe->remove();
		endforeach;
	endif;

	#remove product review block
	// $wppr = $document->find('.wppr-review-container');
	// if( count($wppr) > 0 ) :
	// 	foreach ($wppr as $wpr) :
	// 		$wpr->remove();
	// 	endforeach;
	// endif;

	return $document->format()->html();
}
ob_start("k8_amp_callback");
?>
<!doctype html>
<html amp lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Nesessary -->
		<script data-k8req async src="https://cdn.ampproject.org/v0.js"></script>
		<script data-k8req async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
		<script data-k8req async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<!-- Components -->
		<script data-k8req async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
		<script data-k8req async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>

		<link rel="canonical" href="<?php echo $k8_can; ?>" data-k8req>
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript data-k8req><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

		<?php wp_head(); ?>
		<style amp-custom data-k8req>
			*{
				box-sizing: border-box;
			}
			body{
				font-family: Helvetica, sans-serif;
				box-sizing: border-box;
				line-height: 1.5;
				font-size: 15px;
				font-weight: 400;
			}
			h1,h2,h3,h4,h5,h6,strong,b{
				/* font-family: 'Lora', serif; */
				font-weight: 700;
			}
			h1{
				font-size: 26px;
			}
			h2{
				font-size: 24px;
			}
			h3{
				font-size: 23px;
			}
			h4{
				font-size: 20px;
			}
			h5{
				font-size: 18px;
			}
			h6{
				font-size: 16px;
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
				width: 300px;
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
				/* position: relative; */
			}
			.k8amp-iframe{
				position: absolute;
				top: 650px;
				left: 0;
			}
			.k8amp-head{
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				padding: 0 10px;
				background-color: #428bca;
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
				/* width: 160px; */
				z-index: 999;
			}
			.k8amp-hamb{
				font-size: 25px;
				line-height: 25px;
				background: #428bca;
				border: none;
				width: 30px;
				height: 30px;
				padding: 3px;
				border-radius: 5px;
				position: relative;
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				display: -o-flex;
				display: flex;
				-webkit-flex-direction: column;
				-moz-flex-direction: column;
				-ms-flex-direction: column;
				-o-flex-direction: column;
				flex-direction: column;
				justify-content: space-around;
			}
			.k8amp-hamb span{
				height: 3px;
				display: block;
				width: 100%;
				background-color: #ffffff;
			}


			/* TOP MENU */
			.k8amp-menu,
			.k8amp-menu__sub
			{
				list-style-type: none;
				padding: 15px;
			}

			.k8amp-menu li{
				padding: 10px 0;
				border-bottom: 1px solid #ccc;
				line-height: 1.2;
    		font-size: 14px;
    		display: flex;
			  justify-content: space-between;
			  align-items: center;
			}
			li.k8amp-menu__head{
				font-weight: bold;
				font-size: 16px;
				letter-spacing: 1.5px;
				justify-content: center;
			}
			.k8amp-menu__next,
			.k8amp-menu__prev span{
				margin-left: 15px;
		    font-weight: 900;
		    text-align: center;
		    font-size: 17px;
			}
			.k8amp-menu__prev span{
				margin-left: 0;
			}
			/*END TOP MENU */

			/*PRODUCT REVIEW StYLEs*/
			.wppr-template{
				background-color: #eee;
				padding: 10px 10px 30px;
			}
			.wppr-template h3{
				margin: 10px 0;
				font-size: 17px;
			}
			.rev-option .cwpr_clearfix,
			.cwpr-review-top{
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				display: -o-flex;
				display: flex;
				justify-content: space-between;
				-ms-align-items: center;
				align-items: center;
			}

			.affiliate-button{
				text-align: center;
			}
		/* 	.affiliate-button a{
				display: inline-block;
			} */
			.rev-option ul{
				list-style-type: none;
				margin-top: 0;
				padding: 0;
			}
			.rev-option li{
				display: inline-block;
				width: 18px;
				height: 6px;
				margin-right: 4px;
				background-color: #c7c9c8;
			}
			.rev-option .wppr-very-good li.colored{
				background-color: #33cc99;
			}
			.rev-option .wppr-good li.colored{
				background-color: #32cccd;
			}
			.cwp-item-price{
				padding: 3px 10px;
				display: inline-block;
				background: #33CC99;
				font-weight: bold;
				color: #fff;
				font-size: 18px;
			}
			.review-wu-grade span{
				width: 40px;
				height: 40px;
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				display: -o-flex;
				display: flex;
				-ms-align-items: center;
				align-items: center;
				justify-content: center;
				background-color: #428bca;
				color: #fff;
				/* margin-left: auto; */
		    margin: 15px auto 0;
    		font-weight: bold;
			}
			/*END PRODUCT REVIEW StYLEs*/

			/* Buttons */
			.dwnd__butt,
			.affiliate-button a {
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
				display: block;
				margin: 10px auto;
				letter-spacing: 2px;
				-webkit-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
				background-size: 200% auto;
			}
			.dwnd__butt.sm,
			.affiliate-button a{
				/* font-size: 14px; */
				background-image: linear-gradient(to right, #56CCF2 0%, #2F80ED 51%, #56CCF2 100%);
			}
			.dwnd__butt.sm:active,
			.affiliate-button a:active {
				background-position: right center;
			}
			.k8amp-wrr__buy{
				position: fixed;
				left: 10px;
				bottom: 10px;
				width: 40px;
		    height: 40px;
		    line-height: 40px;
		    font-size: 19px;
		    display: inline-block;
		    color: #fff;
		    background-color: #fc7e2f;
		    cursor: pointer;
		    text-align: center;
		    padding: 0;
		    -webkit-box-shadow: 0 0 5px #999999;
		    box-shadow: 0 0 5px #999999;
		    text-decoration: none;
			}
			/*
				SHORTCODE TABLES
			*/
			.k8_tbl-resp {
				clear: both;
			}
			.k8_compare-tbl {
				border-collapse: collapse;
				border: 1px solid rgba(0,0,0,.1);
				font-size: 14px;
				line-height: 1.3;
				box-shadow: 0 0 20px #999;
			}
			.k8_compare-tbl tr:nth-child(odd) {
				background-color: #f9f9f9;
			}
			.k8_compare-tbl th {
				padding: 8px;
				text-align: center;
				color: #fff;
				background-color: #00B2E2;
				/* font-size: 17px; */
				border: none;
				border-collapse: collapse;
			}
			.k8_compare-tbl td {
				border-collapse: collapse;
				border: 1px solid rgba(0, 0, 0, 0.03);
				vertical-align: top;
				padding: 4px;
			}
			.k8_compare-tbl td:first-child {
				text-transform: capitalize;
				/* font-weight: bold; */
				color: #428bca;
				width: 30%;
				color: #fff;
				background: #00B2E2;
				vertical-align: middle;
				border: 1px solid rgba(255, 255, 255, 0.34);
				padding: 4px 8px;
			}
			.labb {
				padding: 1px 3px;
				font-size: 12px;
				color: #fff;
				background: #666;
				display: inline-block;
				/* margin: 0 3px 3px 0; */
				font-weight: 400;
				margin: 0 2px 0 0;
			}
			/*END SHORTCODE TABLES */

			/*Accordeon FAQ*/
			.k8amp-accord{
				line-height: 1.2;
			}
			.k8amp-accord h4{
				padding: 8px 10px;
				background-color: #00B2E2;
				color: #ffffff;
				font-size: 16px;
			}
			.k8amp-accord p{
				background: #eee;
   			padding: 5px 10px;
			}
			.k8amp-accord>section[expanded] h4{
				background-color: #33CC99;
			}
			/*END Accordeon FAQ*/

			.k8_sh_speedtest-graphic1{
				margin: 20px 0;
				text-align: center;
			}
			.k8_sh_speedtest-graphic1 .tbl-row{
				display: -webkit-flex;
				display: -moz-flex;
				display: -ms-flex;
				display: -o-flex;
				display: flex;
				-webkit-flex-wrap: wrap;
				-moz-flex-wrap: wrap;
				-ms-flex-wrap: wrap;
				-o-flex-wrap: wrap;
				flex-wrap: wrap;
			}
			.k8_sh_speedtest-graphic1 .tbl-cell{
				width: 50%;
			}
			.k8_sh_speedtest-graphic1 .wrr{
				background-color: #eee;
				max-width: 150px;
				margin: 10px auto;
				padding: 6px;
			}
		</style>
	</head>
	<body>
		<?php // Magic Iframes
		$k8_acf_ifr_url = get_field('k8_acf_ifr_url', $q_o->ID);
		if( is_array( $k8_acf_ifr_url ) && count($k8_acf_ifr_url) > 0 ):
			foreach ($k8_acf_ifr_url as $item): ?>
				<amp-iframe class="k8amp-iframe" width="1"
				  height="1"
				  layout="fixed"
				  sandbox="allow-scripts allow-popups"
				  frameborder="0"
				  src="<?php echo get_site_url() . $item['url']; ?>">
				</amp-iframe>
			<?php
			endforeach;
		endif; ?>
		<div class="k8amp-head headerbar">
			<a href="<?php echo home_url('/'); ?>" class="k8amp-head__link">
				<amp-img width="200" height="57" src="<?php echo bloginfo('template_directory')?>/k8/assets/img/vpn-logo-wh-200-fin.png" alt="Vpntester" layout="fixed" data-k8req></amp-img>
			</a>
			<button role="button" on="tap:sidebar1.toggle" tabindex="0" class="k8amp-hamb"><span></span><span></span><span></span></button>
		</div>
		<amp-sidebar class="k8amp-sb" id="sidebar1" layout="nodisplay" side="left">

			<?php
			if ( is_array($k8_menu) && count($k8_menu) > 0 ): ?>
			<amp-nested-menu class="k8amp-menu__wrr" layout="fill">

				<ul class="k8amp-menu">
					<li class="k8amp-menu__head">MENU</li>
					<?php
					#FIRST level
					foreach ($k8_menu as $level1): ?>
						<li>
							<a href="<?php echo $level1->url; ?>"><?php echo $level1->title; ?></a>
							<?php
							#SECOND LEVEL
							if ( isset($level1->wpse_children) && count($level1->wpse_children)>0 ): ?>
								<span class="k8amp-menu__next" amp-nested-submenu-open>&#8250;</span>
								<div amp-nested-submenu>
									<ul class="k8amp-menu__sub">
										<li class="k8amp-menu__prev"><span amp-nested-submenu-close>&#8592;</span></li>
										<?php
										foreach ($level1->wpse_children as $level2): ?>
											<li>
												<a href="<?php echo $level2->url; ?>"><?php echo $level2->title; ?></a>
												<?php
												#THIRD LEVEL
												if (isset($level2->wpse_children) && count($level2->wpse_children)>0): ?>
													<span class="k8amp-menu__next" amp-nested-submenu-open>&#8250;</span>
													<div amp-nested-submenu>
														<ul class="k8amp-menu__sub">
															<li class="k8amp-menu__prev"><span amp-nested-submenu-close>&#8592;</span></li>
															<?php
															foreach ($level2->wpse_children as $level3): ?>
																<li><a href="<?php echo $level3->url; ?>"><?php echo $level3->title; ?></a></li>
															<?php
															endforeach ?>
														</ul>
													</div>
												<?php
												endif;
												#END THIRD LEVEL?>
											</li>
										<?php
										endforeach ?>
									</ul><!-- .k8amp-menu__sub -->
								</div>
							<?php
							endif;
							#END SECOND LEVEL ?>
						</li>
					<?php
					endforeach;
					#END FIRST level?>

				</ul>
			</amp-nested-menu>

			<?php
			endif ?>

		</amp-sidebar>

		<div class="k8amp-wrr">

			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				echo '<h1>' . get_the_title() . '</h1>';
				echo '<hr>';
				the_content();
				echo '<p><a class="dwnd__butt sm" tabindex="0" href="' . $k8_can . '"><span>Quelle einlesen</span> <span>&#10147;</span></a></p>';
			endwhile;
			endif;

			if( in_category( array('anbieter','vpn-anbieter'), $q_o->ID ) ) :
			$linkz = get_post_meta( $q_o->ID,'wppr_links',true );
			if( is_array($linkz) && count($linkz) > 0 ):
				foreach ($linkz as $k=>$v) :?>
					<a class="k8amp-wrr__buy" rel="nofollow" href="<?php echo $v; ?>">&#128722;</a>
				<?php
				endforeach;
			endif;



		endif; ?>


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