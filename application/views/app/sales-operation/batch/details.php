<form action="<?=site_url('app/sales-operation/batch/save_details/' . $item['BA_DocNo']);?>" class="form form-horizontal" method="post" id="save-details">

    <div class="allocate clearfix">
        
        <div class="col-md-6">

            <div class="form-group">
                <div class="col-md-3 control-label">Doc No.:</div>
                <div class="col-md-7">
                    <input type="text" name="BA_DocNo" class="form-control" value="<?=$item['BA_DocNo'];?>" readonly>
                    <?php if (isset($item['new'])): ?>
                        <input type="hidden" name="new" value="1">
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 control-label">Supplier Name:</div>
                <div class="col-md-7">
                    <select name="BA_SupplierID" id="supplier-id" class="form-control" onchange="batch.supplierName();" required>
                        <option value="">Select</option>
                        <?php foreach ($suppliers as $i => $v): ?>
                            <option value="<?=$v['S_Id'];?>" <?=$item['BA_SupplierID'] == $v['S_Id'] ? 'selected' : NULL;?>><?=$v['S_Name'];?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="hidden" id="supplier-name" name="BA_SupplierName" value="<?=$item['BA_SupplierName'];?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 control-label">Allocation For:</div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="BA_AllocationFor" value="<?=$item['BA_AllocationFor'];?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 control-label">Remarks:</div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="BA_Remarks" value="<?=$item['BA_Remarks'];?>" required>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <div class="col-md-3 control-label">Doc Date:</div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="BA_DocDate" value="<?=date('m/d/Y', strtotime($item['BA_DocDate']));?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 control-label">Region:</div>
                <div class="col-md-7">
                    <select name="BA_Region" id="" class="form-control" required>
                        <option value="">Select</option>
                        <?php foreach ($regions as $i => $v): ?>
                            <option value="<?=$v['AD_Id'];?>" <?=$item['BA_Region'] == $v['AD_Id'] ? 'selected' : NULL;?>><?=$v['AD_Desc'];?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

             <div class="form-group">
                <div class="col-md-3 control-label">Status:</div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="BA_Status" value="<?=$item['BA_Status'];?>" readonly>
                </div>
            </div>

        </div>
        
    </div>

    <table class="table table-striped table-bordered table-condensed text-center" id="table-details">
        <thead>
            <th>
                <a href="#" onclick="batch.addDetail();">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </th>
            <th>Item Type</th>
            <th>Item No</th>
            <th>Item Description</th>
            <th>Image</th>
            <th class="col-md-2">Unit Price</th>
            <th>UOM</th>
            <th>Suggested Qty</th>
            <th>Approved Qty</th>
        </thead>
        
        <tbody>
            <?php foreach ($details as $i => $v): ?>
                <?php $dt['v'] = $v;?>
                <?=$this->load->view('app/sales-operation/batch/detail_item', $dt, TRUE);?>
            <?php endforeach ?>
            
        </tbody>
    </table>

    <button class="btn btn-default form-btn main-clr" type="submit">Save</button>
    <a href="<?=site_url('app/sales-operation/batch');?>" class="btn btn-default form-btn sub-clr">Cancel</a>


</form>
<table id="clone-table" class="hide">
    <tbody>
        <?php $info['v'] = $empty_details; ?>
        <?=$this->load->view('app/sales-operation/batch/detail_item', $info, TRUE);?>
    </tbody>
</table>
