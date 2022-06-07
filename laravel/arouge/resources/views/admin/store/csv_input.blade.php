@extends('layouts.app')

@section('content')
				<form action="{{route('store_csv_upload')}}" target="iframe" id="form" method="post" enctype="multipart/form-data">
@csrf
					<div class="elem-form">
@if (count($errors) > 0)
						<div class="alert">
							<ul>
@foreach ($errors as $v)
								<li>{{ $v }}</li>
@endforeach
							</ul>
						</div>
@endif
@if (session('status'))
						<div>
							<ul>
								<li>{{ session('status') }}</li>
							</ul>
						</div>
@endif
						<dl>
							<dt><label><input type="file" name="file_csv" id="input-file"/><span class="label">CSVファイル選択</span></label></dt>
							<dd><input type="text" readonly value="ファイル未選択" id="label-file"/></dd>
@if(!empty($update_date))
							<dd style="text-align:center;">最終アップロード<br>{{$update_date}}</dd>
@endif
						</dl>
						<div class="submit">
							<button type="submit">CSVアップロード</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		(function (d, w) {
			d.querySelector('#input-file').addEventListener('change', function (e) {
				var name = 'ファイル未選択'
				if (this.files && this.files[0]) {
					name = this.files[0].name
				}
				d.querySelector('#label-file').value = name
				console.log(this.files)
			})
			w.addEventListener('message', function (e) {
				if (e.origin == location.origin) {
					switch (e.data.action) {
						case 'reload':
							location.reload(true)
							break;
						case 'close':
							e.currentTarget[0].frameElement.remove()
							break;
					
						default:
							break;
					}
				}
			})
			d.querySelector('#form').addEventListener('submit', function (e) {
				var iframe = d.createElement('iframe')
				iframe.classList.add('area-overlay')
				iframe.name = 'iframe'
				d.body.append(iframe)
			})
		})(document, window)
	</script>

@endsection
