
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Dự án</li>
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
                            Dự án
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-success btn-xs" href="/admin/projects/add">Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Session->flash();?>
                    <?php
                    if(isset($projects) && count($projects) > 0)
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên dự án</th>
                                <th>Nhóm</th>
                                <th>Vip</th>
                                <th>Hiển thị</th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($projects as $project): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['Project']['page'] - 1) * $paginate['Project']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="/admin/projects/view/<?php echo $project['Project']['id'];?>">
                                            <?php echo $project['Project']['title'];?>
                                        </a>
                                    </td>
                                    <td><?php echo $project['Projectcat']['project_category_name'];?></td>
                                    <td align="center">
                                        <?php
                                        if($project['Project']['vipproject'] == 1)
                                        {
                                            echo '<i class="fa fa-check green"></i>';
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        if($project['Project']['status'] == 1)
                                        {
                                            echo '<i class="fa fa-check green"></i>';
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        if($project['Project']['status'] == 1)
                                        {
                                            ?>
                                            <a data-project_id="<?php echo $project['Project']['id'];?>" data-title="<?php echo $project['Project']['title'];?>" class="btnHideProject" href="javascript: void(0)"> Ẩn </a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a data-project_id="<?php echo $project['Project']['id'];?>" data-title="<?php echo $project['Project']['title'];?>" class="btnShowProject" href="javascript: void(0)"> Hiển thị </a>
                                            <?php
                                        }
                                        ?>
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/projects/edit/<?php echo $project['Project']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button type="button" data-project_id="<?php echo $project['Project']['id'];?>" data-title="<?php echo $project['Project']['title'];?>" class="btn btn-xs btn-danger btn-delete-postcat" title="Xóa" href=""><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
                            <?php echo $this->Paginator->numbers(array(
                                'class' => 'numbers',
                            ));?>
                            <?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo '<div class="alert alert-warning">Không có dự án</div>';
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalShowProject">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Hiển thị dự án <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btnConfirmShow" type="button" class="btn btn-xs btn-primary"> Hiển thị <i class="fa fa-eye"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalHideProject">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Ẩn dự án: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btnConfirmHide" type="button" class="btn btn-xs btn-primary"> Ẩn <i class="fa fa-eye-slash"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->


<script>
    $(function () {
        $('#li-project').addClass('open active');
        $('#li-list-project').addClass('active');
        $('.btnShowProject').on('click', function () {
            var title = $(this).data('title');
            var project_id = $(this).data('project_id');
            $('#btnConfirmShow').data('project_id', project_id);
            $('.modal-body #text-content').html(title);
            $('#modalShowProject').modal('show');
        });
        $('#btnConfirmShow').click(function () {
            var project_id = $(this).data('project_id');
            if(project_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/projects/show_project',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'project_id': project_id
                    },
                    success: function() {
                        window.location = window.location;
                    }

                })
            }
        })
        $('.btnHideProject').on('click', function () {
            var title = $(this).data('title');
            var project_id = $(this).data('project_id');
            $('#btnConfirmHide').data('project_id', project_id);
            $('.modal-body #text-content').html(title);
            $('#modalHideProject').modal('show');
        });
        $('#btnConfirmHide').click(function () {
            var project_id = $(this).data('project_id');
            if(project_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/projects/hide_project',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'project_id': project_id
                    },
                    success: function() {
                        window.location = window.location;
                    }

                })
            }
        })
    })
</script>