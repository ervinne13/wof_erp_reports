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
			<td>&nbsp;&nbsp;<?=$header['AMLH_DocNo']?></td>
			<td>Document Date:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_DocDate']?></td>
		</tr>
		<tr>
			<td>Bank Account:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_BankAccount']?></td>
			<td>Loan Amount:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_LoanAmount']?></td>
		</tr>
		<tr>
			<td>Running Balance:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_RunningBalance']?></td>
			<td>Ext. Doc No:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_ExtDocNo']?></td>
		</tr>
		<tr>
			<td>Remarks:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_Remarks']?></td>
			<td>No. of Months:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_NoOfMonths']?></td>
		</tr>
		<tr>
			<td>Annual Intereset Rate:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_AnnualInterestRate']?></td>
			<td>Company:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_Company']?></td>
		</tr>
		<tr>
			<td>Cost Center:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_CostCenter']?></td>
			<td>Status:</td>
			<td>&nbsp;&nbsp;<?=$header['AMLH_Status']?></td>
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
                <td>Payment No.</td>
                <td>Payment Date</td>
                <td>Amount</td>
                <td>Pricipal</td>
                <td>Running Balance</td>
            </tr>
        </thead>
        <?php foreach ($detail["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["AMLD_LineNo"] ?></td>
                <td><?= $detail["AMLD_PaymentDocDate"] ?></td>
                <td><?= $detail["AMLD_PaymentAmount"] ?></td>
                <td><?= $detail["AMLD_Principal"] ?></td>
                <td><?= $detail["AMLD_RunningBalance"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>