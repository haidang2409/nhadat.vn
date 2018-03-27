<div class="container" style="min-height: 400px;">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <?php
            echo $this->Session->flash();
            ?>
            <form style="padding: 10px 5px 5px 5px; margin-top: 15px" id="frmLogin" class="form-horizontal form-login" method="post" action="/members/login">
                <h3 align="center" style="">ĐĂNG NHẬP</h3>
                <hr>
                <div class="form-group has-feedback">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập hoặc email hoặc sđt">
                        <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input class='form-control' type="password" name="password" placeholder="Mật khẩu">
                        <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit"><?php echo __('Login');?> <i class="fa fa-sign-in"></i> </button>
                        <br><br>
                        <a class="link-primary none-textdecoretion" href="/members/register">Hoặc đăng ký</a> | <a class="none-textdecoretion" href="/members/forget_password">Quên mật khẩu</a>
                    </div>
                </div>
                <?php
                $continue = '';
                if(isset($_GET['continue']))
                {
                    $continue = $_GET['continue'];
                }
                else if(isset($_SERVER['HTTP_REFERER']))
                {
                    $continue = $_SERVER['HTTP_REFERER'];
                }
                ?>
                <input type="text" name="url_redirect" value="<?php echo $continue;?>">
                <div class="form-group text-center">
                    <a class="btn btn-danger" href="/socials/login_with_google" style="min-width: 220px; margin-bottom: 5px">
                        <i class="fa fa-google"> </i>
                        Đăng nhập bằng Google
                    </a>
                    <a class="btn btn-primary" href="https://www.facebook.com/dialog/oauth?client_id=177466519511280&redirect_uri=http://nhadatphong.com/login-with-facebook/" style="min-width: 220px; margin-bottom: 5px">
                        <i class="fa fa-facebook"> </i>
                        Đăng nhập bằng Facebook
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>