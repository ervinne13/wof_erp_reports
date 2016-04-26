
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
        <button id="action-save-machine-tickets" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

    <br>

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

</div>
