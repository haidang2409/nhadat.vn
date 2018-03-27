
<div class="row">
    <div class="col-xs-7">
        <h3>BÀI VIẾT</h3>
    </div>
    <div class="col-xs-5 text-right" style="padding-top: 4px">
        <a class="view-all" href="/bai-viet">Xem thêm + </i> </a>
    </div>
</div>
<hr class="hr-double">
<?php
if(isset($posts_menu))
{
    foreach ($posts_menu as $item)
    {
        ?>
        <div class="row" style="margin-bottom: 10px !important;">
            <div class="col-sm-4 col-xs-5" style="padding-right: 0 !important; padding-top: 3px">
                <?php
                $image = '/uploads/posts/no-image-post.png';
                if($item['Post']['image'] != '' && file_exists(WWW_ROOT.'/uploads/posts/' . $item['Post']['image']))
                {
                    $image = '/uploads/posts/' . $item['Post']['image'];
                }
                ?>
                <a href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                    <div style="background: url('<?php echo $image;?>'); background-position: center center; background-size: cover; height: 60px"></div>
                </a>
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
                        $title = substr($title, 0, $start + 1) . '...';
                    }
                }
                ?>
                <h4>
                    <a class="link-hover none-textdecoretion" href="/bai-viet/<?php echo $item['Post']['postlink'];?>-<?php echo $item['Post']['id'];?>" title="<?php echo $item['Post']['title'];?>">
                        <?php echo $title;?>
                    </a>
                </h4>
<!--                <div class="hidden-xs">-->
<!--                    --><?php //echo $item['Post']['summary'];?>
<!--                </div>-->
            </div>
        </div>
        <?php
    }
}
?>
