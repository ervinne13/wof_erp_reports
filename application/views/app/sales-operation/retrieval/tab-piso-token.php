
<style>
    th {
        text-align: center;
    }
</style>

<?php
$retrieval_date = new DateTime($RVPT_Date);
$display_date   = $retrieval_date->format('m/d/Y');
?>

<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MC_MachineTag"] ?>]</h3>

    <meta id="current-piso-token-line-no" content="<?= $RVPT_LineNo ?>">

    <div style="display: none">
        <div id="week-1-total-pisoToken"><?= $weekly_totals['QtyRetrievedWeek1'] ?></div>
        <div id="week-2-total-pisoToken"><?= $weekly_totals['QtyRetrievedWeek2'] ?></div>
        <div id="week-3-total-pisoToken"><?= $weekly_totals['QtyRetrievedWeek3'] ?></div>
        <div id="week-4-total-pisoToken"><?= $weekly_totals['QtyRetrievedWeek4'] ?></div>
        
        <div id="RV_MonthlyRunningTotal-pisoToken"><?= $RV_MonthlyRunningTotal ?></div>
        <div id="RV_RetrievalDateRunningTotal-pisoToken"><?= $RV_RetrievalDateRunningTotal ?></div>
        
    </div>    

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
                    <th>Piso Coin</th>
                    <th>MTC</th>
                    <th style="min-width: 300px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $display_date ?></td>
                    <td>
                        <input type="text" name="RVPT_CounterFrom" class="form-control" value="<?= $RVPT_CounterFrom ?>">
                    </td>
                    <td>
                        <input type="text" name="RVPT_CounterTo" class="form-control" value="<?= $RVPT_CounterTo ?>">
                    </td>
                    <td id="RVPT_QtyRetrieved"><?= $RVPT_QtyRetrieved ?></td>
                    <td>
                        <input type="text" name="RVPT_PisoCoin" class="form-control" value="<?= $RVPT_PisoCoin ?>">
                    </td>
                    <td>
                        <input type="text" name="RVPT_MTC" class="form-control" value="<?= $RVPT_MTC ?>">
                    </td>
                    <td>
                        <input type="text" name="RVPT_Remarks" class="form-control" value="<?= $RVPT_Remarks ?>">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-piso-token" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <!--        <button id="action-save-machine-piso-token" class="btn btn-default form-btn main-clr">
                    Save
                </button>      -->
    </div>

    <br>

    <?php if (count($previous_retrieval_tokens) > 0): ?>

        <div class = "row">
            <label>Previous Retrieval</label>        
        </div>

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
                        <th>Piso Coin</th>
                        <th>MTC</th>
                        <th style = "min-width: 300px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($previous_retrieval_tokens AS $rt):
                        ?>
                        <tr>
                            <td><?= $rt["RVPT_Date"] ?></td>
                            <td><?= $rt["RVPT_CounterFrom"] ?></td>
                            <td><?= $rt["RVPT_CounterTo"] ?></td>
                            <td><?= $rt["RVPT_QtyRetrieved"] ?></td>
                            <td><?= $rt["RVPT_PisoCoin"] ?></td>
                            <td><?= $rt["RVPT_MTC"] ?></td>
                            <td><?= $rt["RVPT_Remarks"] ?></td>                      
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
