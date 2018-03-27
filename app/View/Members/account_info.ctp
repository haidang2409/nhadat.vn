<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
        <div class="col-sm-9">
            <h2>Thông tin tài khoản</h2>
            <hr class="hr-double">
            <?php echo $this->Session->flash();?>
            <?php
            if(isset($members) && count($members) > 0)
            {
                ?>
                <table class="table table-bordered" align="center" style="width: 100%">
                    <tr>
                        <td style="padding-bottom: 15px">
                            <h3>Tài khoản chính</h3>
                        </td>
                        <td align="right" style="padding-bottom: 15px">
                            <h3><?php echo number_format($members['Profile']['primaryaccount'], 0, '', '.');?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Tài khoản thưởng</h3>
                        </td>
                        <td align="right">
                            <h3><?php echo number_format($members['Profile']['secondaccount'], 0, '', '.');?></h3>
                        </td>
                    </tr>
                </table>
                <div class="text-right">
                    <a class="btn btn-warning" href="/members/recharge">Nạp tiền</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>