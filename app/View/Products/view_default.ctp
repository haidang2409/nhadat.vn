<?php if(count($product) > 0):?>
<div class="container">
    <!--            Breadcrumbs-->
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ace-save-state hidden-xs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <a href="/">Trang chủ</a>
                    </li>
                    <li>
                        <?php
                        if($product['Transactiontype']['vend'] == 1)
                        {
                            ?>
                            <a href="/nha-dat">Nhà đất</a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="/can-mua-can-thue">Cần mua/thuê</a>
                            <?php
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if($product['Transactiontype']['vend'] == 1)
                        {
                            ?>
                            <a href="/<?php echo $product['Group']['grouplink'];?>-g<?php echo $product['Group']['id'];?>"><?php echo $product['Group']['groupname'];?></a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="/can-mua-can-thue/<?php echo $product['Group']['grouplink'];?>-g<?php echo $product['Group']['id'];?>"><?php echo $product['Group']['groupname'];?></a>
                            <?php
                        }
                        ?>

                    </li>
                    <li>
                        <?php
                        if($product['Transactiontype']['vend'] == 1)
                        {
                            ?>
                            <a href="/<?php echo $product['Category']['categorylink'];?>-c<?php echo $product['Category']['id'];?>"><?php echo $product['Category']['categoryname'];?></a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="/can-mua-can-thue/<?php echo $product['Category']['categorylink'];?>-c<?php echo $product['Category']['id'];?>"><?php echo $product['Category']['categoryname'];?></a>
                            <?php
                        }
                        ?>
                    </li>
                    <li class="active"><?php echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');?></li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    <!--            End Breadcrumbs-->
    <div class="row">
        <div class="col-sm-9">
<!--            Hình ảnh-->
            <?php
            $sum_image = count($images);
            if($sum_image > 0)
            {
                ?>
                <div class="row">
                    <?php
                    include('view_gallery1.ctp');
                    ?>
                </div>
                <?php
            }
            ?>
<!--            End Hình ảnh-->
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <h1 style="margin: 10px 0 !important;">
                            <?php
                            echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
<!--            Dia chi-->
            <div class="row">
                <div class="col-sm-12">
                    <span class="location">
                    <?php echo htmlentities($product['Product']['address'], ENT_QUOTES, 'UTF-8');?>,
                    <?php echo $product['Ward']['wardtype'];?>
                    <?php echo $product['Ward']['wardname'];?>,
                    <?php echo $product['District']['districttype'];?>
                    <?php echo $product['District']['districtname'];?>,
                    <?php echo $product['Province']['provincename'];?>
                    </span>
                </div>
            </div>
<!--            Price-->
            <div class="row">
                <div class="col-sm-12">
                    <span class="price" style="font-size: 1.5em; color: #ec971f">
                        <?php if($product['Product']['price'] == 0):?>
                            Giá thỏa thuận
                        <?php elseif ($product['Product']['price'] > 0 && $product['Product']['price2'] > $product['Product']['price']): ?>
                            <i class="fa fa-dollar"></i>
                            <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($product['Product']['price']) . ' - ' . $this->Lib->format_price($product['Product']['price2']);?>
                        <?php else:?>
                            <i class="fa fa-dollar"></i>
                            <?php echo $this->Lib->format_price($product['Product']['price']);?>
                        <?php endif ?>
<!--                                    Acreage-->
                        <i class="fa fa-book"></i>
                        <?php if ($product['Product']['acreage'] > 0 && $product['Product']['acreage2'] > $product['Product']['acreage']): ?>
                            <?php echo number_format($product['Product']['acreage'], 0, '', '.') . ' - ' . number_format($product['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                        <?php else:?>
                            <?php echo number_format($product['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                        <?php endif ?>
                    </span>
                </div>
            </div>
<!--            Contact xs-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="product-contact visible-xs">
                        <div class="product-search-header product-search-header-first">
                            <h3>Thông tin liên hệ</h3>
                        </div>
                        <div class="contact">
                            <table style="width: 100%">
                                <tr>
                                    <td align="center">
                                        <img src="/img/members/<?php echo $product['Member']['image']?>" class="img-circle" width="80px" height="80px" style="max-width: 80px">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 1.3em; text-align: center; width: 100%">
                                        <?php
                                        echo $product['Member']['fullname'];
                                        ?>
                                        <br>
                                        <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $product['Product']['phonenumber'];?>">
                                                <a style="color: orangered" href="tel:<?php echo $product['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($product['Product']['phonenumber']);?></a>
                                            </span>
                                        </span>
                                        <br>
                                        <span style="font-size: 15px">
                                            <?php echo $product['Product']['email'];?>
                                        </span>
                                        <hr class="hr-dotted">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<!--            End contact xs-->
<!--            Detail-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="product-description">
                        <?php
                        echo nl2br(htmlentities($product['Product']['description'], ENT_QUOTES, 'UTF-8'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin: 10px 0 !important;">Thông tin bất động sản</h3>
                </div>
<!--                Thong tin co ban-->
                <div class="col-sm-6">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 50% !important;">
                                Số tầng
                            </td>
                            <td>
                                <?php echo $product['Product']['floornumber'];?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Chiều dài
                            </td>
                            <td>
                                <?php echo $product['Product']['length'] != ''? $product['Product']['length'] . 'm': '';?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Chiều rộng
                            </td>
                            <td>
                                <?php echo $product['Product']['width'] != ''? $product['Product']['width'] . 'm': '';?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số phòng ngủ
                            </td>
                            <td>
                                <?php echo $product['Product']['roomnumber'];?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Toilet
                            </td>
                            <td>
                                <?php echo $product['Product']['toiletnumber'];?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Đường trước nhà
                            </td>
                            <td>
                                <?php echo $product['Product']['road'] != ''? $product['Product']['road'] . 'm': '';?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Hướng
                            </td>
                            <td>
                                <?php echo $product['Direction']['directionname'];?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php
                if($product['Transactiontype']['vend'] == 1)
                {
                    ?>
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 50% !important;">
                                    Tiện ích bất động sản
                                </td>
                                <td style="line-height: 23px">
                                    <?php echo ($utility['Utility']['lake'] == 1)? 'Hồ bơi<br>': '';?>
                                    <?php echo ($utility['Utility']['garden'] == 1)? 'Sân vườn<br>': '';?>
                                    <?php echo ($utility['Utility']['balcony'] == 1)? 'Ban công/Sân thượng<br>': '';?>
                                    <?php echo ($utility['Utility']['furniture'] == 1)? 'Đầy đủ nội thất<br>': '';?>
                                    <?php echo ($utility['Utility']['airconditioner'] == 1)? 'Điều hòa<br>': '';?>
                                    <?php echo ($utility['Utility']['internet'] == 1)? 'Internet<br>': '';?>
                                    <?php echo ($utility['Utility']['carparking'] == 1)? 'Chỗ đậu xe hơi<br>': '';?>
                                    <?php echo ($utility['Utility']['firealarm'] == 1)? 'Báo cháy<br>': '';?>
                                    <?php echo ($utility['Utility']['gymroom'] == 1)? 'Phòng tập gym<br>': '';?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50% !important;">
                                    Môi trường xung quanh
                                </td>
                                <td style="line-height: 23px">
                                    <?php echo ($environment['Environment']['supermarket'] == 1)? 'Gần siêu thị<br>': '';?>
                                    <?php echo ($environment['Environment']['hospital'] == 1)? 'Gần bệnh viện<br>': '';?>
                                    <?php echo ($environment['Environment']['school'] == 1)? 'Gần trường học<br>': '';?>
                                    <?php echo ($environment['Environment']['park'] == 1)? 'Gần công viên<br>': '';?>
                                    <?php echo ($environment['Environment']['public_traffic'] == 1)? 'Giao thông công cộng<br>': '';?>
                                    <?php echo ($environment['Environment']['security'] == 1)? 'Gần khu an ninh<br>': '';?>
                                    <?php echo ($environment['Environment']['river'] == 1)? 'Gần sông<br>': '';?>
                                    <?php echo ($environment['Environment']['sea'] == 1)? 'Gần biển<br>': '';?>
                                    <?php echo ($environment['Environment']['temple'] == 1)? 'Gần chùa<br>': '';?>
                                    <?php echo ($environment['Environment']['church'] == 1)? 'Gần nhà thờ<br>': '';?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
<!--            End Detail-->
<!--            Maps-->
            <?php
            if($product['Transactiontype']['vend'] == 1)
            {
                if($product['Product']['latitude'] > 0 && $product['Product']['longitude'] > 0)
                {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="map" style="height: 400px">
                            </div>
                            <script>
                                var uluru = {lat: <?php echo $product['Product']['latitude'];?>, lng: <?php echo $product['Product']['longitude'];?>};
                                var marker;
                                function initMap() {
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 16,
                                        center: uluru
                                    });
                                    marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map,
                                        draggable: false
                                    });
                                }
                            </script>
                            <script async defer
                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w&callback=initMap">
                            </script>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
<!--            End Maps-->

            <!--            Comments-->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="input-comment">
                        <hr>
                        <h3 class="blue" style="margin-bottom: 10px !important;">Đăng bình luận</h3>
                        <textarea id="inputComment" rows="1" type="text" class="form-control" placeholder="Nhập nội dung... "></textarea>
                        <input type="hidden" value="<?php echo $this->Session->check('Member')? md5($this->Session->read('Member.id')): '';?>" name="token" id="token">
                        <div class="text-right"  style="padding: 5px 0">
                            <button class="btn btn-warning btn-mini" id="btnCommentProduct" data-product_id="<?php echo $product['Product']['id'];?>"><i class="fa fa-send"></i> Gửi</button>
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
        <div class="col-sm-3">
            <div class="product-contact">
                <div class="product-search-header product-search-header-first">
                    <h3>Thông tin liên hệ</h3>
                </div>
                <div class="contact">
                    <table style="width: 100%">
                        <tr>
                            <td style="vertical-align: middle; text-align: center">
                                <img src="/img/members/<?php echo $product['Member']['image']?>" class="img-circle" width="80px" height="80px" style="max-width: 80px">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 1.3em; text-align: center; width: 100%">
                                <?php
                                echo $product['Product']['fullname'];
                                ?>
                                <br>
                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                    <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $product['Product']['phonenumber'];?>">
                                        <a style="color: orangered" href="tel:<?php echo $product['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($product['Product']['phonenumber']);?></a>
                                    </span>
                                </span>
                                <br>
                                <span style="font-size: 15px">
                                    <?php echo $product['Product']['email'];?>
                                </span>
                                <hr class="hr-dotted">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=""><!-- style="background-color: #D5D5D5; padding: 5px 10px"> -->
                    <form class="form-horizontal form-login form-register-info" id="form-register-product" method="post" action="">
                        <h4 style="margin-bottom: 15px !important;" class="text-center blue">Hoặc đăng ký nhận thông tin</h4>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <input class="form-control" type="hidden" name="product_id" id="product_id" placeholder="id" value="<?php echo $product['Product']['id'];?>">
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
                                <button class="btn btn-danger" id="save-product" type="button" title="Lưu tin bất động sản này" data-product_id="<?php echo $product['Product']['id'];?>"><i class="fa fa-heart"> </i> Lưu tin</button>
                                <button class="btn btn-primary" id="btnRegister_Info" type="button">Đăng ký <i class="fa fa-arrow-right"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<!--            Rating-->
            <div class="">

            </div>
<!--            End Rating-->
<!--            Product liên quan-->
            <div class="row">
                <div class="col-md-12">
                    <div class="product-search-header">
                        <h3>Bất động sản liên quan</h3>
                    </div>
                </div>
                <div class="col-sm-12 product-container">
                    <?php
                    $sum_relative = count($product_relative);
                    for($j = 0; $j < $sum_relative; $j++)
                    {
                        $item = $product_relative[$j];
                        ?>
                        <div class="list-product-bg-hover">
                            <div class="row list-style-2">
                                <div class="col-sm-4 col-xs-5 product-list-image">
                                    <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                        <?php
                                        $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                        if($item['Product']['image'])
                                        {
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                        }
                                        ?>
                                        <div class=""
                                             style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-8 col-xs-7 product-list-summary">
                                    <hr>
                                    <h4>
                                        <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>" style="text-decoration: none">
                                            <?php
                                            echo $item['Product']['title'];
                                            ?>
                                        </a>
                                    </h4>
                                    <div class="">
                                        <span class="price">
                                        <?php if($item['Product']['price'] == 0):?>
                                            Thỏa thuận
                                        <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                            <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']);?>
                                        <?php else:?>
                                            <?php echo $this->Lib->format_price($item['Product']['price']);?>
                                        <?php endif ?> -
                                            <!--                                    Acreage-->
                                            <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                                <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                                            <?php else:?>
                                                <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                                            <?php endif ?>
                                        </span>
                                        <span class="location">
                                        <i class="fa fa-map-marker"> </i>
                                            <?php echo $item['Product']['address'];?>,
                                            <?php echo $item['Ward']['wardtype'];?>
                                            <?php echo $item['Ward']['wardname'];?>,
                                            <?php echo $item['District']['districttype'];?>
                                            <?php echo $item['District']['districtname'];?>,
                                            <?php echo $item['Province']['provincename'];?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
<!--            End product lien quan-->

        </div>
    </div>
</div>
<?php else:?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php echo $this->element('error'); ?>
        </div>
    </div>
</div>
<?php endif?>
<!--Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer" style="display: none">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a href="/members/login" type="button" class="btn btn-primary">Đăng nhập</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->


<?php echo $this->Html->script('register_info'); ?>
<script>
    $(function () {
        $('.phone-number').on('click', function(){
            var phone = $(this).data('phonenumber');
            $(this).html(phone)
        });
        $('#save-product').click(function(){
            var product_id = $(this).data('product_id');
            $.ajax({
                'url': '/products/add_favorite',
                'type': 'post',
                'dataType': 'html',
                'data': {
                    'product_id': product_id
                },
                'success': function(data)
                {
                    var info = JSON.parse(data);
                    if(info.status == 'not_login')
                    {
                        $('.modal-body').html('Vui lòng <a href="/members/login">đăng nhập</a> trước khi lưu');
                        $('.modal-footer').show();
                        $('#myModal').modal('show');
                    }
                    else if(info.status == 'success')
                    {
                        $('.modal-body').html(info.message);
                        $('#myModal').modal('show');
                    }
                    else
                    {
                        alert('Lỗi');
                    }
                }
            })
        })
    })
</script>
<?php echo $this->Html->script('comment_products.min');?>
<script>
    $(function () {
        var post_id = <?php echo $product['Product']['id'];?>;
        load_comment(1, post_id);
    });
</script>