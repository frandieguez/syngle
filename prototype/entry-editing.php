<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Syngle - Aplicativo Web application para a creación de thesaurus de sinónimos para Hunspell</title>
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
                <li><a href="#">Sinónimo</a></li>
            </ul>
        </div>
         </div>
       </div>
    </div>

    <div class="container" style="margin-top:80px;">
        <header class="jumbotron subhead" id="overview">
            <div class="row">
                <div class="">
                  <h1 class="span6">Entrada</h1>
                  <div class="pull-right right">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a href="#" class="btn" id="show-help"><i class="icon-info-sign"></i></a>
                        </div>
                        <div class="btn-group">
                            <a href="#" class="btn" rel="tooltip" data-original-title="Ir á palabra anterior"><i class="icon-chevron-left"></i></a>
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
        <div class="span6 receiver">
            <h4>Sinónimas</h4>
            <div class="synonyms clearfix">
                <ul>
                    <li></li>
                </ul>
            </div>

            <h4>Antónimas</h4>
            <div class="antonyms clearfix">
                <ul>
                    <li></li>
                </ul>
            </div>

            <h4>Relacionadas</h4>
            <div class="related clearfix">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="span6" id="word-provider">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#server" data-toggle="tab">Servidor</a></li>
                <li><a href="#suggestions" data-toggle="tab">Suxestións</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="server">
                    Cargando...
                </div>
                <div class="tab-pane" id="suggestions">
                    <!-- MySQL levenshtein distance: http://www.jisaacks.com/find-similar-products-in-mysql-using-levenshtein-distance -->
                    Cargando...
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
        <div class="input-append">
          <form action="#" id="search-form">
            <input class="span10" id="search-word" size="16" type="text" placeholder="Buscar unha palabra…" value="{{search}}">
            <button id="search-submit" class="btn" type="submit">Buscar !</button>
          </form>
        </div>
      <ul class="nav nav-list bs-docs-sidenav" data-cursor-selectable>
        {{#articles}}
        <li>
        <a class="list-item clearfix" href="#elem-{{title}}" data-id="{{title}}" data-title="Element {{title}}">
            <span class="title">{{title}}</span>
            <div class="btn-toolbar pull-right">
              <div class="btn-group">
                <span class="btn add-to-synonym btn-mini" rel="tooltip" data-original-title="Engdir como sinónima">S</span>
                <span class="btn add-to-antonym btn-mini" rel="tooltip" data-original-title="Engadir como antónima">A</span>
                <span class="btn add-to-related btn-mini" rel="tooltip" data-original-title="Engadir como relacionada">R</span>
              </div>
            </div>
        </a>
        </li>
        {{/articles}}
      </ul>
      <ul class="pager">
        <li class="previous">
          <a href="#" data-page="{{prev_page}}" data-search-string="{{search}}">&larr; Anterior</a>
        </li>
        <li class="next">
          <a href="#" data-page="{{next_page}}" data-search-string="{{search}}">Seguinte &rarr;</a>
        </li>
      </ul>
    </script>

    <div id="help">
        <div>
            <h2>Axuda sobre esta páxina</h2>
            <div class="close">X</div>
            <div class="span4">
                <p>Nesta páxina pode estabelecer a relación entre as palabras e a palabra raíz.</p>
                <h6>Tipos de relacións dispoñíbeis:</h6>
                <ul>
                    <li>Sinonimia</li>
                    <li>Antonimia</li>
                    <li>Relación: para estabelecer outra clase de relacións</li>
                </ul>
                <h6>Obter as palabras</h6>
                <p>Pode obter elementos para relacionar de dúas fontes:</p>
                <ul>
                    <li>Buscando unha palabra usando o formulario de «Buscar»</li>
                    <li>Ir á lapela «Suxestións» para obter palabras suxeridas automaticamente (conforme
                    semellanzas na palabra).</li>
                </ul>

                <p>Premer sobre calquera elemento da lista para marcalo como activo e usar e usar o botón grupo
                    para realizar unha acción.</p>
            </div>
            <div class="span4">
                <h5>Atallos de teclado</h5>
                <p>Para un uso moi rápido desta páxina, pode asignar palabras usando o seu teclado.</p>
                <dl>
                    <dt>a :</dt>
                    <dd>Engade a tradución activa á lista de antónimos</dd>
                    <dt>s :</dt>
                    <dd>Engade a tradución activa á lista de sinónimos</dd>
                    <dt>r :</dt>
                    <dd>Engade a tradución activa á lista de relacionadas</dd>


                    <dt>Shift + a :</dt>
                    <dd>Engade a tradución activa á lista de antónimos como novo concepto</dd>
                    <dt>Shift + s :</dt>
                    <dd>Engade a tradución activa á lista de sinónimos como novo concepto</dd>
                    <dt>Shift + r :</dt>
                    <dd>Engade a tradución activa á lista de relacionadas como novo concepto</dd>
                </dl>
            </div>

            <div class="span4">
                <h6>Outros atallos</h6>
                <dl>
                    <dt>h :</dt>
                    <dd>Amosa este diálogo de axuda</dd>
                    <dt>/ :</dt>
                    <dd>Destaca a entrada para a busca</dd>
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
