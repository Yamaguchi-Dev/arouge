@extends('layouts.app_login')

@section('content')
	<div class="area-login">
		<div class="area-wrap">
			<div class="login">
				<h1>アルージェ<br>サンプル応募管理</h1>
@if (session('status'))
		{{ session('status') }}
@endif
				<form action="{{route('form_login_auth')}}" method="post">
@csrf
					<dl>
						<dt>ログインID</dt>
						<dd><input type="text" placeholder="ID" name="id" /></dd>
					</dl>
					<dl>
						<dt>パスワード</dt>
						<dd><input type="password" placeholder="Password" name="password" /></dd>
					</dl>
					<div class="submit"><button>ログイン</button></div>
				</form>
			</div>
		</div>
	</div>
@endsection
