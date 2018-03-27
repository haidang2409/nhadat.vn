//products/add
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
//            map.setCenter(this.getPosition()); // Set map center to marker position
       });

       google.maps.event.addListener(marker, 'dragstart', function(evt){
           document.getElementById('longitude').value = '';
           document.getElementById('latitude').value = '';
       });

   }

$('#id-input-file-3').ace_file_input({
    style: 'well',
    btn_choose: 'Click để chọn hình ảnh. Mỗi hình ảnh dung lượng không quá 2Mb',
    btn_change: null,
    no_icon: 'ace-icon fa fa-image',
    droppable: true,
    thumbnail: 'large',//large | fit
    maxSize: 2000000, //~100 KB
    allowExt:  ['jpg', 'jpeg', 'png', 'PNG', 'JPG'],
    allowMime: ['image/jpg', 'image/jpeg', 'image/png'],
    preview_error : function(filename, error_code)
    {
    },
}).on('change', function(){
});
$('#project').select2({
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
            beforeSend: function()
            {
                $('#district').html('<option disabled selected>Đang tải</option>');
                $('#ward').html('<option selected> -- Chọn phường xã -- </option>');
            },
            success: function(string)
            {
                $('#district').html(string)

            }
        });
        $.ajax({
            'url': '/provinces/get_location',
            'type': 'post',
            'dataType': 'html',
            'data': {
                'province_id': province_id
            },
            success: function(data)
            {
                var lnglat = JSON.parse(data);
                $('#longitude').val(lnglat.longitude);
                $('#latitude').val(lnglat.latitude);
                if(lnglat.longitude > 0 && lnglat.latitude > 0)
                {
                    var uluru = {lat: parseFloat(lnglat.latitude), lng: parseFloat(lnglat.longitude)};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: uluru
                    });
                    marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        draggable: true
                    });
                    google.maps.event.addListener(marker, 'dragend', function (evt) {
                        document.getElementById('latitude').value = evt.latLng.lat().toFixed(4);
                        document.getElementById('longitude').value = evt.latLng.lng().toFixed(4);
                    });

                    google.maps.event.addListener(marker, 'dragstart', function (evt) {
                        document.getElementById('longitude').value = '';
                        document.getElementById('latitude').value = '';
                    });
                }
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
            beforeSend: function()
            {
                $('#ward').html('<option disabled selected>Đang tải</option>');
            },
            success: function(string)
            {
                $('#ward').html(string)
            }
        });
        $.ajax({
            'url': '/districts/get_location',
            'type': 'post',
            'dataType': 'html',
            'data': {
                'district_id': district_id
            },
            success: function(data)
            {
                var lnglat = JSON.parse(data);
                $('#longitude').val(lnglat.latitude);
                $('#latitude').val(lnglat.longitude);
                if(lnglat.longitude > 0 && lnglat.latitude > 0)
                {
                    var uluru = {lat: parseFloat(lnglat.longitude), lng: parseFloat(lnglat.latitude)};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: uluru
                    });
                    marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        draggable: true
                    });
                    google.maps.event.addListener(marker, 'dragend', function (evt) {
                        document.getElementById('latitude').value = evt.latLng.lat().toFixed(4);
                        document.getElementById('longitude').value = evt.latLng.lng().toFixed(4);
                    });

                    google.maps.event.addListener(marker, 'dragstart', function (evt) {
                        document.getElementById('longitude').value = '';
                        document.getElementById('latitude').value = '';
                    });
                }
            }
        });
    }
});
$('#ward').change(function () {
    var ward_id = $('#ward').val();
    if(ward_id != '')
    {
        $.ajax({
            'url': '/wards/get_location',
            'type': 'post',
            'dataType': 'html',
            'data': {
                'ward_id': ward_id
            },
            success: function(data)
            {
                var lnglat = JSON.parse(data);
                $('#longitude').val(lnglat.longitude);
                $('#latitude').val(lnglat.latitude);
                if(lnglat.longitude > 0 && lnglat.latitude > 0)
                {
                    var uluru = {lat: parseFloat(lnglat.latitude), lng: parseFloat(lnglat.longitude)};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 16,
                        center: uluru
                    });
                    marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        draggable: true
                    });
                    google.maps.event.addListener(marker, 'dragend', function (evt) {
                        document.getElementById('latitude').value = evt.latLng.lat().toFixed(4);
                        document.getElementById('longitude').value = evt.latLng.lng().toFixed(4);
                    });

                    google.maps.event.addListener(marker, 'dragstart', function (evt) {
                        document.getElementById('longitude').value = '';
                        document.getElementById('latitude').value = '';
                    });
                }
            }
        });
    }
});
$('#groupproduct').change(function () {
    var groupproduct_id = $('#groupproduct').val();
    if(groupproduct_id != '')
    {
        if(groupproduct_id == 2)
        {
            $('#div-utility').hide();
        }
        else
        {
            $('#div-utility').show();
        }
        $.ajax({
            'url': '/categories/get_category',
            'type': 'post',
            'dataType': 'html',
            'data': {
                'groupproduct_id': groupproduct_id
            },
            beforeSend: function()
            {
                $('#categoryproduct').html('<option disabled selected>Đang tải</option>');
            },
            success: function(string)
            {
                $('#categoryproduct').html(string)

            }
        });
    }
});
$('#chk_price_min_max').click(function(){
    if($('#chk_deal').is(':checked'))
    {
        $('#chk_deal').removeAttr('checked');
    }
    if($('#chk_price_min_max').is(':checked'))
    {
        $('#price_dynamic').empty();
        var html = '<div class="input text"><input name="data[Product][price_min]" id="price_min" class="form-control" placeholder="Min" type="text"/></div><div class="input text"><input name="data[Product][price_max]" id="price_max" class="form-control" placeholder="Max" type="text"/></div><span class="input-group-addon">Triệu</span>';
        $('#price_min_max').html(html);
        $('#chk_deal').prop('disabled', true);
        $('#price_min').focus();
    }
    else
    {
        $('#price_min_max').empty();
        var html = '<div class="input text required"><input name="data[Product][price]" id="price" class="form-control" placeholder="Giá" type="text" required="required"/></div><span class="input-group-addon">Triệu</span>';
        $('#price_dynamic').html(html);
        $('#chk_deal').prop('disabled', false);
        $('#price').focus();
    }
    //
});
$('#chk_deal').click(function(){
    if($('#chk_deal').is(':checked'))
    {
        $('#price').prop('disabled', true);
        $('#price').val('0');
    }
    else
    {
        $('#price').prop('disabled', false);
        $('#price').prop('readonly', false);
        $('#price').focus();

    }
});
$('#chk_acreage_min_max').click(function(){
    if($('#chk_acreage_min_max').is(':checked'))
    {
        $('#div-acreage').empty();
        var html = '<div class="input text"><input name="data[Product][acreage_min]" id="acreage_min" class="form-control" placeholder="Min" type="text"/></div><div class="input text"><input name="data[Product][acreage_max]" id="acreage_min" class="form-control" placeholder="Max" type="text"/></div><span class="input-group-addon">m<sup>2</sup></span>';
        $('#div-acreage-min-max').html(html);
        $('#acreage_min').focus();
    }
    else
    {
        $('#div-acreage-min-max').empty();
        var html = '<div class="input text required"><input name="data[Product][acreage]" id="acreage" class="form-control" type="text" required="required"/></div><span class="input-group-addon">m<sup>2</sup></span>';
        $('#div-acreage').html(html)
        $('#acreage').focus();
    }
});
$('#title').keyup(function(){
    var len = $(this).val().length;
    $('#numchar-title').html(len + '/150')
});
$('#btnSaveProduct').click(function () {
    $('#ProductAddForm').submit();
    $(this).attr('disabled', true);
    $(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>');
});
$(document).on('keyup', '#price', function () {
    var opt_price = $('#opt_price').val();
    var opt_price_label = '';
    if(opt_price == '1')
    {
        opt_price_label = '/m2';
    }
    if(opt_price == '2')
    {
        opt_price_label = '/1000m2';
    }
    if(opt_price == '3')
    {
        opt_price_label = '/tháng';
    }
    if(opt_price == '4')
    {
        opt_price_label = '/m2/tháng';
    }
    var price = $(this).val();
    if(parseFloat(price))
    {
        if(price > 1000)
        {
            var new_price = price/1000;
            $('.label-price').text(new_price + ' Tỷ' + opt_price_label);

        }
        else
        {
            if(price < 1)
            {
                var new_price = price*1000;
                $('.label-price').text(new_price + ' K' + opt_price_label);
            }
            else
            {
                var new_price = price;
                $('.label-price').text(new_price + ' Triệu' + opt_price_label);
            }
        }
    }
    else
    {
        $('.label-price').text('');
    }
});
$('#opt_price').change(function () {
    var opt_price = $(this).val();
    var opt_price_label = '';
    if(opt_price == '1')
    {
        opt_price_label = '/m2';
    }
    if(opt_price == '2')
    {
        opt_price_label = '/1000m2';
    }
    if(opt_price == '3')
    {
        opt_price_label = '/tháng';
    }
    if(opt_price == '4')
    {
        opt_price_label = '/m2/tháng';
    }
    var price = $('#price').val();
    if(parseFloat(price))
    {
        if(price > 1000)
        {
            var new_price = price/1000;
            $('.label-price').text(new_price + ' Tỷ' + opt_price_label);

        }
        else
        {
            if(price < 1)
            {
                var new_price = price*1000;
                $('.label-price').text(new_price + ' K' + opt_price_label);
            }
            else
            {
                var new_price = price;
                $('.label-price').text(new_price + ' Triệu' + opt_price_label);
            }
        }
    }
    else
    {
        $('.label-price').text('');
    }
});


