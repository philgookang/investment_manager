<div class="panel">
    <form action="/admin/action/p2p/" method="POST">
        <input type="hidden" name="product_idx"                 value="<?php echo $stock->idx; ?>" />
        <input type="hidden" name="name"                        value="" />
        <input type="hidden" name="investment_type"             value="<?php echo PRODUCT_INVESTMENT_TYPE::STOCK; ?>" />
        <input type="hidden" name="amount"                      value="0" />
        <input type="hidden" name="interest"                    value="0" />
        <input type="hidden" name="total_term"                  value="0" />
        <input type="hidden" name="late_start_date"             value="0000-00-00" />
        <input type="hidden" name="late_end_date"               value="0000-00-00" />
        <input type="hidden" name="investment_status"           value="0" />
        <input type="hidden" name="investment_complete_date"    value="0000-00-00" />
        <input type="hidden" name="qrurl"                       value="/admin/stock/" />
    	<div class="panel-body">
            <div class="row">
                <label>회사</label>
                <select class="input" name="company_idx">
                    <?php foreach($company_list as $company) { ?>
                        <option value="<?php echo $company->getIdx(); ?>">
                            <?php echo $company->getName(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <!--/.row-->
            <br />
            <div class="row-col">
                <div class="col-2">
                    <label>매수일</label>
                    <input type="text" class="input" name="bought_date" value="<?php echo $stock->getName(); ?>" />
                </div>
                <!--/.col-2-->
                <div class="col-2">
                    <label>매수금액</label>
                    <input type="text" class="input" name="bought_price" value="<?php echo $stock->getName(); ?>" />
                </div>
                <!--/.col-2-->
            </div>
            <!--/.row-->
            <br />
            <div class="row-col">
                <div class="col-2">
                    <label>매도일</label>
                    <input type="text" class="input" name="sold_date" value="<?php echo $stock->getName(); ?>" />
                </div>
                <!--/.col-2-->
                <div class="col-2">
                    <label>매도금액</label>
                    <input type="text" class="input" name="sold_price" value="<?php echo $stock->getName(); ?>" />
                </div>
                <!--/.col-2-->
            </div>
            <!--/.row-->
            <br><br>
            <div class="row text-center">
                <button type="submit" class="btn btn-primary">저장하기</button>
            </div>
            <!--/.row-->
        </div>
    	<!--/.panel-body-->
    </form>
</div>
<!--/.panel-->

<script>
    $(function() {
        $("input[name=bought_date]").datepicker({ dateFormat : "yy-mm-dd" });
        $("input[name=sold_date]").datepicker({ dateFormat : "yy-mm-dd" });
    });
</script>
