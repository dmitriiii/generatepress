<?php /* Template Name: Test2
				Template Post Type: post, page */
require get_template_directory() . "/libs/didom/vendor/autoload.php";
use DiDom\Document;
use DiDom\Element;

get_header();


#Clear for rank math's auto video schema generated
if ( isset($_GET['testvidschema']) && $_GET['testvidschema'] == 77 ) {
	$args = array(
		'post_type'   => ['post','page'],
		'post_status' => 'any',
		'order'               => 'DESC',
		'orderby'             => 'date',
		'posts_per_page'         => -1,
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
	$ccc=1;
	while ( $the_query->have_posts() ) : $the_query->the_post();
		echo $ccc . '.) ';
		echo '<hr>';
		delete_post_meta(get_the_ID(), 'rank_math_schema_VideoObject');
		$ccc++;
	endwhile;
	wp_reset_postdata();

	else :

	endif;
}


function sendPostReq($text){
	$array = array(
	'auth_key' => '649b9629-8fdc-1fa1-d9ed-97cd7166cd92',
	'text' => $text,
	'source_lang'=>'DE',
	'target_lang'=>'EN-US'
	);

	$ch = curl_init('https://api.deepl.com/v2/translate');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	$html = curl_exec($ch);
	curl_close($ch);

	return $html;
}


/* AUTO Translating custom taxonomies's acf fields using Deepl.com
 	only for website vpntester.org ( multilanguage websites ) */
if( isset($_GET['trsl_en']) && $_GET['trsl_en']==77){
	$terms_slugs = [
		'betriebssystem',
		'zahlungsmittel',
		'sprache',
		'vpnprotokolle',
		'anwendungen',
		'sonderfunktionen',
		'fixeip',
		'vpnstandortelaender',
		'kundenservice',
		'unternehmen',
		'bedingungen',
		'sicherheitslevel'
	];
	foreach ($terms_slugs as $terms_slug) :

		$terms = get_terms( array(
	    'taxonomy' => $terms_slug,
	    'hide_empty' => false,
		));

		foreach ($terms as $term) {

			#Request translation from Deepl
			// $res = json_decode(sendPostReq($term->name), TRUE);
			// update_field('en_US', $res['translations'][0]['text'], $terms_slug.'_'.$term->term_id);

			update_field('de_DE', $term->name, $terms_slug.'_'.$term->term_id);

		}

	endforeach;
}


if( isset($_GET['test2']) && $_GET['test2'] == 77 ){
	global $wpdb;
	$what = '%nofollow%';
	$dbRequests = [
			[
				'post_type'=>'post',
				'title'=>'Posts',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'page',
				'title'=>'Pages',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'question',
				'title'=>'Questions',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'answer',
				'title'=>'Answers',
				'wp_type'=>'posts'
			]
		];

		// $c=0;
		foreach ($dbRequests as $req) :
			$sql = $wpdb->prepare( "SELECT ID AS itemID,
																		 post_title AS itemTitle,
																		 post_content AS itemContent
																		 FROM {$wpdb->posts}
																		 WHERE post_content LIKE %s
																		 AND post_type=%s
																		 AND post_status='publish'
																		 ORDER BY post_modified_gmt DESC",
																		 $what,
																		 $req['post_type'] );
			$results = $wpdb->get_results( $sql , ARRAY_A );

			#List all found articles ( posts, pages, etc. ) with 'nofollow' word in a content
			if( is_array($results) && count($results) > 0 ){
				$i=0;
				foreach ($results as $item) :

					$document = new Document($item['itemContent']);
					$nofolow_links = $document->find('a[rel*=nofollow]');
					if( is_array($nofolow_links) && count($nofolow_links)>0 ){
						$ii=0;
						foreach ($nofolow_links as $nofolow_link) {
							$href =	$nofolow_link->getAttribute('href');
							#if href attribute contains /link/
							if(strpos($href, "/link/") !== false)
								unset($nofolow_links[$ii]);

							#if href attribute contains http or https
							if(strpos($href, "http://") !== false || strpos($href, "https://") !== false ){
								if( strpos($href, get_site_url()) === false )
									unset($nofolow_links[$ii]);
							}
							$ii++;
						}
					}

					#if there no more nofollow internal links left - remove post( page ) from found array of pages
					if( is_array($nofolow_links) && count($nofolow_links)==0 ){
						unset($results[$i]);
					}

					// print_r($item['itemTitle']);
					// echo '<br>';
					// foreach ($nofolow_links as $nofolow_link) {
					// 	print_r($nofolow_link->getAttribute('href'));
					// 	echo '<br>';
					// }
					// print_r($nofolow_links);
					// echo '</pre>';
					$i++;
				endforeach; # $results
			}

			print_r($req['title']);
			print_r(count($results));
			foreach ($results as $rez) {
				echo '<pre>';
				print_r($rez['itemID']);
				print_r($rez['itemTitle']);

				echo '</pre>';
			}

		endforeach;
}




if( isset($_GET['test3']) && $_GET['test3'] == 77 ){
	$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
	$fp = fopen( K8_PATH_LOC . '/vpnlist.csv' , 'w');
	foreach ($vpnidPid as $item) :
		// $csv_arr=[];
		echo '<pre>';
		print_r($item);
		echo '</pre>';
		$csv_arr=[
			$item['vpnid'],
			html_entity_decode(get_the_title($item['pid'])),
			html_entity_decode(get_the_permalink($item['pid'])),
			html_entity_decode(get_edit_post_link($item['pid']))
		];
		fputcsv($fp, $csv_arr );
	endforeach;



	fclose($fp);
}

get_footer();