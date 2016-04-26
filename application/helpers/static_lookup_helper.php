<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('static_lookup')) {
    function static_lookup($data) {
      
        $config =  array(
                     'storetype'    => array(   '1'=>'Department',
                                                '2'=>'Main Office',
                                                '3'=>'Satellite',
                                                '4'=>'Satellite with Separate Book',
                                                '5'=>'Mother Store'
                                          ),

                     'cpc_class'    => array(   '1'=>'Department',
                                                '2'=>'Store',
                                          ),
                     'account_type' => array(   '100000'=>'Asset',
                                                '200000'=>'Liability',
                                                '300000'=>'Equity',
                                                '400000'=>'Sales & Others',
                                                '500000'=>'Operating Expense',
                                                '600000'=>'Other Income/Expense',
                                                '700000'=>'General & Administrative Expense',
                                          ),
                     'account_nature' => array( '1'=>'Credit',
                                                '2'=>'Debit',
                                          ),
                     'account_level' => array(  '1'=>'Main Account',
                                                '2'=>'Sub Account',
                                          ),
                     'bs_is'         => array(  '0'=>'Balance Sheet',
                                                '1'=>'Income Statement',
                                          ),
                     'period'        => array(  '0'=>'Monthly',
                                                '1'=>'Semi Monthly',
                                          ),
                     'position_group'=> array(  '1000'=>'Rank & File',
                                                '2000'=>'Supervisor 1',
                                                '3000'=>'Supervisor 2',
                                                '4000'=>'Manager',
                                                '5000'=>'Director',
                                                '6000'=>'Executive Director',
                                                '7000'=>'General Manager',
                                                '8000'=>'President'
                                          ),
                     'supplier_type' => array(  '1000'=>'Local',
                                                '2000'=>'Foreign',
                                                '3000'=>'Employee'
                                          ),
                     'applies_to_rq' => array(  '1000'=>'Job Order',
                                                '2000'=>'Amortization Loan'
                                          ),
                     'amortization_type' => array(  '1000'=>'Prepaid Expense',
                                                    '2000'=>'Loan Account',
                                                    '3000'=>'Penalty Account',
                                                    '4000'=>'Interest Account',
                                                    '5000'=> 'Accrual Account',
                                          ),
                     'account_type' => array(   '1'=>'Current Account',
                                                '2'=>'Savings Account',
                                                '3'=>'Current and Savings Account',
                                          ),

                     'source_of_fund' => array( '1' => 'Petty Cash Fund',
                                                '2' => 'Low Point Fund',
                                                '3' => 'Repair Fund',
                                                '4' => 'Revolving Fund ',
                                              ),
                     );

      return $config[$data];
    }
}
