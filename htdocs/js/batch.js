var batch = {

	init: function (){
		// batch.selectItems();
	}, 

	supplierName: function (){

		var name = $('#supplier-id option:selected').text();
		$('#supplier-name').val(name);
	},

	selectItems: function (){

		$('select').select2();
	}, 

	itemNo: function (div){

		var value = $(div).val();
		var tr = $(div).closest('tr');

		$('[data-name=desc] option[data-item-id=' +  value + ']', tr).prop('selected', true);

		batch.uom(div);
	}, 

	description: function(div){
		var value = $(div).val();
		var tr = $(div).closest('tr');

		var item_no = $('option:selected', div).attr('data-item-id');

		$('[data-name=item-no]', tr).val(item_no);

		batch.uom(div);

	}, 

	editItem: function (div){

		var action = $('[data-name=action]', div).val();

		if(action != 'add')
			$('[data-name=action]', div).val('edit');

	}, 

	deleteItem: function (div){
		var tr = $(div).closest('tr');

		setTimeout(function(){
			$('[data-name=action]', tr).val('delete');
		}, 100);

		$(tr).hide();
	}, 

	addDetail: function (){

		var clone = $('#clone-table tr').clone();

		$('#table-details tbody').append(clone);
	}, 

	uom: function(div){

		var tr = $(div).closest('tr');
		var uom = $('[data-name=item-no] option:selected', tr).attr('data-uom');

		$('[data-name=uom]', tr).val(uom);
		$('.td-uom', tr).text(uom);
	}

}

$(document).ready(function(){
	batch.init();
});