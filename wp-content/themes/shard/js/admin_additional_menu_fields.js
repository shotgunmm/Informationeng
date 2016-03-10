jQuery(document).ready(function($) {
    "use strict";

    var $depth_zero = $('#menu-to-edit').find('.menu-item-depth-0');
    var $depth_one = $('#menu-to-edit').find('.menu-item-depth-1');

    var i = 0;
    $depth_zero.find('.field-description').each(function(){
        i++;
        $(this).before('<p class="field-abdev-additional description-wide"><label for="add_mega'+i+'">Menu Type<br><select id="add_mega'+i+'" class="abdev_additional_input add_mega"><option value="">Default Standard Menu</option><option value="mega1">Mega Menu - Single Column</option><option value="mega2">Mega Menu - 2 Columns</option><option value="mega3">Mega Menu - 3 Columns</option><option value="mega4">Mega Menu - 4 Columns</option><option value="mega5">Mega Menu - 5 Columns</option><option value="mega6">Mega Menu - 6 Columns</option><option value="mega7">Mega Menu - 7 Columns</option></select></p>');
        var classes = $(this).siblings('.field-css-classes').find('input').val();
        var current_c;
        for (var c = 1; c <= 7; c++) {
            current_c = 'mega'+c;
            if(classes.indexOf(current_c) >= 0) {
                $(this).siblings('.field-abdev-additional').find('select').val(current_c);
            }
        };
    });

    $depth_one.find('.field-description').each(function(){
        i++;
        var use_desc_state = ($(this).siblings('.field-css-classes').find('input').val().indexOf('use_desc') >= 0) ? ' checked' : '';
        var no_title_state = ($(this).siblings('.field-css-classes').find('input').val().indexOf('no_title') >= 0) ? ' checked' : '';
        $(this).before('<p class="field-abdev-additional description-wide"><br><label for="use_desc'+i+'"><input type="checkbox" id="use_desc'+i+'" class="abdev_additional_input use_desc" value="use_desc"'+use_desc_state+'>Use description field as HTML content<br></label><label for="no_title'+i+'"><input type="checkbox" id="no_title'+i+'" class="abdev_additional_input no_title" value="no_title"'+no_title_state+'>Hide title</label></p>');
    });

    $('.abdev_additional_input, .edit-menu-item-classes').change(function() {
        var $parent_item = $(this).closest('.menu-item');
        define_classes($parent_item);
    });

    function define_classes($item){
        var $class_field = $item.find('.field-css-classes input');
        var current_class_value = $class_field.val().replace('use_desc','').replace('no_title','').replace('mega1','').replace('mega2','').replace('mega3','').replace('mega4','').replace('mega5','').replace('mega6','').replace('mega7','').replace('  ',' ');

        var new_class_value = [];

        new_class_value.push(current_class_value.trim());

        if($item.find('.add_mega').length > 0 && $item.find('.add_mega').val() !== ''){
            new_class_value.push($item.find('.add_mega').val());
        }

        if($item.find('.use_desc').length > 0 && $item.find('.use_desc').is(':checked')){
            new_class_value.push('use_desc');
        }

        if($item.find('.no_title').length > 0 && $item.find('.no_title').is(':checked')){
            new_class_value.push('no_title');
        }

        $class_field.val(new_class_value.join(' ').trim());

    }


});