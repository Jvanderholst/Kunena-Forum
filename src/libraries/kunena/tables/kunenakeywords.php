<?php
/**
 * Kunena Component
 * @package       Kunena.Framework
 * @subpackage    Tables
 *
 * @copyright     Copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license       http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link          https://www.kunena.org
 **/
defined('_JEXEC') or die();

require_once __DIR__ . '/kunena.php';

/**
 * Kunena Keywords Table
 * Provides access to the #__kunena_keywords table
 * @since Kunena
 */
class TableKunenaKeywords extends KunenaTable
{
	/**
	 * @var null
	 * @since Kunena
	 */
	public $id = null;

	/**
	 * @var null
	 * @since Kunena
	 */
	public $name = null;

	/**
	 * @var null
	 * @since Kunena
	 */
	public $public_count = null;

	/**
	 * @var null
	 * @since Kunena
	 */
	public $total_count = null;

	/**
	 * @param   string $db
	 *
	 * @since Kunena
	 */
	public function __construct($db)
	{
		parent::__construct('#__kunena_keywords', 'id', $db);
	}

	/**
	 * @return boolean
	 * @since Kunena
	 */
	public function check()
	{
		$this->name = trim($this->name);

		if (!$this->name)
		{
			$this->setError(JText::_('COM_KUNENA_LIB_TABLE_KEYWORDS_ERROR_EMPTY'));
		}

		return ($this->getError() == '');
	}
}
