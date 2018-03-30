<?php
$type = isset($this->params['url']['type'])? $this->params['url']['type']: '';
$price = isset($this->params['url']['price'])? $this->params['url']['price']: '';
$acreage = isset($this->params['url']['acreage'])? $this->params['url']['acreage']: '';
$direction = isset($this->params['url']['direction'])? $this->params['url']['direction']: '';
$floornumber = isset($this->params['url']['floor_number'])? $this->params['url']['floor_number']: '';
$roomnumber = isset($this->params['url']['room_number'])? $this->params['url']['room_number']: '';
$province = isset($this->params['url']['province'])? $this->params['url']['province']: '';
$district = isset($this->params['url']['district'])? $this->params['url']['district']: '';
$ward = isset($this->params['url']['ward'])? $this->params['url']['ward']: '';
$search = isset($this->params['url']['search'])? $this->params['url']['search']: '';
$group = isset($this->params['url']['group'])? $this->params['url']['group']: '';
$category = isset($this->params['url']['category'])? $this->params['url']['category']: '';
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
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="get">
                <div class="row search-maps">
                    <div class="col-sm-3 col-xs-6">
                        <?php echo $this->Form->input('type', array('name' => 'type', 'id' => 'type', 'label' => false, 'class' => 'form-control', 'title' => 'Hình thức', 'options' => $option_types, 'type' => 'select', 'empty' => ' -- Hình thức -- ', 'style' => 'width: 100 % !important;', 'default' => $type));?>
                        <?php echo $this->Form->input('group_', array('name' => 'group', 'id' => 'group', 'label' => false, 'class' => 'form-control', 'title' => 'Loại nhà đất', 'options' => $option_groups, 'type' => 'select', 'empty' => ' -- Loại nhà đất -- ', 'style' => 'width: 100 % !important;', 'default' => $group));?>
                        <?php echo $this->Form->input('category_', array('name' => 'category', 'id' => 'category', 'label' => false, 'class' => 'form-control', 'title' => 'Phân loại', 'options' => $option_categories, 'type' => 'select', 'empty' => ' -- Phân loại -- ', 'style' => 'width: 100 % !important;', 'default' => $category));?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <?php echo $this->Form->input('province_', array('name' => 'province', 'id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $option_provinces, 'type' => 'select', 'empty' => '-- Tỉnh thành -- ', 'style' => 'width: 100 % !important;', 'default' => $province));?>
                        <?php echo $this->Form->input('district_', array('name' => 'district', 'id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => $option_districts, 'type' => 'select', 'empty' => ' -- Quận huyện -- ', 'style' => 'width: 100 % !important;', 'default' => $district));?>
                        <?php echo $this->Form->input('ward_', array('name' => 'ward', 'id' => 'ward', 'label' => false, 'class' => 'form-control', 'title' => 'Xã phường', 'options' => $option_wards, 'type' => 'select', 'empty' => ' -- Xã phường -- ', 'style' => 'width: 100 % !important;', 'default' => $ward));?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <?php echo $this->Form->input('price_', array('name' => 'price', 'id' => 'price', 'label' => false, 'class' => 'form-control', 'title' => 'Mức giá', 'options' => $option_price, 'type' => 'select', 'empty' => ' -- Mức giá -- ', 'style' => 'width: 100 % !important;', 'default' => $price));?>
                        <?php echo $this->Form->input('acreage_', array('name' => 'acreage', 'id' => 'acreage', 'label' => false, 'class' => 'form-control', 'title' => 'Diện tích', 'options' => $option_acreage, 'type' => 'select', 'empty' => ' -- Diện tích -- ', 'style' => 'width: 100 % !important;', 'default' => $acreage));?>
                        <?php echo $this->Form->input('direction', array('name' => 'direction', 'id' => 'direction', 'label' => false, 'class' => 'form-control', 'title' => 'Hướng bất động sản', 'options' => $directions, 'type' => 'select', 'empty' => ' -- Chọn hướng -- ', 'style' => 'width: 100 % !important;', 'default' => $direction));?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <?php echo $this->Form->input('floor_number', array('name' => 'floor_number', 'id' => 'floor_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số tầng', 'options' => $option_floor, 'type' => 'select', 'empty' => ' -- Số tầng -- ', 'style' => 'width: 100 % !important;', 'default' => $floornumber));?>
                        <?php echo $this->Form->input('room_number', array('name' => 'room_number', 'id' => 'room_number', 'label' => false, 'class' => 'form-control', 'title' => 'Số phòng', 'options' => $option_room, 'type' => 'select', 'empty' => ' -- Số phòng ngủ -- ', 'style' => 'width: 100 % !important;', 'default' => $roomnumber));?>
                        <div class="text-right">
                            <a href="/tim-theo-ban-do" class="btn btn-danger bolder"><i class="fa fa-remove"> </i> XÓA </a>
                            <button type="submit" id="btnSearchPrimary" class="btn btn-primary bolder"><i class="fa fa-search"> </i> TÌM KIẾM </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-9 product-container">
            <div class="col-sm-12">
                <div class="div-hint">
                    Click vào từng vị trí trên bản đồ để xem (<?php echo count($products);?> kết quả)
                </div>
            </div>
            <br><br>
            <!--            maps-->
            <div id="map" style="width: 100%; height: 600px; margin-bottom: 15px">

            </div>
            <!--            maps-->
        </div>
        <div class="col-sm-3" style="padding-top: 0 !important;">
            <!--                List maps-->
            <div class="product-search-header product-search-header-first">
                <h3><?php echo __('Danh sách tin');?></h3>
            </div>
            <div id="list-product" style="max-height: 600px; overflow-y: scroll; overflow-x: hidden; margin-bottom: 15px">
                <ul class="ul-list-maps">
                    <?php
                    if(isset($products))
                    {
                        foreach ($products as $item)
                        {
                            $image = 'http://nhadatphong.com/uploads/products/no-image-product.png';
                            if($item['Product']['image'] != '' && file_exists(WWW_ROOT.'/uploads/products/thumb/'.$item['Product']['image']))
                            {
                                $image = 'http://nhadatphong.com/uploads/products/' . $item['Product']['image'];
                            }
                            ?>
                            <li>
                                <a href="javascript: void(0)">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="<?php echo $image?>" width="100%">
                                        </div>
                                        <div class="col-xs-8">
                                            <?php echo $this->Lib->hidden_text($item['Product']['title'], 70);?>
                                            <br>
                                            <span style="color: #737373; font-size: 14px">
                                                    <?php
                                                    echo 'Giá: ' . $this->Lib->print_price($item['Product']['price'], $item['Product']['price2'], $item['Product']['opt_price']);
                                                    echo '<br>';
                                                    echo 'Diện tích: ' . $this->Lib->print_acreage($item['Product']['acreage'], $item['Product']['acreage2']);
                                                    ?>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <!--                End list maps-->
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
        $('#province').change(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    'url': '/districts/get_district',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'province_id': province_id
                    },
                    beforeSend: function () {
                        $('#district').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                        $('#ward').html('<option selected>Xã phường</option>').select2({minimumResultsForSearch: -1});
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
                    'url': '/wards/get_ward',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'district_id': district_id
                    },
                    beforeSend: function () {
                        $('#ward').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});;
                    },
                    success: function(string)
                    {
                        $('#ward').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('#group').change(function () {
            var group_id = $('#group').val();
            if(group_id != '')
            {
                $.ajax({
                    'url': '/categories/get_category',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'groupproduct_id': group_id
                    },
                    beforeSend: function () {
                        $('#category').html('<option disabled selected>Đang tải</option>').select2({minimumResultsForSearch: -1});
                    },
                    success: function(string)
                    {
                        $('#category').html(string).select2({minimumResultsForSearch: -1});
                    }
                });
            }
        });
        $('#type, #group, #category, #price, #acreage, #province, #district, #ward, #direction, #floor_number, #room_number').select2({
            minimumResultsForSearch: -1
        })
    })
</script>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w"
        type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var locations = [
            <?php
            $i = 1;
            if(isset($products))
            {
                foreach ($products as $item)
                {
                    if($item['Product']['longitude'] > 0 && $item['Product']['latitude'] > 0)
                    {
                        $image = 'http://nhadatphong.com/uploads/products/no-image-product.png';
                        if($item['Product']['image'] != '' && file_exists(WWW_ROOT.'/uploads/products/thumb/'.$item['Product']['image']))
                        {
                            $image = 'http://nhadatphong.com/uploads/products/' . $item['Product']['image'];
                        }
                        $href = '<table><tr><td style="padding-right: 5px;"><img src="' . $image . '" width="100px"></td>';
                        $href = $href . '<td><a style="font-size: 16px;" href="/' . $item['Product']['productlink'] . '-' . $item['Product']['id'] . '">' . $item['Product']['title'] . '</a>';
                        $href = $href . '<br>';
                        $price = $this->Lib->print_price($item['Product']['price'], $item['Product']['price2'], $item['Product']['opt_price']);
                        $acreage = $this->Lib->print_acreage($item['Product']['acreage'], $item['Product']['acreage2']);
                        $href = $href . $price . ' - ' . $acreage . '<br>';
                        $href = $href . 'Liên hệ: ' . $item['Product']['phonenumber'] . ' - ' . $item['Product']['fullname'];
                        $href = $href . '</td></tr></table>';
                        echo  '[';
                        echo  "'" . $href . "',";
                        echo  $item['Product']['latitude'] . ',';
                        echo  $item['Product']['longitude'] . ',';
                        echo $i;
                        echo '], ';
                        $i = $i + 1;
                    }
                }
            }
            ?>
        ];
        var lat = <?php echo $lat?>;
        var lng = <?php echo $lng?>;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        var gmarkers = [];
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: '/img/maps_icon.png',
            });
            gmarkers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                    marker.setIcon('/img/maps_icon2.png');
                }
            })(marker, i));
            google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
                return function() {
                    marker.setIcon('/img/maps_icon.png');
                }
            })(marker, i));
        };
        $('#list-product li a').each(function(i, e) {
            $(e).click(function(i) {
                return function(e) {
                    google.maps.event.trigger(gmarkers[i], 'click');
                }
            }(i));
        });
    });
</script>