<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Nạp tiền</li>
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
                            Lịch sử nạp tiền
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                                ?>
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/members/recharge" class="btn btn-xs btn btn-success">
                            Thêm <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Session->flash();?>
                    <?php
                    if(isset($recharges) && count($recharges) > 0)
                    {
                        $count = 0;
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Thành viên</th>
                                <th>Mệnh giá</th>
                                <th>Loại</th>
                                <th>Mã thẻ</th>
                                <th>Seri</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sum = count($recharges);
                            foreach ($recharges as $item)
                            {
                                $count = $count + 1;
                                ?>
                                <tr>
                                    <td align="center">
                                        <?php echo $count;?>
                                    </td>
                                    <td>
                                        <a href="/admin/members/view_detail/<?php echo $item['Member']['id']?>"><?php echo $item['Member']['fullname']?></a>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($item['Recharge']['price'], 0, '', '.');?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['type']?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['cardcode'];?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['seri'];?>
                                    </td>
                                    <td align="center">
                                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Recharge']['created']);?>
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
        $('#li-history-recharge-member').addClass('active');
    })
</script>