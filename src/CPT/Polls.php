<?php

namespace Polliest\CPT;

use Carbon_Fields\Container\Container;

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
		add_meta_box('polls_options', 'Poll options', [self::$instance, 'callback'], self::$ID);
	}

	function callback() {
		echo "Options";
	}

}