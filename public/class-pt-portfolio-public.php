<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thepixeltribe.com
 * @since      1.0.0
 *
 * @package    Pt_Portfolio
 * @subpackage Pt_Portfolio/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pt_Portfolio
 * @subpackage Pt_Portfolio/public
 * @author     Pixel Tribe <support@thepixeltribe.com>
 */
class Pt_Portfolio_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pt_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pt_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pt-portfolio-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'swipebox-css', plugin_dir_url( __FILE__ ) . 'css/swipebox.min.css');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pt_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pt_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'portfolio-scripts', plugin_dir_url( __FILE__ ) . 'js/pt-portfolio-public.js', array( 'jquery' ), '2262017', false );
		
		wp_enqueue_script('masonry');
		
		wp_enqueue_script( 'swipebox', plugin_dir_url( __FILE__ ) . 'js/jquery.swipebox.min.js', array( 'jquery' ), '22554ss', true );



	}



		function load_more_scripts() {
		 
			global $wp_query; 
		 
			// In most cases it is already included on the page and this line can be removed
			wp_enqueue_script('jquery');
		 
			// register our main script but do not enqueue it yet
			wp_register_script( 'pt_loadmore', plugin_dir_url( __FILE__ ) . 'js/ptloadmore.js', array('jquery') );

		 
			// now the most interesting part
			// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
			// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
			wp_localize_script( 'pt_loadmore', 'pt_loadmore_params', array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
				'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
				'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
				'max_page' => $wp_query->max_num_pages
			) );
		 
		 	wp_enqueue_script( 'pt_loadmore' );
		}
		 
		

}
