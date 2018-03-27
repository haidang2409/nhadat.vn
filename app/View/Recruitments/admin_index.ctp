<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Tuyển dụng</li>
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
                    <div class="col-sm-6">
                        <h1>
                            Danh sách tin tuyển dụng
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/recruitments/add" class="btn btn-xs btn btn-success">
                            Thêm <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($recruitments) && count($recruitments) > 0)
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($recruitments as $item): ?>
                                <tr>
                                    <td style="text-align: center" width="50">
                                        <?php
                                        echo $count + 1;
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td style="max-width: 300px">
                                        <a href="/admin/recruitments/view/<?php echo $item['Recruitment']['id'];?>">
                                            <?php echo $item['Recruitment']['title'];?>
                                        </a>
                                    </td>
                                    <td style="">
                                        <div style="max-height: 200px; overflow-y: hidden">
                                            <?php
                                            echo $item['Recruitment']['content'];
                                            ?>
                                        </div>
                                    </td>
                                    <td align="center"><?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Recruitment']['created']);?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/recruitments/edit/<?php echo $item['Recruitment']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button type="button" data-recruitment_id="<?php echo $item['Recruitment']['id'];?>" data-title="<?php echo $item['Recruitment']['title'];?>" class="btn btn-xs btn-danger btn-delete-recruitment" title="Xóa" href=""><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php
                    }
                    else
                    {
                        echo '<div class="alert alert-warning">Không có dữ liệu</div>';
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-recruitment">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa tin tuyển dụng: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-primary"> Xóa <i class="fa fa-trash"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $(document).on('click', '.btn-delete-recruitment',  function(){
            var recruitment_id = $(this).data('recruitment_id');
            var title = $(this).data('title');
            $('.modal-body #text-content').html(title);
            $('#btn-comfirm-delete').data('recruitment_id', recruitment_id);
            $('#modal-delete-recruitment').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var recruitment_id = $(this).data('recruitment_id');
            if(recruitment_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/recruitments/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'recruitment_id': recruitment_id
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
        $('#li-recruitment').addClass('active open');
        $('#li-list-recruitment').addClass('active');
    })
</script>