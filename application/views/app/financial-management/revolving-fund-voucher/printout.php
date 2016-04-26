<style type="text/css">
	table {
	    padding: 5px;
	}
	table tr td:first{
		text-align: right;
	}
</style>
<div>
	<br>
	<table>
		<tr>
			<td>Document No.</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DocDate']?></td>
		</tr>
		<tr>
			<td>Document No.</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DocDate']?></td>
		</tr>
		<tr>
			<td>Supplier ID:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_SupplierID']?></td>
			<td>Supplier Name:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_SupplierName']?></td>
		</tr>
		<tr>
			<td>Supplier Address:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_Address']?></td>
			<td>Payment Terms:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_PaymentTerms']?></td>
		</tr>
		<tr>
			<td>Date Required:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DateRequired']?></td>
			<td>Due Date:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_DueDate']?></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_Amount']?></td>
			<td>Amount LCY:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_AmountLCY']?></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_Status']?></td>
			<td>Currency:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_Currency']?></td>
		</tr>
		<tr>
			<td>Reason:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_Reason']?></td>
			<td>Ext Doc No.:</td>
			<td>&nbsp;&nbsp;<?=$header['RPH_ExtDocNo']?></td>
		</tr>
	</table>
    <br>
    <hr>
    <br>
    <b>Details</b>
    <br>
    <table>
        <thead>
            <tr>
                <td>Item Type</td>
                <td>Item No</td>
                <td>Description</td>
                <td>Qty</td>
                <td>Unit Price</td>
                <td>Amount</td>
            </tr>
        </thead>
        <?php foreach ($detail["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["RPD_ItemType"] ?></td>
                <td><?= $detail["RPD_ItemNo"] ?></td>
                <td><?= $detail["RPD_ItemDescription"] ?></td>
                <td><?= $detail["RPD_Qty"] ?></td>
                <td><?= $detail["RPD_UnitPrice"] ?></td>
                <td><?= $detail["RPD_Amount"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<!-- 
	    <div class="form-group">
	      <label class="control-label col-xs-5" for="">JO Reference:</label>
	      <div class="col-xs-7">
	      	<label class="control-label"><?=$header['RPH_JORefNo']?></label>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-xs-5" for="">JO Ammount:</label>
	      <div class="col-xs-7">
	      	<label class="control-label"><?=$header['RPH_JOAmount']?></label>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-xs-5" for="">Location:</label>
	      <div class="col-xs-7">
	      	<label class="control-label"><?=$header['RPH_Location']?></label>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-xs-5" for="">Company:</label>
	      <div class="col-xs-7">
	      	<label class="control-label"><?=$header['RPH_Company']?></label>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-xs-5" for="">Remarks:</label>
	      <div class="col-xs-7">
	      	<label class="control-label"><?=$header['RPH_Remarks']?></label>
	      </div>
	    </div>
	</span>
</div> -->