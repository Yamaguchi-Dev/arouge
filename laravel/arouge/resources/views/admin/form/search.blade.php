@extends('layouts.app')

@section('content')
				<form action="{{route('form_search_post')}}" method="post">
@csrf
					<div class="elem-form">
						<dl>
							<dt>管理番号</dt>
							<dd><input type="text" size="12" name="id" value="{{$search->id}}"/></dd>
						</dl>
						<dl>
							<dt>公開</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="radio" name="view_status" value="1" @if($search->view_status == 1) checked @endif /><span class="label">公開中</span></label></li>
									<li><label><input type="radio" name="view_status" value="2" @if($search->view_status == 2) checked @endif /><span class="label">非公開中</span></label></li>
								</ul>
							</dd>
						</dl>
						<dl>
							<dt>管理用タイトル</dt>
							<dd>
								<select name="admin_title">
									<option value=""></option>
@foreach($form_data as $k => $v)
									<option value="{{$v['admin_title']}}" @if($search->admin_title == $v['admin_title']) selected @endif>{{$v['admin_title']}}</option>
@endforeach
								</select>
							</dd>
						</dl>
						<dl>
							<dt>検索期間</dt>
							<dd>
								<ul class="horizontal">
									<li><input type="text" size="12" name="search_start" data-type="date" value="{{$search->search_start}}"/></li>
									<li>～</li>
									<li><input type="text" size="12" name="search_end" data-type="date" value="{{$search->search_end}}"/></li>
								</ul>
							</dd>
						</dl>
						<div class="submit">
							<button type="submit">検索する</button>
						</div>
					</div>
				</form>

				<div class="elem-list-page">
					<p>{{$data->count()}}件中 /  {{($data->currentPage() - 1) * $data->perPage() + 1}}～{{(($data->currentPage() - 1) * $data->perPage() + 1) + (count($data) - 1)}}件</p>
				</div>

@foreach($data as $k => $v)
				<div class="elem-form">
					<dl>
						<dt>管理番号</dt>
						<dd><p class="confirm">{{$v->id}}</p></dd>
					</dl>
					<dl>
						<dt>公開</dt>
						<dd><p class="confirm">{{$v->view_status == 2 ? "非公開" : "公開"}}</p></dd>
					</dl>
					<dl>
						<dt>公開日時</dt>
						<dd><p class="confirm">{{date("Y年m月d日 H:i", strtotime($v->open_start))}} ～ {{date("Y年m月d日 H:i", strtotime($v->open_end))}}</p></dd>
					</dl>
					<dl>
						<dt>管理用タイトル</dt>
						<dd><p class="confirm">{{$v->admin_title}}</p></dd>
					</dl>
@if(count($v->answer_user) > 0)
					<dl>
						<dt></dt>
						<dd>
							<ul class="horizontal">
								<li><a href="{{route('form_detail')}}/{{$v->id}}" class="button">応募者情報確認</a></li>
								<li><a href="" class="button">CSV出力</a></li>
							</ul>
						</dd>
					</dl>
@endif
				</div>
@endforeach

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
