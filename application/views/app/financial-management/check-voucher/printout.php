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
			<td>&nbsp;&nbsp;<?=$header['CV_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_DocDate']?></td>
		</tr>
		<tr>
			<td>Supplier ID:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_SupplierID']?></td>
			<td>Supplier Name:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_SupplierName']?></td>
		</tr>
		<tr>
			<td>Supplier Address:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_SupplierAddress']?></td>
			<td>Payment Terms:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_PaymentTerms']?></td>
		</tr>
		<tr>
			<td>Date Required:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_DateRequired']?></td>
			<td>Due Date:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_DueDate']?></td>
		</tr>
		<tr>
			<td>Ext Doc No.:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_ExtDocNo']?></td>
			<td>Bank:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_Bank']?></td>
		</tr>
		<tr>
			<td>Currency:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_Currency']?></td>
			<td>Check No.:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_CheckNo']?></td>
		</tr>
		<tr>
			<td>Check Date:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_CheckDate']?></td>
			<td>Check Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['CV_CheckAmount']?></td>
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
                <td>Ref. Doc. No.</td>
                <td>Ref. Doc. Date</td>
                <td>Amount</td>
                <td>Remarks</td>
                <td>Comment</td>
            </tr>
        </thead>
        <?php foreach ($detail["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["CVD_RefDocNo"] ?></td>
                <td><?= $detail["CVD_RefDocDate"] ?></td>
                <td><?= $detail["CVD_Amount"] ?></td>
                <td><?= $detail["CVD_Remarks"] ?></td>
                <td><?= $detail["CVD_Comment"] ?></td>
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