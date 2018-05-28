<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {

        $date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');

        $data = array();
		$data['page_date']	= $date;
        $data['analyse'] 	= ReturnsM::new()->setSearchProductInvestmentType(PRODUCT_INVESTMENT_TYPE::P2PFUND)->analyse();
        $data['summary'] 	= ReturnsM::new()->setSearchProductInvestmentType(PRODUCT_INVESTMENT_TYPE::LEASE)->setSearchMonth($date)->getDetailList();

		$this->load->view('website/template/head_new', array('menu' => 'dashboard'));
		$this->load->view('website/page/dashboard2', $data);
		$this->load->view('website/template/foot_new');
	}
}
