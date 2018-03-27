<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
        <div class="col-sm-9">
            <h2>Hóa đơn</h2>
            <hr class="hr-double">
            <?php echo $this->Session->flash();?>
            <?php
            if(isset($orders) && count($orders) > 0)
            {
                $count = 0;
                ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Tin đăng</th>
                        <th>Gói tin</th>
                        <th>Tiền thanh toán</th>
                        <th>Ngày thanh toán</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum = count($orders);
                    foreach ($orders as $item)
                    {
                        $count = $count + 1;
                        ?>
                        <tr>
                            <td align="center">
                                <?php echo $count;?>
                            </td>
                            <td style="max-width: 400px !important;">
                                <?php echo $item['Product']['title']?>
                            </td>
                            <td>
                                <?php echo $item['Packet']['packetname'];?>
                            </td>
                            <td align="right">
                                <?php echo number_format($item['Order']['sumamount'], 0, '', '.');?>
                            </td>
                            <td align="center">
                                <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Order']['created']);?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
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
                ?>
                <div class="alert alert-warning">
                    Không có giao dịch
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>