
<style>
    th, td {
        text-align: center;
    }
</style>

<?php
$retrieval_date = new DateTime($RV_RetrievalDate);
$display_date   = $retrieval_date->format('m/d/Y');
$row_span       = count($tickets);

$display_spanning_rows = true;
?>

<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MC_MachineTag"] ?>]</h3>

    <div style="display: none">
        <div id="week-1-total-ticket"><?= $weekly_totals['QtyRetrievedWeek1'] ?></div>
        <div id="week-2-total-ticket"><?= $weekly_totals['QtyRetrievedWeek2'] ?></div>
        <div id="week-3-total-ticket"><?= $weekly_totals['QtyRetrievedWeek3'] ?></div>
        <div id="week-4-total-ticket"><?= $weekly_totals['QtyRetrievedWeek4'] ?></div>

        <div id="RV_MonthlyRunningTotal-ticket"><?= $RV_MonthlyRunningTotal ?></div>
        <div id="RV_RetrievalDateRunningTotal-ticket"><?= $RV_RetrievalDateRunningTotal ?></div>

    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>              
                <tr>
                    <th>Date</th>
                    <th>Ticket Price</th>                    
                    <th>Qty Retrieved</th>                  
                    <th style="min-width: 400px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets AS $ticket): ?>
                    <tr class="ticket-row" data-id="<?= $ticket['RVTR_LineNo'] ?>">
                        <?php if ($display_spanning_rows): ?>
                            <td><?= $display_date ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?= $ticket['RVTR_TicketPrice'] ?></td>
                        <td>
                            <input data-id="<?= $ticket['RVTR_LineNo'] ?>" type="text" name="RVTR_QtyRetrieved" class="form-control" value="<?= $ticket['RVTR_QtyRetrieved'] ?>">
                        </td>
                        <td>
                            <input data-id="<?= $ticket['RVTR_Remarks'] ?>" type="text" name="RVTR_Remarks" class="form-control" value="<?= $ticket['RVTR_Remarks'] ?>">
                        </td>
                    </tr>

                    <?php $display_spanning_rows = false; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-tickets" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <!--        <button id="action-save-machine-tickets" class="btn btn-default form-btn main-clr">
                    Save
                </button>      -->
    </div>

    <br>

    <?php if (count($previous_tickets) > 0): ?>

        <div class = "row">
            <label>Previous Retrieval</label>        
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>              
                    <tr>
                        <th>Date</th>
                        <th>Ticket Price</th>                    
                        <th>Qty Retrieved</th>                  
                        <th style="min-width: 400px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($previous_tickets AS $ticket): ?>
                        <tr class="ticket-row" data-id="<?= $ticket['RVTR_LineNo'] ?>">
                            <?php
                            $previous_retrieval_date = new DateTime($ticket["RVTR_Date"]);
                            ?>

                            <td><?= $previous_retrieval_date->format('m/d/Y') ?></td>
                            <td><?= $ticket['RVTR_TicketPrice'] ?></td>
                            <td><?= $ticket['RVTR_LineNo'] ?></td>
                            <td><?= $ticket['RVTR_Remarks'] ?></td>
                        </tr>

                        <?php $display_spanning_rows   = false; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    <?php endif; ?>

</div>
