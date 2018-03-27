<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/tuyen-dung"><?php echo __('Thông tin tuyển dụng');?></a></li>
                    <li>
                        <?php echo $recruitments['Recruitment']['title'];?>
                    </li>
                </ul>
            </div>
            <br>
            <div class="col-sm-9">
                <h3 style="margin-bottom: 10px !important;"><?php echo $recruitments['Recruitment']['title'];?></h3>
                <?php echo $recruitments['Recruitment']['content'];?>
            </div>
            <div class="col-sm-3">
                <?php
                echo $this->Element('../Elements/posts_col_sm');
                ?>
            </div>
        </div>
    </div>
</div>