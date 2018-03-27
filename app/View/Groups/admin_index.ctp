<?php
$this->Paginator->options(array(
    "update" => "#content-group",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-group">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Nhóm bất động sản</li>
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
                            Nhóm bất động sản
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/groups/add" class="btn btn-xs btn-success">Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($groupproducts))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên nhóm</th>
                                <th>Link</th>
                                <th>Sắp xếp</th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($groupproducts as $groupproduct): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['Group']['page'] - 1) * $paginate['Group']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="/admin/categories?group=<?php echo $groupproduct['Group']['id'];?>">
                                            <?php echo $groupproduct['Group']['groupname'];?>
                                        </a>
                                    </td>
                                    <td><?php echo $groupproduct['Group']['grouplink'];?></td>
                                    <td align="center"><?php echo $groupproduct['Group']['sort'];?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/groups/edit/<?php echo $groupproduct['Group']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button data-group_id="<?php echo $groupproduct['Group']['id'];?>" data-groupname="<?php echo $groupproduct['Group']['groupname'];?>" class="btn btn-xs btn-danger btn-delete-group" title="Xóa" href=""><i class="fa fa-trash"></i> </button>
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
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php echo $this->Js->writeBuffer();?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-group">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa nhóm bất động sản: <b id="text-content"></b></p>
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
        $('#li-product').addClass('active open');
        $('#li-group').addClass('active');
        $(document).on('click', '.btn-delete-group',  function(){
            var group_id = $(this).data('group_id');
            var groupname = $(this).data('groupname');
            $('.modal-body #text-content').html(groupname);
            $('#btn-comfirm-delete').data('group_id', group_id);
            $('#modal-delete-group').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var group_id = $(this).data('group_id');
            if(group_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/groups/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'group_id': group_id
                    },
                    success: function()
                    {
                        window.location = window.location;
                    },
                    error: function()
                    {
                        window.location = window.location;
                    }

                })
            }
        });
    })
</script>