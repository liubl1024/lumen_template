<?php


namespace App\Support;


use Monolog\Formatter\LineFormatter;

class UDDateFormatter extends LineFormatter
{
    /**
     *  @desc 日志打印 毫秒时间戳
     *  $allowInlineLineBreaks  laravel 中默认为 true
     *  $ignoreEmptyContextAndExtra  laravel 中默认为 true
     * */
    public function __construct($format = null, $dateFormat = null, $allowInlineLineBreaks = true, $ignoreEmptyContextAndExtra = true)
    {

        if (is_null($dateFormat)) {
            $logChannel = config("logging.default");
            $dateFormat = config("logging.channels.{$logChannel}.date_formatter");
        }

        parent::__construct($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
    }

}
