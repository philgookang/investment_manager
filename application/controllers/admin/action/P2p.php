<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function api_done() {
		P2pReturnsBM::new()->setIdx($this->input->post('idx'))->setMarker(2)->updateMarker();
	}

	public function index() {

        $product = P2pProductBM::new()
                    ->setIdx($this->input->post('product_idx'))
					->setCompanyIdx($this->input->post('company_idx'))
                    ->setName($this->input->post('name'))
                    ->setAmount($this->input->post('amount'))
                    ->setInterest($this->input->post('interest'))
					->setTotalTime($this->input->post('total_time'))
					->setHeartbeat($this->input->post('heartbeat'))
					->setHeartbeatComplete($this->input->post('heartbeat_complete'));

        if ($product->getIdx() == '0') {
            $product->setIdx($product->create());
        } else {
            $product->update();
        }

        // remove all first
        P2pReturnsBM::new()->setProductIdx($product->getIdx())->removeAll();

        $idx_list           = $this->input->post('idx');
        $date_list          = $this->input->post('date');
        $profit_list        = $this->input->post('profit');
        $profit_late_list   = $this->input->post('profit_late');
        $tax_list           = $this->input->post('tax');
		$term_list          = $this->input->post('term');
        $service_price_list = $this->input->post('service_price');
		$marker_list 		= $this->input->post('marker');
		$type_list			= $this->input->post('type');

        for($i = 0; $i < count($idx_list); $i++) {

            $idx            = (isset($idx_list[$i])) ? $idx_list[$i] : '0';
            $date           = (isset($date_list[$i])) ? $date_list[$i] : '0';
            $profit         = (isset($profit_list[$i]) && ($profit_list[$i] != '')) ? $profit_list[$i] : '0';
            $profit_late    = (isset($profit_late_list[$i]) && ($profit_late_list[$i] != '')) ? $profit_late_list[$i] : '0';
            $tax            = (isset($tax_list[$i]) && ($tax_list[$i] != '')) ? $tax_list[$i] : '0';
			$term           = (isset($term_list[$i]) && ($term_list[$i] != '')) ? $term_list[$i] : '0';
            $service_price  = (isset($service_price_list[$i]) && ($service_price_list[$i] != '')) ? $service_price_list[$i] : '0';
			$marker 		= (isset($marker_list[$i]) && ($marker_list[$i] != '')) ? $marker_list[$i] : '0';

			$type 			= (isset($type_list[$i]) && ($type_list[$i] != '')) ? $type_list[$i] : '0';

			$profit = str_replace(',', '', $profit);
			$profit_late = str_replace(',', '', $profit_late);
			$tax = str_replace(',', '', $tax);
			$service_price = str_replace(',', '', $service_price);

            $return = P2pReturnsBM::new()
                        ->setIdx($idx)
                        ->setProductIdx($product->getIdx())
                        ->setDate($date)
                        ->setProfit($profit)
                        ->setProfitLate($profit_late)
                        ->setTax($tax)
						->setTerm($term)
                        ->setSusuro($service_price)
						->setMarker($marker)
						->setType($type);

            if ( $return->getIdx() == '0') {
                $return->create();
            } else {
                $return->update();
            }
        }

        redirect('/admin/p2p/');
	}
}
