<?php

namespace Quiziest\Classes;

use Carbon_Fields\Carbon_Fields;
use Quiziest\CPT\QuizCPT;

class Quiziest {

	public function init() {
		add_action( 'init', [ $this, 'registerCPTs' ] );
		add_action( 'after_setup_theme', [ $this, 'bootCarbonFields' ] );
		add_action( 'add_meta_boxes', [ $this, 'registerMetaBoxes' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'registerScripts' ] );
		BladeLoader::init();
	}

	function registerCPTs() {
		QuizCPT::init();
	}

	function registerMetaBoxes() {
		QuizCPT::registerMetaBox();
	}

	function bootCarbonFields() {
		Carbon_Fields::boot();
	}

	function registerScripts() {
		global $post_type;

		$scripts = apply_filters( 'quiziest/registerScripts', [] );
		$styles  = apply_filters( 'quiziest/registerStyles', [] );

		foreach ( $scripts as $script ) {
			if ( ! $script['post_type'] ) {
				wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
			} else {
				if ( $post_type === $script['post_type'] ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
				}
			}
		}

		foreach ( $styles as $style ) {
			if ( ! $style['post_type'] ) {
				wp_enqueue_style( $style['handle'], $style['src'], $style['deps'], $style['ver'] );
			} else {
				if ( $post_type === $style['post_type'] ) {
					wp_enqueue_style( $style['handle'], $style['src'], $style['deps'], $style['ver'] );
				}
			}
		}
		wp_localize_script( 'quiz-options', 'ajax', [ 'url' => admin_url( 'admin-ajax.php' ) ] );

	}
}