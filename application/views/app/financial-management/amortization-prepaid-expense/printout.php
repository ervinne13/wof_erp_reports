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
			<td>&nbsp;&nbsp;<?=$header['AMPH_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_DocDate']?></td>
		</tr>
		<tr>
			<td>Ref DocNo:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_RefDocNo']?></td>
			<td>Amortization Type:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_AmortType']?></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_AmortAmount']?></td>
			<td>Remaining Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_RemAmount']?></td>
		</tr>
		<tr>
			<td>Remarks:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_Remarks']?></td>
			<td>Cost Center:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_CostCenter']?></td>
		</tr>
		<tr>
			<td>Period:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_Period']?></td>
			<td>No of Payments:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_NoOfPayment']?></td>
		</tr>
		<tr>
			<td>Starting Date:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_StartingDate']?></td>
			<td>Status:</td>
			<td>&nbsp;&nbsp;<?=$header['AMPH_Status']?></td>
		</tr>
	</table>
	<br>
    <hr>
    <br><br>
    <b>Details</b>
    <br><br>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>Description</td>
                <td>Amount</td>
                <td>Cost Center</td>
                <td>Comment</td>
            </tr>
        </thead>
        <?php foreach ($detail["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["AMPD_Date"] ?></td>
                <td><?= $detail["AMPD_Description"] ?></td>
                <td><?= $detail["AMPD_Amount"] ?></td>
                <td><?= $detail["AMPD_CPC"] ?></td>
                <td><?= $detail["AMPD_Comment"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>