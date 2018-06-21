$(document).ready(function(){
	$('#menu a').click(function(e){
	     hideContentDivs();
	     var tmp_div = $(this).parent().index();
	     $('.main .content').eq(tmp_div).show();
	  });

	function hideContentDivs(){
	    $('.main .content').each(function(){
	    $(this).hide();});
	}
	hideContentDivs();
});