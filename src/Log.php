<?php

namespace zouzhanhao\Log;
/**
 * 一个简单的日志记录类
 * Class Log
 * @package Log
 */
class Log
{
    public $flag = true;

    /**
     * @param $content  内容
     * @param string $filename 文件夹，默认为default
     * @param string $title 标题
     */
    public static function log($content, $filename = 'default', $title = "")
    {

        if (self::flag == false || empty($content)) {
            return;
        }
        $filename = trim($filename, '/');
        $fileUrl = __DIR__ . '/Log/' . $filename;
        if (!file_exists('Log')) {
            mkdir('Log', 0777);
        }
        if (!file_exists($fileUrl)) {
            $fileUrl = __DIR__ . '/Log/';
            $array = explode('/', $filename);
            foreach ($array as $k => $v) {
                $fileUrl .= $v . '/';
                @mkdir($fileUrl, 0777);
            }
            $fileUrl = rtrim($fileUrl, '/');
        }

        $logUrl = $fileUrl . '/' . date('Y-m-d') . '.txt';
        $file = fopen($logUrl, 'a');
        if (is_array($content)) {
            $text = json_encode($content);
        } else {
            $text = $content;
        }
        $start = '-----------------------' . $title . '(start)-------------------' . "\r\n";
        $text = "【" . date('Y-m-d H:i:s') . '】' . $text . "\r\n";
        $end = '-----------------------' . $title . '(end)-------------------' . "\r\n";
        $txt = $start . $text . $end;
        fwrite($file, $txt);
        fclose($file);
    }


}