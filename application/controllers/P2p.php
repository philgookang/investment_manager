<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function index() {

		$next_month = new DateTime(date('Y-m-d'));
		$next_month->modify('+1 month');

		$summary 		= P2pReturnsBM::summary(P2pReturnsBM::new()->setSearchMonth(date('Y-m'))->getListJoin());
		$late_list 		= P2pProductBM::new()->setHeartbeat('2')->getList( 'idx', 'desc', '0', 0 );

		$data = array();
		$data['analytics_list'] 	= $this->analytics();
		$data['late_list']			= $late_list;
		$data['new_list']			= P2pProductBM::new()->setNewDate($next_month->format('Y-m'))->getNewList();
		$data['summary'] 			= $summary;
		$data['business']			= $this->business_status();

		$this->load->view('website/template/head');
		$this->load->view('website/page/dashboard', $data);
		$this->load->view('website/template/foot');
	}

	public function analytics() {

		$summary_list = array();
		$date = new DateTime('2017-03-01');
		$total_investment = 0;
		for($i = 0; $i < 40; $i++) {
			$date->modify('+1 month');

			$summary = P2pReturnsBM::summary(P2pReturnsBM::new()->setSearchMonth($date->format('Y-m'))->getListJoin());
			if (count($summary) > 0) {
				$summary_list[$date->format('Y-m')] = $summary;
			}

			$date = new DateTime($date->format('Y-m-d'));
		}

		$analytics = array();
		foreach($summary_list as $key=>$summary) {
			array_push($analytics, array(
				'month' 		=> $key,
				'investment' 	=> $summary['total_investment'],
				'profit' 		=> $summary['total_value']
			));
		}

		return $analytics;
	}

	public function business_status() {

		$company_list 	= P2pCompanyBM::new()->getList('idx', 'asc', '0', '0');

		$total_process = 0;
		$total_late = 0;
		$total_finish = 0;
		$grand_total = 0;

		$sublist = array();

		foreach( $company_list as $company) {

			$process = 0;
			$late = 0;
			$finish = 0;
			$total = 0;

			$product_list = P2pProductBM::new()->setCompanyIdx($company->getIdx())->getList('name', 'desc', '0', '0');

			foreach($product_list as $product) {
				if ($product->getHeartbeat() == 1) {
					$process += $product->getAmount();
				} else if ($product->getHeartbeat() == 2) {
					$late += $product->getAmount();
				} else if ($product->getHeartbeat() == 3) {
					$finish += $product->getAmount();
				}

				$total += $product->getAmount();
			}

			array_push($sublist, array(
				'process' 	=> $process,
				'late' 		=> $late,
				'finish' 	=> $finish,
				'total' 	=> $total,
				'name'		=> $company->getName()
			));

			$total_process += $process;
			$total_late += $late;
			$total_finish += $finish;
			$grand_total += $total;
		}

		return array(
			'list' 			=> $sublist,
			'total_process' => $total_process,
			'total_late' 	=> $total_late,
			'total_finish' 	=> $total_finish,
			'grand_total' 	=> $grand_total
		);
	}

	public function all() {

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

		$this->load->view('website/template/head');
		$this->load->view('website/page/list', array('list' => $list));
		$this->load->view('website/template/foot');
	}

	public function status() {

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m');
		$dateform = new DateTime($date.'');
		$return_list = P2pProductBM::new()->setHeartbeat('3')->setHeartbeatComplete($date)->getList('heartbeat_complete', 'asc', '0', '0');
		$company_list = P2pCompanyBM::new()->getList('idx', 'asc', '0', '0');

		$this->load->view('website/template/head');
		$this->load->view('website/page/status', array('company_list' => $company_list, 'return_list' => $return_list, 'dateform' => $dateform ));
		$this->load->view('website/template/foot');
	}
}
