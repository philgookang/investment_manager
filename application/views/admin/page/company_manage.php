<div class="panel">
    <form action="/admin/company/save/<?php echo $company->idx; ?>" method="POST">
        <input type="hidden" name="type" value="<?php echo $company->getType(); ?>" />
    	<div class="panel-body">
            <div class="row">
                <label>
                    <?php
                        switch($company->getType()) {
                            case COMPANY_TYPE::FUNDING: {
                                echo '펀딩사'; break;
                            }
                            case COMPANY_TYPE::STOCK: {
                                echo '주식종목'; break;
                            }
                            case COMPANY_TYPE::LEASE: {
                                echo '임대건물'; break;
                            }
                            case COMPANY_TYPE::LOAN: {
                                echo '대출'; break;
                            }
                        }
                    ?>
                </label>
                <input type="text" class="input" name="name" value="<?php echo $company->getName(); ?>" />
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
