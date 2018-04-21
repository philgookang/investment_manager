<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function index() {

		$list = array();
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-06')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-07')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-08')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-09')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-10')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-11')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-12')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-01')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-02')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-04')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-06')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-07')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-08')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-09')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-10')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-11')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-12')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-01')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-02')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-04')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-06')->getList('date', 'asc', '0', '0'));

		$this->load->view('blog/page/p2p', array('list' => $list));
	}

	public function change() {

		$list = array();
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-06')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-07')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-08')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-09')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-10')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-11')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2017-12')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-01')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-02')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-04')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-06')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-07')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-08')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-09')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-10')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-11')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2018-12')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-01')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-02')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-03')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-04')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-05')->getList('date', 'asc', '0', '0'));
		array_push($list, P2pReturnsBM::new()->setSearchMonth('2019-06')->getList('date', 'asc', '0', '0'));

		$this->load->view('blog/page/p2p', array('list' => $list, 'show_marker' => 'Y'));
	}

	public function api_done() {
		P2pReturnsBM::new()->setIdx($this->input->post('idx'))->setMarker(2)->updateMarker();
	}

	public function status() {

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');
		$dateform = new DateTime($date.'');
		$return_list = P2pProductBM::new()->setHeartbeat('3')->setHeartbeatComplete($date)->getList('heartbeat_complete', 'asc', '0', '0');
		$company_list = P2pCompanyBM::new()->getList('idx', 'asc', '0', '0');

		$this->load->view('blog/page/p2p_status', array('company_list' => $company_list, 'return_list' => $return_list, 'dateform' => $dateform ));
	}
}
