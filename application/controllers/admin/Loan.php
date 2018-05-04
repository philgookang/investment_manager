<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller {

	public function index() {

        $data = array();
        $data['list'] = ProductM::new()->setInvestmentType(PRODUCT_INVESTMENT_TYPE::LOAN)->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/loan', $data);
        $this->load->view('admin/template/foot');
	}
}
