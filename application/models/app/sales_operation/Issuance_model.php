<?php 

class Issuance_model extends CI_Model{

	function tokens($issuances){
		
		$tokens = $this->db->query('select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price", "TTP_Type" from "tblINV_ItemUOMConv" as "iuc" 
							inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
							inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
							where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
							and "TTP_Type" = \'0\' and "TTP_SP_StoreID" = \''.$issuances['IS_Location'].'\'
							order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc')->result_array();
		
		return $tokens; 
	}

	function pisos($issuances){
		$pisos = $this->db->query('select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price", "TTP_Type" from "tblINV_ItemUOMConv" as "iuc" 
							inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
							inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
							where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
							and "TTP_Type" = \'1\' and "TTP_SP_StoreID" = \''.$issuances['IS_Location'].'\'
							order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc')->result_array();
	
		return $pisos;
	}

	function issuances($docno){
		$this->db->where('IS_DocNo', $docno);
		$issuances = $this->db->get('tblINV_Issuance')->row_array();

		return $issuances;
	}

	function details($docno, $type = 0){

		$this->db->where('ISD_IS_DocNo1', $docno);
		$this->db->where('ISD_Type', $type);
		$items = $this->db->get('tblINV_IssuanceDetailHexuple')->result_array();


		foreach ($items as $i => $v) {
			$sum = $v['ISD_1stIssuance'] + $v['ISD_2ndIssuance'] + $v['ISD_3rdIssuance'] + $v['ISD_4thIssuance'] + $v['ISD_5thIssuance'] + $v['ISD_6thIssuance'];
			$items[$i]['sold_packs'] = $sum - $v['ISD_Return'];
		}

		return $items;
	}

}	