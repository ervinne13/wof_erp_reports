

<div style="padding: 4px;">

    <div class="row">
        <table class="table table-striped">
            <thead>             
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2">Variance</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Retrieval Date</th>
                    <th>Ticket Price</th>
                    <th>Qty Retrieved</th>                  
                    <th>Sold</th>
                    <th>Qty</th>
                    <th>%</th>
                    <th style="min-width: 300px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($variances AS $consolidated_variance): ?>
                    <?php foreach ($consolidated_variance AS $retrieval_date => $variance): ?>
                        <tr class="ticket-variance-row" data-id="<?= $variance['RVTIV_LineNo'] ?>">

                            <?php
                            $retrieval_date = new DateTime($variance['RVTIV_Date']);
                            $display_date   = $retrieval_date->format('m/d/Y');
                            ?>

                            <td><?= $display_date ?></td>
                            <td><?= $variance['RVTIV_TicketPrice'] ?></td>
                            <td><?= $variance['RVTIV_QtyRetrieved'] ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input data-id="<?= $variance['RVTIV_LineNo'] ?>" type="text" name="RVTIV_Remarks" class="form-control" value="<?= $variance['RVTIV_Remarks'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">    
        <button id="action-save-ticket-variance" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

</div>