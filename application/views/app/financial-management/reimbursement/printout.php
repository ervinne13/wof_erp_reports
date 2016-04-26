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
    <b>Header</b>
    <br>
    <table>
        <tr>
            <td>Document No.</td>
            <td>&nbsp;&nbsp;<?= $header['RE_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['RE_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Employee Name</td>
            <td>&nbsp;&nbsp;<?= $header['RE_EmployeeName'] ?></td>
            <td>Company</td>
            <td>&nbsp;&nbsp;<?= $header['RE_Company'] ?></td>            
        </tr>
        <tr>
            <td>Remarks</td>
            <td>&nbsp;&nbsp;<?= $header['RE_Remarks'] ?></td>
            <td>Location</td>
            <td>&nbsp;&nbsp;<?= $header['RE_Location'] ?></td>
        </tr>
        <tr>
            <td>With Cash Advance</td>
            <td>&nbsp;&nbsp;<?= $header['RE_WithCA'] == 1 ? "Yes" : "No" ?></td>
            <td>Reimbursement</td>
            <td>&nbsp;&nbsp;<?= $header['RE_Reimbursement'] ?></td>
        </tr>
        <tr>
            <td>Ref Doc No.</td>
            <td>&nbsp;&nbsp;<?= $header['RE_RefDocNo'] ?></td>
            <td>Status</td>
            <td>&nbsp;&nbsp;<?= $header['RE_Status'] ?></td>
        </tr>
        <tr>
            <td>CA Amount</td>
            <td>&nbsp;&nbsp;<?= $header['RE_CAAmount'] ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Liquidated Amount</td>
            <td>&nbsp;&nbsp;<?= $header['RE_LiquidatedAmount'] ?></td>
            <td></td>
            <td></td>
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
                <td>Date</td>
                <td>Invoice / OR No.</td>
                <td>Payee</td>
                <td>Address</td>
                <td>TIN</td>
                <td>With VAT</td>
                <td>Particulars</td>
                <td>Amount</td>
                <td>VAT</td>
                <td>Net of Vat</td>
                <td>Charge To</td>
            </tr>
        </thead>
        <?php foreach ($details["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["RED_TransDate"] ?></td>
                <td><?= $detail["RED_InvOR"] ?></td>
                <td><?= $detail["RED_Payee"] ?></td>
                <td><?= $detail["RED_Address"] ?></td>
                <td><?= $detail["RED_TinNo"] ?></td>
                <td><?= $detail["RED_withVAT"] == 1 ? "Yes" : "No" ?></td>
                <td><?= $detail["RED_Particulars"] ?></td>
                <td><?= $detail["RED_Amount"] ?></td>
                <td><?= $detail["RED_VAT"] ?></td>
                <td><?= $detail["RED_NetOfVat"] ?></td>
                <td><?= $detail["RED_ChargeTo"] ?></td>

            </tr>
        <?php endforeach; ?>
    </table>    
</div>
