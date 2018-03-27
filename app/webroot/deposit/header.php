<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <title>
        Nhà | Đất | Phòng bán - cho thuê - nhadat.vn    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="keywords" content="nhà đất phòng, nhà đất bán, nhà đất cho thuê, cần mua nhà đất, cần thuê nhà đất, bất động sản, bất động sản cần thơ, nhà đất cần thơ, nha dat phong, nha dat ban, nha dat cho thue, can mua nha dat, can thue nha dat, bat dong san, bat dong san can tho"/><meta name="description" content="Kênh Bất Động Sản số 1 Cần Thơ. Nhà đất phòng bán, cho thuê tại Cần Thơ"/>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <link rel="stylesheet" type="text/css" href="/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-custom.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
    <meta property="og:url"  content="nhadat.vn/" />
    <link rel="stylesheet" type="text/css" href="/deposit/atm/css/main.css"/>
</head>
<body>
<?php
session_name('CAKEPHP');
session_start();
if(!isset($_SESSION['Member']))
{
    header('Location: /members/login');
}
?>
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-right: 0px !important;">
                <?php
                if(isset($_SESSION['Member']))
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/members/<?php echo $_SESSION['Member']['image'];?>"
                             class="nav-profile-img img-circle" height="50px" width="50px"/>
                    </a>
                    <ul class="dropdown-menu dropdown-profile">
                        <li><a href="/members/profile"><i class="fa fa-user"></i> Tài khoản</a></li>
                        <li><a href="/members/change_password"><i class="fa fa-key"></i> Đổi mật khẩu</a></li>
                        <li><a href="/members/logout"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                    </ul>
                    <?php
                }
                else
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/members/default_user.jpg"
                             class="nav-profile-img img-circle" width="50px" height="50px"/>
                    </a>
                    <ul class="dropdown-menu dropdown-profile">
                        <li><a href="/members/login"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        <li><a href="/members/register"><i class="fa fa-sign-out"></i> Đăng ký</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <div class="col-xs-6 text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                <a href="/">
                    <img style="margin: auto" class="visible-xs" src="/img/temp/logo_home2.png" width="" height="">
                </a>
            </div>
            <div class="col-xs-3 text-right" style="padding-right: 0px !important;">
                <button class="btn btn-warning" id="btn-menu-xs" data-status="true"><i class="fa fa-search"></i> </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" style="padding-top: 5px">
                <div class="language" style="margin-bottom: 10px">
                    <a href="?language=vie">Vietnamese</a> |
                    <a href="?language=eng">English</a> |
                    <a href="?language=jpn">Japanese</a>
                </div>
                <?php
                ?>
                <div>
                    <a class="btn btn-warning bolder" href="/dang-tin-bat-dong-san"><i class="fa fa-pencil-square-o"></i> ĐĂNG TIN MIỄN PHÍ</a>
                </div>
                <hr class="hr-dotted">
            </div>
        </div>
    </div>
</div>
<!--End menu sm navbar header sm-->
<div class="container hidden-xs" style="padding-top: 10px; padding-bottom: 10px">
    <div class="row">
        <div class="col-sm-3 text-left">
            <a href="/"><img src="/img/temp/logo_home1.png" alt="" height="70px"></a>
        </div>
        <div class="col-sm-6 text-center">
            <img src="/uploads/advertise/quangcao2.jpg" height="70px">
        </div>
        <div class="col-sm-3 text-right" style="padding-top: 5px">
            <div class="language" style="margin-bottom: 10px">
                <a href="?language=vie"> Vietnamese</a> |
                <a href="?language=eng"> English </a> |
                <a href="?language=jpn"> Japanese </a>
            </div>
            <a class="btn btn-warning bolder" href="/dang-tin-bat-dong-san"><i class="fa fa-pencil-square-o"></i> ĐĂNG TIN MIỄN PHÍ</a>
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
            <a class="navbar-brand" href="/" style="color: white">
                Trang chủ
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container">
                <ul class="hidden-xs nav navbar-nav">
                    <li class="li-cat">
                        <a href="/nha-dat-ban">BĐS Bán
                        </a>
                    </li>
                    <li class="li-cat">
                        <a href="/nha-dat-cho-thue">Cho thuê
                        </a>
                    </li>
                    <li class="li-cat">
                        <a href="/can-mua-nha-dat">Cần mua
                        </a>
                    </li>
                    <li class="li-cat">
                        <a href="/can-thue-nha-dat">Cần thuê
                        </a>
                    </li>
                </ul>
                <!--Ul profile-->
                <?php
                if(isset($_SESSION['Member']))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li class="dropdown dropdown-profile-hover">
                            <a href="#" class="dropdown-toggle bolder" data-toggle="dropdown">
                                <?php
                                echo $_SESSION['Member']['fullname'];
                                ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-profile">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="text-center">
                                                    <img src="/img/members/<?php echo $_SESSION['Member']['image'];?>"
                                                         alt="" class="img-responsive img-circle" />
                                                    <p class="text-center small">
                                                        <a href="/members/change_avatar">Thay đổi ảnh</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-7"  style="margin-bottom: 15px !important;">
                                                <p class="text-muted" style="margin-bottom: 5px">
                                                    <?php
                                                    echo $_SESSION['Member']['fullname'];
                                                    ?>
                                                </p>
                                                <p class="text-muted small">
                                                    <?php
                                                    echo $_SESSION['Member']['email'];
                                                    ?>
                                                </p>
                                                <div class="divider">
                                                </div>
                                                <a href="/members/profile" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    Tài khoản
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/change_password" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    Đổi mật khẩu
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/logout" class="">
                                                    <i class="fa fa-caret-right"></i>
                                                    Đăng xuất
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