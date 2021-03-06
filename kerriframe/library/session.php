<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * Classes list:
 * - KF_Library_Session
 */
class KF_Library_Session
{
	public function __construct() {
		$sessionConfig = KF::getConfig('session');

		//不使用 GET/POST 变量方式
		ini_set('session.use_trans_sid', 0);

		//设置垃圾回收最大生存时间
		if (isset($sessionConfig['expire'])) {
			ini_set('session.gc_maxlifetime', $sessionConfig['expire']);
		}

		//使用 COOKIE 保存 SESSION ID 的方式
		ini_set('session.use_cookies', 1);
		ini_set('session.cookie_path', '/');

		//多主机共享保存 SESSION ID 的 COOKIE
		$domain = KF::getConfig('cookie') ['domain'];
		ini_set('session.cookie_domain', $domain);

		if (isset($sessionConfig['manager']) && $sessionConfig['manager'] && $sessionConfig['manager'] != 'default') {
			$className = 'KF_Library_Session_' . $sessionConfig['manager'];
			new $className();
		}

		session_start();
	}
}
