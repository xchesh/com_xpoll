<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

// Подключаем библиотеку controllerform Joomla.
jimport('joomla.application.component.controllerform');

/**
 * Xpoll контроллер.
 */
class XpollControllerXpoll extends JControllerForm
{
	/**
	 * Переопределение метода для проверки, 
	 * может ли пользователь редактировать существующую запись.
	 *
	 * @param  array   $data  Массив данных.
	 * @param  string  $key   Имя первичного ключа.
	 *
	 * @return  boolean  True, если разрешено редактировать запись.
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
            $recordId = (int)isset($data[$key]) ? $data[$key] : 0;

            if ($recordId)
            {
                // Проверка редактирования на уровне записи.
                return JFactory::getUser()->authorise('core.edit', 'com_xpoll.xpoll.' . $recordId);
            }
            else
            {
                // Проверка редактирования на уровне компонента.
                return parent::allowEdit($data, $key);
            }
	}
        
        protected function postSaveHook(JModelLegacy $model, $validData = array())
	{
            $this->setAnswerDB($validData['answer'], $model->get('state')->get('xpoll.id'));
            return true;
	}
        protected function setAnswerDB($arr,$id) 
        {
            $return = false;
            $db =& JFactory::getDBO();
            $query = "DELETE FROM `#__xpoll_answers` WHERE pid=".$id; //mysql
            $db->setQuery($query);
            if(!$db->query()){
                echo __LINE__.$db->stderr();
            };
            if(!isset($id) || $id=='0'){
               
            }
            $insert = 'INSERT INTO `#__xpoll_answers`(`pid`, `title`) VALUES ';
            foreach ($arr as $arr){
                $insert .= "('".$id."','".$arr."'), ";
            }
            $insert = substr($insert,0,-2);
            $db->setQuery($insert);
            if($db->query()){
                $return = true;
            }else{
                echo __LINE__.$db->stderr();
            }
            return $return;
        }
}