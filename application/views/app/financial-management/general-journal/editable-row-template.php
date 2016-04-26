
<!-- BEGIN: Underscore Template Definition. -->
<!--<script type="text/template" class="template">-->
<script type="text/html" id="new-row-template">
    <tr data-reference-id="<%= reference_id %>" data-type="<%= data_type %>">
        <td style="text-align: left;">
            <% if (access.delete) { %>
            <a href="" class="det-inline-remove" data-type="<%= data_type %>" data-reference-id="<%= reference_id %>"  data-container="body" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                <span class="glyphicon glyphicon-remove"></span>
            </a>
            <% } %>
            <img class="loader" data-for="row" data-reference-id="<%= reference_id %>" src="<?= base_url() ?>img/loading.gif" />
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_PostingDate" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable" 
               id="<%= reference_id %>_GJD_PostingDate" 
               name="GJD_PostingDate" 
               data-type="combodate" 
               data-value="<?= $current_date ?>" 
               data-format="YYYY-MM-DD" 
               data-viewformat="MM/DD/YYYY" 
               data-template="MMM / D / YYYY" 
               data-title="Document Date"><?= $current_date ?></a>           
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_AccountType" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable-select"
               id="<%= reference_id %>_GJD_AccountType" 
               name="GJD_AccountType" 
               data-type="select"                
               data-title="Account Type"><%= GJD_AccountType %></a>            
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_AccountNo" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable editable-disabled"
               id="<%= reference_id %>_GJD_AccountNo" 
               name="GJD_AccountNo" 
               data-type="text"                
               data-title="Account Number"><%= GJD_AccountNo %></a>            
            <img class="loader" data-for="GJD_AccountNo" data-reference-id="<%= reference_id %>" src="<?= base_url() ?>img/loading.gif" />            
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_AccountName" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable-select" 
               id="<%= reference_id %>_GJD_AccountName" 
               name="GJD_AccountName" 
               data-type="select"                
               data-title="Account Name"><%= GJD_AccountName %></a>
            <img class="loader" data-for="GJD_AccountName" data-reference-id="<%= reference_id %>" src="<?= base_url() ?>img/loading.gif" />            
        </td>
        <td style="text-align: right;">
            <span id="label_error_<%= reference_id %>_GJD_Debit" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable" 
               id="<%= reference_id %>_GJD_Debit" 
               name="GJD_Debit" 
               data-type="text"               
               data-title="Debit"><%= GJD_Debit %></a>            
        </td>
        <td style="text-align: right;">
            <span id="label_error_<%= reference_id %>_GJD_Credit" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable" 
               id="<%= reference_id %>_GJD_Credit" 
               name="GJD_Credit" 
               data-type="text"               
               data-title="Credit"><%= GJD_Credit %></a>            
        </td>
        <td style="text-align: right;">
            <span id="label_error_<%= reference_id %>_GJD_Amount" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable editable-disabled"
               id="<%= reference_id %>_GJD_Amount" 
               name="GJD_Amount" 
               data-type="text"                
               data-title="Account Type"><%= GJD_Amount %></a>            
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_CY" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable-select"
               id="<%= reference_id %>_GJD_CY" 
               name="GJD_CY" 
               data-type="select"                
               data-title="Currency"><%= GJD_CY %></a>            
        </td>
        <td style="text-align: right;">
            <span id="label_error_<%= reference_id %>_GJD_AmountLCY" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable editable-disabled"
               id="<%= reference_id %>_GJD_AmountLCY" 
               name="GJD_AmountLCY" 
               data-type="text"                
               data-title="Account Type"><%= GJD_AmountLCY %></a>            
            <img class="loader" data-for="GJD_AmountLCY" data-reference-id="<%= reference_id %>" src="<?= base_url() ?>img/loading.gif"/>            
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_CPC" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               data-reference-id="<%= reference_id %>" 
               class="editable-select"
               id="<%= reference_id %>_GJD_CPC" 
               name="GJD_CPC" 
               data-type="select"                
               data-title="Cost Center"><%= GJD_CPC %></a>            
        </td>
        <td style="text-align: left;">
            <span id="label_error_<%= reference_id %>_GJD_Comment" class="label-error" data-toggle="tooltip" data-placement="bottom" title="">
                <i class="glyphicon glyphicon-alert red"></i>
            </span>
            <a href="#" 
               class="editable" 
               data-reference-id="<%= reference_id %>" 
               id="<%= reference_id %>_GJD_Comment" 
               name="GJD_Comment" 
               data-type="textarea" 
               data-title="Comment"><%= GJD_Comment %></a>            
        </td>
    </tr>   
</script>
<!-- END: Underscore Template Definition. -->