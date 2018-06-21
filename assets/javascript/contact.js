$(function(){

	var form = $('#formContact');
	var submit =$('#submitForm');
	var formMessage = $('#formMessage');
	var erreurSettings = $('.erreurSettings');
	erreurSettings.hide();

	$(submit).on("click", function(e){
		e.preventDefault();

		erreurSettings.hide();
		var nom = $('#nom').val();
		var prenom = $('#prenom').val();
		var mail = $('#mail').val();
		var message = $('#message').val();
		var element = $('input').val()
		function validateMail(mail){
			var mailRegex = '^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$';
			return false;

		}
		// if (nom == ''){
		// 	console.log('hey');
		// 	$('.nomErreur').css('color','red').show();
		// 	$(nom).css('border','1px solid red');
		// 	return false;
		// };
		// if(prenom == ''){
		// 	$('.prenomErreur').css('color','red').show();
		// 	return false;

		// };
		// if((mail == '') && (validateMail(mail) == false)){
		// 	$('.mailErreur').css('color','red').show();
			
		// };
		// if(message == ''){
		// 	$('.messageErreur').css('color','red').show();
			
		// }
	// var erreur = '';
	// $("#formContact :input").each(function(){
 //      if($(this).val()===""){
 //      	erreur=$(this).val('').attr('id');
 //      	$("#formContact :input .erreurSettings").show();
 //      	// console.log(erreur);
 //      	// console.log('it works');
 //      }
 //     });



			var formData = form.serialize();
			var request = $.ajax({
				type : 'POST',
				url : form.attr('action'),
				data : formData
			})
		request.done(function(data){
				console.log('success ');
				$('#nom').val('');
				$('#prenom').val('');
				$('#mail').val('');
				$('#message').val('');
				$(formMessage).removeClass('error');
				$(formMessage).addClass('success');
				$(formMessage).html('Mail envoyé avec succès');	
		});
		request.fail(function(){
			$(formMessage).removeClass('success');
			$(formMessage).addClass('error');
			$(formMessage).text('error');
		})
					
	});
	return false;
	
});
