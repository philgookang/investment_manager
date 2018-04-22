<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="container">
    <h1>투자수익</h1>
    <div id="investment_load_chart" style="background-color: #dfdfdf; border: 1px solid #dfdfdf; box-sizing: border-box; padding: 1px; height: 500px;"></div>
</div>
<!--/.container-->

<div class="container">
    <h1>이번달 이자 지급 스케줄</h1>
    <table class="table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 100px;">지급일</th>
				<th rowspan="2" style="width: 90px;">회사명</th>
                <th rowspan="2">이름</th>
				<th rowspan="2" style="width: 60px;">이자</th>
				<th rowspan="2" style="width: 70px;">회차</th>
                <th rowspan="2" style="width: 70px;">기간</th>
				<th rowspan="2" style="width: 103px;">투자금</th>
                <th colspan="5">지급예정내역</th>
                <th rowspan="2" style="width: 110px;">실지급금액</th>
            </tr>
            <tr>
                <th style="width: 105px;">원금</th>
                <th style="width: 105px;">이자</th>
                <th style="width: 105px;">연체이자</th>
                <th style="width: 105px;">세금(-)</th>
                <th style="width: 105px;">수수료(-)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($summary['list'] as $investment) { ?>
                <tr class="status-<?php echo $investment->term_marker; ?>">
                    <td class="text-center">
                        <?php echo $investment->date; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->company_name; ?>
                    </td>
                    <td>
                        <?php echo $investment->product_name; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->interest_rate; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->current_term; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->investment_total_term; ?>
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->investment_amount); ?>
                    </td>
                    <?php if ($investment->type == 1) { ?>
                        <td class="text-right">0 원</td>
                        <td class="text-right"><?php echo number_format($investment->profit); ?> 원</td>
                    <?php } else { ?>
                        <td class="text-right"><?php echo number_format($investment->profit); ?> 원</td>
                        <td class="text-right">0 원</td>
                    <?php } ?>
                    <td class="text-right">
                        <?php echo number_format($investment->profit_late); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->tax); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->fee); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->total); ?> 원
                    </td>
                </tr>
            <?php } ?>
            <tr class="sum_row">
                <td class="text-center" colspan="6" style="padding-top: 0px;">합계</td>
                <td class="text-right">
                    <span>투자금</span>
                    <?php echo number_format($summary['total_investment']); ?> 원
                </td>
                <td class="text-right">
                    <span>원금 회수</span>
                    <?php echo number_format($summary['total_return_investment']); ?> 원
                </td>
                <td class="text-right">
                    <span>이자 수익</span>
                    <?php echo number_format($summary['total_profit']); ?> 원
                </td>
                <td class="text-right">
                    <span>연체금</span>
                    <?php echo number_format($summary['total_profit_late']); ?> 원
                </td>
                <td class="text-right">
                    <span>세금</span>
                    <?php echo number_format($summary['total_tax']); ?> 원
                <td class="text-right">
                    <span>수수료</span>
                    <?php echo number_format($summary['total_fee']); ?> 원
                </td>
                <td class="text-right">
                    <span>총수익</span>
                    <?php echo number_format($summary['total_value']); ?> 원
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!--/.container-->

<div class="container">
    <h1>이번달 연체금 상황</h1>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 110px;">회사명</th>
                <th>이름</th>
                <th style="width: 110px;">연체금</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_late = 0; ?>
            <?php foreach($late_list as $late) { ?>
                <?php
                    $returned_list = P2pReturnsBM::new()->setProductIdx($late->getIdx())->setType(2)->getList( 'idx', 'asc', '0', '0');

                    $reduce_amount = 0;
                    foreach($returned_list as $ree) {
                        $reduce_amount += $ree->getProfit();
                    }

                    $late_total_left = $late->getAmount() - $reduce_amount;
                    $total_late += $late_total_left;
                ?>
                <tr class="status-3">
                    <td class="text-center">
                        <?php echo $late->getCompanyIdx(true)->getName(); ?>
                    </td>
                    <td>
                        <?php echo $late->getName(); ?>
                    </td>
                    <td class="text-right">
                        <?php echo number_format($late_total_left); ?> 원
                    </td>
                </tr>
            <?php } ?>
            <tr class="sum_row">
                <td class="text-center" colspan="2" style="padding-top: 0px;"></td>
                <td class="text-right" style="padding-top: 0px;">
                    <?php echo number_format($total_late); ?> 원
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!--/.container-->

<div class="container">
    <h1>월별 상황</h1>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 140px;">날짜</th>
                <th></th>
                <th style="width: 145px;">투자금</th>
                <th style="width: 145px;">수익</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($analytics_list as $analytics) {?>
                <tr >
                    <td class="text-center">
                        <?php $d = new DateTime($analytics['month'].'-01'); echo $d->format('Y년 m월'); ?>
                    </td>
                    <td></td>
                    <td class="text-right">
                        <?php echo number_format($analytics['investment']); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($analytics['profit']); ?> 원
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!--/.container-->

<div class="container">
	<h1>기업별 투자금 상환</h1>
    <div id="business_status_chart" style="background-color: #dfdfdf; border: 1px solid #dfdfdf; box-sizing: border-box; padding: 1px; height: 400px;"></div>
    <br />
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
			<?php foreach($business['list'] as $item) { ?>
				<tr>
					<td class="text-left"><?php echo $item['name']; ?></td>
					<td class="text-right"><?php echo number_format($item['process']); ?> 원</td>
					<td class="text-right" style="background: #ffe4e438;"><?php echo number_format($item['late']); ?> 원</td>
					<td class="text-right" style="background: #00ff440a;"><?php echo number_format($item['finish']); ?> 원</td>
					<td class="text-right"><?php echo number_format($item['total']); ?> 원</td>
				</tr>
			<?php } ?>

			<tr class="sum_row">
				<td class="text-center" style="padding-top: 0px;">합계</td>
				<td class="text-right" style="padding-top: 0px;"><?php echo number_format($business['total_process']); ?> 원</td>
				<td class="text-right" style="padding-top: 0px; background: #ffe4e438;"><?php echo number_format($business['total_late']); ?> 원</td>
				<td class="text-right" style="padding-top: 0px; background: #00ff440a;"><?php echo number_format($business['total_finish']); ?> 원</td>
				<td class="text-right" style="padding-top: 0px;"><?php echo number_format($business['grand_total']); ?> 원</td>
			</tr>
		</tbody>
	</table>
</div>
<!--/.container-->

<br /><br /><br />

<script>

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawTrendlines);

    function drawTrendlines() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', '투자수익');
        data.addColumn('number', '--');

        data.addRows([
            <?php
                for($i = 0; $i < count($analytics_list); $i++) {
                    if ($i != 0) { echo ', '; }
                    echo '["'.$analytics_list[$i]['month'].'", '.$analytics_list[$i]['profit'].', 0]';
                }
            ?>
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('investment_load_chart'));
        chart.draw(data, { });

        // ============================================================

        var data = new google.visualization.DataTable();
        data.addColumn('string', '회사');
        data.addColumn('number', '상환중');
        data.addColumn('number', '연체중');
        data.addColumn('number', '상환완료');

        data.addRows([
            <?php
                for($i = 0; $i < count($business['list']); $i++) {
                    if ($i != 0) { echo ', '; }
                    echo '["'.$business['list'][$i]['name'].'", '.$business['list'][$i]['process'].', '.$business['list'][$i]['late'].', '.$business['list'][$i]['finish'].']';
                }
            ?>
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('business_status_chart'));
        chart.draw(data, { isStacked : true, colors: ['#001fff', '#ff0000', '#00ff1f'] });
    }
</script>
