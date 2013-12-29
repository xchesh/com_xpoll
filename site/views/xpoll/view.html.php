<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку представления Joomla.
jimport('joomla.application.component.view');

/**
 * HTML представление сообщения компонента Xpoll.
 */
class XpollViewXpoll extends JViewLegacy
{
	/**
	 * Сообщение.
	 *
	 * @var object 
	 */
	protected $item;

	/**
	 * Переопределяем метод display класса JViewLegacy.
	 * 
	 * @return void
	 */
	public function display($tpl = null) 
	{
		// Получаем сообщение.
		$this->items = $this->get('Items');

		// Есть ли ошибки.
		if (count($errors = $this->get('Errors')))
		{
			foreach ($errors as $error)
			{
				JLog::add($error, JLog::ERROR, 'com_xpoll');
			}
		}

		// Подготавливаем документ.
//		$this->_prepareDocument();

		// Отображаем представление.
		parent::display($tpl);
	}

	/**
	 * Подготавливает документ.
	 *
	 * @return void
	 */
//	protected function _prepareDocument()
//	{
//		$app = JFactory::getApplication();
//		$menus = $app->getMenu();
//		$title = null;
//
//		// Так как приложение устанавливает заголовок страницы по умолчанию, 
//		// мы получаем его из пункта меню.
//		$menu = $menus->getActive();
//
//		
//
//		if (empty($title))
//		{
//			$title = $app->getCfg('sitename');
//		}
//		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
//		{
//			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
//		}
//		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
//		{
//			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
//		}
//		else
//		{
////			$title = $this->item[]->category;
//		}
//
//		// Устанавливаем заголовок страницы в браузере.
//		$this->document->setTitle($title);
//	}
}