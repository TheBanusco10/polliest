<?php

namespace Polliest\Classes;

use Carbon_Fields\Carbon_Fields;
use Polliest\CPT\Polls;

class Polliest {

	public function init() {
		add_action( 'init', [ $this, 'registerCPTs' ] );
		add_action( 'after_setup_theme', [ $this, 'bootCarbonFields' ] );
		add_action( 'add_meta_boxes', [ $this, 'registerMetaBoxes' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'registerScripts' ] );
		BladeLoader::init();
	}

	function registerCPTs() {
		Polls::init();
	}

	function registerMetaBoxes() {
		Polls::registerMetaBox();
	}

	function bootCarbonFields() {
		Carbon_Fields::boot();
	}

	function registerScripts() {
		global $post_type;

		$scripts = apply_filters( 'polliest/registerScripts', [] );

		foreach ( $scripts as $script ) {
			if ( ! $script['page'] ) {
				wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
			} else {
				if ( $post_type === $script['post_type'] ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
				}
			}
		}
	}
}