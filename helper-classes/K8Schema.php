<?php
class K8Schema
{
	static function getQAPage( $args ){
		extract( $args );
		$datta = array(
			"@context" => "https://schema.org",
			"@type" => "QAPage",
			'mainEntity' => array(
				'@type' => 'Question',
				'name' => $quest->post_title,
				'text' => get_the_content( $qid ),
				'answerCount' => $quest->answers,
				'upvoteCount' => $quest->votes_up,
				'dateCreated' => $quest->post_modified_gmt,
				'author' => array(
					'@type' => 'Person',
					'name' => ( $quest->post_author != 0 ) ? get_the_author_meta( 'user_login', $quest->post_author ) : (isset($quest->fields['anonymous_name']) ? $quest->fields['anonymous_name'] : 'Anonimus')
				)
			)
		);
		#Answers
		if( isset( $answrs->posts ) && is_array($answrs->posts) && count($answrs->posts) > 0 ):
			foreach ($answrs->posts as $answ):
				$datta['mainEntity']['suggestedAnswer'][] = array(
					"@type" => "Answer",
					"text" => wp_strip_all_tags( $answ->post_content, true ),
					"dateCreated" => $answ->post_date_gmt,
					"upvoteCount" => $answ->votes_up,
					"url" => get_the_permalink( $answ->ID ),
					"author" => array(
						"@type" => "Person",
						"name" => ( $answ->post_author != 0 ) ? get_the_author_meta( 'user_login', $answ->post_author ) : (isset($answ->fields['anonymous_name']) ? $answ->fields['anonymous_name'] : 'Anonimus' )
					)
				);
			endforeach;
		else:
			$datta['mainEntity']['suggestedAnswer'] = array(
				"@type" => "Answer",
				"text" => get_the_content( $qid ),
				"dateCreated" => $quest->post_modified_gmt,
				"upvoteCount" => $quest->votes_up,
				"url" => get_the_permalink( $qid ),
				"author" => array(
					"@type" => "Person",
					"name" => ( $quest->post_author != 0 ) ? get_the_author_meta( 'user_login', $quest->post_author ) : (isset($quest->fields['anonymous_name']) ? $quest->fields['anonymous_name'] : 'Anonimus')
				)
			);
		endif;
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	#Returns json markup for FAQ page
	static function getFaqPage( $args ){
		extract( $args );
		unset( $args );
		$datta = array(
			"@context" => "https://schema.org",
			"@type" => "FAQPage"
		);
		foreach ($k8_acf_faq as $value) {
			$datta['mainEntity'][] = array(
				'@type' => 'Question',
				'name' => wp_strip_all_tags( $value['quest'], true ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text' => wp_strip_all_tags( $value['ans'], true )
				)
			);
		}
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	/**
	 * [getNewsArticle Returns json markup for News Article]
	 * @param  [type] $args [
	 *   pid - int
	 *   author - string
 	 * ]
	 * @return [type]       [description]
	 */
	static function getNewsArticle( $args ){
		extract( $args );
		unset( $args );
		$img_urls = array();
		$attachments = get_posts( array(
		  'post_type' => 'attachment',
		  'posts_per_page' => -1,
		  'post_parent' => $pid,
		));
		if ( is_array($attachments) && count($attachments) > 0 ) {
			foreach ($attachments as $attach) {
				$url = K8Help::getImgUrl( $attach->ID, 'large' );
				( strpos( $url,'.png' ) || strpos( $url,'.jpg' ) || strpos( $url,'.jpeg' ) ) ? $img_urls[] = $url : '';
			}
		}
		if( count( $img_urls ) == 0 ){
			$img_urls = array( get_template_directory() . '/img/default-user-image.png' );
		}
		$datta = array(
			"@context" => "https://schema.org",
			"@type" => "NewsArticle",
			"mainEntityOfPage" => [
				"@type" => "WebPage",
				"@id" => get_the_permalink( $pid ),
			],
			"headline" => substr( get_the_title( $pid ), 0, 100 ),
			"image" => $img_urls,
			"datePublished" => get_the_date( 'Y-m-d', $pid ),
			"dateModified" => get_the_modified_date( 'Y-m-d', $pid ),
			"author" => [
		    "@type" => "Person",
		    "name" => $author
		  ],
		  "publisher" => [
		  	"@type" => "Organization",
    		"name" => get_bloginfo('name'),
    		"logo" => [
		      "@type" => "ImageObject",
		      "url" => "https://vpn-anbieter-vergleich-test.de/wp-content/uploads/2018/12/cropped-cropped-vpntester-Logo-quer-min-300x58-1.png"
		    ]
		  ],
		  "description" => get_the_excerpt($pid)
		);
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}


	/**
	 * [getHowTo description]
	 * @param  array  $args [
	 *  'pid' => how to' post id
	 *  'k8_title' => how to's post title
	 *  'k8_content' => how to's post content
	 *  'k8_acf_howto_stp' => acf steps array
	 *  'k8_acf_howto_supply' => acf supply array
	 *  'k8_acf_howto_tool' => acf tool array
 	 * ]
	 * @return [type]       [description]
	 */
	static function getHowTo( $args=[] ){
		extract( $args );
		(trim($k8_content) == '') ? $k8_content = 'Sehr nützlicher Artikel zum Selbermachen' : '';
		$datta = [
			"@context" => "https://schema.org",
			"@type" => "HowTo",
			"totalTime" => "PT3M",
			"name" => $k8_title,
  		"description" => wp_strip_all_tags($k8_content),
		];
		if( is_array($k8_acf_howto_stp) && count( $k8_acf_howto_stp ) > 0 ){
			$c = 1;
			foreach ($k8_acf_howto_stp as $item) :
				$datta['step'][] = [
					"@type" => "HowToStep",
					"name" => $item["head"],
					"text" => wp_strip_all_tags($item["txt"]),
					"image" => wp_get_attachment_image_src( $item["img"], 'large' )[0],
					"url" => $k8_current_url . '/#howto_' . $c,
				];
				$c++;
			endforeach;
		}

		if( is_array($k8_acf_howto_supply) && count($k8_acf_howto_supply) > 0 ){
			foreach ($k8_acf_howto_supply as $item) {
				$datta['supply'][] = [
					"@type" => "HowToSupply",
					"name" => $item["txt"],
				];
			}
		}

		if( is_array($k8_acf_howto_tool) && count($k8_acf_howto_tool) > 0 ){
			foreach ($k8_acf_howto_tool as $item) {
				$datta['tool'][] = [
					"@type" => "HowToTool",
					"name" => $item["txt"],
				];
			}
		}

		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	/**
	 * [getSiteNavEl description]
	 * @param  array  $args [
	 *   'menu' - WP_Term Object(
    [term_id] => 192
    [name] => Footer
    [slug] => footer
    [term_group] => 0
    [term_taxonomy_id] => 199
    [taxonomy] => nav_menu
    [description] =>
    [parent] => 0
    [count] => 5
    [filter] => raw
    )
	 * ]
	 * @return [type]       [description]
	 */
	static function getSiteNavEl( $args = array() ){
		extract( $args );
		unset( $args );
		$datta = [
			"@context" => "https://schema.org",
			"@type" => "SiteNavigationElement",
			"name" => $link->title,
			"url" => $link->url
		];
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	/**
	 * [getItemList description]
	 * @param  array  $args [
	 * 'prep'-array
	 * ]
	 * @return [type]       [description]
	 */
	static function getItemList( $args = array() ){
		extract( $args );
		unset( $args );
		$datta = [
			"@context" => "https://schema.org",
			"@type" => "ItemList",
		];
		$i=0;
		foreach ($prep as $value) {
			$datta["itemListElement"][$i]["@type"] = "ListItem";
			$datta["itemListElement"][$i]["position"] = $value["position"];
			$datta["itemListElement"][$i]["name"] = $value["name"];
			$datta["itemListElement"][$i]["url"] = $value["url"];
			$i++;
		}
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}


	/**
	 * [getYTdata description]
	 * @param  array  $args [
	 *   'decoded' - array from youtube
	 *   'id' - youtube id
	 * ]
	 * @return [type]       [description]
	 */
	static function getYTdata( $args = array() ){
		extract( $args );
		// write_log(get_defined_vars());
		if( !is_array($decoded['items']) || count($decoded['items']) == 0 )
			return;
		$datta = [
			"@context" => "https://schema.org",
			"@type" => "VideoObject",
			"name" => $decoded['items'][0]['snippet']['title'],
			"description" => $decoded['items'][0]['snippet']['description'],
			"thumbnailUrl" => $decoded['items'][0]['snippet']['thumbnails']['medium']['url'],
			"uploadDate" => $decoded['items'][0]['snippet']['publishedAt'],
			"duration" => $decoded['items'][0]['contentDetails']['duration'],
			"embedUrl" => "https://www.youtube.com/embed/" . $id,
			"interactionCount" => $decoded['items'][0]['statistics']['viewCount']
		];
		if ( !isset($datta['name']) || trim($datta['name']) == '' )
			$datta['name'] = get_bloginfo('name');

		if ( !isset($datta['description']) || trim($datta['description']) == '' )
			$datta['description'] = get_bloginfo('description');

		if ( !isset($datta['thumbnailUrl']) || trim($datta['thumbnailUrl']) == '' )
			$datta['thumbnailUrl'] = 'https://vpn-anbieter-vergleich-test.de/wp-content/uploads/2019/09/VPNtester-logo-white.png';

		if ( !isset($datta['uploadDate']) || trim($datta['uploadDate']) == '' )
			$datta['uploadDate'] = '2020-01-08T09:58:11Z';

		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}


	/**
	 * [getOrganization description]
	 * @return [type]       [description]
	 */
	static function getOrganization( $args = [] ) {
		extract( $args );
		$main_info = [
			"@context" => "https://schema.org",
			"@type" => "Organization",
			"name" => $org['name'],
			"legalName" => $org['legalName'] ? $org['legalName']: $org['name'],
			"url" => home_url(),
			"logo" => [
		      "@type" => "ImageObject",
		      "url" =>  $org['logo'] ? $org['logo'] : "https://vpn-anbieter-vergleich-test.de/wp-content/uploads/2018/12/cropped-cropped-vpntester-Logo-quer-min-300x58-1.png"
		    ],
		    "foundingDate" => $org['founding_year'],
		    "founders" => [
				"@type" => "Person",
				"name" => $org['founder_name']
			],
		];

		if(isset($org['k8_schema_social_links'])) {
			$social = [];
			foreach ($org['k8_schema_social_links'] as $link) {
				$social['sameAs'][] = $link['url'];
			}
			$main_info = array_merge($main_info, $social); 
		}

		$contact_data = [
			"address" => [
				"@type" => "PostalAddress",
				"addressRegion" => $org['address_region'],
				"addressCountry" => [
					"@type" => "Country",
					"name" => $org['address_country']
				],
			],
			"contactPoint" => [
				"@type" => "ContactPoint",
				"contactType" => $org['contact_type'],
				"telephone" => $org['phone'],
				"email" => $org['email']
			],
		];
		$datta = array_merge($main_info, $contact_data);
		return json_encode($datta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

}