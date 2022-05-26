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
<script>
function goNext()
{
    document.getElementById('next_btn').disabled = true;
    document.form1.submit();
}
</script>
</head>

<body class="brand-arouge">
	<div class="area-container">
		<div class="area-body">
			<div class="area-title">
				<h2>アルージェキャンペーン新規追加</h2>
			</div>

			<div class="area-main">
				<div class="elem-preview">
					<iframe src="{{route('form_confirm_preview')}}" frameborder="0"></iframe>
				</div>

				<form name="form1" action="{{route('form_regist')}}" method="POST">
@csrf
		@foreach($data as $key => $value)
			@if($key == "q_title")
				@foreach($value as $key2 => $value2)
					<input type="hidden" name="q_title[{{$key2}}]" value="{{$value2}}">
				@endforeach
			@elseif($key == "type")
				@foreach($value as $key2 => $value2)
					<input type="hidden" name="type[{{$key2}}]" value="{{$value2}}">
				@endforeach
			@elseif($key == "choice")
				@foreach($value as $key2 => $value2)
					@foreach($value2 as $key3 => $value3)
					<input type="hidden" name="choice[{{$key2}}][{{$key3}}]" value="{{$value3}}">
					@endforeach
				@endforeach
			@elseif($key == "hoge")
			@else
				<input type="hidden" name="{{$key}}" value="{{$value}}">
			@endif
		@endforeach
					<div class="elem-form">
						<div class="submit">
							<button id="next_btn" onclick="javascript:goNext(); return false;">確定</button>
							<button type="button" class="btn-sub" id="btn-close">戻る</button>
						</div>
					</div>
				</form>
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
login
