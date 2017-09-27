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

    public function log($title, $message)
    {
        $this->message = 'cookie : ' . $_COOKIE['PHPSESSID'] . ',        object : ' . $title . ',        message : ' . var_export($message, true);
        $this->write();

        return contractor::get();
    }

    private function write()
    {
        write_log($this->message);
        var_dump($this->message);
    }

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = new contractor();
        }

        return self::$instance;
    }

    public function evaluate($function, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                $result = call_user_func($function);
                return parent::requires($result, array_merge($args, array($this->message)));
            } catch (Exception $ex) {
                $this->write();
                throw $ex;
            }
        }

        return contractor::get();
    }

    public function throw()
    {
        return self::requires(false);
    }

    public function requires($condition, $args = array())
    {
        if (true === WP_DEBUG) {
            try {
                return parent::requires($condition, array_merge($args, array($this->message)));
            } catch (Exception $ex) {
                $this->write();
                throw $ex;
            }
        }

        return contractor::get();
    }
}
