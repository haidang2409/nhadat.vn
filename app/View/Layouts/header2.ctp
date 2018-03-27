<!DOCTYPE html>
<html lang="vi">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php if(isset($title)){ echo $title;} else { echo 'My website';} echo ' - ' . $_SERVER['HTTP_HOST'];?>
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
    echo $this->Html->css('select2.min');
    echo $this->Html->css('colorbox.min');
    echo $this->Html->css('ace.min');
    echo $this->Html->css('jquery-ui.min');
    echo $this->Html->css('style');
    echo $this->Html->script('jquery-2.1.4.min', array());
    echo $this->Js->writeBuffer();
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
<body>
<?php include ('header_contact.ctp');?>
<!--Menu xs khung tim kiem-->
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-left: 0px !important;">
<!--                <button class="btn btn-danger" id="btn-menu-xs" data-status="true"><i class="fa fa-search"></i> </button>-->
            </div>
            <div class="col-xs-5 text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                <a href="/">
                    <img style="margin: auto" class="visible-xs" src="/img/temp/logo_home2.png" width="" height="">
                </a>
            </div>
            <div class="col-xs-4 text-right" style="padding-right: 0px !important;">
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="icon-user fa fa-user"></i><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-profile">
                        <li><a href="/members/profile">Tài khoản</a></li>
                        <li><a href="/members/logout">Đăng xuất</a></li>
                    </ul>
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
                    <a href="/du-an" class="a-header link-waring">Dự án</a>
                    <a href="/nha-dat" class="a-header link-waring">Nhà đất</a>
                    <a href="/can-mua-can-thue" class="a-header link-waring <">Cần mua/Cần thuê</a>
                    <a href="/khuyen-mai" class="a-header link-waring">Khuyến mãi</a>
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
            <a href="/"><img src="/img/temp/logo_home1.png" alt="Nhà đất Mekong"></a>
<!--        </div>-->
<!--        <div class="col-sm-6">-->
            <span>
                <a href="/du-an" class="a-header link-waring">Dự án</a>
                <a href="/nha-dat" class="a-header link-waring">Nhà đất</a>
                <a href="/can-mua-can-thue" class="a-header link-waring <">Cần mua/Cần thuê</a>
                <a href="/khuyen-mai" class="a-header link-waring">Khuyến mãi</a>
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
<div class="hidden-xs" style="background-color: #ec971f">
    <nav class="container navbar-custom navbar navbar-default" style="background-color: #ec971f !important;">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" style="color: white">
                <?php echo __('Home');?>
            </a>
            <a class="navbar-brand" href="/a/gioi-thieu" style="color: white">
                <?php echo __('Giới thiệu');?>
            </a>
            <a class="navbar-brand" href="/tuyen-dung" style="color: white">
                <?php echo __('Tuyển dụng');?>
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container">
                <!--Ul profile-->
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li>
                            <a href="/nha-dat-ban">
                                Bán
                            </a>
                        </li>
                        <li>
                            <a href="/nha-dat-cho-thue">
                                Cho thuê
                            </a>
                        </li>
                        <li>
                            <a href="/tim-theo-ban-do">
                                Bản đồ
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-md-5 text-center">
                                                <img src="/img/members/<?php echo $this->Session->read('Member.image');?>"
                                                     alt="Alternate Text" class="img-responsive img-circle" />
                                                <p class="text-center small">
                                                    <a href="/members/change_avatar"><?php echo __('Change avatar');?></a></p>
                                            </div>
                                            <div class="col-md-7">
                                            <span>
                                                <?php
                                                echo $this->Session->read('Member.fullname');
                                                ?>
                                            </span>
                                                <p class="text-muted small">
                                                    <?php
                                                    echo $this->Session->read('Member.email');
                                                    ?>
                                                </p>
                                                <div class="divider">
                                                </div>
                                                <a href="/members/profile" class=""><?php echo __('Account');?></a>
                                                <div class="divider"></div>
                                                <a href="/members/change_password" class=""><?php echo __('Change password');?></a>
                                                <div class="divider"></div>
                                                <a href="/members/logout" class=""><?php echo __('Logout');?></a>
                                                <div class="divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                else
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
<!--                        <li>-->
                        <a class="btn btn-white" href="/dang-tin-bat-dong-san" style="margin-top: 8px !important; margin-bottom: 8px !important;">
                            <?php echo __('Add post free');?> <i class="fa fa-plus"></i>
                        </a>
<!--                        </li>-->
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div><!-- /.nav-collapse -->
    </nav>
</div>