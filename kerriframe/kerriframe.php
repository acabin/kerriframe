<?php
define('KF_PATH', __DIR__ . '/');

require (KF_PATH . 'factory.php');

class KF extends KF_Factory
{
	private function __construct() {
	}

	protected static $_logger = false;
	public static function log($message, $level = 'info') {
		if (!self::$_logger) {
			self::$_logger = self::singleton('logger');
		}
		self::$_logger->log($message, $level);
	}

	// shortcuts
	public static function header($k, $v) {
		return parent::singleton('response')->header($k, $v);
	}

	public static function baseUrl($uri = '') {
		return parent::singleton('router')->base_url($uri);
	}

	public static function siteUrl($uri = '') {
		return parent::singleton('router')->site_url($uri);
	}

	public static function getClientIP() {
		return $_SERVER['REMOTE_ADDR'];
	}
}

KF::init();
