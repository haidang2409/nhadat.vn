<?php
$this->Paginator->options(array(
    "update" => "#content-ward",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-ward">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Phường xã</li>
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
        <!--            Search-->
        <div class="div-form-timkiem">
            <form class="form-horizontal" action="" method="get">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tỉnh thành</label>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('province', array('name' => 'province', 'id' => 'province', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['province'])?$this->params['url']['province']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Quận huyện</label>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('district', array('name' => 'district', 'id' => 'district', 'type' => 'select', 'options' => $districts, 'empty' => ' -- Chọn quận huyện - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['district'])?$this->params['url']['district']:''));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phường xã</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" value="<?php echo isset($this->params['url']['name'])? $this->params['url']['name']:'';?>">
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/wards" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
<!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>
                            Danh sách phường xã
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                                ?>
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/wards/add" class="btn btn-xs btn-success"> Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($wards))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input id="checkAll" name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>Stt</th>
                                <th><?php echo $this->Paginator->sort('wardname', 'Phường xã');?></th>
                                <th><?php echo $this->Paginator->sort('wardtype', 'Loại');?></th>
                                <th>
                                    <?php echo $this->Paginator->sort('District.districtname', 'Quận huyện');?>
                                </th>
                                <th>
                                    <?php echo $this->Paginator->sort('Province.provincename', 'Tỉnh thành');?>
                                </th>
                                <th>
                                    <?php echo $this->Paginator->sort('longitude', 'Kinh độ');?>
                                </th>
                                <th>
                                    <?php echo $this->Paginator->sort('latitude', 'Vĩ độ');?>
                                </th>
                                <th>
                                    Link
                                </th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($wards as $ward): ?>
                                <tr>
                                    <td>
                                        <label>
                                            <input name="wardIdAction" value="<?php echo $ward['Ward']['id'];?>" class="chkWardAction ace ace-checkbox-2" type="checkbox">
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['Ward']['page'] - 1) * $paginate['Ward']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $ward['Ward']['wardname'];?></td>
                                    <td align="center"><?php echo $ward['Ward']['wardtype'];?></td>
                                    <td>
                                        <a href="?district=<?php echo $ward['District']['id'];?>&province=<?php echo $ward['Province']['id']?>">
                                            <?php echo $ward['District']['districttype'] . ' ' . $ward['District']['districtname'];?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?province=<?php echo $ward['Province']['id']?>">
                                            <?php echo $ward['Province']['provincetype'] . ' ' . $ward['Province']['provincename'];?>
                                        </a>
                                    </td>
                                    <td align="center"><?php echo $ward['Ward']['longitude'];?></td>
                                    <td align="center"><?php echo $ward['Ward']['latitude'];?></td>
                                    <td><?php echo $ward['Ward']['wardlink'];?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/wards/edit/<?php echo $ward['Ward']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button class="btn btn-xs btn-danger btn-delete-ward" title="Xóa" data-ward_id="<?php echo $ward['Ward']['id'];?>" data-wardname="<?php echo $ward['Ward']['wardname'];?>" ><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div>
                            <select id="sltAction">
                                <option value=""> -- Chọn hành động -- </option>
                                <option value="move">
                                    Chuyển đến
                                </option>
                            </select>
                            <span style="display: none" id="divActionMove">
                                <?php echo $this->Form->input('province_move', array('id' => 'province_move', 'type' => 'select', 'options' => $provinces, 'label' => false, 'div' => false, 'empty' => ' -- Chọn tỉnh thành -- '));?>
                                <?php echo $this->Form->input('province_move', array('id' => 'district_move', 'type' => 'select', 'options' => null, 'label' => false, 'div' => false, 'empty' => ' -- Chọn quận huyện -- '));?>
                                <button class="btn btn-info btn-mini">Thực hiện</button>
                            </span>
                        </div>
                        <div class="pagination">
<!--                            --><?php //echo $this->Paginator->first(__('First', true), array());?>
                            <?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
                            <?php echo $this->Paginator->numbers(array(
                                'class' => 'numbers',

                            ));?>
                            <?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
<!--                            --><?php //echo $this->Paginator->last(__('Last', true), array());?>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-ward">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa phường xã: <b id="text-content"></b></p>
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
        $('#li-ward').addClass('active');
        $(document).on('click', '.btn-delete-ward',  function(){
            var ward_id = $(this).data('ward_id');
            var wardname = $(this).data('wardname');
            $('.modal-body #text-content').html(wardname);
            $('#btn-comfirm-delete').data('ward_id', ward_id);
            $('#modal-delete-ward').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var ward_id = $(this).data('ward_id');
            if(ward_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/wards/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'ward_id': ward_id
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
        $('th a').append(' <i class="fa fa-sort"></i>');
        $('th a.asc i').attr('class', 'fa fa-sort-asc');
        $('th a.desc i').attr('class', 'fa fa-sort-desc');
        $('.pagination span a').on('click', function(){
            var url = this.href;
            history.pushState(null, '', url);
        });
        $('th a').on('click', function(){
            var url = this.href;
            history.pushState(null, '', url);
        });
        //

        $('#province').change(function(){
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
        });
        $('#province_move').change(function(){
            var province_id = $('#province_move').val();
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
                        $('#district_move').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function (data) {
                        $('#district_move').html(data);
                    }
                })
            }
        });
        $('#checkAll').click(function () {
            if($(this).is(':checked') == true)
            {
                $('.chkWardAction').prop('checked', 'true');
            }
            else
            {
                $('.chkWardAction').prop('checked', '');
            }
        });
        $('#sltAction').change(function (e) {
            var action = $(this).val();
            if(action == 'move')
            {
                $('#divActionMove').show();
                var checkedVals = $('.chkWardAction:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                console.log(checkedVals);
                $.ajax({
                    url: '/admin/wards/move_ward',
                    type: 'post',
                    data: {
                        data: checkedVals
                    }
                })
            }
        });
    })
</script>