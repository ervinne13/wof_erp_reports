<style type="text/css">
    table {
        padding: 5px;
    }
    table tr td:first{
        text-align: right;
    }
</style>
<div>    
    <table>
        <thead>
            <tr>
                <th rowspan="2">Account Code</th>
                <th rowspan="2">Account Name</th>
                <th rowspan="2">Beginning Balance</th>
                <th colspan="2">Disbursement</th>
                <th colspan="2">Cash Receipt</th>
                <th colspan="2">General Journal</th>
                <th colspan="2">Sales</th>
                <th colspan="2">Total</th>
                <th rowspan="2">Ending Balance</th>                        
            </tr>
            <tr>                      
                <!--Disbursement-->
                <th>Debit</th>
                <th>Credit</th>
                <!--Cash Receipt-->
                <th>Debit</th>
                <th>Credit</th>
                <!--General Journal-->
                <th>Debit</th>
                <th>Credit</th>
                <!--Sales-->
                <th>Debit</th>
                <th>Credit</th>
                <!--Total-->
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
        <?php foreach ($entries["data"] AS $entry): ?>
            <tr>
                <td><?= $entry["COA_Account_id"] ?></td>
                <td><?= $entry["COA_AccountName"] ?></td>
                <td><?= $entry["GL_Beginning_Balance"] ?></td>                
                <td><?= $entry["GL_Disbursement_Credit"] ?></td>
                <td><?= $entry["GL_Disbursement_Debit"] ?></td>
                <td><?= $entry["GL_Cash_Receipt_Credit"] ?></td>
                <td><?= $entry["GL_Cash_Receipt_Debit"] ?></td>
                <td><?= $entry["GL_Sales_Credit"] ?></td>
                <td><?= $entry["GL_Sales_Debit"] ?></td>
                <td><?= $entry["GL_General_Journal_Credit"] ?></td>
                <td><?= $entry["GL_General_Journal_Debit"] ?></td>
                <td><?= $entry["GL_Credit"] ?></td>
                <td><?= $entry["GL_Debit"] ?></td>
                <td><?= $entry["GL_Ending_Balance"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
