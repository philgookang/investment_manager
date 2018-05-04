<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <h1>Report</h1>
    <form method="GET" action="/p2p/report/">
        <select name="date">
            <?php $dt = new DateTime(date('2017-05-01')); ?>
            <?php for($i = 0; $i < 30; $i++) { ?>
                <?php $dt->modify('+1 month'); ?>
                <option value="<?php echo $dt->format('Y-m'); ?>" <?php echo ($dt->format('Y-m') == $page_date)?'selected':''; ?>>
                    <?php echo $dt->format('Y-m'); ?> <?php echo ($dt->format('Y-m') == date('Y-m'))?'(금월)':''; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" value="검색"/>
    </form>
</div>
<div class="row">
    <div id="investment_load_chart" class="graph"></div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2" style="width: 100px;">지급일</th>
			<th>회사명</th>
			<th style="width: 50px;">이자</th>
			<th style="width: 50px;">회차</th>
            <th style="width: 50px;">기간</th>
            <th style="width: 120px;">원금</th>
            <th style="width: 120px;">이자</th>
            <th style="width: 120px;">상품권</th>
            <th rowspan="2" style="width: 110px;">실지급금액</th>
        </tr>
        <tr>
            <th>상품명</th>
            <th colspan="3">투자금</th>
            <th>연체이자</th>
            <th>세금(-)</th>
            <th>수수료(-)</th>
        </tr>
    </thead>
    <?php foreach($analyse as $summary) { ?>
        <?php if ($summary['month'] == $page_date) { ?>
            <tbody>
                <?php foreach($summary['summary']['list'] as $investment) { ?>
                    <tr class="status-<?php echo $investment->payment_status; ?>">
                        <td class="text-center" rowspan="2">
                            <?php $d = new DateTime($investment->date); echo $d->format('m월 d일'); ?>
                        </td>
                        <td class="text-left">
                            <?php echo $investment->company_name; ?>
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
                            <?php echo number_format($investment->investment); ?> 원
                        </td>
                        <td class="text-right">
                            <?php echo number_format($investment->profit); ?> 원
                        </td>
                        <td class="text-right">
                            <?php echo number_format($investment->bond); ?> 원
                        </td>
                        <td class="text-right" rowspan="2">
                            <?php echo number_format($investment->total); ?> 원
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="dot-dot">
                                <?php echo $investment->product_name; ?>
                            </div>
                        </td>
                        <td class="text-right" colspan="3">
                            <?php echo number_format($investment->investment_amount); ?>
                        </td>
                        <td class="text-right">
                            <?php echo number_format($investment->profit_late); ?> 원
                        </td>
                        <td class="text-right">
                            <?php echo number_format($investment->tax); ?> 원
                        </td>
                        <td class="text-right">
                            <?php echo number_format($investment->fee); ?> 원
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="2" rowspan="2" style="padding-top: 0px;">합계</td>
                    <td class="text-right" colspan="3" rowspan="2">
                        <span>투자금</span>
                        <?php echo number_format($summary['summary']['total_investment']); ?> 원
                    </td>
                    <td class="text-right">
                        <span>원금 회수</span>
                        <?php echo number_format($summary['summary']['total_return_investment']); ?> 원
                    </td>
                    <td class="text-right">
                        <span>이자 수익</span>
                        <?php echo number_format($summary['summary']['total_profit']); ?> 원
                    </td>
                    <td class="text-right">
                        <span>상품권</span>
                        <?php echo number_format($summary['summary']['total_bond']); ?> 원
                    </td>
                    <td class="text-right" rowspan="2">
                        <span>총수익</span>
                        <?php echo number_format($summary['summary']['total_value']); ?> 원
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <span>연체금</span>
                        <?php echo number_format($summary['summary']['total_profit_late']); ?> 원
                    </td>
                    <td class="text-right">
                        <span>세금</span>
                        <?php echo number_format($summary['summary']['total_tax']); ?> 원
                    <td class="text-right">
                        <span>수수료</span>
                        <?php echo number_format($summary['summary']['total_fee']); ?> 원
                    </td>
                </tr>
            </tfoot>
        <?php } ?>
    <?php } ?>
</table>

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawTrendlines);
    function drawTrendlines() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', '투자수익');

        data.addRows([
            <?php
                for($i = 0; $i < count($analyse); $i++) {
                    if ($i != 0) { echo ', '; }
                    echo '["'.$analyse[$i]['month'].'", '.$analyse[$i]['profit'].']';
                }
            ?>
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('investment_load_chart'));
        chart.draw(data, { });
    }
</script>
