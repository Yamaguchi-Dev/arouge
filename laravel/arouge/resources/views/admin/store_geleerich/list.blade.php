@extends('layouts.app_geleerich')

@section('content')
<script>
function goSearch()
{
    document.form1.action = "{{route('store_geleerich_list')}}";
    document.form1.submit();
}

function goCsv()
{
    document.form1.action = "{{route('store_geleerich_csv_download')}}";
    document.form1.submit();
}

function view_conf(view_status, id) {
    var next_view_status = "非公開";
    if (view_status == 2) {
        next_view_status = "公開";
    }
    var result = window.confirm(next_view_status+'に切り替えますか?');

    if (result) {
        window.location.href = "{{route('store_geleerich_view_change')}}/"+id;
    }
}
</script>
				<form name="form1" action="{{route('store_geleerich_list')}}" method="post">
@csrf
					<div class="elem-form">
						<dl>
							<dt>店名</dt>
							<dd><input type="text" name="name" value="{{$search->name}}"/></dd>
						</dl>
						<dl>
							<dt>郵便番号</dt>
							<dd><input type="text" name="zipcode" size="12" value="{{$search->zipcode}}"/></dd>
						</dl>
						<dl>
							<dt>都道府県</dt>
							<dd>
								<select name="pref_id">
									<option value="">都道府県名</option>
@foreach(config('common.pref') as $k => $v)
									<option value="{{$k}}" @if($search->pref_id == $k) selected @endif>{{$v}}</option>
@endforeach
								</select>
							</dd>
						</dl>
						<dl>
							<dt>市区郡町村以降</dt>
							<dd><textarea name="address">{{$search->address}}</textarea></dd>
						</dl>
						<dl>
							<dt>電話番号</dt>
							<dd><input type="tel" size="12" name="tel" value="{{$search->tel}}"/></dd>
						</dl>
						<dl>
							<dt>お取り扱い状況</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="checkbox" name="bland[]" value="1" @if(!empty($search->bland) && in_array(1, $search->bland)) checked @endif/><span class="label">リュール</span></label></li>
									<li><label><input type="checkbox" name="bland[]" value="2" @if(!empty($search->bland) && in_array(2, $search->bland)) checked @endif/><span class="label">ジュレリッチ</span></label></li>
									<li><label><input type="checkbox" name="bland[]" value="3" @if(!empty($search->bland) && in_array(3, $search->bland)) checked @endif/><span class="label">エタン</span></label></li>
								</ul>
							</dd>
						</dl>
						<div class="submit">
							<button type="submit" onclick="javascript:goSearch();">検索する</button>
							<button type="submit" id="csv" class="btn-sub" onclick="javascript:goCsv();">CSV出力</button>
						</div>
					</div>
				</form>

				<div class="elem-list-result">
					<table>
						<caption>{{$data->total()}}件中 /  {{($data->currentPage() - 1) * $data->perPage() + 1}}～{{(($data->currentPage() - 1) * $data->perPage() + 1) + (count($data) - 1)}}件</caption>
						<thead>
							<tr>
								<th rowspan="2">公開</th>
								<th rowspan="2">店名</th>
								<th rowspan="2">郵便番号</th>
								<th rowspan="2">住所</th>
								<th rowspan="2">電話番号</th>
								<th colspan="3">お取り扱い状況</th>
								<th rowspan="2">編集</th>
							</tr>
							<tr>
								<th>リュール</th>
								<th>ジュレリッチ</th>
								<th>エタン</th>
							</tr>
						</thead>
						<tbody>
@foreach($data as $k => $v)
							<tr>
								<td>@if($v->view_status == 1)<a href="javascript:view_conf({{$v->view_status}}, {{$v->id}});">公開</a>@else<a href="javascript:view_conf({{$v->view_status}}, {{$v->id}});" class="x-alert">非公開</a>@endif</td>
								<td class="x-left">{{$v->name}}</td>
								<td>{{$v->zipcode}}</td>
								<td class="x-left">{{config('common.pref')[$v->pref_id]}}　{{$v->address}}</td>
								<td><a href="tel:{{$v->tel}}">{{$v->tel}}</a></td>
								<td>@if($v->bland_lueur == 1)〇@else - @endif</td>
								<td>@if($v->bland_geleerich == 1)〇@else - @endif</td>
								<td>@if($v->bland_etin == 1)〇@else - @endif</td>
								<td><button type="button" data-id="{{$v->id}}">編集</button></td>
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
			Array.from(d.querySelectorAll('.elem-list-result button[data-id]')).forEach(function (el) {
				el.addEventListener('click', function () {
					var iframe = d.createElement('iframe')
					iframe.classList.add('area-overlay')
					iframe.src = '{{route('store_geleerich_edit')}}/' + this.dataset.id
					d.body.append(iframe)
				})
			})
		})(document, window)
	</script>
	<script>
		window.onload = function() {
@if (session('status'))
			alert("{{session('status')}}に切り替えました");
@endif
		}
	</script>
@endsection
