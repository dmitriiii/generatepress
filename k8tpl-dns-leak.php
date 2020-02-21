<?php /* Template Name: DNS Leak
Template Post Type: page */
global $wp;
get_header();?>
<style>
	#dnskeakimg {
	display: none !important;
	visibility: hidden;
}
.dnsleak-placeholder {
	min-height: 82px;
	text-align: center;
	vertical-align: middle;
	color: #418bca;
	font-weight: bold;
}
.k8_compare-tbl td:first-child{
	text-transform: inherit;
    font-weight: inherit;
    color: inherit;
    width: auto;
}

.k8_compare-tbl tr:first-child td{
    font-weight: bold;
    color: white;
    background: #418bca;
}
.k8_compare-tbl tr:not(:first-child):hover {
	background: #ddd;
}
</style>
<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
					<div class="inside-article">
						<?php
						/**
						 * generate_before_content hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_featured_page_header_inside_single - 10
						 */
						do_action( 'generate_before_content' );
						?>

						<header class="entry-header">
							<?php
							/**
							 * generate_before_entry_title hook.
							 *
							 * @since 0.1
							 */
							do_action( 'generate_before_entry_title' );

							// if ( generate_show_title() ) {
							// 	the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
							// }

							/**
							 * generate_after_entry_title hook.
							 *
							 * @since 0.1
							 *
							 * @hooked generate_post_meta - 10
							 */
							// do_action( 'generate_after_entry_title' );
							?>
						</header><!-- .entry-header -->

						<?php
						/**
						 * generate_after_entry_header hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_post_image - 10
						 */
						do_action( 'generate_after_entry_header' );
						?>

						<div class="entry-content" itemprop="text">

							<div class="k8-ip__wrr">
								<h1 style="text-align: center;">
									<?php the_title(); ?>
								</h1>
								<div id="dnskeakimg"></div>
								<div id="dnsleak-result-container"></div>

							</div><!-- .k8-ip__wrr -->

							<?php
							the_content();

							echo '<br><p><u><b>Erstellt am:</b></u> <meta itemprop="datePublished" content="' . get_the_date() . '">' . get_the_date() . '</p>';

							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
								'after'  => '</div>',
							) );
							?>
						</div><!-- .entry-content -->

						<?php
						/**
						 * generate_after_entry_content hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_footer_meta - 10
						 */
						do_action( 'generate_after_entry_content' );

						/**
						 * generate_after_content hook.
						 *
						 * @since 0.1
						 */
						do_action( 'generate_after_content' );
						?>
					</div><!-- .inside-article -->
				</article><!-- #post-## -->


				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) :
					/**
					 * generate_before_comments_container hook.
					 *
					 * @since 2.1
					 */
					do_action( 'generate_before_comments_container' );
					?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

					<?php
				endif;

			endwhile;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

get_footer();?>
<script>
	var nrOfQuerys = 6;
var tries = 10;
var resultdata = "None";
var rescnt = 0;

document.getElementById("dnsleak-result-container").innerHTML = '<div class="dnsleak-placeholder mtb-30">Checking DNS servers, please wait...<p>';

function makeid(){
    var text = "";
    var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i != 12; i++ ){
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
}

var id = makeid();

function loadResult(){
    tries--;
    document.getElementById("dnsleak-result-container").innerHTML =  document.getElementById("dnsleak-result-container").innerHTML + ""
    lol = thisid = id + "_" + i;
    fetch(lol);
    var proxyUrl = 'https://cors-anywhere.herokuapp.com/',
        targetUrl = 'https://dns-leak.com/result.php?id='+id
    fetch(proxyUrl + targetUrl)
    .then(blob => blob.json())
    .then(data => {
        console.table(data);
        var html = '<table class="k8_compare-tbl mtb-30"><tr><td>IP</td><td>Hostname</td><td>ISP</td><td>Land</td></tr>';
            var results = data;
            results.forEach(function(entry) {
                html = html + "<tr><td>"+entry["IP"]+"</td><td>"+entry["HOSTNAME"]+"</td><td>"+entry["ISP"]+"</td><td>"+entry["COUNTRY"]+"</td></tr>";
            });
            html = html + "</table>";
            document.getElementById("dnsleak-result-container").innerHTML = html;
    })
    .catch(e => {
        console.log(e);
        return e;
    });    
}





function cntResult(){
    rescnt++;
    if (rescnt == nrOfQuerys){
        document.getElementById("dnsleak-result-container").innerHTML =  document.getElementById("dnsleak-result-container").innerHTML + "";
        setTimeout( function(){
            loadResult();
        }, 1500);
    }
}

for(var i=0; i != nrOfQuerys; i++ ){
    var thisid = id + "_" + i;
    var elem = document.createElement("img");
    elem.style.display="none;"
    elem.setAttribute("src","https://" + thisid + ".dns-leak.com/dontexists.png");
    elem.setAttribute("onerror","cntResult()");
    document.getElementById("dnskeakimg").appendChild(elem);
    elem = document.createElement("img");
    elem.style.display="none;"
    elem.setAttribute("src","https://" + thisid + ".dns-check.info/dontexist.png");
    elem.setAttribute("onerror","cntResult()");
    document.getElementById("dnskeakimg").appendChild(elem);
}
</script>