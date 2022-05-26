<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<meta http-equiv="refresh" content="3; URL=https://www.arouge.com/">-->
<title>確認画面｜アルージェを試す（サンプル応募）｜Arouge（アルージェ）</title>
<meta name="description" content="「アルージェのバリア保湿 サンプルセット」プレゼントの確認画面です。">
<meta name="keywords" content="サンプル,応募,アルージェ,Arouge,敏感肌,バリア保湿,スキンケア">
<link rel="stylesheet" href="/shared/css/reset.css" media="all">
<link rel="stylesheet" href="/shared/css/common.css" media="all">
<link rel="stylesheet" href="/shared/css/common_sp.css" media="all">
<link rel="stylesheet" href="/shared/css/form.css" media="all">
<script src="/shared/js/jquery.js"></script>
<script src="/shared/js/script.js"></script>
	
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
	
    <!--#include virtual="/shared/include/header_bom.html" -->
    <div class="wrapper">
		<div class="title_bg">
			<div class="breadClumbs">
				<ul>
					<li><a href="https://www.arouge.com/">TOP</a>&gt;</li>
					<li><a href="https://www.arouge.com/campaign/">キャンペーン</a>&gt;</li>
					<li><a href="https://www.arouge.com/sdocs/sample/form.html">アルージェを試す</a>&gt;</li>
					<li>応募</li>
				</ul>
			</div>
	
			<div class="title02">
				<div class="titleInner">
					<h1>アルージェを試す</h1>
				</div>
			</div>
		</div>

        
		<div class="cont_bg">
			<div class="contents confirm sample_cont">
				<h2>確認画面</h2>
				<p class="ttl0a"><span>合計<br class="sp">30,000名様に<br>&#147;アルージェの<br class="sp">バリア保湿&#148;を体感<br><span class="fs">モイスチャー ミストローション&#8545; <br>モイストUVクリーム <br class="sp">のサンプルセット（各２回分）をプレゼント</span></span></p>
				
				<p class="mb30">{{$data['txtName_1']}}{{$data['txtName_2']}} 様 ご応募ありがとうございます。<br>ご入力に誤りがございますと、お届けできない場合があります。<br>今一度、ご確認をお願いいたします。</p>
				
				<div class="Notes mb40">
					<ul class="annotation">
						<li>当選者の発表は、発送をもってかえさせていただきます。</li>
					</ul>
				</div>
				
				<form action="{{route('sample_regist')}}" method="post">
@csrf
@foreach($data as $k => $v)
@if($k != "question")
@if(is_array($v))
@foreach($v as $k2 => $v2)
				<input type="hidden" name="{{$k}}[{{$k2}}]" value="{{$v2}}">
@endforeach
@else
				<input type="hidden" name="{{$k}}" value="{{$v}}">
@endif
@endif
@endforeach
				<div class="confirm_box">
				<dl class="def-01">

@foreach($data['question'] as $k => $v)
					<dt><span class="item">Q{{$k + 1}}：</span>{{$v['q_title']}}</dt>
					<dd>{{$v['answer']}}</dd>
@endforeach
				</dl>

				<dl class="def-02">
					<dt>お名前</dt>
					<dd>{{$data['txtName_1']}} {{$data['txtName_2']}}</dd>
					
					<dt>フリガナ</dt>
					<dd>{{$data['txtName_12']}} {{$data['txtName_22']}}</dd>
					
					<dt>郵便番号</dt>
					<dd>{{$data['txtPono_1']}}{{$data['txtPono_2']}}</dd>
					
					<dt>ご住所</dt>
					<dd>{{config('common.pref')[$data['txtKenmei']]}}{{$data['txtCity']}}{{$data['txtTown']}}{{$data['txtTown2']}}</dd>
					
					<dt>電話番号</dt>
					<dd>{{$data['txtTel_1']}}-{{$data['txtTel_2']}}-{{$data['txtTel_3']}}</dd>
					
					<!--<dt>E-mailアドレス</dt>
					<dd>otani@favor.co.jp</dd>-->
					
					<dt>性別</dt>
					<dd>@if($data['USR_SEX'] == 1)男性 @elseif($data['USR_SEX'] == 2)女性 @else 回答しない @endif</dd>
					
					<!--<dt>年代</dt>
					<dd>10代</dd>-->
					<dt>生年月日</dt>
					<dd>{{$data['seireki']}}年{{$data['tuki']}}月{{$data['day']}}日</dd>
					</dl>
				</div>
				
				<p class="ac Ntxt"><em>上記でよろしければ、必ず下記の送信ボタンを押してください。</em></p>
				<ul class="buttons-02 clearfix">
				<li class="color-01 btnleft"><button type="button" class="height-set" onclick="history.back()"><span> 戻る</span></button></li>
				<li class="color-01 btnright"><button type="submit" class="height-set" onclick="send_onclick()"><span>送信 </span></button></li>
				</ul>
			</form>

			</div>
	
		</div>
	</div>

    
    <!--#include virtual="/shared/include/footer_bom.html" -->
</body>
</html>

