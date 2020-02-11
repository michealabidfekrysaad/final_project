<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ToFind</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/style.css" />

</head>

<body style="padding: 0px; margin: 0px;">

	<div id="notfound">
		<div class="notfound-bg"></div>
		<div class="notfound">
			<div class="notfound-404">
				<h1>{{$message}}</h1>
			</div>
			<h2>{{$code}}</h2>
			<a href="/" class="home-btn">{{ __('messages.Go Home') }}</a>
			<a href="/contact" class="contact-btn">{{ __('messages.Contact us') }}</a>

		</div>
	</div>

</body>

</html>
