<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="sample0a.aspx.cs" Inherits="ArougeMultiWeb.sdocs.sample.sample0a" %>

<!DOCTYPE HTML>
<html lang="ja">
<head runat="server">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
			<form id="form1" runat="server">
				<h2>確認画面</h2>
				<p class="ttl0a"><span>合計<br class="sp">30,000名様に<br>&#147;アルージェの<br class="sp">バリア保湿&#148;を体感<br><span class="fs">モイスチャー ミストローション&#8545; <br>モイストUVクリーム <br class="sp">のサンプルセット（各２回分）をプレゼント</span></span></p>

				<p><asp:Label ID="Name" runat="server"></asp:Label>様 ご応募ありがとうございます。<br>ご入力に誤りがございますと、お届けできない場合があります。<br>今一度、ご確認をお願いいたします。</p>
				<p><asp:Literal ID="Literal1" runat="server"></asp:Literal></p>
				
				<div class="Notes mb40">
					<ul class="annotation">
						<li>当選者の発表は、発送をもってかえさせていただきます。</li>
					</ul>
				</div>
				
				<div class="confirm_box">
				<dl class="def-02">
					<dt> 
    <asp:Literal ID="Literal2" runat="server"></asp:Literal>
    </dt>
					<dt>お名前</dt>
					<dd>
    <asp:Label ID="Name2" runat="server"></asp:Label>
    </dd>
					
					<dt>フリガナ</dt>
					<dd><asp:Label ID="furigana" runat="server"></asp:Label></dd>
					
					<dt>郵便番号</dt>
					<dd><asp:Label ID="post" runat="server"></asp:Label></dd>
					
					<dt>ご住所</dt>
					<dd><asp:Label ID="jyusyo" runat="server"></asp:Label></dd>
					
					<dt>電話番号</dt>
					<dd><asp:Label ID="tel" runat="server"></asp:Label></dd>
					
					<dt>性別</dt>
					<dd><asp:Label ID="sex" runat="server"></asp:Label></dd>
					
					<dt>生年月日</dt>
					<dd><asp:Label ID="seireki" runat="server"></asp:Label>年<asp:Label ID="tuki" runat="server"></asp:Label>月<asp:Label ID="day" runat="server"></asp:Label>日</dd>
					</dl>

<dt class="none">E-mailアドレス</dt>
<dd class="none"><asp:Label ID="email" runat="server"></asp:Label></dd>
<dt class="none">年代</dt>
<dd class="none">
    <asp:Label ID="nenndai" runat="server"></asp:Label>
    </dd>
<dt class="none">ご職業</dt>
<dd class="none">
    <asp:Label ID="syokugyo" runat="server"></asp:Label>
    </dd>
<dt class="none">業種</dt>
<dd class="none">
    <asp:Label ID="gyosyu" runat="server"></asp:Label>
     <asp:HiddenField ID="HiddenField1" runat="server" />
    </dd>
				</div>
				
				<p class="ac Ntxt"><em>上記でよろしければ、必ず下記の送信ボタンを押してください。</em></p>
				<ul class="buttons-02 clearfix">
				<li class="color-01 btnleft"><button type="button" class="height-set" onclick="history.back()"><span> 戻る</span></button></li>
				<li class="color-01 btnright"><button type="submit" class="height-set" onclick="send_onclick()"><span>送信 </span></button></li>
				</ul>
				
<asp:Panel ID="Panel1" runat="server" Visible="false">
    <asp:HiddenField ID="Hidden26" runat="server" />
    <asp:HiddenField ID="Hidden25" runat="server" />
    <asp:HiddenField ID="Hidden24" runat="server" />
    <asp:HiddenField ID="Hidden23" runat="server" />
    <asp:HiddenField ID="Hidden22" runat="server" />
    <asp:HiddenField ID="Hidden21" runat="server" />
    <asp:HiddenField ID="Hidden20" runat="server" />
    <asp:HiddenField ID="Hidden19" runat="server" />
    <asp:HiddenField ID="Hidden18" runat="server" />
    <asp:HiddenField ID="Hidden17" runat="server" />
    <asp:HiddenField ID="Hidden16" runat="server" />
    <asp:HiddenField ID="Hidden15" runat="server" />
    <asp:HiddenField ID="Hidden14" runat="server" />
    <asp:HiddenField ID="Hidden13" runat="server" />
    <asp:HiddenField ID="Hidden12" runat="server" />
    <asp:HiddenField ID="Hidden11" runat="server" />
    <asp:HiddenField ID="Hidden10" runat="server" />
    <asp:HiddenField ID="Hidden9" runat="server" />
    <asp:HiddenField ID="Hidden8" runat="server" />
    <asp:HiddenField ID="Hidden7" runat="server" />
    <asp:HiddenField ID="Hidden6" runat="server" />
    <asp:HiddenField ID="Hidden5" runat="server" />
    <asp:HiddenField ID="Hidden4" runat="server" />
    <asp:HiddenField ID="Hidden3" runat="server" />
    <asp:HiddenField ID="Hidden2" runat="server" />
    <asp:HiddenField ID="Hidden1" runat="server" />
     
</asp:Panel>

</form>
				
			</div>

		</div>
	</div>
<script language="javascript" type="text/javascript">
    function send_onclick() {

        document.getElementById("HiddenField1").value = "send";
        
    }
</script>
    
    <!--#include virtual="/shared/include/footer_bom.html" -->
</body>
</html>