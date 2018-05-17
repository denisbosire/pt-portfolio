<?php
/**
 * Template name: 4 columns
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

	
    <div id="primary" class="content-area">
        <main id="main" class="site-main magpad" role="main">
        
        <?php
        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
        $args = array(
            'paged' => $paged,
            'post_type' => 'portfolio',
            );
        $main_loop = new WP_Query( $args );

        if ( $main_loop->have_posts() ) :

        echo '<ul id="filters">'; //Portfolio Filters

        $terms = get_terms('types');
        $count = count($terms);
            echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">All</a></li>';
        if ( $count > 0 ){
 
            foreach ( $terms as $term ) {
 
                $termname = strtolower($term->name);
                $termname = str_replace(' ', '-', $termname);
                echo '<li><a href="javascript:void(0)" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
            }
        }
        
            echo '</ul><div id="portfolio-list" class="masonry">';
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
<article id="post-<?php the_ID(); ?>" class="<?php echo $tax; ?> all col-3-12 portfolio-item" >
    <?php   if ( has_post_thumbnail() ) { ?>
        <div class='post-thumb'>
                <a href="<?php the_permalink();?>" >
                <?php the_post_thumbnail('draft-portfolio-thumbnail'); ?>
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
