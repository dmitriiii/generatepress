<?php /* Template Name: Test2
				Template Post Type: post, page */
require get_template_directory() . "/libs/didom/vendor/autoload.php";
use DiDom\Document;
use DiDom\Element;

get_header();


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