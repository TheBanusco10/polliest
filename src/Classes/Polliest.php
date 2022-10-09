<?php

namespace Polliest\Classes;

use Carbon_Fields\Carbon_Fields;
use Polliest\CPT\Polls;

class Polliest {

	public function init() {
		add_action('init', [$this, 'registerCPTs']);
		add_action( 'after_setup_theme', [$this, 'bootCarbonFields'] );
		add_action('add_meta_boxes', [$this, 'registerMetaBoxes']);
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
}