<div class="panel">
  <div class="panel-heading">
    <h5 class="panel-title"><?=$title?></h5>
  </div>
  <div class="panel-body">
    <div id="data-container" class="container-fluid">
     <form id="prepaid-expense-details-form" class="form-horizontal row page-form" role="form" class="container-fluid">
       <span class="col-md-6">      
            <div class="form-group">
                <label for="sel1" class="control-label col-xs-5">Comment:</label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" id="" maxlength="250" value="<?=$data['AMPD_Comment']?>" tabindex="1"  name="AMPD_Comment" placeholder="Comment">
                </div>
            </div>
          </span>   
      </form>
      <hr>
      <div class="btn-cont">
        <a type="button" tabindex="2" data-lineid="<?= $data['mid']; ?>" data-docid="<?=$data['id']?>" id="update-det" href="javascript:void(0)" class="btn btn-default form-btn main-clr">
          Save
        </a>
        <a type="button" tabindex="3" href="<?= base_url() ?>app/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/dback/?id=<?=$data['id']?>&mid=<?=$data['mid']?>" class="btn btn-default form-btn sub-clr">
           Cancel
        </a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
   $(document).on("click","#update-det",function(){
      var $btn = $(this);
      var $lbl = $btn.text();
      form = $('#prepaid-expense-details-form');
      data = form.serializeArray();
      data.push({name:"type",value:'update-details'},
              {name:"uniqid",value:$(this).data('lineid')},
              {name:"uniqfid",value:$(this).data('docid')});
      $(form).find('input[type=checkbox]').each(function() {
        data.push({ name: this.name, value: this.checked ? 1 : 0 });
      });     
      confirm("Save Entry?", function(confirmed) {
          if(confirmed){ 
          $btn.attr('disabled',true).text('Processing..');
          $.post(base_url+'app/'+ _module + "/" +_class+'/process',data,function(data){
           
            if(data.result == 0){
              error_message(data.errors);
            $btn.attr('disabled',false).text($lbl);
            }else{
              alert('Saved!');
              window.location = base_url+'app/'+_module+'/'+_class+'/view/?id='+$btn.data('docid');
            }
          },'json').error(function(){
            alert('Error!');
            $btn.attr('disabled',false).text($lbl);
          });
        }
      });
    });
  $select = $('.select-cli').each(function(index, obj){
                $(this).selectize({
                  sortField: 'text',
                  plugins: {
            'dropdown_header': {
              title: $(obj).attr('placeholder')
            }
          }
                });
              });

  check_if_changed($('#prepaid-expense-details-form'),$('#update-det'));

</script>