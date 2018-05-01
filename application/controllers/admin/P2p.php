<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function index() {

		$product = ProductM::new();

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

        $data = array();
        $data['product'] 		= ProductM::new()->setIdx($idx)->get();
		$data['return_list'] 	= ReturnsM::new()->setProductIdx($idx)->getList();
		$data['company_list'] 	= CompanyM::new()->setType(COMPANY_TYPE::FUNDING)->getList();

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/p2p_manage', $data);
        $this->load->view('admin/template/foot');
	}
}
