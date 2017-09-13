function viewport(){var e = window, a = 'inner';
if (!( 'innerWidth' in window )){
a = 'client';e = document.documentElement || document.body;}
return { width : e[ a+'Width' ] , height : e[ a+'Height' ] }}
var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
window.onload = function(){document.getElementById("screenH").innerHTML=y;}