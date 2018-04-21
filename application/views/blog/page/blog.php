<div class="container">
    <div class="content-list">
        <?php foreach($list as $blog) {
            $group = BlogGroupBM::new()->setIdx($blog->getGroupIdx())->get();
            ?>
            <a href="/blog/view/<?php echo $blog->getIdx(); ?>">
                <div class="list-item">

                    <div class="title">
                        <?php echo $blog->getTitle(); ?>

                        <div class="group group-<?php echo $group->getIdx(); ?>">
                            <?php echo $group->getName(); ?>
                        </div>
                        <!--/.group-->
                    </div>
                    <!--/.title-->

                    <div class="datetime">
                        <?php echo $blog->getCreatedDateTime('Y.m.d'); ?>
                    </div>
                    <!--/.datetime-->

                    <div class="content">
                        <?php echo $blog->getDescription(); ?>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.list-item-->
            </a>
        <?php } ?>
    </div>
</div>
<!--/.container-->
