<?php
function showTree($folder, $space)
{
    $files = scandir($folder);
    foreach ($files as $file) {
        if (($file === '.') || ($file === '..')) {
            continue;
        }
        $nextFile = $folder.'/'.$file;
        if (php_sapi_name() === 'cli') {
            echo $space.$file.PHP_EOL;
        } else {
            echo str_replace(' ', '&nbsp;', $space).$file.'<br/>';
        }
        if (is_dir($nextFile)) {
            if (substr(sprintf('%o', fileperms($nextFile)), -1) < 4) {
                continue;
            }
            showTree($nextFile, $space.'   ');
        }
    }
}

showTree('../', '  ');
