<!doctype html>
<html lang="fr">
{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/monStyle.css') !!}
<head>

</head>
<body class="body">
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar+ bvn"></span>
                </button>
                <a class="navbar-brand" href="{{url('')}}">Laboratoire médicament</a>
            </div>
            @if (Session::get('id') == 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/formLogin') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                    </ul>
                </div>
            @endif
            @if (Session::get('id') > 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('medicament/Lister') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Gestion Médicaments</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/getLogout') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                    </ul>
                </div>
            @endif
        </div><!--/.container-fluid -->
    </nav>
</div>
<div class="container">
    @yield('content')
</div>
{!! Html::script('assets/js/boostrap.min.js') !!}
{!! Html::script('assets/js/jquery-3.3.1.min.js') !!}
{!! Html::script('assets/js/ui-bootsrap-tpls.js') !!}
{!! Html::script('assets/js/boostrap.js') !!}
{!! Html::script('assets/js/AjaxConnexion.js') !!}

</body>
</html>
