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
            <td>&nbsp;&nbsp;<?= $header['CA_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['CA_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Employee Name</td>
            <td>&nbsp;&nbsp;<?= $header['CA_EmployeeName'] ?></td>
            <td>Date Needed From</td>
            <td>&nbsp;&nbsp;<?= $header['CA_DateFrom'] ?></td>            
        </tr>
        <tr>
            <td>Purpose</td>
            <td>&nbsp;&nbsp;<?= $header['CA_Purpose'] ?></td>
            <td>Date Needed To</td>
            <td>&nbsp;&nbsp;<?= $header['CA_DateTo'] ?></td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>&nbsp;&nbsp;<?= $header['CA_Remarks'] ?></td>
            <td>CA Amount</td>
            <td>&nbsp;&nbsp;<?= $header['CA_Amount'] ?></td>
        </tr>
        <tr>
            <td>Company</td>
            <td>&nbsp;&nbsp;<?= $header['CA_Company'] ?></td>
            <td>CA Request Status</td>
            <td>&nbsp;&nbsp;<?= $header['CA_RequestStatus'] ?></td>
        </tr>
        <tr>
            <td>Location</td>
            <td>&nbsp;&nbsp;<?= $header['CA_Location'] ?></td>
            <td>Liquidation Request Status</td>
            <td>&nbsp;&nbsp;<?= $header['CA_LiquidationStatus'] ?></td>
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
                <td>Particulars</td>
                <td>Qty / No. of Days</td>
                <td>Amount per Qty /per Day</td>
                <td>Total</td>
            </tr>
        </thead>
        <?php foreach ($details AS $detail): ?>
            <tr>
                <td><?= $detail["CAD_Particular"] ?></td>
                <td><?= $detail["CAD_Qty"] ?></td>
                <td><?= $detail["CAD_Amount"] ?></td>
                <td><?= $detail["CAD_Total"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table>
        <tr>            
            <td colspan="3"> <b>Running Total: </b></td>
            <td>&nbsp;&nbsp; <?= $header["CA_Amount"] ?></td>
        </tr>
    </table>

</div>
