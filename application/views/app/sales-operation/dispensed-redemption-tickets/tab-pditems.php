
<style>
    th, td {
        text-align: center;
    }
</style>

<?php
$retrieval_date        = new DateTime($DIP_RetrievalDate);
$display_date          = $retrieval_date->format('m/d/Y');
$row_span              = count($docs) + 1;
$display_spanning_rows = true;
?>


<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MCI_MC_MachineTag"] ?>]</h3>

    <div class="row">
        <table class="table table-striped">
            <thead>

                <tr>            
                    <th>Date</th>
                    <th style="min-width: 80px;">Beginning</th>
                    <th style="min-width: 80px;">Ending</th>
                    <th style="min-width: 80px;">Additional Issuances</th>
                    <th style="min-width: 80px;">Transfer Out</th>
                    <th style="min-width: 80px;">Dispensed</th>                    
                </tr>
            </thead>

            <tbody>
                <?php foreach ($docs AS $doc): ?>
                    <tr class="pditem-row" data-id="<?= $doc['DIP_LineNo'] ?>" data-item-no="<?= $doc['DIP_ItemNo'] ?>">

                        <?php if ($display_spanning_rows): ?>
                            <td class="retrieval-date" data-id="<?= $doc['DIP_RetrievalDate'] ?>"><?= $display_date ?></td>                            
                        <?php else: ?>
                            <td colspan="1"></td>
                        <?php endif; ?>

                        <td class="issue-beg" data-id="<?= $doc['DIP_LineNo'] ?>"><?= $doc['DIP_Beg'] ?></td> <!-- BEG -->


                        <td width="40" >
                            <input  data-id="<?= $doc['DIP_LineNo'] ?>" type="text" name="DIP_End" class="form-control pditem-field" value="<?= $doc['DIP_End'] ?>">                            
                        </td>  

                        <td class="additional-issueance" data-id="<?= $doc['DIP_LineNo'] ?>"><?= $doc['DIP_AdditionalIssuances'] ?></td>
                        <td class="transfer-out" data-id="<?= $doc['DIP_LineNo'] ?>"><?= $doc['DIP_TransferOut'] ?></td>
                        <td class="issue-capture" data-id="<?= $doc['DIP_LineNo'] ?>"><?= $doc['DIP_Captured'] ?></td>  <!-- CAPTURE -->                        

                    </tr>

                    <?php
                    //  display spanning rows one time only
                    $display_spanning_rows = false;
                    ?>


                <?php endforeach; ?>
            </tbody>


        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-pd-ticket" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <!--         <button id="action-save-machine-dispense-ticket" class="btn btn-default form-btn main-clr">
                    Save
                </button>      --> 
    </div>

    <br>



</div>
