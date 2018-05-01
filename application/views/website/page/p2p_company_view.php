<div class="row">
    <h1><?php echo $company->getName(); ?></h1>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
			<th>상품명</th>
            <th style="width: 70px;">이자율</th>
            <th style="width: 70px;">기간</th>
            <th style="width: 140px;">투자금</th>
            <th style="width: 120px;">상태</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($product_list as $product) { ?>
            <?php
                $return_list = ReturnsM::new()->setProductIdx($product->idx)->getList();
            ?>
            <tr>
                <td class="text-left" onclick="toogleSchedule('schedule_<?php echo $product->idx; ?>');" style="cursor: pointer;">
                    <?php echo $product->product_name; ?>
                </td>
                <td class="text-center">
                    <?php echo $product->interest; ?>
                </td>
                <td class="text-center">
                    <?php echo $product->total_term; ?>
                </td>
                <td class="text-right">
                    <?php echo number_format($product->amount); ?> 원
                </td>
                <td class="text-center">
                    <?php
                        switch($product->investment_status) {
                            case PRODUCT_INVESTMENT_STATUS::REDEEM: {
                                echo '상환중';
                                break;
                            }
                            case PRODUCT_INVESTMENT_STATUS::OVERDUE: {
                                echo '연체중';
                                break;
                            }
                            case PRODUCT_INVESTMENT_STATUS::COMPLETE: {
                                echo '상환완료';
                                break;
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr id="schedule_<?php echo $product->idx; ?>" style="display: none;">
                <td colspan="5" class="schedule">
                    <?php foreach($return_list as $return) { ?>
                        <div class="row">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td class="text-center" style="width: 14%;"><?php echo $return->getDate(); ?></td>
                                        <td class="text-right"><?php echo $return->getInvestment(); ?> 원</td>
                                        <td class="text-right" style="width: 14%;"><?php echo $return->getProfit(); ?> 원</td>
                                        <td class="text-right" style="width: 14%;"><?php echo $return->getBond(); ?> 원</td>
                                        <td class="text-right" style="width: 14%;"><?php echo $return->getProfitLate(); ?> 원</td>
                                        <td class="text-right" style="width: 14%;"><?php echo $return->getTax(); ?> 원</td>
                                        <td class="text-right" style="width: 14%;"><?php echo $return->getFee(); ?> 원</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    var toogleSchedule = function(e) {
        $("#" + e).toggle();
    }
</script>
