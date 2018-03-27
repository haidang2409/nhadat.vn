<?php
function watermark_image($file, $destination, $overlay){
    $watermark = imagecreatefrompng($overlay);
    $source = getimagesize($file);
    $source_mime = $source['mime'];
    //Lấy kích thướt ảnh
    print_r($source);//để xem tham số
    $source_x = $source[0];
    $source_y = $source[1];
//    $source_x = 400;
//    $source_y = 400;
    if($source_mime == "image/png"){
        $image = imagecreatefrompng($file);
    }else if($source_mime == "image/jpeg"){
        $image = imagecreatefromjpeg($file);
    }else if($source_mime == "image/gif"){
        $image = imagecreatefromgif($file);
    }
    //Lấy chiều ngang/2 = tâm x, trừ 147(do anh mark co chieu ngang 295/2) => anh mark nam ngay tam theo chieu ngang
    $X = ($source_x / 2) - 130;
    //Lấy chiều cao - 50 (do anh mark cao 40) tru them 10 để cách bottom 10
    $Y = $source_y - 50;
    imagecopy($image, $watermark, $X, $Y, 0, 0, imagesx($watermark), imagesy($watermark));
    imagepng($image, $destination);
    return $destination;
}
//watermark_image('a4.jpg', 'ex.jpg', './uploads/products/watermark.png');

function resize($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
{
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);
    #assuming the mime type is correct
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }
    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
    $src_w = imagesx($source);
    $src_h = imagesy($source);
    #Do some math to figure out which way we'll need to crop the image
    #to get it proportional to the new size, then crop or adjust as needed
    $x_ratio = $tn_w / $src_w;
    $y_ratio = $tn_h / $src_h;

    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
        $new_w = $src_w;
        $new_h = $src_h;
    } elseif (($x_ratio * $src_h) < $tn_h) {
        $new_h = ceil($x_ratio * $src_h);
        $new_w = $tn_w;
    } else {
        $new_w = ceil($y_ratio * $src_w);
        $new_h = $tn_h;
    }
    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
    $final = imagecreatetruecolor($tn_w, $tn_h);
    $backgroundColor = imagecolorallocate($final, 229, 229, 229);
    imagefill($final, 0, 0, $backgroundColor);
    //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
    imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
    #if we need to add a watermark
    if ($wmsource) {
        #find out what type of image the watermark is
        $info    = getimagesize($wmsource);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $watermark = imagecreatefromjpeg($wmsource);
                break;
            case 'image/gif':
                $watermark = imagecreatefromgif($wmsource);
                break;
            case 'image/png':
                $watermark = imagecreatefrompng($wmsource);
                break;
            default:
                die('Invalid watermark type.');
        }
        #if we're adding a watermark, figure out the size of the watermark
        #and then place the watermark image on the bottom right of the image
        $wm_w = imagesx($watermark);
        $wm_h = imagesy($watermark);
        imagecopy($final, $watermark, 185, 405, 0, 0, $wm_w, $wm_h);
    }
    if (imagejpeg($final, $destination, $quality)) {
        return true;
    }
    return false;
}

resize('a4.jpg', 'out.jpg', 630, 450, 100, './uploads/products/watermark.png');
?>
<img src="out.jpg">
