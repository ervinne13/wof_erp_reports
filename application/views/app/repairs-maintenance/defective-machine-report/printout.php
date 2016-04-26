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
            <td>&nbsp;&nbsp;<?= $header['DMR_DocNo'] ?></td>
            <td>Document Date:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_DocDate'] ?></td>            
        </tr>
        <tr>
            <td>Reference No.:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_RefNo'] ?></td>
            <td>Location:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_Company'] ?></td>            
        </tr>
        <tr>
            <td>Remarks:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_Remarks'] ?></td>
            <td>Company:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_Company'] ?></td>
        </tr>
        <tr> <td colspan="4"></td></tr>
        <tr>
            <td>Item Description:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_ItemDescription'] ?></td>
            <td>Nature of Defect:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_NatureOfDefect'] ?></td>
        </tr>
        <tr>
            <td>Asset ID:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_AssetID'] ?></td>
            <td>Job Needed:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_JobNeeded'] ?></td>
        </tr>
        <tr>
            <td>Item No:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_ItemNo'] ?></td>
            <td>Technician:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_Technician'] ?></td>
        </tr>
        <tr> <td colspan="4"></td></tr>
        <tr>
            <td>Date Down:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_DateDown'] ?></td>
            <td>Date Operational:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_DateOperational'] ?></td>
        </tr>
        <tr>
            <td>Downtime Days:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_DowntimeDays'] ?></td>
            <td>Status:</td>
            <td>&nbsp;&nbsp;<?= $header['DMR_Status'] ?></td>
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
                    <td><?= $detail["DMRD_Date"] ?></td>
                    <td><?= $detail["DMRD_ActionTaken"] ?></td>
                    <td><?= $detail["DMRD_UserID"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
