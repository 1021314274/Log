<?php

namespace Log;
/**
 * 一个简答的日志记录类
 * Class Log
 * @package Log
 */
class Log
{
    const  FLAG = true;

    /**
     * @param $content  内容
     * @param string $filename 文件夹，默认为default
     * @param string $title 标题
     */
    public static function log($content, $filename = 'default', $title = "")
    {
        if (FLAG == false || empty($content)) {
            return;
        }
        $filename = trim($filename, '/');
        $fileUrl = 'Log/' . $filename;
        if (!file_exists('Log')) {
            mkdir('Log', 0777);
            fopen('Log/index.html', 'w');
        }
        if (!file_exists($fileUrl)) {
            $fileUrl = 'Log/';
            $array = explode('/', $filename);
            foreach ($array as $k => $v) {
                $fileUrl .= $v . '/';
                @mkdir($fileUrl, 0777);
                @fopen($fileUrl . '/index.html', 'w');
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
        $start = '-----------------------' . $title . '(start)-------------------<br>';
        $end = '<br>-----------------------' . $title . '(end)-------------------<br>';
        $text = "【" . date('Y-m-d H:i:s') . '】' . $start . $text . $end;
        fwrite($file, $text . "\r\n");
        fclose($file);
    }


}