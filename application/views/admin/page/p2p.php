<div class="panel">
	<div class="panel-tab">
		<a href="/admin/p2p/?investment_status=1">
			<div class="tab-item <?php echo ($this->input->get('investment_status')=='1')?'tab-item-active':''; ?>">상환중</div>
			<!--/.tab-item-->
		</a>
		<a href="/admin/p2p/?investment_status=2">
			<div class="tab-item <?php echo ($this->input->get('investment_status')=='2')?'tab-item-active':''; ?>">연체중</div>
			<!--/.tab-item-->
		</a>
		<a href="/admin/p2p/?investment_status=3">
			<div class="tab-item <?php echo ($this->input->get('investment_status')=='3')?'tab-item-active':''; ?>">상환완료</div>
			<!--/.tab-item-->
		</a>

		<form class="panel-options input-inline" method="GET" action="">
			<a href="/admin/p2p/manage/?investment_type=<?php echo PRODUCT_INVESTMENT_TYPE::LEASE; ?>" class="btn btn-primary">Create</a>
		</form>
		<!--/.panel-options-->
	</div>
	<!--/.panel-tab-->

	<div class="panel-body">
		<table class="table table-bordered table-striped table-hover">
            <thead>
				<tr>
					<th style="width: 80px;">#</th>
					<th style="width: 140px;"></th>
                    <th>Name</th>
					<th style="width: 90px;">Menu</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $product) { ?>
    				<tr>
                        <td class="text-center"><?php echo $product->idx; ?></td>
						<td class="text-center">
							<?php echo $product->company_name; ?>
						</td>
    					<td>
							<?php echo $product->product_name; ?>

							<?php
								if ($product->investment_status == PRODUCT_INVESTMENT_STATUS::REDEEM) {
									echo '<span class="label label-default">상환중</span>';
								} else if ($product->investment_status == PRODUCT_INVESTMENT_STATUS::OVERDUE) {
									echo '<span class="label label-danger">연체중</span>';
								} else if ($product->investment_status == PRODUCT_INVESTMENT_STATUS::COMPLETE) {
									echo '<span class="label label-success">상환완료 : '.$product->investment_complete_date.'</span>';
								}
							?>
						</td>
						<td class="menu">
    						<a href="/admin/p2p/manage/<?php echo $product->idx; ?>" class="menu-item">Edit</a>
    					</td>
    				</tr>
                <?php } ?>
			</tbody>
		</table>
	</div>
	<!--/.panel-body-->
</div>
<!--/.panel-->
