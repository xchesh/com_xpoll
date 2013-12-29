<?php
// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('text');

/**
 * katalog Form Field class for the katalog component
 */
class JFormFieldAnswer extends JFormField
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Answer';

        protected function getInput()
	{
            $id = JRequest::getVar('id');
            if (isset($id)){
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                $query->select('*');
                $query->from('#__xpoll_answers');
                $query->where('pid='.$id);
                $query->order('title');
                $db->setQuery((string)$query);
                $answer = $db->loadObjectList();
                $return = '';
                if ($answer)
                {
                    foreach($answer as $img)
                    {
                        $return .= '<div class="answer input-append">';
                        $return .= '<input type="text" class="input" name="jform[answer][]" value="'.$img->title.'">';
                        $return .= '<span class="delete btn icon-remove"></span>';
                        $return .= '</div>';
                    }
                }
		return $return;
            }
	}
}