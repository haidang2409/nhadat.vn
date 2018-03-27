<div class="container">
    <div class="row">
        <div class="col-sm-3 hidden-xs">
            <?php include ('profile-menu.ctp');?>
        </div>
        <div class="col-sm-9 col-xs-12">
            <h2>Thay đổi mật khẩu</h2>
            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <?php echo $this->Form->create('Member', array('class' => 'form-horizontal form-register', 'novalidate' => true));?>
            <div class="form-group has-feedback">
                <label for="password" class="col-sm-4 control-label">Mật khẩu cũ</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('password_old', array('label' => false, 'class' => 'form-control', 'title' => 'Nhập mật khẩu cũ', 'type' => 'password'));?>
                    <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="password_new" class="col-sm-4 control-label">Mật khẩu mới</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('password_new', array('label' => false, 'class' => 'form-control', 'title' => 'Nhập mật khẩu mới', 'type' => 'password'));?>
                    <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="re_password_new" class="col-sm-4 control-label">Nhập lại mật khẩu mới</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('re_password_new', array('label' => false, 'class' => 'form-control', 'title' => 'Nhập mật khẩu mới', 'type' => 'password'));?>
                    <span class="glyphicon glyphicon-repeat form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div class="text-center-xs text-center">
                <button class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Thay đổi
                </button>
            </div>
            <?php
            echo $this->Form->end();?>
        </div>
    </div>
</div>