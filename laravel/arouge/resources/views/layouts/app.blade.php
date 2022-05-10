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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://polyfill.io/v3/polyfill.min.js?features=HTMLTemplateElement%2Cdefault"></script>
	<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
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
@if(preg_match("/^store_.*/", Route::currentRouteName()))
					<li><a href="">ジュレリッチ</a></li>
@endif
				</ul>
			</div>
		</div>

		<div class="area-body">
			<div class="area-title">
				<h2>{{$title}}</h2>
			</div>

			<div class="area-side">
				<div class="navi">
					<ul>
@if(preg_match("/^store_.*/", Route::currentRouteName()))
						<li>@if(Route::currentRouteName() == "store_list")<a>@else<a href="{{ route('store_list') }}">@endif取扱店一覧</a></li>
						<li>@if(Route::currentRouteName() == "store_input")<a>@else<a href="{{ route('store_input') }}">@endif取扱店新規追加</a></li>
						<li>@if(Route::currentRouteName() == "store_csv_input")<a>@else<a href="{{ route('store_csv_input') }}">@endif取扱店CSVアップロード</a></li>
						<li>@if(Route::currentRouteName() == "store_delete")<a>@else<a href="{{ route('store_delete') }}">@endif取扱店削除</a></li>
@else
						<li>@if(Route::currentRouteName() == "form_list")<a>@else<a href="{{ route('form_list') }}">@endifキャンペーン一覧</a></li>
						<li>@if(Route::currentRouteName() == "form_input")<a>@else<a href="{{ route('form_input') }}">@endifキャンペーン新規追加</a></li>
						<li>@if(Route::currentRouteName() == "form_search")<a>@else<a href="{{ route('form_search') }}">@endif応募者情報一覧</a></li>
@endif
					</ul>
				</div>
			</div>

			<div class="area-main">
@yield('content')

</body>

</html>
