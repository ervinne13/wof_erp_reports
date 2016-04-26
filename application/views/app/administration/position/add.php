<div class="panel">
	<div class="panel-heading">
		<h5 class="panel-title"><?=$title?></h5>
	</div>
	<div class="panel-body">
		<div id="data-container" class="container-fluid">
			<form id="position-form" class="form-horizontal row page-form" role="form" class="container-fluid">
				<span class="col-md-6">
			    <div class="form-group">
			      <label class="control-label col-xs-5" for="">Position:</label>
			      <div class="col-xs-7">
			        <input type="text" class="form-control" id="" tabindex="2" maxlength="255" name="P_Position" placeholder="Position">
			      </div>
			    </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Position Type:</label>
            <div class="col-xs-7">
              <select class="form-control single-default" id="" placeholder="Position Type" name="P_Type" tabindex="2">
                <option value="" disabled selected>Position Type</option>
                <?php foreach(static_lookup('position_group') as $key => $value){ ?>
                  <option value="<?= $key ?>" ><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="sel1" class="control-label col-xs-5">Parent:</label>
            <div class="col-xs-7">
              <select class="form-control single-default" id="" placeholder="Parent" name="P_Parent" tabindex="2">
                <option value="" disabled selected>Parent</option>
              </select>
            </div>
          </div>
				</span>
			</form>
			<div class="btn-cont">
				<a type="button" tabindex="3" id="save-new" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & New
				</a>
				<a type="button" tabindex="4" id="save-close"  href="javascript:void(0)" class="btn btn-default form-btn main-clr">
				  Save & Close
				</a>
				<a type="button" tabindex="5" href="<?= base_url() ?>app/administration/position" class="btn btn-default form-btn sub-clr">
				   Cancel
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    
 var position_type,$position_type,parent,$parent,xhr;
  
 $position_type = $('select[name=P_Type]').selectize({
      plugins: {
      'dropdown_header': {
        title: 'Position Type'
      }
    },
      onChange: function(value) {
          if (!value.length){
            parent.clearOptions();
            parent.disable();
          }else{
            parent.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    dataType:'json',
                    data:{
                      q:value
                    },
                    url: base_url+'app/ajaxes/get_position_per_type' ,
                    success: function(results) {
                      if(results){
                        parent.clearOptions();
                        parent.enable();
                        callback(results);
                      }
                    },
                    error: function() {
                        callback();
                    }
                });
            });
          }
      }
  });

 $parent = $('select[name=P_Parent]').selectize({
        valueField: 'P_Position_id',
        labelField: 'P_Position',
        searchField: ['P_Position_id','P_Position'],
        plugins: {
        'dropdown_header': {
          title: 'Parent'
          },
        },
        render: {
                    option: function(item, escape) {
                      return '<div class="sel-dropdown">' +
                                    '<span class="id"><label>Position ID:</label>' + escape(item.P_Position_id) + '</span>' +
                                    '<span class="name"><label>Position:</label>' + escape(item.P_Position) + '</span>' +
                                '</div>';
                    }
                },
              
  });

 position_type  = $position_type[0].selectize;
 parent         = $parent[0].selectize;
 
 parent.disable();
 
  $("#save-new").on("click",function(){
    var $btn = $(this);
    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        
        $btn.attr('disabled',true).text('Processing..');
        form = $('#'+_class+"-form");
        data = form.serializeArray();
        data.push({name:"type",value:'add'});
        $(form).find('input[type=checkbox]').each(function() {
           data.push({ name: this.name, value: this.checked ? 1 : 0 });
         });

        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          }else{
            $('.form-group').removeClass('has-error').find('div:first .alert').remove();
            form[0].reset();
            alert('Saved!');
          }
          $btn.attr('disabled',false).text('Save & New');
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & New');
        });
      }
    });
  });

  $("#save-close").on("click",function(){
    var $btn = $(this);
    form = $('#'+_class+"-form");
    data = form.serializeArray();
    data.push({name:"type",value:'add'});
    $(form).find('input[type=checkbox]').each(function() {
      data.push({ name: this.name, value: this.checked ? 1 : 0 });
    });

    confirm("Save Entry?", function(confirmed) {
        if(confirmed){ 
        $btn.attr('disabled',true).text('Processing..');
        $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
          if(data.result == 0){
            error_message(data.errors);
          $btn.attr('disabled',false).text('Save & Close');
          }else{
            alert('Saved!');
            window.location = base_url+'app/administration/'+_class;
          }
        },'json').error(function(){
          alert('Error!');
          $btn.attr('disabled',false).text('Save & Close');
        });
      }
    });
  });
 
</script>
