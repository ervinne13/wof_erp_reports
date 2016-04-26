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
            <td>&nbsp;&nbsp;<?= $header['DCM_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Customer ID.</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_CustomerID'] ?></td>
            <td>Ref Doc. No.</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_RefDocNo'] ?></td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_CustomerName'] ?></td>
            <td>External Doc. No.</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_ExtDocNo'] ?></td>
        </tr>
        <tr>
            <td>Remarks</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_Remarks'] ?></td>
            <td>Status</td>
            <td>&nbsp;&nbsp;<?= $header['DCM_Status'] ?></td>
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
                <td>DCM Type</td>
                <td>Description</td>
                <td>Location</td>
                <td>Amount</td>
                <td>Applies to Doc Type</td>
                <td>Applies to Doc No.</td>
            </tr>
        </thead>
        <?php foreach ($details["data"] AS $detail): ?>
            <tr>
                <td><?= $detail["DCMD_DCMType"] ?></td>
                <td><?= $detail["DCMD_Description"] ?></td>
                <td><?= $detail["DCMD_Location"] ?></td>
                <td><?= $detail["DCMD_Amount"] ?></td>
                <td><?= $detail["DCMD_AppliesToDocType"] ?></td>
                <td><?= $detail["DCMD_AppliesToDocNo"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table>
        <tr>            
            <td colspan="5"> <b>Running Total: </b></td>
            <td>&nbsp;&nbsp; <?= $header["DCM_Amount"] ?></td>
        </tr>
    </table>

</div>
