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
            <td>&nbsp;&nbsp;<?= $header['JO_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Reference No.:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_RefNo'] ?></td>
            <td>Location:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_Company'] ?></td>            
        </tr>
        <tr>
            <td>Remarks:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_Remarks'] ?></td>
            <td>Company:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_Company'] ?></td>
        </tr>
        <tr> <td colspan="4"></td></tr>
        <tr>
            <td>Item Description:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_ItemDescription'] ?></td>
            <td>Nature of Defect:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_NatureOfDefect'] ?></td>
        </tr>
        <tr>
            <td>Asset ID:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_AssetID'] ?></td>
            <td>Job Needed:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_JobNeeded'] ?></td>
        </tr>
        <tr>
            <td>Item No:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_ItemNo'] ?></td>
            <td>Technician:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_Technician'] ?></td>
        </tr>
        <tr> <td colspan="4"></td></tr>
        <tr>
            <td>Date Down:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_DateDown'] ?></td>
            <td>Date Operational:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_DateOperational'] ?></td>
        </tr>
        <tr>
            <td>Downtime Days:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_DowntimeDays'] ?></td>
            <td>Status:</td>
            <td>&nbsp;&nbsp;<?= $header['JO_Status'] ?></td>
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
                <td>Action Taken</td>
                <td>Technician</td>             
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details["data"] AS $detail): ?>
                <tr>
                    <td><?= $detail["JOD_Date"] ?></td>
                    <td><?= $detail["JOD_ActionTaken"] ?></td>
                    <td><?= $detail["JOD_UserID"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
