<div class="panel">
	<div class="panel-header">
		<h1>Blog</h1>
		<div class="panel-options input-inline">
			<a href="/admin/blog/manage/" class="btn btn-primary">Create</a>
		</div>
		<!--/.panel-options-->
	</div>
	<!--/.panel-header-->

	<div class="panel-body padTopNone">
		<table class="table table-bordered table-striped table-hover">
            <thead>
				<tr>
					<th style="width: 80px;">#</th>
                    <th>Title</th>
                    <th style="width: 120px;">Views</th>
                    <th style="width: 120px;">Created Date</th>
					<th style="width: 120px;">Menu</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($list as $blog) { ?>
    				<tr>
                        <td class="text-center"><?php echo $blog->getIdx(); ?></td>
    					<td>
							<?php echo $blog->getTitle(); ?>
							<?php if ($blog->getIsVisible() != 2) { ?>
								<div class="label label-default">HIDDEN</div>
							<?php } ?>
						</td>
						<td class="text-center"><?php echo $blog->getViews(); ?></td>
                        <td class="text-center"><?php echo $blog->getCreatedDateTime('m월 d일 H:i'); ?></td>
    					<td class="menu">
							<a href="/blog/view/<?php echo $blog->getIdx(); ?>?skip_count=1" class="menu-item" target="window_<?php echo $blog->getIdx(); ?>">View</a>
    						<a href="/admin/blog/manage/<?php echo $blog->getIdx(); ?>" class="menu-item">Edit</a>
							<a href="#" onclick="Blog.remove(this, <?php echo $blog->getIdx(); ?>); return false;" class="menu-item">Delete</a>
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
