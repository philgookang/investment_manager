<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lease extends CI_Controller {

	public function report() {

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');

        $data = array();
		$data['page_date']	= $date;
		$data['summary'] 	= ReturnsM::new()->setSearchProductInvestmentType(PRODUCT_INVESTMENT_TYPE::LEASE)->setSearchMonth($date)->getDetailList();

		$this->load->view('website/template/head_new', array('menu' => 'lease->report'));
		$this->load->view('website/page/lease_report', $data);
		$this->load->view('website/template/foot_new');
	}
}
