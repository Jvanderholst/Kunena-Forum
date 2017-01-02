<?php
/**
 * Kunena Component
 * @package         Kunena.Site
 * @subpackage      Controller.Announcement
 *
 * @copyright       Copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;

/**
 * Class ComponentKunenaControllerAnnouncementEditDisplay
 *
 * @since  K4.0
 */
class ComponentKunenaControllerAnnouncementEditDisplay extends KunenaControllerDisplay
{
	/**
	 * @var string
	 * @since Kunena
	 */
	protected $name = 'Announcement/Edit';

	/**
	 * @var string
	 * @since Kunena
	 */
	public $announcement;

	/**
	 * Prepare announcement form display.
	 *
	 * @return void
	 * @since Kunena
	 */
	protected function before()
	{
		parent::before();

		$id = $this->input->getInt('id', null);

		$this->announcement = KunenaForumAnnouncementHelper::get($id);
		$this->announcement->tryAuthorise($id ? 'edit' : 'create');
	}

	/**
	 * Prepare document.
	 *
	 * @return void
	 * @since Kunena
	 */
	protected function prepareDocument()
	{
		$app       = JFactory::getApplication();
		$menu_item = $app->getMenu()->getActive();

		if ($menu_item)
		{
			$params             = $menu_item->params;
			$params_title       = $params->get('page_title');
			$params_keywords    = $params->get('menu-meta_keywords');
			$params_description = $params->get('menu-meta_description');

			if (!empty($params_title))
			{
				$title = $params->get('page_title');
				$this->setTitle($title);
			}
			else
			{
				$this->setTitle(JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS'));
			}

			if (!empty($params_keywords))
			{
				$keywords = $params->get('menu-meta_keywords');
				$this->setKeywords($keywords);
			}
			else
			{
				$this->setKeywords(JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS'));
			}

			if (!empty($params_description))
			{
				$description = $params->get('menu-meta_description');
				$this->setDescription($description);
			}
			else
			{
				$this->setDescription(JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS'));
			}
		}
	}
}
