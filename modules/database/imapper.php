<?php defined('DOC_ROOT') or exit();

/**
 * JAMP IMapper Interface
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
interface IMapper
{
	public function insert($data);
	public function update($data);
}