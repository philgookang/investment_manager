<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function api_done() {
		P2pReturnsBM::new()->setIdx($this->input->post('idx'))->setMarker(2)->updateMarker();
	}

	public function index() {

        $product = ProductM::new()
                    ->setIdx($this->input->post('product_idx'))
					->setCompanyIdx($this->input->post('company_idx'))
                    ->setName($this->input->post('name'))
					->setInvestmentType($this->input->post('investment_type'))
                    ->setAmount($this->input->post('amount'))
                    ->setInterest($this->input->post('interest'))
					->setTotalTerm($this->input->post('total_term'))
					->setLateStartDate($this->input->post('late_start_date'))
					->setLateEndDate($this->input->post('late_end_date'))
					->setInvestmentStatus($this->input->post('investment_status'))
					->setInvestmentCompleteDate($this->input->post('investment_complete_date'));

        if ($product->getIdx() == null) {
            $product->setIdx($product->create());
        } else {
            $product->update();
        }

        // remove all first
        ReturnsM::new()->setProductIdx($product->getIdx())->setStatus(1)->removeAll();

        $idx_list           = $this->input->post('idx');
        $date_list          = $this->input->post('date');
        $investment_list    = $this->input->post('investment');
		$profit_list        = $this->input->post('profit');
		$bond_list        	= $this->input->post('bond');
        $profit_late_list   = $this->input->post('profit_late');
        $tax_list           = $this->input->post('tax');
		$term_list          = $this->input->post('term');
		$loan_list          = $this->input->post('loan');
        $service_price_list = $this->input->post('service_price');
		$marker_list 		= $this->input->post('marker');
		$type_list			= $this->input->post('type');

        for($i = 0; $i < count($idx_list); $i++) {

            $idx            = (isset($idx_list[$i])) ? $idx_list[$i] : '0';
            $date           = (isset($date_list[$i])) ? $date_list[$i] : '0';
			$investment		= (isset($investment_list[$i]) && ($investment_list[$i] != '')) ? $investment_list[$i] : '0';
            $profit         = (isset($profit_list[$i]) && ($profit_list[$i] != '')) ? $profit_list[$i] : '0';
			$bond			= (isset($bond_list[$i]) && ($bond_list[$i] != '')) ? $bond_list[$i] : '0';
            $profit_late    = (isset($profit_late_list[$i]) && ($profit_late_list[$i] != '')) ? $profit_late_list[$i] : '0';
            $tax            = (isset($tax_list[$i]) && ($tax_list[$i] != '')) ? $tax_list[$i] : '0';
			$term           = (isset($term_list[$i]) && ($term_list[$i] != '')) ? $term_list[$i] : '0';
			$loan           = (isset($loan_list[$i]) && ($loan_list[$i] != '')) ? $loan_list[$i] : '0';
            $service_price  = (isset($service_price_list[$i]) && ($service_price_list[$i] != '')) ? $service_price_list[$i] : '0';
			$marker 		= (isset($marker_list[$i]) && ($marker_list[$i] != '')) ? $marker_list[$i] : '0';

			$type 			= (isset($type_list[$i]) && ($type_list[$i] != '')) ? $type_list[$i] : '0';

			$investment = str_replace(',', '', $investment);
			$profit = str_replace(',', '', $profit);
			$bond = str_replace(',', '', $bond);
			$profit_late = str_replace(',', '', $profit_late);
			$tax = str_replace(',', '', $tax);
			$loan = str_replace(',', '', $loan);
			$service_price = str_replace(',', '', $service_price);

            $return = ReturnsM::new()
                        ->setIdx($idx)
                        ->setProductIdx($product->getIdx())
                        ->setDate($date)
						->setInvestment($investment)
                        ->setProfit($profit)
						->setBond($bond)
                        ->setProfitLate($profit_late)
                        ->setTax($tax)
						->setTerm($term)
						->setLoan($loan)
                        ->setFee($service_price)
						->setPaymentStatus($marker);

            if ( $return->getIdx() == '0') {
                $return->create();
            } else {
                $return->update();
            }
        }

        redirect($this->input->post('rurl'));
	}
}
