<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
        <x-meta title="SIR Diagnóstico" description="Há mais de 25 anos realizando diagnóstico por imagem com qualidade e segurança" keywords="exame por imagem, diagnóstico, ressonância magnética, raio-x, tomografia computadorizada, densitometria óssea, ultra-sonografia" image=""/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
	</head>
	<body class='@if(Route::currentRouteName() == "principal") landing @endif is-preload'>
		<div id="page-wrapper">

            <x-header/>

            @yield('content')

            <x-footer/>

        </div>

        @stack('scripts')

	</body>
</html>
