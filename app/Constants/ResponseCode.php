<?php


namespace App\Constants;

/**
 * @desc 通过注解 设置响应 code 和 message
 *       可以设置 多个 Constant 文件 只要 继承 AbstractConstants 即可
 *       注意 code 值要唯一
 * */
class ResponseCode extends AbstractConstants
{
    /**
     * @Message("请求错误");
     */
    const ERROR = 499;


    /**
     * @Message("参数错误");
     */
    const PARAMS_ERROR = 450;
}
