@extends('layouts.app')

@section('content')
				<div class="elem-form">
					<dl>
						<dt>管理番号</dt>
						<dd><p class="confirm">{{$form_data->id}}</p></dd>
					</dl>
					<dl>
						<dt>公開</dt>
						<dd><p class="confirm">{{$form_data->view_status == 2 ? "非公開" : "公開"}}</p></dd>
					</dl>
					<dl>
						<dt>公開日時</dt>
						<dd><p class="confirm">{{date("Y年m月d日 H:i", strtotime($form_data->open_start))}} ～ {{date("Y年m月d日 H:i", strtotime($form_data->open_end))}}</p></dd>
					</dl>
					<dl>
						<dt>管理用タイトル</dt>
						<dd><p class="confirm">{{$form_data->admin_title}}</p></dd>
					</dl>
					<dl>
						<dt>CSV出力</dt>
						<dd>
							<form action="{{route('form_csv_download')}}" method="post">
@csrf
							<input type="hidden" name="id" value="{{$form_data->id}}">
							<ul class="horizontal">
								<li><input type="text" size="12" name="csv_start" data-type="date" value=""/></li>
								<li>～</li>
								<li><input type="text" size="12" name="csv_end" data-type="date" value=""/></li>
								<li>
						<div class="submit">
							<button type="submit">CSV出力</button>
						</div>
</li>
							</ul>
							</form>
						</dd>
					</dl>
				</div>

				<div class="elem-list-page">
					<p>{{$data->total()}}件中 /  {{($data->currentPage() - 1) * $data->perPage() + 1}}～{{(($data->currentPage() - 1) * $data->perPage() + 1) + (count($data) - 1)}}件</p>
				</div>

				<div class="elem-list-table">
					<table>
						<thead>
							<tr>
								<th>応募日時</th>
								<th>番号</th>
								<th>お名前</th>
								<th>フリガナ</th>
								<th>郵便番号</th>
								<th>住所</th>
								<th>電話番号</th>
								<th>性別</th>
								<th>生年月日</th>
@foreach($form_data->question as $k => $v)
								<th>Q{{$v->no}}</th>
@endforeach
							</tr>
						</thead>
						<tbody>
@foreach($user_data as $k => $v)
							<tr>
								<td>{{date("Y.m.d H:i", strtotime($v["created"]))}}</td>
								<td>{{$v["id"]}}</td>
								<td>{{$v["name"]}}</td>
								<td>{{$v["kana"]}}</td>
								<td>{{$v["zipcode"]}}</td>
								<td>{{$v["address"]}}</td>
								<td>{{$v["tel"]}}</td>
								<td>{{$v["gender"]}}</td>
								<td>{{date("Y年m月d日", strtotime($v["birthday"]))}}</td>
@foreach($form_data->question as $k2 => $v2)
@if(empty($v['answer_choice'][$v2->no]))
								<td></td>
@else
								<td>{{implode(", ", $v['answer_choice'][$v2->no])}}</td>
@endif
@endforeach
							</tr>
@endforeach
						</tbody>
					</table>
				</div>

				<div class="elem-list-page">
{{$data->links('vendor.pagination.bootstrap-4')}}
				</div>
			</div>
		</div>
	</div>
	<script>
		(function (d, w) {
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
			Array.from(d.querySelectorAll('a[target="iframe"]')).forEach(function (el) {
				el.addEventListener('click', function (e) {
					e.preventDefault()
					var iframe = d.createElement('iframe')
					iframe.classList.add('area-overlay')
					iframe.src = el.pathname
					d.body.append(iframe)
				})
			})
			Array.from(d.querySelectorAll('input[data-type="date"]')).forEach(function (el) {
				flatpickr(el, {
					locale: 'ja'
				})
			})
		})(document, window)
	</script>
@endsection
