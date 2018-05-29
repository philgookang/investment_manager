<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function index() {

        $data = array();
        $data['list'] = ProductM::new()->setInvestmentType(PRODUCT_INVESTMENT_TYPE::STOCK)->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/stock_list', $data);
        $this->load->view('admin/template/foot');
	}

	public function manage($idx = "-1") {

        $data = array();
        $data['stock'] = ProductM::new()->setIdx($idx)->get();
		$data['company_list'] = CompanyM::new()->setType(COMPANY_TYPE::STOCK)->getList('name', 'asc');

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/stock_manage', $data);
        $this->load->view('admin/template/foot');
	}

	public function remove($idx = "-1") {
		ProductM::new()->setIdx($idx)->remove();
		redirect('/admin/stock/');
	}
}
