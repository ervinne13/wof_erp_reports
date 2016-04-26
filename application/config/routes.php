<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['app']    = "app/dashboard";
$route['admin']  = "admin/index";

$loc = array('administration','warehouse-management','financial-management','fixed-asset-management','human-resource-recruitment','purchasing','reports','sales-operation','repairs-maintenance','ticket-redemption','returns');
foreach ($loc as $key => $value) {
	$route['app/'.$value]  = "app/".$value."/index";
}

$route['app/returns/edit'] = 'app/returns/index/edit';

$route['app/financial-management/customer'] 				= 'app/administration/customer';
$route['app/financial-management/customer/update'] 			= 'app/administration/customer/update';
$route['app/financial-management/customer/add'] 			= 'app/administration/customer/add';
$route['app/financial-management/customer/back/(:any)'] 	= 'app/administration/customer/back/$1';
$route['app/financial-management/customer/customer_ledger'] = 'app/administration/customer/customer_ledger';

$route['app/financial-management/supplier'] 				= 'app/administration/supplier';
$route['app/financial-management/supplier/update'] 			= 'app/administration/supplier/update';
$route['app/financial-management/supplier/add'] 			= 'app/administration/supplier/add';
$route['app/financial-management/supplier/back/(:any)'] 	= 'app/administration/supplier/back/$1';
$route['app/financial-management/supplier/supplier_ledger'] = 'app/administration/supplier/supplier_ledger';

$route['app/purchasing/requisition'] 				= 'app/financial-management/requisition';
$route['app/purchasing/requisition/update'] 		= 'app/financial-management/requisition/update';
$route['app/purchasing/requisition/add'] 			= 'app/financial-management/requisition/add';
$route['app/purchasing/requisition/back/(:any)'] 	= 'app/financial-management/requisition/back/$1';
$route['app/purchasing/requisition/view'] 			= 'app/financial-management/requisition/view';

$route['app/purchasing/document-approval'] 			= 'app/financial-management/document-approval';
$route['app/sales-operation/document-approval'] 	= 'app/financial-management/document-approval';
$route['app/warehouse-management/document-approval']= 'app/financial-management/document-approval';

/*WAREHOUSE MANAGEMENT*/
$route['app/warehouse-management/requisition'] 				= 'app/financial-management/requisition';
$route['app/warehouse-management/requisition/update'] 		= 'app/financial-management/requisition/update';
$route['app/warehouse-management/requisition/add'] 			= 'app/financial-management/requisition/add';
$route['app/warehouse-management/requisition/back/(:any)'] 	= 'app/financial-management/requisition/back/$1';
$route['app/warehouse-management/requisition/view'] 		= 'app/financial-management/requisition/view';

$route['app/warehouse-management/item-master'] 				= 'app/administration/item-master';
$route['app/warehouse-management/item-master/add'] 			= 'app/administration/item-master/add';
$route['app/warehouse-management/item-master/update'] 		= 'app/administration/item-master/update';
$route['app/warehouse-management/item-master/back/(:any)'] 	= 'app/administration/item-master/back/$1';

$route['app/warehouse-management/item-re-class-journal'] 			 = 'app/sales-operation/item-re-class-journal';
$route['app/warehouse-management/item-re-class-journal/update'] 	 = 'app/sales-operation/item-re-class-journal/update';
$route['app/warehouse-management/item-re-class-journal/add'] 		 = 'app/sales-operation/item-re-class-journal/add';
$route['app/warehouse-management/item-re-class-journal/back/(:any)'] = 'app/sales-operation/item-re-class-journal/back/$1';
$route['app/warehouse-management/item-re-class-journal/view'] 		 = 'app/sales-operation/item-re-class-journal/view';
$route['app/warehouse-management/item-re-class-journal/data'] 	     = 'app/sales-operation/item-re-class-journal/data';


$route['app/warehouse-management/purchase-order'] 				= 'app/purchasing/purchase-order';
$route['app/warehouse-management/purchase-order/update'] 		= 'app/purchasing/purchase-order/update';
$route['app/warehouse-management/purchase-order/add'] 			= 'app/purchasing/purchase-order/add';
$route['app/warehouse-management/purchase-order/back/(:any)'] 	= 'app/purchasing/purchase-order/back/$1';
$route['app/warehouse-management/purchase-order/view'] 			= 'app/purchasing/purchase-order/view';
$route['app/warehouse-management/purchase-order/data'] 			= 'app/purchasing/purchase-order/data';

$route['app/warehouse-management/transfer-order'] 				= 'app/sales-operation/transfer-order';
$route['app/warehouse-management/transfer-order/update'] 		= 'app/sales-operation/transfer-order/update';
$route['app/warehouse-management/transfer-order/add'] 			= 'app/sales-operation/transfer-order/add';
$route['app/warehouse-management/transfer-order/back/(:any)'] 	= 'app/sales-operation/transfer-order/back/$1';
$route['app/warehouse-management/transfer-order/view'] 			= 'app/sales-operation/transfer-order/view';
$route['app/warehouse-management/transfer-order/data'] 			= 'app/sales-operation/transfer-order/data';
$route['app/warehouse-management/transfer-order/pendingRQ'] 	= 'app/sales-operation/transfer-order/pendingRQ';
$route['app/warehouse-management/transfer-order/process'] 	    = 'app/sales-operation/transfer-order/process';

$route['app/warehouse-management/transfer-order-local'] 			= 'app/sales-operation/transfer-order-local';
$route['app/warehouse-management/transfer-order-local/update'] 		= 'app/sales-operation/transfer-order-local/update';
$route['app/warehouse-management/transfer-order-local/add'] 		= 'app/sales-operation/transfer-order-local/add';
$route['app/warehouse-management/transfer-order-local/back/(:any)'] = 'app/sales-operation/transfer-order-local/back/$1';
$route['app/warehouse-management/transfer-order-local/view'] 		= 'app/sales-operation/transfer-order-local/view';
$route['app/warehouse-management/transfer-order-local/data'] 		= 'app/sales-operation/transfer-order-local/data';
$route['app/warehouse-management/transfer-order-local/pendingRQ'] 	= 'app/sales-operation/transfer-order-local/pendingRQ';
$route['app/warehouse-management/transfer-order-local/process'] 	= 'app/sales-operation/transfer-order-local/process';

$route['app/warehouse-management/physical-count'] 				= 'app/sales-operation/physical-count';
$route['app/warehouse-management/physical-count/update'] 		= 'app/sales-operation/physical-count/update';
$route['app/warehouse-management/physical-count/add'] 			= 'app/sales-operation/physical-count/add';
$route['app/warehouse-management/physical-count/back/(:any)'] 	= 'app/sales-operation/physical-count/back/$1';
$route['app/warehouse-management/physical-count/view'] 			= 'app/sales-operation/physical-count/view';
$route['app/warehouse-management/physical-count/data'] 			= 'app/sales-operation/physical-count/data';
$route['app/warehouse-management/physical-count/viewdetail'] 	= 'app/sales-operation/physical-count/viewdetail';


$route['app/warehouse-management/reimbursement'] 			= 'app/financial-management/reimbursement';
$route['app/warehouse-management/reimbursement/update'] 	= 'app/financial-management/reimbursement/update';
$route['app/warehouse-management/reimbursement/add'] 		= 'app/financial-management/reimbursement/add';
$route['app/warehouse-management/reimbursement/back/(:any)']= 'app/financial-management/reimbursement/back/$1';
$route['app/warehouse-management/reimbursement/view'] 		= 'app/financial-management/reimbursement/view';

$route['app/warehouse-management/petty-cash-request'] 				= 'app/financial-management/revolving-fund-voucher';
$route['app/warehouse-management/petty-cash-request/update'] 		= 'app/financial-management/revolving-fund-voucher/update';
$route['app/warehouse-management/petty-cash-request/add'] 			= 'app/financial-management/revolving-fund-voucher/add';
$route['app/warehouse-management/petty-cash-request/back/(:any)'] 	= 'app/financial-management/revolving-fund-voucher/back/$1';
$route['app/warehouse-management/petty-cash-request/view'] 			= 'app/financial-management/revolving-fund-voucher/view';

$route['app/warehouse-management/petty-cash-replenishment'] 			= 'app/financial-management/revolving-fund-replenishment';
$route['app/warehouse-management/petty-cash-replenishment/update'] 		= 'app/financial-management/revolving-fund-replenishment/update';
$route['app/warehouse-management/petty-cash-replenishment/add'] 		= 'app/financial-management/revolving-fund-replenishment/add';
$route['app/warehouse-management/petty-cash-replenishment/back/(:any)'] = 'app/financial-management/revolving-fund-replenishment/back/$1';
$route['app/warehouse-management/petty-cash-replenishment/view'] 		= 'app/financial-management/revolving-fund-replenishment/view';

$route['app/warehouse-management/request-payment'] 				= 'app/financial-management/request-payment';
$route['app/warehouse-management/request-payment/update'] 		= 'app/financial-management/request-payment/update';
$route['app/warehouse-management/request-payment/add'] 			= 'app/financial-management/request-payment/add';
$route['app/warehouse-management/request-payment/back/(:any)'] 	= 'app/financial-management/request-payment/back/$1';
$route['app/warehouse-management/request-payment/view'] 		= 'app/financial-management/request-payment/view';

$route['app/warehouse-management/cash-advance'] 			= 'app/financial-management/cash-advance';
$route['app/warehouse-management/cash-advance/update'] 		= 'app/financial-management/cash-advance/update';
$route['app/warehouse-management/cash-advance/add'] 		= 'app/financial-management/cash-advance/add';
$route['app/warehouse-management/cash-advance/back/(:any)'] = 'app/financial-management/cash-advance/back/$1';
$route['app/warehouse-management/cash-advance/view'] 		= 'app/financial-management/cash-advance/view';

$route['app/warehouse-management/debit-credit-memo'] 			 = 'app/financial-management/debit-credit-memo';
$route['app/warehouse-management/debit-credit-memo/update'] 	 = 'app/financial-management/debit-credit-memo/update';
$route['app/warehouse-management/debit-credit-memo/add'] 		 = 'app/financial-management/debit-credit-memo/add';
$route['app/warehouse-management/debit-credit-memo/back/(:any)'] = 'app/financial-management/debit-credit-memo/back/$1';
$route['app/warehouse-management/debit-credit-memo/view'] 		 = 'app/financial-management/debit-credit-memo/view';
$route['app/warehouse-management/debit-credit-memo/data'] 		 = 'app/financial-management/debit-credit-memo/data';
$route['app/warehouse-management/debit-credit-memo/process'] 		 = 'app/financial-management/debit-credit-memo/process';



/* Sales Opertation Returns */
$route['app/sales-operation/returns'] = 'app/sales-operation/issuance';
$route['app/sales-operation/returns/(:any)/(:any)'] = "app/sales-operation/issuance/$1/$2";
