@extends('layouts.app')

@section('content')
				<form action="{{route('form_confirm')}}" target="iframe" method="post" id="form">
@csrf
					<div class="elem-form">
@if (count($errors) > 0)
						<div class="alert">
							<ul>
@foreach ($errors->all() as $v)
								<li>{{$v}}</li>
@endforeach
							</ul>
						</div>
@endif
						<dl>
							<dt>管理番号</dt>
							<dd><p class="confirm">{{$no}}</p></dd>
						</dl>
						<dl>
							<dt>公開</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="radio" name="view_status" value="1"@if(isset($data['view_status']) && $data['view_status'] == 1) checked @elseif(old('view_status') == 1) checked @endif/><span class="label">公開</span></label></li>
									<li><label><input type="radio" name="view_status" value="2"@if(isset($data['view_status']) && $data['view_status'] == 2) checked @elseif(old('view_status') == 2) checked @endif/><span class="label">非公開</span></label></li>
								</ul>
							</dd>
						</dl>
						<dl>
							<dt>公開開始日時</dt>
							<dd><input type="text" size="12" data-type="datetime" name="open_start" value="@if(isset($data['open_start'])){{$data['open_start']}}@else{{old('open_start')}}@endif" /></dd>
						</dl>
						<dl>
							<dt>公開終了日時</dt>
							<dd><input type="text" size="12" data-type="datetime" name="open_end" value="@if(isset($data['open_end'])){{$data['open_end']}}@else{{old('open_end')}}@endif"/></dd>
						</dl>
						<dl>
							<dt>管理用タイトル</dt>
							<dd><input type="text" name="admin_title" value="@if(isset($data['admin_title'])){{$data['admin_title']}}@else{{old('admin_title')}}@endif" /></dd>
						</dl>
						<dl>
							<dt>掲載タイトル</dt>
							<dd><textarea name="title">@if(isset($data['title'])){{$data['title']}}@else{{old('title')}}@endif</textarea></dd>
						</dl>
						<dl>
							<dt>内容</dt>
							<dd><textarea name="contents">@if(isset($data['contents'])){{$data['contents']}}@else{{old('contents')}}@endif</textarea></dd>
						</dl>
						<dl>
							<dt>応募期間</dt>
							<dd>
								<ul class="horizontal">
									<li><input type="text" size="12" data-type="date" name="apply_start" value="@if(isset($data['apply_start'])){{$data['apply_start']}}@else{{old('apply_start')}}@endif"/></li>
									<li>～</li>
									<li><input type="text" size="12" data-type="date" name="apply_end" value="@if(isset($data['apply_end'])){{$data['apply_end']}}@else{{old('apply_end')}}@endif"/></li>
								</ul>
							</dd>
						</dl>

						<div class="questions">
							<template class="x-hide" id="tpl-option">
								<dl>
									<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
									<dd><input type="text" name="hoge[0][]"/></dd>
								</dl>
							</template>
							<template class="x-hide" id="tpl-question">
								<li class="question">
									<div class="controls">
										<button type="button" data-type="remove-question" class="btn-remove">設問<br>削除</button>
										<button type="button" data-type="move-up" class="btn-svg"><svg class="up"><use href="#ico-up"></use></svg></button>
										<button type="button" data-type="move-down" class="btn-svg"><svg class="down"><use href="#ico-down"></use></svg></button>
									</div>
									<div class="form">
										<dl>
											<dt>設問<span class="q"></span></dt>
											<dd><input type="text" name="q_title[0]"/></dd>
										</dl>
										<dl>
											<dt>選択肢</dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt></dt>
											<dd><button type="button" data-type="add-option">選択肢追加</button></dd>
										</dl>
										<dl>
											<dt>選択方法</dt>
											<dd>
												<ul class="horizontal">
													<li><label><input type="radio" name="type[0]" value="1"/><span class="label">単一選択</span></label></li>
													<li><label><input type="radio" name="type[0]" value="2"/><span class="label">複数選択</span></label></li>
												</ul>
											</dd>
										</dl>
									</div>
								</li>
							</template>
							<ul>
@if(isset($data['q_title']) && count($data['q_title']) > 0)
    @foreach($data['q_title'] as $k => $v)
								<li class="question">
									<div class="controls">
										<button type="button" data-type="remove-question" class="btn-remove">設問<br>削除</button>
										<button type="button" data-type="move-up" class="btn-svg"><svg class="up"><use href="#ico-up"></use></svg></button>
										<button type="button" data-type="move-down" class="btn-svg"><svg class="down"><use href="#ico-down"></use></svg></button>
									</div>
									<div class="form">
										<dl>
											<dt>設問<span class="q"></span></dt>
											<dd><input type="text" name="q_title[{{$k}}]" value="{{$v}}"/></dd>
										</dl>
        @foreach($data['choice'][$k] as $k2 => $v2)
            @if($k2 < 1)
										<dl>
											<dt>選択肢</dt>
											<dd><input type="text" name="choice[{{$k}}][]" value="{{$v2}}"/></dd>
										</dl>
            @else
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[{{$k}}][]" value="{{$v2}}"/></dd>
										</dl>
            @endif
        @endforeach
										<dl>
											<dt></dt>
											<dd><button type="button" data-type="add-option">選択肢追加</button></dd>
										</dl>
										<dl>
											<dt>選択方法</dt>
											<dd>
												<ul class="horizontal">
													<li><label><input type="radio" name="type[{{$k}}]" value="1" @if(isset($data['type'][$k]) && ($data['type'][$k] == 1)) checked @endif/><span class="label">単一選択</span></label></li>
													<li><label><input type="radio" name="type[{{$k}}]" value="2" @if(isset($data['type'][$k]) && ($data['type'][$k] == 2)) checked @endif/><span class="label">複数選択</span></label></li>
												</ul>
											</dd>
										</dl>
									</div>
								</li>
    @endforeach
@else
								<li class="question">
									<div class="controls">
										<button type="button" data-type="remove-question" class="btn-remove">設問<br>削除</button>
										<button type="button" data-type="move-up" class="btn-svg"><svg class="up"><use href="#ico-up"></use></svg></button>
										<button type="button" data-type="move-down" class="btn-svg"><svg class="down"><use href="#ico-down"></use></svg></button>
									</div>
									<div class="form">
										<dl>
											<dt>設問<span class="q"></span></dt>
											<dd><input type="text" name="q_title[0]"/></dd>
										</dl>
										<dl>
											<dt>選択肢</dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt><button type="button" data-type="remove-option" class="btn-remove">削除</button></dt>
											<dd><input type="text" name="choice[0][]"/></dd>
										</dl>
										<dl>
											<dt></dt>
											<dd><button type="button" data-type="add-option">選択肢追加</button></dd>
										</dl>
										<dl>
											<dt>選択方法</dt>
											<dd>
												<ul class="horizontal">
													<li><label><input type="radio" name="type[0]" value="1"/><span class="label">単一選択</span></label></li>
													<li><label><input type="radio" name="type[0]" value="2"/><span class="label">複数選択</span></label></li>
												</ul>
											</dd>
										</dl>
									</div>
								</li>
@endif
							</ul>
							<div class="add"><button type="button" data-type="add-question">設問追加</button></div>
						</div>
						
						<div class="submit">
							<button type="submit">追加する</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		(function (d, w) {
			w.addEventListener('click', function (e) {
				if (Array.from(d.querySelectorAll('button[data-type], svg[data-type]')).includes(e.target)) {
					var ul = e.target.closest('.questions').querySelector('ul')
					switch (e.target.dataset.type) {
						case 'add-question':
							var tpl = d.querySelector('#tpl-question')
							ul.append(tpl.content.cloneNode(true))
							break;
						case 'remove-question':
							e.target.closest('li').remove()
							break;
						case 'add-option':
							var tpl = d.querySelector('#tpl-option')
							e.target.closest('dl').before(tpl.content.cloneNode(true))
							break;
						case 'remove-option':
							e.target.closest('dl').remove()
							break;
						case 'move-up':
							var c = e.target.closest('li')
							var t = c.previousElementSibling
							if (t) {
								c.addEventListener('transitionend', function () {
									t.before(c)
									c.style.transition = 'none'
									t.style.transition = 'none'
									c.style.transform = 'none'
									t.style.transform = 'none'
								}, { once: true })
								c.style.transition = null
								t.style.transition = null
								c.style.transform = 'translateY(-' + (t.clientHeight + 16) + 'px)'
								t.style.transform = 'translateY(' + (c.clientHeight + 16) + 'px)'
							}
							break;
						case 'move-down':
							var c = e.target.closest('li')
							var t = c.nextElementSibling
							if (t) {
								c.addEventListener('transitionend', function () {
									t.after(c)
									c.style.transition = 'none'
									t.style.transition = 'none'
									c.style.transform = 'none'
									t.style.transform = 'none'
								}, { once: true })
								c.style.transition = null
								t.style.transition = null
								c.style.transform = 'translateY(' + (t.clientHeight + 16) + 'px)'
								t.style.transform = 'translateY(-' + (c.clientHeight + 16) + 'px)'
							}
							break;
					}
					Array.from(ul.querySelectorAll('.question')).forEach(function (li, i) {
						Array.from(li.querySelectorAll('[name]')).forEach(function (el) {
							el.name = el.name.replace(/\[(\d+)\]/, '[' + i + ']')
						})
					})
				}
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
			Array.from(d.querySelectorAll('input[data-type="date"]')).forEach(function (el) {
				flatpickr(el, {
					locale: 'ja',
				})
			})
			Array.from(d.querySelectorAll('input[data-type="datetime"]')).forEach(function (el) {
				flatpickr(el, {
					locale: 'ja',
					enableTime: true
				})
			})
		})(document, window)
	</script>

@endsection
