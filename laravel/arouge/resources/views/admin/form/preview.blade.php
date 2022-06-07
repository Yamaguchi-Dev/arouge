<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>入力フォーム｜アルージェを試す（サンプル応募）｜Arouge（アルージェ）</title>
<meta name="description" content="「アルージェのバリア保湿 サンプルセット」プレゼントの入力フォームです。">
<meta name="keywords" content="サンプル,応募,アルージェ,Arouge,敏感肌,バリア保湿,スキンケア">
<!--<meta http-equiv="refresh" content="3; URL=https://www.arouge.com/">-->
<link rel="stylesheet" href="/shared/css/reset.css" media="all">
<link rel="stylesheet" href="/shared/css/common.css" media="all">
<link rel="stylesheet" href="/shared/css/common_sp.css" media="all">
<link rel="stylesheet" href="/shared/css/form.css" media="all">
<script src="/shared/js/jquery.js"></script>
<script src="/shared/js/script.js"></script>
<script type="text/javascript" src="js/zipSuggest.js" charset="utf-8"></script>
	
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5GCD4SP');</script>
<!-- End Google Tag Manager -->
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GCD4SP"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
    <div class="wrapper">
		<div class="title_bg">
			<div class="breadClumbs">
				<ul>
					<li><a href="http://www.arouge.com/">TOP</a>&gt;</li>
					<li><a href="/campaign/">キャンペーン</a>&gt;</li>
					<li><a href="/sdocs/sample/form.html">アルージェを試す</a>&gt;</li>
					<li>応募</li>
				</ul>
			</div>
	
			<div class="title01">
				<div class="titleInner">
					<h1><?php echo nl2br($data['title']); ?><br><span class="fs"><?php echo nl2br($data['contents']); ?></span></span></h1>
				</div>
			</div>
		</div>

        
		<div class="cont_bg">
			<div class="contents form sample_cont">
<?php
echo $data['summary'];
?>
					
					<div>
						<form method="post" action="sample0a.aspx" id="form1" name="form1">
							<input type="hidden" name="sample_select2" value="1">
							
							<dl class="def-01">
@foreach($data['q_title'] as $k => $v)
							<dt><span class="item">Q{{$k + 1}}：</span>{{$v}}<sup class="red_text">※</sup></dt>
							<dd>
							<ul class="input-03">
@foreach($data['choice'][$k] as $k2 => $v2)
@if($data['type'][$k] == 2)
							<li><label><input type="checkbox" name="question{{$k + 1}}[]" value="{{$k2}}">{{$v2}}</label></li>
@else
							<li><label><input type="radio" name="question{{$k + 1}}" value="{{$k2}}">{{$v2}}</label></li>
@endif
@endforeach
							</ul>
							</dd>
@endforeach
							</dl>

							
							<!--<h3><span>（必須）</span>の項目は必須項目ですので、必ずお答えください。</h3>-->
							<dl class="def-02">
							<dt class="required">お名前</dt>
							<dd>
							<ul class="input-02">
							<li class="larea"><label><span class="label">姓</span> <input type="text" name="txtName_1" value="" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<li><label><span class="label">名</span> <input type="text" name="txtName_2" value="" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<!--<li class="attention">※ 全角でご入力ください。</li>-->
							</ul>
							</dd>
							
							
							<dt class="required">フリガナ</dt>
							<dd>
							<ul class="input-02">
							<li class="larea"><label><span class="label">セイ</span> <input type="text" name="txtName_12" value="" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<li><label><span class="label">メイ</span> <input type="text" name="txtName_22" value="" class="w250px variable rarea" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<!--<li class="attention">※ 全角でご入力ください。</li>-->
							</ul>
							</dd>
							
							
							<dt class="required">郵便番号</dt>
							<dd>
							<ul class="zipSuggest input-02">
							<li><input type="text" name="txtPono_1" value="" class="zipInput postal_code" id="text-zip-01" maxlength="3" placeholder="※ 半角数字"> - <input type="text" name="txtPono_2" value="" class="zipInput postal_code2" maxlength="4" placeholder="※ 半角数字"><!--<span class="attention">※ 半角でご入力ください。</span>--> <input type="button" id="postal_btn" class="postal_btn" name="btn" value="住所検索"></li>
							</ul>
							</dd>
							
							<dt class="required">ご住所</dt>
							<dd>
							<ul class="zipSuggest input-02">
							<li class="w100p">
							<select class="w275px variable" name="txtKenmei" id="select-address-01">
							<option selected="selected">都道府県名</option>
							<option value="北海道">北海道</option>
							<option value="青森県">青森県</option>
							<option value="岩手県">岩手県</option>
							<option value="秋田県">秋田県</option>
							<option value="宮城県">宮城県</option>
							<option value="山形県">山形県</option>
							<option value="福島県">福島県</option>
							<option value="東京都">東京都</option>
							<option value="神奈川県">神奈川県</option>
							<option value="埼玉県">埼玉県</option>
							<option value="千葉県">千葉県</option>
							<option value="茨城県">茨城県</option>
							<option value="栃木県">栃木県</option>
							<option value="群馬県">群馬県</option>
							<option value="山梨県">山梨県</option>
							<option value="長野県">長野県</option>
							<option value="新潟県">新潟県</option>
							<option value="富山県">富山県</option>
							<option value="石川県">石川県</option>
							<option value="福井県">福井県</option>
							<option value="岐阜県">岐阜県</option>
							<option value="静岡県">静岡県</option>
							<option value="愛知県">愛知県</option>
							<option value="三重県">三重県</option>
							<option value="滋賀県">滋賀県</option>
							<option value="京都府">京都府</option>
							<option value="大阪府">大阪府</option>
							<option value="兵庫県">兵庫県</option>
							<option value="奈良県">奈良県</option>
							<option value="和歌山県">和歌山県</option>
							<option value="鳥取県">鳥取県</option>
							<option value="島根県">島根県</option>
							<option value="岡山県">岡山県</option>
							<option value="広島県">広島県</option>
							<option value="山口県">山口県</option>
							<option value="徳島県">徳島県</option>
							<option value="高知県">高知県</option>
							<option value="愛媛県">愛媛県</option>
							<option value="香川県">香川県</option>
							<option value="福岡県">福岡県</option>
							<option value="佐賀県">佐賀県</option>
							<option value="熊本県">熊本県</option>
							<option value="長崎県">長崎県</option>
							<option value="大分県">大分県</option>
							<option value="宮崎県">宮崎県</option>
							<option value="鹿児島県">鹿児島県</option>
							<option value="沖縄県">沖縄県</option>
							</select>
							<!--<span class="attention">※ 選択してください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span class="required">市区町村</span>
							<input type="text" name="txtCity" value="" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span class="required">番地</span>
							<input type="text" name="txtTown" value="" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span>アパート、マンション、部屋番号</span>
							<input type="text" name="txtTown2" value="" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							</ul>
							</dd>
							
							
							
							
							
							
							<dt class="required">電話番号</dt>
							<dd>
							<ul class="input-02">
							<li><input type="text" name="txtTel_1" value="" class="phone_num" id="text-tel-01" maxlength="7" placeholder="※ 半角数字"> - <input type="text" name="txtTel_2" value="" class="phone_num2" maxlength="4" placeholder="※ 半角数字"> - <input type="text" name="txtTel_3" value="" class="phone_num3" maxlength="4" placeholder="※ 半角数字"><!--<span class="attention">※ 半角でご入力ください。</span>--></li>
							</ul>
							</dd>
							
							
							<dt>E-mailアドレス</dt>
							<dd class="padl0">
							<ul class="input-02">
							<li><input type="text" name="txtEmail" value="{{old('txtEmail')}}" class="w600px variable" id="text-mail-01" maxlength="50" placeholder="※ 半角でご入力ください。">
							</ul>
							</dd>
							
							
							
							<dt class="required">性別</dt>
							<dd class="padl0">
							<ul class="input-02">
							<li><label><input type="radio" name="USR_SEX" value="男性"> 男性</label></li>
							<li><label><input type="radio" name="USR_SEX" value="女性"> 女性</label></li>
							<li><label><input type="radio" name="USR_SEX" value="回答しない"> 回答しない</label></li>
							<!--<li class="attention">※ 選択してください。</li>-->
							</ul>
							</dd>
							
							<dt class="required">生年月日</dt>
							<dd class="padl0">
							<ul class="input-02">
							<li><!--<input type="text" name="seireki" value="" class="w24p" id="text-born-01" maxlength="8" placeholder="例）1980">年 -->
							<select name="seireki" class="mr5">
							<option value="1930">1930</option>
							<option value="1931">1931</option>
							<option value="1932">1932</option>
							<option value="1933">1933</option>
							<option value="1934">1934</option>
							<option value="1935">1935</option>
							<option value="1936">1936</option>
							<option value="1937">1937</option>
							<option value="1938">1938</option>
							<option value="1939">1939</option>
							<option value="1940">1940</option>
							<option value="1941">1941</option>
							<option value="1942">1942</option>
							<option value="1943">1943</option>
							<option value="1944">1944</option>
							<option value="1945">1945</option>
							<option value="1946">1946</option>
							<option value="1947">1947</option>
							<option value="1948">1948</option>
							<option value="1949">1949</option>
							<option value="1950">1950</option>
							<option value="1951">1951</option>
							<option value="1952">1952</option>
							<option value="1953">1953</option>
							<option value="1954">1954</option>
							<option value="1955">1955</option>
							<option value="1956">1956</option>
							<option value="1957">1957</option>
							<option value="1958">1958</option>
							<option value="1959">1959</option>
							<option value="1960">1960</option>
							<option value="1961">1961</option>
							<option value="1962">1962</option>
							<option value="1963">1963</option>
							<option value="1964">1964</option>
							<option value="1965">1965</option>
							<option value="1966">1966</option>
							<option value="1967">1967</option>
							<option value="1968">1968</option>
							<option value="1969">1969</option>
							<option value="1970">1970</option>
							<option value="1971">1971</option>
							<option value="1972">1972</option>
							<option value="1973">1973</option>
							<option value="1974">1974</option>
							<option value="1975">1975</option>
							<option value="1976">1976</option>
							<option value="1977">1977</option>
							<option value="1978">1978</option>
							<option value="1979">1979</option>
							<option value="1980">1980</option>
							<option value="1981">1981</option>
							<option value="1982">1982</option>
							<option value="1983">1983</option>
							<option value="1984">1984</option>
							<option value="1985">1985</option>
							<option value="1986">1986</option>
							<option value="1987">1987</option>
							<option value="1988">1988</option>
							<option value="1989">1989</option>
							<option value="" disabled selected>-------</option>
							<option value="1990">1990</option>
							<option value="1991">1991</option>
							<option value="1992">1992</option>
							<option value="1993">1993</option>
							<option value="1994">1994</option>
							<option value="1995">1995</option>
							<option value="1996">1996</option>
							<option value="1997">1997</option>
							<option value="1998">1998</option>
							<option value="1999">1999</option>
							<option value="2000">2000</option>
							<option value="2001">2001</option>
							<option value="2002">2002</option>
							<option value="2003">2003</option>
							<option value="2004">2004</option>
							<option value="2005">2005</option>
							<option value="2006">2006</option>
							<option value="2007">2007</option>
							<option value="2008">2008</option>
							<option value="2009">2009</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							</select>年
							<select name="tuki" class="mr5">
							<option value=""></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							</select>月 
							<select name="day" class="mr5">
							<option value=""></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
							</select>日<!-- <span class="attention">※ 半角でご入力ください。</span>--></li>
							</ul>
							</dd>
							</dl>
							
							
							
							<input type="hidden" name="OLD" value="未入力">

							<input type="hidden" name="JOB" value="未入力">

							<input type="hidden" name="GYOUSHU" value="未入力">
							
							<ul class="buttons-01">
							<!--<li class="color-01"><button type="submit" class="height-set"><span>受付確認画面へ </span></button></li>-->
							</ul>
							</form> 
					</div>
	
			 </div>
	
		</div>
	</div>
</body>
</html>
