<?php
/**
 * Plugin Name: Campbellsville - Tab Contents
 * Plugin URI: http://campbellsville.edu
 * Description: Plugin supports tab contents in the site. The plugin is dependent on both `meta-box` and `meta-box-group` plugin. 
 * Version: 1.0
 * Author: CaveIM
 * Author URI: https://caveim.com/
 * License: GPL2
 * 
 **/

define('ABSPATH',ABSPATH);

class CU_TAB_CONTENT {

    public function __construct()
	{
        add_filter( 'rwmb_meta_boxes', array( &$this,'cu_metaboxes') );
        add_filter( 'page_template', array( &$this,'cu_page_template') );
        add_action( 'admin_head', array( &$this,'cu_admin_style') );
    }

    /**
     * Metabox
     **/
    public function cu_metaboxes( $meta_boxes )
    {
        $prefix = 'prefix-cumetabox';

        $meta_boxes[] = [
            'title'      => esc_html__( 'Tab Settings', 'cumetabox' ),
            'id'         => 'cu_meta_box',
            'post_types' => ['page'],
            'context'    => 'normal',
            'priority'   => 'high',
            'fields' => [
                [
                    'type' => 'checkbox',
                    'id'   => 'tab_template',
                    'name' => 'Use Template Tab?<br/><small style="padding-right: 15px; display: block;">Override current template.</small>',
                ],
                [
                    'type' => 'url',
                    'id'   => 'tab_header_banner',
                    'name' => esc_html__( 'Tab Header Image', 'cumetabox' ),
                ],
                [
                    'name' => 'Tab Contents<br/><small style="padding-right: 15px; display: block;">Add tabs within the body contents.</small>',
                    'id' => 'tab_items',
                    'type' => 'group',
                    'clone' => true,
                    'collapsible' => true,
                    'group_title' => ['field' => 'tab_title'],
                    'save_state' => true,
                    'add_button' => 'Add Tab Item',
                    'fields' => [
                        [
                            'name' => 'Tab Title',
                            'id' => 'tab_title',
                            'type' => 'text',
                            'placeholder' => 'General Guidelines',
                        ],
                        [
                            'name' => 'Tab ID',
                            'id' => 'tab_id',
                            'type' => 'text',
                            'placeholder' => 'general-guidelines',
                        ],
                        [
                            'name' => 'Tab Contents',
                            'id' => 'tab_contents',
                            'type' => 'wysiwyg',
                            'raw' => true,
                        ],
                    ],
                ],
            ],
        ];

        return $meta_boxes;

    }

    /**
     * Page Template
     **/
    public function cu_page_template( $page_template )
    {
        // Override Template
        $cu_template_override = rwmb_meta( 'tab_template' );
        if ( empty( $cu_template_override ) ){
            $cu_template_override = 0;
        }
        
        if ( $cu_template_override == 1 ) {
            $page_template = dirname( __FILE__ ) . '/template/landing-page.php';
        }
        return $page_template;
    }

    /**
     * Remove metabox license message
     **/
    public function cu_admin_style()
    {
      print_r('<style>#meta-box-notification, tr#meta-box-group-update td.plugin-update, a.rwmb-activate-license{display:none!important;}</style>');
    }

}

new CU_TAB_CONTENT();