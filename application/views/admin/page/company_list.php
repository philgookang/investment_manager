<div class="panel">
	<div class="panel-tab">
		<a href="/admin/company/?type=1">
			<div class="tab-item <?php echo ($this->input->get('type')=='1')?'tab-item-active':''; ?>">펀딩사</div>
			<!--/.tab-item-->
		</a>
		<a href="/admin/company/?type=2">
			<div class="tab-item <?php echo ($this->input->get('type')=='2')?'tab-item-active':''; ?>">주식종목</div>
			<!--/.tab-item-->
		</a>
		<a href="/admin/company/?type=3">
			<div class="tab-item <?php echo ($this->input->get('type')=='3')?'tab-item-active':''; ?>">임대건물</div>
			<!--/.tab-item-->
		</a>
        <a href="/admin/company/?type=4">
			<div class="tab-item <?php echo ($this->input->get('type')=='4')?'tab-item-active':''; ?>">대출사</div>
			<!--/.tab-item-->
		</a>

		<form class="panel-options input-inline" method="GET" action="">
			<a href="/admin/company/manage/?type=<?php echo $this->input->get('type'); ?>" class="btn btn-primary">Create</a>
		</form>
		<!--/.panel-options-->
	</div>
	<!--/.panel-tab-->

	<div class="panel-body">
		<table class="table table-bordered table-striped table-hover">
            <thead>
				<tr>
					<th style="width: 80px;">#</th>
                    <th>Name</th>
					<th style="width: 90px;">Menu</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $company) { ?>
    				<tr>
                        <td class="text-center"><?php echo $company->idx; ?></td>
						<td><?php echo $company->name; ?></td>
						<td class="menu">
    						<a href="/admin/company/manage/<?php echo $company->idx; ?>" class="menu-item">Edit</a>
                            <a href="/admin/company/remove/<?php echo $company->idx; ?>" onclick="return confirm('Are you sure?');" class="menu-item">Delete</a>
    					</td>
    				</tr>
                <?php } ?>
			</tbody>
		</table>
	</div>
	<!--/.panel-body-->
</div>
<!--/.panel-->
