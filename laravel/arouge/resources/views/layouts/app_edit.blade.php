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
	<link rel="stylesheet" href="/admin/static/css/iframe.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://polyfill.io/v3/polyfill.min.js?features=HTMLTemplateElement%2Cdefault"></script>
	<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
</head>

<body class="brand-arouge">
@if(preg_match("/^form_edit_.*/", Route::currentRouteName()))
	<svg class="x-hide">
		<symbol id="ico-up" viewBox="0 0 24 24"><path fill="currentColor" d="M15,20H9V12H4.16L12,4.16L19.84,12H15V20Z" /></symbol>
		<symbol id="ico-down" viewBox="0 0 24 24"><path fill="currentColor" d="M9,4H15V12H19.84L12,19.84L4.16,12H9V4Z" /></symbol>
	</svg>
@endif
	<div class="area-container">
		<div class="area-body">
			<div class="area-title">
				<h2>アルージェ取扱店編集</h2>
			</div>

			<div class="area-main">
@yield('content')

</body>

</html>
