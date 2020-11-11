<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Register post types
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 */
class Custom_Post_Types {
    use Singleton;

    public function __construct() {
        $this->hooks();
    }

    public function hooks() {
        add_action( 'init', array( $this, 'register_post_type' ), 0 );
    }

    public function register_post_type() {
        $labels = array(
            'name'                  => _x( 'Teams', 'Team General Name', 'sobercheck' ),
            'singular_name'         => _x( 'Team', 'Team Singular Name', 'sobercheck' ),
            'menu_name'             => __( 'Teams', 'sobercheck' ),
            'name_admin_bar'        => __( 'Team', 'sobercheck' ),
            'archives'              => __( 'Team Archives', 'sobercheck' ),
            'attributes'            => __( 'Team Attributes', 'sobercheck' ),
            'parent_item_colon'     => __( 'Parent Team:', 'sobercheck' ),
            'all_items'             => __( 'All Teams', 'sobercheck' ),
            'add_new_item'          => __( 'Add New Team', 'sobercheck' ),
            'add_new'               => __( 'Add New', 'sobercheck' ),
            'new_item'              => __( 'New Team', 'sobercheck' ),
            'edit_item'             => __( 'Edit Team', 'sobercheck' ),
            'update_item'           => __( 'Update Team', 'sobercheck' ),
            'view_item'             => __( 'View Team', 'sobercheck' ),
            'view_items'            => __( 'View Teams', 'sobercheck' ),
            'search_items'          => __( 'Search Team', 'sobercheck' ),
            'not_found'             => __( 'Not found', 'sobercheck' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'sobercheck' ),
            'featured_image'        => __( 'Featured Image', 'sobercheck' ),
            'set_featured_image'    => __( 'Set featured image', 'sobercheck' ),
            'remove_featured_image' => __( 'Remove featured image', 'sobercheck' ),
            'use_featured_image'    => __( 'Use as featured image', 'sobercheck' ),
            'insert_into_item'      => __( 'Insert into item', 'sobercheck' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'sobercheck' ),
            'items_list'            => __( 'Teams list', 'sobercheck' ),
            'items_list_navigation' => __( 'Teams list navigation', 'sobercheck' ),
            'filter_items_list'     => __( 'Filter items list', 'sobercheck' ),
        );

        $args = array(
            'label'                 => __( 'Team', 'sobercheck' ),
            'description'           => __( 'Team Description', 'sobercheck' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-businessperson',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( 'sc_team', $args );
    }
}