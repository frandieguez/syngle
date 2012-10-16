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

        var new_element = jQuery('<div/>', {
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

function makeCursorSelectable() {
    selectable_container.on('click', '[data-cursor-selectable] > *', function() {
        var target = $(this);
        $(this).siblings().each(function() {
            $(this).removeClass('active');
        })
        target.addClass('active');
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
            var vars = {
                'next_page' : data.next_page,
                'prev_page' : data.prev_page,
                'articles'  : data.words,
                'search'    : search_string,
                'total_pages'     : data.total_pages,
                'show_search_form' : true
            }
            $.get('js/templates/entry_hb.handlebars', function(data) {
                var template = Handlebars.compile(data);
                var content = template(vars);
                $('#server').html(content);

                pickFirstInTheList();
            });
        }
    });
    makeCursorSelectable()
}

function loadSuggestions(search_string, new_page) {
    $.ajax({
        url: 'ws.php',
        data: {
            page: new_page,
            search: 'aba',
            levenshtein: 1
        },
        dataType: 'json',
        success: function(data) {
            var vars = {
                'next_page' : data.next_page,
                'prev_page' : data.prev_page,
                'articles'  : data.words,
                'search'    : search_string,
                'show_search_form' : false
            }
            $.get('js/templates/entry_hb.handlebars', function(data) {
                var template = Handlebars.compile(data);
                var content = template(vars);
                $('#suggestions').html(content);

                pickFirstInTheList();
            });
        }
    });
    makeCursorSelectable()
}

function loadSidebar(search, new_page) {
    $.ajax({
        url: 'ws.php',
        data: {
            page: new_page,
            items: 20
        },
        dataType: 'json',
        success: function(data) {
            var vars = {
                'articles'  : data.words,
                'next_page' : data.next_page,
            }
            $.get('js/templates/sidebar_hb.handlebars', function(data) {
                var template = Handlebars.compile(data);
                var content = template(vars);
                $('#sidebar .word-list .load_more').html(content);

                pickFirstInTheList();
            });
        }
    });
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
    loadSuggestions('', 1);
    loadSidebar('', 1)

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
        var handler = selectable_container.find('.pager:visible .previous a');
        handler.trigger('click');
        return false;
    });
    jQuery(document).bind('keydown', 'right',function (e){
        var handler = selectable_container.find('.pager:visible .next a');
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
        alert('Not implemented: this button will load the next word')
        return false;
    });
    jQuery(document).bind('keydown', 'p',function (e){
        alert('Not implemented: this button will load the previous word')
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
        console.log(relations)
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