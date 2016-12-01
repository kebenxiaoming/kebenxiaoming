<?php
/**
 * Created by sunny.
 * User: sunny
 * For Darling
 * Date: 2016/12/1
 * Time: 16:32
 */
namespace sunny;

class Response{
    /**
     * 创建Response对象
     * @access public
     * @param mixed  $data    输出数据
     * @param string $type    输出类型
     * @param int    $code
     * @param array  $header
     * @param array  $options 输出参数
     * @return Response|JsonResponse|ViewResponse|XmlResponse|RedirectResponse|JsonpResponse
     */
    public static function create($data = '', $type = '', $code = 200, array $header = [], $options = [])
    {
        $type = empty($type) ? 'null' : strtolower($type);

        $class = false !== strpos($type, '\\') ? $type : '\\sunny\\response\\' . ucfirst($type);
        if (class_exists($class)) {
            $response = new $class($data, $code, $header, $options);
        } else {
            $response = new static($data, $code, $header, $options);
        }

        return $response;
    }
}