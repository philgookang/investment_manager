<div class="container">
    <div class="sidemenu">
        <div class="title">
            Blog
        </div>
        <!--/.title-->

        <ul>
            <?php $group_list = BlogGroupBM::new()->getList('name', 'asc', '0', '0'); ?>
            <?php foreach($group_list as $group) { ?>
                <li>
                    <a href="/blog/?group=<?php echo $group->getIdx(); ?>">
                        <?php echo $group->getName(); ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--/.sidemenu-->

    <div class="article">

        <div class="article-head">
            <h1><?php echo $blog->getTitle(); ?></h1>
            <?php if ($blog->getSubtitle() == '') { ?>
                <h2><?php echo $blog->getSubtitle(); ?></h2>
            <?php } ?>

            <div class="credits">
                Updated <?php echo $blog->getReleaseDateTime('Y.m.d'); ?>
            </div>
            <!--/.credits-->

            <?php
                $hashtag_list = explode(',', $blog->getTitle());
            ?>
            <?php if (count($hashtag_list)) { ?>
                <div class="hashtag">
                    <?php foreach($hashtag_list as $hashtag) { ?>
                        #<?php echo $hashtag; ?>
                    <?php } ?>
                </div>
                <!--/.hashtag-->
            <?php } ?>
        </div>
        <!--/.article-head-->

        <div class="article-body">
            <?php echo $blog->getContent(); ?>
        </div>
        <!--/.article-body-->
    </div>
    <!--/.article-->
</div>
<!--/.container-->
