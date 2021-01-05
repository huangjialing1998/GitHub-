<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Administrator
 * @subpackage      Models
 *
 * @copyright       Copyright (C) 2008 - 2021 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Administrator\Model;

defined('_JEXEC') or die();

use Exception;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Client\ClientHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Pagination\Pagination;
use Kunena\Forum\Libraries\Factory\KunenaFactory;
use Kunena\Forum\Libraries\Template\KunenaTemplate;
use Kunena\Forum\Libraries\Template\KunenaTemplateHelper;
use Kunena\Forum\Libraries\User\KunenaUserHelper;
use Kunena\Forum\Libraries\Config\KunenaConfig;
use Kunena\Forum\Libraries\User\KunenaUser;
use stdClass;

/**
 * Templates Model for Kunena
 *
 * @since   Kunena 2.0
 */
class TemplatesModel extends AdminModel
{
	/**
	 * @var CMSApplicationInterface|null
	 * @since version
	 */
	private $app;

	/**
	 * @var string
	 * @since version
	 */
	private $context;

	/**
	 * @var string
	 * @since version
	 */
	private $cache;

	/**
	 * @var KunenaConfig
	 * @since version
	 */
	private $config;

	/**
	 * @var KunenaUser|null
	 * @since version
	 */
	private $me;

	/**
	 * @param   array  $config  config
	 *
	 * @throws  Exception
	 * @since   Kunena 6.0
	 *
	 */
	public function __construct($config = [])
	{
		parent::__construct($config);
		$this->app    = Factory::getApplication();
		$this->me     = KunenaUserHelper::getMyself();
		$this->config = KunenaFactory::getConfig();
	}

	/**
	 * @param   array  $data      data
	 * @param   bool   $loadData  loadData
	 *
	 * @return  boolean|mixed
	 *
	 * @throws  Exception
	 * @since   Kunena 6.0
	 *
	 * @see     \Joomla\CMS\MVC\Model\FormModel::getForm()
	 *
	 */
	public function getForm($data = [], $loadData = true): bool
	{
		// Load the configuration definition file.
		$template = $this->getState('template');
		$xml      = KunenaTemplate::getInstance($template)->getConfigXml();

		// Get the form.
		$form = $this->loadForm('com_kunena_template', $xml, ['control' => 'jform', 'load_data' => $loadData, 'file' => false], true, '//config');

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * @return  array
	 *
	 * @throws  Exception
	 * @since   Kunena 6.0
	 *
	 */
	public function getTemplates(): array
	{
		// Get template xml file info
		$rows = KunenaTemplateHelper::parseXmlFiles();

		// Set dynamic template information
		foreach ($rows as $row)
		{
			$row->published = KunenaTemplateHelper::isDefault($row->directory);
		}

		$this->setState('list.total', count($rows));

		if ($this->getState('list.limit'))
		{
			$rows = array_slice($rows, $this->getState('list.start'), $this->getState('list.limit'));
		}

		return $rows;
	}

	/**
	 * @return  boolean|stdClass
	 *
	 * @since   Kunena 6.0
	 */
	public function getTemplateDetails()
	{
		$template = $this->app->getUserState('kunena.edit.template');
		$details  = KunenaTemplateHelper::parseXmlFile($template);

		if (empty($template))
		{
			$template = $this->getState('template');
			$details  = KunenaTemplateHelper::parseXmlFile($template);
		}

		return $details;
	}

	/**
	 * @return  boolean|void|string
	 *
	 * @since   Kunena 6.0
	 */
	public function getFileLessParsed()
	{
		$template = $this->app->getUserState('kunena.templatename');
		$filename = $this->app->getUserState('kunena.editless.filename');

		$content = file_get_contents(KPATH_SITE . '/template/' . $template . '/assets/less/' . $filename);
		$content = htmlspecialchars($content, ENT_COMPAT, 'UTF-8');

		if ($content === false)
		{
			return;
		}

		return $content;
	}

	/**
	 * @return  boolean|void|string
	 *
	 * @since   Kunena 6.0
	 */
	public function getFileContentParsed()
	{
		$template = $this->app->getUserState('kunena.templatename');
		$filename = $this->app->getUserState('kunena.editCss.filename');
		$content  = file_get_contents(KPATH_SITE . '/template/' . $template . '/assets/css/' . $filename);

		if ($content === false)
		{
			return;
		}

		$content = htmlspecialchars($content, ENT_COMPAT);

		return $content;
	}

	/**
	 * @return  mixed
	 *
	 * @since   Kunena 6.0
	 */
	public function getFTPCredentials()
	{
		// Set FTP credentials, if given
		return ClientHelper::setCredentialsFromRequest('ftp');
	}

	/**
	 * @return  mixed
	 *
	 * @since   Kunena 6.0
	 */
	public function getPagination(): Pagination
	{
		// Get a storage key.
		$store = $this->getStoreId('getPagination');

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Create the pagination object.
		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page  = new Pagination($this->getTotal(), $this->getStart(), $limit);

		// Add the object to the internal cache.
		$this->cache[$store] = $page;

		return $this->cache[$store];
	}

	/**
	 * @param   string  $id  id
	 *
	 * @return  string
	 *
	 * @since   Kunena 6.0
	 */
	protected function getStoreId($id = ''): string
	{
		// Add the list state to the store id.
		$id .= ':' . $this->getState('list.start');
		$id .= ':' . $this->getState('list.limit');
		$id .= ':' . $this->getState('list.ordering');
		$id .= ':' . $this->getState('list.direction');

		return md5($this->context . ':' . $id);
	}

	/**
	 * @return  integer
	 *
	 * @since   Kunena 6.0
	 */
	public function getTotal(): int
	{
		return $this->getState('list.total');
	}

	/**
	 * @return  integer
	 *
	 * @since   Kunena 6.0
	 */
	public function getStart(): int
	{
		return $this->getState('list.start');
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * @param   null  $ordering   ordering
	 * @param   null  $direction  direction
	 *
	 * @return  void
	 *
	 * @throws Exception
	 * @since   Kunena 6.0
	 *
	 */
	protected function populateState($ordering = null, $direction = null): void
	{
		$this->context = 'com_kunena.admin.templates';

		$app = Factory::getApplication();

		// Adjust the context to support modal layouts.
		$layout = $app->input->get('layout');

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		// Edit state information
		$value = $this->getUserStateFromRequest($this->context . '.edit', 'name', '', 'cmd');
		$this->setState('template', $value);

		if (empty($this->app->getUserState('kunena.edit.templatename')))
		{
			$this->app->setUserState('kunena.edit.templatename', $value);
		}

		// List state information
		$value = $this->getUserStateFromRequest($this->context . '.list.limit', 'limit', $this->app->get('list_limit'), 'int');
		$this->setState('list.limit', $value);

		$value = $this->getUserStateFromRequest($this->context . '.list.ordering', 'filter_order', 'ordering', 'cmd');
		$this->setState('list.ordering', $value);

		$value = $this->getUserStateFromRequest($this->context . '.list.start', 'limitstart', 0, 'int');
		$this->setState('list.start', $value);
	}

	/**
	 * @param   string  $key        key
	 * @param   string  $request    request
	 * @param   null    $default    default
	 * @param   string  $type       type
	 * @param   bool    $resetPage  resetPage
	 *
	 * @return  mixed|null
	 *
	 * @throws Exception
	 * @since   Kunena 6.0
	 *
	 */
	public function getUserStateFromRequest(string $key, string $request, $default = null, $type = 'none', $resetPage = true)
	{
		$app      = Factory::getApplication();
		$input    = $app->input;
		$oldState = $app->getUserState($key);
		$curState = ($oldState !== null) ? $oldState : $default;
		$newState = $input->get($request, null, $type);

		if (($curState != $newState) && ($resetPage))
		{
			$input->set('limitstart', 0);
		}

		// Save the new value only if it is set in this request.
		if ($newState !== null)
		{
			$app->setUserState($key, $newState);
		}
		else
		{
			$newState = $curState;
		}

		return $newState;
	}

	/**
	 * @return  array|mixed
	 *
	 * @throws  Exception
	 * @since   Kunena 6.0
	 *
	 * @see     \Joomla\CMS\MVC\Model\FormModel::loadFormData()
	 *
	 */
	protected function loadFormData(): array
	{
		// Check the session for previously entered form data.
		$data = Factory::getApplication()->getUserState('com_kunena.edit.template.data', []);

		if (empty($data))
		{
			$template = $this->getState('template');
			$data     = KunenaTemplate::getInstance($template)->params->toArray();
		}

		return $data;
	}

	/**
	 * parseKunenaInstallFile
	 *
	 * @return boolean|stdClass|array
	 *
	 * @since Kunena 6.0
	 */
	public function loadTemplatesXml()
	{
		$template1 = array();
		$context   = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
		$url       = 'https://update.kunena.org/templates.xml';

		$xml = file_get_contents($url, false, $context);
		$xml = simplexml_load_string($xml);

		if ($xml)
		{
			foreach ($xml->templates as $template)
			{
				foreach ($template as $temp)
				{
					$attributes             = $temp->attributes();
					$temp                   = new stdClass;
					$temp->name             = (string) $attributes->name;
					$temp->type             = (string) $attributes->element;
					$temp->created          = (string) $attributes->created;
					$temp->author           = (string) $attributes->author;
					$temp->version          = (string) $attributes->version;
					$temp->description      = (string) $attributes->description;
					$temp->detailsurl       = (string) $attributes->detailsurl;
					$temp->price            = (string) $attributes->price;
					$temp->thumbnail        = (string) $attributes->thumbnail;
					$temp->authorurl        = (string) $attributes->authorurl;
					$temp->authoremail      = (string) $attributes->authoremail;
					$template1[$temp->name] = $temp;
				}
			}

			return $template1;
		}

		return false;
	}

	/**
	 * @return array
	 *
	 * @throws Exception
	 * @since Kunena
	 */
	public function getTemplatesXml()
	{
		// Get template xml file info
		return self::loadTemplatesXml();
	}
}