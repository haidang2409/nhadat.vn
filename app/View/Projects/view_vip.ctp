<div class="" style="background-color: #4F99C6" id="project-detail-nav-bar" data-spy="affix" data-offset-top="90" data-offset-bottom="200">
    <nav class="container navbar-custom navbar navbar-default" style="background-color: #4F99C6 !important;">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: white">
                <?php
                if(isset($title_project))
                {
                    echo $title_project;
                }
                else
                {
                    echo 'Dự án';
                }
                ?>
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container"  id="my-nav-bar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#gioi-thieu">
                            Giới thiệu
                        </a>
                    </li>
                    <li>
                        <a href="#hinh-anh">
                            Hình ảnh
                        </a>
                    </li>
                    <li>
                        <a href="#tien-ich">
                            Tiện ích
                        </a>
                    </li>
                    <li>
                        <a href="#thiet-ke">
                            Thiết kế
                        </a>
                    </li>
                    <li>
                        <a href="#mat-bang">
                            Mặt bằng
                        </a>
                    </li>
                    <li>
                        <a href="#vi-tri">
                            Vị trí
                        </a>
                    </li>
                    <li>
                        <a href="#thanh-toan">
                            Thanh toán
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- /.nav-collapse -->
    </nav>
</div>
<div class="project-detail-container">
    <?php
    echo isset($projects)? $projects['Project']['description']: '';
    ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4">
            <div class=""><!-- style="background-color: #D5D5D5; padding: 5px 10px"> -->
                <form class="form-horizontal form-login form-register-info" id="form-register-product" method="post" action="">
                    <h4 style="margin-bottom: 15px !important;">Hoặc đăng ký nhận thông tin</h4>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12">
                            <input class="form-control" type="hidden" name="project" id="project" placeholder="id" value="<?php echo $projects['Project']['title'];?>">
                            <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Họ tên">
                            <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12">
                            <input class='form-control' type="text" id="email" name="email" placeholder="Địa chỉ email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12">
                            <input class='form-control' type="text" id="phonenumber" name="phonenumber" placeholder="Số điện thoại">
                            <span class="glyphicon glyphicon-earphone form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-sm-12">
                            <textarea style="resize: none" class='form-control' id="content" name="content" placeholder="Nội dung"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center-xs text-right">
                            <button class="btn btn-primary" id="btnRegister_Info" type="button">Đăng ký <i class="fa fa-arrow-right"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('register_project');?>
<script>
    $(function () {
        var $document = $(document),
            $element = $('#project-detail-nav-bar');
        $document.scroll(function() {
            if ($document.scrollTop() >= 90) {
                $element.addClass('fixtop');
                $element.stop().css({
                    top: '0px'
                });
            } else {
                $element.removeClass('fixtop');
                $element.stop().css({
                    top: '-90px'
                });
            }
        });

        $("#my-nav-bar ul li a[href^='#']").on('click', function(e) {
            // prevent default anchor click behavior
            e.preventDefault();
            // animate
            $('html, body').animate({
                scrollTop: $(this.hash).offset().top
            }, 700, function(){
            });

        });
    })
</script>
