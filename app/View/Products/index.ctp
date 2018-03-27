<?php
$option_price = array(
    '-1_-1' => 'Thỏa thuận',
    '0_1' => '< 1 triệu',
    '1_5' => '1 - 5 triệu',
    '5_10' => '5 - 10 triệu',
    '10_50' => '10 - 50 triệu',
    '50_100' => '50 - 100 triệu',
    '100_500' => '100 - 500 triệu',
    '500_1000' => '500 - 1 tỷ',
    '1000_5000' => '1 - 5 tỷ',
    '5000_10000' => '5 - 10 tỷ',
    '10000_50000' => '10 - 50 tỷ',
    '50000_0' => '> 50 tỷ',
);
$option_acreage = array(
    '0_10' => '< 10 m2',
    '10_50' => '10 - 50 m2',
    '50_100' => '50 - 100 m2',
    '100_500' => '100 - 500 m2',
    '500_1000' => '500 - 1000 m2',
    '1000_5000' => '1000 - 5000 m2',
    '5000_0' => '> 5000 m2',

);
$option_floor = array(
    '1' => '1+',
    '2' => '2+',
    '3' => '3+',
    '4' => '4+',
    '5' => '5+',
    '10' => '10+',
    '20' => '20+',
    '50' => '50+',
    '100' => '100+',
);
$option_room = array(
    '1' => '1+',
    '2' => '2+',
    '3' => '3+',
    '4' => '4+',
    '5' => '5+',
    '10' => '10+'
);
?>
<div class="container-search">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="search-primary">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-sm-12 div-choose-type">
                                <input id="type" type="hidden" value="<?php echo rtrim($type, '-');?>">
                                <ul class="ul-type">
                                    <li>
                                        <a href="javascript: void(0)" class="btn-choose-type <?php if($type == 'ban-'){ echo 'active';}?>" data-type="ban">BĐS BÁN</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0)" class="btn-choose-type <?php if($type == 'cho-thue-'){ echo 'active';}?>" data-type="cho-thue">CHO THUÊ</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0)" class="btn-choose-type <?php if($type == 'can-mua-'){ echo 'active';}?>" data-type="can-mua">CẦN MUA</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0)" class="btn-choose-type <?php if($type == 'can-thue-'){ echo 'active';}?>" data-type="can-thue">CẦN THUÊ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <?php echo $this->Form->input('province_', array('name' => 'province', 'id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $province_menu, 'type' => 'select', 'empty' => '-- Tỉnh thành -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('district_', array('name' => 'district', 'id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => null, 'type' => 'select', 'empty' => ' -- Quận huyện -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('ward_', array('name' => 'ward', 'id' => 'ward', 'label' => false, 'class' => 'form-control', 'title' => 'Xã phường', 'options' => null, 'type' => 'select', 'empty' => ' -- Xã phường -- ', 'style' => 'width: 100 % !important;'));?>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <?php echo $this->Form->input('category_', array('name' => 'category', 'id' => 'category', 'label' => false, 'class' => 'form-control', 'title' => 'Loại nhà đất', 'options' => $option_category, 'type' => 'select', 'empty' => ' -- Loại nhà đất -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('price_', array('name' => 'price', 'id' => 'price', 'label' => false, 'class' => 'form-control', 'title' => 'Mức giá', 'options' => $option_price, 'type' => 'select', 'empty' => ' -- Mức giá -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('acreage_', array('name' => 'acreage', 'id' => 'acreage', 'label' => false, 'class' => 'form-control', 'title' => 'Diện tích', 'options' => $option_acreage, 'type' => 'select', 'empty' => ' -- Diện tích -- ', 'style' => 'width: 100 % !important;'));?>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <?php echo $this->Form->input('direction', array('name' => 'direction', 'id' => 'direction', 'label' => false, 'class' => 'form-control', 'title' => 'Hướng bất động sản', 'options' => $directions, 'type' => 'select', 'empty' => ' -- Chọn hướng -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('floor_number', array('name' => 'floor_number', 'id' => 'floor_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số tầng', 'options' => $option_floor, 'type' => 'select', 'empty' => ' -- Số tầng -- ', 'style' => 'width: 100 % !important;'));?>
                                <?php echo $this->Form->input('room_number', array('name' => 'room_number', 'id' => 'room_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số phòng', 'options' => $option_room, 'type' => 'select', 'empty' => ' -- Số phòng ngủ -- ', 'style' => 'width: 100 % !important;'));?>
                            </div>
                            <div class="col-sm-12 col-xs-12 text-right">
                                <button type="button" id="btnSearchPrimary" class="btn btn-primary bolder"><i class="fa fa-search"> </i> TÌM KIẾM </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3 product-container">
            <br>
            <div class="row hidden">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-8">
                            <h2>DỰ ÁN NỔI BẬT</h2>
                        </div>
                        <div class="col-xs-4 text-right" style="padding-top: 4px">
                            <a class="view-all" href="/du-an-vip">Xem thêm + </i> </a>
                        </div>
                    </div>
                    <hr class="hr-double">
                </div>
                <div class="col-sm-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $sum = count($projects);
                            for($j = 0; $j < $sum; $j+=3)
                            {
                                ?>
                                <div class="item <?php if($j == 0){echo 'active';}?>">
                                    <div class="row" style="margin-bottom: 15px">
                                        <?php
                                        for($k = 0; $k < 3; $k++)
                                        {
                                            if(isset($projects[$j + $k]))
                                            {
                                                ?>
                                                <div class="col-sm-4">
                                                    <a class="project-title" href="/du-an-vip/<?php echo $projects[$j + $k]['Projectcat']['project_category_link'];?>-<?php echo $projects[$j + $k]['Projectcat']['id'];?>/<?php echo $projects[$j + $k]['Project']['projectlink'];?>-<?php echo $projects[$j + $k]['Project']['id'];?>" title="<?php echo $projects[$j + $k]['Project']['title'];?>">
                                                        <div style="
                                                                height: 180px;
                                                                background: url('/uploads/projects/<?php echo $projects[$j + $k]['Project']['image'];?>');
                                                                background-position: center center;
                                                                background-size: cover;
                                                                ">
                                                        </div>
                                                    </a>
                                                    <h4 style="padding: 5px 0">
                                                        <small>
                                                            <a class="project-title" href="/du-an-vip/<?php echo $projects[$j + $k]['Projectcat']['project_category_link'];?>-<?php echo $projects[$j + $k]['Projectcat']['id'];?>/<?php echo $projects[$j + $k]['Project']['projectlink'];?>-<?php echo $projects[$j + $k]['Project']['id'];?>" title="<?php echo $projects[$j + $k]['Project']['title'];?>">
                                                                <?php echo $projects[$j + $k]['Project']['title'];?>
                                                            </a>
                                                            <br>
                                                            <i class="fa fa-map-marker"></i>
                                                            <?php echo $projects[$j + $k]['District']['districtname'];?>
                                                            <?php echo $projects[$j + $k]['Province']['provincename'];?>
                                                        </small>
                                                    </h4>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div><!-- End Carousel Inner -->
                    </div><!-- /.carousel -->
                </div>
            </div>
            <!--            End project-->
            <!--            Adv-->
            <div class="row">
                <div class="col-md-12 hidden">
                    <div class="text-center" style="margin: 15px 0">
                        <img src="/uploads/advertise/gif1.gif" style="max-width: 100%">
                    </div>
                </div>
            </div>
            <!--            END ADV-->
            <!--            Product-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>BẤT ĐỘNG SẢN MỚI</h2>
                        </div>
                    </div>
                    <hr class="hr-double">
                </div>
                <div class="col-sm-12">
                    <?php
                    $sum_product = count($products);
                    if($sum_product > 0)
                    {
                        for($i = 0; $i < $sum_product; $i++)
                        {
                            $item = $products[$i];
                            ?>
                            <div class="list-product-bg-hover-<?php echo $item['Packet']['id'];?>">
                                <div class="row list-style-<?php echo $item['Packet']['id']; if($item['Product']['red_title'] == 1) { echo ' red-title';}?>">
                                    <div class="col-sm-3 col-xs-5 product-list-image">
                                        <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                            <?php
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                            if($item['Product']['image'] && ($item['Packet']['id'] == 1 || $item['Packet']['id'] == 2))
                                            {
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                            }
                                            ?>
                                            <div class=""
                                                 style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                                <?php
                                                if($item['Packet']['id'] == 1)
                                                {
                                                    ?>
                                                    <div class="label-top1-icon">
                                                        NỔI BẬT
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-9 col-xs-7 product-list-summary">
                                        <hr>
                                        <h4>
                                            <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                <?php
                                                echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                ?>
                                            </a>
                                        </h4>
                                        <div class="visible-xs text-center">
                                            <span class="price">
                                                <?php
                                                $price = $this->Lib->print_price($item['Product']['price'], $item['Product']['price2'], $item['Product']['opt_price']);
                                                echo $price;
                                                ?>
                                                <br>
                                                <?php
                                                $acreage = $this->Lib->print_acreage($item['Product']['acreage'], $item['Product']['acreage2']);
                                                echo $acreage;
                                                ?>
                                            </span>
                                        </div>
                                        <div class="hidden-xs">
                                            <span class="price">
                                                <?php
                                                echo $price;
                                                ?>
                                                -
                                                <?php
                                                echo $acreage;
                                                ?>
                                            </span>
                                            <div class="summary">
                                                <?php
                                                $summary = '';
                                                if($item['Product']['summary'] != '')
                                                {
                                                    $summary = $this->Lib->hidden_text($item['Product']['summary'], 200);
                                                }
                                                else
                                                {
                                                    $summary = $this->Lib->hidden_text($item['Product']['description'], 200);
                                                }
                                                echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                                ?>
                                            </div>
                                            <span class="location">
                                                <i class="fa fa-map-marker"> </i>
                                                <?php echo $item['Product']['address']? htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8') . ',': '';?>
                                                <?php echo $item['Ward']['wardtype'];?>
                                                <?php echo $item['Ward']['wardname'];?>,
                                                <?php echo $item['District']['districttype'];?>
                                                <?php echo $item['District']['districtname'];?>,
                                                <?php echo $item['Province']['provincename'];?>
                                             </span>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <span class="member">
                                                        <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle"  alt="<?php echo $item['Product']['title'];?>">
                                                        <?php echo $item['Product']['fullname'];?>
                                                        <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                                                <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="col-sm-4 text-right">
                                                    <span class="date">
                                                        <i class="fa fa-clock-o"> </i>
                                                        <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs">
                                        <div class="summary">
                                            <?php
                                            echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                            ?>
                                        </div>
                                        <span class="location">
                                            <i class="fa fa-map-marker"> </i>
                                            <?php echo $item['Product']['address']? htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8') . ',': '';?>
                                            <?php echo $item['Ward']['wardtype'];?>
                                            <?php echo $item['Ward']['wardname'];?>,
                                            <?php echo $item['District']['districttype'];?>
                                            <?php echo $item['District']['districtname'];?>,
                                            <?php echo $item['Province']['provincename'];?>
                                        </span>
                                        <div class="row">
                                            <div class="col-sm-8">
                                <span class="member">
                                    <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle" alt="<?php echo $item['Product']['title'];?>">
                                    <?php echo $item['Product']['fullname'];?>
                                    <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                        <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                            <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                        </span>
                                    </span>
                                </span>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <span class="date">
                                                    <i class="fa fa-clock-o"> </i>
                                                    <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!--            End product-->
        </div>
        <div class="col-sm-3 col-sm-pull-9" style="padding-top: 0 !important;">
            <!--        Adv-->
            <div style="margin-top: 20px">
                <a href="http://dream.edu.vn" target="_blank">
                    <img src="/uploads/advertise/quang-cao-2.jpg" width="100%" alt="Nghệ thuật hiện thực hóa ước mơ">
                </a>
            </div>
            <!--            Posts-->
            <div style="margin: 15px 0">
                <?php echo $this->Element('../Elements/posts_col_sm');?>
            </div>
            <!--            End posts-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".accordian-search h4").click(function(){
            $(".accordian-search ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        });
        $('.icon-plus-expand').on('click', function(){
            $('.icon-plus-expand').addClass('fa-plus');
            var data = $(this).data('expand');
            if(data == '1')
            {
                $(this).data('expand', '0');
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
            }
            else
            {
                $(this).data('expand', '1');
                $(this).removeClass('fa-minus');
                $(this).addClass('fa-plus');
            }

        });
        $('.phone-number').on('click', function(){
            var phone = $(this).data('phonenumber');
            $(this).html(phone)
        });
        $('#province, #district, #ward, #category, #price, #acreage, #direction, #floor_number, #room_number').select2({
            minimumResultsForSearch: -1
        });
        $('#province').change(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    'url': '/districts/get_district_link',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'province_id': province_id
                    },
                    beforeSend: function(){
                        $('#district').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                        $('#ward').html('<option value=""> -- Phường xã -- </option>').select2({minimumResultsForSearch: -1});
                    },
                    success: function(string)
                    {
                        $('#district').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('#district').change(function () {
            var district_id = $('#district').val();
            if(district_id != '')
            {
                $.ajax({
                    'url': '/wards/get_ward_link',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'district_id': district_id
                    },
                    beforeSend: function(){
                        $('#ward').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                    },
                    success: function(string)
                    {
                        $('#ward').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('.btn-choose-type').click(function () {
            $('.btn-choose-type').removeClass('active');
            $(this).addClass('active');
            var type = $(this).data('type');
            $('#type').val($.trim(type));
        });
        $('#btnSearchPrimary').click(function () {
            var here = '';
            var type = $('#type').val();
            if(type == 'ban')
            {
                here = '/nha-dat-ban';
            }
            if(type == 'cho-thue')
            {
                here = '/nha-dat-cho-thue';
            }
            if(type == 'can-mua')
            {
                here = '/can-mua-nha-dat';
            }
            if(type == 'can-thue')
            {
                here = '/can-thue-nha-dat';
            }
            var category = $('#category').val();
            if(category != '')
            {
                if(type == 'ban')
                {
                    here = '/ban-' + category;
                }
                if(type == 'cho-thue')
                {
                    here = '/cho-thue-' + category;
                }
                if(type == 'can-mua')
                {
                    here = '/can-mua-'+ category;
                }
                if(type == 'can-thue')
                {
                    here = '/can-thue-' + category;
                }
            }
            //Price
            var query_string = '?search=';
            var price = $('#price').val();
            var acreage = $('#acreage').val();
            var direction = $('#direction').val();
            var floor_number = $('#floor_number').val();
            var room_number = $('#room_number').val();
            var window_location = '';
            query_string = query_string + '&price=' + price + '&acreage=' + acreage + '&direction=' + direction + '&floor_number=' + floor_number + '&room_number=' + room_number;

            var ward_link = $('#ward').val();
            if(ward_link != '')
            {
                window_location = here + '/' + ward_link;
            }
            else
            {
                var district_link = $('#district').val();
                if(district_link != '')
                {
                    window_location = here + '/' + district_link;
                }
                else
                {
                    var province_link = $('#province').val();
                    if(province_link != '')
                    {
                        window_location = here + '/' + province_link;
                    }
                    else
                    {
                        window_location = here;
                    }
                }
            }
            window.location = window_location + query_string;
        });

    })
</script>