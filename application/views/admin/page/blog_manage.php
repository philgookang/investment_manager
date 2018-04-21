<div class="panel">
	<div class="panel-header">
		<h1>Blog Manage</h1>
		<div class="panel-options input-inline">
			<div class="btn btn-primary" onclick="BlogManage.save(<?php echo $blog->getIdx(); ?>);">Save</div>
		</div>
		<!--/.panel-options-->
	</div>
	<!--/.panel-header-->

	<div class="panel-body padTopNone">
        <div class="row">
            <input type="text" class="input" id="title" placeholder="제목" value="<?php echo $blog->getTitle(); ?>" />
        </div>
        <!--/.row-->
        <br />
        <div class="row-col">
			<div class="col-2">
                <div class="row-col">
                    <div class="col-2">
                        <input type="text" class="input" id="subtitle" placeholder="부제목" value="<?php echo $blog->getSubtitle(); ?>" />
                    </div>
                    <!--/.row-2-->
                    <div class="col-2">
                        <input type="text" class="input" id="hashtag" placeholder="#태그" value="<?php echo $blog->getHashtag(); ?>" />
                    </div>
                    <!--/.col-2-->
                </div>
                <!--/.row-col-->
            </div>
            <!--/.row-2-->
            <div class="col-2">
                <div class="row-col">
                    <div class="col-2">
						<input type="text" class="input" id="release_date_time" placeholder="Release Date" value="<?php echo $blog->getReleaseDateTime(); ?>" />
                    </div>
                    <!--/.row-2-->
                    <div class="col-2">
                        <div class="segmented segmented-default">
    						<label>
    							<input type="radio" name="is_visible" value="1" <?php echo ($blog->getIsVisible()!='2')?'checked':''; ?>> <span>Closed</span>
    						</label>

    						<label>
    							<input type="radio" name="is_visible" value="2" <?php echo ($blog->getIsVisible()=='2')?'checked':''; ?>> <span>Open</span>
    						</label>
    					</div>
                        <!--/.segmented-->
                    </div>
                    <!--/.col-2-->
                </div>
                <!--/.row-col-->
            </div>
            <!--/.row-2-->
        </div>
        <!--/.row-col-->
		<br />
		<div class="row-col">
			<div class="col-4">
				<select class="input" id="group_idx">
					<?php foreach($group_list as $group) { ?>
						<option value="<?php echo $group->getIdx(); ?>" <?php echo ($blog->getGroupIdx()==$group->getIdx()) ? 'selected' : ''; ?>>
							<?php echo $group->getName(); ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<!--/.row-col-->
		<br />
		<textarea id="description" class="input" rows="6"><?php echo $blog->getDescription() ; ?></textarea>
        <br />
        <div class="row">
            <textarea name="content"><?php echo $blog->getContent(); ?></textarea>
        </div>
        <!--/.row-->
	</div>
	<!--/.panel-body-->
</div>
<!--/.panel-->

<script>BlogManage.init();</script>
