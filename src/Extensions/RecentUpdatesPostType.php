<?php
namespace TheConference\Extensions;
use TheConference\Interfaces\Extension;

class RecentUpdatesPostType implements Extension {
	
	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		add_action('init', array(__CLASS__, 'registerPostType'));
	}

	public function registerPostType()
	{
		$labels = array(
			'name'               => _x( 'Recent Updates', 'post type general name', _TXTDOM() ),
			'singular_name'      => _x( 'Recent Update', 'post type singular name', _TXTDOM() ),
			'menu_name'          => _x( 'Recent Updates', 'admin menu', _TXTDOM() ),
			'name_admin_bar'     => _x( 'Recent Update', 'add new on admin bar', _TXTDOM() ),
			'add_new'            => _x( 'Add New', 'update', _TXTDOM() ),
			'add_new_item'       => __( 'Add New Update', _TXTDOM() ),
			'new_item'           => __( 'New Update', _TXTDOM() ),
			'edit_item'          => __( 'Edit Update', _TXTDOM() ),
			'view_item'          => __( 'View Update', _TXTDOM() ),
			'all_items'          => __( 'All Updates', _TXTDOM() ),
			'search_items'       => __( 'Search Updates', _TXTDOM() ),
			'parent_item_colon'  => __( 'Parent Updates:', _TXTDOM() ),
			'not_found'          => __( 'No updates found.', _TXTDOM() ),
			'not_found_in_trash' => __( 'No updates found in Trash.', _TXTDOM() )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Recent Updates to your site.', _TXTDOM() ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'recent-updates' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array( 'title', 'excerpt', 'author' )
		);
		register_post_type( 'recent-update', $args );
	}


}