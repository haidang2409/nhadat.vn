<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/bai-viet"><?php echo __('Bài viết');?></a></li>
                    <?php
                    if(isset($breadcrumb_postcat))
                    {
                        ?>
                        <li>
                            <?php echo $breadcrumb_postcat['Postcat']['name'];?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <br>
        </div>
        <div class="col-sm-9 col-sm-push-3">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Tin tức mới</h3>
                </div>
            </div>
            <hr class="hr-double">
            <?php
            if(isset($posts))
            {
                $count_post = count($posts);
                //Sm-4
                if($count_post >= 3 && $this->params['paging']['Post']['page'] == 1)
                {
                    ?>
                    <div class="row">
                        <?php
                            for($i = 0; $i < 3; $i++)
                            {
                                $item = $posts[$i];
                                ?>
                                <div class="col-sm-4" style="margin-bottom: 10px !important;">
                                    <div class="" style="padding-right: 0 !important;">
                                        <?php
                                        if($item['Post']['image'] != '')
                                        {
                                            ?>
                                            <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                                                <img width="100%" height="190px" src="/uploads/posts/<?php echo $item['Post']['image'];?>" alt="<?php echo $item['Post']['title'];?>">
                                            </a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                                                <img width="100%" height="190px" src="/uploads/posts/no-image-post.png" alt="<?php echo $item['Post']['title'];?>">
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="" style="padding-left: 5px !important;">
                                        <?php
                                        $title = $item['Post']['title'];
                                        ?>
                                        <h3 style="font-size: 1.2em">
                                            <a class="link-hover none-textdecoretion" href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                                                <?php echo $title;?>
                                            </a>
                                        </h3>
                                        <div class="">
                                        </div>
                                        <div style="color: #7e7e7e; font-style: italic">
                                            <i class="fa fa-user"> </i>
                                            <?php echo $item['Staff']['nickname'];?>
                                            <i class="fa fa-calendar"> </i>
                                            <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Post']['created']);?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="col-sm-12">
                            <hr>
                        </div>
                    </div>
                    <?php
                }
                //End SM-4
                if($count_post >= 3 && $this->params['paging']['Post']['page'] == 1)
                {
                    unset($posts[0]);
                    unset($posts[1]);
                    unset($posts[2]);
                }
                foreach ($posts as $item)
                {
                    ?>
                    <div class="row" style="margin-bottom: 10px !important;">
                        <div class="col-sm-3 col-xs-5" style="padding-right: 0 !important;">
                            <?php
                            if($item['Post']['image'] != '')
                            {
                                ?>
                                <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                                    <img width="100%" src="/uploads/posts/<?php echo $item['Post']['image'];?>" alt="<?php echo $item['Post']['title'];?>">
                                </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                                    <img width="100%" src="/uploads/posts/no-image-post.png" alt="<?php echo $item['Post']['title'];?>">
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-9 col-xs-7" style="padding-left: 5px !important;">
                            <?php
                            $title = $item['Post']['title'];
                            ?>
                            <h3 style="font-size: 1.2em">
                                <a class="link-hover none-textdecoretion" href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>">
                                    <?php echo $title;?>
                                </a>
                            </h3>
                            <div class="hidden-xs">
                                <?php echo $item['Post']['summary'];?>
                            </div>
                            <div style="color: #7e7e7e; padding-top: 5px; font-size: 13px; font-style: italic">
                                <i class="fa fa-calendar"></i>
                                <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Post']['created']);?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if($this->params['paging']['Post']['pageCount'] > 1)
                {
                    ?>
                    <div class="">
                        <ul class="pagination">
                            <?php
                            $here = $this->here;
                            $len_here = strlen($here);
                            $here = substr($here, 1, $len_here);
                            $this->Paginator->options(array(
                                'url'=> array(
                                    'controller' => '/',
                                    'action' => '/',
                                    $here
                                )
                            ));
                            $this->Paginator->options['url']['?'] = $this->params['url'];
                            echo urldecode($this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')));
                            echo urldecode($this->Paginator->numbers(
                                array(
                                    'separator' => '',
                                    'currentTag' => 'a',
                                    'currentClass' => 'active',
                                    'tag' => 'li',
                                    'ellipsis'=>'<li class="ellipsis"><a>...</a></li>',
                                    'modulus' => 4,
                                    'first' => 2,
                                    'last' => 2
                                )));
                            echo urldecode($this->Paginator->next(__('>>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')));
                            ?>
                        </ul>
                    </div>
                <?php
                }
            }
            else
            {
                ?>
                <div class="alert alert-warning">
                    Không tìm thấy trang theo yêu cầu
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <div class="">
                <div class="product-search-header product-search-header-first">
                    <h3><?php echo __('Xem theo chuyên mục');?></h3>
                </div>
                <div id="" class="accordian">
                    <ul style="margin-left: 0 !important;">
                        <?php
                        $postcat_id = isset($this->params['postcatid'])? substr($this->params['postcatid'], 2): '';
                        if(isset($postcats))
                        {
                            for($i = 0; $i < count($postcats); $i++)
                            {
                                ?>
                                <li>
                                    <h4>
                                        <a class="a-group <?php if($postcats[$i]['Postcat']['id'] == $postcat_id){ echo 'link-waring';}?>" href="/bai-viet/<?php echo $postcats[$i]['Postcat']['link'];?>-cp<?php echo $postcats[$i]['Postcat']['id'];?>">
                                            <i class="fa fa-caret-right"></i>
                                            <?php echo $postcats[$i]['Postcat']['name'];?>
                                        </a>
                                    </h4>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!--                Advertise-->
                <div class="">
                    <?php
                    if(isset($advertise))
                    {
                        ?>
                        <img width="100%" src="/uploads/advertise/<?php echo $advertise[0]['Advertise']['image'];?>">
                        <?php
                    }
                    ?>
                </div>
                <!--                End advertise-->
            </div>
        </div>
    </div>
</div> 