<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Base Singleton Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
abstract class Base_Singleton
{	
	abstract protected function __construct();
	
	public static function instance() { }
}