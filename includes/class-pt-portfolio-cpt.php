<?php

/**
 * Plugin Custom Post Types & taxonomies
 *
 * @link       https://thepixeltribe.com/
 * @since      1.0.0
 *
 * @package    pt-portfolio
 * @subpackage pt-portfolio/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    pt-portfolio
 * @subpackage pt-portfolio/includes
 * @author     Denis Bosire <support@thepixeltribe.com>
 */
class Portfolio_Cpts {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
  public function __construct() {

	}

public function pt_portfolio_cpts() {

	/**
	 * Post Type: portfolio.
	 */

	$labels = array(
		"name" => __( 'Portfolio', 'pt-portfolio' ),
		"singular_name" => __( 'portfolio', 'pt-portfolio' ),
	);

	$args = array(
		"label" => __( 'Portfolio', 'pt-portfolio' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "portfolio", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => plugin_dir_url( __FILE__ ) . 'icons/gallery.png',
		"supports" => array( "title", "editor", "thumbnail" ),
		//"taxonomies" => array( "category" ),
	);

	register_post_type( "portfolio", $args );
}




function pt_portfolio_taxes() {

	/**
	 * Taxonomy: Project Types.
	 */

	$labels = array(
		"name" => __( 'Project Types', 'pt-portfolio' ),
		"singular_name" => __( 'Project Type', 'pt-portfolio' ),
	);

	$args = array(
		"label" => __( 'Project Types', 'draft' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Project Types",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'types', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "types", array( "portfolio" ), $args );
}}