

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
                    <th>Particular</th>
                    <th>Qty Retrieved</th>                  
                    <th>Released</th>
                    <th>Qty</th>
                    <th>%</th>
                    <th style="min-width: 300px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($variances AS $consolidated_variance): ?>
                    <?php foreach ($consolidated_variance AS $retrieval_date => $variance): ?>
                        <tr class="token-variance-row" data-id="<?= $variance['RVTOV_LineNo'] ?>">

                            <?php
                            $retrieval_date = new DateTime($variance['RVTOV_RetrievalDate']);
                            $display_date   = $retrieval_date->format('m/d/Y');
                            ?>

                            <td><?= $display_date ?></td>
                            <td><?= $variance['RVTOV_Particular'] ?></td>
                            <td><?= $variance['RVTOV_QtyRetrieved'] ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input data-id="<?= $variance['RVTOV_LineNo'] ?>" type="text" name="RVTOV_Remarks" class="form-control" value="<?= $variance['RVTOV_Remarks'] ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">    
        <button id="action-save-token-variance" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

</div>