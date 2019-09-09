<?php
class K8Ajax
{
  function __construct()
  {
    //Success Captcha
    add_action('wp_ajax_nopriv_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));
    add_action('wp_ajax_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));
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

}

new K8Ajax;