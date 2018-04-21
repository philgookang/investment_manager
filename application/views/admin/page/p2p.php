<div class="panel">
	<div class="panel-header">
		<h1>P2P</h1>
		<form class="panel-options input-inline" method="GET" action="/admin/p2p/">
			<select name="heartbeat" class="input">
				<option value="">전체</option>
				<option value="1" <?php echo ($this->input->get('heartbeat') == '1') ? 'selected' : ''; ?>>상환중</option>
				<option value="2" <?php echo ($this->input->get('heartbeat') == '2') ? 'selected' : ''; ?>>연체중</option>
				<option value="3" <?php echo ($this->input->get('heartbeat') == '3') ? 'selected' : ''; ?>>상환완료</option>
			</select>
			<input type="submit" class="btn btn-primary" value="검색" style="height: 25px" />
			<a href="/admin/p2p/manage/" class="btn btn-primary">Create</a>
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
                    <th style="width: 120px;">Created Date</th>
					<th style="width: 90px;">Menu</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $product) { ?>
    				<tr>
                        <td class="text-center"><?php echo $product->getIdx(); ?></td>
						<td class="text-center">
							<?php echo $product->getCompanyIdx(true)->getName(); ?>
						</td>
    					<td>
							<?php echo $product->getName(); ?>

							<?php
								if ($product->getHeartbeat() == 1) {
									echo '<span class="label label-default">상환중</span>';
								} else if ($product->getHeartbeat() == 2) {
									echo '<span class="label label-danger">연체중</span>';
								} else if ($product->getHeartbeat() == 3) {
									echo '<span class="label label-success">상환완료 : '.$product->getHeartbeatComplete().'</span>';
								}
							?>
						</td>
                        <td class="text-center"><?php echo $product->getCreatedDateTime('m월 d일 H:i'); ?></td>
    					<td class="menu">
    						<a href="/admin/p2p/manage/<?php echo $product->getIdx(); ?>" class="menu-item">Edit</a>
							<a href="#" onclick="P2p.remove(this, <?php echo $product->getIdx(); ?>); return false;" class="menu-item">Delete</a>
    					</td>
    				</tr>
                <?php } ?>
                <?php if (count($list) == 0) { ?>
                    <tr>
                        <td colspan="6" class="text-center">No Results! :(</td>
                    </tr>
                <?php } ?>
			</tbody>
		</table>
	</div>
	<!--/.panel-body-->

    <?php if ( $pagination != '' ) { ?>
        <div class="panel-block text-center"><?php echo $pagination; ?>&nbsp;</div>
    	<!--/.panel-block-->
    <?php } ?>
</div>
<!--/.panel-->
