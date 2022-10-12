<?php

namespace Quiziest\CPT;

use Carbon_Fields\Container\Container;
use Quiziest\Classes\BladeLoader;
use Quiziest\Helpers\Assets;

class QuizCPT {

	private static $instance = null;

	public static $ID = 'quiz';

	public static function init() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		self::$instance->registerQuizCpt();
		self::$instance->registerQuizCPTScripts();

		add_action( 'save_post', [ self::$instance, 'onSavePost' ] );
	}

	function registerQuizCpt() {
		register_post_type( self::$ID, [
			'label'       => 'Quizes',
			'description' => 'Quizes',
			'public'      => true
		] );
	}

	static function registerMetaBox() {
		add_meta_box( 'options-metabox', 'Quiz options', [ self::$instance, 'renderMetaBox' ], self::$ID );
	}

	function renderMetaBox( $post ) {
		$options = get_post_meta( $post->ID, 'quiz_options', true );

		echo BladeLoader::$blade->render( 'quiz_metabox', [
			'options' => $options,
			'post_ID' => $post->ID,
		] );
	}

	function registerQuizCPTScripts() {
		Assets::addScript( 'quiz-options', PLUGIN_URL . 'Assets/js/quizMetabox.js', [ 'jquery' ], '', true, QuizCPT::$ID );
		Assets::addStyle( 'quiz-metabox', PLUGIN_URL . 'Assets/css/quizMetabox.css', [], false, QuizCPT::$ID );
	}

	function onSavePost( $post_ID ) {
		$options = $_POST[ $post_ID . '-option' ] ?? [];

		if ( sizeof( $options ) > 0 ) {

			// Removing empty fields
			$options = array_filter( $options );

			update_post_meta( $post_ID, 'quiz_options', $options );
		}
	}

}