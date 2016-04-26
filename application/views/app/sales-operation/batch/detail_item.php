<tr onclick="batch.editItem(this);">
    <td>

        <a href="<?=site_url('app/sales-operation/batch/sub_details/' . $v['BAD_BA_DocNo'] . '/' . $v['BAD_ItemNo']);?>">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </a>

        <a href="#" onclick="batch.deleteItem(this);">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </a>
        
        <?php if (empty($v['BAD_BA_DocNo'])): ?>
            <input type="hidden" name="action[]" value="add" data-name="action">
        <?php else: ?>
            <input type="hidden" name="action[]" value="none" data-name="action">
        <?php endif ?>
    </td>
    <td>   
        <select name="BAD_ItemType[]" class="form-control selectize" required>
            <option value="">Select</option>
            <?php foreach ($item_types as $a): ?>
                <option value="<?=$a['IT_Id'];?>" <?=$a['IT_Id'] == $v['BAD_ItemType'] ? 'selected' : NULL ;?> required><?=$a['IT_Description'];?></option>
            <?php endforeach ?>
        </select>
    </td>
    <td>
        <select name="BAD_ItemNo[]" data-name="item-no" class="form-control selectize" onchange="batch.itemNo(this);" required>
            <option value="">Select</option>
            <?php foreach ($item_list as $b): ?>
                <option value="<?=$b['IM_Item_id'];?>" data-uom="<?=$b['IM_FK_Attribute_UOM_id'];?>" <?=$b['IM_Item_id'] == $v['BAD_ItemNo'] ? 'selected' : NULL;?>><?=$b['IM_Item_id'];?></option>
            <?php endforeach ?>
        </select>
    </td>
    <td>
        <select name="BAD_Description[]" data-name="desc" class="form-control selectize" onchange="batch.description(this);" required>
            
            <option value="">Select</option>
            <?php foreach ($item_list as $b): ?>
                <option value="<?=htmlentities($b['IM_Sales_Desc']);?>" data-item-id="<?=$b['IM_Item_id'];?>" <?=$b['IM_Sales_Desc'] == $v['BAD_Description'] ? 'selected' : NULL;?>><?=$b['IM_Sales_Desc'];?></option>
            <?php endforeach ?>

        </select>
    </td>
    <td>
        <input type="text" class="form-control" name="BAD_Image[]" value="<?=$v['BAD_Image'];?>">
    </td>
    <td>
        <input type="text" class="form-control text-center" name="BAD_UnitPrice[]" value="<?= number_format($v['BAD_UnitPrice'], 2);?>" required>
        
    </td>
    <td>
        <div class="td-uom">
            <?=$v['BAD_UOM'];?>
        </div> 
        <input type="hidden" data-name="uom" name="BAD_UOM[]" value="<?=$v['BAD_UOM'];?>">
        <input type="hidden" data-name="uom" name="BAD_BaseUOM[]" value="<?=$v['BAD_BaseUOM'];?>">
    </td>
    <td><?= number_format($v['BAD_SuggestedQty'], 2);?></td>
    <td>
        <?= number_format($v['BAD_ApprovedQty'], 2);?>
    </td>
 </tr>