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
class Portfolio_Functions {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
  public function __construct() {

    }


  public function pt_portfolio_metabox() {
    $prefix = 'portfolio_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'portfolio_metabox',
        'title'         => __( 'Portfolio Details', 'cmb2' ),
        'object_types'  => array( 'portfolio', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name'    => 'Client',
        'id'      => $prefix . 'client',
        'type'    => 'text',
    ) );


    $cmb->add_field( array(
        'name' => 'Video',
        'desc' => 'Enter a youtube or vimeo URL here.',
        'id'   => $prefix . 'video',
        'type' => 'oembed',
    ) );

    $cmb->add_field( array(
        'name' => 'Portfolio Gallery',
        'desc' => 'Upload Portfolio images here',
        'id'   => $prefix . 'gallery',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Add or Upload Images', // default: "Add or Upload Files"
            'remove_image_text' => 'Remove Image', // default: "Remove Image"
            'file_text' => 'File', // default: "File:"
            'file_download_text' => 'Download', // default: "Download"
            'remove_text' => 'Remove', // default: "Remove"
        ),
    ) );
  }

  public function pt_gallery_metabox() {
    $prefix = 'gallery_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'portfolio_gallery_metabox',
        'title'         => __( 'Portfolio Gallery', 'cmb2' ),
        'object_types'  => array( 'page', ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-gallery.php' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name' => 'Portfolio Gallery',
        'desc' => 'Upload Portfolio images here to create a one page gallery, drag and drop to re arrange',
        'id'   => $prefix . 'gallery',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Add or Upload Images', // default: "Add or Upload Files"
            'remove_image_text' => 'Remove Image', // default: "Remove Image"
            'file_text' => 'File', // default: "File:"
            'file_download_text' => 'Download', // default: "Download"
            'remove_text' => 'Remove', // default: "Remove"
        ),
    ) );
  }

public function remove_editor_init() {
    // If not in the admin, return.
    if ( ! is_admin() ) {
       return;
    }

    // Get the post ID on edit post with filter_input super global inspection.
    $current_post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );
    // Get the post ID on update post with filter_input super global inspection.
    $update_post_id = filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );

    // Check to see if the post ID is set, else return.
    if ( isset( $current_post_id ) ) {
       $post_id = absint( $current_post_id );
    } else if ( isset( $update_post_id ) ) {
       $post_id = absint( $update_post_id );
    } else {
       return;
    }

    // Don't do anything unless there is a post_id.
    if ( isset( $post_id ) ) {
       // Get the template of the current post.
       $template_file = get_post_meta( $post_id, '_wp_page_template', true );

       // Example of removing page editor for page-your-template.php template.
       if (  'template-gallery.php' === $template_file ) {
           remove_post_type_support( 'page', 'editor' );
           // Other features can also be removed in addition to the editor. See: https://codex.wordpress.org/Function_Reference/remove_post_type_support.
       }
    }
}
  public function portfolio_terms(){


  $terms = get_the_terms( get_the_ID(), 'types' );

  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
   
          echo  $terms[0]->name ;
   
      
  }
  }

  public function welcome(){

  if( is_front_page() && get_theme_mod('welcome_text')) { ?>
      <div class="col-10-12 welcome">
         <?php $welcome = wp_kses_post( get_theme_mod('welcome_text'));
         echo '<h1>';
         echo $welcome;
         echo '</h1>';
         ?>
      </div>
  <?php }
  }


public static function load_tgm() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

  
            array(
            'name'      => 'CMB2',
            'slug'      => 'cmb2',
            'required'  => true,
        ),
            array(
            'name'      => 'kirki',
            'slug'      => 'kirki',
            'required'  => true,
        ),
    );
   // Message to output right before the plugins table.

    tgmpa( $plugins);

}

    function pt_loadmore_ajax_handler(){
     
        // prepare our arguments for the query
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
        $args['post_status'] = 'publish';
        $args['post_type'] = 'portfolio';
     
        // it is always better to use WP_Query but not here
        query_posts( $args );
     
        if( have_posts() ) :
     
            // run the loop
            while( have_posts() ): the_post();
     
   
                get_template_part( 'template-parts/content-preview', get_post_format() );  

     
     
            endwhile;
     
        endif;
        die; // here we exit the script and even no wp_reset_query() required!
    }
     

}

