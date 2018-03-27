<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/16/2017
 * Time: 3:34 PM
 */
class LibHelper extends AppHelper
{
    public function format_price($price)
    {
        $result = '';
        if($price < 1000)
        {
            if($price < 1)
            {
                $result = ($price * 1000) . ' nghìn';
            }
            else
            {
                $result = number_format($price, 2, ',', '.');
                $arr = explode(',', $result);
                $decimal = (int)$arr[1];
                if($decimal == 0)
                {
                    $result = $arr[0] . ' triệu';
                }
                else
                {
                    $result = $arr[0] . ',' . $arr[1] . ' triệu';
                }
            }
        }
        else
        {
            $result = number_format($price/1000, 2, ',', '.');
            $arr = explode(',', $result);
            $decimal = (int)$arr[1];
            if($decimal == 0)
            {
                $result = $arr[0] . ' tỷ';
            }
            else
            {
                $result = $arr[0] . ',' . $arr[1] . ' tỷ';
            }
        }

        return $result;

    }
    public function format_price_non_decimal($price)
    {
        $result = '';
        if($price < 1000)
        {
            $result = number_format($price, 0, ',', '.') . ' triệu';
        }
        else
        {
            $result = number_format($price/1000, 0, ',', '.') . ' tỷ';
        }
        return $result;

    }
    public function format_price_onlynumber($price)
    {
        $result = '';
        if($price < 1000)
        {
            $result = number_format($price, 2, ',', '.');
            $arr = explode(',', $result);
            $decimal = (int)$arr[1];
            if($decimal == 0)
            {
                $result = $arr[0];
            }
            else
            {
                $result = $arr[0] . ',' . $arr[1];
            }
        }
        else
        {
            $result = number_format($price/1000, 2, ',', '.');
            $arr = explode(',', $result);
            $decimal = (int)$arr[1];
            if($decimal == 0)
            {
                $result = $arr[0];
            }
            else
            {
                $result = $arr[0] . ',' . $arr[1];
            }
        }

        return $result;

    }
    function print_price($price1, $price2, $opt_price)
    {
        $result = '';
        //
        if($price1 == 0)
        {
            $result = 'Thỏa thuận';
        }
        else if($price1 > 0 && $price2 > $price1)
        {
            $result = $this->format_price_onlynumber($price1) . ' - ' . $this->format_price($price2);
        }
        else
        {
            $result = $this->format_price($price1);
        }
        //Opt price
        if($opt_price == 1)
        {
            $result = $result . '/m<sup>2</sup>';
        }
        if($opt_price == 2)
        {
            $result = $result . '/1000m<sup>2</sup>';
        }
        if($opt_price == 3)
        {
            $result = $result . '/tháng';
        }
        if($opt_price == 4)
        {
            $result = $result . '/m<sup>2</sup>/tháng';
        }
        return $result;
    }

    function print_acreage($acreage1, $acreage2)
    {
        $result = '';
        if($acreage1 > 0 && $acreage2 > $acreage1)
        {
            $result = $acreage1 . ' - ' . $acreage2 . 'm<sup>2</sup>';
        }
        else
        {
            $result = $acreage1 . 'm<sup>2</sup>';
        }
        return $result;
    }

    function substr_blank($str, $numCharacter)
    {
        $result = $result = substr($str, $numCharacter);;
        $num = 0;
        $char = substr($str, $numCharacter, 1);
        while($char != ' ')
        {
            $char = substr($str, $numCharacter + 1, 1);
            $num = $num + 1;

        }

    }

    function convertDateTime_Mysql_to_Date($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        return $newDate;
    }
    function convertDateTime_Mysql_to_Time($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        return $newDate;
    }
    function convertDateTime_Mysql_to_DateTime($datetime)
    {
        if($datetime == '')
        {
            return '';
        }
        else
        {
            $arr = explode(' ', $datetime);
            $date = $arr[0];
            $arrDate = explode('-', $date);
            $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0] . ' ' . $arr[1];
            return $newDate;
        }
    }

    function hide_phonenumber($phonenumber)
    {
        $len = strlen($phonenumber);
        if($len == 10)
        {
            return substr($phonenumber, 0, 7) . 'xxx';
        }
        else
        {
            return substr($phonenumber, 0, 8) . 'xxx';
        }
    }
    function removeScript($str)
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $str);
    }
    function replace_frame_280_160($url)
    {
        $result = preg_replace('#(WIDTH|width)(.*?)=(.*?)"(.*?)"#is', 'width="280"', $url);
        $result = preg_replace('#(HEIGHT|height)(.*?)=(.*?)"(.*?)"#is', 'height="160"', $result);
        return $result;
    }
    function replace_frame_80_160($url)
    {
        $result = preg_replace('#(WIDTH|width)(.*?)=(.*?)"(.*?)"#is', 'width="100%"', $url);
        $result = preg_replace('#(HEIGHT|height)(.*?)=(.*?)"(.*?)"#is', 'height="250px"', $result);
        return $result;
    }
    function encrypt_data($data, $key) {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
        return $encrypted;
    }
    function decrypt_data($data, $key) {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
        return $decrypted;
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' trước' : 'vừa mới';
    }


    //$time = strtotime('2010-04-28 17:25:43');
    //echo 'event happened '.humanTiming($time).' ago';

    function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }
    function hidden_text($text, $number)
    {
        $summary = $text;
        $num_str = strlen($summary);
        if($num_str > $number)
        {
            $summary = substr($summary, 0, $number);
            $start = strripos($summary, ' ');
            if($start > 0)
            {
                $summary = substr($summary, 0, $start + 1) . '...';
            }
        }
        return $summary;
    }
}