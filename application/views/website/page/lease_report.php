<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <h1>Report</h1>
    <form method="GET" action="/lease/report/">
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
			<th>건물 & 호수</th>
			<th style="width: 50px;">회차</th>
            <th style="width: 50px;">기간</th>
            <th style="width: 150px;">투자금</th>
            <th style="width: 130px;">보조금</th>
            <th style="width: 130px;">원세</th>
            <th style="width: 130px;">세금(-)</th>
            <th style="width: 130px;">대출이자(-)</th>
            <th rowspan="2" style="width: 130px;">실지급금액</th>
        </tr>
    </thead>
    <?php if (isset($summary['list'])) { ?>
        <tbody>
            <?php foreach($summary['list'] as $investment) { ?>
                <tr class="status-<?php echo $investment->payment_status; ?>">
                    <td class="text-center" rowspan="2">
                        <?php $d = new DateTime($investment->date); echo $d->format('m월 d일'); ?>
                    </td>
                    <td class="text-left">
                        <?php echo $investment->company_name; ?> <?php echo $investment->product_name; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->current_term; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $investment->investment_total_term; ?>
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->investment_amount); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->investment); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->profit); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->tax); ?> 원
                    </td>
                    <td class="text-right">
                        <?php echo number_format($investment->fee); ?> 원
                    </td>
                    <td class="text-right" rowspan="2">
                        <?php echo number_format($investment->total); ?> 원
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-center" colspan="4" style="padding-top: 0px;">합계</td>
                <td class="text-right">
                    <span>투자금</span>
                    <?php echo number_format($summary['total_investment']); ?> 원
                </td>
                <td class="text-right">
                    <span>총 보조금</span>
                    <?php echo number_format($summary['total_return_investment']); ?> 원
                </td>
                <td class="text-right">
                    <span>월세</span>
                    <?php echo number_format($summary['total_profit']); ?> 원
                </td>
                <td class="text-right">
                    <span>세금</span>
                    <?php echo number_format($summary['total_tax']); ?> 원
                <td class="text-right">
                    <span>수수료</span>
                    <?php echo number_format($summary['total_fee']); ?> 원
                </td>
                <td class="text-right" rowspan="2">
                    <span>총수익</span>
                    <?php echo number_format($summary['total_value']); ?> 원
                </td>
            </tr>
        </tfoot>
    <?php } ?>
</table>

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawTrendlines);
    function drawTrendlines() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', '월세');
        data.addColumn('number', '대출이자');
        data.addColumn('number', '수익');

        data.addRows([
            <?php
                for($i = 0; $i < count($analyse); $i++) {
                    if ($i != 0) { echo ', '; }
                    echo '["'.$analyse[$i]['month'].'", '.$analyse[$i]['profit'].', 0]';
                }
            ?>
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('investment_load_chart'));
        chart.draw(data, { });
    }
</script>
