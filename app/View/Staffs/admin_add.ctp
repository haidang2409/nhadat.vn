<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/staffs">Nhân viên</a>
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
                            Thêm nhân viên
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
                    echo $this->Form->create('Staff', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Email <font class="label-require">(*)</font></label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Mật khẩu <font class="label-require">(*)</font></label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('password', array('type' => 'text', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Họ tên <font class="label-require">(*)</font></label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('fullname', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-xs-12 control-label no-padding-right">Giới tính </label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="radio">
                                <?php
                                $gender = isset($this->request->data['Staff']['gender'])? $this->request->data['Staff']['gender']: '';
                                ?>
                                <label>
                                    <input name="data[Staff][gender]" class="ace" type="radio" value="1" <?php if($gender == '1'){ echo 'checked';}?>>
                                    <span class="lbl"> Nam </span>
                                </label>
                                <label>
                                    <input name="data[Staff][gender]" class="ace" type="radio" value="0" <?php if($gender == '0'){ echo 'checked';}?>>
                                    <span class="lbl"> Nữ </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Ngày sinh</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('birth', array('type' => 'text', 'id' => 'birthday', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Ngày/tháng/năm'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Số điện thoại</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('phonenumber', array('type' => 'text', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Địa chỉ</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('address', array('type' => 'text', 'id' => 'birthday', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Tỉnh thành</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'label' => false, 'options' => $provinces, 'class' => 'form-control', 'empty' => ' -- Chọn tỉnh thành -- '));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Quận huyện</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('district', array('id' => 'district', 'type' => 'select', 'label' => false, 'options' => $districts, 'class' => 'form-control', 'empty' => ' -- Chọn quận huyện -- '));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Phường xã</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('ward_id', array('id' => 'ward', 'type' => 'select', 'label' => false, 'options' => $wards, 'class' => 'form-control', 'empty' => ' -- Chọn phường xã -- '));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Quyền <font class="label-require">(*)</font></label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('role', array('type' => 'select', 'label' => false, 'options' => array('1' => 1, '2' => 2, '3' => 3), 'class' => 'form-control', 'empty' => ' -- Chọn quyền -- '));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
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
    $(function () {
        $('#birthday').datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $('#province').change(function(){
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    url: '/districts/get_district',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'province_id': province_id
                    },
                    beforeSend: function()
                    {
                        $('#district').html('<option disabled selected>Đang tải</option>');
                        $('#ward').html('<option value="">Chọn phường xã</option>')
                    },
                    success: function (data) {
                        $('#district').html(data);
                    }
                })
            }
        });
        $('#district').change(function () {
            var district_id = $('#district').val();
            if(district_id != '')
            {
                $.ajax({
                    url: '/wards/get_ward',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'district_id' : district_id
                    },
                    beforeSend: function () {
                        $('#ward').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function (data) {
                        $('#ward').html(data);
                    }
                })
            }
        })
    })
</script>