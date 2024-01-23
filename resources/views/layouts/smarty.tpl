<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{block name=title}default{/block}</title>
	{{HTML::style("/packages/bootstrap/css/bootstrap.min.css")}}
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="container">
	{block name=contents}{/block}
</div>
{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js")}}
{{HTML::script("/packages/bootstrap/js/bootstrap.min.js")}}
{block name=scripts}{/block}
</body>
</html>