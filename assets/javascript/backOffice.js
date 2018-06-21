$(function(){
  $('#showAPropos').on('click',function(e){
    e.preventDefault();
    $.get("index.php?controller=section&action=afficherSectionBO", function(data){
      $('#content').html(data);
    });
  });

  var alert = $('#alert'); 
    if(alert.length > 0){
        alert.hide().slideDown(500);
        alert.find('.close').click(function(e){
            e.preventDefault();
            alert.slideUp();
        })
    }
});
