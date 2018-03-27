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
                                    <?php
                                    $type = isset($this->request->data['Product']['transactiontype_id'])? $this->request->data['Product']['transactiontype_id']: 0;
                                    ?>
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="1" <?php if($type == 1 || $type == 0){ echo 'checked';}?>>
                                        <span class="lbl"> Bán </span>
                                    </label>
                                    <label>
                                        <input name="data[Product][transactiontype_id]" class="ace" type="radio" value="2" <?php if($type == 2){ echo 'checked';}?>>
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
                                echo $this->Form->input('groupproduct', array('id' => 'groupproduct', 'type' => 'select', 'options' => $groups, 'label' => false, 'empty' => ' -- Chọn loại bất động sản -- ', 'style' => 'width: 100% !important'))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('categoryproduct_id', array('id' => 'categoryproduct', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phân loại -- ', 'options' => $categories, 'style' => 'width: 100% !important'))
                                ?>
                            </div>
                        </div>
                        <!--                                    Location-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Vị trí bất động sản <font class="label-require">(*)</font></label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'options' => $provinces, 'label' => false, 'empty' => ' -- Chọn tỉnh thành -- ', 'style' => 'width: 100% !important'))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('district', array('id' => 'district', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn quận huyện -- ', 'options' => $districts, 'style' => 'width: 100% !important'))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                echo $this->Form->input('ward_id', array('id' => 'ward', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn phường xã -- ', 'options' => $wards, 'style' => 'width: 100% !important'))
                                ?>
                            </div>
                        </div>
                        <!--                                    Address-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Địa chỉ</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('address', array('id' => 'address', 'label' => false, 'class' => 'form-control', 'placeholder' => 'VD: "Số 86, đường Mạc Thiên Tích" hoặc "Đường số .. KDC 91B", .... '))
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
                                echo $this->Form->input('project_id', array('id' => 'project', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn dự án -- ', 'style' => 'width: 100% !important', 'options' => $projects))
                                ?>
                            </div>
                            <div class="col-sm-3 col-xs-12 div-hint">
                                Nếu bất động sản của bạn trong dự án
                            </div>
                        </div>
                        <!--                                    Map-->
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">Vị trí trên bản đồ</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php
                                echo $this->Form->input('longitude', array('id' => 'longitude', 'label' => false, 'type' => 'hidden'));
                                echo $this->Form->input('latitude', array('id' => 'latitude', 'label' => false, 'type' => 'hidden'));
                                ?>
                                <div id="map-container">
                                    <div id="map"></div>
                                    <div class="div-hint">
                                        Kéo con trỏ màu đỏ đến vị trí bất động sản của bạn
                                    </div>
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
                                echo $this->Form->input('title', array('id' => 'title', 'label' => false, 'class' => 'form-control'))
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
                                echo $this->Form->input('summary', array('id' => 'summary', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '2'))
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
                                echo $this->Form->input('description', array('id' => 'description', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '8', 'escape' => true))
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
                                $fullname = isset($this->request->data['Product']['fullname'])? $this->request->data['Product']['fullname']: $member['Member']['fullname'];
                                echo $this->Form->input('fullname', array('id' => 'fullname', 'label' => false, 'class' => 'form-control', 'value' => $fullname))
                                ?>
                            </div>
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Số điện thoại <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                $phonenumber = isset($this->request->data['Product']['phonenumber'])? $this->request->data['Product']['phonenumber']: $member['Member']['phonenumber'];
                                echo $this->Form->input('phonenumber', array('id' => 'phonenumber', 'label' => false, 'class' => 'form-control', 'value' => $phonenumber))
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Email
                            </label>
                            <div class="col-sm-3 col-xs-12">
                                <?php
                                $email = isset($this->request->data['Product']['email'])? $this->request->data['Product']['email']: $member['Member']['email'];
                                echo $this->Form->input('email', array('id' => 'email', 'label' => false, 'class' => 'form-control', 'value' => $email))
                                ?>
                            </div>
                        </div>
                        <div id="div-houseorland">
                            <!--                            Price-->
                            <div class="form-group">
                                <!--                                            Price-->
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Giá <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php $pri_minmax = false;?>
                                    <?php if(isset($this->request->data['Product']['priceminmax']) && $this->request->data['Product']['priceminmax'] == 1):?>
                                        <div class="input-group" id="price_min_max">
                                            <?php
                                            $pri_minmax = true;
                                            echo $this->Form->input('price_min', array('id' => 'price_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min'));
                                            echo $this->Form->input('price_max', array('id' => 'price_max', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max'));
                                            ?>
                                            <span class="input-group-addon">
                                                Triệu
                                                </span>
                                        </div>
                                        <div class="input-group" id="price_dynamic"></div>
                                    <?php elseif(isset($this->request->data['Product']['pricedeal']) && $this->request->data['Product']['pricedeal'] == 1):?>
                                        <div class="input-group" id="price_dynamic">
                                            <?php
                                            echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => '0', 'readonly' => true));
                                            ?>
                                            <span class="input-group-addon">
                                            Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_min_max"></div>
                                    <?php else:?>
                                        <div class="input-group" id="price_dynamic">
                                            <?php
                                            echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Giá', 'autocomplete' => 'off'));
                                            ?>
                                            <span class="input-group-addon">
                                                Triệu
                                            </span>
                                        </div>
                                        <div class="input-group" id="price_min_max"></div>
                                    <?php endif;?>
                                    <span class="label-price"></span>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <?php
                                            $opt_price = array(
                                                '1' => '/m2',
                                                '2' => '/1000m2',
                                                '3' => '/tháng',
                                                '4' => '/m2/tháng'
                                            );
                                            echo $this->Form->input('opt_price', array('id' => 'opt_price', 'label' => false, 'class' => 'form-control', 'type' => 'select', 'style' => 'width: 100% !important', 'empty' => ' -- Tùy chọn giá -- ', 'options' => $opt_price))
                                            ?>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Product.pricedeal', array('id' => 'chk_deal', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'disabled' => $pri_minmax))
                                                    ?>
                                                    <span class="lbl"> Thỏa thuận</span>
                                                </label>
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Product.priceminmax', array('id' => 'chk_price_min_max', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Khoảng giá</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--                            Acreage-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Diện tích <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group" id="div-acreage">
                                        <?php if(!isset($this->request->data['Product']['acreage_minmax']) || (isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] != 1)):?>
                                            <?php
                                            echo $this->Form->input('acreage', array('id' => 'acreage', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                            ?>
                                            <span class="input-group-addon">
                                            m<sup>2</sup>
                                        </span>
                                        <?php endif;?>
                                    </div>
                                    <!--                                                Khoảng dien tich-->
                                    <div class="input-group" id="div-acreage-min-max">
                                        <?php if(isset($this->request->data['Product']['acreage_minmax']) && $this->request->data['Product']['acreage_minmax'] == 1):?>
                                            <?php
                                            echo $this->Form->input('acreage_min', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Min'));
                                            echo $this->Form->input('acreage_max', array('id' => 'acreage_min', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Max'));
                                            ?>
                                            <span class="input-group-addon">
                                                m<sup>2</sup>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                    <!--                                                End khoảng dien tich-->
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <?php
                                            echo $this->Form->input('Product.acreage_minmax', array('id' => 'chk_acreage_min_max', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                            ?>
                                            <span class="lbl"> Khoảng diện tích</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--                            Option-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Hướng
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('direction_id', array('id' => 'direction', 'label' => false, 'class' => 'form-control', 'type' => 'select', 'style' => 'width: 100% !important', 'empty' => ' -- Chọn hướng -- ', 'options' => $directions))
                                    ?>
                                </div>
                                <!--                                            acreage-->
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Đường trước nhà
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('road', array('id' => 'acreage', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
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
                                    Chiều rộng
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('width', array('id' => 'width', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                        ?>
                                        <span class="input-group-addon">
                                        m
                                    </span>
                                    </div>
                                </div>
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Chiều dài
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('length', array('id' => 'length', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
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
                                    echo $this->Form->input('floornumber', array('id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                    ?>
                                </div>
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Số phòng ngủ
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('roomnumber', array('id' => 'roomnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Số toilet
                                </label>
                                <div class="col-sm-3 col-xs-12">
                                    <?php
                                    echo $this->Form->input('toiletnumber', array('id' => 'toiletnumber', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                    ?>
                                </div>
                            </div>
                            <!--                            Option-->
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
                            </div>
                        </div>
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
                                                    echo $this->Form->input('Utility.lake', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Hồ bơi</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.garden', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Sân vườn</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.balcony', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Ban công/sân thượng</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.furniture', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Đầy đủ nội thất</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.airconditioner', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Máy điều hòa</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.internet', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Internet</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.firealarm', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Báo cháy</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.gymroom', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Phòng tập gym</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Utility.carparking', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
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
                                                    echo $this->Form->input('Environment.supermarket', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần chợ/siêu thị</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.hospital', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần bệnh viện</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.school', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần trường học</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.park', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần công viên</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.public_traffic', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Giao thông công cộng</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.security', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Khu an ninh</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.river', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần sông</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.sea', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần biển</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.temple', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
                                                    ?>
                                                    <span class="lbl"> Gần chùa</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    <?php
                                                    echo $this->Form->input('Environment.church', array('type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1))
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
                            <button class="btn btn-primary" type="button" id="btnSaveProduct">Tiếp tục <i class="fa fa-arrow-right"></i> </button>
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
    var uluru = {
        lat: <?php echo (isset($this->request->data['Product']['latitude']) && $this->request->data['Product']['latitude'] != '')? $this->request->data['Product']['latitude']: 10.0314;?>,
        lng: <?php echo (isset($this->request->data['Product']['longitude']) && $this->request->data['Product']['longitude'] != '')? $this->request->data['Product']['longitude']: 105.782;?>
    };
    function initMap(){var e=new google.maps.Map(document.getElementById("map"),{zoom:12,center:uluru});marker=new google.maps.Marker({position:uluru,map:e,draggable:!0}),google.maps.event.addListener(marker,"dragend",function(e){document.getElementById("latitude").value=e.latLng.lat().toFixed(4),document.getElementById("longitude").value=e.latLng.lng().toFixed(4)}),google.maps.event.addListener(marker,"dragstart",function(e){document.getElementById("longitude").value="",document.getElementById("latitude").value=""})}
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w&callback=initMap">
</script>
<script>
    $(function () {
        $("#id-input-file-3").ace_file_input({style:"well",btn_choose:"Click để chọn hình ảnh. Mỗi hình ảnh dung lượng không quá 2Mb",btn_change:null,no_icon:"ace-icon fa fa-image",droppable:!0,thumbnail:"large",maxSize:2e6,allowExt:["jpg","jpeg","png","PNG","JPG"],allowMime:["image/jpg","image/jpeg","image/png"],preview_error:function(e,t){}}).on("change",function(){}),$("#project").select2({}),$("#province").change(function(){var e=$("#province").val();""!=e&&($.ajax({url:"/districts/get_district",type:"post",dataType:"html",data:{province_id:e},beforeSend:function(){$("#district").html("<option disabled selected>Đang tải</option>"),$("#ward").html("<option selected> -- Chọn phường xã -- </option>")},success:function(e){$("#district").html(e)}}),$.ajax({url:"/provinces/get_location",type:"post",dataType:"html",data:{province_id:e},success:function(e){var t=JSON.parse(e);if($("#longitude").val(t.longitude),$("#latitude").val(t.latitude),t.longitude>0&&t.latitude>0){var a={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},i=new google.maps.Map(document.getElementById("map"),{zoom:15,center:a});marker=new google.maps.Marker({position:a,map:i,draggable:!0}),google.maps.event.addListener(marker,"dragend",function(e){document.getElementById("latitude").value=e.latLng.lat().toFixed(4),document.getElementById("longitude").value=e.latLng.lng().toFixed(4)}),google.maps.event.addListener(marker,"dragstart",function(e){document.getElementById("longitude").value="",document.getElementById("latitude").value=""})}}}))}),$("#district").change(function(){var e=$("#district").val();""!=e&&($.ajax({url:"/wards/get_ward",type:"post",dataType:"html",data:{district_id:e},beforeSend:function(){$("#ward").html("<option disabled selected>Đang tải</option>")},success:function(e){$("#ward").html(e)}}),$.ajax({url:"/districts/get_location",type:"post",dataType:"html",data:{district_id:e},success:function(e){var t=JSON.parse(e);if($("#longitude").val(t.latitude),$("#latitude").val(t.longitude),t.longitude>0&&t.latitude>0){var a={lat:parseFloat(t.longitude),lng:parseFloat(t.latitude)},i=new google.maps.Map(document.getElementById("map"),{zoom:15,center:a});marker=new google.maps.Marker({position:a,map:i,draggable:!0}),google.maps.event.addListener(marker,"dragend",function(e){document.getElementById("latitude").value=e.latLng.lat().toFixed(4),document.getElementById("longitude").value=e.latLng.lng().toFixed(4)}),google.maps.event.addListener(marker,"dragstart",function(e){document.getElementById("longitude").value="",document.getElementById("latitude").value=""})}}}))}),$("#ward").change(function(){var e=$("#ward").val();""!=e&&$.ajax({url:"/wards/get_location",type:"post",dataType:"html",data:{ward_id:e},success:function(e){var t=JSON.parse(e);if($("#longitude").val(t.longitude),$("#latitude").val(t.latitude),t.longitude>0&&t.latitude>0){var a={lat:parseFloat(t.latitude),lng:parseFloat(t.longitude)},i=new google.maps.Map(document.getElementById("map"),{zoom:16,center:a});marker=new google.maps.Marker({position:a,map:i,draggable:!0}),google.maps.event.addListener(marker,"dragend",function(e){document.getElementById("latitude").value=e.latLng.lat().toFixed(4),document.getElementById("longitude").value=e.latLng.lng().toFixed(4)}),google.maps.event.addListener(marker,"dragstart",function(e){document.getElementById("longitude").value="",document.getElementById("latitude").value=""})}}})}),$("#groupproduct").change(function(){var e=$("#groupproduct").val();""!=e&&(2==e?$("#div-utility").hide():$("#div-utility").show(),$.ajax({url:"/categories/get_category",type:"post",dataType:"html",data:{groupproduct_id:e},beforeSend:function(){$("#categoryproduct").html("<option disabled selected>Đang tải</option>")},success:function(e){$("#categoryproduct").html(e)}}))}),$("#chk_price_min_max").click(function(){if($("#chk_deal").is(":checked")&&$("#chk_deal").removeAttr("checked"),$("#chk_price_min_max").is(":checked")){$("#price_dynamic").empty();var e='<div class="input text"><input name="data[Product][price_min]" id="price_min" class="form-control" placeholder="Min" type="text"/></div><div class="input text"><input name="data[Product][price_max]" id="price_max" class="form-control" placeholder="Max" type="text"/></div><span class="input-group-addon">Triệu</span>';$("#price_min_max").html(e),$("#chk_deal").prop("disabled",!0),$("#price_min").focus()}else{$("#price_min_max").empty();e='<div class="input text required"><input name="data[Product][price]" id="price" class="form-control" placeholder="Giá" type="text" required="required"/></div><span class="input-group-addon">Triệu</span>';$("#price_dynamic").html(e),$("#chk_deal").prop("disabled",!1),$("#price").focus()}}),$("#chk_deal").click(function(){$("#chk_deal").is(":checked")?($("#price").prop("disabled",!0),$("#price").val("0")):($("#price").prop("disabled",!1),$("#price").prop("readonly",!1),$("#price").focus())}),$("#chk_acreage_min_max").click(function(){if($("#chk_acreage_min_max").is(":checked")){$("#div-acreage").empty();var e='<div class="input text"><input name="data[Product][acreage_min]" id="acreage_min" class="form-control" placeholder="Min" type="text"/></div><div class="input text"><input name="data[Product][acreage_max]" id="acreage_min" class="form-control" placeholder="Max" type="text"/></div><span class="input-group-addon">m<sup>2</sup></span>';$("#div-acreage-min-max").html(e),$("#acreage_min").focus()}else{$("#div-acreage-min-max").empty();e='<div class="input text required"><input name="data[Product][acreage]" id="acreage" class="form-control" type="text" required="required"/></div><span class="input-group-addon">m<sup>2</sup></span>';$("#div-acreage").html(e),$("#acreage").focus()}}),$("#title").keyup(function(){var e=$(this).val().length;$("#numchar-title").html(e+"/150")}),$("#btnSaveProduct").click(function(){$("#ProductAddForm").submit(),$(this).attr("disabled",!0),$(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>')}),$(document).on('keyup','#price',function(){var e=$("#opt_price").val(),t="";"1"==e&&(t="/m2"),"2"==e&&(t="/1000m2"),"3"==e&&(t="/tháng"),"4"==e&&(t="/m2/tháng");var a=$(this).val();if(parseFloat(a))if(a>1e3){var i=a/1e3;$(".label-price").text(i+" Tỷ"+t)}else if(a<1){i=1e3*a;$(".label-price").text(i+" K"+t)}else{i=a;$(".label-price").text(i+" Triệu"+t)}else $(".label-price").text("")}),$("#opt_price").change(function(){var e=$(this).val(),t="";"1"==e&&(t="/m2"),"2"==e&&(t="/1000m2"),"3"==e&&(t="/tháng"),"4"==e&&(t="/m2/tháng");var a=$("#price").val();if(parseFloat(a))if(a>1e3){var i=a/1e3;$(".label-price").text(i+" Tỷ"+t)}else if(a<1){i=1e3*a;$(".label-price").text(i+" K"+t)}else{i=a;$(".label-price").text(i+" Triệu"+t)}else $(".label-price").text("")});
    })
</script>