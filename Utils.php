<?php
Class Utils {
    static function add_hyphen_before_last_char($string) {
        $length = strlen($string);
        $result = substr($string, 0, $length - 1) . "-" . substr($string, -1);
        return $result;
    }

    static function replace_second_last_char($str) {
        if (strlen($str) > 1) {
          $length = strlen($str);
          $new_str = substr_replace($str, "-", $length - 2, 1);
          return $new_str;
        } else {
          return $str;
        }
    }

    static function add_els_or_ans($str) {
        $last_char = substr($str, -1);
        $int_last_char = intval($last_char);
        if ($int_last_char > 1) {
          $str .= " ans";
        } else {
          $str .= " an";
        }
        return $str;
    }

    static function getLastThreeCharacters($str) {
        return substr($str, -3);
    }
      
}