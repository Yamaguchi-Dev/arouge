@extends('layouts.app_edit')

@section('content')
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
@endsection
