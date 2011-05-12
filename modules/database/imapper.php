<?php defined('DOC_ROOT') or exit();

/**
 * JAMP IMapper Interface
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
interface IMapper
{
	public function insert(Model $data);
	public function update(Model $data);
}