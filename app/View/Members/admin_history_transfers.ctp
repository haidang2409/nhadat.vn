<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Chuyển nhận tiền</li>
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
                            Lịch sử chuyển nhận tiền
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                                ?>
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/members/transfer" class="btn btn-xs btn btn-success">
                            Thêm <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Session->flash();?>
                    <?php
                    if(isset($transfers) && count($transfers) > 0)
                    {
                        $count = 0;
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Người chuyển</th>
                                <th>Người nhận</th>
                                <th>Số tiền chuyển</th>
                                <th>Ngày chuyển</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sum = count($transfers);
                            foreach ($transfers as $item)
                            {
                                $count = $count + 1;
                                ?>
                                <tr>
                                    <td align="center">
                                        <?php echo $count;?>
                                    </td>
                                    <td>
                                        <a href="/admin/members/view_detail/<?php echo $item['Member_sender']['id']?>"><?php echo $item['Member_sender']['fullname']?></a>
                                    </td>
                                    <td>
                                        <a href="/admin/members/view_detail/<?php echo $item['Member_receiver']['id']?>"><?php echo $item['Member_receiver']['fullname']?></a>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($item['Transfer']['amount'], 0, '', '.');?>
                                    </td>
                                    <td align="center">
                                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Transfer']['created']);?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-warning">
                            Không có giao dịch
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $(function () {
        $('#li-member').addClass('active open');
        $('#li-history-transfer-member').addClass('active');
    })
</script>