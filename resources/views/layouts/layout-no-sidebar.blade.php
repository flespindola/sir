<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
        <x-meta title="SIR Diagnóstico" description="" image=""/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">

            <x-header/>

            @yield('content')

            <x-footer/>

        </div>

        @stack('scripts')

	</body>
</html>
