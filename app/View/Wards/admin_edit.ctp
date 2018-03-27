<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/wards">Phường xã</a>
                </li>
                <li class="active">Thêm</li>
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
                    <div class="col-sm-12">
                        <h1>
                            Sửa thông tin phường xã
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    echo $this->Form->create('Ward', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tên phường xã <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('wardname',
                                array(
                                    'label' => false,
                                    'class' => 'form-control',
                                    'value' => $wards['Ward']['wardname']
                                ));?>
                            <?php echo $this->Form->input('id', array('label' => false, 'class' => 'form-control', 'value' => $wards['Ward']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Link <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('wardlink', array('label' => false, 'class' => 'form-control', 'value' => $wards['Ward']['wardlink']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Loại <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('wardtype', array('label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => array('Xã' => 'Xã', 'Phường' => 'Phường', 'Thị Trấn' => 'Thị Trấn'), 'default' => $wards['Ward']['wardtype']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tỉnh thành <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('province', array('id' => 'province', 'label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành -- ', 'default' => $wards['Province']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Quận huyện <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('district_id', array('id' => 'district', 'type' => 'select', 'label' => false, 'options' => $districts, 'class' => 'form-control', 'empty' => ' -- Chọn quận huyện -- ', 'default' => $wards['District']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Kinh độ <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('longitude', array('id' => 'longitude', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $wards['Ward']['longitude']));?>
                        </div>
                        <div class="col-sm-8 col-sm-offset-4 col-xs-12">
                            <div class="div-hint">
                                Hoặc kéo vị trí trên bản đồ
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Vĩ độ <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('latitude', array('id' => 'latitude', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $wards['Ward']['latitude']));?>
                        </div>
                        <div class="col-sm-8 col-sm-offset-4 col-xs-12">
                            <div class="div-hint">
                                Hoặc kéo vị trí trên bản đồ
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Vị trí <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-8">
                            <div id="map" style="width: 100%; height: 350px"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <input type="hidden" name="redirect_url" value="<?php echo isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: '';?>">
                            <button class="btn btn-xs btn-warning">Save <i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    var uluru = {
        lat: <?php echo ($wards['Ward']['latitude']) > 0? $wards['Ward']['latitude']: 10.0328;?>,
        lng: <?php echo ($wards['Ward']['longitude']) > 0? $wards['Ward']['longitude']: 105.7793;?>,
    };
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });
        marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function(evt){
            document.getElementById('latitude').value = evt.latLng.lat().toFixed(4);
            document.getElementById('longitude').value = evt.latLng.lng().toFixed(4);
        });

        google.maps.event.addListener(marker, 'dragstart', function(evt){
            document.getElementById('longitude').value = '';
            document.getElementById('latitude').value = '';
        });

    }
    $(function () {
        $('#province').change(function(){
            var province_id = $(this).val();
            if(province_id != '')
            {
                $.ajax({
                    url: '/districts/get_district',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        province_id: province_id
                    },
                    success: function (st) {
                        $('#district').html(st)
                    }
                })
            }
        });
        $('#li-ward').addClass('active');
    })
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w&callback=initMap">
</script>