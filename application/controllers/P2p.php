<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function report() {

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');

		$data = array();
		$data['page_date']	= $date;
		$data['analyse'] 	= ReturnsM::new()->setSearchProductInvestmentType(PRODUCT_INVESTMENT_TYPE::P2PFUND)->analyse();

		$this->load->view('website/template/head_new', array('menu' => 'p2p->report'));
		$this->load->view('website/page/p2p_report', $data);
		$this->load->view('website/template/foot_new');
	}

	public function company() {

		$company_list = CompanyM::new()->setType(COMPANY_TYPE::FUNDING)->getList('name', 'asc');
		$summary = CompanyM::new()->summary($company_list);

		$data = array();
		$data['summary'] = $summary;

		$this->load->view('website/template/head_new', array('menu' => 'p2p->company'));
		$this->load->view('website/page/p2p_company', $data);
		$this->load->view('website/template/foot_new');
	}

	public function company_view($idx) {

		$company = CompanyM::new()->setIdx($idx)->get();
		$product_list = ProductM::new()->setCompanyIdx($idx)->getList();

		$data = array();
		$data['company'] = $company;
		$data['product_list'] = $product_list;

		$this->load->view('website/template/head_new', array('menu' => 'p2p->company'));
		$this->load->view('website/page/p2p_company_view', $data);
		$this->load->view('website/template/foot_new');
	}
}
