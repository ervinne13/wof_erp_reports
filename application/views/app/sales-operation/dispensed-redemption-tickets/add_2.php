

<div class="panel">
  	<div class="panel-heading">
      	<h3 class="panel-title">
          	<?=$title?>          	
        </h3>
  	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="<?=$this->uri->segment(3)?>-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
					<!-- DOC. NO -->
					<div class="form-group">
					  <label for="sel1" class="control-label col-xs-5">Doc. No.:</label>
					  <div class="col-xs-7">
				        <input type="text" class="form-control" disabled id="" tabindex="1" name="DI_DocNo" placeholder="Document No.">
				      </div>
					</div>		

					<!-- BRANCH -->					
					 <div class="form-group">
						<label class="control-label col-xs-5" for="">Branch:</label>
							<div class="col-xs-7">

								<select class="form-control single-default" id="branch" placeholder="Branch" name="DI_Location" tabindex="3">
								  	<option value="" disabled selected>Branch</option>
								  	<?php if(!empty($branch['data'])){
										foreach ($branch['data'] as $key => $value) 											
									{
								  	?>
								  	<!-- auto fill the dropdownbox the default location -->								  	
								  	<option value="<?=$value['SP_StoreID']?>" 								  	
									  	<?=$this->session->userdata('dlocation')['SP_StoreID'] == ($value['SP_StoreID']) ? 'selected' : '' ?> ><?=$value['SP_StoreName']?></option>									
								  	<?php }} ?>
									  	
								</select>
							</div>
				    </div>


				    <!-- PERIOD -->
		            <div class="form-group">
		                <label for="sel1" class="control-label col-xs-5">Period:</label>
		                <div class="col-md-7">
		                    <input type="text" class="form-control periodPicker" id="period" tabindex="3" value="<?=date('M Y')?>" name="DI_Period" placeholder="Period">                    
		                </div>
		            </div>



		           <!-- WEEK NO -->
		            <div class="form-group">
		            	<label for="sel1" class="control-label col-xs-5">Week No:</label>
			            <div class="col-md-7">					  
						  <select type="text" class="form-control weekselect" id="" name="DI_WeekNo" data-type='filterbyWeek' tabindex="4" placeholder="Week">
						    <option value="">
						      <h5>Select Week</h5>
						    </option>
						    <option value="1">
						      <h5>Week 1</h5>
						    </option>
						    <option value="2">
						      <h5>Week 2</h5>
						    </option>
						    <option value="3">
						      <h5>Week 3</h5>
						    </option>
						    <option value="4">
						      <h5>Week 4</h5>
						    </option>
						  </select>
						 </div>
					</div>


					</span>


					<span class="col-md-6"> 



					<!--DOC DATE  -->
			          <div class="form-group">
			            <label for="sel1" class="control-label col-xs-5">Doc. Date:</label>
			              <div class="col-xs-7">
			                <input type="text" class="form-control" id="" maxlength="30" readonly value="<?=date("m/d/Y",time())?>" disabled name="DI_DocDate" placeholder="Document Date">
			              </div>
			          </div>

			          					<!-- RETRIEVAL DATE -->
		            <div class="form-group">
		              <label for="sel1" class="control-label col-xs-5">Retrival Date:</label>
		              <div class="col-xs-7">
		                <input type="text" class="form-control retDate" id="retDate" maxlength="30" tabindex="2"  value="<?=date("m/d/Y",time())?>" name="Retdate" placeholder="Retrival Date">
		              </div>
					</div>

			          <!-- COMPANY -->
			         <div class="form-group">
					     <label class="control-label col-xs-5" for="">Company:</label>
					     <div class="col-xs-7">
					       <input type="text" class="form-control" id="com_id" readonly value="<?=count($location) == 1 ? $location[0]['COM_Name']: $dcompany ?>" name="DI_Company" placeholder="Company">
					     </div>
					 </div>

					  <!-- STATUS -->
				    <div class="form-group">
				      <label class="control-label col-xs-5" for="">Status:</label>
				      <div class="col-xs-7">
				        <input type="text" class="form-control" readonly id="status"  value="" data-id="" name="DI_Status" placeholder="Status">
				      </div>
				    </div>	
					</span>

			</form>
			<hr>

			<!-- MACHINE GRID -->
			<span class="col-md-6"> 
			<!-- class = "grid table fixing the sizeview of grid -->
			<div id="tblINV-Machine" class="grid-table"> 

			</div>
			</span>
			<!-- MACHINE GRID -->

		<!-- tab -->

			<span class="col-md-6"> 				
				<div id="tabs-container">
					<!-- create two tabs. Add active class for the first, so it will be the active tab onload. -->
				    <ul class="tabs-menu">
				        <li class="current"><a href="#tab-1">Dispensed Ticket</a></li>
				        <li><a href="#tab-2">PD Items Count</a></li>
				    </ul>
				    <!-- create two tabs. Add active class for the first, so it will be the active tab onload. -->

				    <!-- create the content divs for the tabs. -->
				    <div class="tab">
				    	<!-- TAB 1 DISPENSED TICKET -->
				        <div id="tab-1" class="tab-content">
				        <p></p>
				            <label class="control-label col-xs-6" name="Item_Desc">  Item </label>
				            <div>				     
					            <div id="tblINV-Dispense-Tickets" class="grid-table"> 
							    </div>
							  </div>
				        </div>
				        <!-- TAB 1 DISPENSED TICKET -->

				        <!-- TAB 2 PD ITEMS -->
				        <div id="tab-2" class="tab-content">
				        	<p></p>
				            <label class="control-label col-xs-6">  Item </label>				            
				            <div id="tblINV_Dispensed_PDItems" class="grid-table"> 
						    </div> 			        
				        </div>				   
				        <!-- TAB 2 PD ITEMS -->     
				    </div>
				    <!-- create the content divs for the tabs. -->
				</div>
			</span>
			<!-- tab -->

	
			<hr>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="16" id="save" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save
				</a>
				<a type="button" tabindex="17" id="save-next"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Next
				</a>
				<a type="button" tabindex="18" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div> 
		</div>
	</div>
</div>

<script type="text/javascript"> 


(function() {

	var loc,$loc;
	var grid;
	var $itemdesc;
	var $week;

	var TotalQtyIssued = 'GetQtyIssued';
	GetQtyIssued = 

	var refdata = <?=json_encode($machinedet['data']);?>;
	var branch = <?= json_encode($branch['data']) ?>;


	$(document).ready(function() {

		initializeView();
		initializeMachinesTable();
		initializeDispenseTicketsTable();		
		initializeDispensePDItemsTable();		
	});


	function initializeView() {
	 	// branch	 		
	  	if($('select[name=DI_Location]').length > 0) {	  			  		
			$loc = $('select[name=DI_Location]').selectize({
				sortField: 'text',				

				onChange: function(value) {						
					loadMachines(value)					
				}			

				// var tab_1 = {
				//     col_0: "select",
				//     public_methods: true
				// 	};
				// var tf8 = setFilterGrid("tblINV_Dispense_Tickets", tab_1);


				// var branch = {
				//     col_0: "select",
				//     col_4: "none",
				//     display_all_text: " [ Show all ] ",
				//     sort_select: true
				// };
				// var tf2 = setFilterGrid("tblINV_Dispense_Tickets", branch);


			});
		}

		// WEEK 
		if($('select[name=DI_WeekNo]').length > 0) {
			$week = $('select[name=DI_WeekNo]').selectize();
		}

	}

	// Retrieval
	function OnClickRetDate() {
	 	// branch	 		
	  	if($('select[name=DI_Location]').length > 0) {	  			  		
			$loc = $('select[name=DI_Location]').selectize({
				sortField: 'text',				

				onChange: function(value) {						
					loadMachines(value)					
				}			

				// var tab_1 = {
				//     col_0: "select",
				//     public_methods: true
				// 	};
				// var tf8 = setFilterGrid("tblINV_Dispense_Tickets", tab_1);


				// var branch = {
				//     col_0: "select",
				//     col_4: "none",
				//     display_all_text: " [ Show all ] ",
				//     sort_select: true
				// };
				// var tf2 = setFilterGrid("tblINV_Dispense_Tickets", branch);


			});
		}

		// WEEK 
		if($('select[name=DI_WeekNo]').length > 0) {
			$week = $('select[name=DI_WeekNo]').selectize();
		}

	}





    // auto date input to grid
	// function DateRetrieval (instance, td, row, col, prop, value, cellProperties,retDate) {
	// 	  		 cellProperties.readOnly = true;
	// 		   	 if(row == instance.countRows() - 1){
	// 		   	 		value=null;
	// 					Handsontable.renderers.TextRenderer.apply(this, arguments);
	// 		     }else{
	// 		  	  	  	 var date= $('#retDate').attr('value');
	// 		  	  	  	 // $('#retDate').append(date);

	// 			      	Handsontable.Dom.empty(td);
	// 			      	$(td).append(date);

	// 			  	  	return td;
	// 		  	  }
	//   }



	function initializeMachinesTable(){	
	    return $('#tblINV-Machine').gridEntry({
        tableData: <?= json_encode($machinedet['data']) ?>,	 
        // grid  = $('#tblINV-Machine').gridEntry({	  	
		    add:false,

		    gridConfig:{
		      minSpareRows:0,		      
		        colHeaders:[  
				            "Location",
				            "Classification",
				            "Machine Tag",
				            "Description",	
		                   ],
		        colWidths: [50, 50],
		        columns: [
		        		{
		                    data: "MC_Location",
		                    readOnly:true	,
		                    listeners: ['click']

		                }, 		                
		                {
		                	data: "MC_MachineClass",
		                    readOnly:true		                    
		                }, 
		                {
		                	data: "MC_MachineTag",
		                    readOnly:true		                    
		                }, 
		                {
		                    data: "IM_Sales_Desc",
		                    readOnly:true 
		                }
		                ],


		    },


		});

	}


function initializeDispenseTicketsTable(){		
		// grid  = $('#tblINV-Dispense-Tickets').gridEntry1({	
			return $('#tblINV-Dispense-Tickets').gridEntry1({
        	tableData: <?= json_encode($dispenseticket['data']) ?>,	 
		    add:false,
		    gridConfig:{
		      minSpareRows:0,		      
		        colHeaders:[  				            
				            "Deck #",
				            "BEG Issuance" ,
				            "END Issuance" ,
				            "Reading",
				            "Qty Issued",
				            "Total Remaining",	
		                   ],
		        colWidths: [0, 0],
		        columns: [
		        		{
		                	data: "MCT_DeckNo",
		                    type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true,		                   

		                }, 
		                {
		                    data: "MCT_SeriesFrom",
		                    type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:false,		                
		                },	
		                {
		                    data: "MCT_SeriesTo",
		                    type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true,		                  
		                },	               
		                

		                {
		                    data: "DIT_Reading",
		                    type: 'numeric',
		                    format: '0,0',
		                    // validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:false
		                },
		                {
		                    data: "MCT_QtyIssued",
		                    type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,

		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true
		                },
		                {
		                    data: "MCT_Remaining",
		                     type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true
		                }
		                ],
			            beforeChange: function (change, source) { 
	                        if (change !== null || source != 'loadData') {

	                            if ($.inArray(change[0][1], ['MCT_SeriesTo', 'MCT_SeriesFrom']) != -1) {
	                                var qty = this.getDataAtRowProp(change[0][0], 'CAD_Qty') || 0;
	                                var amount = this.getDataAtRowProp(change[0][0], 'CAD_Amount') || 0;
	                                previousRowTotal = qty * amount;
	                            }
	                        }
	                    },
	                    afterChange: function (change, source) {
	                        if (change !== null || source != 'loadData') {
	                            if ($.inArray(change[0][1], ['CAD_Qty', 'CAD_Amount']) != -1) {

	                                var qty = this.getDataAtRowProp(change[0][0], 'CAD_Qty') || 0;
	                                var amount = this.getDataAtRowProp(change[0][0], 'CAD_Amount') || 0;
	                                var total = qty * amount;

	                                var caAmount = $('input[name=CA_Amount]').val();
	                                if (!caAmount) {
	                                    caAmount = 0;
	                                }

	                                if (caAmount > 0) {
	                                    caAmount -= previousRowTotal;
	                                }

	                                this.setDataAtRowProp(change[0][0], 'CAD_Total', total);
	                                $('input[name=CA_Amount]').val(parseInt(caAmount) + total);
	                            }
	                        }
	                    }
		    }
		});

	}



	// function initializeDispenseTicketsTable(){		
	// 	grid  = $('#tblINV-Dispense-Tickets').gridEntry1({	
	// 	    add:true,
	// 	    gridConfig:{
	// 	      minSpareRows:0,		      
	// 	        colHeaders:[  
	// 			            "Date",
	// 			            "Deck #",
	// 			            "BEG Issuance" ,
	// 			            "END Issuance" ,
	// 			            "Reading",
	// 			            "Qty Issued",
	// 			            "Total Remaining",	
	// 	                   ],
	// 	        colWidths: [0, 0],
	// 	        columns: [
	// 	        		{
	// 	                    data: "DIT_RetrievalDate",
	// 	                    type: 'date',
	// 	                    dateFormat: 'MM/DD/YYYY',
	// 	                    strict: true,

	// 	                }, 
	// 	                {
	// 	                	data: "DIT_DeckNo",
	// 	                    type: 'numeric',
	// 	                    format: '0,0',
	// 	                    validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:false,
	// 	                    readOnly:true

	// 	                }, 
	// 	                {
	// 	                    data: "DIT_SerialFrom",
	// 	                    type: 'numeric',
	// 	                    format: '0,0',
	// 	                    validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:false,
	// 	                    readOnly:true
	// 	                },	
	// 	                {
	// 	                    data: "DIT_SerialTo",
	// 	                    type: 'numeric',
	// 	                    format: '0,0',
	// 	                    validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:false,
	// 	                    readOnly:true
	// 	                },	               
		                

	// 	                {
	// 	                    data: "DIT_Reading",
	// 	                    type: 'numeric',
	// 	                    format: '0,0',
	// 	                    // validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:false
	// 	                },
	// 	                {
	// 	                    data: "DIT_QtyIssued",
	// 	                    type: 'numeric',
	// 	                    format: '0,0',
	// 	                    validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:true
	// 	                },
	// 	                {
	// 	                    data: "DIT_Remaining",
	// 	                     type: 'numeric',
	// 	                    format: '0,0',
	// 	                    validator: requiredValidator,
	// 	                    allowInvalid:false,
	// 	                    strict: true,
	// 	                    readOnly:true
	// 	                }
	// 	                ],
	// 	            beforeChange: function (change, source) {
 //                        if (change !== null || source != 'loadData') {
 //                            if ($.inArray(change[0][1], ['CAD_Qty', 'CAD_Amount']) != -1) {
 //                                var qty = this.getDataAtRowProp(change[0][0], 'CAD_Qty') || 0;
 //                                var amount = this.getDataAtRowProp(change[0][0], 'CAD_Amount') || 0;
 //                                previousRowTotal = qty * amount;
 //                            }
 //                        }
 //                    },
	// 	    }
	// 	});

	// }




	function initializeDispensePDItemsTable(){		
		grid  = $('#tblINV_Dispensed_PDItems').gridEntry1({	
		    add:true,
		    gridConfig:{
		      minSpareRows:0,		      
		        colHeaders:[  
				            "Date",
				            "Beginning",
				            "Ending",
				            "Captured",				           	
		                   ],
		        colWidths: [0,0],
		        columns: [
		        		{
		                    data: "DIP_RetrievalDate",
		                    type: 'date',
		                    dateFormat: 'MM/DD/YYYY',
		                    strict: true,
		                    readOnly:false	
		                }, 
		                {
		                	data: "DIP_Beg",
		                	type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true,		                   	                    
		                }, 
		                {
		                    data: "DIP_End",
		                    type: 'numeric', //This will limit the value to be input numeric only
		                    format: '0,0',
		                    // validator: Handsontable.NumericValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:false,
		                    // renderer:numeric,
		                },
		                {
		                    data: "DIP_Captured",
		                    type: 'numeric',
		                    format: '0,0',
		                    validator: requiredValidator,
		                    allowInvalid:false,
		                    strict: true,
		                    readOnly:true
		                }
		                
		                ],
		            beforeChange: function (change, source) { 
                        if (change !== null || source != 'loadData') {

                            if ($.inArray(change[0][1], ['DIP_RetrievalDate', 'DIP_Beg']) != -1) {
                            	// var pddate = date("m/d/Y");
                                var pdbeg = this.getDataAtRowProp(change[0][0], 'DIP_Beg') || 0;
                                var pdend = this.getDataAtRowProp(change[0][0], 'DIP_End') || 0;
                                previousRowTotal = pdbeg * pdend;

                                // this.setDataAtRowProp(change[0][0], 'DIP_RetrievalDate', pddate);
                                this.setDataAtRowProp(change[0][0], 'DIP_Beg', pdbeg);
                            }
                        }
                    },
		            afterChange: function (change, source) {
                        if (change !== null || source != 'loadData') {
                            if ($.inArray(change[0][1], ['DIP_Beg', 'DIP_End']) != -1) {

                                var pdbeg = this.getDataAtRowProp(change[0][0], 'DIP_Beg') || 0; //pd begginning quantity
                                var pdend = this.getDataAtRowProp(change[0][0], 'DIP_End') || 0; //pd ending quantity
                                var pdcapture = pdbeg - pdend; //pd capture qty


                                this.setDataAtRowProp(change[0][0], 'DIP_Captured', pdcapture);
                                // $('input[name=DIP_End]').val(parseInt(caAmount) + total);
                            }
                        }

                    }

                                               
		    }
		});

	}



	function loadMachines(branch) {		
		// var url = "http://localhost/wof/app/sales-operation/dispensed-redemption-tickets/machine?location=" + branch;	
		var url = "<?= base_url("app/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/machine?location=" )  ?>" + branch;	
		console.log(url);		
		$.get(url, function (machines) {			
			machines = JSON.parse(machines);
			console.log(machines);
			grid.loadData(machines);

			// tableData: <?= json_encode($machinedet['data']) ?>,	   	

		})
	}


	
	$(document).ready(function() {
	    $(".tabs-menu a").click(function(event) {
	        event.preventDefault();
	        $(this).parent().addClass("current");
	        $(this).parent().siblings().removeClass("current");
	        var tab = $(this).attr("href");
	        $(".tab-content").not(tab).css("display", "none");
	        $(tab).fadeIn();
	    });
	});

	// datepicket for period date
	 $('.periodPicker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function (dateText, inst) {
            currentlySelectedMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            currentlySelectedYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(currentlySelectedYear, currentlySelectedMonth, 1));                   
        }
    });


	// Datepicker for retrival date
	$('.retDate').datepicker({
		changeMonth: true,
		changeYear: true
	});



})();


</script>			