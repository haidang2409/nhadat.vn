<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
                    <ul class="steps" style="margin-left: 0">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Nhập thông tin</span>
                        </li>
                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Chọn dịch vụ và thanh toán</span>
                        </li>
                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Hoàn thành</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
                        <?php
                        echo $this->Session->flash();
                        ?>
                        <?php
                        echo $this->Form->create('Product', array('class' => 'form-horizontal', 'novalidate' => true, 'type' => 'file'))
                        ?>
        <!--                                    Type-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Hình thức giao dịch <font class="label-require">(*)</font></label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                $type = $products['Product']['transactiontype_id'];
                                ?>
                                <div class="radio">
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="3" <?php if($type == 3 || $type == 0){ echo 'checked';}?>>
                                        <span class="lbl"> Cần mua </span>
                                    </label>
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="4" <?php if($type == 4){ echo 'checked';}?>>
                                        <span class="lbl"> Cần thuê </span>
                                    </label>
                                </div>
                            </div>
                        </div>
        <!--                                    Category-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Chọn loại bất động sản <font class="label-require">(*)</font></label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('groupproduct', array('id' => 'groupproduct', 'type' => 'select', 'options' => $groups, 'label' => false, 'empty' => ' -- Chọn loại bất động sản -- ', 'style' => 'width: 100% !important', 'value' => $products['Group']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('categoryproduct_id', array('id' => 'categoryproduct', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phân loại -- ', 'options' => $categories, 'style' => 'width: 100% !important', 'default' => $products['Category']['id']))
                                ?>
                            </div>
                        </div>
        <!--                                    Location-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Vị trí bất động sản <font class="label-require">(*)</font></label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'options' => $provinces, 'label' => false, 'empty' => ' -- Chọn tỉnh thành -- ', 'style' => 'width: 100% !important', 'default' => $products['Province']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('district', array('id' => 'district', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn quận huyện -- ', 'options' => $districts, 'style' => 'width: 100% !important', 'default' => $products['District']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('ward_id', array('id' => 'ward', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phường xã -- ', 'options' => $wards, 'style' => 'width: 100% !important', 'default' => $products['Ward']['id']))
                                ?>
                            </div>
                        </div>
        <!--                                    Address-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Địa chỉ <font class="label-require">(*)</font></label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('address', array('id' => 'address', 'label' => false, 'class' => 'form-control', 'value' => $products['Product']['address']))
                                ?>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                <div class="div-hint">
                                    Nhập tên đường, địa danh nơi bạn cần mua hoặc thuê
                                </div>
                            </div>
                        </div>
        <!--                                   Tiêu đề-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Tiêu đề tin đăng
                                <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('title', array('id' => 'title', 'label' => false, 'class' => 'form-control', 'value' => $products['Product']['title']));
                                echo $this->Form->input('id', array('id' => 'id', 'label' => false, 'class' => 'form-control', 'value' => $products['Product']['id']))
                                ?>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                <div class="div-hint">
                                    Tiêu đề ít nhất 20 ký tự và không quá 150 ký tự để được hiển thị tốt hơn <span id="numchar-title">0/150</span>
                                </div>
                            </div>
                        </div>
                        <!--                                    Des-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Tóm tắt
                            </label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('summary', array('id' => 'summary', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '2', 'value' => $products['Product']['summary']))
                                ?>
                            </div>
                        </div>
        <!--                                    Des-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Mô tả chi tiết <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('description', array('id' => 'description', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '8', 'escape' => true, 'value' => $products['Product']['description']))
                                ?>
                            </div>
                        </div>
        <!--                                    SDT-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Người liên hệ <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('fullname', array('id' => 'fullname', 'label' => false, 'class' => 'form-control', 'value' => $products['Product']['fullname']))
                                ?>
                            </div>
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Số điện thoại liên hệ <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('phonenumber', array('id' => 'phonenumber', 'label' => false, 'class' => 'form-control', 'value' => $products['Product']['phonenumber']))
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
        <!--                                            Price-->
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Giá <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    $pri_minmax = false;
                                    $pri_deal = false;
                                    ?>
                                    <?php if($products['Product']['price'] > 0 && $products['Product']['price2'] > $products['Product']['price']):?>
                                        <div class="input-group" id="price_min_max">
                                            <?php
                                            $pri_minmax = true;
                                            echo $this->Form->input('price_min', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min', 'value' => $products['Product']['price']));
                                            echo $this->Form->input('price_max', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max', 'value' => $products['Product']['price2']));
                                            ?>
                                            <span class="input-group-addon">
                                            Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_dynamic"></div>
                                    <?php elseif($products['Product']['price'] == 0):?>
                                        <div class="input-group" id="price_dynamic">
                                            <?php
                                            $pri_deal = true;
                                            echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => '0', 'readonly' => true, 'value' => '0'));
                                            ?>
                                            <span class="input-group-addon">
                                            Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_min_max"></div>
                                    <?php else:?>
                                        <div class="input-group" id="price_dynamic">
                                            <?php
                                            echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Giá', 'value' => $products['Product']['price']));
                                            ?>
                                            <span class="input-group-addon">
                                            Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_min_max"></div>
                                    <?php endif;?>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Product.pricedeal', array('id' => 'chk_deal', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'disabled' => $pri_minmax, 'checked' => $pri_deal))
                                                    ?>
                                                    <span class="lbl"> Thỏa thuận</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Product.priceminmax', array('id' => 'chk_price_min_max', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $pri_minmax))
                                                    ?>
                                                    <span class="lbl"> Khoảng giá</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        <!--                                            acreage-->

                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Diện tích <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group" id="div-acreage">
                                        <?php $acr_minmax = false;?>
                                        <?php if($products['Product']['acreage2'] == 0 || $products['Product']['acreage'] == 0 || ($products['Product']['acreage2'] <= $products['Product']['acreage'])):?>
                                            <?php
                                            echo $this->Form->input('acreage', array('id' => 'acreage', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $products['Product']['acreage']))
                                            ?>
                                            <span class="input-group-addon">
                                            m<sup>2</sup>
                                        </span>
                                        <?php endif;?>
                                    </div>

        <!--                                                Khoảng dien tich-->
                                    <div class="input-group" id="div-acreage-min-max">
                                        <?php if($products['Product']['acreage'] > 0 && $products['Product']['acreage2'] > $products['Product']['acreage']):?>
                                            <?php
                                            $acr_minmax = true;
                                            echo $this->Form->input('acreage_min', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min', 'value' => $products['Product']['acreage']));
                                            echo $this->Form->input('acreage_max', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max', 'value' => $products['Product']['acreage2']));
                                            ?>
                                            <span class="input-group-addon">
                                                m<sup>2</sup>
                                            </span>
                                        <?php endif;?>
                                    </div>
        <!--                                                End khoảng dien tich-->
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Product.acreage_minmax', array('id' => 'chk_acreage_min_max', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $acr_minmax))
                                                    ?>
                                                    <span class="lbl"> Khoảng diện tích</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Hình ảnh
                            </label>
                            <div class="col-sm-9 col-xs-12">
                                <label class="ace-file-input ace-file-multiple">
                                    <?php
                                    echo $this->Form->input('imagelink. ', array('id' => 'id-input-file-3', 'type' => 'file', 'multiple' => false, 'label' => false, 'div' => false));
                                    echo $this->Form->input('image_old', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $products['Product']['image']));
                                    ?>
                                </label>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                <div class="div-hint">
                                    Để trống nếu không thay đổi, nếu chọn ảnh mới, ảnh cũ sẽ bị xóa
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <hr>
                            <button class="btn btn-white" type="reset"> <i class="fa fa-refresh"></i> Nhập lại</button>
                            <button class="btn btn-primary" type="button" id="btnEditCanMuaCanThue">Tiếp tục <i class="fa fa-arrow-right"></i> </button>
                        </div>
        <!--                                    End div houseorland-->
                        <?php
                        echo $this->Form->end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Html->script('select2.min');?>
<!--Maps-->
<script>
    $(function () {
        $(function () {
            $('#id-input-file-3').ace_file_input({
                style: 'well',
                btn_choose: 'Chỉ chọn được 1 hình ảnh không quá 2Mb',
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
        })
        $('#groupproduct').change(function () {
            var groupproduct_id = $('#groupproduct').val();
            if(groupproduct_id != '')
            {
                if(groupproduct_id == 2)
                {
                    $('#div-utility').hide();
                }
                else
                    $('#div-utility').show();
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
        $('#btnEditCanMuaCanThue').click(function () {
            $('#ProductEditCanMuaCanThueForm').submit();
            $(this).attr('disabled', true);
            $(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>');
        })
    })
</script>