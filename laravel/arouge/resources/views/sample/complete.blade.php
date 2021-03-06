<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<meta http-equiv="refresh" content="3; URL=https://www.arouge.com/">-->
<title>完了画面｜アルージェを試す（サンプル応募）｜Arouge（アルージェ）</title>
<meta name="description" content="「アルージェのバリア保湿 サンプルセット」プレゼントの入力完了画面です。">
<meta name="keywords" content="サンプル,応募,アルージェ,Arouge,敏感肌,バリア保湿,スキンケア">
<link rel="stylesheet" href="/shared/css/reset.css" media="all">
<link rel="stylesheet" href="/shared/css/common.css" media="all">
<link rel="stylesheet" href="/shared/css/common_sp.css" media="all">
<link rel="stylesheet" href="/shared/css/form.css" media="all">
<link rel="stylesheet" href="/special/moisture_mist_lotion_2/css/style.css" media="all">
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
	
<?php include("../../shared/include/header_http.html"); ?>
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
			<div class="contents thanks sample_cont">
				<h2>ご応募いただきありがとうございました。</h2>
				
				<p class="ac mb0">{{$data['txtName_1']}} {{$data['txtName_2']}} 様 受付番号　700113　で承りました。</p>
                
<?php
echo $complete_page;
?>

			</div>
		</div>
	</div>
<?php include("../../shared/include/footer_bom.html"); ?>
</body>
</html>
