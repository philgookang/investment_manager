<div class="panel">
	<div class="panel-header">
		<h1>P2P Manage</h1>
	</div>
	<!--/.panel-header-->

    <form action="/admin/action/p2p" method="POST">
    	<div class="panel-body padTopNone">
			<div class="row">
				<select class="input" name="company_idx">
					<?php foreach($company_list as $company) { ?>
						<option value="<?php echo $company->getIdx(); ?>" <?php if ($product->getCompanyIdx() == $company->getIdx()) { echo 'selected'; } ?> >
							<?php echo $company->getName(); ?>
						</option>
					<?php } ?>
				</select>
            </div>
            <!--/.row-->
            <br />
            <div class="row">
                <input type="hidden" name="product_idx" value="<?php echo $product->getIdx(); ?>" />
                <input type="text" class="input" name="name" placeholder="제목" value="<?php echo $product->getName(); ?>" />
            </div>
            <!--/.row-->
            <br />
            <div class="row">
                <input type="text" class="input" name="amount" placeholder="투자금" value="<?php echo $product->getAmount(); ?>" />
            </div>
            <!--/.row-->
            <br />
            <div class="row">
                <input type="text" class="input" name="interest" placeholder="이자" value="<?php echo $product->getInterest(); ?>" />
            </div>
            <!--/.row-->
            <br />
			<div class="row">
                <input type="text" class="input" name="total_time" placeholder="투자 기간" value="<?php echo $product->getTotalTime(); ?>" />
            </div>
            <!--/.row-->
            <br />
			<div class="row">
				<select class="input" name="heartbeat">
					<option value="1" <?php echo ($product->getHeartbeat() == '1') ? 'selected' : ''; ?>>상환중</option>
					<option value="2" <?php echo ($product->getHeartbeat() == '2') ? 'selected' : ''; ?>>연체중</option>
					<option value="3" <?php echo ($product->getHeartbeat() == '3') ? 'selected' : ''; ?>>상환완료</option>
				</select>

				<div class="pull-right">
					상환완료일<input type="text" class="input" name="heartbeat_complete" id="heartbeat_complete" value="<?php echo $product->getHeartbeatComplete(); ?>" />
				</div>
            </div>
            <!--/.row-->
            <br />
            <div class="row text-right">
                <div class="btn btn-primary" onclick="add();">
                    추가
                </div>
            </div>
            <!--/.row-->
            <br />
            <div class="row">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
        				<tr>
        					<th style="width: 130px;">날짜</th>
							<th style="width: 80px;">회</th>
                            <th>수익</th>
                            <th>연체금</th>
                            <th>세금</th>
                            <th>스스료</th>
							<th style="width: 80px;">상태</th>
							<th style="width: 80px;"></th>
							<th style="width: 40px;"></th>
        				</tr>
        			</thead>
        			<tbody id="returns">
                        <?php foreach($return_list as $return) { ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="idx[]" value="<?php echo $return->getIdx(); ?>" />
                                    <input type="text" class="input date" name="date[]" value="<?php echo $return->getDate(); ?>" />
                                </td>
								<td>
                                    <input type="text" class="input" name="term[]" value="<?php echo $return->getTerm(); ?>" />
                                </td>
                                <td>
                                    <input type="text" class="input" name="profit[]" value="<?php echo $return->getProfit(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="profit_late[]" value="<?php echo $return->getProfitLate(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="tax[]" value="<?php echo $return->getTax(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="service_price[]" value="<?php echo $return->getSusuro(); ?>"/>
                                </td>
								<td>
                                    <select class="input" name="marker[]">
										<option value="1" <?php if ($return->getMarker() == 1) { echo 'selected'; } ?>>
											상환중
										</option>
										<option value="2" <?php if ($return->getMarker() == 2) { echo 'selected'; } ?>>
											입금된
										</option>
									</select>
                                </td>
								<td>
									<select class="input" name="type[]">
										<option value="1" <?php if ($return->getType() == 1) { echo 'selected'; } ?>>이자</option>
										<option value="2" <?php if ($return->getType() == 2) { echo 'selected'; } ?>>원금</option>
										<option value="3" <?php if ($return->getType() == 3) { echo 'selected'; } ?>>상품권</option>
									</select>
								</td>
								<td class="text-center">
									<div class="btn btn-xs btn-danger" onclick=" if (confirm('Are you sure?')) { $(this).parent().parent().remove(); } ">삭제</div>
								</td>
                            </tr>
                        <?php } ?>
        			</tbody>
        		</table>
            </div>
            <!--/.row-->

            <br><br>

            <div class="row text-center">
                <button type="submit" class="btn btn-primary">저장하기</button>
            </div>
        </div>
    	<!--/.panel-body-->
    </form>
</div>
<!--/.panel-->

<script>
	$(function() {
		$("#heartbeat_complete").datepicker({
			dateFormat : "yy-mm-dd"
		});
	});
    var add = function() {
        $("#returns").append(
            '<tr>' +
                '<td>' +
                    '<input type="hidden" name="idx[]" value="0" />' +
                    '<input type="text" class="input date" name="date[]" value="" />' +
                '</td>' +
				'<td>' +
					'<input type="text" class="input" name="term[]" value="" />' +
				'</td>' +
                '<td>' +
                    '<input type="text" class="input" name="profit[]" value="" />' +
                '</td>' +
                '<td>' +
                    '<input type="text" class="input" name="profit_late[]" value="" />' +
                '</td>' +
                '<td>' +
                    '<input type="text" class="input" name="tax[]" value=""/ />' +
                '</td>' +
                '<td>' +
                    '<input type="text" class="input" name="service_price[]" value=""/ />' +
                '</td>' +
				'<td>' +
					'<select class="input" name="marker[]">'+
						'<option value="1">상환중</option>' +
						'<option value="2">입금된</option>' +
					'</select>' +
				'</td>' +
				'<td>' +
					'<select class="input" name="type[]">'+
						'<option value="1">이자</option>' +
						'<option value="2">원금</option>' +
						'<option value="3">상품권</option>' +
					'</select>' +
				'</td>' +
				'<td class="text-center"><div class="btn btn-xs btn-danger" onclick=" if (confirm(\'Are you sure?\')) { $(this).parent().parent().remove(); } ">삭제</div></td>' +
            '</tr>'
        );
        set_datepicker();
    }
    var set_datepicker = function() {
        $(".date").each(function() {
            if ($(this).data('is_set') != '1') {
                $(this).datepicker({
                    dateFormat : "yy-mm-dd"
                });
            }
            $(this).data('is_set', '1');
        });
    }
    set_datepicker();
</script>
