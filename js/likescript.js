$(document).ready(function(e){
$(".likes").live("click",function(){   // Like and Unlike
var element=$(this);
// var numlike=$(this).attr("id");
var per=$(this).parents(".likesdiv");
var sid=per.attr("id");
var htm=$(this).html();
if(htm=="Like")
{
$.ajax({
type: "POST",
url: "like.php",
data: 'sid=' + sid + '&sta=like',
success: function(reslike){
if(reslike==1)
{
var numlikes=$("#lik"+sid).html();
numlikes=parseInt(numlikes);
element.html("Unlike");
$("#lik"+sid).html(numlikes+1);
}
}
});
}
else if(htm=="Unlike")
{
$.ajax({
type: "POST",
url: "like.php",
data: 'sid=' + sid + '&sta=unlike',
success: function(reslike){
if(reslike==1)
{
var numlikes=$("#lik"+sid).html();
numlikes=parseInt(numlikes);
element.html("Like");
$("#lik"+sid).html(numlikes-1);
}
}
});
}
return false;
});
});