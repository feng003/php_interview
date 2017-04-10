<?php
//date() strtotime()

// int strtotime ( string $time [, int $now = time() ] )   将任何英文文本的日期时间描述解析为 Unix 时间戳
echo strtotime("now"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
?>