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
<body class="body-with-tool-bar" data-offset="100">
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="#">Syngle</a>
            <div class="nav-collapse" id="main-menu">
                <ul class="nav" id="main-menu-left">
                    <li><a href="#">Your dictionaries</a></li>
                </ul>
                <ul class="nav nav-secondary pull-right">
                    <li>
                        <a href="#" id="show-help"><i class="icon-info-sign icon-white"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Fran Diéguez
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Your profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Sign out</a></li>
                      </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
       <div class="row-fluid">
            <div class="span2" id="sidebar">
                <div>
                    <!--Sidebar content-->
                    <div class="sidebar-header">
                        <label for="sidebar_filter_state">Filter</label>
                        <select name="state" id="sidebar_filter_state">
                            <option value="uncompleted">Uncompleted</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="word-list">
                        <div class="load_more">
                            <div class="loading">Loading</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" id="word-content">
                <!--Body content-->


                <div class="word-header clearfix">
                    <h4 class="muted">Original word:</h4>
                    <h2 class="span5">Entry</h2>
                    <div class="btn-toolbar pull-right right">
                        <div class="btn-group">
                            <a href="#" class="btn" rel="tooltip" data-original-title="Go to the previous word"><i class="icon-chevron-left"></i></a>
                            <a href="#" class="btn" rel="tooltip" data-original-title="Go to the next word"><i class="icon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row-fluid clearfix">
                    <div class="span6 receiver">
                        <h5>Synonyms</h5>
                        <div class="synonyms clearfix">
                            <ul>
                                <li></li>
                            </ul>
                        </div>

                        <h5>Antonyms</h5>
                        <div class="antonyms clearfix">
                            <ul>
                                <li></li>
                            </ul>
                        </div>

                        <h5>Related</h5>
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
                            <div class="tab-pane active" id="server">
                                <div class="loading">Loading...</div>
                            </div>
                            <div class="tab-pane" id="suggestions">
                                <!-- MySQL levenshtein distance: http://www.jisaacks.com/find-similar-products-in-mysql-using-levenshtein-distance -->
                                <div class="loading">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright  clearfix">
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
                </div>
            </div><!-- .word-content -->

        </div>
    </div>

    <div id="help">
        <div>
            <h2>Help about this page</h2>
            <div class="close">X</div>
            <div class="span4">
                <p>At this page you can stablish relationships between words to its
                root word.</p>
                <h6>There are some available relationships:</h6>
                <ul>
                    <li><strong>Synonym</strong></li>
                    <li><strong>Antonym</strong></li>
                    <li><strong>Related:</strong> for stablishing other kind of relationship</li>
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
                    <dd>Adds the active word to the antonyms list</dd>
                    <dt>s :</dt>
                    <dd>Adds the active word to the synonyms list</dd>
                    <dt>r :</dt>
                    <dd>Adds the active word to the related list</dd>

                    <br>

                    <dt>Shift + a :</dt>
                    <dd>Adds the active word to the antonyms list as a new concept</dd>
                    <dt>Shift + s :</dt>
                    <dd>Adds the active word to the synonyms list as a new concept</dd>
                    <dt>Shift + r :</dt>
                    <dd>Adds the active word to the related list in as a new concept</dd>
                </dl>
            </div>

            <div class="span4">
                <h6>Other shortcuts</h6>
                <dl>
                    <dt>h :</dt>
                    <dd>Shows this help dialog</dd>
                    <dt>/ :</dt>
                    <dd>Focus search input</dd>
                    <dt>f :</dt>
                    <dd>Focus first word in the listing</dd>
                </dl>
            </div>
        </div>
    </div>


    <script src="js/libraries/jquery.min.js"></script>
    <script src="js/libraries/bootstrap.min.js"></script>
    <script src="js/libraries/jquery.hotkeys.js"></script>
    <script src="js/libraries/jquery-ui.min.js"></script>
    <!--
    <script src="http://documentcloud.github.com/underscore/underscore.js"></script>
    <script src="http://backbonejs.org/backbone.js"></script>
    -->
    <script src="js/libraries/handlebars-1.0.rc.1.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/old.js"></script>
</body>
</html>