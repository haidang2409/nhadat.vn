<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/products">Tin bất động sản</a> </li>
                <li>Chi tiết tin đăng</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <h1>
                        Chi tiết tin đăng
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo $product['Transactiontype']['nametype']
                            ?>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo $product['Group']['groupname']
                            ?>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo $product['Category']['categoryname']
                            ?>
                        </small>
                    </h1>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <h3 style="margin: 10px 0 !important;">
                                    <?php
                                    echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');
                                    ?>
                                </h3>
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
                            <div>
                                <?php
                                echo 'Ngày tạo: ' . $this->Lib->convertDateTime_Mysql_to_DateTime($product['Product']['created']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Thông tin liên hệ</h4>
                            <i class="fa fa-user"></i>
                            <?php
                            echo $product['Product']['fullname'];
                            ?>
                            <br>
                            <i class="fa fa-phone"></i>
                            <?php
                            echo $product['Product']['phonenumber'];
                            ?>
                            <br>
                            <i class="fa fa-envelope"></i>
                            <?php
                            echo $product['Product']['email'];
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <h4>Thông tin thành viên</h4>
                            <i class="fa fa-user"></i>
                            <a href="/admin/members/view_detail/<?php echo $product['Member']['id'];?>">
                                <?php
                                echo $product['Member']['fullname'];
                                ?>
                            </a>
                            <br>
                            <i class="fa fa-phone"></i>
                            <?php
                            echo $product['Member']['phonenumber'];
                            ?>
                            <br>
                            <i class="fa fa-envelope"></i>
                            <?php
                            echo $product['Member']['email'];
                            ?>
                        </div>
                    </div>
                    <hr>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div style="font-weight: bold">
                        <?php
                        echo htmlentities($product['Product']['summary'], ENT_QUOTES, 'UTF-8');
                        ?>
                    </div>
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
                                <?php echo $product['Product']['length'];?>m
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Chiều rộng
                            </td>
                            <td>
                                <?php echo $product['Product']['width'];?>m
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
                                <?php echo $product['Product']['road'];?>m<sup>2</sup>
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
                <div class="col-sm-6">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 50% !important;">
                                Tiện ích bất động sản
                            </td>
                            <td style="line-height: 23px">
                                <?php
                                if($utility)
                                {
                                    ?>
                                    <?php echo ($utility['Utility']['lake'] == 1)? 'Hồ bơi<br>': '';?>
                                    <?php echo ($utility['Utility']['garden'] == 1)? 'Sân vườn<br>': '';?>
                                    <?php echo ($utility['Utility']['balcony'] == 1)? 'Ban công/Sân thượng<br>': '';?>
                                    <?php echo ($utility['Utility']['furniture'] == 1)? 'Đầy đủ nội thất<br>': '';?>
                                    <?php echo ($utility['Utility']['airconditioner'] == 1)? 'Điều hòa<br>': '';?>
                                    <?php echo ($utility['Utility']['internet'] == 1)? 'Internet<br>': '';?>
                                    <?php echo ($utility['Utility']['carparking'] == 1)? 'Chỗ đậu xe hơi<br>': '';?>
                                    <?php echo ($utility['Utility']['firealarm'] == 1)? 'Báo cháy<br>': '';?>
                                    <?php echo ($utility['Utility']['gymroom'] == 1)? 'Phòng tập gym<br>': '';?>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50% !important;">
                                Môi trường xung quanh
                            </td>
                            <td style="line-height: 23px">
                                <?php if($environment)
                                {
                                ?>
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
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    for($i = 0; $i < count($images); $i++)
                    {
                        ?>
                        <img src="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink']?>" width="25%">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <br>
            <!--            End Detail-->

            <!--            Maps-->
            <?php
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
            ?>
            <!--            End Maps-->

        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $(function () {
        $('#li-product').addClass('active open');
    })
</script>