<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Syngle - Web application for creating Hunspell Synonym thesaurus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web application for creating Hunspell Synonym thesaurus">
    <meta name="author" content="Fran Diéguez">
    <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet"> -->
    <link href="//netdna.bootstrapcdn.com/bootswatch/2.1.0/united/bootstrap.min.css" rel="stylesheet"   >

    <link href="css/styles.css" rel="stylesheet"></style>
</head>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="100">
    <div class="navbar navbar-fixed-top navbar-inverse">
       <div class="navbar-inner">
         <div class="container">
           <a class="brand" href="#">Syngle</a>
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
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a href="#" class="btn" id="show-help"><i class="icon-info-sign"></i></a>
                        </div>
                        <div class="btn-group">
                            <a href="#" class="btn" rel="tooltip" data-original-title="Go to the previous word"><i class="icon-chevron-left"></i></a>
                            <a href="#" class="btn" rel="tooltip" data-original-title="Go to the next word"><i class="icon-chevron-right"></i></a>
                        </div>
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
                <ul>
                    <li></li>
                </ul>
            </div>

            <h4>Antonyms</h4>
            <div class="antonyms clearfix">
                <ul>
                    <li></li>
                </ul>
            </div>

            <h4>Related</h4>
            <div class="related clearfix">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="span6" id="word-provider">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#server" data-toggle="tab">Server</a></li>
                <li><a href="#suggestions" data-toggle="tab">Suggestions</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="server">
                    Loading...
                </div>
                <div class="tab-pane" id="suggestions">
                    <!-- MySQL levenshtein distance: http://www.jisaacks.com/find-similar-products-in-mysql-using-levenshtein-distance -->
                    Loading...
                </div>
            </div>


        </div>
      </div>
    </div>
    <footer class="container">
        <div class="pull-left">
            <strong>Syngle - &copy; 2012</strong> <br>
            A product by <a href="http://www.frandieguez.com">Fran Diéguez</a>
        </div>
        <div class="pull-right right">
            <ul>
                <li><a href="#">Help</a></li>
                <li><a href="#">Terms of service</a></li>
            </ul>
        </div>
    </footer>

    <script id="entry_hb" type="text/x-handlebars-template">
        <div class="input-append">
          <form action="#" id="search-form">
            <input class="span10" id="search-word" size="16" type="text" placeholder="Search for a word…" value="{{search}}">
            <button id="search-submit" class="btn" type="submit">Search !</button>
          </form>
        </div>
      <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
        {{#articles}}
        <li>
        <a class="list-item clearfix" href="#elem-{{title}}" data-id="{{title}}" data-title="{{title}}">
            <span class="title">{{title}}</span>
            <div class="btn-toolbar pull-right">
              <div class="btn-group">
                <span class="btn add-to-synonym btn-mini" rel="tooltip" data-original-title="Add as Synonym">S</span>
                <span class="btn add-to-antonym btn-mini" rel="tooltip" data-original-title="Add as Antonym">A</span>
                <span class="btn add-to-related btn-mini" rel="tooltip" data-original-title="Add as Related">R</span>
              </div>
            </div>
        </a>
        </li>
        {{/articles}}
      </ul>
      <ul class="pager">
        <li class="previous">
          <a href="#" data-page="{{prev_page}}" data-search-string="{{search}}">&larr; Older</a>
        </li>
        <li class="next">
          <a href="#" data-page="{{next_page}}" data-search-string="{{search}}">Newer &rarr;</a>
        </li>
      </ul>
    </script>

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


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
    <script src="//raw.github.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
    <!--
    <script src="http://documentcloud.github.com/underscore/underscore.js"></script>
    <script src="http://backbonejs.org/backbone.js"></script>
    -->
    <script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/old.js"></script>
</body>
</html>