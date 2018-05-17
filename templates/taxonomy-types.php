<?php
/**
 * 
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

    
    <div id="primary" class="content-area cleared">
    <?php $term = get_queried_object(); ?>
    <header class="archive-header">
    <h1 class="archive-title">
        <?php echo $term->name; ?>
        <?php //post_type_archive_title(); ?>
    </h1>
        <main id="main" class="site-main mass magpad" role="main">
        
        <?php
        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
        $args = array(
            'paged' => $paged,
            'post_type' => 'portfolio',
            'types' => $term->slug
            );
        $main_loop = new WP_Query( $args );

        if ( $main_loop->have_posts() ) :?>

    
        
        
           <?php
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
            ?>
<article id="post-<?php the_ID(); ?>" class="<?php echo $tax; ?> all col-4-12 grid-item portfolio-item" >
    <?php   if ( has_post_thumbnail() ) { ?>
        <div class='post-thumb'>
                <a href="<?php the_permalink();?>" >
                <?php the_post_thumbnail('photopress-thumb'); ?>
                </a>
        </div>

  <div class="overbox">
    <div class="title overtext"> 
        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
</div>
    <div class="tagline overtext"> <?php do_action('portfolio-terms'); ?> </div>
  </div>

    <?php } ?>
</article><!-- #post-## -->
            <?php
            endwhile;
            echo '</div>';

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>
      
        </main><!-- #main -->
<div class="col-1-1 pagination">
<?php next_posts_link(  'Load More', $main_loop->max_num_pages ); ?>
             <?php previous_posts_link('Previous') ?>
</div>
    </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php
get_footer();
