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
} ?>