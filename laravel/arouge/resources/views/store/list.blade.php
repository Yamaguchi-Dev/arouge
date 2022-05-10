@extends('layouts.app')

@section('content')
				<form action="{{route('store_list_search')}}" method="post">
					<div class="elem-form">
						<dl>
							<dt>店名</dt>
							<dd><input type="text" name="name"/></dd>
						</dl>
						<dl>
							<dt>郵便番号</dt>
							<dd><input type="text" name="zipcode" size="12"/></dd>
						</dl>
						<dl>
							<dt>都道府県</dt>
							<dd>
								<select name="pref_id">
									<option value="">北海道</option>
								</select>
							</dd>
						</dl>
						<dl>
							<dt>市区郡町村以降</dt>
							<dd><textarea name="pref_id"></textarea></dd>
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
							<button type="submit">検索する</button>
							<button type="submit" class="btn-sub">CSV出力</button>
						</div>
					</div>
				</form>

				<div class="elem-list-result">
					<table>
						<caption>0件中 / 1～50件</caption>
						<thead>
							<tr>
								<th rowspan="2">公開</th>
								<th rowspan="2">店名</th>
								<th rowspan="2">郵便番号</th>
								<th rowspan="2">住所</th>
								<th rowspan="2">電話番号</th>
								<th colspan="2">お取り扱い状況</th>
								<th rowspan="2">編集</th>
							</tr>
							<tr>
								<th>アルージェ</th>
								<th>エンリッチ</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">クリエイトＳＤ　清水有東坂店</td>
								<td>424-0874</td>
								<td class="x-left">静岡県　静岡市清水区今泉１６３－１</td>
								<td><a href="tel:054-344-3700">054-344-3700 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="" class="x-alert">非公開</a></td>
								<td class="x-left">ウエルシア　清水草薙店</td>
								<td>424-0886</td>
								<td class="x-left">静岡県　静岡市清水区草薙２－１７－２４</td>
								<td><a href="tel:054-349-5866">054-349-5866 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">つつじ堂二番館</td>
								<td>424-0886</td>
								<td class="x-left">静岡県　静岡市清水区草薙１－１４－６</td>
								<td><a href="tel:054-347-3353">054-347-3353 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">くすりのつつじ堂</td>
								<td>424-0886</td>
								<td class="x-left">静岡県　静岡市清水区草薙１－６－１</td>
								<td><a href="tel:054-345-9059">054-345-9059 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">アザレア薬局</td>
								<td>424-0888</td>
								<td class="x-left">静岡県　静岡市清水区中之郷１－７－４</td>
								<td><a href="tel:054-348-5216">054-348-5216 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">杏林堂薬局　清水三保店</td>
								<td>424-0901</td>
								<td class="x-left">静岡県　静岡市清水区三保１１１－２</td>
								<td><a href="tel:054-334-1211">054-334-1211 </a></td>
								<td>〇</td>
								<td>〇</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">ウエルシア　清水折戸店</td>
								<td>424-0902</td>
								<td class="x-left">静岡県　静岡市清水区折戸４－２－３５</td>
								<td><a href="tel:054-335-5688">054-335-5688 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">ウエルシア　清水駒越店</td>
								<td>424-0905</td>
								<td class="x-left">静岡県　静岡市清水区駒越西１－２－７０</td>
								<td><a href="tel:054-337-1650">054-337-1650 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">ウエルシア　ベイドリーム清水店</td>
								<td>424-0906</td>
								<td class="x-left">静岡県　静岡市清水区駒越北町８－１</td>
								<td><a href="tel:054-337-3589">054-337-3589 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
							<tr>
								<td><a href="">公開</a></td>
								<td class="x-left">蘖　薬局</td>
								<td>424-0907</td>
								<td class="x-left">静岡県　静岡市清水区駒越東町２－３５</td>
								<td><a href="tel:054-334-7719">054-334-7719 </a></td>
								<td>〇</td>
								<td>-</td>
								<td><button type="button" data-id="111">編集</button></td>
							</tr>
						</tbody>
					</table>
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
			Array.from(d.querySelectorAll('.elem-list-result button[data-id]')).forEach(function (el) {
				el.addEventListener('click', function () {
					var iframe = d.createElement('iframe')
					iframe.classList.add('area-overlay')
					iframe.src = './edit.html?id=' + this.dataset.id
					d.body.append(iframe)
				})
			})
		})(document, window)
	</script>
@endsection
