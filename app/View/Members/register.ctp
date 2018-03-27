<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
            <h3 align="center" style="margin-bottom: 10px !important;">ĐĂNG KÝ</h3>
            <hr>
            <?php
            echo $this->Session->flash();
            ?>
            <?php echo $this->Form->create('Member', array('class' => 'form-horizontal form-register', 'novalidate' => true));?>
            <div class="form-group has-feedback">
                <label for="username" class="col-sm-4 control-label"><?php echo __('Username');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'title' => 'Tên đăng nhập', 'placeholder' => 'Tên đăng nhập từ 6 ký tự'));?>
                    <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="email" class="col-sm-4 control-label"><?php echo __('Email address');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'title' => 'Địa chỉ email', 'placeholder' => 'Nhập địa chỉ email của bạn để xác thực'));?>
                    <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="username" class="col-sm-4 control-label"><?php echo __('Full name');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('fullname', array('label' => false, 'class' => 'form-control', 'title' => 'Họ tên', 'placeholder' => 'Nhập đầy đủ họ tên của bạn'));?>
                    <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="phonenumber" class="col-sm-4 control-label"><?php echo __('Phone number');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('phonenumber', array('label' => false, 'class' => 'form-control', 'title' => 'Số điện thoại', 'placeholder' => 'Nhập số điện thoại của bạn'));?>
                    <span class="fa fa-phone form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="password" class="col-sm-4 control-label"><?php echo __('Password');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'title' => 'Mật khẩu', 'placeholder' => 'Mật khẩu từ 8 ký tự'));?>
                    <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="repassword" class="col-sm-4 control-label"><?php echo __('Re-enter password');?> <font class="label-require"> (*)</font> </label>
                <div class="col-sm-7">
                    <?php echo $this->Form->input('repassword', array('label' => false, 'class' => 'form-control', 'type' => 'password', 'title' => 'Nhập lại mật khẩu', 'placeholder' => 'Nhập lại mật nhẩu của bạn'));?>
                    <?php echo $this->Form->input('token', array('label' => false, 'class' => 'form-control', 'type' => 'hidden', 'value' => $this->params['_Token']['key']));?>
                    <span class="fa fa-refresh form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="repassword" class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                    <div class="checkbox">
                        <label class="block">
                            <input name="form-field-checkbox" disabled="" checked class="ace" type="checkbox">
                            <span class="lbl"> Đồng ý với các <a href="/help/dieu-khoan-su-dung">điều khoản sử dụng dịch vụ</a> </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="repassword" class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="6LddJT0UAAAAAKOerTZU0-BxFRwdaLgdm4zz4ozE"></div>
                </div>
            </div>
            <div class="text-center-xs text-center">
                <button class="btn btn-warning" type="reset">
                    <i class="fa fa-refresh"></i>
                    <?php echo __('Reset');?>
                </button>
                <button class="btn btn-primary" id="btnRegister">
                    <i class="fa fa-check"></i>
                    <?php echo __('Register');?>
                </button>
            </div>
            <div class="text-center" style="margin-top: 10px">
                <?php echo __('Have account');?>? <a class="link-waring none-textdecoretion" href="/members/login"><?php echo __('Login');?></a>
            </div>
            <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#btnRegister').click(function () {
            $(this).attr('disabled', true);
            $('#MemberRegisterForm').submit();
            $(this).html('<i class="fa fa-spin fa-spinner"></i> Loading')
        })
    })
</script>