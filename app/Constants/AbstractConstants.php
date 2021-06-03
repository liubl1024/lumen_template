<?php

namespace App\Constants;

use Illuminate\Support\Str;

abstract class AbstractConstants
{
    public static function __callStatic($commentName, $arguments)
    {
        if (!Str::startsWith($commentName, 'get')) {
            throw new \Exception('The function is not defined!');
        }

        if (!isset($arguments) || count($arguments) === 0) {
            throw new \Exception('The Code is required');
        }

        // 输入 code 码
        $code = $arguments[0];
        $commentName = ucfirst(strtolower(substr($commentName, 3)));

        $class = get_called_class();

        $reflectionClass = new \ReflectionClass($class);

        $constants = $reflectionClass->getConstants();
        // 反查  code 码对应的  const
        $nameArr = array_keys($constants, $code);

        if (count($nameArr) > 1) {
            throw new \Exception("response code 不唯一");
        }

        $name = $nameArr[0];

        $reflectionConst = new \ReflectionClassConstant($class, $name);

        $comment = $reflectionConst->getDocComment();

        $result = preg_match_all("/@{$commentName}\([\"|\'](.*)[\"|\']\)/", $comment, $matchs);

        if ($result) {
            $message = $matchs[1][0];
        } else {
            throw new \Exception("找不到 annotation {$commentName}");
        }
        return $message;
    }
}
