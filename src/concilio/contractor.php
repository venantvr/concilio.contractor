<?php

namespace concilio;

use Hediet\Contract;

if (!function_exists('write_log')) {

    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

class contractor extends Contract
{
    private static $instance = null;
    public $message;

    public static function log($title, $message)
    {
        self::/*$this->*/
        $message = 'cookie : ' . $_COOKIE['PHPSESSID'] . ',        object : ' . $title . ',        message : ' . var_export($message, true);
        self::/*$this->*/
        write();

        return self/*contractor*/
        ::get();
    }

    private static function write()
    {
        write_log(self::/*$this->*/
        $message);
        var_dump(self::/*$this->*/
        $message);
    }

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = new contractor();
        }

        return self::$instance;
    }

    public static function evaluate($function, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                $result = call_user_func($function);
                return parent::requires($result, array_merge($args, array(self::/*$this->*/
                $message)));
            } catch (Exception $ex) {
                write();
                throw $ex;
            }
        }

        return self/*contractor*/
        ::get();
    }

    public static function requires($condition, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                return parent::requires($condition, array_merge($args, array(self::/*$this->*/
                $message)));
            } catch (Exception $ex) {
                write();
                throw $ex;
            }
        }

        return self/*contractor*/
        ::get();
    }

    public static function throw()
    {
        return requires(false);
    }
}
