function moveNext(container) {
    var active = container.find('.active');
    var next = active.next();
    var siblings = active.parent().children();

    if (next.length > 0) {
        siblings.each(function(){ $(this).removeClass('active'); });
        next.addClass('active');
    };
}

function movePrevious(container) {
    var active = container.find('.active');
    var prev = active.prev();
    var siblings = active.parent().children();

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

function makeSelectable() {
    selectable_container.on('click', '[data-cursor-selectable] > *', function() {
        $(this).siblings().each(function() {
            $(this).removeClass('active');
        })
        var target = $(this);
        target.toggleClass('active');
        return false;
    });
}

function loadWords(search_string, new_page) {
    $.ajax({
        url: 'ws.php',
        data: {
            page: new_page,
            search: search_string
        },
        dataType: 'json',
        success: function(data) {
            var source = $("#entry_hb").html();
            var template = Handlebars.compile(source);

            var vars = {
                'next_page' : data.next_page,
                'prev_page' : data.prev_page,
                'articles'  : data.words,
                'search'    : search_string
            }
            var content = template(vars);
            $('#server').html(content);

            pickFirstInTheList();
        }
    });
    makeSelectable()
}

function pickFirstInTheList() {
    $('.tab-pane:visible').find('li').each(function() {
        $(this).removeClass('active');
    })
    $('.tab-pane:visible').find('li:first').addClass('active');
}
var selectable_container = $('#word-provider .tab-pane');

jQuery(document).ready(function($) {
    $('.tab-content').on('submit', '#search-form', function(e, ui) {
        e.preventDefault();
        loadWords($('#search-word').val(), 1);
    })
    loadWords('', 1);

    $('.tab-content').on('click', '.pager a', function() {
        loadWords($(this).data('search-string'), $(this).data('page'));
    });

    $('[rel=tooltip]').tooltip({'placement':'bottom'});

    $( ".receiver ul li" ).sortable({
        connectWith: ".receiver ul li"
    });
    $( ".receiver ul" ).disableSelection();

    jQuery(document).bind('keydown', 'Shift+a',function (e){
        moveWordTo(selectable_container, 'antonyms', true);
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
        var handler = selectable_container.find('.pager .previous a');
        handler.trigger('click');
        return false;
    });
    jQuery(document).bind('keydown', 'right',function (e){
        var handler = selectable_container.find('.pager .next a');
        handler.trigger('click');
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
        return false;
    });

    jQuery(document).bind('keydown', 'l',function (e){
        pickFirstInTheList();
        return false;
    });

    $('#help .close, #show-help').on('click', function() {
        $('#help').fadeToggle();
    })

    $('.receiver').on('click', '.icon-trash', function(e, ui) {
        // log($(this));
        $(this).closest('a').remove();
    });
});