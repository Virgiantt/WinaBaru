<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Mypdf {
	protected $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'portrait') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
	}

	public function miring($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'landscape') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
	}

	public function baliknama($view, $data = array(), $filename = 'Balik Nama', $paper = 'A4', $orientation = 'portrait') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
	}

	public function air_tangki($view, $data = array(), $filename = 'Balik Nama', $paper = 'A4', $orientation = 'portrait') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
	}

	public function tagihan_rekening($view, $data = array(), $filename = 'Laporan', $paper = 'A5', $orientation = 'landscape') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => FALSE));
	}

	public function spk($view, $data = array(), $filename, $paper = 'A4', $orientation = 'portrait') {
		$dompdf = new Dompdf();
  
		$html = $this->ci->load->view($view, $data, TRUE);
  
		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);
		$dompdf->render();
  
		// Pastikan tidak ada output lain sebelum PDF dikirim
		ob_end_clean();
  
		// Set header agar PDF ditampilkan di browser
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '.pdf"');
		header('Cache-Control: public, must-revalidate, max-age=0');
		header('Pragma: public');
		header('Expires: 0');
  
		$dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
  }
  
  
	public function tesges($view, $data = array(), $filename, $paper = 'A4', $orientation = 'portrait') {
		$dompdf = new Dompdf();

		$html = $this->ci->load->view($view, $data, TRUE);

		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename.".pdf", array("Attachment" => TRUE));
	}
}