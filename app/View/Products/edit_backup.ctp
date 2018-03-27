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
                        echo $this->Form->create('Product', array('class' => 'form-horizontal', 'novalidate' => true, 'enctype' => 'multipart/form-data'))
                        ?>
                        <!--                                    Type-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Hình thức giao dịch <font class="label-require">(*)</font></label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="1" <?php if($product['Product']['transactiontype_id'] == 1){ echo 'checked';}?>>
                                        <span class="lbl"> Bán </span>
                                    </label>
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="2" <?php if($product['Product']['transactiontype_id'] == 2){ echo 'checked';}?>>
                                        <span class="lbl"> Cho thuê </span>
                                    </label>
                                    <span style="display: inline-block">&nbsp;&nbsp;&nbsp;<a href="/dang-tin-can-mua-can-thue">Cần mua hoặc cần thuê</a></span>
                                </div>
                            </div>
                        </div>
                        <!--                                    Category-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Chọn loại bất động sản <font class="label-require">(*)</font></label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('groupproduct', array('id' => 'groupproduct', 'type' => 'select', 'options' => $groups, 'label' => false, 'empty' => ' -- Chọn loại bất động sản -- ', 'style' => 'width: 100% !important', 'default' => $product['Group']['id']));
                                echo $this->Form->input('id', array('id' => 'id', 'type' => 'hidden', 'label' => false, 'value' => $product['Product']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('categoryproduct_id', array('id' => 'categoryproduct', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phân loại -- ', 'options' => $categories, 'style' => 'width: 100% !important', 'default' => $product['Product']['categoryproduct_id']))
                                ?>
                            </div>
                        </div>
                        <!--                                    Location-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Vị trí bất động sản <font class="label-require">(*)</font></label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'options' => $provinces, 'label' => false, 'empty' => ' -- Chọn tỉnh thành -- ', 'style' => 'width: 100% !important', 'default' => $product['Province']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('district', array('id' => 'district', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn quận huyện -- ', 'options' => $districts, 'style' => 'width: 100% !important', 'default' => $product['District']['id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('ward_id', array('id' => 'ward', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phường xã -- ', 'options' => $wards, 'style' => 'width: 100% !important', 'default' => $product['Product']['ward_id']))
                                ?>
                            </div>
                        </div>
                        <!--                                    Address-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Địa chỉ <font class="label-require">(*)</font></label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('address', array('id' => 'address', 'label' => false, 'class' => 'form-control', 'value' => $product['Product']['address']))
                                ?>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                <div class="div-hint">
                                    Nhập đầy đủ địa chỉ số nhà, tên đường, ... để tăng độ chính xác và được nhiều người quan tâm
                                </div>
                            </div>
                        </div>
                        <!--                                    project-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Thuộc dự án
                            </label>
                            <div class="col-sm-6 col-xs-12">
                                <?php
                                echo $this->Form->input('project_id', array('id' => 'project', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn dự án -- ', 'style' => 'width: 100% !important',  'default' => $product['Product']['project_id']))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12 div-hint">
                                Nếu bất động sản của bạn thuộc dự án
                            </div>
                        </div>
                        <!--                                    Map-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Vị trí trên bản đồ</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('longitude', array('id' => 'longitude', 'label' => false, 'type' => 'hidden', 'value' => $product['Product']['longitude']));
                                echo $this->Form->input('latitude', array('id' => 'latitude', 'label' => false, 'type' => 'hidden', 'value' => $product['Product']['latitude']));
                                ?>
                                <div id="map"></div>
                                <div class="div-hint">
                                    Kéo con trỏ màu đỏ đến vị trí bất động sản của bạn
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
                                echo $this->Form->input('title', array('id' => 'title', 'label' => false, 'class' => 'form-control', 'value' => $product['Product']['title']))
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
                                echo $this->Form->input('summary', array('id' => 'summary', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '2', 'default' => $product['Product']['summary']))
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
                                echo $this->Form->input('description', array('id' => 'description', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '8', 'escape' => true,  'value' => $product['Product']['description']))
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
                                echo $this->Form->input('fullname', array('id' => 'fullname', 'label' => false, 'class' => 'form-control', 'value' => $product['Product']['fullname']))
                                ?>
                            </div>
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Số điện thoại liên hệ <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('phonenumber', array('id' => 'phonenumber', 'label' => false, 'class' => 'form-control',  'value' => $product['Product']['phonenumber']))
                                ?>
                            </div>
                        </div>

                        <div id="div-houseorland">
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
                                    <?php if($product['Product']['price'] > 0 && $product['Product']['price2'] > $product['Product']['price']):?>
                                        <div class="input-group" id="price_min_max">
                                            <?php
                                            $pri_minmax = true;
                                            echo $this->Form->input('price_min', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min', 'value' => $product['Product']['price']));
                                            echo $this->Form->input('price_max', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max', 'value' => $product['Product']['price2']));
                                            ?>
                                            <span class="input-group-addon">
                                            Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_dynamic"></div>
                                    <?php elseif($product['Product']['price'] == 0):?>
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
                                            echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Giá', 'value' => $product['Product']['price']));
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
                                        <?php if($product['Product']['acreage2'] == 0 || $product['Product']['acreage'] == 0 || ($product['Product']['acreage2'] <= $product['Product']['acreage'])):?>
                                            <?php
                                            echo $this->Form->input('acreage', array('id' => 'acreage', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['acreage']))
                                            ?>
                                            <span class="input-group-addon">
                                            m<sup>2</sup>
                                        </span>
                                        <?php endif;?>
                                    </div>

                                    <!--                                                Khoảng dien tich-->
                                    <div class="input-group" id="div-acreage-min-max">
                                        <?php if($product['Product']['acreage'] > 0 && $product['Product']['acreage2'] > $product['Product']['acreage']):?>
                                            <?php
                                            $acr_minmax = true;
                                            echo $this->Form->input('acreage_min', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min', 'value' => $product['Product']['acreage']));
                                            echo $this->Form->input('acreage_max', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max', 'value' => $product['Product']['acreage2']));
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
                                <!--                                            Price-->
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Hướng
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('direction_id', array('id' => 'direction', 'label' => false, 'class' => 'form-control', 'type' => 'select', 'style' => 'width: 100% !important', 'empty' => ' -- Chọn hướng -- ', 'options' => $directions,  'default' => $product['Product']['direction_id']))
                                    ?>
                                </div>
                                <!--                                            acreage-->
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Đường trước nhà
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('road', array('id' => 'acreage', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['road']))
                                        ?>
                                        <span class="input-group-addon">
                                            m
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--                                        Length width-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Chiều dài
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('length', array('id' => 'length', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['length']))
                                        ?>
                                        <span class="input-group-addon">
                                            m
                                        </span>
                                    </div>
                                </div>
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Chiều rộng
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('width', array('id' => 'width', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['width']))
                                        ?>
                                        <span class="input-group-addon">
                                        m
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <!--                                        Room-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Số tầng
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('floornumber', array('id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['floornumber']))
                                    ?>
                                </div>
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Số phòng ngủ
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('roomnumber', array('id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['roomnumber']))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Số toilet
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('toiletnumber', array('id' => 'toiletnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['toiletnumber']))
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--                                    Hình ảnh-->
                        <div id="div-hinhanh">
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Hình ảnh bất động sản
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <label class="ace-file-input ace-file-multiple">
                                        <?php
                                        echo $this->Form->input('Imagesproduct.imagelink. ', array('id' => 'id-input-file-3', 'type' => 'file', 'multiple' => true, 'label' => false, 'div' => false));
                                        ?>
                                    </label>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                    <div class="row" style="margin-top: 10px">
                                    <?php
                                    for($i = 0; $i < count($images); $i++)
                                    {
                                        ?>
                                        <div class="div-image-<?php echo $images[$i]['Image']['id'];?> col-sm-3" style="margin-bottom: 10px;">
                                            <div class="div-image-remove"
                                                style="
                                                    background: url('/uploads/products/thumb/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink']?>');
                                                    background-size: cover;
                                                    background-position: center center;
                                                    height: 120px;
                                                    text-align: right">
                                                <button class="btn-delete-image" data-image_id="<?php echo $images[$i]['Image']['id'];?>" type="button">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function () {
                                $('#id-input-file-3').ace_file_input({
                                    style: 'well',
                                    btn_choose: 'Click để chọn hình ảnh. Mỗi hình ảnh dung lượng không quá 2Mb',
                                    btn_change: null,
                                    no_icon: 'ace-icon fa fa-image',
                                    droppable: true,
                                    thumbnail: 'large',//large | fit
                                    maxSize: 2000000, //~100 KB
                                    allowExt:  ['jpg', 'jpeg', 'png', 'PNG', 'JPG'],
                                    allowMime: ['image/jpg', 'image/jpeg', 'image/png'], //html5 browsers only
                                    preview_error : function(filename, error_code)
                                    {
                                    },

                                }).on('change', function(){
                                    //console.log($(this).data('ace_input_files'));
                                    //console.log($(this).data('ace_input_method'));
                                });
                            })
                        </script>
                        <!--                                    End hinh ảnh-->
                        <!--                                    Utility-->
                        <div id="div-utility">
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Tiện ích bất động sản
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.lake', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['lake']))
                                                    ?>
                                                    <span class="lbl"> Hồ bơi</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.garden', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['garden']))
                                                    ?>
                                                    <span class="lbl"> Sân vườn</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.balcony', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['balcony']))
                                                    ?>
                                                    <span class="lbl"> Ban công/sân thượng</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.furniture', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['furniture']))
                                                    ?>
                                                    <span class="lbl"> Đầy đủ nội thất</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.airconditioner', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['airconditioner']))
                                                    ?>
                                                    <span class="lbl"> Máy điều hòa</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.internet', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['internet']))
                                                    ?>
                                                    <span class="lbl"> Internet</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.firealarm', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['firealarm']))
                                                    ?>
                                                    <span class="lbl"> Báo cháy</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.gymroom', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['gymroom']))
                                                    ?>
                                                    <span class="lbl"> Phòng tập gym</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.carparking', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $utility['Utility']['carparking']))
                                                    ?>
                                                    <span class="lbl"> Chỗ đỗ xe hơi</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!--                                    Environment-->
                        <div id="div-environment">
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Môi trường xung quanh
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.supermarket', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['supermarket']))
                                                    ?>
                                                    <span class="lbl"> Gần siêu thị</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.hospital', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['hospital']))
                                                    ?>
                                                    <span class="lbl"> Gần bệnh viện</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.school', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['school']))
                                                    ?>
                                                    <span class="lbl"> Gần trường học</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.park', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['park']))
                                                    ?>
                                                    <span class="lbl"> Gần công viên</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.public_traffic', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['public_traffic']))
                                                    ?>
                                                    <span class="lbl"> Giao thông công cộng</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.security', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['security']))
                                                    ?>
                                                    <span class="lbl"> Khu an ninh</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.river', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['river']))
                                                    ?>
                                                    <span class="lbl"> Gần sông</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.sea', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['sea']))
                                                    ?>
                                                    <span class="lbl"> Gần biển</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.temple', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['temple']))
                                                    ?>
                                                    <span class="lbl"> Gần chùa</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.church', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $environment['Environment']['church']))
                                                    ?>
                                                    <span class="lbl"> Gần nhà thờ</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <hr>
                            <button class="btn btn-white" type="reset"> <i class="fa fa-refresh"></i> Nhập lại</button>
                            <button class="btn btn-primary" type="button" id="btnEditProduct">Tiếp tục <i class="fa fa-arrow-right"></i> </button>
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

<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<?php echo $this->Html->script('select2.min');?>
<!--Maps-->
<script>
    var lng = <?php echo $product['Product']['longitude'];?>;
    var lat = <?php echo $product['Product']['latitude'];?>;
    var uluru = {lng: <?php echo $product['Product']['longitude'];?>, lat: <?php echo $product['Product']['latitude'];?>};
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
            document.getElementById('latitude').value = evt.latLng.lat().toFixed(3);
            document.getElementById('longitude').value = evt.latLng.lng().toFixed(3);
        });

        google.maps.event.addListener(marker, 'dragstart', function(evt){
            document.getElementById('longitude').value = '';
            document.getElementById('latitude').value = '';
        });

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w&callback=initMap">
</script>
<script>
    $(function () {
        $('#project').select2({
            minimumResultsForSearch: -1
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
                        $('#district').html(string);

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
                                document.getElementById('latitude').value = evt.latLng.lat().toFixed(3);
                                document.getElementById('longitude').value = evt.latLng.lng().toFixed(3);
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
        })
        $('.btn-delete-image').on('click', function(){
            var image_id = $(this).data('image_id');
            if(image_id != '')
            {
                $.ajax({
                    url: '/products/delete_image',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'image_id': image_id
                    },
                    success: function(st)
                    {
                        if(st == 'success')
                        {
                            $('.div-image-' + image_id).remove();
                        }
                    }
                });
            }
        });
        $('#btnEditProduct').click(function () {
            $('#ProductEditForm').submit();
            $(this).attr('disabled', true);
            $(this).html('Đang luu <i class="fa fa-spin fa-spinner"></i>')
        })
    })
</script>