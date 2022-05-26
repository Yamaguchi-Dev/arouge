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

<body class="brand-geleerich">
	<div class="area-container">
		<div class="area-header">
			<div class="logo"><a><img src="https://www.geleerich.jp/common/images/common/logo_gelee.png" alt=""></a></div>
			<div class="title">
				<h1>取扱店管理</h1>
			</div>
			<div class="brand">
				<ul>
					<li><a href="{{route('store_list')}}">アルージェ</a></li>
					<li><a>ジュレリッチ</a></li>
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
						<li>@if(Route::currentRouteName() == "store_geleerich_list")<a>@else<a href="{{route('store_geleerich_list')}}">@endif取扱店一覧</a></li>
<!--
						<li><a href="./add.html">取扱店新規追加</a></li>
-->
						<li>@if(Route::currentRouteName() == "store_geleerich_csv_input")<a>@else<a href="{{route('store_geleerich_csv_input')}}">@endif取扱店CSVアップロード</a></li>
<!--
						<li><a href="./remove.html">取扱店削除</a></li>
-->
					</ul>
				</div>
			</div>

			<div class="area-main">
@yield('content')

</body>

</html>
