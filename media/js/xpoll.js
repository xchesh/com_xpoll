jQuery.noConflict();
jQuery(document).ready(function($) {
    
    $('#media2').prepend($("<span id='add' class='btn btn-small btn-success'>Добавить</span>"));
    $('#media2').on('click','span#add',function(){
        $('#media2').append($('<div class="answer input-append"><input type="text" name="jform[answer][]" value=""><span class="delete btn icon-remove"></span></div>'));
    })
    $('#media2').on('click','span.delete',function(){
        $(this).parent().detach();
    })
})