<!DOCTYPE HTML>
<html lang="ja-JP">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,user-scalable=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="description" content="" />
	<title></title>
	<link rel="stylesheet" href="/admin/static/css/default.css" />
	<link rel="stylesheet" href="/admin/static/css/style.css" />
	<script src="https://polyfill.io/v3/polyfill.min.js"></script>
</head>

<body class="brand-arouge">
	<div class="area-container">
		<div class="area-header">
			<div class="logo"><a><img src="https://www.arouge.com/shared/images/logo.png" alt=""></a></div>
			<div class="title">
				<h1>取扱店管理</h1>
			</div>
			<div class="brand">
				<ul>
					<li><a>アルージェ</a></li>
					<li><a href="">ジュレリッチ</a></li>
				</ul>
			</div>
		</div>

		<div class="area-body">
			<div class="area-title">
				<h2>アルージェ取扱店一覧</h2>
			</div>

			<div class="area-side">
				<div class="navi">
					<ul>
						<li>@if(Route::currentRouteName() == "store_list")<a>@else<a href="{{ route('store_list') }}">@endif取扱店一覧</a></li>
						<li>@if(Route::currentRouteName() == "store_input")<a>@else<a href="{{ route('store_input') }}">@endif取扱店新規追加</a></li>
						<li>@if(Route::currentRouteName() == "store_csv_input")<a>@else<a href="{{ route('store_csv_input') }}">@endif取扱店CSVアップロード</a></li>
						<li>@if(Route::currentRouteName() == "store_delete")<a>@else<a href="{{ route('store_delete') }}">@endif取扱店削除</a></li>
					</ul>
				</div>
			</div>

			<div class="area-main">
@yield('content')

</body>

</html>
