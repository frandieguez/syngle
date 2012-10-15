(function ($) {

    var articles = {
        articles: [
            { id: '1', title: 'elem 1'},
            { id: '2', title: 'elem 2'},
            { id: '3', title: 'elem 3'},
            { id: '4', title: 'elem 4'},
            { id: '5', title: 'elem 5'},
            { id: '6', title: 'elem 6'},
            { id: '7', title: 'elem 7'},
            { id: '8', title: 'elem 8'},
            { id: '9', title: 'elem 9'}
        ]
    };

    var template = Handlebars.compile($("#entry_hb").html());
    var content = template(articles);
    console.log($("#entry_hb").html())
    $('#server').html(content);


  })(jQuery);