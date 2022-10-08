<?php

/*
Plugin Name: Polliest
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: david
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

use Polliest\Classes\Polliest;

defined('ABSPATH') or die();

require_once 'vendor/autoload.php';

$polliest = new Polliest();

$polliest->init();