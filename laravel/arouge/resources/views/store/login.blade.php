<html>
<head>
</head>
<body>
@if (session('status'))
		{{ session('status') }}
@endif

login
<form action="{{route('store_login_auth')}}" method="post">
@csrf
<br>
ID<input type="text" name="id">
<br>
password<input type="password" name="password">
<br>
<button type="submit">ログイン</button>
</form>

</body>
</html>
