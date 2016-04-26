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
			<td>&nbsp;&nbsp;<?=$header['APV_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_DocDate']?></td>
		</tr>
		<tr>
			<td>Supplier ID:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_SupplierID']?></td>
			<td>Supplier Name:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_SupplierName']?></td>
		</tr>
		<tr>
			<td>Supplier Address:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_SupplierAddress']?></td>
			<td>Payment Terms:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_PaymentTerms']?></td>
		</tr>
		<tr>
			<td>Date Required:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_DateRequired']?></td>
			<td>Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_Amount']?></td>
		</tr>
		<tr>	
			<td>Amount LCY:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_AmountLCY']?></td>
			<td>Discount:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_PaymentDiscount']?></td>
		</tr>
		<tr>	
			<td>Remarks:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_Remarks']?></td>
			<td>Status:</td>
			<td>&nbsp;&nbsp;<?=$header['APV_Status']?></td>
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
                <td><?= $detail["APVD_ItemType"] ?></td>
                <td><?= $detail["APVD_ItemNo"] ?></td>
                <td><?= $detail["APVD_Description"] ?></td>
                <td><?= $detail["APVD_Qty"] ?></td>
                <td><?= $detail["APVD_UnitPrice"] ?></td>
                <td><?= $detail["APVD_Amount"] ?></td>
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