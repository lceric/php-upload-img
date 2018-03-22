<?php
  /**
   * 图片上传处理
   * User: CorwienWong
   * Date: 16-06-15
   * Time: 00:33
   */
  header('Access-Control-Allow-Origin: *');
  // header("Content-type:text/html;charset=utf-8");
  $sourcePath = 'http://localhost:3000/';
  // 配置文件需要上传到服务器的路径，需要允许所有用户有可写权限，否则无法上传成功
  $uploadPath = 'source/images/';

  // 获取提交的图片数据
  $file = $_FILES['file'];
  // print_r($file);
  // 获取图片回调路径
  // $callbackUrl = $_POST['callbackUrl'];

  if($file['error'] > 0) {
    $msg = '传入参数错误' . $file['error'] . "  ";
    exit($msg);
  } else {
    // chmod($uploadPath, 0666);
    if(file_exists($uploadPath.$file['name'])){
      $result = array('code' => 417, 'msg' => '文件已经存在！' );
      // $msg = $file['name'] . "文件已经存在！";
      exit(json_encode($result));
    } else {
      if(move_uploaded_file($file['tmp_name'], $uploadPath.$file['name'])) {
        $img_url = $uploadPath.$file['name'];
        // $img_url = urlencode($img_url);
        // $url = $callbackUrl."?img_url={$img_url}";
        // 跳转
        // header("location:{$url}");
        $result = array('code' => 0, 'msg' => '上传成功', 'url' => $sourcePath.$img_url );
        exit(json_encode($result));
      } else {
        $result = array('code' => 417, 'msg' => '上传失败！' );
        exit(json_encode($result));
      }
    }
  }
?>