<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li><a href="/admin/projects">Dự án</a> </li>
                <li>Sửa dự án</li>
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
                <h1>
                    Sửa dự án
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        overview &amp; stats
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Session->flash();?>
                    <?php echo $this->Html->script('ckeditor/ckeditor');?>
                    <?php echo $this->Html->script('ckfinder/ckfinder');?>
                    <?php echo $this->Form->create('Project', array('class' => 'form-horizontal', 'method' => 'post', 'type' => 'file', 'noValidate' => true));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nhóm dự án <font class="label-require">(*)</font> </label>
                        <div class="col-sm-6">
                            <?php echo $this->Form->input('project_category_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => $projectcats, 'empty' => ' -- Chọn nhóm dự án -- ', 'default' => $projects['Project']['project_category_id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dự án vip<font class="label-require">(*)</font> </label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input name="data[Project][vipproject]" class="ace ace-checkbox-2" type="checkbox" value="1" <?php if($projects['Project']['vipproject'] == 1) { echo 'checked';}?>>
                                    <span class="lbl"> Dự án vip</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tỉnh thành <font class="label-require">(*)</font> </label>
                        <div class="col-sm-6">
                            <?php echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành -- ',  'default' => $projects['Province']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Quận huyện <font class="label-require">(*)</font> </label>
                        <div class="col-sm-6">
                            <?php echo $this->Form->input('district_id', array('id' => 'district', 'type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => $districts, 'empty' => ' -- Chọn quận huyện -- ',  'default' => $projects['District']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tiêu đề dự án <font class="label-require">(*)</font></label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'label' => false,  'value' => $projects['Project']['title']));?>
                            <?php echo $this->Form->input('id', array('class' => 'form-control', 'label' => false,  'value' => $projects['Project']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tóm tắt dự án <font class="label-require">(*)</font></label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('summary', array('type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => 2,  'value' => $projects['Project']['summary']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mô tả dự án <font class="label-require">(*)</font></label>
                        <div class="col-sm-9">
                            <textarea name="data[Project][description]" class="form-control">
                                <?php
                                echo $projects['Project']['description'];
                                ?>
                            </textarea>
                            <!--                            --><?php //echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => 10, 'value' => html_entity_decode($menu_header)));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hình ảnh đại diện</label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('image2', array('id' => 'id-input-file-3', 'type' => 'file', 'class' => 'form-control', 'label' => false, 'multiple' => false));?>
                            <?php echo $this->Form->input('image_old', array('type' => 'hidden', 'class' => 'form-control', 'label' => false, 'value' => $projects['Project']['image']));?>
                        </div>
                        <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                            <div class="div-hint">
                                Để trống nếu không thay đổi hình ảnh(< 500Kb)
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary btn-xs">
                                Lưu <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </div>
                    <?php echo $this->Form->end();?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript">
    $(function () {
        CKEDITOR.config.allowedContent = true;
        var editor = CKEDITOR.replace('data[Project][description]', {
            filebrowserBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        });
        CKFinder.setupCKEditor(editor, '../' );
        //
        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small',//large | fit
            allowExt:  ['jpg', 'jpeg', 'png', 'PNG', 'JPG'],
            allowMime: ['image/jpg', 'image/jpeg', 'image/png'],
            preview_error : function(filename, error_code) {
            }
        }).on('change', function(){
        });
        //
        $('#province').click(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    url: '/districts/get_district',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'province_id' : province_id
                    },
                    beforeSend: function () {
                        $('#district').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function (data) {
                        $('#district').html(data);
                    }
                })
            }
        })
    });
    $('#li-project').addClass('open active');
</script>