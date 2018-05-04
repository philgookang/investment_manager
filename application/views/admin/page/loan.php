<div class="panel">
	<div class="panel-header">
		<h1>Loan</h1>
		<form class="panel-options input-inline" method="GET" action="/admin/loan/">
			<select name="heartbeat" class="input">
				<option value="">전체</option>
				<option value="1" <?php echo ($this->input->get('heartbeat') == '1') ? 'selected' : ''; ?>>상환중</option>
				<option value="2" <?php echo ($this->input->get('heartbeat') == '2') ? 'selected' : ''; ?>>연체중</option>
				<option value="3" <?php echo ($this->input->get('heartbeat') == '3') ? 'selected' : ''; ?>>상환완료</option>
			</select>
			<input type="submit" class="btn btn-primary" value="검색" style="height: 25px" />
			<a href="/admin/p2p/manage/?investment_type=<?php echo PRODUCT_INVESTMENT_TYPE::LOAN; ?>" class="btn btn-primary">Create</a>
		</form>
		<!--/.panel-options-->
	</div>
	<!--/.panel-header-->

	<div class="panel-body padTopNone">
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
