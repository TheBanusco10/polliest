<?php

namespace Quiziest\Helpers;

class Assets {

	/**
	 * @param $handle
	 * @param $src
	 * @param $deps
	 * @param $ver
	 * @param $in_footer
	 * @param $post_type : Post type name if you want to display a script only there
	 *
	 * @return void
	 */
	public static function addScript( $handle, $src, $deps, $ver, $in_footer, $post_type = null ) {
		$scriptInformation = [
			'handle'    => $handle,
			'src'       => $src,
			'deps'      => $deps,
			'ver'       => $ver,
			'in_footer' => $in_footer,
			'post_type' => $post_type,
		];

		add_filter( 'quiziest/registerScripts', function ( $script ) use ( $scriptInformation ) {
			$script[] = $scriptInformation;

			return $script;
		}, 1 );
	}

	/**
	 * @param $handle
	 * @param $src
	 * @param $deps
	 * @param $ver
	 * @param $post_type : Post type name if you want to display a script only there
	 *
	 * @return void
	 */
	public static function addStyle( $handle, $src, $deps, $ver, $post_type = null ) {
		$styleInformation = [
			'handle'    => $handle,
			'src'       => $src,
			'deps'      => $deps,
			'ver'       => $ver,
			'post_type' => $post_type,
		];

		add_filter( 'quiziest/registerStyles', function ( $styles ) use ( $styleInformation ) {
			$styles[] = $styleInformation;

			return $styles;
		}, 1 );
	}

}