function moveNext(container) {
    var active = container.find('.active');
    var next = active.next();
    var siblings = container.children();

    if (next.length > 0) {
        siblings.each(function(){ $(this).removeClass('active'); });
        next.addClass('active');
    };
}

function movePrevious(container) {
    var active = container.find('.active');
    var prev = active.prev();
    var siblings = container.children();

    if (prev.length > 0) {
        siblings.each(function(){ $(this).removeClass('active'); });
        prev.addClass('active');
    };
}

function moveWordTo(container, position) {
    var active = container.find('.active a');
    if (active.length > 0) {
        var target = '.'+position+' > ul li';

        // Don't add the element if the element is already assign
        var present = false;
        $('.receiver').find('a').each(function() {
            if ($(this).data('id') == active.data('id')) {
                active.find('span.title').effect("bounce");
                present = true;
                return false;
            };
        })
        if (present) {
            return false;
        };

        var new_element = jQuery('<a/>', {
            href: '#',
            text: active.data('title')
        })
        $('<i class="icon-trash icon-white"></i>').appendTo(new_element);
        new_element.appendTo(target);
        new_element.data({
                'id'    : active.data('id'),
                'title' : active.data('title')
        });
    };
}

jQuery(document).ready(function($) {

    $('[rel=tooltip]').tooltip({'placement':'bottom'});

    var selectable_container = $('[data-cursor-selectable]');
    selectable_container.on('click', ' > *', function() {
        selectable_container.children().each(function() {
            $(this).removeClass('active');
        })
        var target = $(this);
        target.toggleClass('active');
        return false;
    });

    $( ".receiver ul li" ).sortable({
        connectWith: ".receiver ul li"
    });

    $( ".receiver ul" ).disableSelection();

    jQuery(document).bind('keydown', 'Shift+a',function (e){
        moveWordTo(selectable_container, 'antonyms',true);
        return false;
    });
    jQuery(document).bind('keydown', 'Shift+s',function (e){
        moveWordTo(selectable_container, 'synonyms', true);
        return false;
    });
    jQuery(document).bind('keydown', 'Shift+r',function (e){
        moveWordTo(selectable_container, 'related', true);
        return false;
    });
    jQuery(document).bind('keydown', 'a',function (e){
        moveWordTo(selectable_container, 'antonyms', false);
        return false;
    });
    jQuery(document).bind('keydown', 's',function (e){
        moveWordTo(selectable_container, 'synonyms', false);
        return false;
    });
    jQuery(document).bind('keydown', 'r',function (e){
        moveWordTo(selectable_container, 'related', false);
        return false;
    });
    jQuery(document).bind('keydown', 'left',function (e){
        movePrevious(selectable_container);
        return false;
    });
    jQuery(document).bind('keydown', 'right',function (e){
        moveNext(selectable_container);
        return false;
    });
    jQuery(document).bind('keydown', 'up',function (e){
        movePrevious(selectable_container);
        return false;
    });
    jQuery(document).bind('keydown', 'down',function (e){
        moveNext(selectable_container);
        return false;
    });
    jQuery(document).bind('keydown', '/',function (e){
        $('#search-word').focus();
        return false;
    });

    jQuery(document).bind('keydown', 'n',function (e){
        alert('Not implemente: this button will load the next word')
        return false;
    });
    jQuery(document).bind('keydown', 'p',function (e){
        alert('Not implemente: this button will load the previous word')
        return false;
    });

    jQuery(document).bind('keydown', 'h',function (e){
        $('#help').fadeToggle();
        return false;
    });

    jQuery(document).bind('keydown', 'Ctrl+s',function (e){
        var relations = {'synonyms': [], 'antonyms': [], 'related':[]};

        $.each(relations, function(key, value){
            $('.'+key+'').find('a').each(function(){
                relations[key].push($(this).data('id'));
            });
        });
        console.log(relations);
        return false;
    });

    jQuery(document).bind('keydown', 'l',function (e){
        $('.tab-pane:visible').find('li').each(function() {
            $(this).removeClass('active');
        })
        $('.tab-pane:visible').find('li:first').addClass('active');
        return false;
    });

    $('#help .close, #show-help').on('click', function() {
        $('#help').fadeToggle();
    })

    $('.receiver').on('click', '.icon-trash', function(e, ui) {
        // log($(this));
        $(this).closest('a').remove();
    })
});