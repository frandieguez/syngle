<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Syngle - Aplicativo Web para a creación de thesaurus de sinónimos en formato Hunspell</title>
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
                <li><a href="#">Sinónimos</a></li>
            </ul>
        </div>
         </div>
       </div>
    </div>

    <div class="container" style="margin-top:80px;">
        <header class="jumbotron subhead" id="overview">
            <div class="row">
                <div class="">
                  <h1 class="span6">Área de traballo</h1>
                  <div class="pull-right right">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a href="#" class="btn" id="show-help"><i class="icon-info-sign"></i></a>
                        </div>
                        <div class="btn-group">
                            <a href="#" class="btn" rel="tooltip" data-original-title="Ir á palabra previa"><i class="icon-chevron-left"></i></a>
                            <a href="#" class="btn" rel="tooltip" data-original-title="Ir á palabra seguinte"><i class="icon-chevron-right"></i></a>
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
        <div>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#server" data-toggle="tab">Servidor</a></li>
                <li><a href="#search-form" data-toggle="tab" >Buscar</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="server">
                    <ul class="nav nav-list bs-docs-sidebar" data-cursor-selectable></ul>
                </div>
                <div class="tab-pane" id="search-form">
                    <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
                      <li>Cargando</li>
                    </ul>
                    <ul class="pager">
                      <li class="previous">
                        <a href="#">&larr; Anterior</a>
                      </li>
                      <li class="next">
                        <a href="#">Seguinte &rarr;</a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div>
    <footer class="container">
        <div class="pull-left">
            <strong>Syngle - &copy; 2012</strong> <br>
            Un produto de <a href="http://www.frandieguez.com">Fran Diéguez</a>
        </div>
        <div class="pull-right right">
            <ul>
                <li><a href="#">Axuda</a></li>
                <li><a href="#">Termos e condicións</a></li>
            </ul>
        </div>
    </footer>

    <script id="entry_hb" type="text/x-handlebars-template">
      <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
        {{#articles}}
        <li>
        <a class="list-item clearfix" href="#elem-{{title}}" data-id="{{title}}" data-title="Element {{title}}">
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
          <a href="#" data-page="{{prev_page}}">&larr; Anterior</a>
        </li>
        <li class="next">
          <a href="#" data-page="{{next_page}}">Seguinte &rarr;</a>
        </li>
      </ul>
    </script>




    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
    <script src="//raw.github.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
    <script src="http://documentcloud.github.com/underscore/underscore.js"></script>
    <script src="http://backbonejs.org/backbone.js"></script>
    <script src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.js"></script>
    <script>
    (function ($) {

      $.ajax({
        url: 'ws.php',
        dataType: 'json',
        success: function(data) {
          console.log(data)
          var source = $("#entry_hb").html();
          var template = Handlebars.compile(source);

          var vars = {
            'next_page' : data.next_page,
            'prev_page' : data.prev_page,
            'articles'  : data.words
          }
          var content = template(vars);
          $('#server').html(content);
        }
      });
  })(jQuery);</script>
</body>
</html>
