<!DOCTYPE html>
<html lang="vi">
<head>
    <?php
    echo $this->Html->charset();
    $arr_keyword = array(
        'nhà đất phòng',
        'nhà đất bán',
        'nhà đất cho thuê',
        'cần mua nhà đất',
        'cần thuê nhà đất',
        'bất động sản',
        'bất động sản cần thơ',
        'nhà đất cần thơ',
        'nha dat phong',
        'nha dat ban',
        'nha dat cho thue',
        'can mua nha dat',
        'can thue nha dat',
        'bat dong san',
        'bat dong san can tho'
    );
    $m_title = '';
    $m_description = '';
    if(isset($title))
    {
        $m_title = $title;
    }
    else
    {
        $m_title = 'Kênh Bất Động Sản số 1 Cần Thơ';
    }
    if(isset($head_description))
    {
        $m_description = $head_description;
    }
    else
    {
        $m_description = 'Kênh Bất Động Sản số 1 Cần Thơ. Nhà đất phòng bán, cho thuê tại Cần Thơ';
    }
    ?>
    <title>
        <?php echo $m_title . ' - ' . $_SERVER['HTTP_HOST'];?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?php
    echo $this->Html->meta('keywords', isset($keywords)? $keywords:  implode(', ', $arr_keyword));
    echo $this->Html->meta('description', $m_description);
    echo $this->Html->meta('icon');
    echo $this->Html->css('app');
    echo $this->Html->css('bootstrap-custom.min');
    echo $this->Html->css('style');
    echo $this->Html->script('jquery-2.1.4.min', array());
    echo $this->Js->writeBuffer();
    ?>
    <meta property="og:url"  content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php  echo $m_title . ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta property="og:description" content="<?php  echo $m_description;?>"/>
    <meta property="og:image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo 'http://' . $_SERVER['HTTP_HOST'] . '/img/temp/logo_home1.png';}?>"/>
    <meta itemprop="name" content="<?php echo $m_title . ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta itemprop="description" content="<?php echo $m_description;?>"/>
    <meta itemprop="image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo 'http://' . $_SERVER['HTTP_HOST'] . '/img/temp/logo_home1.png';}?>"/>
</head>
<body>
<!--Menu xs khung tim kiem-->
<div class="menu-xs">
    <form method="get" action="/" id="form-search-nha-dat">
        <div class="menu-xs-header text-center">
            <div style="display: inline; width: 100% !important; padding-left: 10px; text-align: center !important;">
                <input type="text" name="search" placeholder="<?php echo __('Search');?>" style="" value="">
            </div>
            <div style="display: inline; float: right">
                <a class="a-close-menu" href="javascript: void(0)">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-12" style="margin-bottom: 20px">
            <div class="accordian" id="accordian">
                <ul>
                    <li>
                        <h4>
                            <a class="" href="/nha-dat-ban">
                                BĐS Bán
                            </a>
                            <i data-expand="1" class="fa fa-chevron-down icon-plus-expand"></i>
                        </h4>
                        <ul>
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li>
                                    <a class="bolder" href="/ban-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        +
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Bán ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                                foreach ($item['Category'] as $item_cat)
                                {
                                    ?>
                                    <li>
                                        <a href="/ban-<?php echo $item_cat['categorylink'];?>-c<?php echo $item_cat['id'];?>">
                                            -
                                            <?php
                                            echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Bán ' . $item_cat['categoryname'])), 1);
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <a class="" href="/nha-dat-cho-thue">
                                Cho thuê
                            </a>
                            <i data-expand="1" class="fa fa-chevron-down icon-plus-expand"></i>
                        </h4>
                        <ul>
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li>
                                    <a class="bolder" href="/cho-thue-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        +
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cho thuê ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                                foreach ($item['Category'] as $item_cat)
                                {
                                    ?>
                                    <li>
                                        <a href="/cho-thue-<?php echo $item_cat['categorylink'];?>-c<?php echo $item_cat['id'];?>">
                                            -
                                            <?php
                                            echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cho thuê ' . $item_cat['categoryname'])), 1);
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <a class="" href="/can-mua-nha-dat">
                                Cần mua
                            </a>
                            <i data-expand="1" class="fa fa-chevron-down icon-plus-expand"></i>
                        </h4>
                        <ul>
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li>
                                    <a class="bolder" href="/can-mua-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        +
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần mua ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                                foreach ($item['Category'] as $item_cat)
                                {
                                    ?>
                                    <li>
                                        <a href="/can-mua-<?php echo $item_cat['categorylink'];?>-c<?php echo $item_cat['id'];?>">
                                            -
                                            <?php
                                            echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần mua ' . $item_cat['categoryname'])), 1);
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <a class="" href="/can-thue-nha-dat">
                                Cần thuê
                            </a>
                            <i data-expand="1" class="fa fa-chevron-down icon-plus-expand"></i>
                        </h4>
                        <ul>
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li>
                                    <a class="bolder" href="/can-thue-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        +
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần thuê ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                                foreach ($item['Category'] as $item_cat)
                                {
                                    ?>
                                    <li>
                                        <a href="/can-thue-<?php echo $item_cat['categorylink'];?>-c<?php echo $item_cat['id'];?>">
                                            -
                                            <?php
                                            echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần thuê ' . $item_cat['categoryname'])), 1);
                                            ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <h4>
                            <a href="/tim-theo-ban-do">
                                Bản đồ
                            </a>
                        </h4>
                    </li>
                    <li>
                        <h4>
                            <a href="/du-an">
                                Dự án
                            </a>
                        </h4>
                    </li>
                    <li>
                        <h4>
                            <a href="/bai-viet">
                                Tin tức
                            </a>
                        </h4>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-left: 0px !important;">
                <span class="" id="btn-menu-xs" data-status="true">
                    <span class="fa fa-bars"></span>
                </span>
            </div>
            <div class="col-xs-5 text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                <a href="/">
                    <img style="margin: auto" class="visible-xs" src="/img/temp/logo_home2.png" width="" height="" alt="Nhà đất phòng Cần Thơ">
                </a>
            </div>
            <div class="col-xs-4 text-right" style="padding-right: 0px !important;">
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                        <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <img src="/img/threedot.png" width="50px" height="50px">
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
                <div class="" style="margin-top: 10px">
                    <a class="btn btn-warning" href="/dang-tin-bat-dong-san"><?php echo __('Add post free');?> <i class="fa fa-plus"></i> </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End menu sm navbar header sm-->
<div class="container hidden-xs" style="padding-top: 5px; padding-bottom: 5px">
    <div class="row">
        <div class="col-md-9 col-sm-8 text-left">
            <a href="/">
                <img src="/img/temp/logo_home1.png" alt="Kênh bất động sản số 1 Cần Thơ" height="70px">
            </a>
            <img class="hidden-sm" src="/uploads/advertise/quangcao2.jpg" width="550px" style="float: right" alt="Bất động sản Cần Thơ">
        </div>
        <div class="col-md-3 col-sm-4 text-right" style="padding-top: 5px">
            <div class="language" style="margin-bottom: 5px">
                <a href="?language=vie"><?php echo __('Vietnamese');?></a> |
                <a href="?language=eng"><?php echo __('English');?></a> |
                <a href="?language=jpn"><?php echo __('Japanese');?></a>
            </div>
            <a class="btn btn-warning bolder" href="/dang-tin-bat-dong-san">
                <i class="fa fa-pencil-square-o"> </i> <?php echo __('Add post free');?>
            </a>
        </div>
    </div>
</div>
<!--End menu xs navbar ngang xs-->
<div class="hidden-xs" style="background-color: #4F99C6">
    <nav class="container navbar-custom navbar navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" style="color: white" title="Trang chủ">
                <h1 style="font-size: 15px; font-weight: bolder"><?php echo __('Home');?></h1>
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container">
                <ul class="hidden-xs nav navbar-nav">
<!--                    -->
                    <li class="li-cat">
                        <a href="/nha-dat-ban">BĐS Bán <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="/ban-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Bán ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="li-cat">
                        <a href="/nha-dat-cho-thue">Cho thuê <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="/cho-thue-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cho thuê ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="li-cat">
                        <a href="/can-mua-nha-dat">Cần mua <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="/can-mua-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần mua ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="li-cat">
                        <a href="/can-thue-nha-dat">Cần thuê <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                            <?php
                            foreach ($categories_menu as $item)
                            {
                                ?>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="/can-thue-<?php echo $item['Group']['grouplink'];?>-g<?php echo $item['Group']['id'];?>">
                                        <?php
                                        echo preg_replace('/^đ/', 'Đ', ucfirst(mb_strtolower('Cần thuê ' . $item['Group']['groupname'])), 1);
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="li-cat hidden-sm">
                        <a href="/tim-theo-ban-do">Bản đồ</a>
                    </li>
                    <li class="li-cat hidden-sm">
                        <a href="/du-an">Dự án</a>
                    </li>
                    <li class="li-cat hidden-sm">
                        <a href="/bai-viet">Tin tức</a>
                    </li>
                </ul>
                <!--Ul profile-->
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li class="dropdown dropdown-profile-hover">
                            <a href="#" class="dropdown-toggle bolder" data-toggle="dropdown">
                                <?php
                                echo $this->Lib->hidden_text($this->Session->read('Member.fullname'), 50);
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-profile">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="text-center">
                                                    <img src="/img/members/<?php echo $this->Session->read('Member.image');?>"
                                                         alt="" class="img-responsive img-circle" />
                                                    <p class="text-center small">
                                                        <a href="/members/change_avatar"><?php echo __('Change avatar');?></a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-7"  style="margin-bottom: 15px !important;">
                                                <p class="text-muted" style="margin-bottom: 5px">
                                                    <?php
                                                    echo $this->Session->read('Member.fullname');
                                                    ?>
                                                </p>
                                                <p class="text-muted small">
                                                    <?php
                                                    echo $this->Session->read('Member.email');
                                                    ?>
                                                </p>
                                                <div class="divider">
                                                </div>
                                                <a href="/members/profile" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    <?php echo __('Account');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/change_password" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    <?php echo __('Change password');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/logout" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    <?php echo __('Logout');?>
                                                </a>
                                                <!--                                                <div class="divider"></div>-->
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
                    <div class="nav navbar-nav navbar-right" style="padding-top: 7px">
                        <a class="btn btn-info btn-white btn-round bolder" href="/members/login">
                            <i class="fa fa-user"></i> <?php echo __('Login');?>
                        </a>
                        <a class="btn btn-info btn-white btn-round bolder" href="/members/register">
                            <i class="fa fa-key"> </i> <?php echo __('Sign up');?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div><!-- /.nav-collapse -->
    </nav>
</div>