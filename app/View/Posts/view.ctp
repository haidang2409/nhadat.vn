<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!--            Breadcrumbs-->
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><?php echo __('Home');?></a>
                    </li>
                    <li><a href="/bai-viet"><?php echo __('Bài viết');?></a></li>
                    <li><a href="/bai-viet/<?php echo $posts['Postcat']['link']?>-cp<?php echo $posts['Postcat']['id']?>"><?php echo $posts['Postcat']['name'];?></a> </li>
                    <li><?php echo $posts['Post']['title'];?></li>
                </ul>
            </div>
            <br>
            <!--            End Breadcrumbs-->
        </div>
        <!--        Right-->
        <div class="col-sm-9 col-sm-push-3">
            <h1 style="margin-bottom: 10px !important; font-size: 1.7em">
                <?php echo $posts['Post']['title'];?>
            </h1>
            <div class="post-summary">
                <?php echo $posts['Post']['summary'];?>
            </div>
            <div class="post-content">
                <?php
                echo str_replace('/app/webroot', '', $posts['Post']['description']);
                ?>
            </div>
<!--            Prev and next-->
            <div class="prev-next text-right">
                <?php
                if(isset($post_prev_next['prev']))
                {
                    ?>
                    <a title="Bài trước" href="/bai-viet/<?php echo $post_prev_next['prev']['Post']['postlink'];?>-<?php echo $post_prev_next['prev']['Post']['id'];?>">
                        <i class="fa fa-angle-double-left"></i>
                    </a>
                    <?php
                }
                if(isset($post_prev_next['next']))
                {
                    ?>
                    <a title="Bài kế tiếp" href="/bai-viet/<?php echo $post_prev_next['next']['Post']['postlink'];?>-<?php echo $post_prev_next['next']['Post']['id'];?>">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                    <?php
                }
                ?>
            </div>
<!--            End Prev and next-->
            <div>

            </div>
<!--            Comments-->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="input-comment">
                        <hr>
                        <h3 class="blue" style="margin-bottom: 10px !important;">Đăng bình luận</h3>
                        <textarea id="inputComment" rows="1" type="text" class="form-control" placeholder="Nhập nội dung... "></textarea>
                        <input type="hidden" value="<?php echo $this->Session->check('Member')? md5($this->Session->read('Member.id')): '';?>" name="token" id="token">
                        <div class="text-right"  style="padding: 5px 0">
                            <button class="btn btn-warning btn-mini" id="btnCommentPost" data-post_id="<?php echo $posts['Post']['id'];?>"><i class="fa fa-send"></i> Gửi</button>
                        </div>
                    </div>
                    <div class="timeline-container" id="timeline-container">

                    </div><!-- /.timeline-container -->
                    <div class="text-center" id="div-pre-more-comment">
                    </div>
                    <div class="text-center" id="div-more-comment">
                    </div>
                </div>
            </div>
<!--            End comments-->
        </div>
        <!--        Left-->
        <div class="col-sm-3 col-sm-pull-9">
            <div class="">
                <div class="product-search-header product-search-header-first">
                    <h3><?php echo __('Xem theo chuyên mục');?></h3>
                </div>
                <div id="" class="accordian">
                    <ul style="margin-left: 0 !important;">
                        <?php
                        if(isset($postcats))
                        {
                            for($i = 0; $i < count($postcats); $i++)
                            {
                                ?>
                                <li>
                                    <h4>
                                        <a class="a-group" href="/bai-viet/<?php echo $postcats[$i]['Postcat']['link'];?>-cp<?php echo $postcats[$i]['Postcat']['id'];?>">
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
                <!--            Posts relative-->
                <div style="margin: 15px 0">
                    <h3>Bài viết mới</h3>
                    <hr class="hr-double">
                    <?php
                    if(isset($post_relatives))
                    {
                        foreach ($post_relatives as $item)
                        {
                            ?>
                            <div class="row" style="margin-bottom: 10px !important;">
                                <div class="col-sm-4 col-xs-5" style="padding-right: 0 !important;">
                                    <?php
                                    if($item['Post']['image'] != '')
                                    {
                                        ?>
                                        <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>">
                                            <img width="100%" src="/uploads/posts/<?php echo $item['Post']['image'];?>" alt="<?php echo $item['Post']['title'];?>">
                                        </a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>">
                                            <img width="100%" src="/uploads/posts/no-image-post.png" alt="<?php echo $item['Post']['title'];?>">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-8 col-xs-7" style="padding-left: 5px !important;">
                                    <?php
                                    $title = $item['Post']['title'];
                                    $num_str = strlen($title);
                                    if($num_str > 90)
                                    {
                                        $title = substr($title, 0, 90);
                                        $start = strripos($title, ' ');
                                        if($start > 0)
                                        {
                                            $title = substr($title, 0, $start + 1);
                                        }
                                    }
                                    ?>
                                    <h3 style="font-size: 1em">
                                        <a class="link-hover none-textdecoretion" href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>">
                                            <?php echo $title;?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <!--            End posts relative-->
                <!--                Advertise-->
                <div class="hidden-xs">
                    <?php
                    if(isset($advertise))
                    {
                        ?>
                        <img width="100%" src="/uploads/advertise/<?php echo $advertise[0]['Advertise']['image'];?>">
                        <?php
                    }
                    ?>
                </div>
<!--                Product new-->
                    <?php
                    echo $this->element('product_col_sm_3');
                    ?>
<!--                End product new-->
                <!--                End advertise-->
<!--                Weather-->
                <?php
//                echo $this->element('weather');
                ?>
<!--                End weather-->

            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('comments.min');?>
<script>
    $(function () {
        var post_id = <?php echo $posts['Post']['id'];?>;
        load_comment(1, post_id);

    });
</script>