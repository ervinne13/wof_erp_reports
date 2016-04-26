
<style>
    th, td {
        text-align: center;
    }
</style>

<?php
$retrieval_date        = new DateTime($RVMR_Date);
$display_date          = $retrieval_date->format('m/d/Y');
$row_span              = count($docs) + 1;
$display_spanning_rows = true;
?>

<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MC_MachineTag"] ?>]</h3>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2">Meter Reading</th>
                    <th colspan="4"></th>
                </tr>
                <tr>            
                    <th>Date</th>
                    <th style="max-width: 60px;">Qty<br>Retrieved</th>
                    <th style="max-width: 40px;">Meter<br>#</th>
                    <th style="min-width: 80px;">Beg</th>
                    <th style="min-width: 80px;">End</th>
                    <th style="min-width: 70px;">Meter<br>Count</th>
                    <th>Qty<br>Variance</th>
                    <th>Variance<br>%</th>                    
                    <th style="min-width: 250px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docs AS $doc): ?>

                    <tr class="meter-reading-row" data-id="<?= $doc['RVMR_LineNo'] ?>">
                        <?php if ($display_spanning_rows): ?>
                            <td><?= $display_date ?></td>
                            <td id="qty-retrieved"><?= $RVMR_QtyRetrieved ?></td>
                        <?php else: ?>
                            <td colspan="2"></td>
                        <?php endif; ?>

                        <td><?= $doc['RVMR_MeterNo'] ?></td>
                        <td>
                            <input data-id="<?= $doc['RVMR_LineNo'] ?>" type="text" name="RVMR_ReadingFrom" class="form-control meter-reading-field" value="<?= $doc['RVMR_ReadingFrom'] ?>">
                        </td>                     
                        <td>
                            <input data-id="<?= $doc['RVMR_LineNo'] ?>" type="text" name="RVMR_ReadingTo" class="form-control meter-reading-field" value="<?= $doc['RVMR_ReadingTo'] ?>">
                        </td>
                        <td id="meter-count-<?= $doc['RVMR_LineNo'] ?>" class="meter-count">0</td>

                        <?php if ($display_spanning_rows): ?>                            
                            <td id="qty-variance">0</td>
                            <td id="variance-p">0%</td>            
                            <td>
                                <input type="text" name="RVMR_Remarks" class="form-control" value="<?= $RVMR_Remarks ?>">
                            </td>
                        <?php else: ?>
                            <td colspan="3" rowspan="0"></td>
                        <?php endif; ?>
                    </tr>

                    <?php
                    //  display spanning rows one time only
                    $display_spanning_rows = false;
                    ?>

                <?php endforeach; ?>
                <tr>
                    <td colspan="3" rowspan="0"></td>
                    <td colspan="2">Sub Total:</td>
                    <td id="sub-total">0</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-machine-reading" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <button id="action-save-machine-machine-reading" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

    <br>

    <?php if (count($previous_docs) > 0): ?>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th colspan="2">Meter Reading</th>
                        <th colspan="4"></th>
                    </tr>
                    <tr>            
                        <th>Date</th>
                        <th style="max-width: 60px;">Qty<br>Retrieved</th>
                        <th style="max-width: 40px;">Meter<br>#</th>
                        <th style="min-width: 80px;">Beg</th>
                        <th style="min-width: 80px;">End</th>
                        <th style="min-width: 70px;">Meter<br>Count</th>
                        <th>Qty<br>Variance</th>
                        <th>Variance<br>%</th>                    
                        <th style="min-width: 250px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $previous_doc_date_compare_to = null;
                    $current_total                = 0;
                    ?>

                    <?php foreach ($previous_docs AS $doc): ?>

                        <?php
                        $previous_doc_date = (new DateTime($doc["RVMR_Date"]))->format('m/d/Y');
                        $current_total += $doc['RVMR_MeterCount'];
                        ?>

                        <?php if ($previous_doc_date_compare_to && ($previous_doc_date_compare_to != $previous_doc_date)): ?>
                            <tr>
                                <td colspan="3" rowspan="0"></td>
                                <td colspan="2">Sub Total:</td>
                                <td id="sub-total"><?= $current_total ?></td>
                                <td colspan="3"></td>
                            </tr>
                        <?php endif; ?>

                        <tr class="meter-reading-row" data-id="<?= $doc['RVMR_LineNo'] ?>">
                            <td><?= $previous_doc_date ?></td>
                            <td id="qty-retrieved"><?= $RVMR_QtyRetrieved ?></td>

                            <td><?= $doc['RVMR_MeterNo'] ?></td>
                            <td><?= $doc['RVMR_ReadingFrom'] ?></td>                     
                            <td><?= $doc['RVMR_ReadingTo'] ?></td>
                            <td><?= $doc['RVMR_MeterCount'] ?></td>                        
                            <td><?= $doc['RVMR_VarianceQty'] ?></td>                        
                            <td><?= $doc['RVMR_VarianceP'] ?></td>                        
                            <td><?= $doc['RVMR_Remarks'] ?></td>
                        </tr>

                        <?php $previous_doc_date_compare_to = $previous_doc_date ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" rowspan="0"></td>
                        <td colspan="2">Sub Total:</td>
                        <td id="sub-total">0</td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
