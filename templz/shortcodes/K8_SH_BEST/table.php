<?php 
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
echo '<pre>';
print_r( get_defined_vars() );
echo '</pre>';

echo K8Html::tbl_start([
	'add_clss' => strtolower( $tag ),
	'scroll' => true,
	'without_head' => true,
	'anim_clss' => true
]);?>

<thead>
  <tr>
    <th scope="col">Anbieter</th>
    <th scope="col">Beschreibung</th>
    <th scope="col">Download</th>
    <th scope="col">Upload</th>
    <th scope="col">Ping</th>
    <th scope="col">Bewertung</th>
    <th scope="col">Empfehlung</th>
    <th scope="col">Streaming (DE)</th>
    <th scope="col">Streaming (Int)</th>
    <th scope="col">Anwendungen</th>
    <th scope="col">Datenschutz</th>
    <th scope="col">Preis</th>
    <th scope="col">Links</th>
  </tr>
</thead>
<tbody>
  <tr>
    <th>VyprVpn</th>
    <td>Cell content<br>test </td>
    <td><a href="#">Cell content longer</a></td>
    <td>Cell content with more content and more content Cell </td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
  </tr>
  <tr>
    <th>NordVPN</th>
    <td>Cell content<br>test </td>
    <td><a href="#">Cell content longer</a></td>
    <td>Cell content with more content and more content Cell </td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
  </tr>
  <tr>
    <th>Surfshark VPN</th>
    <td>Cell content<br>test </td>
    <td><a href="#">Cell content longer</a></td>
    <td>Cell content with more content and more content Cell </td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
    <td>Cell content</td>
  </tr>

<?php
echo K8Html::tbl_end();
?>


<!-- <div class="table-scroll">
  <table>
   
  </table>
</div> -->