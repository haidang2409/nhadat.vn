<?php
$this->Paginator->options(array(
    "update" => "#content-product",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-product">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Tin bất động sản</li>
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
                    <label class="col-sm-2 control-label">Hình thức</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('transactiontype', array('name' => 'transactiontype', 'label' => false, 'type' => 'select', 'options' => $transactiontypes, 'empty' => ' -- Tất cả -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['transactiontype'])?$this->params['url']['transactiontype']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Nhóm</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('group', array('name' => 'group', 'id' => 'group', 'label' => false, 'type' => 'select', 'options' => $groups, 'empty' => ' -- Tất cả -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['group'])?$this->params['url']['group']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Loại</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('category', array('name' => 'category', 'id' => 'category', 'label' => false, 'type' => 'select', 'options' => $categories, 'empty' => ' -- Tất cả -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['category'])?$this->params['url']['category']:''));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tỉnh thành</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('province', array('name' => 'province', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Tất cả - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['province'])?$this->params['url']['province']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Quận huyện</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('district', array('name' => 'district', 'type' => 'select', 'options' => $districts, 'empty' => ' -- Tất cả - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['district'])?$this->params['url']['district']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Phường xã</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('ward', array('name' => 'ward', 'type' => 'select', 'options' => null, 'empty' => ' -- Tất cả - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['ward'])?$this->params['url']['ward']:''));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Thành viên</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('member', array('name' => 'member', 'class' => 'form-control', 'label' => false, 'value' => isset($this->params['url']['member'])?$this->params['url']['member']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Loại tin</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('packet', array('name' => 'packet', 'type' => 'select', 'options' => $packets, 'empty' => ' -- Tất cả - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['packet'])?$this->params['url']['packet']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('status',
                            array(
                                'name' => 'filter',
                                'type' => 'select',
                                // 'empty' => ' -- Tất cả -- ',
                                'class' => 'form-control',
                                'label' => false,
                                'options' => array(
                                    'all' => ' -- Tất cả -- ',
                                    'visible' => 'Đang hiển thị',
                                    'expired' => 'Tin hết hạn',
                                    'draft' => 'Tin nháp',
                                    'deleted' => 'Đã xóa'
                                ),
                                'default' => isset($this->params['url']['filter'])?$this->params['url']['filter']:''
                            )
                        );
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">SĐT liên hệ</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('phonenumber', array('name' => 'phonenumber', 'class' => 'form-control', 'label' => false, 'value' => isset($this->params['url']['phonenumber'])?$this->params['url']['phonenumber']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Email liên hệ</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('email', array('name' => 'email', 'class' => 'form-control', 'label' => false, 'value' => isset($this->params['url']['email'])?$this->params['url']['email']:''));?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/products" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
        <!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <h1>
                        Danh sách tin bất động sản
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                            ?>
                        </small>
                    </h1>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12 product-container">
                    <?php
                    echo $this->Session->flash();
                    if(isset($products) && count($products) > 0)
                    {
                        $sum_product = count($products);
                        for($i = 0; $i < $sum_product; $i++)
                        {
                            $item = $products[$i];
                            ?>
                            <div class="list-product-bg-hover">
                                <div class="row list-style-<?php echo $item['Packet']['id'];?>">
                                    <div class="col-sm-2 col-xs-5 product-list-image">
                                        <a href="/admin/products/view/<?php echo $item['Product']['id'];?>">
                                            <?php
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                            if($item['Product']['image'])
                                            {
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                            }
                                            ?>
                                            <div class="" style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                                <div class="" style="background-color: #ecd5a2; padding: 5px; font-size: 20px">
                                                    <?php echo $item['Packet']['packetname'];?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-8 col-xs-7 product-list-summary">
                                        <hr>
                                        <h4>
                                            <a href="/admin/products/view/<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                <?php
                                                echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                ?>
                                            </a>
                                        </h4>
                                        <div class="">
                                            <span class="price">
                                                <?php if($item['Product']['price'] == 0):?>
                                                    Giá thỏa thuận
                                                <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                                    <i class="fa fa-dollar"></i>
                                                    <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']);?>
                                                <?php else:?>
                                                    <i class="fa fa-dollar"></i>
                                                    <?php echo $this->Lib->format_price($item['Product']['price']);?>
                                                <?php endif ?>
                                                <!--                                    Acreage-->
                                                - <i class="fa fa-book"></i>
                                                <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                                    <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                                                <?php else:?>
                                                    <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                                                <?php endif ?>
                                            </span>
                                            <div class="summary">
                                                <?php
                                                echo htmlentities($item['Product']['summary'], ENT_QUOTES, 'UTF-8');
                                                ?>
                                            </div>
                                            <span class="location">
                                                <i class="fa fa-map-marker"> </i>
                                                <?php echo htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8');?>,
                                                <?php echo $item['Ward']['wardtype'];?>
                                                <?php echo $item['Ward']['wardname'];?>,
                                                <?php echo $item['District']['districttype'];?>
                                                <?php echo $item['District']['districtname'];?>,
                                                <?php echo $item['Province']['provincename'];?>
                                            </span>
                                            <span>
                                                <?php
                                                echo 'Ngày tạo: ' . $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);
                                                echo ' - Ngày thanh toán: ' . $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['date_paid']);
                                                echo ' - Hết hạn: ' . $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['expiry']);
                                                ?>
                                                </span>
                                            <div class="member">
                                                <b>TT liên hệ:</b>
                                                <span class="blue"><?php echo $item['Product']['fullname'];?></span>/
                                                <span class="orange"><?php echo $item['Product']['phonenumber'];?></span>/
                                                <span class="green"><?php echo $item['Product']['email'];?></span>
                                            </div>
                                            <div class="member">
                                                <b>Thành viên:</b>
                                                <a href="/admin/members/view_detail/<?php echo $item['Member']['id'];?>"><?php echo $item['Member']['fullname'];?></a>/
                                                <span class="orange"><?php echo $item['Member']['phonenumber'];?></span>/
                                                <span class="green"><?php echo $item['Member']['email'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-center" style="padding-top: 15px">
                                        <i class="fa fa-eye"> </i>
                                        <?php
                                        echo $item['Product']['view'];
                                        ?>
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <a class="btn btn-info btn-xs" style="width: 39px" target="_blank" href="/<?php echo $item['Product']['productlink'] . '-' . $item['Product']['id'];?>"><i class="fa fa-eye"></i> </a>
                                        <br>
                                        <a class="btn btn-warning btn-xs" style="width: 39px" href="/admin/products/edit/<?php echo $item['Product']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <br>
                                        <div class="inline pos-rel">
                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" data-position="auto" aria-expanded="false">
                                                <i class="ace-icon fa fa-share icon-only bigger-110" style="width: 23px"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="https://www.facebook.com/sharer?u=<?php echo $_SERVER['HTTP_HOST'] . '/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẻ lên Facebook" target="_blank">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-facebook bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . '/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẽ lên Google+" target="_blank">
                                                        <span class="red">
                                                            <i class="ace-icon fa fa-google-plus bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
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
                        echo '<div class="alert alert-warning">Không có tin</div>';
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php
$filter = isset($this->params['url']['filter'])? $this->params['url']['filter']: '';

?>
<?php echo $this->Js->writeBuffer();?>
<script>
    $(function () {
        var action = '<?php echo $filter;?>';
        $('#li-product').addClass('active open');
        $("#li-list-product-" + action).addClass('active');
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
                    beforeSend: function () {
                        $('#district').html('<option disabled selected>Đang tải</option>')
                        $('#ward').html('<option selected>Xã phường</option>')
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
                    beforeSend: function () {
                        $('#ward').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#ward').html(string)
                    }
                });
            }
        });
        $('#group').change(function () {
            var group_id = $('#group').val();
            if(group_id != '')
            {
                $.ajax({
                    'url': '/categories/get_category',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'groupproduct_id': group_id
                    },
                    beforeSend: function () {
                        $('#category').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#category').html(string)
                    }
                });
            }
        });
    })
</script>