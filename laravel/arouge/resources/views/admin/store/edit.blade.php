@extends('layouts.app_edit')

@section('content')
				<form name="form1" action="{{route('store_update')}}" method="post">
@csrf
					<input type="hidden" name="id" value="@if(isset($data['id'])){{$data['id']}}@else{{old('id')}}@endif" /></dd>
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
							<dt>店名</dt>
							<dd><input type="text" name="name" value="@if(isset($data['name'])){{$data['name']}}@else{{old('name')}}@endif"/></dd>
						</dl>
						<dl>
							<dt>郵便番号</dt>
							<dd><input type="text" name="zipcode" value="@if(isset($data['zipcode'])){{$data['zipcode']}}@else{{old('zipcode')}}@endif"/></dd>
						</dl>
						<dl>
							<dt>都道府県</dt>
							<dd>
								<select name="pref_id">
									<option value="">都道府県名</option>
@foreach(config('common.pref') as $k => $v)
									<option value="{{$k}}" @if(isset($data['pref_id']) && $data['pref_id'] == $k) selected @endif>{{$v}}</option>
@endforeach
								</select>
							</dd>
						</dl>
						<dl>
							<dt>市区郡町村以降</dt>
							<dd><textarea name="address">@if(isset($data['address'])){{$data['address']}}@else{{old('address')}}@endif</textarea></dd>
						</dl>
						<dl>
							<dt>電話番号</dt>
							<dd><input type="tel" name="tel" value="@if(isset($data['tel'])){{$data['tel']}}@else{{old('tel')}}@endif"/></dd>
						</dl>
						<dl>
							<dt>お取り扱い状況</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="checkbox" name="bland[]" value="1" @if(isset($data['bland']) && in_array(1, $data['bland'])) checked @endif/><span class="label">アルージェ</span></label></li>
									<li><label><input type="checkbox" name="bland[]" value="2" @if(isset($data['bland']) && in_array(2, $data['bland'])) checked @endif/><span class="label">エンリッチ</span></label></li>
								</ul>
							</dd>
						</dl>
						<div class="submit">
							<button type="submit">確定</button>
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
				w.parent.postMessage({ action: 'close' }, location.origin)
			})
		})(document, window)
	</script>
@endsection
