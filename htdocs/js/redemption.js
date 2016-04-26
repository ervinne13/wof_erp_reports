var r, redemption = {

	settings: {
		lowPoint: 0
	},

	init: function (){

		r = redemption.settings;

		redemption.tab();
		redemption.listeners();

		if($("#item-type").val() == 'low_point')
			r.lowPoint = 1;

	}, 

	listeners: function (){
		redemption.ticketListen();
		redemption.redeemListen();
		redemption.calculate();
		redemption.searchListen();
		redemption.tabListen();
	},

	tab: function (){

		$('.nav-tabs[role=tablist] li a').click(function(){
			$(this).tab('show');
		});

	}, 

	trash: function (div){

		$(div).closest('tr').remove();
		redemption.listeners();

		if(r.lowPoint == 1)
			redemption.deleteLP(div);

		$('#add-ticket').text('Add');
		$('#add-ticket-form').trigger('reset');

	}, 

	edit: function (div){

		var tr = $(div).closest('tr');

		$('#item-desc').val($(tr).attr('data-desc'));
		$('#item-code').val($(tr).attr('data-code'));
		$('#item-points').val($(tr).attr('data-points'));
		$('#item-hash').val($(tr).attr('data-hash'));
		$('#item-qty').val($(tr).attr('data-quantity')).removeClass('disabled').prop('disabled', false);

		$('#add-ticket').text('Edit').removeClass('disabled').prop('disabled', false);

	}, 

	ticketCount: function (){

		var count = $('#ticket-count').val() != '' ? parseFloat($('#ticket-count').val()) : '';
		var sum = parseFloat($('#ticket-count-field').val());
		
		sum = sum ? sum : 0;
		count += sum;

		$('#ticket-count-field').val(count);
		$('#ticket-count').val('');

		redemption.listeners();

	}, 

	searchItem: function (){
		$('#coupon-popup form').trigger('reset');
		$('#coupon-popup table tbody').empty();
		$('#coupon-popup').modal('show');
		$('#add-ticket').text('Add');
	}, 

	goSearch: function (){

		var codes = [];

		$('#coupon-popup table tbody').empty();

		$('#item-table tbody tr').each(function(){
			codes.push($(this).attr('data-code'));
		});

		

		$.ajax({
			type: 'post', 
			dataType: 'json', 
			url: base_url + 'app/sales-operation/ticket-redemption/search', 
			data: {
				description: $('#item-description').val(), 
				quantity: $('#remaining-points').val(), 
				low_point: r.lowPoint,
				item_codes: codes
			},
			success: function (data){

				$(data.items).each(function(i, v){

					$('#coupon-popup table tbody').append(v);

				});
			}
		});

	}, 

	chooseItem: function (div){

		var id = $(div).attr('data-id');
		var desc = $(div).attr('data-desc');
		var points = $(div).attr('data-points');

		$('#item-code').val(id).trigger('change');
		$('#item-desc').val(desc);
		$('#item-qty').val(1);
		$('#item-points').val(points);

		$('#coupon-popup').modal('hide');

		redemption.listeners();

	}, 

	ticketListen: function(){
		
		if($('#item-code').val() == ''){
			$('#add-ticket, #item-qty').addClass('disabled').prop('disabled', true);
		} else{
			$('#add-ticket, #item-qty').removeClass('disabled').prop('disabled', false);
		}
	}, 

	addTicket: function (){

		if(!redemption.validateQty()) return false;

		$.ajax({
			type: 'post',
			dataType: 'json', 
			url: base_url + 'app/sales-operation/ticket-redemption/add_ticket',
			data: {
				item_no: $('#item-code').val(),
				quantity: $('#item-qty').val(), 
				hash: $('#item-hash').val(), 
				doc_no: $('#doc-no').val(),
				date: $('#doc-date').val(),
				branch: $('#doc-branch').val(),
				points: $('#item-points').val(),
				low_point: r.lowPoint
			},
			success: function (data){

				if(data.edit_hash){

					$(data.items).insertAfter('tr[data-hash=' + data.edit_hash + ']');
					$('#item-table tbody tr[data-hash=' + data.edit_hash + ']').remove();

				} else{

					$('#item-table tbody').append(data.items);

				}

				$('#add-ticket-form').trigger('reset');
				$('#add-ticket').text('Add');

				redemption.listeners();

			}
		});	
	}, 

	validate: function (){

		var status = true;

		if($('#ticket-count-field').val() == ''){
			status = false;
			alert('No ticket quantity.');
		}

		return status;
	},

	validateQty: function (){

		var status = true;
		var total = parseFloat($('#item-qty').val()) * parseFloat($('#item-points').val());
		var remaining = parseFloat($('#remaining-points').val());

		// if($('#item-type').val() == 'low_point' && remaining - total < 0){
		// 	status = false;

		// 	alert('Low ticket quantity.');
		// }

		return status;
	},

	calculate: function (){
		redemption.totalPoints();
		redemption.remainingPoints();
	},

	totalPoints: function (){

		var points = 0;

		$('#item-table td[data-total]').each(function(){
			points += parseFloat($(this).attr('data-total'));
		});

		$('#total-points').val(points);
	}, 

	remainingPoints: function (){
		var points = parseFloat($('#ticket-count-field').val()) - parseFloat($('#total-points').val());

		if(!points)
			points = 0;

		$('#remaining-points').val(points);
	}, 

	redeemListen: function (){
		if($('#item-table tbody tr').length == 0)
			$('.act-btn').addClass('disabled').prop('disabled', true);
		else
			$('.act-btn').removeClass('disabled').prop('disabled', false);

	}, 

	searchListen: function (){
		// if($('#remaining-points').val() > 0)
		// 	$('#search-item').removeClass('disabled').attr('disabled', false);
		// else
		// 	$('#search-item').addClass('disabled').attr('disabled', true);

	}, 

	cancel: function (){
		$('#item-table tbody').empty();
		$('#add-ticket-form').trigger('reset');
		$('#ticket-count-form').trigger('reset');
		$('#ticket-count-field').val('');

		redemption.listeners();
	}, 

	redeem: function (){

		if(!redemption.validateQty()) return false;
		if(!redemption.validate()) return false;

		$('.act-btn').addClass('disabled').prop('disabled', true);

		var data = {};

		data.doc_no = $('#doc-no').val();
		data.date = $('#doc-date').val();
		data.branch = $('#doc-branch').val();
		data.quantity = $('#ticket-count-field').val();
		data.items = [];
		data.item_type = $('#item-type').val();

		$('#item-table tbody tr').each(function(){
			item = {
				item_no: $(this).attr('data-code'),
				desc: $(this).attr('data-desc'),
				quantity: $(this).attr('data-quantity'),
				points: $(this).attr('data-points'), 
				total_points: $(this).attr('data-total-points'), 
				item_type: $('#item-type').val()
			}

			data.items.push(item);

		});

		$.ajax({
			type: 'post', 
			data: data,
			url: base_url + 'app/sales-operation/ticket-redemption/redeem',
			success: function(data){
				alert('Successfully redeemed tickets.');

				setTimeout(function(){
					location.reload();
				}, 1000);
			}
		});
	}, 

	lowPoint: function(){
		r.lowPoint = 1;
		redemption.cancel();
		$('.act-btn').hide();
		$('#search-item').removeClass('disabled').prop('disabled', false);
	}, 

	goodCoupon: function (){
		r.lowPoint = 0;
		redemption.cancel();
		$('.act-btn').show();
	}, 

	tabListen: function (){

		if(r.lowPoint == 1){
			$('#search-item').removeClass('disabled').prop('disabled', false);
		}
	}, 

	deleteLP: function (div){

		var tr = $(div).closest('tr');

		$.ajax({
			type: 'post', 
			dataType: 'json', 
			url: base_url + 'app/sales-operation/ticket-redemption/delete_lp',
			data: {
				doc_no: $('#doc-no').val(),
				item_code: $(tr).attr('data-code')
			},

			success: function (data){

				$(tr).remove();
			}

		});
	}, 

	voidModal: function (){

		$('#redemption-list table tbody').empty();

		$.ajax({
			type: 'post',
			dataType: 'json', 
			url: base_url + 'app/sales-operation/ticket-redemption/items',
			success: function(data){
				
				$(data.items).each(function(i, v){
					$('#redemption-list table tbody').append(v);
				});
			}
		});

		$('#redemption-list').modal('show');
	}, 

	voidCheck: function(){

		if($('#redemption-list table tbody .void-check:checked').length > 0){
			$('#void-btn').removeClass('disabled').prop('disabled', false);
		} else{
			$('#void-btn').addClass('disabled').prop('disabled', true);
		}
	}, 

	voidTickets: function (){

		var data = {};
		data.doc_nos = [];

		$('#redemption-list table tbody .void-check:checked').each(function(i, v){
			data.doc_nos.push($(this).val());
		});

		$.ajax({
			type: 'post', 
			data: data, 
			url: base_url + 'app/sales-operation/ticket-redemption/void_tickets',
			success: function (data){
				$('#redemption-list').modal('hide');
				alert('Successfully voided tickets.');
			}
		});
	}, 

	searchDocNo: function (){
		$('#redemption-list table tbody').empty();
		redemption.voidCheck();

		$.ajax({
			type: 'post', 
			dataType: 'json', 
			data: {
				doc_no: $('#search-doc-no').val()
			},
			url: base_url + 'app/sales-operation/ticket-redemption/search_void',
			success: function (data){
				$(data.items).each(function(i, v){
					$('#redemption-list table tbody').append(v);
				});
			}

		});
	}, 

	clearTicket: function (){
		$('#add-ticket').text('Add');
	}

}

$(document).ready(function(){
	redemption.init();
});