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
            <td>&nbsp;&nbsp;<?= $header['SI_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['SI_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Customer ID.</td>
            <td>&nbsp;&nbsp;<?= $header['SI_CustomerID'] ?></td>
            <td>External Doc. No.</td>
            <td>&nbsp;&nbsp;<?= $header['SI_ExtDocNo'] ?></td>            
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>&nbsp;&nbsp;<?= $header['SI_CustomerName'] ?></td>
            <td>Payment Terms</td>
            <td>&nbsp;&nbsp;<?= $header['SI_PayTermsID'] ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>&nbsp;&nbsp;<?= $header['SI_CustomerAddress'] ?></td>
            <td>Due Date</td>
            <td>&nbsp;&nbsp;<?= $header['SI_DueDate'] ?></td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>&nbsp;&nbsp;<?= $header['SI_Remarks'] ?></td>
            <td>Status</td>
            <td>&nbsp;&nbsp;<?= $header['SI_Status'] ?></td>
        </tr>
        <tr>
            <td>Company</td>
            <td>&nbsp;&nbsp;<?= $header['SI_Company'] ?></td>
            <td>Location</td>
            <td>&nbsp;&nbsp;<?= $header['SI_Location'] ?></td>
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
                <td>Location</td>
                <td>Qty</td>
                <td>Unit Price</td>
                <td>Amount</td>
            </tr>
        </thead>
        <?php foreach ($details["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["SID_ItemTypeID"] ?></td>
                <td><?= $detail["SID_ItemNo"] ?></td>
                <td><?= $detail["SID_Location"] ?></td>
                <td><?= $detail["SID_Qty"] ?></td>
                <td><?= $detail["SID_UnitPrice"] ?></td>
                <td><?= $detail["SID_Amount"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table>
        <tr>            
            <td colspan="5"> <b>Running Total: </b></td>
            <td>&nbsp;&nbsp; <?= $header["SI_Amount"] ?></td>
        </tr>
    </table>

</div>
