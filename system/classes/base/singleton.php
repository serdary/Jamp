<?php defined('DOC_ROOT') or exit(0);

abstract class Base_Singleton
{	
	abstract protected function __construct();
	
	public static function instance() { }
}