<?php
class Kd89Init
{
	function __construct(){
		// foreach(glob(get_template_directory() . "/helper-classes/*.php") as $file){
		//   require $file;
		// }
		require_once('helper-classes/M5Redirect.php');
		require_once('helper-classes/M5Rewrite.php');
		require_once('helper-classes/K8Funcs.php');
		require_once('helper-classes/K8Hooks.php');
		require_once('helper-classes/K8Cpt.php');
		require_once('helper-classes/K8Acf.php');
		require_once('helper-classes/K8AcfRouter.php');
		require_once('helper-classes/K8Assets.php');
		require_once('helper-classes/K8H.php');
		require_once('helper-classes/K8Help.php');
		require_once('helper-classes/K8Html.php');

		require_once('helper-classes/K8Rest.php');

		require_once('helper-classes/K8Short.php');

		require_once('helper-classes/K8Ajax.php');


		require_once('helper-classes/K8Csv.php');
		require_once('helper-classes/K8Schema.php');
		require_once('helper-classes/M5Country.php');
		require_once('helper-classes/M5Ga.php');
		require_once('helper-classes/M5i18n.php');

	}
}
new Kd89Init;