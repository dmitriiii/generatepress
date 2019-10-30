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
					'text' => $value['ans']
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
		$attachments = get_posts( array(
		  'post_type' => 'attachment',
		  'posts_per_page' => -1,
		  'post_parent' => $pid,
		));
		if ( is_array($attachments) && count($attachments) > 0 ) {
			foreach ($attachments as $attach) {
				$img_urls[] = K8Help::getImgUrl( $attach->ID, 'large' );
			}
		}
		else{
			$img_urls = array( get_template_directory() . '/img/default-user-image.png' );
		}
		$datta = array(
			"@context" => "https://schema.org",
			"@type" => "NewsArticle",
			"mainEntityOfPage" => [
				"@type" => "WebPage",
				"@id" => get_the_permalink( $pid ),
			],
			"headline" => get_the_title( $pid ),
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
} ?>