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

class Contractor extends Contract
{
    public $message;

    private static $instance = null;

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = new Contractor();
        }

        return self::$instance;
    }

    public function log($title, $message)
    {
        $this->message = PHP_EOL . $_COOKIE['PHPSESSID'] . PHP_EOL . $title . PHP_EOL . var_export($message, true);

        write_log($this->message);

        return Contractor::get();
    }

    public static function requires_func($condition, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                $result = call_user_func($condition);
                return parent::requires($result, $args);
            } catch (Exception $ex) {
                die($this->message);
            }
        }

        return $this;
    }

    public static function requires($condition, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                return parent::requires($condition, $args);
            } catch (Exception $ex) {
                die($this->message);
            }
        }

        return $this;
    }
}
