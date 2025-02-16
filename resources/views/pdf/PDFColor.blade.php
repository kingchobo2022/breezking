<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
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
	<p>제목 : {{ $title }}</p>	
	<p>날짜 : {{ $date }}</p>

	<table border="1">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Created At</th>				
		</tr>
		@foreach ($colors as $color)
		<tr>
			<td>{{ $color->id }}</td>
			<td>{{ $color->name }}</td>
			<td>{{ $color->created_at }}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>