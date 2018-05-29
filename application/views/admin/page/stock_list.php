<div class="panel">
	<div class="panel-header">
		<h1>Stock</h1>
		<form class="panel-options input-inline" method="GET" action="#">
			<a href="/admin/stock/manage/" class="btn btn-primary">Create</a>
		</form>
		<!--/.panel-options-->
	</div>
	<!--/.panel-header-->

	<div class="panel-body padTopNone">
		<table class="table table-bordered table-striped table-hover">
            <thead>
				<tr>
					<th style="width: 100px;">매수일</th>
                    <th>회사</th>
					<th style="width: 80px;">수익률</th>
					<th style="width: 100px;">순손익금액</th>
                    <th style="width: 100px;">매수단가</th>
                    <th style="width: 100px;">매도단가</th>
					<th style="width: 90px;">Menu</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $product) { ?>
					<tr>
						<td class="text-center"><?php echo $product->bought_date; ?></td>
						<td><?php echo $product->company_name; ?></td>
						<td></td>
						<td class="text-right"><?php echo number_format($product->sold_price - $product->bought_price); ?></td>
						<td class="text-right"><?php echo number_format($product->bought_price); ?></td>
						<td class="text-right"><?php echo number_format($product->sold_price); ?></td>
						<td class="menu">
    						<a href="/admin/stock/manage/<?php echo $product->idx; ?>" class="menu-item">Edit</a>
                            <a href="/admin/stock/remove/<?php echo $product->idx; ?>" onclick="return confirm('Are you sure?');" class="menu-item">Delete</a>
    					</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<!--/.panel-body-->
</div>
<!--/.panel-->
