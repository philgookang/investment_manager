<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function index() {

        $company = CompanyM::new();

        if ($this->input->get('type')) {
            $company->setType($this->input->get('type'));
        } else {
            redirect('/admin/company/?type='.COMPANY_TYPE::FUNDING);
            return;
        }

        $data = array();
        $data['list'] = $company->getList('idx', 'desc');

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/company_list', $data);
        $this->load->view('admin/template/foot');
	}

    public function manage($idx = '') {

        $company = CompanyM::new()->setIdx($idx)->get();

        if ($this->input->get('type')) {
            $company->setType($this->input->get('type'));
        }

        $data = array();
        $data['company'] = $company;

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/company_manage', $data);
        $this->load->view('admin/template/foot');
    }

    public function save($idx = "-1") {

        $company = CompanyM::new()
                    ->setType($this->input->post('type'))
                    ->setName($this->input->post('name'));
        if ($idx == "-1") {
            $company->create();
        } else {
            $company->setIdx($idx);
            $company->update();
        }

        redirect('/admin/company/?type='.$company->getType());
    }

    public function remove($idx = "-1") {

    }
}
