

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

								<select class="form-control single-default" id="" placeholder="Branch" name="DI_Location" tabindex="3">
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
		                    <input type="text" class="form-control periodPicker" id="period" tabindex="3" name="DI_Period" placeholder="Period">                    
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
			<span class="col-md-6"> 
			<!-- class = "grid table fixing the sizeview of grid -->
			<div id="tblINV-Machine" class="grid-table"> 
			</div>
			</span>

			
			<span class="col-md-6"> 
				<div class="tab_wrap">
					<!-- create two tabs. Add active class for the first, so it will be the active tab onload. -->
					<div class="tabs">
					    <ul>
					        <li><a name="tab" id="tab_1" href="javascript:void(0)" onClick="tabs(1)" class="active">Popular</a></li>
					        <li><a name="tab" id="tab_2" href="javascript:void(0)" onClick="tabs(2)">Recent</a></li>
					    </ul>
					</div>
					<!-- create two tabs. Add active class for the first, so it will be the active tab onload. -->

					<!-- create the content divs for the tabs. -->
					<div name="tab_content" id="tab_content_1" class="tab_content active">
					    <ul>
					        <li><a href="#">HTML Techniques<br /><small>2012 10 12</small></a></li>
					        <li><a href="#">HTML Techniques<br /><small>2012 10 12</small></a></li>
					        <li><a href="#">HTML Techniques<br /><small>2012 10 12</small></a></li>
					 		
					    </ul>
					</div>
					<div name="tab_content" id="tab_content_2" class="tab_content">
					    <ul>
					        <li><a href="#">2HTML Techniques<br /><small>2012 10 12</small></a></li>
					        <li><a href="#">2HTML Techniques<br /><small>2012 10 12</small></a></li>
					        </li>
					    </ul>
					</div>
					<!-- create the content divs for the tabs. -->
				</div>
			</span>
			<hr>
			<hr>
			<div class="btn-cont">
				<a type="button" tabindex="16" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="17" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
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



	$(document).ready(function() {
		initializeView();
		initializeMachinesTable();
	});


	function initializeView() {
	 	// branch	 	
	  	if($('select[name=DI_Location]').length > 0) {	  			  		
			$loc = $('select[name=DI_Location]').selectize({
				sortField: 'text',					
				onChange: function(value) {																	
					loadMachines(value);
				}			
			});
		}

		if($('select[name=DI_WeekNo]').length > 0) {
			$loc = $('select[name=DI_WeekNo]').selectize();
		}
	}

	function initializeMachinesTable(){		
		grid  = $('#tblINV-Machine').gridEntry({	
		    add:false,
		    gridConfig:{
		      minSpareRows:0,		      
		        colHeaders:[  
				            "Location",
				            "Machine Tag",
				            "Description",	
		                   ],
		        columns: [
		        		{
		                    data: "MC_Location",
		                    readOnly:true	
		                }, 
		                {
		                	data: "MC_MachineTag",
		                    readOnly:true		                    
		                }, 
		                {
		                    data: "MC_MachineTag",
		                    readOnly:true
		                }
		                ],
		    }
		});

	}


	function loadMachines(branch) {
		var url = "http://localhost/wof/app/sales-operation/dispensed-redemption-tickets/machine?location=" + branch;				
		console.log(url);		
		$.get(url, function (machines) {			
			machines = JSON.parse(machines);
			console.log(machines);
			grid.loadData(machines);
			
		})
	}

	function tabs(selectedtab) {    
	    // contents
	    var s_tab_content = "tab_content_" + selectedtab;   
	    var contents = document.getElementsByTagName("div");
	    for(var x=0; x<contents.length; x++) {
	        name = contents[x].getAttribute("name");
	        if (name == 'tab_content') {
	            if (contents[x].id == s_tab_content) {
	            contents[x].style.display = "block";                        
	            } else {
	            contents[x].style.display = "none";
	            }
	        }
	    }   
	    // tabs
	    var s_tab = "tab_" + selectedtab;       
	    var tabs = document.getElementsByTagName("a");
	    for(var x=0; x<tabs.length; x++) {
	        name = tabs[x].getAttribute("name");
	        if (name == 'tab') {
	            if (tabs[x].id == s_tab) {
	            tabs[x].className = "active";                       
	            } else {
	            tabs[x].className = "";
	            }
	        }
	    }     
	}

})();


</script>			