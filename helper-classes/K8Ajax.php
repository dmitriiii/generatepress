<?php
// class K8Ajax
// {
//   function __construct()
//   {
//     //Catch Lead
//     add_action('wp_ajax_nopriv_leav_form', array( $this, 'leav_form' ));
//     add_action('wp_ajax_leav_form', array( $this, 'leav_form' ));
//   }

//   #Catch Lead
//   public function leav_form(){
//     $arrr = array();
//     extract( $_POST );
//     $body = "";
//     foreach ($cont as $value) {
//       switch ( $value['name'] ) {
//         case 'k8_name':
//           $body .= K8H::mess( 'Имя', $value['value']);
//           break;
//         case 'k8_phone':
//           $body .= K8H::mess( 'Телефон', $value['value']);
//           break;
//         case 'k8_email':
//           $body .= K8H::mess( 'Email', $value['value']);
//           break;

//         default:
//           break;
//       }
//     }

//     foreach ($calc as $value) {
//       switch ( $value['name'] ) {
//         case 'k8_want':
//           $body .= K8H::mess( 'Хочет вложить', $value['value']);
//           break;
//         case 'k8_srok':
//           $body .= K8H::mess( 'На срок', $value['value']);
//           break;
//         case 'k8_vypl':
//           $body .= K8H::mess( 'С выплатой процентов', K8H::proc( $value['value'] ));
//           break;

//         default:
//           break;
//       }
//     }

//     $body .= "<h2>Расчет калькулятора</h2>";

//     $body .= $plash;

//     $m = new K8Mail([
//       'to' => [
//         get_field('k8_acf_ema_to', 'option'),
//       ],
//       'subject' => 'Заявка с сайта iResidence',
//       'body' => $body
//     ]);
//     $m->send();

//     //write_log(get_defined_vars());
//     $arrr['html'] = 'ok!';
//     echo json_encode( $arrr );
//     exit();
//   }

// }

// new K8Ajax;