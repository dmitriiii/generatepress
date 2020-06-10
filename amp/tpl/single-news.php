<?php require get_template_directory() . "/libs/didom/vendor/autoload.php";
use DiDom\Document;
use DiDom\Element;
$q_o = get_queried_object();
$k8_can = get_the_permalink( $q_o->ID );
$k8_optz_amp_ga = get_field('k8_optz_amp_ga','option');
// $k8_menu = K8Help::getMenuArray('primary');



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

	#remove product review block
	$wppr = $document->find('.wppr-review-container');
	if( count($wppr) > 0 ) :
		foreach ($wppr as $wpr) :
			$wpr->remove();
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

		<script async custom-element="amp-nested-menu" src="https://cdn.ampproject.org/v0/amp-nested-menu-0.1.js"></script>


		<link rel="canonical" href="<?php echo $k8_can; ?>" data-k8req>
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript data-k8req><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

		<!-- <link href="https://fonts.googleapis.com/css?family=Lora:700|Ubuntu&display=swap&subset=latin-ext" rel="stylesheet"> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

		<?php wp_head(); ?>
		<style amp-custom data-k8req>

			/*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}main{display:block}h1{font-size:2em;margin:.67em 0}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace,monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{padding:.35em .75em .625em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{vertical-align:baseline}textarea{overflow:auto}[type=checkbox],[type=radio]{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details{display:block}summary{display:list-item}template{display:none}[hidden]{display:none}
/*# sourceMappingURL=normalize.min.css.map */

			*{
				box-sizing: border-box;
			}

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
			}
/* 			.k8amp-sb{
				padding: 15px;
			} */
			/* .k8amp-menu__wrr{
				padding: 15px;
			} */
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
			


		</style>
	</head>
	<body>
		<div class="k8amp-head headerbar">
			<a href="<?php echo home_url('/'); ?>" class="k8amp-head__link">
				<img width="200" height="57" src="<?php echo bloginfo('template_directory')?>/k8/assets/img/vpn-logo-wh-200-fin.png" alt="Vpntester">
			</a>
			<div role="button" on="tap:sidebar1.toggle" tabindex="0" class="k8amp-hamb">☰</div>
		</div>
		<amp-sidebar class="k8amp-sb" id="sidebar1" layout="nodisplay" side="left">
			<!-- <div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div> -->
			<!-- <p class="k8amp-sb__head"></p> -->


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