<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function index() {

		$product = ProductM::new();
		$product->setInvestmentType(PRODUCT_INVESTMENT_TYPE::P2PFUND);

		if ($this->input->get('investment_status') != '') {
			$product->setInvestmentStatus($this->input->get('investment_status'));
		}

        $data = array();
        $data['list'] = $product->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/p2p', $data);
        $this->load->view('admin/template/foot');
	}

    public function manage($idx = '-1') {

		$rurl = '';
		$company_type = $this->input->get('investment_type');

        $data = array();
        $data['product'] 		= ProductM::new()->setIdx($idx)->get();
		if ($data['product']->getIdx()!=null) {
			$company_type = $data['product']->getInvestmentType();
		}
		if ($company_type == PRODUCT_INVESTMENT_TYPE::STOCK) {
			$rurl = '';
			$company_type = COMPANY_TYPE::STOCK;
		} else if ($company_type == PRODUCT_INVESTMENT_TYPE::P2PFUND) {
			$rurl = '/admin/p2p/?investment_status=1';
			$company_type = COMPANY_TYPE::FUNDING;
		} else if ($company_type == PRODUCT_INVESTMENT_TYPE::LEASE) {
			$rurl = '/admin/lease/';
			$company_type = COMPANY_TYPE::LEASE;
		}
		$data['rurl']			= $rurl;
		$data['return_list'] 	= ReturnsM::new()->setProductIdx($idx)->getList();
		$data['company_list'] 	= CompanyM::new()->setType($company_type)->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/p2p_manage', $data);
        $this->load->view('admin/template/foot');
	}
}
