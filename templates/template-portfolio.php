<?php
/**
 * Template name: Portfolio
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package couture
 */

get_header(); ?>

    
    <div id="primary" class="content-area cleared posts">
        <main id="main" class="site-main masonry" role="main">
        
        <?php
        $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
        $args = array(
            //'posts_per_page' => 3,
            'paged' => $paged,
            'post_type' => 'portfolio',
            );
        $main_loop = new WP_Query( $args );

        if ( $main_loop->have_posts() ) :?>

    <?php if( get_theme_mod('filters')): 
    //the filter js is missing ?>
    <div class="grid">
      <ul id="filters" class="portfolio-filter">
        
        <li id="filter--all" class="filter active" data-filter="*"><?php _e( 'All', 'pt-portfolio' ) ?></li>
                <?php 
                    // list terms in a given taxonomy
                    
                    $tax_terms = get_terms( 'types');

                    if (is_array($tax_terms) || is_object($tax_terms))

                    foreach ( $tax_terms as $tax_term ) {

                    echo '<li class="filter" data-filter=".'. $tax_term->slug.'"><a href="#">' . $tax_term->name .'</a></li>';
                    }
                ?>
        </ul>
        
    </div>
<?php endif; ?>
           <?php echo '</ul><div id="portfolio-list" class="portfolio">';
            /* Start the Loop */
            while ( $main_loop->have_posts() ) : $main_loop->the_post();

      /* 
     Pull category for each unique post using the ID 
     */
     $terms = get_the_terms( $post->ID, 'types' );   
     if ( $terms && ! is_wp_error( $terms ) ) : 
 
         $links = array();
 
         foreach ( $terms as $term ) {
             $links[] = $term->name;
         }
 
         $tax_links = join( " ", str_replace(' ', '-', $links));          
         $tax = strtolower($tax_links);
     else : 
     $tax = '';                 
     endif; 
     

      get_template_part( 'template-parts/content-preview', get_post_format() );  

    
            endwhile;
            echo '</div>';

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>
      
        </main><!-- #main -->


<div class="col-1-1 pagination">
<?php  //if( get_next_posts_link() ) :
    next_posts_link( 'Load More', $main_loop->max_num_pages );
    //endif;
    previous_posts_link( 'Newer Entries' ); 
    ?>

</div>
    </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php
get_footer();
