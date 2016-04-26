
<style>
    th, td {
        text-align: center;
    }
</style>

<?php
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
                    <th>Date Transferred</th>
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

                        <?php
                        $doc_date              = new DateTime($doc["MCT_DocDate"]);
                        $display_date          = $doc_date->format('m/d/Y');
                        ?>

                        <td class="retrieval-date" data-id="<?= $doc['DIT_RetrievalDate'] ?>"><?= $display_date ?></td>                            

                        <td class="deck-no" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_DeckNo'] ?></td> <!-- DECK NO -->
                        <td class="issue-beg" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_SerialFrom'] ?></td> <!-- BEG -->
                        <td class="issue-end" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_SerialTo'] ?></td>  <!-- END -->

                        <td width="50" >
                            <input  data-id="<?= $doc['DIT_LineNo'] ?>" type="text" name="DIT_Reading" class="form-control dispense-ticket-field" value="<?= $doc['DIT_Reading'] ?>">
                        </td>  

                        <td class="qty-issued" data-id="<?= $doc['DIT_LineNo'] ?>" ><?= $doc['DIT_QtyIssued'] + 1 ?></td>                        
                        <td class="remaining-qty" data-id="<?= $doc['DIT_LineNo'] ?>"><?= $doc['DIT_Remaining'] ?></td>

                    </tr>

                    <?php
                    //  display spanning rows one time only
                    $display_spanning_rows = false;
                    ?>
                <?php endforeach; ?>

                <tr>
                    <td colspan="3" rowspan="0"></td>
                    <td colspan="2">Total:</td>
                    <td id="sub-total"><?= $total_qty_issued ?></td>
                    <td></td>
                </tr>

            </tbody>

        </table>
    </div>

    <br>

    <div class="btn-cont">
        <button id="action-save-and-next-machine-dispense-ticket" class="btn btn-default form-btn main-clr">
            Save & Next
        </button>
        <!--         <button id="action-save-machine-dispense-ticket" class="btn btn-default form-btn main-clr">
                    Save
                </button>     -->  
    </div>

    <br>



</div>
