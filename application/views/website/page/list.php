<script>
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 190) {
                $("#follow").show();
            } else {
                $("#follow").hide();
            }
        });
    });

	var change_status = function(idx) {
		if (confirm('Sure?')) {
			$.post("/admin/action/p2p/api_done/", {"idx" : idx}, function() {
				location.reload();
			})
		}
	}
    var toggleButton = function() {
        $(".btn-done").toggle();
    }
</script>

<div class="container">
    <h1 onclick="toggleButton();">전체 지급 스케줄</h1>
    <h2>전체 투자기간동안 지급 예정인 상세 내역을 확인하실 수 있습니다.</h2>

    <table class="table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 100px;">지급일</th>
				<th rowspan="2" style="width: 90px;">기간</th>
                <th rowspan="2">이름</th>
				<th rowspan="2" style="width: 60px;">이자</th>
				<th rowspan="2" style="width: 70px;">회차</th>
                <th rowspan="2" style="width: 70px;">기간</th>
				<th rowspan="2" style="width: 120px;">투자금</th>
                <th colspan="5">지급예정내역</th>
                <th rowspan="2" style="width: 120px;">실지급금액</th>
            </tr>
            <tr>
                <th style="width: 105px;">원금</th>
                <th style="width: 105px;">이자</th>
                <th style="width: 105px;">연체이자</th>
                <th style="width: 105px;">세금(-)</th>
                <th style="width: 105px;">투자 수수료(-)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $returns) { ?>

                <?php
                    $total_investment = 0;
                    $total_profit = 0;
                    $total_profit_late = 0;
                    $total_tax = 0;
                    $service_price = 0;
                    $total_total = 0;
					$total_investment_returned = 0;

					$check_added_list = array();

					$current_month = null;
                ?>

                <?php foreach($returns as $row) { ?>
                    <?php
						$current_month = new DateTime($row->getDate());

						$total = 0;
                        $product = P2pProductBM::new()->setIdx($row->getProductIdx())->get();

						if (!in_array($row->getProductIdx(), $check_added_list)) {
							array_push($check_added_list, $row->getProductIdx());
							$total_investment += $product->getAmount();
						}

						if ($row->getType() == 1) {
							$total_profit += $row->getProfit();
							$total = ($row->getProfit() + $row->getProfitLate()) - ($row->getTax() + $row->getSusuro());
						} else {
							$total_investment_returned += $row->getProfit();
						}
                        $total_profit_late += $row->getProfitLate();
                        $total_tax += $row->getTax();
                        $service_price += $row->getSusuro();
                        $total_total += $total;
                    ?>
                    <tr class="status-<?php echo $row->getMarker(); ?>">
                        <td class="text-center">
							<?php echo $row->getDate(); ?>
							<?php if ($row->getMarker() == 1) { ?>
								<div class="btn-done" onclick="change_status(<?php echo $row->getIdx(); ?>);">
									받았음
								</div>
							<?php } ?>
						</td>
                        <td class="text-center"><?php echo $product->getCompanyIdx(true)->getName(); ?></td>
                        <td><?php echo $product->getName(); ?></td>
						<td class="text-center"><?php echo $product->getInterest(); ?></td>
                        <td class="text-center"><?php echo $row->getTerm(); ?></td>
						<td class="text-center"><?php echo $product->getTotalTime(); ?></td>
						<td class="text-right"><?php echo number_format($product->getAmount()); ?> 원</td>
						<?php if ($row->getType() == 1) { ?>
							<td class="text-right">0 원</td>
							<td class="text-right"><?php echo number_format($row->getProfit()); ?> 원</td>
						<?php } else { ?>
							<td class="text-right"><?php echo number_format($row->getProfit()); ?> 원</td>
							<td class="text-right">0 원</td>
						<?php } ?>
                        <td class="text-right"><?php echo number_format($row->getProfitLate()); ?> 원</td>
                        <td class="text-right"><?php echo number_format($row->getTax()); ?> 원</td>
                        <td class="text-right"><?php echo number_format($row->getSusuro()); ?> 원</td>
                        <td class="text-right"><?php echo number_format($total); ?> 원</td>
                    </tr>
                <?php } ?>
				<?php $late_summary = 0; ?>
				<?php if (isset($current_month) && (date('Y-m') == $current_month->format('Y-m'))) { ?>
					<?php
						$product = P2pProductBM::new();
						$product->setHeartbeat('2');
				        $late_list = $product->getList( 'idx', 'desc', '100', 0 );
					?>
					<?php foreach($late_list as $late) {

						$returned_list = P2pReturnsBM::new()->setProductIdx($late->getIdx())->setType(2)->getList( 'idx', 'asc', '0', '0');

						$reduce_amount = 0;
						foreach($returned_list as $ree) {
							$reduce_amount += $ree->getProfit();
						}

						$late_total_left = $late->getAmount() - $reduce_amount;
						$late_summary += $late_total_left;
						?>
						<tr class="status-3">
                            <td class="text-center">연체</td>
                            <td class="text-center">
								<?php echo $late->getCompanyIdx(true)->getName(); ?>
							</td>
                            <td colspan="2">
								<?php echo $late->getName(); ?>
							</td>
							<td class="text-right" colspan="2">
								<?php echo number_format($late_total_left); ?> 원
							</td>
							<td colspan="7">
							</td>
                        </tr>
					<?php } ?>
				<?php } ?>

				<?php if (count($returns) > 0) { ?>
					<tr class="sum_row">
                        <td class="text-center" colspan="4">합계</td>
						<td class="text-right" colspan="2">
							<span>연체총금</span>
							<?php echo number_format($late_summary); ?> 원
						</td>
						<td class="text-right">
							<span>투자금</span>
							<?php echo number_format($total_investment); ?> 원
						</td>
                        <td class="text-right">
							<span>원금 회수</span>
							<?php echo number_format($total_investment_returned); ?> 원
						</td>
                        <td class="text-right">
							<span>이자 수익</span>
							<?php echo number_format($total_profit); ?> 원
						</td>
                        <td class="text-right">
							<span>연체금</span>
							<?php echo number_format($total_profit_late); ?> 원
						</td>
                        <td class="text-right">
							<span>세금</span>
							<?php echo number_format($total_tax); ?> 원</td>
                        <td class="text-right">
							<span>투자 수수료</span>
							<?php echo number_format($service_price); ?> 원
						</td>
                        <td class="text-right">
							<span>총수익</span>
							<?php echo number_format($total_total); ?> 원
						</td>
                    </tr>
				<?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>
<!--/.container-->

<div class="container container-fixed" id="follow">
    <table class="table">
		<thead>
			<tr>
                <th rowspan="2" style="width: 100px;">지급일</th>
				<th rowspan="2" style="width: 90px;">기간</th>
                <th rowspan="2">이름</th>
				<th rowspan="2" style="width: 60px;">이자</th>
				<th rowspan="2" style="width: 70px;">회차</th>
                <th rowspan="2" style="width: 70px;">기간</th>
				<th rowspan="2" style="width: 120px;">투자금</th>
                <th colspan="5">지급예정내역</th>
                <th rowspan="2" style="width: 120px;">실지급금액</th>
            </tr>
            <tr>
                <th style="width: 105px;">원금</th>
                <th style="width: 105px;">이자</th>
                <th style="width: 105px;">연체이자</th>
                <th style="width: 105px;">세금(-)</th>
                <th style="width: 105px;">투자 수수료(-)</th>
            </tr>
        </thead>
    </table>
</div>
<!--/.container-->
