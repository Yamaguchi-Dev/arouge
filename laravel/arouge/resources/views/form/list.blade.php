@extends('layouts.app')

@section('content')
				<form action="">
					<div class="elem-form">
						<dl>
							<dt>管理番号</dt>
							<dd><input type="text" size="12"/></dd>
						</dl>
						<dl>
							<dt>公開</dt>
							<dd>
								<ul class="horizontal">
									<li><label><input type="radio"/><span class="label">公開中</span></label></li>
									<li><label><input type="radio"/><span class="label">非公開中</span></label></li>
								</ul>
							</dd>
						</dl>
						<dl>
							<dt>管理用タイトル</dt>
							<dd>
								<select>
									<option value=""></option>
								</select>
							</dd>
						</dl>
						<dl>
							<dt>検索期間</dt>
							<dd>
								<ul class="horizontal">
									<li><input type="text" size="12" data-type="date"/></li>
									<li>～</li>
									<li><input type="text" size="12" data-type="date"/></li>
								</ul>
							</dd>
						</dl>
						<div class="submit">
							<button type="submit">検索する</button>
						</div>
					</div>
				</form>

				<div class="elem-list-page">
					<p>0件中 / 1～50件</p>
				</div>

				<div class="elem-form">
					<dl>
						<dt>管理番号</dt>
						<dd><p class="confirm">1</p></dd>
					</dl>
					<dl>
						<dt>公開</dt>
						<dd><p class="confirm">公開</p></dd>
					</dl>
					<dl>
						<dt>管理用タイトル</dt>
						<dd><p class="confirm">サンプル2回分セット</p></dd>
					</dl>
					<dl>
						<dt>掲載タイトル</dt>
						<dd><p class="confirm">合計30,000名様に<br>アルージェのバリア保湿を体感できる化粧水、<br>肌にやさしく、敏感肌を守るUVクリーム</p></dd>
					</dl>
					<dl>
						<dt>内容</dt>
						<dd><p class="confirm">モイスチャー ミストローションⅡ<br>モイストUVクリームのサンプルセットをプレゼント</p></dd>
					</dl>
					<dl>
						<dt>応募期間</dt>
						<dd><p class="confirm">2022年3月1日（火）～ 2022年5月31日（火）</p></dd>
					</dl>
					<dl>
						<dt>設問</dt>
						<dd><a href="./preview.html" target="_blank" class="button">確認</a></dd>
					</dl>
					<dl>
						<dt>応募者情報</dt>
						<dd>
							<ul class="horizontal">
								<li><a href="./subscriber-detail.html" class="button">確認</a></li>
								<li><a href="" class="button">CSV出力</a></li>
							</ul>
						</dd>
					</dl>
					<div class="submit"><a href="./edit.html?id=1" target="iframe" class="button">編集</a></div>
				</div>

				<div class="elem-form">
					<dl>
						<dt>管理番号</dt>
						<dd><p class="confirm">2</p></dd>
					</dl>
					<dl>
						<dt>公開</dt>
						<dd><p class="confirm">公開</p></dd>
					</dl>
					<dl>
						<dt>管理用タイトル</dt>
						<dd><p class="confirm">サンプル2回分セット</p></dd>
					</dl>
					<dl>
						<dt>掲載タイトル</dt>
						<dd><p class="confirm">合計30,000名様に<br>アルージェのバリア保湿を体感できる化粧水、<br>肌にやさしく、敏感肌を守るUVクリーム</p></dd>
					</dl>
					<dl>
						<dt>内容</dt>
						<dd><p class="confirm">モイスチャー ミストローションⅡ<br>モイストUVクリームのサンプルセットをプレゼント</p></dd>
					</dl>
					<dl>
						<dt>応募期間</dt>
						<dd><p class="confirm">2022年3月1日（火）～ 2022年5月31日（火）</p></dd>
					</dl>
					<dl>
						<dt>設問</dt>
						<dd><a href="./preview.html" target="_blank" class="button">確認</a></dd>
					</dl>
					<dl>
						<dt>応募者情報</dt>
						<dd>
							<ul class="horizontal">
								<li><a href="./subscriber-detail.html" class="button">確認</a></li>
								<li><a href="" class="button">CSV出力</a></li>
							</ul>
						</dd>
					</dl>
					<div class="submit"><a href="./edit.html?id=2" target="iframe" class="button">編集</a></div>
				</div>

				<div class="elem-list-page">
					<ol>
						<li><a href="">&lt;前へ</a></li>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li><a>3</a></li>
						<li><a href="">4</a></li>
						<li><a href="">5</a></li>
						<li><a href="">次へ&gt;</a></li>
					</ol>
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
