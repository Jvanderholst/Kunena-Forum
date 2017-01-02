<?php
/**
 * Kunena Plugin
 *
 * @package         Kunena.Plugins
 * @subpackage      Joomla
 *
 * @copyright       Copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die();

/**
 * Class KunenaLoginJoomla
 * @since Kunena
 */
class KunenaLoginJoomla
{
	/**
	 * @var null
	 * @since Kunena
	 */
	protected $params = null;

	/**
	 * @param $params
	 *
	 * @since Kunena
	 */
	public function __construct($params)
	{
		$this->params = $params;
		require_once JPATH_SITE . '/components/com_users/helpers/route.php';
	}

	/**
	 * Method to login via Joomla! framework
	 *
	 * @param   string  $username   Username of user
	 * @param   string  $password   Password of user
	 * @param   boolean $rememberme Remember the user next time it wants login
	 * @param   string  $secretkey  The secretkey given by user when TFA is enabled
	 *
	 * @return boolean
	 * @since Kunena
	 */
	public function loginUser($username, $password, $rememberme, $secretkey = null)
	{
		$credentials = array('username' => $username, 'password' => $password);

		if ($secretkey)
		{
			$credentials['secretkey'] = $secretkey;
		}

		$options = array('remember' => $rememberme);
		$error   = JFactory::getApplication()->login($credentials, $options);

		return is_bool($error) ? '' : $error;
	}

	/**
	 * @return boolean|string
	 * @throws Exception
	 * @since Kunena
	 */
	public function logoutUser()
	{
		$error = JFactory::getApplication()->logout();

		return is_bool($error) ? '' : $error;
	}

	/**
	 * @return boolean
	 * @since Kunena
	 */
	public function getRememberMe()
	{
		return (bool) JPluginHelper::isEnabled('system', 'remember');
	}

	/**
	 * @return string
	 * @since Kunena
	 */
	public function getLoginURL()
	{
		$Itemid = UsersHelperRoute::getLoginRoute();

		return JRoute::_('index.php?option=com_users&view=login' . ($Itemid ? "&Itemid={$Itemid}" : ''));
	}

	/**
	 * @return string
	 * @since Kunena
	 */
	public function getLogoutURL()
	{
		$Itemid = UsersHelperRoute::getLoginRoute();

		return JRoute::_('index.php?option=com_users&view=login' . ($Itemid ? "&Itemid={$Itemid}" : ''));
	}

	/**
	 * @return null|string
	 * @since Kunena
	 */
	public function getRegistrationURL()
	{
		$usersConfig = JComponentHelper::getParams('com_users');

		if ($usersConfig->get('allowUserRegistration'))
		{
			$Itemid = UsersHelperRoute::getRegistrationRoute();

			return JRoute::_('index.php?option=com_users&view=registration' . ($Itemid ? "&Itemid={$Itemid}" : ''));
		}

		return null;
	}

	/**
	 * @return string
	 * @since Kunena
	 */
	public function getResetURL()
	{
		$Itemid = UsersHelperRoute::getResetRoute();

		return JRoute::_('index.php?option=com_users&view=reset' . ($Itemid ? "&Itemid={$Itemid}" : ''));
	}

	/**
	 * @return string
	 * @since Kunena
	 */
	public function getRemindURL()
	{
		$Itemid = UsersHelperRoute::getRemindRoute();

		return JRoute::_('index.php?option=com_users&view=remind' . ($Itemid ? "&Itemid={$Itemid}" : ''));
	}
}
