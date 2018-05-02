<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lease extends CI_Controller {

	public function index() {

		$product = ProductM::new();
        $product->setInvestmentType(PRODUCT_INVESTMENT_TYPE::LEASE);

		if ($this->input->get('investment_status') != '') {
			$product->setInvestmentStatus($this->input->get('investment_status'));
		}

        $data = array();
        $data['list'] = $product->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/lease', $data);
        $this->load->view('admin/template/foot');
	}
}
