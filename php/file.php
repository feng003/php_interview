<?php
/**
 * 文件操作
 * Created by PhpStorm.
 * User: zhang
 * Date: 2015/3/29
 * Time: 10:52
 */

//TODO file() file_put_content() file_get_content()  fopen() fread() fwrite() fclose() file_exists() filesize() feof()  filetype()  move_uploaded_file()
//TODO opendir() mkdir() rmdir()  is_dir() is_file() is_link() closedir()  is_executable()  is_readable() is_writable() is_uploaded_file() unlink()

// mixed pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] ) 返回文件路径的信息
// string dirname ( string $path )  返回路径中的目录部分
// string basename ( string $path [, string $suffix ] ) 返回路径中的文件名部分
// string realpath ( string $path ) 返回规范化的绝对路径名

// mixed parse_url ( string $url [, int $component = -1 ] )   解析 URL，返回其组成部分
// void parse_str ( string $str [, array &$arr ] )  将字符串解析成多个变量

// string http_build_url ([ mixed $url [, mixed $parts [, int $flags = HTTP_URL_REPLACE [, array &$new_url ]]]] )   产生一个 URL
// string http_build_str ( array $query [, string $prefix [, string $arg_separator = ini_get("arg_separator.output") ]] )  产生一个查询字符串

//chgrp   chmod chown clearstatcache copy  delete  unset    disk_free_space  disk_total_space fflush  fgetc fgetcsv fgets fgetss 
//fileatime  filectime  filegroup  fileinode filemtime fileowner fileperms  flock  fnmatch fpassthru fputcsv fscanf fseek fstat ftell
//ftruncate  glob  link linkinfo lstat  pclose popen readfile  readlink rename  rewind stat symlink tempnam temfile  touch  umask