<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Template Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
abstract class Controller_Template
{
	protected $templateFileName = '';
	
	protected $innerContent;
	
	public function __construct()
	{
	}
	
	public function setInnerContent($content)
	{
		$this->innerContent = $content;
	}
	
	public function getInnerContent()
	{
		return $this->innerContent;
	}
	
	abstract public function renderPage();
}