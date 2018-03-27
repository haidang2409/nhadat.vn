<!DOCTYPE html>
<html lang="vi">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php if(isset($title)){ echo $title;} else { echo 'Kênh bất động sản số 1 Cần Thơ';} echo ' - ' . $_SERVER['HTTP_HOST'];?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?php
    echo $this->Html->meta('keywords', isset($keywords)? $keywords: 'Bất động sản, nhà đất, nhà đất bán, nhà đất cho thuê, cần mua nhà đất, cần thuê nhà đất');
    echo $this->Html->meta('description', isset($head_description)? $head_description: 'Bất động sản Mekong, kênh bất động hàng đầu khu vực');
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('bootstrap-custom.min');
    echo $this->Html->css('ace.min');
    echo $this->Html->css('style');
    echo $this->Html->css('style_project_detail');
    echo $this->Html->script('jquery-2.1.4.min');
    ?>
    <meta property="og:url"  content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title)){ echo $title;} else { echo 'Bất động sản MeKong';} echo ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta property="og:description" content="<?php echo isset($head_description)? $head_description: 'Bất động sản Mekong, kênh bất động hàng đầu khu vực'?>"/>
    <meta property="og:image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo $_SERVER['HTTP_HOST'] . '/img/og_logo_default.jpg';}?>"/>
    <meta itemprop="name" content="<?php if(isset($title)){ echo $title;} else { echo 'Bất động sản MeKong';} echo ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta itemprop="description" content="<?php echo isset($head_description)? $head_description: 'Bất động sản Mekong, kênh bất động hàng đầu khu vực'?>"/>
    <meta itemprop="image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo $_SERVER['HTTP_HOST'] . '/img/og_logo_default.jpg';}?>"/>
</head>
<body data-spy="scroll" data-target="#project-detail-nav-bar">
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-left: 0px !important;">
<!--                <button class="btn btn-danger" id="btn-menu-xs" data-status="true"><i class="fa fa-search"></i> </button>-->
            </div>
            <div class="col-xs-6 text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                <a href="/">
                    <img style="margin: auto" class="visible-xs" src="/img/temp/logo_home2.png" width="" height="">
                </a>
            </div>
            <div class="col-xs-3 text-right" style="padding-right: 0px !important;">
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <a class="profile-member" href="/members/profile"><i class="icon-user fa fa-user"></i></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" style="padding-top: 5px">
                <div class="language" style="margin-bottom: 10px">
                    <a href="?language=vie"><?php echo __('Vietnamese');?></a> |
                    <a href="?language=eng"><?php echo __('English');?></a> |
                    <a href="?language=jpn"><?php echo __('Japanese');?></a>
                </div>
                <span style="padding-bottom: 15px !important;">
                   <a href="/nha-dat-ban" class="a-header link-waring">BĐS Bán</a>
                    <a href="/nha-dat-cho-thue" class="a-header link-waring">Cho thuê</a>
                    <a href="/can-mua-nha-dat" class="a-header link-waring">Cần mua</a>
                    <a href="/can-thue-nha-dat" class="a-header link-waring">Cần thuê</a>
                </span><br>
                <a class="btn btn-warning" href="/products/add"><?php echo __('Add post free');?> <i class="fa fa-plus"></i> </a>
                <br>
                <?php
                if(!$this->Session->check('Member'))
                {
                    ?>
                    <a class="link-primary none-textdecoretion link-lg" href="/members/login">
                        <?php echo __('Login');?>
                    </a> |
                    <a class="link-waring none-textdecoretion link-lg" href="/members/register">
                        <?php echo __('Sign up');?>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--End menu sm navbar header sm-->
<div class="container hidden-xs" style="padding-top: 10px; padding-bottom: 10px">
    <div class="row">
        <div class="col-sm-8 text-left">
            <a href="/"><img src="/img/temp/logo_home1.png" width="210px" height="70px" alt="Nhà đất phòng bán, cho thuê"></a>
<!--        </div>-->
<!--        <div class="col-sm-6">-->
            <span>
                <a href="/nha-dat-ban" class="a-header link-waring">BĐS Bán</a>
                <a href="/nha-dat-cho-thue" class="a-header link-waring">Cho thuê</a>
                <a href="/can-mua-nha-dat" class="a-header link-waring">Cần mua</a>
                <a href="/can-thue-nha-dat" class="a-header link-waring">Cần thuê</a>
            </span>
        </div>
        <div class="col-sm-4 text-right" style="padding-top: 5px">
            <div class="language" style="margin-bottom: 10px">
                <a href="?language=vie"><?php echo __('Vietnamese');?></a> |
                <a href="?language=eng"><?php echo __('English');?></a> |
                <a href="?language=jpn"><?php echo __('Japanese');?></a>
            </div>
            <?php
            if(!$this->Session->check('Member'))
            {
                ?>
                <a class="link-primary none-textdecoretion link-lg" href="/members/login">
                    <?php echo __('Login');?>
                </a> |
                <a class="link-waring none-textdecoretion link-lg" href="/members/register">
                    <?php echo __('Sign up');?>
                </a>
                <?php
            }
            else
            {
                ?>
                <a class="btn btn-warning" href="/products/add"><?php echo __('Add post free');?> <i class="fa fa-plus"></i> </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!--End menu xs navbar ngang xs-->
