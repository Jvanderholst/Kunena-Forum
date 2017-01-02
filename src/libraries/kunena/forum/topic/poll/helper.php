<?php
/**
 * Kunena Component
 * @package       Kunena.Framework
 * @subpackage    Forum.Topic.Poll
 *
 * @copyright     Copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license       http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link          https://www.kunena.org
 **/
defined('_JEXEC') or die();

/**
 * Class KunenaForumTopicPollHelper
 * @since Kunena
 */
abstract class KunenaForumTopicPollHelper
{
	/**
	 * @var array
	 * @since Kunena
	 */
	protected static $_instances = array();

	/**
	 * Returns KunenaForumTopic object.
	 *
	 * @param   int  $identifier The poll to load - Can be only an integer.
	 * @param   bool $reload
	 *
	 * @return KunenaForumTopicPoll
	 * @since Kunena
	 */
	static public function get($identifier = null, $reload = false)
	{
		if ($identifier instanceof KunenaForumTopicPoll)
		{
			return $identifier;
		}

		$id = intval($identifier);

		if ($id < 1)
		{
			return new KunenaForumTopicPoll;
		}

		if ($reload || empty(self::$_instances [$id]))
		{
			self::$_instances [$id] = new KunenaForumTopicPoll($id);
		}

		return self::$_instances [$id];
	}

	/**
	 *
	 * @since Kunena
	 */
	static public function recount()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->update('#__kunena_topics AS a')
			->innerJoin('#__kunena_polls AS b ON a.id=b.threadid')
			->set('a.poll_id=b.id');

		$db->setQuery($query);
		$db->execute();
	}
}
