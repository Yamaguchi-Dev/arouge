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
<script type="text/javascript" src="/sdocs/sampletest/js/zipSuggest.js" charset="utf-8"></script>
	
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
	
<?php include("../../shared/include/header_http.html"); ?>
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
					<h1><?php echo nl2br($data['title']); ?><br><span class="fs"><?php echo nl2br($data['contents']); ?></span></h1>
				</div>
			</div>
		</div>

        
		<div class="cont_bg">
			<div class="contents form sample_cont">
				
@include($include_file)
				
<?php
echo $data['summary'];
?>
					<div>
						
						<form method="post" action="{{route('sample_comfirm')}}" id="form1" name="form1" method="post">
@csrf
							<input type="hidden" name="sample_select2" value="1">
							<input type="hidden" name="id" value="{{$data['id']}}">
							
							<dl class="def-01">
@foreach($data['q_title'] as $k => $v)
<?php
$no = $k + 1;
$question = 'question'.$no;
$error_question = 'question.'.$no;
?>
							<input type="hidden" name="q_title[{{$no}}]" value="{{$v}}">
							<dt><span class="item">Q{{$no}}：</span>{{$v}}<sup class="red_text">※</sup></dt>
							<dd>
							<ul class="input-03">
@foreach($data['choice'][$k] as $k2 => $v2)
<?php
$no2 = $k2 + 1;
?>
@if($data['type'][$k] == 2)
							<li><label><input type="checkbox" name="question{{$no}}[]" value="{{$no2}}" @if(!empty(old($question)) && in_array($no2, old($question))) checked @endif>{{$v2}}</label></li>
@else
							<li><label><input type="radio" name="question{{$no}}" value="{{$no2}}" @if(old($question) == $no2) checked @endif>{{$v2}}</label></li>
@endif
@endforeach
							</ul>
							@if ($errors->has($error_question))<div class="new_layout"><span class="pink">{{$errors->first($error_question)}}</span></div>@endif
							</dd>
@endforeach
							</dl>

							
							<!--<h3><span>（必須）</span>の項目は必須項目ですので、必ずお答えください。</h3>-->
							<dl class="def-02">
							<dt class="required">お名前</dt>
							<dd>
							<ul class="input-02">
							<li class="larea"><label><span class="label">姓</span> <input type="text" name="txtName_1" value="{{old('txtName_1')}}" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<li><label><span class="label">名</span> <input type="text" name="txtName_2" value="{{old('txtName_2')}}" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<!--<li class="attention">※ 全角でご入力ください。</li>-->
							</ul>
							@if ($errors->has('txtName_1'))<div class="new_layout"><span class="pink">{{$errors->first('txtName_1')}}</span></div>@endif
							@if ($errors->has('txtName_2'))<div class="new_layout"><span class="pink">{{$errors->first('txtName_2')}}</span></div>@endif
							</dd>
							
							
							<dt class="required">フリガナ</dt>
							<dd>
							<ul class="input-02">
							<li class="larea"><label><span class="label">セイ</span> <input type="text" name="txtName_12" value="{{mb_convert_kana(mb_convert_kana(old('txtName_12'), 'KV', 'UTF-8'), 'C', 'UTF-8')}}" class="w250px variable" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<li><label><span class="label">メイ</span> <input type="text" name="txtName_22" value="{{mb_convert_kana(mb_convert_kana(old('txtName_22'), 'KV', 'UTF-8'), 'C', 'UTF-8')}}" class="w250px variable rarea" maxlength="36" placeholder="※ 全角でご入力ください。"></label></li>
							<!--<li class="attention">※ 全角でご入力ください。</li>-->
							</ul>
							@if ($errors->has('txtName_12'))<div class="new_layout"><span class="pink">{{$errors->first('txtName_12')}}</span></div>@endif
							@if ($errors->has('txtName_22'))<div class="new_layout"><span class="pink">{{$errors->first('txtName_22')}}</span></div>@endif
							</dd>
							
							
							<dt class="required">郵便番号</dt>
							<dd>
							<ul class="zipSuggest input-02">
							<li><input type="text" name="txtPono_1" value="{{old('txtPono_1')}}" class="zipInput postal_code" id="text-zip-01" maxlength="3" placeholder="※ 半角数字"> - <input type="text" name="txtPono_2" value="{{old('txtPono_2')}}" class="zipInput postal_code2" maxlength="4" placeholder="※ 半角数字"><!--<span class="attention">※ 半角でご入力ください。</span>--> <input type="button" id="postal_btn" class="postal_btn" name="btn" value="住所検索"></li>
							</ul>
							@if ($errors->has('zipcode'))<div class="new_layout"><span class="pink">{{$errors->first('zipcode')}}</span></div>@endif
							</dd>
							
							<dt class="required">ご住所</dt>
							<dd>
							<ul class="zipSuggest input-02">
							<li class="w100p">
							<select class="w275px variable" name="txtKenmei" id="select-address-01">
							<option value="">都道府県名</option>
@foreach(config('common.pref') as $k => $v)
							<option value="{{$k}}" @if(old('txtKenmei') == $k) selected @endif>{{$v}}</option>
@endforeach
							</select>
							<!--<span class="attention">※ 選択してください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span class="required">市区町村</span>
							<input type="text" name="txtCity" value="{{old('txtCity')}}" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span class="required">番地</span>
							<input type="text" name="txtTown" value="{{old('txtTown')}}" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							
							<li class="w100p">
							<label><span>アパート、マンション、部屋番号</span>
							<input type="text" name="txtTown2" value="{{old('txtTown2')}}" class="w300px variable" placeholder="※ 全角でご入力ください。"></label>
							<!--<span class="attention">※ 全角でご入力ください。</span>-->
							</li>
							</ul>
							@if ($errors->has('txtKenmei'))<div class="new_layout"><span class="pink">{{$errors->first('txtKenmei')}}</span></div>@endif
							@if ($errors->has('txtCity'))<div class="new_layout"><span class="pink">{{$errors->first('txtCity')}}</span></div>@endif
							@if ($errors->has('txtTown'))<div class="new_layout"><span class="pink">{{$errors->first('txtTown')}}</span></div>@endif
							@if ($errors->has('txtTown2'))<div class="new_layout"><span class="pink">{{$errors->first('txtTown2')}}</span></div>@endif
							</dd>
							
							
							
							
							
							
							<dt class="required">電話番号</dt>
							<dd>
							<ul class="input-02">
							<li><input type="text" name="txtTel_1" value="{{old('txtTel_1')}}" class="phone_num" id="text-tel-01" maxlength="7" placeholder="※ 半角数字"> - <input type="text" name="txtTel_2" value="{{old('txtTel_2')}}" class="phone_num2" maxlength="4" placeholder="※ 半角数字"> - <input type="text" name="txtTel_3" value="{{old('txtTel_3')}}" class="phone_num3" maxlength="4" placeholder="※ 半角数字"><!--<span class="attention">※ 半角でご入力ください。</span>--></li>
							</ul>
							@if ($errors->has('tel'))<div class="new_layout"><span class="pink">{{$errors->first('tel')}}</span></div>@endif
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
							<li><label><input type="radio" name="USR_SEX" value="1" @if(old('USR_SEX') == 1) checked @endif> 男性</label></li>
							<li><label><input type="radio" name="USR_SEX" value="2" @if(old('USR_SEX') == 2) checked @endif> 女性</label></li>
							<li><label><input type="radio" name="USR_SEX" value="3" @if(old('USR_SEX') == 3) checked @endif> 回答しない</label></li>
							<!--<li class="attention">※ 選択してください。</li>-->
							</ul>
							@if ($errors->has('USR_SEX'))<div class="new_layout"><span class="pink">{{$errors->first('USR_SEX')}}</span></div>@endif
							</dd>
							
							<dt class="required">生年月日</dt>
							<dd class="padl0">
							<ul class="input-02">
							<li><!--<input type="text" name="seireki" value="" class="w24p" id="text-born-01" maxlength="8" placeholder="例）1980">年 -->
							<select name="seireki" class="mr5">
@for($y = 1930; $y <= 1989; $y++)
							<option value="{{$y}}" @if(old('seireki') == $y) selected @endif>{{$y}}</option>
@endfor
							<option value="" disabled  @if(empty(old('seireki'))) selected @endif>-------</option>
@for($y = 1990; $y <= $max_select_year; $y++)
							<option value="{{$y}}"  @if(old('seireki') == $y) selected @endif>{{$y}}</option>
@endfor
							</select>年
							<select name="tuki" class="mr5">
							<option value=""></option>
@for($m = 1; $m <= 12; $m++)
							<option value="{{$m}}"  @if(old('tuki') == $m) selected @endif>{{$m}}</option>
@endfor
							</select>月 
							<select name="day" class="mr5">
							<option value=""></option>
@for($d = 1; $d <= 31; $d++)
							<option value="{{$d}}"  @if(old('day') == $d) selected @endif>{{$d}}</option>
@endfor
							</select>日<!-- <span class="attention">※ 半角でご入力ください。</span>--></li>
							</ul>
							@if ($errors->has('birthday'))<div class="new_layout"><span class="pink">{{$errors->first('birthday')}}</span></div>@endif
							</dd>
							</dl>
							
							
							
							<input type="hidden" name="OLD" value="未入力">

							<input type="hidden" name="JOB" value="未入力">

							<input type="hidden" name="GYOUSHU" value="未入力">
							
							<ul class="buttons-01">
							<li class="color-01"><button type="submit" class="height-set"><span>受付確認画面へ </span></button></li>
							</ul>
							</form> 
					</div>
	
			 </div>
	
		</div>
	</div>
<?php include("../../shared/include/footer_http.html"); ?>
</body>
</html>

