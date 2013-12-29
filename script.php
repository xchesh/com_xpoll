<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

/**
* Файл-скрипт для компонента Xpoll.
*/
class com_XpollInstallerScript
{
	/**
	 * Метод для установки компонента.
	 *
	 * @param object Класс, который вызывает этом метод.
	 *
	 * @return void
	 */
	function install($parent) 
	{
            $basePath = JPATH_ADMINISTRATOR.'/components/com_categories';
            require_once $basePath.'/models/category.php';
            $config  = array('table_path' => $basePath.'/tables');
            $catmodel = new CategoriesModelCategory($config);
            $catData = array('id' => 0, 'parent_id' => 0, 'level' => 1, 'path' => 'uncategorized', 'extension' => 'com_xpoll',
                'title' => 'Uncategorized', 'alias' => 'uncategorized', 'description' => '', 'published' => 1, 'language' => '*');
            $catmodel->save($catData);
            $catid = $catmodel->getItem()->id; // Uncategorized category ID

            $db =& JFactory::getDBO();
            $query = "UPDATE `#__xpoll` SET `catid`='".$catid."' WHERE id=1";
            $db->setQuery($query);
            if(!$db->query()){
                echo __LINE__.$db->stderr();
            }else{
                $parent->getParent()->setRedirectURL('index.php?option=com_xpoll');
            }
            
	}

	/**
	 * Метод для удаления компонента.
	 *
	 * @param object Класс, который вызывает этом метод.
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_XPOLL_UNINSTALL_TEXT') . '</p>';
	}

	/**
	 * Метод для обновления компонента.
	 *
	 * @param object Класс, который вызывает этом метод.
	 *
	 * @return void
	 */
	function update($parent) 
	{
		echo '<p>' . JText::sprintf('COM_XPOLL_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}

	/**
	 * Метод, который исполняется до install/update/uninstall.
	 *
	 * @param  object  $type     Тип изменений: install, update или discover_install
	 * @param  object  $parent  Класс, который вызывает этом метод. Класс, который вызывает этом метод.
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		echo '<p>' . JText::_('COM_XPOLL_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	/**
	 * Метод, который исполняется после install/update/uninstall.
	 *
	 * @param  object  $type     Тип изменений: install, update или discover_install
	 * @param  object  $parent  Класс, который вызывает этом метод. Класс, который вызывает этом метод.
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		echo '<p>' . JText::_('COM_XPOLL_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
                
}