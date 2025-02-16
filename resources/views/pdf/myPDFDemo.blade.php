<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>My PDF Kingchobo</title>
	<style>
		@font-face {
			font-family: 'NanumGothic';
			src: url("{{ storage_path('fonts/NanumGothic.ttf') }}");
		}

		body {
			font-family: 'NanumGothic', sans-serif;
		}
	</style>
</head>
<body>
	<h1>Title: {{ $title }}</h1>
	<hr>
	<h2>Date : {{ $date }}</h2>
	<hr>
	Hello.~~~~!!! 
	<hr>
	한글을 출력시켜보겠습니다.
</body>
</html>