<?php

class Helper extends CController
{
    public static function phone_number_format($number)
    { 
        //$number = '+37477684833';

        if(strlen($number) == 12 && $number[0] == '+')
        {
            $result = '('.substr($number, 0, 4).') '.substr($number, 4, 2) .' '.substr($number, 6, 2).'-'.substr($number, 8, 2).'-'.substr($number, 10);
        }
        elseif(strlen($number) == 9 && $number[0] == '0')
        {
            $result = '(+374) '.substr($number, 1, 2).' '.substr($number, 3, 2) .'-'.substr($number, 5, 2).'-'.substr($number, 7);
        }
        elseif(strlen($number) == 8)
        {
            $result = '(+374) '.substr($number, 0, 2).' '.substr($number, 2, 2) .'-'.substr($number, 4, 2).'-'.substr($number, 6);
        }
        else
        {
            $result = $number;
        }
        return $result;
    }
    
    public static function date_to($count, $type = 'day', $pm = '+', $time = FALSE)
    {
        switch ($type)
        {
            case 'day':
                $days = (int)$count;
                break;
            case 'week':
                $days = 7 * (int)$count;
                break;
            case 'month':
                $days = 30 * (int)$count;
                break;
            case 'year':
                $days = 365 * (int)$count;
                break;
        }
        date_default_timezone_set ('Asia/Moscow');
        if($time === FALSE)
        {
            $new_date = date_modify(date_create(), $pm.$days.' day')->format('Y-m-d');
        }
        else
        {
            $new_date = date_modify(date_create(), $pm.$days.' day')->format('Y-m-d 00:00:00');
        }
        return $new_date;
    }
    
    public static function article_category($categoryNumber)
    {
        $catArray = array(1 => 'О нас', 2 => 'О компании', 3 => 'Продукты', 4 => 'Статьи');
        return $catArray[$categoryNumber];
    }
    public static function text_crop($text, $count = 419)
    {
        return substr($text, 0, $count);
    }
}