var returns = {

	init: function (){
		returns.inputs();
	}, 

	inputs: function (){
		$('.form-control:not(.return-edit)').addClass('disabled').prop('disabled', true)
	}
}

$(document).ready(function(){
	returns.init();
});