<?php

namespace app;

use basic\BaseController;
use think\facade\Validate;

class AuthController extends BaseController
{
    protected function initialize()
    {
    }

    /**
     * 验证数据
     * @param  array  $data
     * @param $validate
     * @param  null  $message
     * @param  bool  $batch
     * @return bool
     */
    final protected function validate(array $data, $validate, $message = null, bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                list($validate, $scene) = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }

            if (is_string($message) && empty($scene)) {
                $v->scene($message);
            }
        }

        if (is_array($message)) {
            $v->message($message);
        }


        // 是否批量验证
        if ($batch) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }
}