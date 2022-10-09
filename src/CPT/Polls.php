<?php

namespace Polliest\CPT;

use Carbon_Fields\Container\Container;
use Polliest\Classes\BladeLoader;

class Polls {

	private static $instance = null;

	public static $ID = 'polls';

	public static function init() {
		if (!self::$instance) {
			self::$instance = new self();
		}

		self::$instance->registerPollsCpt();
	}

	function registerPollsCpt() {
		register_post_type( self::$ID, [
			'label'       => 'Polls',
			'description' => 'Polls',
			'public'      => true
		] );
	}

	static function registerMetaBox() {
		add_meta_box('polls_options', 'Poll options', [self::$instance, 'renderMetaBox'], self::$ID);
	}

	function renderMetaBox() {
		echo BladeLoader::$blade->render('poll_metabox');
	}

}