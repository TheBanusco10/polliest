<?php

namespace Polliest\CPT;

use Carbon_Fields\Container\Container;
use Polliest\Classes\BladeLoader;
use Polliest\Helpers\Assets;

class Polls {

	private static $instance = null;

	public static $ID = 'polls';

	public static function init() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		self::$instance->registerPollsCpt();
		self::$instance->registerScripts();

		add_action( 'save_post', [ self::$instance, 'onSavePost' ] );
	}

	function registerPollsCpt() {
		register_post_type( self::$ID, [
			'label'       => 'Polls',
			'description' => 'Polls',
			'public'      => true
		] );
	}

	static function registerMetaBox() {
		add_meta_box( 'polls_options', 'Poll options', [ self::$instance, 'renderMetaBox' ], self::$ID );
	}

	function renderMetaBox() {
		echo BladeLoader::$blade->render( 'poll_metabox' );
	}

	function registerScripts() {
		Assets::addScript( 'poll-options', PLUGIN_URL . 'Assets/js/pollsMetabox.js', [ 'jquery' ], '', true, Polls::$ID );
	}

	function onSavePost( $post_ID ) {
		var_dump( $_POST[ $post_ID . '-option' ] );
		die();
	}

}