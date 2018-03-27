<!--            Product new-->
<?php
if(isset($product_new) && count($product_new) > 0)
{
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="product-search-header">
                <h3>Bất động sản mới</h3>
            </div>
        </div>
        <div class="col-sm-12 product-container">
            <?php
            $sum_new = count($product_new);
            for($j = 0; $j < $sum_new; $j++)
            {
                $item = $product_new[$j];
                ?>
                <div class="list-product-bg-hover">
                    <div class="row list-style-2">
                        <div class="col-sm-4 col-xs-5 product-list-image">
                            <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                <?php
                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                if($item['Product']['image'])
                                {
                                    $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                }
                                ?>
                                <div class=""
                                     style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8 col-xs-7 product-list-summary">
                            <hr>
                            <h4>
                                <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>" style="text-decoration: none; font-size: 17px">
                                    <?php
                                    echo $item['Product']['title'];
                                    ?>
                                </a>
                            </h4>
                            <div class="">
                                <?php
                                $opt_price = '';
                                if($item['Product']['opt_price'] == 1)
                                {
                                    $opt_price = '/m<sup>2</sup>';
                                }
                                if($item['Product']['opt_price'] == 2)
                                {
                                    $opt_price = '/1000m<sup>2</sup>';
                                }
                                if($item['Product']['opt_price'] == 3)
                                {
                                    $opt_price = '/tháng';
                                }
                                if($item['Product']['opt_price'] == 4)
                                {
                                    $opt_price = '/m<sup>2</sup>/tháng';
                                }
                                ?>
                                <span class="price">
                                <?php if($item['Product']['price'] == 0):?>
                                    Thỏa thuận
                                <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                    <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']) . $otp_price;?>
                                <?php else:?>
                                    <?php echo $this->Lib->format_price($item['Product']['price']) . $opt_price;?>
                                <?php endif ?> -
                                    <!--                                    Acreage-->
                                    <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                        <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                                    <?php else:?>
                                        <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                                    <?php endif ?>
                                </span>
                                <span class="location">
                                        <i class="fa fa-map-marker"> </i>
                                    <?php echo $item['Product']['address'];?>,
                                    <?php echo $item['Ward']['wardtype'];?>
                                    <?php echo $item['Ward']['wardname'];?>,
                                    <?php echo $item['District']['districttype'];?>
                                    <?php echo $item['District']['districtname'];?>,
                                    <?php echo $item['Province']['provincename'];?>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
        <div class="col-sm-12 text-right">
            <a href="/nha-dat" style="color: orangered">Xem thêm +</a>
            <hr class="hr-dotted">
        </div>
    </div>
    <?php
}
?>
<!--            End product new->