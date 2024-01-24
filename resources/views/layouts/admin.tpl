<!DOCTYPE html>
<html lang="{App::getLocale()}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{$csrf_token}">
    <script src="/js/app.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<title>{block name=title}default{/block}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="container text-center">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                Lottery!
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{route('tickets.index')}">Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{route('winners.index')}">Winners</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link" id="run-lottery">Run Lottery Now!</button>
                </li>
            </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    {if $guest eq 'guest'}
                        <li class="nav-item">
                            <a class="nav-link" href="{route('login')}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{route('register')}">Register</a>
                        </li>
                    {else}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {$user.name} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{route('logout')}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{route('logout')}" method="POST" style="display: none;">
                                    {$csrf_field}
                                </form>
                            </div>
                        </li>
                    {/if}
                </ul>
            </div>
        </div>
    </nav>    
    <div class="py-3">        
	    {block name=contents}{/block}
    </div>
</div>
{block name=scripts}
    <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#run-lottery').click(function() {
                $('#spinner').addClass('rotate-center');
                $.ajax({
                    url: '{route('admin.getwinners')}', // Replace with your server endpoint
                    type: 'POST',
                    contentType: 'application/json',
                    success: function(response) {
                        window.location = "{route('winners.index')}";
                        console.log('Response:', JSON.parse(response));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                 });
            });
        });
    </script>
{/block}
</body>
</html>