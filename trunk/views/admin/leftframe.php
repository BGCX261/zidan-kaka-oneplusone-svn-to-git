<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>左侧导航栏</title>
</head>
<script  type="text/javascript">
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('y M="";8 17(z,l){b(M!=""){7(M).v="13"}b(7(z).v=="13"){7(z).v="1n";2.E(l);M=z}}8 7(h){b(e.Q&&e.Q(h)){o e.Q(h)}r b(e.R&&e.R(h)){o e.R(h)}r b(e.S&&e.S[h]){o e.S[h]}r{o 1q}}8 1s(){d.4=x Z();d.6=x Z();d.T=T;d.F=F;d.N=N;d.E=E;d.J=J}8 X(p,G,K,C){d.5=G;d.P=K;d.9=p;d.18=C}8 T(p,5,C){2.6[2.4.c]=x Z();2.4[2.4.c]=x X(p,5,0,C);o(2.4.c-1)}8 F(p,k,K){b(k>=0&&k<=2.4.c){G="1i"+k;2.6[k][2.6[k].c]=x X(p,G,K,0);o(2.6[k].c-1)}r F=-1}8 J(5){y 3="";t(i=0;i<2.4.c;i++){b(2.4[i].18==1&&2.4[i].5==5){3+="<g u=W f=V"+i+" w=\\"10(\'A"+i+"\')\\">";3+="<O>"+2.4[i].9+"</O>";3+="</g>";3+="<g u=16 f=A"+i+"><n>";t(j=0;j<2.6[i].c;j++){3+="<m f="+2.6[i][j].5+j+" w=\\"14(\'"+2.6[i][j].9+"\',\'"+2.4[i].9+"\',\'"+2.6[i][j].P+"\')\\"><a 1f=#>"+2.6[i][j].9+"</a></m>"}3+="</n></g>"}}7(\'19\').D=3}8 N(5){y 3="<n>";t(i=0;i<2.4.c;i++){b(2.4[i].5==5){3+="<m f=1z"+i+" w=\\"17(f,\'"+2.4[i].9+"\')\\" u=13>"+2.4[i].9+"</m>"}}3+="</n>";7(\'1u\').D=3}8 E(l){y 3="";t(i=0;i<2.4.c;i++){b(2.4[i].9==l){3="<g u=W f=V"+i+" w=\\"10(\'A"+i+"\')\\">";3+="<O>"+2.4[i].9+"</O>";3+="</g>";3+="<g u=16 f=A"+i+" L=\'H:1c;\'><n>";t(j=0;j<2.6[i].c;j++){3+="<m f="+2.6[i][j].5+"1B"+j+" w=\\"14(\'"+2.6[i][j].9+"\',\'"+2.4[i].9+"\',\'"+2.6[i][j].P+"\')\\"><a 1f=#>"+2.6[i][j].9+"</a></m>"}3+="</n></g>"}}7(\'19\').D=3}8 14(l,5,s){b(l!=""&&5!=""){U.12.15[\'1x\'].7(\'1w\').D=5+"&B;&B;<1v s=1e/I/1A/1E.1C 1D=0 />&B;&B;"+l}b(s!=""){U.12.15[\'1d\'].1a=s}}8 10(q){Y="V"+q.1t(11);b(7(q).L.H=="1g"){7(q).L.H="1c";7(Y).v="W"}r{7(q).L.H="1g";7(Y).v="1j"}}8 1k(5){2.J(5);2.N(5);U.12.15[\'1d\'].1a="1l.1r?1p=I&1o=I"}e.1m("<1b s=1e/I/1h/1y.1h></"+"1b>");',62,103,'||outlookbar|output|titlelist|sortname|itemlist|getObject|function|title||if|length|this|document|id|div|objectId|||parentid|item|li|ul|return|intitle|divid|else|src|for|class|className|onclick|new|var|Id|sub_detail_|nbsp|inisdefault|innerHTML|getbyitem|additem|insort|display|admin|getdefaultnav|inkey|style|preClassName|getbytitle|span|key|getElementById|all|layers|addtitle|window|sub_sort_|list_tilte|theitem|subsortid|Array|hideorshow||top|left_back|changeframe|frames|list_detail|list_sub_detail|isdefault|right_main_nav|location|script|block|manFrame|views|href|none|js|item_|list_tilte_onclick|initinav|index|write|left_back_onclick|act|con|false|php|outlook|substring|left_main_nav|img|show_text|mainFrame|nav|left_nav_|images|_|gif|broder|slide'.split('|'),0,{}))
</script>
<body onload="initinav('管理首页')">
<div id="left_content">
     <div id="user_info"><strong><?php echo $GLOBALS['session']->get('username');?></strong><br />[<a href="#">系统管理员</a>，<a href="index.php?con=admin&act=logout" target="_top">退出</a>]</div>
	 <div id="main_nav">
	     <div id="left_main_nav"></div>
		 <div id="right_main_nav"></div>
	 </div>
</div>
</body>
</html>
