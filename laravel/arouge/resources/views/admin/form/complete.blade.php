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
	<div class="area-container">
		<div class="area-body">
			<div class="area-title">
				<h2>アルージェキャンペーン新規追加</h2>
			</div>

			<div class="area-main">
				<div class="elem-finish">
					<p><strong>編集が完了しました。</strong></p>
					<p><button type="button" id="btn-close">閉じる</button></p>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function (d, w) {
			d.querySelector('#btn-close').addEventListener('click', function () {
				w.parent.postMessage({ action: 'reload' }, location.origin)
			})
		})(document, window)
	</script>
</body>

</html>
