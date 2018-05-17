<?php

/**
 * Plugin Customizer
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
class Portfolio_Customizer {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
  public function __construct() {
    }


public function portfolio_customizer(){

/**
 * Add the theme configuration
 */
Kirki::add_config( 'pt-portfolio', array(
    'option_type' => 'theme_mod',
    'capability'  => 'edit_theme_options',
) );

/**
 * Add the typography section
 */

Kirki::add_section( 'general', array(
    'title'      => esc_attr__( 'General', 'pt-portfolio' ),
    'priority'   => 20,
    'capability' => 'edit_theme_options',
) );
Kirki::add_section( 'typography', array(
    'title'      => esc_attr__( 'Typography', 'pt-portfolio' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
) );

Kirki::add_section( 'posts', array(
    'title'      => esc_attr__( 'Portfolio Options', 'pt-portfolio' ),
    'priority'   => 999,
    'capability' => 'edit_theme_options',
) );

/**
 * Add the body-typography control
 */
Kirki::add_field( 'body_typography', array(
    'type'        => 'typography',
    'settings'    => 'body_typography',
    'label'       => esc_attr__( 'Body Typography', 'pt-portfolio' ),
    'description' => esc_attr__( 'Select the main typography options for your site.', 'pt-portfolio' ),
    'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'pt-portfolio' ),
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'color'          => '#333333',
    ),
    'output' => array(
        array(
            'element' => 'body, p',
        ),
    ),
) );

/**
 * Add the body-typography control
 */
Kirki::add_field( 'pt-portfolio', array(
    'type'        => 'typography',
    'settings'    => 'headers_typography',
    'label'       => esc_attr__( 'Headers Typography', 'pt-portfolio' ),
    'description' => esc_attr__( 'Select the typography options for your headers.', 'pt-portfolio' ),
    'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'pt-portfolio' ),
    'section'     => 'typography',
    'priority'    => 10,
    'default'     => array(
        'font-family'    => 'Oswald',
        'variant'        => '400',
    ),
    'output' => array(
        array(
            'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ,'.blog-item h2 a'),
        ),
    ),
) );

/*
*
* Header welcome Text
*/

Kirki::add_field( 'pt-portfolio', array(
  'type'     => 'textarea',
  'settings' => 'welcome_text',
  'label'    => __( 'Header Intro Text', 'pt-portfolio' ),
  'section'  => 'general',
  'priority' => 10,
) );

/*
*
* Footer credit
*/

Kirki::add_field( 'pt-portfolio', array(
  'type'     => 'textarea',
  'settings' => 'footer_text',
  'label'    => __( 'Footer credit Text', 'pt-portfolio' ),
  'section'  => 'general',
  'priority' => 10,
) );

Kirki::add_field( 'pt-portfolio', array(
    'type'        => 'color',
    'settings'    => 'accent_color',
    'label'       => __( 'Site Accent Color', 'pt-portfolio' ),
    'section'     => 'colors',
    'default'     => '#000',
    'priority'    => 1,
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => 'a,#cssmenu ul li ul li:hover>a, #cssmenu ul li ul li.active>a',
            'property' => 'color',
        ),
        array(
            'element'  => '#cssmenu>ul>li.has-sub>a:before',
            'property' => 'border-top-color',
        ),
        array(
            'element'  => 'ul#filters li a.active',
            'property' => 'border-bottom-color',
        ),
        array(
            'element'  => '.pagination .current,.pagination a:hover, button, input[type="button"], input[type="reset"], input[type="submit"]',
            'property' => 'background',
        ),
)) );
}
}