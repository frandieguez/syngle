<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DOM cursor navigation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootswatch/2.1.0/united/bootstrap.min.css" rel="stylesheet"   >
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
    <script src="//raw.github.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>

    <style type="text/css">
        .bs-docs-sidenav {
          /*width: 228px;*/
          margin: 0 0 30px 0;
          padding: 0;
          background-color: #fff;
          -webkit-border-radius: 6px;
             -moz-border-radius: 6px;
                  border-radius: 6px;
          -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
             -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
                  box-shadow: 0 1px 4px rgba(0,0,0,.065);
        }
        .bs-docs-sidenav > li > a {
          display: block;
          *width: 190px;
          margin: 0 0 -1px;
          padding: 8px 14px;
          border: 1px solid #e5e5e5;
        }
        .bs-docs-sidenav > li:first-child > a {
          -webkit-border-radius: 6px 6px 0 0;
             -moz-border-radius: 6px 6px 0 0;
                  border-radius: 6px 6px 0 0;
        }
        .bs-docs-sidenav > li:last-child > a {
          -webkit-border-radius: 0 0 6px 6px;
             -moz-border-radius: 0 0 6px 6px;
                  border-radius: 0 0 6px 6px;
        }
        .bs-docs-sidenav > .active > a {
          position: relative;
          z-index: 2;
          padding: 9px 15px;
          border: 0;
          text-shadow: 0 1px 0 rgba(0,0,0,.15);
          -webkit-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
             -moz-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
                  box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
        }
        /* Chevrons */
        .bs-docs-sidenav .icon-chevron-right {
          float: right;
          margin-top: 2px;
          margin-right: -6px;
          opacity: .25;
        }
        .bs-docs-sidenav > li > a:hover {
          background-color: #f5f5f5;
        }
        .bs-docs-sidenav a:hover .icon-chevron-right {
          opacity: .5;
        }
        .bs-docs-sidenav .active .icon-chevron-right,
        .bs-docs-sidenav .active a:hover .icon-chevron-right {
          opacity: 1;
        }
        .bs-docs-sidenav.affix {
          top: 40px;
        }
        .bs-docs-sidenav.affix-bottom {
          position: absolute;
          top: auto;
          bottom: 270px;
        }

        .receiver > div {
          background-color: #fff;
          -webkit-border-radius: 6px;
             -moz-border-radius: 6px;
                  border-radius: 6px;
          -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
             -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
                  box-shadow: 0 1px 4px rgba(0,0,0,.065);
            padding:30px;
            border: 1px solid #E5E5E5;
        }

        #help {
            display:none;
            position:absolute;
            top:60px;
            left:50%;
            width:80%;
            min-height:80%;
            margin-left:-42%;
            background:rgba(0, 0, 0, 0.9);
            border-radius:10px;
            color:White;
            box-shadow:0 0 10px Gray;
            z-index:9999;
        }
        #help > div {
            padding:30px;
            position:relative;
        }
        #help .close {
            position:absolute;
            top:10px;
            right:10px;
            color:White;
        }

        .receiver ul a{
            display:inline-block
            height:24px;
            line-height:24px;
            position:relative;
            font-size:11px;
            margin-bottom:4px;
            margin-left:20px;
            display:inline-block;
            padding:0 15px 0 12px;
            background:#0089e0;
            color:#fff;
            text-decoration:none;
            -moz-border-radius-bottomright:4px;
            -webkit-border-bottom-right-radius:4px;
            border-bottom-right-radius:4px;
            -moz-border-radius-topright:4px;
            -webkit-border-top-right-radius:4px;
            border-top-right-radius:4px;
            }
        .receiver ul  a:before{
            content:"";
            float:left;
            position:absolute;
            top:0;
            left:-12px;
            width:0;
            height:0;
            border-color:transparent #0089e0 transparent transparent;
            border-style:solid;
            border-width:12px 12px 12px 0;
            }
        .receiver ul  a:after{
            content:"";
            position:absolute;
            top:10px;
            left:0;
            float:left;
            width:4px;
            height:4px;
            -moz-border-radius:2px;
            -webkit-border-radius:2px;
            border-radius:2px;
            background:#fff;
            -moz-box-shadow:-1px -1px 2px #004977;
            -webkit-box-shadow:-1px -1px 2px #004977;
            box-shadow:-1px -1px 2px #004977;
            }

        .receiver ul  a:hover{background:#555;}
        .receiver ul  a:hover:before{border-color:transparent #555 transparent transparent;}

        .right {
            text-align:right;
        }

        .list-item .btn-toolbar {
            display:none;
            margin:0 !important;
        }
        .list-item:hover .btn-toolbar {
            display:block;
        }

        footer ul { margin:0; }
        footer ul li { display:inline-block; }
        footer ul li a { padding:0 5px; }
    </style>
</head>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="100">
    <div class="navbar navbar-fixed-top navbar-inverse">
       <div class="navbar-inner">
         <div class="container">
           <a class="brand" href="#">Syngel</a>
           <div class="nav-collapse" id="main-menu">
            <ul class="nav" id="main-menu-left">
                <li><a href="#">Synonym</a></li>
            </ul>
        </div>
         </div>
       </div>
    </div>

<div class="container" style="margin-top:80px;">
    <header class="jumbotron subhead" id="overview">
        <div class="row">
            <div class="">
              <h1 class="span6">Entry</h1>
              <div class="pull-right right">
                <div class="btn-group">
                    <a href="#" class="btn"><i class="icon-chevron-left"></i></a>
                    <a href="#" class="btn"><i class="icon-chevron-right"></i></a>
                </div>
              </div>
              <!-- <p class="lead">Navigate through lists with your cursors.</p> -->
            </div>
        </div>
        <hr>
    </header>
</div>


    <div class="container">

      <div class="row-fluid">
        <div class="span6 receiver">
            <h4>Synonyms</h4>
            <div class="synonyms clearfix">
                <ul></ul>
            </div>

            <h4>Antonyms</h4>
            <div class="antonyms clearfix">
                <ul></ul>
            </div>

            <h4>Related</h4>
            <div class="related clearfix">
                <ul></ul>
            </div>
        </div>
        <div class="span6">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a href="#search-form" data-toggle="tab">Search</a></li>
              <li><a href="#suggestions" data-toggle="tab">Suggestions</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="search-form">
                    <div class="input-append">
                      <input class="span10" id="search-word" size="16" type="text" placeholder="Search for a word…"><button class="btn" type="button">Search !</button>
                    </div>
                    <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
                        <?php for ($i = 0; $i < 10 ; $i++): ?>
                        <li>
                            <a class="list-item clearfix" href="#elem-<?php echo $i; ?>" data-id="elo-<?php echo $i; ?>" data-title="Element <?php echo $i; ?>">
                                <span class="title">Element <?php echo $i; ?></span>
                                <div class="btn-toolbar pull-right">
                                  <div class="btn-group">
                                    <span class="btn add-to-synonym btn-mini">S</span>
                                    <span class="btn add-to-antonym btn-mini">A</span>
                                    <span class="btn add-to-related btn-mini">R</span>
                                  </div>
                                </div>
                            </a>
                        </li>
                        <?php endfor ?>
                    </ul>
                    <ul class="pager">
                      <li class="previous">
                        <a href="#">&larr; Older</a>
                      </li>
                      <li class="next">
                        <a href="#">Newer &rarr;</a>
                      </li>
                    </ul>
                </div>
                <div class="tab-pane" id="suggestions">
                    <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
                        <?php for ($i = 0; $i < 10 ; $i++): ?>
                        <li>
                            <a class="list-item clearfix" href="#elem-<?php echo $i; ?>" data-id="elo-<?php echo $i; ?>" data-title="Sugestion <?php echo $i; ?>">
                                <span class="title">Suggestion <?php echo $i; ?></span>
                                <div class="btn-toolbar pull-right">
                                  <div class="btn-group">
                                    <span class="btn add-to-synonym btn-mini">S</span>
                                    <span class="btn add-to-antonym btn-mini">A</span>
                                    <span class="btn add-to-related btn-mini">R</span>
                                  </div>
                                </div>
                            </a>
                        </li>
                        <?php endfor ?>
                    </ul>
                    <ul class="pager">
                      <li class="previous">
                        <a href="#">&larr; Older</a>
                      </li>
                      <li class="next">
                        <a href="#">Newer &rarr;</a>
                      </li>
                    </ul>
                </div>
            </div>


        </div>
      </div>
    </div>
    <footer class="container">
        <hr>
        <div class="span7">&copy; Syngel - a product by Fran Diéguez</div>
        <div class="pull-right right">
            <ul>
                <li><a href="#">Help</a></li>
                <li><a href="#">Terms of service</a></li>
            </ul>
        </div>
    </footer>

    <div id="help">
        <div>
            <h2>Help about this page</h2>
            <div class="close">X</div>
            <div class="span4">
                <p>At this page you can stablish relationship between words to its
                root word.</p>
                <h6>There are some available relationships:</h6>
                <ul>
                    <li>Synonym</li>
                    <li>Antonym</li>
                    <li>Related: for stablish other kind of relationship</li>
                </ul>
                <h6>Getting words</h6>
                <p>You can get elements to relate from two sources:</p>
                <ul>
                    <li>Searching for a word by using the «Search» form</li>
                    <li>Go to the «Suggestions» tab for getting machine-suggested words (based on
                    word similarity).</li>
                </ul>

                <p>Click over any list item for marking it as active and use the button group
                    for performing an action.</p>
            </div>
            <div class="span4">
                <h5>Keyword shortcuts</h5>
                <p>For quicker usage of this page, you can assign words by using your keyboard.</p>
                <dl>
                    <dt>a :</dt>
                    <dd>Adds the active translation to the antonyms list</dd>
                    <dt>s :</dt>
                    <dd>Adds the active translation to the synonyms list</dd>
                    <dt>r :</dt>
                    <dd>Adds the active translation to the related list</dd>


                    <dt>Shift + a :</dt>
                    <dd>Adds the active translation to the antonyms list as a new concept</dd>
                    <dt>Shift + s :</dt>
                    <dd>Adds the active translation to the synonyms list as a new concept</dd>
                    <dt>Shift + r :</dt>
                    <dd>Adds the active translation to the related list in as a new concept</dd>
                </dl>
            </div>

            <div class="span4">
                <h6>Other shortcuts</h6>
                <dl>
                    <dt>h :</dt>
                    <dd>Shows this help dialog</dd>
                    <dt>/ :</dt>
                    <dd>Focus search input</dd>
                </dl>
            </div>
        </div>
    </div>

    <script type="text/javascript">

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
            var target = '.'+position+' > ul';

            // Don't add the element if the element is already assign
            var present = false;
            $('.receiver').find('a').each(function() {
                if ($(this).data('id') == active.data('id')) {
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

        var selectable_container = $('[data-cursor-selectable]');
        selectable_container.on('click', ' > *', function() {
            selectable_container.children().each(function() {
                $(this).removeClass('active');
            })
            var target = $(this);
            target.toggleClass('active');
            return false;
        });

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

        jQuery(document).bind('keydown', 'h',function (e){
            $('#help').fadeToggle();
            return false;
        });

        $('#help .close').on('click', function() {
            $('#help').fadeToggle();
        })

        $('.receiver').on('click', '.icon-trash', function(e, ui) {
            // log($(this));
            $(this).closest('a').remove();
        })
    });
    </script>
</body>
</html>