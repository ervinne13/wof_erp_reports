<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/tcpdf/tcpdf.php";

class Pdf{
	
	public $pdf;
	
	function __construct() {
		$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}
	
	public function generate($opts) {
		$options = array_merge(array('content'		=> '',
									 'filename'		=> 'output.pdf',
									 'type'			=> 'FD', # I = display pdf | FD = force DL | F = generate a file
									 'path'			=> '',
									 'output'		=> '',
									 'orientation'	=> 'P'), $opts);

	
		extract($options);
							 
		if(!empty($path)) {
			if(!file_exists($path)) mkdir($path, 0777);			
			if($type == 'F') $filename = $path . $filename;
		}
		
		$this->pdf->setHeaderFont(array('helvetica', '', 10));
		$this->pdf->setFooterFont(array('helvetica', '', 8));
		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont('helvetica');
		// set margins
		$this->pdf->SetMargins(15, 15, 15); // left, top, right
		$this->pdf->SetHeaderMargin(15); 
		$this->pdf->SetFooterMargin(15);
		// set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, 25);
		// set image scale factor
		$this->pdf->setImageScale('1.25');
		// set font
		$this->pdf->SetFont('helvetica', '', 10);
		
		if(is_array($content)) {
			foreach($content as $c) {
				// add a page
				$this->pdf->AddPage($orientation);
				// output the HTML content
				$this->pdf->writeHTML($c['cont'], true, false, true, false, '');
				// graph
				if(isset($c['graph'])) {
					foreach($c['graph'] as $g) {
						$this->pdf->ImageSVG("@" . $g['data'], $x = $g['xpos'], $y = $g['ypos'], $w = '200', $h = '135', $link = '', $align = '', $palign = '', $border = 1, $fitonpage = true);
					}
				}
			}
		} else {
			// add a page
			$this->pdf->AddPage($orientation);
			// output the HTML content
			$this->pdf->writeHTML($content, true, false, true, false, '');
		}
		
		// reset pointer to the last page
		$this->pdf->lastPage();
		
		// ---------------------------------------------------------
		
		// close and output PDF document
		$this->pdf->Output($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/'.$filename, $type);
	}
	
}