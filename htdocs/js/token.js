var token = {

	init: function (){
		token.types();
		token.datePicker();
		token.barcode();
		token.calculate();
		token.promoSubmit();
		token.disabledInputs();
	}, 

	disabledInputs: function (){

		if($('#type').val() == 'Promo' || $('#type').val() == 'VIP'){
			$('#token-table input').prop('readonly', true);
		}
	},

	changeTypes: function (){

		location.href = window.location.href.split('?')[0] + '?type=' + $('#types').val();
	},

	types: function (){
		
		// return false;

		// var type = $('#types').val();

		// $('.type-fields').hide();
		// $('.hide-promo').show();
		// $('#td-total').attr('colspan', 4);

		// switch(type){
		// 	case 'FGC':
		// 		$('#fgc-details .title').text('FGC Details');
		// 		$('.type-fgc').show();
		// 		break;
		// 	case 'GRC':
		// 		$('#fgc-details .title').text('GRC Details');
		// 		$('.type-grc').show();
		// 		break;
		// 	case 'Promo':
		// 		$('.type-fields').hide();
		// 		$('.type-promo').show();
		// 		$('.hide-promo').hide();
		// 		$('#td-total').attr('colspan', 2);
		// 		$('#token-table tbody tr:not(#tr-total)').hide();
		// 		break;
		// }

	}, 

	barcode: function (div){
		$('#barcode').keyup(function(event){
			if(event.keyCode == 13)
		        token.searchBarcode();
		})
	},

	searchBarcode: function (){

		$.ajax({
			type: 'post', 
			dataType: 'json', 
			url: base_url + 'app/sales-operation/token/search_barcode', 
			data: {
				barcode: $('#barcode').val(),
				date_redeemed: $('.date-redeemed').val()
			}, 
			success: function (data){

				if(data.error_msg){
					alert(data.error_msg);
				} else if(data.item){
					$(data.item).insertBefore('#fgc-totals');
				} 

				token.faceCalculate();
			}
		});
	},

	faceCalculate: function (){
		
		var total = 0;

		$('#fgc-table tbody td.fgc-value').each(function(){
			total += parseFloat($(this).attr('data-value').replace(/,/g, ''));
		});

		total = number_format(total, 2);

		total = total == 0 ? '' : total;

		$('#fgc-total-value').text(total);
		$('#remaining-face-value').val(total);
		$('#remaining-value').val(total);
	},

	removeFgc: function (div){
		var tr = $(div).closest('tr');

		$(tr).remove();
		token.faceCalculate();

	}, 

	tokenTotal: function(div){

		var tr = $(div).closest('tr');
		var price = parseFloat($('td[data-name=price]').text().replace(/,/g, ''));
		var qty =  parseFloat($('td[data-name=quantity] input', tr).val().replace(/,/g, ''));
		var free =  $('td[data-name=free] input', tr).length > 0 ? parseFloat($('td[data-name=free] input', tr).val().replace(/,/g, '')) : 0;

		qty = qty ? qty : 0;
		free = free ? free : 0;

		var total = qty + free;
		var peso = qty * price;

		total = number_format(total, 0, '.', ',');
		peso = number_format(peso, 2, '.', ',');

		$('[data-name=total]', tr).text(total).val(total);
		$('[data-name=peso]', tr).text(peso).val(peso);

		token.tokenTotalAll();
		token.tokenPesoAll();

	}, 

	tokenTotalAll: function (){
		var total = 0;

		$('#token-table input[data-name=total]').each(function(){

			if($(this).text() != '')
				total += parseFloat($(this).text().replace(/,/g, ''));
		});

		$('#total-token, #total-token-input').text(total).val(total);
	}, 

	tokenPesoAll: function (){

		var total = 0;

		$('#token-table input[data-name=peso]').each(function(){

			if($(this).text() != '')
				total += parseFloat($(this).text().replace(/,/g, ''));
		});

		total = number_format(total, 2);

		$('#token-peso, #token-peso-input').text(total).val(total);
		token.remainingValue();

	}, 

	seriesTotal: function (div){

		var tr = $(div).closest('tr');
		var price = parseFloat($('td[data-name=price]', tr).text().replace(/,/g, ''));
		var from = parseFloat($('td[data-name=from] input', tr).val().replace(/,/g, ''));
		var to = parseFloat($('td[data-name=to] input', tr).val().replace(/,/g, ''));
		var quantity = (to - from) + 1;

		quantity = quantity ? quantity : 0;

		var total = quantity * price;

		total = number_format(total, 2);

		$('[data-name=total]', tr).text(quantity).val(quantity);
		$('[data-name=peso]', tr).text(total).val(total);

		token.seriesTotalAll();

		if($('#type').val() == 'Promo' || $('#type').val() == 'VIP')
			token.remain();

	}, 

	remain: function (){
		var total = parseFloat($('#ticket-peso-all').text());
		var ticket_value = parseFloat($('#ticket-qty-total').text());

		ticket_value = ticket_value ? ticket_value : 0;
		total = total ? total : 0;

		var sum = ticket_value - total;

		$('#ticket-peso-total').text(number_format(sum, 2));

	},

	seriesTotalAll: function (){

		var total = 0;
		var peso = 0;

		$('#ticket-table input[data-name=total]').each(function(){

			num = parseFloat($(this).text().replace(/,/g, ''));
			num = num ? num : 0;

			total += num;
		});

		$('#ticket-table input[data-name=peso]').each(function(){

			num = parseFloat($(this).text().replace(/,/g, ''));
			num = num ? num : 0;

			peso += num;
		});


		$('#ticket-total-all').text(total);
		$('#ticket-peso-all').text(number_format(peso, 2));

		token.remainingValue();
	}, 

	saveItem: function (addNew){

		if(!token.validate()) return false;

		var data = $(':input').serializeArray();

		$.ajax({
			type: 'post', 
			data: data, 
			url: base_url + 'app/sales-operation/token/save', 
			success: function (data){

				if(addNew)
					location.href = base_url + 'app/sales-operation/token/details';
				else
					location.href = base_url + 'app/sales-operation/token';
			}
		});


	}, 

	validate: function (){

		var status = true;
		var value = parseFloat($('#remaining-face-value').val().replace(/,/g, ''));
		var remain = parseFloat($('#remaining-value').val().replace(/,/g, ''));


		if($('#type').val() == 'Promo' || $('#type').val() == 'VIP'){
			var sum = parseFloat($('#ticket-peso-total').text());
			if(sum < 0 ){
				alert('Remaining value should not be less than 0.');
				status = false;
			}
		} else{

			if(value != 0 || !remain){

				alert('Remaining face value should be 0.');
				status = false;
			}
		}
		
		return status;
	}, 

	remainingValue: function (){

		var diff = 0;
		var value = parseFloat($('#remaining-value').val().replace(/,/g, ''));
		var token = parseFloat($('#token-peso').text().replace(/,/g, ''));
		var ticket = parseFloat($('#ticket-peso-all').text().replace(/,/g, ''));

		ticket = ticket ? ticket : 0;
		token = token ? token : 0;

		var diff =  value - (token + ticket);

		diff = !diff ? '' : diff;

		$('#remaining-face-value').val(number_format(diff, 2));

	}, 

	datePicker: function (){
		$('.datepicker').datepicker();
	}, 

	calculate: function (){

		$('#token-table :input, #ticket-table :input').trigger('keyup');

	}, 

	addFgcSetup: function(){

		var tr = $('#table-clone .fgc-row').clone();

		$('#fgc-table tbody').append(tr);

		$('#fgc-table tbody .set-datepicker:last-child').datepicker();
	}, 

	removeFgcSetup: function (div){

		var tr = $(div).closest('tr');
		$(tr).remove();
	}, 

	addPromoSetup: function (){
		var tr = $('#table-clone .promo-row').clone();

		$('#promo-table tbody').append(tr);

		$('#promo-table tbody .set-datepicker:last-child').datepicker();
	}, 

	promoSubmit: function(form){

		$('#promo-form').submit(function(){

			var codes = [];
			var val = null;
			var status  = true;

			$('#promo-table tbody td input.promo-code').each(function(){

				val = $(this).val();

				if(in_array(val, codes)){

					alert(val + ' not unique');

					status = false;
					return false;

				} else{
					codes.push(val);
				}
				
			});

			return status;

		});	
	}, 

	promoType: function (){

		var data = {
			type: $('#types').val(),
			promo_type: $('#promo-type').val()
		}

		location.href = window.location.href.split('?')[0] + '?' + $.param(data);

		// $.ajax({
		// 	type: 'post', 
		// 	dataType: 'json', 
		// 	url: base_url + 'app/sales-operation/token/get_promo_type',
		// 	data: {
		// 		type: $('#promo-type').val(),
		// 	}, 

		// 	success: function (data){

		// 		$(data.item).insertBefore('#token-table #tr-total');
		// 		token.types();
		// 		$('#token-table tbody tr[data-token-id=' + data.id_code +  ']').show();
		// 	}
		// });	
	}, 

	vip: function (){

		if($('#is-vip').is(':checked')){
			$('#vip-card-no').prop('disabled', false);
		} else{
			$('#vip-card-no').prop('disabled', true);
		}
	}
}

$(document).ready(function(){
	token.init();
});

