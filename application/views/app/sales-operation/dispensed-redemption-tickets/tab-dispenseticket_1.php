
<style>
    th, td {
        text-align: center;
    }
</style>

<?php
$retrieval_date        = new DateTime($DIT_RetrievalDate);
$display_date          = $retrieval_date->format('m/d/Y');
$row_span              = count($docs) + 1;
$display_spanning_rows = true;

?>


<div style="padding: 4px;">

    <h3><?= $machine["IM_Sales_Desc"] ?> [<?= $machine["MCT_MC_MachineTag"] ?>]</h3>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th></th>     
                    <th colspan="2">Issuance</th>
                    <th colspan="3"></th>
                </tr>
                <tr>            
                    <th>Date</th>
                    <th style="max-width: 60px;">Deck<br>#</th>
                    <th style="min-width: 80px;">Beg</th>
                    <th style="min-width: 80px;">End</th>
                    <th style="min-width: 80px;">Reading</th>
                    <th style="min-width: 70px;">Qty<br>Dispensed</th>
                    <th style="min-width: 70px;">Total<br>Remaining</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($docs AS $doc): ?>
                    <tr class="dispense-ticket-row" data-id="<?= $doc['DIT_LineNo'] ?>">

                        <?php if ($display_spanning_rows):?>
                            <td><?= $display_date ?></td>                            
                        <?php else: ?>
                            <td colspan="1"></td>
                        <?php endif; ?>

                        <td><?= $doc['DIT_DeckNo'] ?></td>
                        <td class="issue-beg" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_SerialFrom'] ?></td> <!-- BEG -->
                        <td class="issue-end" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_SerialTo'] ?></td>  <!-- END -->

                        <td width="50" >
                            <input  data-id="<?= $doc['DIT_LineNo'] ?>" type="text" name="DIT_Reading" class="form-control dispense-ticket-field" value="<?= $doc['DIT_Reading'] ?>">
                        </td>  

                                          
                            <td class="qty-issued" data-id="<?= $doc['DIT_LineNo'] ?>" ><?= $doc['DIT_QtyIssued'] ?></td>
                            <td class="remaining-qty" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_Remaining'] ?></td>            
                            
             
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
        <button id="action-save-and-next-machine-dispense-ticket" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <button id="action-save-machine-dispense-ticket" class="btn btn-default form-btn main-clr">
            Save
        </button>      
    </div>

    <br>

   <!--  <?php if (count($previous_docs) > 0): ?>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>     
                        <th colspan="2">Issuance</th>
                        <th colspan="3"></th>
                    </tr>
                <tr>            
                    <th>Date</th>
                    <th style="max-width: 60px;">Deck<br>#</th>
                    <th style="min-width: 80px;">Beg</th>
                    <th style="min-width: 80px;">End</th>
                    <th style="min-width: 80px;">Reading</th>
                    <th style="min-width: 70px;">Qty<br>Dispensed</th>
                    <th style="min-width: 70px;">Total<br>Remaining</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $previous_doc_date_compare_to = null;
                    $current_total                = 0;
                    ?>

                    <?php foreach ($previous_docs AS $doc): ?>

                        <?php
                        $previous_doc_date = (new DateTime($doc["DIT_RetrievalDate"]))->format('m/d/Y');         
                        ?>

                        <?php if ($previous_doc_date_compare_to && ($previous_doc_date_compare_to != $previous_doc_date)): ?>
                            <tr>
                                <td colspan="3" rowspan="0"></td>
                                <td colspan="2"></td>                               
                                <td colspan="3"></td>
                            </tr>
                        <?php endif; ?>

                        <tr class="meter-reading-row" data-id="<?= $doc['DIT_LineNo'] ?>">
                            <td><?= $previous_doc_date ?></td>
                            <td><?= $doc['DIT_DeckNo'] ?></td>
                            <td><?= $doc['DIT_SerialFrom'] ?></td>                     
                            <td><?= $doc['DIT_SerialTo'] ?></td>
                            <td><?= $doc['DIT_Reading'] ?></td>                        
                            <td><?= $doc['DIT_QtyIssued'] ?></td>                        
                            <td><?= $doc['DIT_Remaining'] ?></td>                        
                            <!-- <td><?= $doc['DIT_Reading'] ?></td> -->
                        </tr>

                        <?php $previous_doc_date_compare_to = $previous_doc_date ?>
                    <?php endforeach; ?>
<!--                     <tr>
                        <td colspan="3" rowspan="0"></td>
                        <td colspan="2">Sub Total:</td>
                        <td id="sub-total">0</td>
                        <td colspan="3"></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    <?php endif; ?> -->

</div>
