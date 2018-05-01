<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function report() {

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');

		$data = array();
		$data['page_date']	= $date;
		$data['analyse'] 	= ReturnsM::new()->analyse();

		$this->load->view('website/template/head_new', array('menu' => 'p2p->report'));
		$this->load->view('website/page/p2p_report', $data);
		$this->load->view('website/template/foot_new');
	}
}
