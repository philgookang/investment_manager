<style> #returns td { padding: 3px 4px; } </style>
<div class="panel">
    <form action="/admin/action/p2p" method="POST">
    	<div class="panel-body">
            <div class="row">
				<input type="hidden" name="rurl" value="<?php echo $rurl; ?>"/>
                <input type="hidden" name="investment_type" value="<?php if ($this->input->get('investment_type')) { echo $this->input->get('investment_type'); }  if ($product->getIdx()!=null) { echo $product->getInvestmentType(); } ?>" />
				<input type="hidden" name="product_idx" value="<?php echo $product->getIdx(); ?>" />
                <label>
                    <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                    <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                        상품명
                    <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                        호수
                    <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                        대출명
                    <?php } ?>
                </label>
                <input type="text" class="input" name="name" value="<?php echo $product->getName(); ?>" />
            </div>
            <!--/.row-->
            <br />
			<div class="row-col">
				<div class="col-4">
                    <label>
                        <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                        <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                            업체
                        <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                            건물명
                        <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                            은행
                        <?php } ?>
                    </label>
					<select class="input" name="company_idx">
						<?php foreach($company_list as $company) { ?>
							<option value="<?php echo $company->getIdx(); ?>" <?php if ($product->getCompanyIdx() == $company->getIdx()) { echo 'selected'; } ?> >
								<?php echo $company->getName(); ?>
							</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-4">
					<label>
                        <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>
                            투자원금(원)
                        <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                            투자원금(원)
                        <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                            투자원금(원)
                        <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                            대출금
                        <?php } ?>
                    </label>
					<input type="text" class="input" name="amount" placeholder="" value="<?php echo $product->getAmount(); ?>" />
				</div>
				<div class="col-4">
					<label>이자율(%)</label>
					<input type="text" class="input" name="interest" value="<?php echo $product->getInterest(); ?>" />
				</div>
				<div class="col-4">
					<label>투자 기간(개월)</label>
					<input type="text" class="input" name="total_term" value="<?php echo $product->getTotalTerm(); ?>" />
				</div>
            </div>
            <!--/.row-->
            <br />
			<div class="row-col">
				<div class="col-4">
					<label>진행상태</label><br />
					<div class="segmented segmented-default">
						<label style="font-size: 11px;">
							<input type="radio" name="investment_status" value="<?php echo PRODUCT_INVESTMENT_STATUS::REDEEM; ?>" <?php echo ($product->getInvestmentStatus()==PRODUCT_INVESTMENT_STATUS::REDEEM)?	'checked':''; ?> <?php echo ($product->getIdx()==null)?'checked':''; ?>/>
							<span style="padding: 4px 13px;">상환중</span>
						</label>
						<label style="font-size: 11px;">
							<input type="radio" name="investment_status" value="<?php echo PRODUCT_INVESTMENT_STATUS::OVERDUE; ?>" <?php echo ($product->getInvestmentStatus()==PRODUCT_INVESTMENT_STATUS::OVERDUE)?'checked':''; ?>/>
							<span style="padding: 4px 13px;">연체중</span>
						</label>
						<label style="font-size: 11px;">
							<input type="radio" name="investment_status" value="<?php echo PRODUCT_INVESTMENT_STATUS::COMPLETE; ?>" <?php echo ($product->getInvestmentStatus()==PRODUCT_INVESTMENT_STATUS::COMPLETE)?'checked':''; ?>/>
							<span style="padding: 4px 13px;">상환완료</span>
						</label>
					</div>
				</div>
				<div class="col-4">
					<label>
                        <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                        <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                            연체시작
                        <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                            SKIP
                        <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                            SKIP
                        <?php } ?>
                    </label>
					<input type="text" class="input" name="late_start_date" value="<?php echo ($product->getLateStartDate()!=null)?$product->getLateStartDate():'0000-00-00'; ?>" />
				</div>
				<div class="col-4">
					<label>
                        <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                        <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                            연체마감
                        <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                            SKIP
                        <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                            SKIP
                        <?php } ?>
                    </label>
					<input type="text" class="input" name="late_end_date" value="<?php echo ($product->getLateEndDate()!=null)?$product->getLateEndDate():'0000-00-00'; ?>" />
				</div>
				<div class="col-4">
					<label>
                        <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                        <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                            투자완료
                        <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                            계약완료
                        <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                            SKIP
                        <?php } ?>
                    </label>
					<input type="text" class="input" name="investment_complete_date" value="<?php echo ($product->getInvestmentCompleteDate()!=null)?$product->getInvestmentCompleteDate():'0000-00-00'; ?>" />
				</div>
            </div>
            <!--/.row-->
            <br />
            <div class="row">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
        				<tr>
        					<th style="width: 100px;">날짜</th>
							<th style="width: 45px;">회</th>
							<th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    원금
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    보조금
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    SKIP
                                <?php } ?>
                            </th>
                            <th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    수익
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    월세
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    SKIP
                                <?php } ?>
                            </th>
							<th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    상품권
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    SKIP
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    SKIP
                                <?php } ?>
                            </th>
                            <th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    연체금
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    SKIP
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    SKIP
                                <?php } ?>
                            </th>
                            <th>세금</th>
                            <th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    수수료
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    SKIP
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    SKIP
                                <?php } ?>
                            </th>
                            <th>
                                <?php if ($company_type == COMPANY_TYPE::STOCK) { ?>

                                <?php } else if ($company_type == COMPANY_TYPE::FUNDING) { ?>
                                    SKIP
                                <?php } else if ($company_type == COMPANY_TYPE::LEASE) { ?>
                                    SKIP
                                <?php } else if ($company_type == COMPANY_TYPE::LOAN) { ?>
                                    대출이자
                                <?php } ?>
                            </th>
							<th style="width: 80px;">상태</th>
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
                                    <input type="text" class="input" name="investment[]" value="<?php echo $return->getInvestment(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="profit[]" value="<?php echo $return->getProfit(); ?>"/>
                                </td>
								<td>
                                    <input type="text" class="input" name="bond[]" value="<?php echo $return->getBond(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="loan[]" value="<?php echo $return->getLoan(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="profit_late[]" value="<?php echo $return->getProfitLate(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="tax[]" value="<?php echo $return->getTax(); ?>"/>
                                </td>
                                <td>
                                    <input type="text" class="input" name="service_price[]" value="<?php echo $return->getFee(); ?>"/>
                                </td>
								<td>
                                    <select class="input" name="marker[]">
										<option value="1" <?php if ($return->getPaymentStatus() == 1) { echo 'selected'; } ?>>
											상환중
										</option>
										<option value="2" <?php if ($return->getPaymentStatus() == 2) { echo 'selected'; } ?>>
											입금된
										</option>
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

			<br />

			<div class="row text-right">
				<div class="btn btn-primary" onclick="add();">
					추가
				</div>
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
		$("input[name=late_start_date]").datepicker({ dateFormat : "yy-mm-dd" });
		$("input[name=late_end_date]").datepicker({ dateFormat : "yy-mm-dd" });
		$("input[name=investment_complete_date]").datepicker({ dateFormat : "yy-mm-dd" });
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
					'<input type="text" class="input" name="investment[]" value=""/>'+
				'</td>' +
                '<td>' +
                    '<input type="text" class="input" name="profit[]" value="" />' +
                '</td>' +
				'<td>' +
					'<input type="text" class="input" name="bond[]" value=""/>' +
				'</td>' +
                '<td>' +
					'<input type="text" class="input" name="loan[]" value=""/>' +
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
