<?php
class K8Cpt
{
	function __construct()
	{
		add_action( 'init', array( $this, 'anbieter_taxes' ) );
	}
	public function anbieter_taxes(){

		/**
		 * Taxonomy: Betriebssysteme.
		 */
		$labels = [
			"name" => __( "Betriebssysteme", "k8lang_domain" ),
			"singular_name" => __( "Betriebssystem", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Betriebssysteme", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'betriebssystem', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "betriebssystem",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'betriebssystem' ) ):
			register_taxonomy( "betriebssystem", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Zahlungsmöglichkeiten.
		 */
		$labels = [
			"name" => __( "Zahlungsmöglichkeiten", "k8lang_domain" ),
			"singular_name" => __( "Zahlungsmöglichkeit", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Zahlungsmöglichkeiten", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'zahlungsmittel', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "zahlungsmittel",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'zahlungsmittel' ) ):
			register_taxonomy( "zahlungsmittel", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Sprache / Anwendung.
		 */
		$labels = [
			"name" => __( "Sprache / Anwendung", "k8lang_domain" ),
			"singular_name" => __( "Sprache / Anwendung", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Sprache / Anwendung", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'sprache', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "sprache",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'sprache' ) ):
			register_taxonomy( "sprache", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: VPN-Protokolle.
		 */
		$labels = [
			"name" => __( "VPN-Protokolle", "k8lang_domain" ),
			"singular_name" => __( "VPN-Protokoll", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "VPN-Protokolle", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'vpnprotokolle', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "vpnprotokolle",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'vpnprotokolle' ) ):
			register_taxonomy( "vpnprotokolle", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Anwendungen.
		 */
		$labels = [
			"name" => __( "Anwendungen", "k8lang_domain" ),
			"singular_name" => __( "Anwendung", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Anwendungen", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'anwendungen', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "anwendungen",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'anwendungen' ) ):
			register_taxonomy( "anwendungen", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Sonder Funktionen.
		 */
		$labels = [
			"name" => __( "Sonder Funktionen", "k8lang_domain" ),
			"singular_name" => __( "Sonder Funktion", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Sonder Funktionen", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'sonderfunktionen', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "sonderfunktionen",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'sonderfunktionen' ) ):
			register_taxonomy( "sonderfunktionen", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Fixe IP-Adressen.
		 */
		$labels = [
			"name" => __( "Fixe IP-Adressen", "k8lang_domain" ),
			"singular_name" => __( "Fixe IP-Adresse", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Fixe IP-Adressen", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'fixeip', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "fixeip",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'fixeip' ) ):
			register_taxonomy( "fixeip", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: VPN Standorte/Länder.
		 */
		$labels = [
			"name" => __( "VPN Standorte/Länder", "k8lang_domain" ),
			"singular_name" => __( "VPN Standort/Land", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "VPN Standorte/Länder", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'vpnstandortelaender', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "vpnstandortelaender",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'vpnstandortelaender' ) ):
			register_taxonomy( "vpnstandortelaender", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Kundenservices.
		 */
		$labels = [
			"name" => __( "Kundenservices", "k8lang_domain" ),
			"singular_name" => __( "Kundenservice", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Kundenservices", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'kundenservice', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "kundenservice",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'kundenservice' ) ):
			register_taxonomy( "kundenservice", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Unternehmen.
		 */
		$labels = [
			"name" => __( "Unternehmen", "k8lang_domain" ),
			"singular_name" => __( "unternehmen-standort", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Unternehmen", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'unternehmen', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "unternehmen",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'unternehmen' ) ):
			register_taxonomy( "unternehmen", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: bedingungen.
		 */
		$labels = [
			"name" => __( "bedingungen", "k8lang_domain" ),
			"singular_name" => __( "bedigungen", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "bedingungen", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'bedingungen', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "bedingungen",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'bedingungen' ) ):
			register_taxonomy( "bedingungen", [ "post" ], $args );
		endif;

		/**
		 * Taxonomy: Sicherheitslevel.
		 */
		$labels = [
			"name" => __( "Sicherheitslevel", "k8lang_domain" ),
			"singular_name" => __( "Sicherheitslevel", "k8lang_domain" ),
		];
		$args = [
			"label" => __( "Sicherheitslevel", "k8lang_domain" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'sicherheitslevel', 'with_front' => true, ],
			"show_admin_column" => false,
			"show_in_rest" => true,
			"rest_base" => "sicherheitslevel",
			// "rest_controller_class" => "WP_REST_Terms_Controller",
			"show_in_quick_edit" => false,
			];
		if( !taxonomy_exists( 'sicherheitslevel' ) ):
			register_taxonomy( "sicherheitslevel", [ "post" ], $args );
		endif;
	}
}
new K8Cpt();