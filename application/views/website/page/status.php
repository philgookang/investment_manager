<div class="container">
	<h1>기업별 투자금 상환</h1>
	<table class="table">
		<thead>
			<tr>
				<th>기업명</th>
				<th style="width: 205px;">상환중</th>
				<th style="width: 205px; background: #ffe4e438;">연체중</th>
				<th style="width: 205px; background: #00ff440a;">상환완료</th>
				<th style="width: 205px;">합계</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$total_process = 0;
				$total_late = 0;
				$total_finish = 0;
				$grand_total = 0;
			?>
			<?php foreach($company_list as $company) { ?>
				<?php

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

					$total_process += $process;
					$total_late += $late;
					$total_finish += $finish;
					$grand_total += $total;
				?>
				<tr>
					<td class="text-left"><?php echo $company->getName(); ?></td>
					<td class="text-right"><?php echo number_format($process); ?> 원</td>
					<td class="text-right" style="background: #ffe4e438;"><?php echo number_format($late); ?> 원</td>
					<td class="text-right" style="background: #00ff440a;"><?php echo number_format($finish); ?> 원</td>
					<td class="text-right"><?php echo number_format($total); ?> 원</td>
				</tr>
			<?php } ?>

			<tr class="sum_row">
				<td class="text-center">합계</td>
				<td class="text-right"><?php echo number_format($total_process); ?> 원</td>
				<td class="text-right" style="background: #ffe4e438;"><?php echo number_format($total_late); ?> 원</td>
				<td class="text-right" style="background: #00ff440a;"><?php echo number_format($total_finish); ?> 원</td>
				<td class="text-right"><?php echo number_format($grand_total); ?> 원</td>
			</tr>
		</tbody>
	</table>

	<h1><?php echo $dateform->format('m'); ?>월 상환 상품</h1>
	<table class="table">
		<thead>
			<tr>
				<th style="width: 105px;">상환일</th>
				<th style="width: 105px;">기업</th>
				<th>상품명</th>
				<th style="width: 205px;">이자</th>
				<th style="width: 205px;">투자금</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$total = 0;
			?>
			<?php foreach($return_list as $product) { ?>
				<?php $total += $product->getAmount(); ?>
				<tr>
					<td class="text-center"><?php echo $product->getHeartbeatComplete(); ?></td>
					<td class="text-center"><?php echo $product->getCompanyIdx(true)->getName(); ?></td>
					<td class="text-left"><?php echo $product->getName(); ?></td>
					<td class="text-center"><?php echo $product->getInterest(); ?>%</td>
					<td class="text-right"><?php echo number_format($product->getAmount()); ?> 원</td>
				</tr>
			<?php } ?>

			<tr class="sum_row">
				<td class="text-center" colspan="4">합계</td>
				<td class="text-right"><?php echo number_format($total); ?> 원</td>
			</tr>
		</tbody>
	</table>

	<br /><br />
</div>
<!--/.container-->
