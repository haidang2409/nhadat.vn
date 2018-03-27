<div class="container">
    <div class="row">
        <form method="get" action="<?php echo $_SERVER['REQUEST_URI'];?>">
            <?php
            $price_min = isset($this->params['url']['price_min'])? $this->params['url']['price_min']: '';
            $price_max = isset($this->params['url']['price_max'])? $this->params['url']['price_max']: '';
            $acreage_min = isset($this->params['url']['acreage_min'])? $this->params['url']['acreage_min']: '';
            $acreage_max = isset($this->params['url']['acreage_max'])? $this->params['url']['acreage_max']: '';
            $direction = isset($this->params['url']['direction'])? $this->params['url']['direction']: '';
            $floornumber = isset($this->params['url']['floornumber'])? $this->params['url']['floornumber']: '';
            $roomnumber = isset($this->params['url']['roomnumber'])? $this->params['url']['roomnumber']: '';
            $province = isset($this->params['url']['province'])? $this->params['url']['province']: '';
            $district = isset($this->params['url']['district'])? $this->params['url']['district']: '';
            $ward = isset($this->params['url']['ward'])? $this->params['url']['ward']: '';
            $search = isset($this->params['url']['search'])? $this->params['url']['search']: '';
            $group = isset($this->params['url']['group'])? $this->params['url']['group']: '';
            $category = isset($this->params['url']['category'])? $this->params['url']['category']: '';
            //            $query_string = $_SERVER['QUERY_STRING']!= ''? '?' . $_SERVER['QUERY_STRING']: '';
            ?>
            <div class="col-sm-9 product-container">
                <!--            Breadcrumbs-->
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/"><?php echo __('Home');?></a>
                        </li>
                        <li><a href="/nha-dat">Nhà đất</a></li>
                        <li>Tìm trên bản đồ</li>
                    </ul>
                </div>
                <br>
                <!--            End Breadcrumbs-->

                <!--            maps-->
                <div class="row div-search-location-map" style="margin-bottom: 15px">
                    <div class="col-sm-3">
                        <?php echo $this->Form->input('province', array('name' => 'province', 'id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $provinces, 'type' => 'select', 'empty' => ' -- Tỉnh thành -- ', 'style' => 'width: 100 % !important;', 'default' => $province));?>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Form->input('district', array('name' => 'district', 'id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => $districts, 'type' => 'select', 'empty' => ' -- Quận huyện -- ', 'style' => 'width: 100 % !important;', 'default' => $district));?>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Form->input('ward', array('name' => 'ward', 'id' => 'ward', 'label' => false, 'class' => 'form-control', 'title' => 'Xã phường', 'options' => $wards, 'type' => 'select', 'empty' => ' -- Xã phường -- ', 'style' => 'width: 100 % !important;', 'default' => $ward));?>
                    </div>
                    <div class="col-sm-3 text-center-xs">
                        <button class="btn btn-info" type="submit"><?php echo __('Search');?> <i class="fa fa-search"></i> </button>
                        <a class="btn btn-warning" href="/tim-theo-ban-do"><?php echo __('Remove');?> <i class="fa fa-remove"></i> </a>
                    </div>
                    <div class="col-sm-12">
                        <div class="div-hint">
                            Click vào từng vị trí trên bản đồ để xem (<?php echo count($products);?> kết quả)
                        </div>
                    </div>
                </div>
                <div id="map" style="width: 100%; height: 500px; margin-bottom: 15px">

                </div>
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
                                            $href = $href . '<td><h4><a href="/' . $item['Product']['productlink'] . '-' . $item['Product']['id'] . '">' . $item['Product']['title'] . '</a></h4>';
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
                                icon: '/img/maps_icon2.png',
                            });
                            gmarkers.push(marker);
                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                    infowindow.setContent(locations[i][0]);
                                    infowindow.open(map, marker);
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
                <!--            maps-->
            </div>
            <div class="col-sm-3" style="padding-top: 0 !important;">
<!--                List maps-->
                <div class="product-search-header product-search-header-first">
                    <h3><?php echo __('Danh sách tin');?></h3>
                </div>
                <div id="list-product" style="max-height: 500px; overflow-y: scroll; margin-bottom: 15px">
                    <ul class="ul-list-maps">
                        <?php
                        if(isset($products))
                        {
                            foreach ($products as $item)
                            {
                                ?>
                                <li>
                                    <a href="javascript: void(0)">
                                        <?php echo $item['Product']['title'];?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
<!--                End list maps-->
                <div class="product-search-category">
                    <div class="product-search-header product-search-header-first">
                        <h3><?php echo __('Search by category');?></h3>
                    </div>
                    <div id="" class="accordian accordian-search">
                        <ul>
                            <?php
                            $sum_group = count($categories_menu);
                            for($i = 0; $i < $sum_group; $i++)
                            {
                                ?>
                                <li>
                                    <h4><a class="<?php if($group == $categories_menu[$i]['Group']['id']){ echo ' link-waring';}?>" href="?group=<?php echo $categories_menu[$i]['Group']['id'];?>"><?php echo $categories_menu[$i]['Group']['groupname'];?> </a>
                                        <i data-expand="1" class="fa fa-plus icon-plus-expand"></i>
                                    </h4>
                                    <ul <?php if($group == $categories_menu[$i]['Group']['id']){ echo 'style="display: block !important;"';}?>>
                                        <?php
                                        $cat = $categories_menu[$i]['Category'];
                                        $sum_category = count($cat);
                                        for($j = 0; $j < $sum_category; $j++)
                                        {
                                            ?>
                                            <li>
                                                <a class="<?php if($category == $cat[$j]['id']){ echo ' link-waring';}?>" href="?category=<?php echo $cat[$j]['id'];?>">
                                                    <?php echo $cat[$j]['categoryname'];?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="product-search-price">
                    <div class="product-search-header">
                        <h3><?php echo __('Search by basic info');?></h3>
                    </div>
                    <table class="table-search-basic" style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                Tìm theo giá
                                <select name="price_min" id="price_min">
                                    <option value="">Min</option>
                                    <option <?php if($price_min == 50){ echo 'selected';}?> value="50">50 triệu</option>
                                    <option <?php if($price_min == 100){ echo 'selected';}?> value="100">100 triệu</option>
                                    <option <?php if($price_min == 500){ echo 'selected';}?> value="500">500 triệu</option>
                                    <option <?php if($price_min == 1000){ echo 'selected';}?> value="1000">1 tỷ</option>
                                    <option <?php if($price_min == 10000){ echo 'selected';}?> value="10000">10 tỷ</option>
                                    <option <?php if($price_min == 50000){ echo 'selected';}?> value="50000">50 tỷ</option>
                                    <option <?php if($price_min == 100000){ echo 'selected';}?> value="100000">100 tỷ</option>
                                </select>
                            </td>
                            <td style="width: 50%">
                                <select name="price_max" id="price_max">
                                    <option value="">Max</option>
                                    <option <?php if($price_max == 50){ echo 'selected';}?> value="50">50 triệu</option>
                                    <option <?php if($price_max == 100){ echo 'selected';}?> value="100">100 triệu</option>
                                    <option <?php if($price_max == 500){ echo 'selected';}?> value="500">500 triệu</option>
                                    <option <?php if($price_max == 1000){ echo 'selected';}?> value="1000">1 tỷ</option>
                                    <option <?php if($price_max == 10000){ echo 'selected';}?> value="10000">10 tỷ</option>
                                    <option <?php if($price_max == 50000){ echo 'selected';}?> value="50000">50 tỷ</option>
                                    <option <?php if($price_max == 100000){ echo 'selected';}?> value="100000">100 tỷ</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 50%;">
                                Tìm theo diện tích
                                <select name="acreage_min" id="acreage_min">
                                    <option value="">Min</option>
                                    <option <?php if($acreage_min == 10){ echo 'selected';}?> value="10">10 m2</option>
                                    <option <?php if($acreage_min == 50){ echo 'selected';}?> value="50">50 m2</option>
                                    <option <?php if($acreage_min == 100){ echo 'selected';}?> value="100">100 m2</option>
                                    <option <?php if($acreage_min == 200){ echo 'selected';}?> value="200">200 m2</option>
                                    <option <?php if($acreage_min == 500){ echo 'selected';}?> value="500">500 m2</option>
                                    <option <?php if($acreage_min == 1000){ echo 'selected';}?> value="1000">1.000 m2</option>
                                    <option <?php if($acreage_min == 5000){ echo 'selected';}?> value="5000">5.000 m2</option>
                                    <option <?php if($acreage_min == 10000){ echo 'selected';}?> value="10000">10.000 m2</option>
                                </select>
                            </td>
                            <td style="width: 50%">
                                <select name="acreage_max" id="acreage_max">
                                    <option value="">Max</option>
                                    <option <?php if($acreage_max == 10){ echo 'selected';}?> value="10">10 m2</option>
                                    <option <?php if($acreage_max == 50){ echo 'selected';}?> value="50">50 m2</option>
                                    <option <?php if($acreage_max == 100){ echo 'selected';}?> value="100">100 m2</option>
                                    <option <?php if($acreage_max == 200){ echo 'selected';}?> value="200">200 m2</option>
                                    <option <?php if($acreage_max == 500){ echo 'selected';}?> value="500">500 m2</option>
                                    <option <?php if($acreage_max == 1000){ echo 'selected';}?> value="1000">1.000 m2</option>
                                    <option <?php if($acreage_max == 5000){ echo 'selected';}?> value="5000">5.000 m2</option>
                                    <option <?php if($acreage_max == 10000){ echo 'selected';}?> value="10000">10.000 m2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 0 10px 0 !important;">
                                Tìm theo hướng bất động sản
                                <?php echo $this->Form->input('direction', array('name' => 'direction', 'id' => 'direction', 'label' => false, 'class' => 'form-control', 'title' => 'Hướng bất động sản', 'options' => $directions, 'type' => 'select', 'empty' => ' -- Chọn hướng -- ', 'default' => $direction));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số tầng
                                <?php echo $this->Form->input('floornumber', array('name' => 'floornumber', 'id' => 'floornumber', 'label' => false, 'class' => 'form-control', 'title' => 'Số tầng', 'type' => 'text', 'placeholder' => 'Số tầng', 'value' => $floornumber));?>
                            </td>
                            <td>
                                Số phòng
                                <?php echo $this->Form->input('roomnumber', array('name' => 'roomnumber', 'id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'title' => 'Số phòng ngủ', 'type' => 'text', 'placeholder' => 'Số phòng ngủ', 'value' => $roomnumber));?>
                            </td>
                        </tr>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary">Tìm <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </div>
        </form>
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
                        $('#district').html('<option disabled selected>Đang tải</option>')
                        $('#ward').html('<option selected>Xã phường</option>')
                    },
                    success: function(string)
                    {
                        $('#district').html(string)
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
                        $('#ward').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#ward').html(string)
                    }
                });
            }
        });
    })
</script>