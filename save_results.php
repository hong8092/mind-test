<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['data'])) {
        $data = urldecode($_POST['data']);
        $file = 'test_results.txt';
        
        // 检查文件是否存在
        if (file_exists($file)) {
            // 读取现有内容
            $existingContent = file_get_contents($file);
            // 检查是否已存在相同的行
            $lines = explode("\n", $existingContent);
            $newLines = explode("\n", $data);
            
            foreach ($newLines as $newLine) {
                if (!in_array($newLine, $lines)) {
                    // 追加新行
                    file_put_contents($file, "\n" . $newLine, FILE_APPEND);
                }
            }
        } else {
            // 创建新文件
            file_put_contents($file, $data);
        }
        
        echo '数据已成功保存到服务器';
    } else {
        echo '未收到数据';
    }
} else {
    echo '无效请求';
}
?>