<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
                    <ul class="steps" style="margin-left: 0">
                        <li data-step="1" class="complete">
                            <span class="step">1</span>
                            <span class="title">Nhập thông tin</span>
                        </li>
                        <li data-step="2" class="active">
                            <span class="step">2</span>
                            <span class="title">Chọn dịch vụ và thanh toán</span>
                        </li>
                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Hoàn thành</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="step-content pos-rel">
                    <form id="formPaidProduct" method="post" action="<?php echo $_SERVER[ 'REQUEST_URI'];?>">
                        <div class="">
                            <div class="row">
                                <?php
                                echo $this->Session->flash();
                                $item = $products;
                                ?>
                                <?php if(isset($packets)):?>
                                    <?php for($i = 0; $i < count($packets); $i++):?>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="packet">
                                                <div class="packet-header">
                                                    <h4><?php echo $packets[$i]['Packet']['packetname'];?></h4>
                                                </div>
                                                <div class="bigger-150 packet-price">
                                                    <?php
                                                    $price = 0;
                                                    if($packets[$i]['Packet']['discount'] > 0)
                                                    {
                                                        $price =  $packets[$i]['Packet']['discount'];
                                                    }
                                                    else
                                                    {
                                                        $price = $packets[$i]['Packet']['price'];
                                                    }
                                                    echo number_format($price, 0, '', '.') . 'đ';
                                                    ?>
                                                </div>
                                                <div>
                                                    <?php
                                                    echo $packets[$i]['Packet']['date'] . ' Ngày';
                                                    echo '<br>';
                                                    echo 'Số lượt up tin: ' . $packets[$i]['Packet']['re_up'];
                                                    ?>
                                                </div>
                                                <div class="packet-footer">
                                                    <?php
                                                    $cls_btn = 'btn-primary';
                                                    if($packets[$i]['Packet']['sort'] == 1)
                                                    {
                                                        $cls_btn = 'btn-warning';
                                                    }
                                                    if($packets[$i]['Packet']['sort'] == 4)
                                                    {
                                                        $cls_btn = 'btn-white';
                                                    }
                                                    ?>
                                                    <button  type="submit" class="btn <?php echo $cls_btn;?>" name="packet_id" value="<?php echo $packets[$i]['Packet']['id'];?>">
                                                        Thanh toán
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor?>
                                <?php else:?>
                                    <div class="alert alert-warning">
                                        Chưa có dịch vụ
                                    </div>
                                <?php endif?>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-sm-9 product-container">
                            <!--                            Style 1-->
                            <?php
                            for($i = 1; $i <=4; $i++)
                            {
                                ?>
                                <div class="list-product-bg-hover packet-choose" id="style<?php echo $i;?>">
                                    <div class="row list-style-<?php echo $i;?>">
                                        <div class="col-sm-3 col-xs-5 product-list-image">
                                            <a href="javascript: void()" title="<?php echo $item['Product']['title'];?>">
                                                <?php
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                                if($item['Product']['image'] && ($i == 1 || $i == 2))
                                                {
                                                    $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                                }
                                                ?>
                                                <div class=""
                                                     style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-9 col-xs-7 product-list-summary">
                                            <hr>
                                            <h4>
                                                <a href="javascript: void()" title="<?php echo $item['Product']['title'];?>">
                                                    <?php
                                                    echo $item['Product']['title'];
                                                    ?>
                                                </a>
                                            </h4>
                                            <div class="hidden-xs">
                                                <span class="price">
                                                    <?php
                                                    $price = $this->Lib->print_price($item['Product']['price'], $item['Product']['price2'], $item['Product']['opt_price']);
                                                    echo $price;
                                                    ?>
                                                        <br>
                                                        <?php
                                                        $acreage = $this->Lib->print_acreage($item['Product']['acreage'], $item['Product']['acreage2']);
                                                        echo $acreage;
                                                        ?>
                                                </span>
                                                <div class="summary">
                                                    <?php
                                                    $summary = '';
                                                    if($item['Product']['summary'] != '')
                                                    {
                                                        $summary = $this->Lib->hidden_text($item['Product']['summary'], 200);
                                                    }
                                                    else
                                                    {
                                                        $summary = $this->Lib->hidden_text($item['Product']['description'], 200);
                                                    }
                                                    echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </div>
                                                <span class="location">
                                                    <i class="fa fa-map-marker"> </i>
                                                    <?php echo $item['Product']['address'];?>,
                                                    <?php echo $item['Ward']['wardtype'];?>
                                                    <?php echo $item['Ward']['wardname'];?>,
                                                    <?php echo $item['District']['districttype'];?>
                                                    <?php echo $item['District']['districtname'];?>,
                                                    <?php echo $item['Province']['provincename'];?>
                                                </span>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                    <span class="member">
                                                        <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                                        <?php echo $item['Product']['fullname'];?>
                                                        <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                                                <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                    <span class="date">
                                                        <i class="fa fa-clock-o"> </i>
                                                        <?php echo $this->Lib->time_elapsed_string($item['Product']['created']);?>
                                                    </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 visible-xs">
                                            <span class="price">
                                                <?php
                                                echo $price;
                                                ?>
                                                -
                                                <?php
                                                echo $acreage;
                                                ?>
                                            </span>
                                            <div class="summary">
                                                <?php
                                                echo $summary;
                                                ?>
                                            </div>
                                            <span class="location">
                                                <i class="fa fa-map-marker"> </i>
                                                <?php echo $item['Product']['address'];?>,
                                                <?php echo $item['Ward']['wardtype'];?>
                                                <?php echo $item['Ward']['wardname'];?>,
                                                <?php echo $item['District']['districttype'];?>
                                                <?php echo $item['District']['districtname'];?>,
                                                <?php echo $item['Province']['provincename'];?>
                                            </span>
                                            <span class="date">
                                                <i class="fa fa-calendar"> </i>
                                                <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);?>
                                            </span>
                                            <span class="member">
                                                <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                                <?php echo $item['Member']['fullname'];?>
                                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                    <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                                        <?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-search-header product-search-header-first">
                                <h3>Thông tin tài khoản</h3>
                            </div>
                            <div class="packet-member">
                                <div class="row">
                                    <div class="col-xs-8">
                                        Tài khoản chính
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <?php
                                        echo number_format($member['Profile']['primaryaccount'], 0, '', '.');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        Tài khoản thưởng
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <?php
                                        echo number_format($member['Profile']['secondaccount'], 0, '', '.');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.widget-body -->
        <!--            Steps-->
    </div>
</div>
<?php echo $this->Html->script('select2.min');?>
<!--Maps-->
<script>
    $(function () {
        $('.packet_id').click(function () {
            var packet_id = $(this).data('packet');
            if(packet_id == 1)
            {
                $('#style1').removeClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 2)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').removeClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 3)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').removeClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 4)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').removeClass('packet-choose');
            }
        });
        $('#btnPaid').click(function () {
            $('#formPaidProduct').submit();
            $(this).attr('disabled', true);
            $(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>');
        })
    })
</script>