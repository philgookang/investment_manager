<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <h1>Company</h1>
</div>
<div class="row">
    <div id="company_chart" class="graph"></div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
			<th>회사명</th>
			<th style="width: 160px;">상환중</th>
			<th style="width: 160px;">연체중</th>
            <th style="width: 160px;">상환완료</th>
            <th style="width: 160px;">합계</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($summary['list'] as $company) { ?>
            <tr>
                <td class="text-left">
                    <a href="/p2p/company_view/<?php echo $company['idx']; ?>">
                        <?php echo $company['name']; ?>
                    </a>
                </td>
                <td class="text-right">
                    <?php echo number_format($company['process']); ?> 원
                </td>
                <td class="text-right">
                    <?php echo number_format($company['late']); ?> 원
                </td>
                <td class="text-right">
                    <?php echo number_format($company['finish']); ?> 원
                </td>
                <td class="text-right">
                    <?php echo number_format($company['total']); ?> 원
                </td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="text-center" style="padding: 15px;">합계</td>
            <td class="text-right" style="padding: 15px;">
                <?php echo number_format($summary['total_process']); ?> 원
            </td>
            <td class="text-right" style="padding: 15px;">
                <?php echo number_format($summary['total_late']); ?> 원
            </td>
            <td class="text-right" style="padding: 15px;">
                <?php echo number_format($summary['total_finish']); ?> 원
            </td>
            <td class="text-right" style="padding: 15px;">
                <?php echo number_format($summary['grand_total']); ?> 원
            </td>
        </tr>
    </tfoot>
</table>

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawTrendlines);

    function drawTrendlines() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '회사');
        data.addColumn('number', '상환완료');
        data.addColumn('number', '연체중');
        data.addColumn('number', '상환중');

        data.addRows([
            <?php
                for($i = 0; $i < count($summary['list']); $i++) {
                    if ($i != 0) { echo ', '; }
                    echo '["'.$summary['list'][$i]['name'].'", '.$summary['list'][$i]['finish'].', '.$summary['list'][$i]['late'].', '.$summary['list'][$i]['process'].']';
                }
            ?>
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('company_chart'));
        chart.draw(data, { isStacked : true, colors: ['#00DD00', '#ff0000', '#001fff'] });
    }
</script>
