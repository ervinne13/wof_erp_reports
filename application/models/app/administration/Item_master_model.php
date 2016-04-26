<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_master_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_Item");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("IM_Item_id",
                    'md5("IM_DocNo") as id',
                    "IM_UPCCode",
                    "IM_Short_Desc",
                    "IM_Sales_Desc",
                    "IM_Purchased_Desc",
                    "IM_UnitCost",
                    "IM_Status",
                    '(CASE WHEN "IM_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "IM_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) as "IM_Active"'))
                ->join("tblINV_ItemType", "tblINV_ItemType.IT_Id = tblINV_Item.IM_FK_ItemType_id", 'left')
                ->where(array('IT_Services !=' => '1'))
                ->or_where(array('IM_FK_ItemType_id' => NULL))
                ->group_by("IM_Item_id");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("IM_Item_id" as text)) LIKE'                                                                                                   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_UPCCode" as text)) LIKE'                                                                                                   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_Short_Desc" as text)) LIKE'                                                                                                => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_Sales_Desc" as text)) LIKE'                                                                                                => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_Purchased_Desc" as text)) LIKE'                                                                                            => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_UnitCost" as text)) LIKE'                                                                                                  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CASE WHEN "IM_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "IM_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) LIKE' => '%' . strtolower($queries['search']) . '%'
            ));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by("tblINV_Item.DateCreated DESC");
        }

        $count = $this->db->query($this->db->get_compiled_select("tblINV_Item", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function getItemsUnderItemType($item_type_id, $fields = array()) {

        if (count($fields) > 0) {
            $this->db->select($fields);
        } else {
            $this->db->select('*');
        }


        $this->db->where(array(
            '"IM_FK_ItemType_id"' => $item_type_id,
            '"IM_Active"'         => '1'
        ));
        $query = $this->db->get('"tblINV_Item"');

        return $query->result_array();
    }

    public function getItemsWithMachineType($fields = array()) {

        if (count($fields) > 0) {
            $this->db->select($fields);
        } else {
            $this->db->select('*');
        }

        $this->db->where(array('"IM_Active"' => '1'));
        $this->db->join('tblINV_Machine', "tblINV_Machine.MC_IM_Item_id = tblINV_Item.IM_Item_id", 'left');

        $query = $this->db->get('"tblINV_Item"');
        return $query->result_array();
    }

    public function add_data($data) {

        $supplier   = isset($data['supplier']) ? $data['supplier'] : array();
        $uom        = isset($data['uom']) ? $data['uom'] : array();
        $identifier = isset($data['IMI_FK_IdentifierDetails_id']) ? $data['IMI_FK_IdentifierDetails_id'] : array();
        unset($data['uom'], $data['IMI_FK_IdentifierDetails_id'], $data['supplier']);
        $this->db->trans_start();

        $result = $this->db->insert('tblINV_Item', add_data($data));
        $id     = $data['IM_Item_id'] . '-' . $this->db->insert_id();

        foreach ($uom as $key => $value) {
            $ins = array('IUC_FK_Item_id' => $id,
                'IUC_FK_UOM_id'  => $value['IUC_FK_UOM_id'],
                'IUC_Quantity'   => $value['IUC_Quantity']);
            $this->db->insert("tblINV_ItemUOMConv", $ins);
        }

        foreach ($supplier as $key => $value) {
            $ins = array('IS_FK_Item_id'       => $id,
                'IS_FK_Suppllier_id'  => $value['IS_FK_Suppllier_id'],
                'IS_OldItemCode'      => $value['IS_OldItemCode'],
                'IS_Active'           => $value['IS_Active'],
                'IS_SupplierItemCode' => $value['IS_SupplierItemCode']);
            $this->db->insert("tblINV_ItemSupplier", add_data($ins));
        }

        foreach ($identifier as $key => $value) {
            if ($value) {
                $iden = array('IMI_FK_IdentifierDetails_id' => $value,
                    'IMI_FK_Item_id'              => $id);
                $this->db->insert("tblINV_ItemIdentifier", $iden);
            }
        }

        $this->db->trans_complete();
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data($where, $data) {

        $supplier   = isset($data['supplier']) ? $data['supplier'] : array();
        $del        = isset($data['delete']) ? $data['delete'] : array();
        $dels       = isset($data['delete-s']) ? $data['delete-s'] : array();
        $identifier = isset($data['IMI_FK_IdentifierDetails_id']) ? $data['IMI_FK_IdentifierDetails_id'] : array();
        $uom        = isset($data['uom']) ? $data['uom'] : array();
        $old        = isset($data['old']) ? $data['old'] : array();
        $olds       = isset($data['old-s']) ? $data['old-s'] : array();
        unset($data['supplier'], $data['delete-s'], $data['old-s'], $data['uom'], $data['delete'], $data['old'], $data['IMI_FK_IdentifierDetails_id']);

        $this->db->trans_start();
        $this->db->where($where)
                ->update('tblINV_Item', update_data($data));

        foreach ($del as $key => $value) {
            $this->db->where(array('IUC_Id' => $value))
                    ->delete("tblINV_ItemUOMConv");
        }

        foreach ($dels as $key => $value) {
            $this->db->where(array('IS_Id' => $value))
                    ->delete("tblINV_ItemSupplier");
        }

        foreach ($supplier as $key => $value) {
            $ins = array('IS_FK_Item_id'       => $data['IM_Item_id'],
                'IS_FK_Suppllier_id'  => $value['IS_FK_Suppllier_id'],
                'IS_OldItemCode'      => $value['IS_OldItemCode'],
                'IS_Active'           => $value['IS_Active'],
                'IS_SupplierItemCode' => $value['IS_SupplierItemCode']);
            $this->db->insert("tblINV_ItemSupplier", add_data($ins));
        }

        foreach ($uom as $key => $value) {
            $ins = array('IUC_FK_Item_id' => $data['IM_Item_id'],
                'IUC_FK_UOM_id'  => $value['IUC_FK_UOM_id'],
                'IUC_Quantity'   => $value['IUC_Quantity']);
            $this->db->insert("tblINV_ItemUOMConv", $ins);
        }
        foreach ($olds as $key => $value) {
            $this->db->where(array('IS_Id' => $key))
                    ->update("tblINV_ItemSupplier", $value);
        }
        foreach ($old as $key => $value) {
            $this->db->where(array('IUC_Id' => $key))
                    ->update("tblINV_ItemUOMConv", $value);
        }

        $this->db->where(array('IMI_FK_Item_id' => $data['IM_Item_id']))
                ->delete('tblINV_ItemIdentifier');

        foreach ($identifier as $key => $value) {
            if ($value) {
                $iden = array('IMI_FK_IdentifierDetails_id' => $value,
                    'IMI_FK_Item_id'              => $data['IM_Item_id']);
                $this->db->insert("tblINV_ItemIdentifier", $iden);
            }
        }
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_status($where, $data) {
        return My_Model::update_data($where, $data);
    }

    public function search($data) {

        $result = $this->db->select(array("IM_Item_id",
                    "IM_Short_Desc"))
                ->where(array('LOWER("IM_Item_id") LIKE' => '%' . strtolower($data['q']) . '%'))
                ->limit($data['page_limit'])
                ->get("tblINV_Item");

        return $result->result_array();
    }

    public function get_identifiers_per_item($where) {

        $result = $this->db->select('*')
                ->where($where)
                ->get("tblINV_ItemIdentifier");

        return array('rows' => $result->num_rows(),
            'data' => $result->result_array());
    }

    //used on physical count
    public function get_spec_data_per_item_type($itemTypeId) {

        $result = $this->db->select('*')
                ->join('tblCOM_AttributeDetail', 'AD_Id = IM_FK_Attribute_UOM_id', 'left')
                ->where_in('IM_FK_ItemType_id', $itemTypeId)
                ->get("tblINV_Item");

        // print_r($result);
        // exit();


        return $result->result_array();
    }

    public function get_spec_item($location, $countsheetno) {

        $location = $this->session->userdata('dlocation')['SP_StoreID'];

        $query = 'select "IM_FK_ItemType_id", "IM_Item_id", "IM_Sales_Desc", "IM_OnHandQty",
				(select "AD_Code" from "tblCOM_AttributeDetail" where "AD_Id" = "IM_FK_Attribute_UOM_id"), 
				(select sum("IL_RemQty") as "Total Qty" 
					from "tblINV_ItemLedger" 
					where "IL_Location" = \'' . $location . '\' 
					and "IL_ItemNo" = "IM_Item_id" 
					and (select "AD_Id" from "tblCOM_AttributeDetail" where "AD_Id" = "IM_FK_Attribute_UOM_id") = "IM_FK_Attribute_UOM_id" 
					and "IL_SubLocation" in (select distinct "PCS_SubLocation" from "tblINV_PCountSetup" where "PCS_CS_CountSheetNo" = ' . $countsheetno . '))
				from "tblINV_Item" where "IM_FK_ItemType_id" in (select distinct "PCS_ItemType" from "tblINV_PCountSetup" where "PCS_CS_CountSheetNo" = ' . $countsheetno . ') 
				order by "IM_FK_ItemType_id", "IM_Sales_Desc"';

        $result = $this->db->query($query);
        return $result->result_array();
    }

}
