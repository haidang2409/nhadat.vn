<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li><a href="/admin/recruitments">Tuyển dụng</a> </li>
                <li>Thêm tin tuyển dụng</li>
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
                    Thêm tuyển dụng
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
                    <?php echo $this->Form->create('Recruitment', array('class' => 'form-horizontal', 'method' => 'post', 'type' => 'file', 'noValidate' => true));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tiêu đề tin tuyển dụng <font class="label-require">(*)</font></label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'label' => false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mô tả tin tuyển dụng <font class="label-require">(*)</font></label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => 10));?>
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
        var editor = CKEDITOR.replace('data[Recruitment][content]', {
            filebrowserBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '/app/webroot/js/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '/app/webroot/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        });
        CKFinder.setupCKEditor(editor, '../' );
        $('#li-recruitment').addClass('active open');
        $('#li-add-recruitment').addClass('active');
    })
</script>
