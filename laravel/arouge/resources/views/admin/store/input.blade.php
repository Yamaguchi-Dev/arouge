@extends('layouts.app')

@section('content')
				<form action="./add-confirm.html" target="iframe" id="form">
					<div class="elem-form">
						<div class="alert">
							<ul>
								<li>エラー文言</li>
								<li>エラー文言</li>
							</ul>
						</div>
						<dl>
							<dt>店名</dt>
							<dd><input type="text"/></dd>
						</dl>
						<dl>
							<dt>郵便番号</dt>
							<dd><input type="text" size="12"/></dd>
						</dl>
						<dl>
							<dt>都道府県</dt>
							<dd>
								<select>
									<option value="">北海道</option>
								</select>
							</dd>
						</dl>
						<dl>
							<dt>市区郡町村以降</dt>
							<dd><textarea></textarea></dd>
						</dl>
						<dl>
							<dt>電話番号</dt>
							<dd><input type="tel" size="12"/></dd>
						</dl>
						<dl>
							<dt>お取り扱い状況</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="checkbox"/><span class="label">アルージェ</span></label></li>
									<li><label><input type="checkbox"/><span class="label">エンリッチ</span></label></li>
								</ul>
							</dd>
						</dl>
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
