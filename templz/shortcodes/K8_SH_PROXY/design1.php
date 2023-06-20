<?php 
// echo '<pre>';
// print_r(get_defined_vars());
// echo '</pre>'; 

?>

<div class="proxx">
	<img class="proxx__logo" width="300" height="86" src="https://vpntester.org/wp-content/uploads/2019/09/VPNtester-logo-white-e1591025997764.png" alt="vpntester proxy">
	<p class="proxx__head">Geben Sie einfach die URL der Website ein, die Sie ohne Einschränkungen durchsuchen möchten.</p>
	<form class="proxx__form" target="__blank" action="<?= $a['proxy_url'];?>">
		<input type="text"
			class="proxx__inp"
		  name="url"
		  placeholder="https://example.com">
		<button type="submit">GEHEN!</button>
	</form>
	<div class="proxx__res"></div>
</div>