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
            <td>&nbsp;&nbsp;<?= $header['CRJ_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Customer ID.</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_CustomerID'] ?></td>
            <td>Amount</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_Amount'] ?></td>            
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_CustomerName'] ?></td>
            <td>Location / Store</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_Location'] ?></td>
        </tr>
        <tr>
            <td>External Doc. No.</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_ExtDocNo'] ?></td>
            <td>Status</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_Status'] ?></td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>&nbsp;&nbsp;<?= $header['CRJ_Remarks'] ?></td>
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
                <td>Applies to Doc Type</td>
                <td>Applied Amount</td>
                <td>Rem. Amount</td>
                <td>Comment</td>
            </tr>
        </thead>
        <?php foreach ($details["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["CRJD_AppliesToDocType"] ?></td>
                <td><?= $detail["CRJD_AppliedAmount"] ?></td>
                <td><?= $detail["CRJD_RemAmount"] ?></td>
                <td><?= $detail["CRJD_Comment"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

