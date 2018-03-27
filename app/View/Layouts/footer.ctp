<div class="footer text-center-xs">
    <div class="container" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4>
                    Website đang trong quá trình xây dựng
                </h4>
            </div>
        </div>
        <div class="row hidden">
            <div class="col-sm-3">
                <h3>Về chúng tôi</h3>
                <a href="/a/gioi-thieu">Giới thiệu về chúng tôi</a><br>
                <a href="/tuyen-dung">Tuyển dụng</a><br>
                <a href="/a/lien-he">Liên hệ</a><br>
                <div class="div-link-social">
                    <a href="https://www.facebook.com" class="btn-social facebook"><i class="fa fa-facebook"></i> </a>
                    <a href="https://www.plus.google.com" class="btn-social google-plus"><i class="fa fa-google-plus"></i> </a>
                    <a href="https://www.youtube.com" class="btn-social youtube"><i class="fa fa-youtube"></i> </a>
                    <a href="https://www.twitter.com" class="btn-social twitter"><i class="fa fa-twitter"></i> </a>
                    <a href="https://www.linkedin.com" class="btn-social linkedin"><i class="fa fa-linkedin"></i> </a>
                </div>
                <?php
                $path_file = WWW_ROOT . DS . 'counter.txt';
                $num = (int)file_get_contents($path_file) + 1;
                file_put_contents(WWW_ROOT . DS . 'counter.txt', $num);
                echo number_format($num, 0, '', '.') . ' lượt truy cập';
                ?>
            </div>
            <div class="col-sm-3">
                <h3>Hướng dẫn</h3>
                    <a href="/help/huong-dan-dang-tin">Hướng dẫn đăng tin</a><br>
                    <a href="/help/huong-dan-thanh-toan">Hướng dẫn thanh toán</a><br>
                    <a href="/help/huong-dan-nap-tien">Hướng dẫn nạp tiền</a><br>
                    <a href="/help/dieu-khoan-su-dung">Điều khoản sử dụng</a><br>
                    <a href="/help/dieu-khoan-bao-mat">Điều khoản bảo mật</a>
            </div>
            <div class="col-sm-3">
                <h3>Báo giá dịch vụ</h3>
                <a href="/a/gia-dich-vu-dang-tin">Giá dịch vụ đăng tin</a><br>
                <a href="/a/gia-dich-vu-quang-cao">Giá dịch vụ quảng cáo</a><br>

            </div>
            <div class="col-sm-3">
                <h3>Bất động sản</h3>
                <?php
                foreach ($categories_menu as $item)
                {
                    echo '<a href="/' . $item['Group']['grouplink'] . '-g' . $item['Group']['id'] . '">'. $item['Group']['groupname'] . '</a><br>';
                }
                ?>
            </div>
        </div>
        <div class="row hidden">
            <hr>
            <div class="col-sm-9" style="font-size: 14px">
                Bản quyền <span class="fa fa-copyright"></span> 2017, vui lòng ghi rõ nguồn <u>nhadatphong.com</u> khi phát hành lại thông tin từ website này!
                <br>
                CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO HIỆN THỰC ƯỚC MƠ
                <br>
                <i class="fa fa-phone"></i> 0901 032 320 - <i class="fa fa-envelope"></i> cskh@dream.edu.vn
                <br>
                <i class="fa fa-home"></i>
                Địa chỉ VP: Số 86 Mạc Thiên Tích, Phường Xuân Khánh, Quận Ninh Kiều, TP Cần Thơ
                <br>
                <span>
                    Hoạt động theo giấy phép đăng ký kinh doanh số - Cấp ngày // Sở kế hoạch và đầu tư TP Cần Thơ
                </span>
            </div>
            <div class="col-sm-3 text-center-xs text-right">
                <?php
                echo $this->Html->image('bocongthuong.png', array('width' => '200px', 'alt' => 'Đã đăng ký với bộ công thương'))
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($allow_share) && $allow_share == true)
{
    include('social-share.ctp');
}
?>
<?php
echo $this->element('sql_dump');
?>
