<?php
/**
 * The template for displaying a grid gallery
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package portfolio
 */

get_header();?>

<div id="primary" class="content-area ">
    <main id="main" class="site-main" role="main">
    <div class="grid">

    <?php
    while (have_posts()): the_post();?>


    <article id="post-<?php the_ID();?>" <?php post_class('col-1-1');?>>
        <header class="entry-header padded">

        <?php
        if (is_single()):
            the_title('<h1 class="entry-title">', '</h1>');
        else:
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()): ?>
                <div class="entry-meta">
                    <?php portfolio_posted_on();?>
                </div><!-- .entry-meta -->
                <?php
        endif;?>
        </header><!-- .entry-header -->

    <div class="entry-content padded">
        <?php
            the_content();

            $client = get_post_meta(get_the_ID(), 'portfolio_client', true);
            if (!empty($client)): ?>
                        <ul class="portfolio-meta">
                        <li>
                        <?php
            echo '<h5>' . esc_html__('Client', 'portfolio') . '</h5>';
            echo $client; ?>
                        </li>
                        <?php endif;?>

                        </ul>
                        <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'portfolio'),
                'after'  => '</div>',
            ));
            ?>
    </div><!-- .entry-content -->

    </article><!-- #post-## -->
    </div><!-- grid -->
    <div class="grid-wide">
    <div class="portfolio-gallery">
        <div class='single-post-thumb'>
        <?php $video = esc_url(get_post_meta(get_the_ID(), 'portfolio_video', 1));?>
            <?php if (!empty($video)): ?>
            <ul class="portfolio-gallery-list">
                <li><?php echo wp_oembed_get($video); ?></li>
            </ul>
        <?php endif;?>
        </div>
    </div>


    <div class="portfolio-gallery">
        <div class='single-post-thumb'>

            <?php $gallery_images = get_post_meta(get_the_ID(), 'portfolio_gallery', true);?>

            <ul class="portfolio-gallery-list masonry">
                <?php if (!empty($gallery_images)): ?>
                    <?php foreach ($gallery_images as $attachment_id => $img_full_url): ?>
                        <li class="col-4-12 grid-item portfolio-item">
                            <a href="<?php echo wp_get_attachment_url($attachment_id); ?>" class="swipebox wp-link">
                            <img src="<?php echo wp_get_attachment_image($attachment_id, 'large'); ?>">
                        </a></li>
                <?php endforeach;?>
            </ul>
                <?php endif;?>
    </div>
    </div>

    <?php
    the_post_navigation();


    endwhile; // End of the loop.
    ?>
    </div><!-- end grid wide -->
    </main><!-- #main -->

    </div><!-- #primary -->


<?php get_footer();