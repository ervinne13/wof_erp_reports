<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Document_posting_model
 *
 * @author Ervinne Sodusta
 */
class Document_posting_model extends MY_Model {

    //  typesafe ledger types
    const LEDGER_TYPE_CUSTOMER          = "Customer Ledger";
    const LEDGER_TYPE_ITEM              = "Item Ledger";
    const LEDGER_TYPE_BANK_ACCOUNT      = "Bank Account Ledger";
    const LEDGER_TYPE_SUPPLIER          = "Supplier Ledger";
    //
    //  typesafe account types
    const ACCOUNT_CUSTOMER              = "Customer";
    const ACCOUNT_ITEM                  = "Item";
    const ACCOUNT_SUPPLIER              = "Supplier";
    const ACCOUNT_GL                    = "G/L Account";
    const ACCOUNT_BANK_ACCOUNT          = "Bank Account";
    //
    //  typesafe vat and wht accounts
    const VAT_ACCOUNT_SALES             = "VPS_COA_FK_SalesAccountNo";
    const VAT_ACCOUNT_PURCHASE          = "VPS_COA_FK_PurchaseAccountNo";
    const WHT_ACCOUNT_REC               = "WPS_COA_FK_WHTRecAccountNo";
    const WHT_ACCOUNT_PAYABLE           = "WPS_COA_FK_PayableAccountNo";
    //
    //  typesafe ledger tables
    const TABLE_CUSTOMER_LEDGER         = "tblCOM_CustomerLedger";
    const TABLE_ITEM_LEDGER             = "tblINV_ItemLedger";
    const TABLE_SUPPLIER_LEDGER         = "tblCOM_SupplierLedger";
    const TABLE_BANK_ACCOUNT_LEDGER     = "tblACC_BankAccountLedger";
    const TABLE_GENERAL_LEDGER          = "tblACC_GLEntry";
    //
    //  typesafe account/posting group tables
    const TABLE_POSTING_GROUP_BANK      = "tblACC_BankPostingGroup";
    const TABLE_POSTING_GROUP_CUSTOMER  = "tblACC_CustomerPostingGroup";
    const TABLE_POSTING_GROUP_INVENTORY = "tblACC_InvPostingGroup";
    const TABLE_POSTING_GROUP_SUPPLIER  = "tblACC_SupplierPostingGroup";
    //
    //  typesafe other tables
    const TABLE_GENERAL_JOURNAL         = "tblACC_GJHeader";
    const TABLE_CHART_OF_ACCOUNTS       = "tblACC_ChartAccount";
    //
    //  other constants
    const DEFAULT_CURRENCY              = "Peso";

    protected $is_configured = FALSE;
    protected $header_ledger;
    protected $header_account_type;
    protected $detail_ledger;
    protected $detail_account_type;
    protected $document_type;
    protected $book;
    protected $debit_account_table;
    protected $debit_account_field;
    protected $debit_account_posting_code;
    protected $debit_account_filter_field;
    protected $credit_account_table;
    protected $credit_account_field;
    protected $credit_account_posting_code;
    protected $credit_account_filter_field;
    protected $VAT_account;
    protected $VBPG_field;
    protected $VPPG_field;
    protected $VAT_amount_field;
    protected $WHT_account;
    protected $WBPG_field;
    protected $WPPG_field;
    protected $WHT_amount_field;

    public function configure($configuration) {
        $this->_validate_configuration($configuration);

        $this->header_ledger       = $configuration["header_ledger"];
        $this->header_account_type = $configuration["header_account_type"];
        $this->detail_ledger       = $configuration["detail_ledger"];
        $this->detail_account_type = $configuration["detail_account_type"];
        $this->document_type       = $configuration["document_type"];
        $this->book                = $configuration["book"];

        $this->debit_account_table        = $configuration["debit_account_table"];
        $this->debit_account_field        = $configuration["debit_account_field"];
        $this->debit_account_posting_code = $configuration["debit_account_posting_code"];
        $this->debit_account_filter_field = $configuration["debit_account_filter_field"];

        $this->credit_account_table        = $configuration["credit_account_table"];
        $this->credit_account_field        = $configuration["credit_account_field"];
        $this->credit_account_posting_code = $configuration["credit_account_posting_code"];
        $this->credit_account_filter_field = $configuration["credit_account_filter_field"];

        $this->VAT_account      = array_key_exists("VAT_account", $configuration) ? $configuration["VAT_account"] : null;
        $this->VBPG_field       = array_key_exists("VBPG_field", $configuration) ? $configuration["VBPG_field"] : null;
        $this->VPPG_field       = array_key_exists("VPPG_field", $configuration) ? $configuration["VPPG_field"] : null;
        $this->VAT_amount_field = array_key_exists("VAT_amount_field", $configuration) ? $configuration["VAT_amount_field"] : null;
        $this->WHT_account      = array_key_exists("WHT_account", $configuration) ? $configuration["WHT_account"] : null;
        $this->WBPG_field       = array_key_exists("WBPG_field", $configuration) ? $configuration["WBPG_field"] : null;
        $this->WPPG_field       = array_key_exists("WPPG_field", $configuration) ? $configuration["WPPG_field"] : null;
        $this->WHT_amount_field = array_key_exists("WHT_amount_field", $configuration) ? $configuration["WHT_amount_field"] : null;

        $this->is_configured = TRUE;
    }

    private function _validate_configuration($configuration) {
        $required_configurations = array(
            "header_ledger",
            "header_account_type",
            "detail_ledger",
            "detail_account_type",
            "header_ledger",
            "document_type",
            "book",
            "debit_account_table",
            "debit_account_field",
            "credit_account_table",
            "credit_account_field"
        );

        foreach ($required_configurations AS $key) {
            if (!array_key_exists($key, $configuration) || !$configuration[$key]) {
                throw new Exception("{$key} is required in the configuration");
            }
        }
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Document Validation">

    public function validate_documents($documents) {

        $company_id_list = $this->_consolidate_locked_company_id_list($documents);

        $this->db->select('*');
        $this->db->from('tblCOM_Company');
        $this->db->where_in('COM_Id', $company_id_list);

        $companies_query = $this->db->get();
        $companies       = $companies_query->result_array();

        if (count($companies) <= 0) {
            return;
        }

        $company_map = $this->_map_companies_and_lock_date($companies);

        foreach ($documents AS $document) {
            if (strtotime($document["DocDate"]) <= strtotime($company_map[$document["Company"]])) {
                //  invalid, document date must be greater than the lock date!
                if (array_key_exists("DocNo", $document)) {
                    $message = "Document {$document["DocNo"]} is within the lock period!";
                } else {
                    $message = "Document(s) is within the lock period!";
                }
                throw new Exception($message);
            }
        }
    }

    private function _consolidate_locked_company_id_list($documents) {

        $company_id_list = array();

        foreach ($documents AS $document) {
            if (!in_array($document["Company"], $company_id_list)) {
                array_push($company_id_list, $document["Company"]);
            }
        }

        return $company_id_list;
    }

    private function _map_companies_and_lock_date($companies) {

        $map = array();

        foreach ($companies AS $company) {
            $map[$company["COM_Id"]] = $company["COM_LockDate"];
        }

        return $map;
    }

    //  </editor-fold>
    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Overall Validation">

    public function validate_gl_balance($docno = null) {

        if ($docno) {
            $query = $this->db->query('SELECT (SUM("GL_Debit") - SUM("GL_Credit")) AS Balance FROM "tblACC_GLEntry" WHERE "GL_DocNo" = ' . "'" . $docno . "'");
        } else {
            $query = $this->db->query('SELECT (SUM("GL_Debit") - SUM("GL_Credit")) AS Balance FROM "tblACC_GLEntry"');
        }

        $result = $query->row_array();

        if ($result["balance"] != 0) {
            throw new Exception("Posting invalid, the resulting balance is {$result["balance"]}!");
        }
    }

    //  </editor-fold>

    public function post($adapted_document, $adapted_document_details) {

        if (!$this->is_configured) {
            throw new Exception("Document posting model is not configured!");
        }

        $this->db->trans_begin();

        try {
            //  Create ledger entry
            switch ($this->header_ledger) {
                case self::LEDGER_TYPE_CUSTOMER: $this->_create_customer_ledger_entry($adapted_document);
                    break;
                case self::LEDGER_TYPE_SUPPLIER: $this->_create_supplier_ledger_entry($adapted_document);
                    break;
                case self::LEDGER_TYPE_BANK_ACCOUNT: $this->_create_bank_account_ledger_entry($adapted_document);
                    break;
                case self::LEDGER_TYPE_ITEM: $this->_create_item_ledger_entries($adapted_document, $adapted_document_details);
                    break;
                default:
                    throw new Exception("Unknown or unsupported header ledger type {$this->header_ledger}");
            }

            switch ($this->detail_ledger) {
                case self::LEDGER_TYPE_ITEM: $this->_create_item_ledger_entries($adapted_document, $adapted_document_details);
                    break;
                case self::LEDGER_TYPE_CUSTOMER: $this->_create_customer_ledger_entry($adapted_document);
                    break;
                case self::LEDGER_TYPE_BANK_ACCOUNT: $this->_create_bank_account_ledger_entry($adapted_document);
                    break;
                case self::LEDGER_TYPE_SUPPLIER: $this->_create_supplier_ledger_entry($adapted_document);
                    break;
                default:
                    throw new Exception("Unknown or unsupported detail ledger type {$this->detail_ledger}");
            }

            //  Create main gl debit entry(ies)
            if ($this->debit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
                $this->_create_gl_debit_entries($adapted_document, $adapted_document_details);
            } else {
                $this->_create_gl_debit_entry($adapted_document);
            }

            //  Create main gl credit entry(ies)
            if ($this->credit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
                $this->_create_gl_credit_entries($adapted_document, $adapted_document_details);
            } else {
                $this->_create_gl_credit_entry($adapted_document, $adapted_document_details);
            }

            //  Create VAT GL Entry
            if (array_key_exists("VATAmount", $adapted_document) && $adapted_document["VATAmount"] > 0) {
                $this->_create_vat_entries($adapted_document, $adapted_document_details);
            }

            //  Create WHT GL Entry
            if (array_key_exists("WHTAmount", $adapted_document) && $adapted_document["WHTAmount"] > 0) {
                $this->_create_wht_entries($adapted_document, $adapted_document_details);
            }

            //  validate after each post
            $this->document_posting_model->validate_gl_balance($adapted_document["DocNo"]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return array('status' => 0, 'message' => 'Posting failed');
            } else {
                $this->db->trans_commit();
                return array('status' => 1, 'message' => 'Success!');
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return array('status' => 0, 'message' => 'Posting failed. ' . $e->getMessage());
        }
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Adapters">

    /**
     * "Adapts" a document to a document that can be posted. Adapted documents does
     * not contain the module code in their field names. Ex. "DocNo"'s adapted version
     * is "DocNo"
     * @param array $document    The document to be adapted
     * @param string $code The module code (ex. ).
     * @return type
     */
    public function adapt_document_for_posting($document, $code) {

        if (strpos($code, "_") === false) {
            $code .= "_";
        }

        $adapted_document = array();

        foreach ($document AS $key => $value) {
            $adapted_key                    = str_replace($code, "", $key);
            $adapted_document[$adapted_key] = $value;
        }

        return $adapted_document;
    }

    //  </editor-fold>
    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Specific Ledger Entry Creators">

    private function _create_customer_ledger_entry($document) {

        /**
         * The following are left blank:
         * CL_BalAccountType, CL_BalAccountNo, CL_BalAccountName, CL_AppliesToDocType,
         * CL_AppliesToDocNo, CL_AppliesToDocDate, CL_AppliesToID, CL_AppliedAmount
         */
        $doc_amount = array_key_exists("AmountLCY", $document) ? $document["AmountLCY"] : $document["Amount"];
        if ($this->debit_account_table != self::TABLE_POSTING_GROUP_CUSTOMER) {
            $doc_amount = $doc_amount * -1;
        }

        $doc_payment_terms = array_key_exists("PayTermsID", $document) ? $document["PayTermsID"] : null;
        $doc_due_date      = array_key_exists("DueDate", $document) ? $document["DueDate"] : null;
        $doc_vat_amount    = array_key_exists("VATAmount", $document) && $document["VATAmount"] ? $document["VATAmount"] : 0;
        $doc_wht_amount    = array_key_exists("WHTAmount", $document) && $document["WHTAmount"] ? $document["WHTAmount"] : 0;

        $cl = array();

        $cl["CL_DocType"]              = $this->document_type;
        $cl["CL_DocDate"]              = $document["DocDate"];
        $cl["CL_DocNo"]                = $document["DocNo"];
        $cl["CL_DocAmount"]            = $doc_amount;
        $cl["CL_CustomerID"]           = $document["CustomerID"];
        $cl["CL_CustomerName"]         = $document["CustomerName"];
        $cl["CL_ExtDocNo"]             = $document["ExtDocNo"];
        $cl["CL_CustomerPostingGroup"] = $document["CPG"];
        $cl["CL_PaymentTerms"]         = $doc_payment_terms;
        $cl["CL_DueDate"]              = $doc_due_date;
        $cl["CL_Company"]              = $document["Company"];
        $cl["CL_CPC"]                  = $document["Location"];
        $cl["CL_VATAmount"]            = $doc_vat_amount;
        $cl["CL_WHTAmount"]            = $doc_wht_amount;
        $cl["CL_RemAmount"]            = $doc_amount - $doc_wht_amount;
        $cl["CL_Status"]               = "Open";
        $cl["CL_PostedBy"]             = $this->session->userdata('U_User_id');
        $cl["CL_DatePosted"]           = date("Y-m-d H:i:s", time());

        $this->db->insert(self::TABLE_CUSTOMER_LEDGER, $cl);

        return $cl;
    }

    private function _create_bank_account_ledger_entry($document) {

        /**
         * The following are left blank:
         * BAL_BalAccountType, BAL_BalAccountNo, BAL_BalAccountName
         */
        $account_info = $this->get_gl_debit_account_info($document);
        $doc_amount   = array_key_exists("AmountLCY", $document) ? $document["AmountLCY"] : $document["Amount"];

        $doc_cpc = array_key_exists("CPC", $document) ? $document["CPC"] : null;

        $bal["BAL_DocType"]         = $this->document_type;
        $bal["BAL_DocDate"]         = $document["DocDate"];
        $bal["BAL_DocNo"]           = $document["DocNo"];
        $bal["BAL_BankAccountNo"]   = $account_info["GL_AccountID"];
        $bal["BAL_BankAccountName"] = $account_info["GL_AccountName"];

        if ($this->debit_account_table == self::TABLE_CHART_OF_ACCOUNTS) {
            $bal["BAL_Debit"]  = $doc_amount;
            $bal["BAL_Credit"] = 0;
        } else {
            $bal["BAL_Debit"]  = 0;
            $bal["BAL_Credit"] = $doc_amount;
        }

        if ($bal["BAL_Debit"] > 0) {
            $bal["BAL_Amount"] = $bal["BAL_Debit"];
        } else {
            $bal["BAL_Amount"] = $bal["BAL_Credit"] * -1;
        }

        if (array_key_exists("Currency", $document)) {
            $bal["BAL_Currency"]  = $document["Currency"];
            $bal["BAL_AmountLCY"] = $document["AmountLCY"];
        } else {
            $bal["BAL_Currency"]  = self::DEFAULT_CURRENCY;
            $bal["BAL_AmountLCY"] = $bal["BAL_Amount"];
            $bal["BAL_Amount"]    = null;
        }

//        $bal["BAL_Company"]    = $document["Company"];
        $bal["BAL_CPC"]        = $doc_cpc;
        $bal["BAL_Status"]     = "Open";
        $bal["BAL_PostedBy"]   = $this->session->userdata('U_User_id');
        $bal["BAL_DatePosted"] = date("Y-m-d H:i:s", time());

        $this->db->insert(self::TABLE_BANK_ACCOUNT_LEDGER, $bal);

        return $bal;
    }

    private function _create_item_ledger_entries($document, $document_details) {

        foreach ($document_details AS $detail) {
            $il = array();

            if ($this->header_account_type == self::ACCOUNT_ITEM) {
                $account_id   = $detail[$this->_get_account_id_field()];
                $account_name = $detail[$this->_get_account_name_field()];

                $location = $document["Location"];
            } else {
                $account_id   = $document[$this->_get_account_id_field()];
                $account_name = $document[$this->_get_account_name_field()];

                $location = $detail["Location"];
            }

            //  pre computed fields
            $amount = $detail["Qty"] * $detail["UnitPrice"];

            //  multi name fields
            $item_type  = array_key_exists("ItemType", $detail) ? $detail["ItemType"] : $detail["ItemTypeID"];
            $amount_lcy = array_key_exists("ExchangeRate", $detail) ? $amount * $detail["ExchangeRate"] : $amount;
            $cpc        = array_key_exists("CPC", $detail) ? $detail["CPC"] : $detail["CostCenter"];

            //  optional fields
            $rem_qty      = array_key_exists("QtyToReceive", $detail) ? $detail["QtyToReceive"] : 0;
            $sub_location = array_key_exists("SubLocation", $detail) ? $detail["SubLocation"] : null;
            $uom          = array_key_exists("UOM", $detail) ? $detail["UOM"] : null;

            $il["IL_AccountType"]     = $this->header_account_type;
            $il["IL_AccountID"]       = $account_id;
            $il["IL_AccountName"]     = $account_name;
            $il["IL_DocType"]         = $this->document_type;
            $il["IL_DocNo"]           = $document["DocNo"];
            $il["IL_LineNo"]          = $detail["LineNo"];
            $il["IL_ItemType"]        = $item_type;
            $il["IL_ItemNo"]          = $detail["ItemNo"];
            $il["IL_ItemDescription"] = $detail["ItemDescription"];
            $il["IL_Qty"]             = $detail["Qty"];
            $il["IL_RemQty"]          = $rem_qty;
            $il["IL_UnitPrice"]       = $detail["UnitPrice"];
            $il["IL_Amount"]          = $amount;
            $il["IL_AmountLCY"]       = $amount_lcy;
            $il["IL_Location"]        = $location;
            $il["IL_SubLocation"]     = $sub_location;
            $il["IL_UOM"]             = $uom;
            $il["IL_Comment"]         = $detail["Comment"];
            $il["IL_CPC"]             = $cpc;
            $il["IL_VAT"]             = $detail["VAT"];
            $il["IL_WHT"]             = $detail["WHT"];
            $il["IL_PostedBy"]        = $this->session->userdata('U_User_id');
            $il["IL_DatePosted"]      = date("Y-m-d H:i:s", time());

            $this->db->insert(self::TABLE_ITEM_LEDGER, $il);
        }
    }

    private function _create_supplier_ledger_entry($document) {

        /**
         * The following fields are left blank:
         * SL_AppliesToDocType, SL_AppliesToDocNo, SL_AppliesToDocDate, SL_AppliesToID, SL_AppliedAmount
         */
        $currency     = array_key_exists("Currency", $document) ? $document["Currency"] : self::DEFAULT_CURRENCY;
        $buyer        = array_key_exists("Buyer", $document) ? $document["Buyer"] : null;
        $requested_by = array_key_exists("RequestedBy", $document) ? $document["RequestedBy"] : null;

        $sl["SL_DocType"]              = $this->document_type;
        $sl["SL_DocDate"]              = $document["DocDate"];
        $sl["SL_DocNo"]                = $document["DocNo"];
        $sl["SL_DocAmount"]            = $document["Amount"];
        $sl["SL_DocAmountLCY"]         = $document["AmountLCY"];
        $sl["SL_SupplierID"]           = $document["SupplierID"];
        $sl["SL_SupplierName"]         = $document["SupplierName"];
        $sl["SL_ExtDocNo"]             = $document["ExtDocNo"];
        $sl["SL_Currency"]             = $currency;
        $sl["SL_SupplierPostingGroup"] = $document["SupplierPostingGroup"];
        $sl["SL_PaymentTerms"]         = $document["PaymentTerms"];
        $sl["SL_DueDate"]              = $document["DueDate"];
        $sl["SL_Buyer"]                = $buyer;
        $sl["SL_RequestedBy"]          = $requested_by;
        $sl["SL_Company"]              = $document["Company"];
        $sl["SL_Location"]             = $document["Location"];
        $sl["SL_RefDocType"]           = $document["RefDocType"];
        $sl["SL_RefDocNo"]             = $document["RefDocNo"];
        $sl["SL_RefDocAmount"]         = $document["RefDocAmount"];
        $sl["SL_PostedBy"]             = $this->session->userdata('U_User_id');
        $sl["SL_DatePosted"]           = date("Y-m-d H:i:s", time());

        $this->db->insert(self::TABLE_SUPPLIER_LEDGER, $sl);

        return $sl;
    }

    private function _get_account_id_field() {
        switch ($this->header_account_type) {
            case self::ACCOUNT_CUSTOMER:
                return "CustomerID";
            case self::ACCOUNT_ITEM:
                return "ItemNo";
        }
    }

    private function _get_account_name_field() {
        switch ($this->header_account_type) {
            case self::ACCOUNT_CUSTOMER:
                return "CustomerName";
            case self::ACCOUNT_ITEM:
                return "ItemDescription";
        }
    }

//  </editor-fold>
    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="General Ledger Entry Creators">

    private function _create_gl_debit_entry($document) {

        $doc_amount     = array_key_exists("AmountLCY", $document) ? $document["AmountLCY"] : $document["Amount"];
        $doc_vat_amount = array_key_exists("VATAmount", $document) && $document["VATAmount"] ? $document["VATAmount"] : 0;
        $doc_wht_amount = array_key_exists("WHTAmount", $document) && $document["WHTAmount"] ? $document["WHTAmount"] : 0;

        $gl_account_info = $this->get_gl_debit_account_info($document);

        if ($this->debit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
            $debit = $doc_amount - $doc_vat_amount;
        } else {
            $debit = $doc_amount - $doc_wht_amount;
        }

        $debit_entry = array();

        $debit_entry["GL_DocType"]      = $this->document_type;
        $debit_entry["GL_DocNo"]        = $document["DocNo"];
        $debit_entry["GL_DocDate"]      = $document["DocDate"];
        $debit_entry["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
        $debit_entry["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
        $debit_entry["GL_Debit"]        = $debit;
        $debit_entry["GL_Credit"]       = 0;
        $debit_entry["GL_Amount"]       = $debit_entry["GL_Debit"];
        $debit_entry["GL_CPC"]          = $document["Location"];
        $debit_entry["GL_Company"]      = $document["Company"];
        $debit_entry["GL_FK_BT_BookID"] = $this->book;
        $debit_entry["GL_Status"]       = "Open";
        $debit_entry["GL_PostedBy"]     = $this->session->userdata('U_User_id');
        $debit_entry["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
        $debit_entry["GL_DateCreated"]  = date("Y-m-d H:i:s", time());

        if ($this->debit_account_table == self::TABLE_GENERAL_JOURNAL) {
            $debit_entry["GL_DatePosted"] = $document["Date"];
        }

        $this->db->insert(self::TABLE_GENERAL_LEDGER, $debit_entry);

        return $debit_entry;
    }

    private function _create_gl_debit_entries($document, $details) {

        foreach ($details AS $detail) {

            $amount     = array_key_exists("AmountLCY", $detail) ? $detail["AmountLCY"] : $detail["Amount"];
            $vat_amount = array_key_exists("VATAmount", $detail) && $detail["VATAmount"] ? $detail["VATAmount"] : 0;
            $wht_amount = array_key_exists("WHTAmount", $detail) && $detail["WHTAmount"] ? $detail["WHTAmount"] : 0;

            $gl_account_info = $this->get_gl_debit_account_info($detail);

            if ($this->debit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
                $debit = $amount - $vat_amount;
            } else {
                $debit = $amount - $wht_amount;
            }

            $debit_entry = array();

            $debit_entry["GL_DocType"]      = $this->document_type;
            $debit_entry["GL_DocNo"]        = $document["DocNo"];
            $debit_entry["GL_DocDate"]      = $document["DocDate"];
            $debit_entry["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
            $debit_entry["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
            $debit_entry["GL_Debit"]        = $debit;
            $debit_entry["GL_Credit"]       = 0;
            $debit_entry["GL_Amount"]       = $debit_entry["GL_Debit"];
            $debit_entry["GL_CPC"]          = $document["Location"];
            $debit_entry["GL_Company"]      = $document["Company"];
            $debit_entry["GL_FK_BT_BookID"] = $this->book;
            $debit_entry["GL_Status"]       = "Open";
            $debit_entry["GL_PostedBy"]     = $this->session->userdata('U_User_id');
            $debit_entry["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
            $debit_entry["GL_DateCreated"]  = date("Y-m-d H:i:s", time());

            if ($this->debit_account_table == self::TABLE_GENERAL_JOURNAL) {
                $debit_entry["GL_DatePosted"] = $document["Date"];
            }

            $this->db->insert(self::TABLE_GENERAL_LEDGER, $debit_entry);

            return $debit_entry;
        }
    }

    private function _create_gl_credit_entry($document) {

        $gl_account_info = $this->get_gl_credit_account_info($document);

        $doc_amount     = array_key_exists("AmountLCY", $document) ? $document["AmountLCY"] : $document["Amount"];
        $doc_vat_amount = array_key_exists("VATAmount", $document) && $document["VATAmount"] ? $document["VATAmount"] : 0;
        $doc_wht_amount = array_key_exists("WHTAmount", $document) && $document["WHTAmount"] ? $document["WHTAmount"] : 0;

        if ($this->credit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
            $credit = $doc_amount - $doc_vat_amount;
        } else {
            $credit = $doc_amount - $doc_wht_amount;
        }

        $credit_entry = array();

        $credit_entry["GL_DocType"]      = $this->document_type;
        $credit_entry["GL_DocNo"]        = $document["DocNo"];
        $credit_entry["GL_DocDate"]      = $document["DocDate"];
        $credit_entry["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
        $credit_entry["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
        $credit_entry["GL_Debit"]        = 0;
        $credit_entry["GL_Credit"]       = $credit;
        $credit_entry["GL_Amount"]       = $credit_entry["GL_Credit"] * -1;
        $credit_entry["GL_CPC"]          = $document["Location"];
        $credit_entry["GL_Company"]      = $document["Company"];
        $credit_entry["GL_FK_BT_BookID"] = $this->book;
        $credit_entry["GL_Status"]       = "Open";
        $credit_entry["GL_PostedBy"]     = $this->session->userdata('U_User_id');
        $credit_entry["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
        $credit_entry["GL_DateCreated"]  = date("Y-m-d H:i:s", time());

        if ($this->credit_account_table == self::TABLE_GENERAL_JOURNAL) {
            $credit_entry["GL_DatePosted"] = $document["Date"];
        }

        $this->db->insert(self::TABLE_GENERAL_LEDGER, $credit_entry);
    }

    private function _create_gl_credit_entries($document, $details) {

        $credit_entries = array();

        foreach ($details AS $detail) {

            $gl_account_info = $this->get_gl_credit_account_info($detail);

            $detail_amount     = array_key_exists("AmountLCY", $detail) ? $detail["AmountLCY"] : $detail["Amount"];
            $detail_wht_amount = $detail["WHTAmount"] ? $detail["WHTAmount"] : 0;
            $detail_vat_amount = $detail["VATAmount"] ? $detail["VATAmount"] : 0;

            if ($this->credit_account_table == self::TABLE_POSTING_GROUP_INVENTORY) {
                $credit = $detail_amount - $detail_vat_amount;
            } else {
                $credit = $detail_amount - $detail_wht_amount;
            }

            $credit_entry = array();

            $credit_entry["GL_DocType"]      = $this->document_type;
            $credit_entry["GL_DocNo"]        = $document["DocNo"];
            $credit_entry["GL_DocDate"]      = $document["DocDate"];
            $credit_entry["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
            $credit_entry["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
            $credit_entry["GL_Debit"]        = 0;
            $credit_entry["GL_Credit"]       = $credit;
            $credit_entry["GL_Amount"]       = $credit_entry["GL_Credit"] * -1;
            $credit_entry["GL_CPC"]          = $document["Location"];
            $credit_entry["GL_Company"]      = $document["Company"];
            $credit_entry["GL_FK_BT_BookID"] = $this->book;
            $credit_entry["GL_Status"]       = "Open";
            $credit_entry["GL_PostedBy"]     = $this->session->userdata('U_User_id');
            $credit_entry["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
            $credit_entry["GL_DateCreated"]  = date("Y-m-d H:i:s", time());

            if ($this->credit_account_table == self::TABLE_GENERAL_JOURNAL) {
                $credit_entry["GL_DatePosted"] = $document["Date"];
            }

            $this->db->insert(self::TABLE_GENERAL_LEDGER, $credit_entry);

            array_push($credit_entries, $credit_entry);
        }

        return $credit_entries;
    }

    private function _create_vat_entries($document, $details) {

        foreach ($details AS $detail) {

            $gl_account_info = $this->get_gl_account_vat_info($document, $detail);

            if (!$gl_account_info) {
                continue;
            }

            $vat                    = array();
            $vat["GL_DocType"]      = $this->document_type;
            $vat["GL_DocNo"]        = $document["DocNo"];
            $vat["GL_DocDate"]      = $document["DocDate"];
            $vat["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
            $vat["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
            $vat["GL_CPC"]          = $document["Location"];
            $vat["GL_Company"]      = $document["Company"];
            $vat["GL_FK_BT_BookID"] = $this->book;
            $vat["GL_Status"]       = "Open";
            $vat["GL_PostedBy"]     = $this->session->userdata('U_User_id');
            $vat["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
            $vat["GL_DateCreated"]  = date("Y-m-d H:i:s", time());  //  should be "actual system date of posting" - check later with sir jason

            if ($this->VAT_account == self::VAT_ACCOUNT_SALES) {
                $vat["GL_Debit"]  = 0;
                $vat["GL_Credit"] = $detail[$this->VAT_amount_field];
            } else if ($this->VAT_account == self::VAT_ACCOUNT_PURCHASE) {
                $vat["GL_Debit"]  = $detail[$this->VAT_amount_field];
                $vat["GL_Credit"] = 0;
            } else {
                throw new Exception("Invalid vat account {$this->VAT_account}");
            }

            if ($vat["GL_Debit"] > 0) {
                $vat["GL_Amount"] = $vat["GL_Debit"];
            } else {
                $vat["GL_Amount"] = $vat["GL_Credit"] * -1;
            }

            if ($this->debit_account_table == self::TABLE_GENERAL_JOURNAL) {
                $vat["GL_DatePosted"] = $document["Date"];
            }

            $this->db->insert(self::TABLE_GENERAL_LEDGER, $vat);
        }
    }

    private function _create_wht_entries($document, $details) {

        foreach ($details AS $detail) {

            $gl_account_info = $this->get_gl_account_wht_info($document, $detail);

            if (!$gl_account_info) {
                continue;
            }

            $wht = array();

            $wht["GL_DocType"]      = $this->document_type;
            $wht["GL_DocNo"]        = $document["DocNo"];
            $wht["GL_DocDate"]      = $document["DocDate"];
            $wht["GL_AccountID"]    = $gl_account_info["GL_AccountID"];
            $wht["GL_AccountName"]  = $gl_account_info["GL_AccountName"];
            $wht["GL_CPC"]          = $document["Location"];
            $wht["GL_Company"]      = $document["Company"];
            $wht["GL_FK_BT_BookID"] = $this->book;
            $wht["GL_Status"]       = "Open";
            $wht["GL_PostedBy"]     = $this->session->userdata('U_User_id');
            $wht["GL_DatePosted"]   = date("Y-m-d H:i:s", time());
            $wht["GL_DateCreated"]  = date("Y-m-d H:i:s", time());  //  should be "actual system date of posting" - check later with sir jason

            if ($this->WHT_account == self::WHT_ACCOUNT_REC) {
                $wht["GL_Debit"]  = $detail[$this->WHT_amount_field];
                $wht["GL_Credit"] = 0;
            } else if ($this->WHT_account == self::WHT_ACCOUNT_PAYABLE) {
                $wht["GL_Debit"]  = 0;
                $wht["GL_Credit"] = $detail[$this->WHT_amount_field];
            } else {
                throw new Exception("Invalid wht account {$this->WHT_account}");
            }

            if ($wht["GL_Debit"] > 0) {
                $wht["GL_Amount"] = $wht["GL_Debit"];
            } else {
                $wht["GL_Amount"] = $wht["GL_Credit"] * 1;
            }

            if ($this->debit_account_table == self::TABLE_GENERAL_JOURNAL) {
                $wht["GL_DatePosted"] = $document["Date"];
            }

            $this->db->insert(self::TABLE_GENERAL_LEDGER, $wht);
        }
    }

    //  </editor-fold>
    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="GL Account Info Fetchers">

    public function get_gl_debit_account_info($document) {

        if ($this->debit_account_table == self::TABLE_CHART_OF_ACCOUNTS) {
            $this->db->select(array($this->debit_account_field, "COA_AccountName"));
            $this->db->from("tblACC_ChartAccount");
            $this->db->where(array($this->debit_account_posting_code => $document[$this->debit_account_filter_field]));
        } else {
            $this->db->select(array($this->debit_account_field, "COA_AccountName"));
            $this->db->from("{$this->debit_account_table} dat");
            $this->db->join("tblACC_ChartAccount coa", "dat.{$this->debit_account_field} = coa.COA_Account_id");
            $this->db->where(array($this->debit_account_posting_code => $document[$this->debit_account_filter_field]));
        }

        $results = $this->db->get();
        $account = $results->row_array();

        if (!$account) {
            throw new Exception("Credit account for [{$document[$this->debit_account_filter_field]}] not found");
        }

        return array(
            "GL_AccountID"   => $account[$this->debit_account_field],
            "GL_AccountName" => $account["COA_AccountName"]
        );
    }

    public function get_gl_credit_account_info($document) {

        if ($this->credit_account_table == self::TABLE_CHART_OF_ACCOUNTS) {
            $this->db->select(array($this->credit_account_field, "COA_AccountName"));
            $this->db->from("tblACC_ChartAccount");
            $this->db->where(array($this->credit_account_posting_code => $document[$this->credit_account_filter_field]));
        } else {
            $this->db->select(array($this->credit_account_field, "COA_AccountName"));
            $this->db->from("{$this->credit_account_table} cat");
            $this->db->join("tblACC_ChartAccount coa", "cat.{$this->credit_account_field} = coa.COA_Account_id");
            $this->db->where(array($this->credit_account_posting_code => $document[$this->credit_account_filter_field]));
        }

        $results = $this->db->get();
        $account = $results->row_array();

        if (!$account) {
            throw new Exception("Credit account for [{$document[$this->credit_account_filter_field]}] not found");
        }

        return array(
            "GL_AccountID"   => $account[$this->credit_account_field],
            "GL_AccountName" => $account["COA_AccountName"]
        );
    }

    public function get_gl_account_vat_info($document, $detail) {

        $this->db->select(array("{$this->VAT_account}", "COA_AccountName"));
        $this->db->from("tblACC_VATPostingSetup vps");
        $this->db->join("tblACC_ChartAccount coa", "vps.{$this->VAT_account} = coa.COA_Account_id");
        $this->db->where("vps.VPS_VBPG_FK_Code", $document[$this->VBPG_field]);
        $this->db->where("vps.VPS_VPPG_FK_Code", $detail[$this->VPPG_field]);

        $results = $this->db->get();

        if (!$results) {
            return false;
        }

        $vat = $results->row_array();

        if (!$vat) {
            return false;
        }

        return array(
            "GL_AccountID"   => $vat[$this->VAT_account],
            "GL_AccountName" => $vat["COA_AccountName"]
        );
    }

    public function get_gl_account_wht_info($document, $detail) {

        $this->db->select(array("{$this->WHT_account}", "COA_AccountName"));
        $this->db->from("tblACC_WHTPostingGroupSetup wpgs");
        $this->db->join("tblACC_ChartAccount coa", "wpgs.{$this->WHT_account} = coa.COA_Account_id");
        $this->db->where("WPS_WBPG_FK_Code", $document[$this->WBPG_field]);
        $this->db->where("WPS_WPPG_FK_Code", $detail[$this->WPPG_field]);

        $results = $this->db->get();

        if (!$results) {
            return false;
//            throw new Exception("WHT account not found");
        }

        $wht = $results->row_array();

        if (!$wht) {
            return false;
        }

        return array(
            "GL_AccountID"   => $wht[$this->WHT_account],
            "GL_AccountName" => $wht["COA_AccountName"]
        );
    }

    //  </editor-fold>
}
