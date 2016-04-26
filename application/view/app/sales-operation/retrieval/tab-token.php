
<style>
    th {
        text-align: center;
    }
</style>

<?php
$retrieval_date = new DateTime($RVT_Date);
$display_date   = $retrieval_date->format('m/d/Y');
?>

<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MC_MachineTag"] ?>]</h3>

    <meta id="current-token-line-no" content="<?= $RVT_LineNo ?>">    

    <div id="week-1-total"><?= $weekly_totals['QtyRetrievedWeek1'] ?></div>
    <div id="week-2-total"><?= $weekly_totals['QtyRetrievedWeek2'] ?></div>
    <div id="week-3-total"><?= $weekly_totals['QtyRetrievedWeek3'] ?></div>
    <div id="week-4-total"><?= $weekly_totals['QtyRetrievedWeek4'] ?></div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th colspan="2">Counter Reading</th>
                    <th colspan="4"></th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Beg</th>
                    <th>End</th>
                    <th>Qty Retrieved</th>
                    <th>Free</th>
                    <th>MTC</th>
                    <th style="min-width: 300px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $display_date ?></td>
                    <td>
                        <input type="text" name="RVT_CounterFrom" class="form-control" value="<?= $RVT_CounterFrom ?>">
                    </td>
                    <td>
                        <input type="text" name="RVT_CounterTo" class="form-control" value="<?= $RVT_CounterTo ?>">
                    </td>
                    <td id="RVT_QtyRetrieved"><?= $RVT_QtyRetrieved ?></td>
                    <td>
                        <input type="text" name="RVT_Free" class="form-control" value="<?= $RVT_Free ?>">
                    </td>
                    <td>
                        <input type="text" name="RVT_MTC" class="form-control" value="<?= $RVT_MTC ?>">
                    </td>
                    <td>
                        <input type="text" name="RVT_Remarks" class="form-control" value="<?= $RVT_Remarks ?>">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-tokens" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <button id="action-save-machine-tokens" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

    <br>

    <?php if (count($previous_retrieval_tokens) > 0): ?>
        <div class = "row">
            <table class = "table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th colspan = "2">Counter Reading</th>
                        <th colspan = "4"></th>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <th>Beg</th>
                        <th>End</th>
                        <th>Qty Retrieved</th>
                        <th>Free</th>
                        <th>MTC</th>
                        <th style = "min-width: 300px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($previous_retrieval_tokens AS $rt):
                        ?>
                        <tr>
                            <td><?= $rt["RVT_Date"] ?></td>
                            <td><?= $rt["RVT_CounterFrom"] ?></td>
                            <td><?= $rt["RVT_CounterTo"] ?></td>
                            <td><?= $rt["RVT_QtyRetrieved"] ?></td>
                            <td><?= $rt["RVT_Free"] ?></td>
                            <td><?= $rt["RVT_MTC"] ?></td>
                            <td><?= $rt["RVT_Remarks"] ?></td>                      
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
