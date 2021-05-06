<?php
/*
Widget Name: RA Post Carousel
Description: A simple post carousel widget.
Author: Rotsen Mark Acob
Author URI: https://rotsenacob.com
*/

class RA_Post_Carousel_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'ra-post-carousel',
            __( 'RA Post Carousel', 'ra-post-carousel-widget' ),
            array(
                'description' => __( 'A simple post carousel widget', 'ra-post-carousel-widget' ),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path( __FILE__ ) . 'widgets'
        );
    }

    function get_widget_form() {
    	return array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'ra-post-carousel-widget'),
				'default' => ''
			),
			'class' => array(
				'type' => 'text',
				'label' => __( 'Class', 'ra-post-carousel-widget' )
			),
			'post' => array(
				'type' => 'posts',
				'label' => __( 'Post Query', 'ra-post-carousel-widget' )
			),
			'structure' => array(
				'type' => 'section',
				'label' => __( 'Post Settings', 'ra-post-carousel-widget' ),
				'hide' => true,
				'fields' => array(
					'display' => array(
						'type' => 'checkboxes',
						'label' => __( 'Display Settings', 'ra-post-carousel-widget' ),
						'options' => array(
							'thumbnail' => __( 'Post Thumbnail', 'ra-post-carousel-widget' ),
							'title' => __( 'Post Title', 'ra-post-carousel-widget' ),
							'content' => __( 'Post Content', 'ra-post-carousel-widget' )
						),
						'default' => 'thumbnail',
						'state_emitter' => array(
							'callback' => 'conditional',
							'args' => array( 'structure[display]: val == thumbnail' )
						)
					),
					'size' => array(
						'type' => 'image-size',
						'label' => __( 'Thumbnail Size', 'ra-post-carousel-widget' ),
						'custom_size' => true,
						'state_handler' => array(
							'structure[display][thumbnail]' => array( 'show' )
						)
					)
				)
			),
			'slideshow' => array(
				'type' => 'section',
				'label' => __( 'Slideshow Settings', 'ra-post-carousel-widget' ),
				'hide' => true,
				'fields' => array(
					'slides' => array(
						'type' => 'number',
						'default' => 1,
						'label' => __( 'Slides', 'ra-post-carousel-widget' )
					),
					'speed' => array(
						'type' => 'number',
						'default' => 250,
						'label' => __( 'Speed', 'ra-post-carousel-widget' ),
					),
					'autoplay' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Enable autoplay?', 'ra-post-carousel-widget' ),
					),
					'navigation' => array(
						'type' => 'checkbox',
						'default' => true,
						'label' => __( 'Display navigation?', 'ra-post-carousel-widget' ),
					),
					'pagination' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Display pagination?', 'ra-post-carousel-widget' ),
					),
					'autoheight' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Enable autoheight?', 'ra-post-carousel-widget' ),
					),
					'autowidth' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Enable autowidth?', 'ra-post-carousel-widget' ),
					),
					'center' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Center item', 'ra-post-carousel-widget' ),
					),
					'mergefit' => array(
						'type' => 'checkbox',
						'default' => false,
						'label' => __( 'Fit merged items?', 'ra-post-carousel-widget' ),
					),
					'loop' => array(
						'type' => 'checkbox',
						'default' => true,
						'label' => __( 'Loop items?', 'ra-post-carousel-widget' )
					)
				)
			),
			'responsive' => array(
				'type' => 'section',
				'label' => __( 'Responsive Settings', 'ra-post-carousel-widget' ),
				'hide' => true,
				'fields' => array(
					'mobile' => array(
						'type' => 'number',
						'label' => __( 'Slides for mobile', 'ra-post-carousel-widget' ),
						'default' => 1
					),
					'tablet' => array(
						'type' => 'number',
						'label' => __( 'Slides for tablets', 'ra-post-carousel-widget' ),
						'default' => 1
					),
				)
			),
			'template' => array(
				'type' => 'select',
				'label' => __( 'Choose template', 'ra-post-carousel-widget' ),
				'options' => array(
					'default' => __( 'Default', 'ra-post-carousel-widget' )
				),
				'default' => 'default'
			)
		);
    }

    function get_template_name( $instance ) {
        switch ( $instance['template'] ) {
            case 'default':
            default:
                return 'default';
                break;
        }
    }

    function get_template_variables( $instance, $args ) {
    	return array(
			'title' => $instance['title'],
			'class' => $instance['class'],
			'post' => $instance['post'],
			'structure' => $instance['structure'],
			'display' => $instance['structure']['display'],
			'size' => $instance['structure']['size'],
			'template' => $instance['template'],
			'slides' => $instance['slideshow']['slides'],
			'speed' => $instance['slideshow']['speed'],
			'autoplay' => $instance['slideshow']['autoplay'],
			'navigation' => $instance['slideshow']['navigation'],
			'pagination' => $instance['slideshow']['pagination'],
			'autowidth' => $instance['slideshow']['autowidth'],
			'autoheight' => $instance['slideshow']['autoheight'],
			'center' => $instance['slideshow']['center'],
			'loop' => $instance['slideshow']['loop'],
			'slides_mobile' => $instance['responsive']['mobile'],
			'slides_tablet' => $instance['responsive']['tablet']
    	);
    }
}

siteorigin_widget_register( 'ra-post-carousel', __FILE__, 'RA_Post_Carousel_Widget' );