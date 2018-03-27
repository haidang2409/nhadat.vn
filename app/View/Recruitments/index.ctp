<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/tuyen-dung"><?php echo __('Thông tin tuyển dụng');?></a></li>
                </ul>
            </div>
            <br>
            <div class="col-sm-9">
                <?php
                if(isset($recruitments))
                {
                    foreach ($recruitments as $item)
                    {
                        ?>
                        <div>
                            <h3>
                                <a href="/tuyen-dung/<?php echo $item['Recruitment']['recruitmentlink'];?>">
                                    <?php echo $item['Recruitment']['title'];?>
                                </a>
                            </h3>
                            <hr>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>