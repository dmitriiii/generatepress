<?php
class K8Ajax
{
  function __construct()
  {
    //Success Captcha
    add_action('wp_ajax_nopriv_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));
    add_action('wp_ajax_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));

    #VPN security
    add_action('wp_ajax_nopriv_k8_ajx_safety', array( $this, 'k8_ajx_safety' ));
    add_action('wp_ajax_k8_ajx_safety', array( $this, 'k8_ajx_safety' ));
  }

  public function final( $arrr ){
    echo json_encode( $arrr );
    exit();
  }

  //Success Captcha
  public function k8_ajx_captcha_succ(){
    $arrr = array();
    extract( $_POST );

   	if( !isset( $action ) || $action != 'k8_ajx_captcha_succ' ){
      $arrr['error'] = 'Submit via website, please';
      $this->final($arrr);
    }

   	if( is_array($dataSubm) && count($dataSubm) > 0 ){
   		foreach ($dataSubm as $item) {
   			switch ( $item['name'] ) {
   				case 'g-recaptcha-response':
   					$recaptcha = $item['value'];
   					break;
   				case 'href':
   					$href = $item['value'];
   					break;
   				default:
   					$pid = $item['value'];
   					break;
   			}
   		}
   	}

   	#Verify captcha backend code
 	  if(isset( $recaptcha ) && !empty( $recaptcha ) ){
      $secret = '6LdCnLQUAAAAAFa309xFoL442plFuhYWBUEsTjvs';
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$recaptcha);
      $responseData = json_decode($verifyResponse);
      if($responseData->success){
        $arrr['html'] = K8Html::getButt(
          array(
            'nofollow'=> 'nofollow',
            'class'   => 'dwnd__butt grn',
            'href'    => $href,
            'download'=> 'download',
            'img_src' => get_the_post_thumbnail_url( $pid, 'thumbnail' ),
            'text'    => 'Download Starten'
          )
        );
      }
      else{
      	$arrr['error'] = 'Robot verification failed, please try again.';
      	$this->final($arrr);
      }
	  }

    // write_log(get_defined_vars());
    echo json_encode( $arrr );
    exit();
  }

  #VPN security
  public function k8_ajx_safety(){
    $arrr = array();
    $html = '';
    extract( $_POST );

    if( !isset( $action ) || $action != 'k8_ajx_safety' ){
      $arrr['error'] = 'Submit via website, please';
      $this->final($arrr);
    }


    $args = array(
      'post_type'   => 'post',
      'post_status' => array(
        'publish'
      ),
      'category_name' => 'vpn-anbieter',
      'posts_per_page' => -1,
      'meta_key'  => 'option_overall_score',
      'orderby'   => 'meta_value_num',
      'order'     => 'DESC',
    );

    if( $typ == 2 ){
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'anwendungen',
          'field'    => 'slug',
          'terms'    => 'tauschboersen-torrent',
        ),
      );
    }

    if( $typ == 3 ){
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'anwendungen',
          'field'    => 'slug',
          'terms'    => 'maximale-anonymitaet',
        ),
      );
    }

    if( $typ == 4 ){
      $args['tax_query'] = array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'anwendungen',
          'field'    => 'slug',
          'terms'    => 'maximale-anonymitaet',
        ),
        array(
          'taxonomy' => 'sonderfunktionen',
          'field'    => 'slug',
          'terms'    => 'multi-hop-vpn',
        ),
      );
    }

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) :
      $html = $html . '<div class="container-fluid"><div class="row">';
      while ( $the_query->have_posts() ) : $the_query->the_post();
        $pid = get_the_ID();
        $pm = get_post_meta( $pid );
        $wppr_options = unserialize($pm['wppr_options'][0]);

        $html = $html . '<div class="col-md-6">' . K8Html::getItem(array(
          'pid' => $pid,
          'pm' => $pm,
          'wppr_options' => $wppr_options,
        )) . '</div>';

      endwhile;
      wp_reset_postdata();
      $html = $html . '</div></div>';
    endif; 


    $arrr['html'] = $html;
    // write_log(get_defined_vars());
    echo json_encode( $arrr );
    exit();
  }

}

new K8Ajax;