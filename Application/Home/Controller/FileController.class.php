<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
class FileController extends Controller {
 
    //上传图片
  public function upload(){
      $upload=new Upload();
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $Upload->rootPath = C('UPLOAD_PATH');// 设置附件上传根目录
      $info   =   $upload->upload();
      if ($info) {
          $savePath = $info['Filedata']['savepath'];
          $saveName = $info['Filedata']['savename'];
          $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
          $image = new Image();
          $image->open($imgPath);
          $thumbPath = C('UPLOAD_PATH').$savePath.'180_'.$saveName;//缩略图地址
          $image->thumb(180, 180,image::IMAGE_THUMB_CENTER)->save($thumbPath);
          $image->open($imgPath);
          $unfoldPath = C('UPLOAD_PATH').$savePath.'550_'.$saveName;//大图
          $image->thumb(550, 550)->save($unfoldPath);
          $imageArr = array(
              'thumb'=>$thumbPath,
              'unfold'=>$unfoldPath,
              'source'=>$imgPath,
          );
      }else{
          $imageArr=$upload->getError();
      }
      
      $this->ajaxReturn($imageArr);
  }
  
  
  //校园新闻
  public function pic(){
      $upload=new Upload();
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $Upload->rootPath = C('UPLOAD_PATH');// 设置附件上传根目录
      $info   =   $upload->upload();
      if ($info) {
          $savePath = $info['Filedata']['savepath'];
          $saveName = $info['Filedata']['savename'];
          $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
          $image = new Image();
          $image->open($imgPath);
          $thumbPath = C('UPLOAD_PATH').$savePath.'119_'.$saveName;//缩略图地址
          $image->thumb(119, 89,image::IMAGE_THUMB_CENTER)->save($thumbPath);
          $imageArr = array(
              'thumb'=>$thumbPath,
              'source'=>$imgPath,
          );
      }else{
          $imageArr=$upload->getError();
      }
  
      $this->ajaxReturn($imageArr);
  }
  
  
  //单张图片
  public function one(){
      $upload=new Upload();
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $Upload->rootPath = C('UPLOAD_PATH');// 设置附件上传根目录
      $info   =   $upload->upload();
      if ($info) {
          $savePath = $info['Filedata']['savepath'];
          $saveName = $info['Filedata']['savename'];
          $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
          $image = new Image();
          $image->open($imgPath);
          $image->thumb(100,100,image::IMAGE_THUMB_CENTER)->save($imgPath);
      }else{
          $imageArr=$upload->getError();
      }
  
      $this->ajaxReturn($imgPath);
  }
  
  //幼儿知识
  public function story(){
      $upload=new Upload();
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath = C('UPLOAD_PATH');// 设置附件上传根目录
      $info   =   $upload->upload();
      if ($info) {
          $savePath = $info['Filedata']['savepath'];
          $saveName = $info['Filedata']['savename'];
          $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
          $image = new Image();
          $image->open($imgPath);
          $thumbPath = C('UPLOAD_PATH').$savePath.'119_'.$saveName;//缩略图地址
          $image->thumb(200,200,image::IMAGE_THUMB_CENTER)->save($thumbPath);
          $image->open($imgPath);
          $unfoldPath = C('UPLOAD_PATH').$savePath.'600_'.$saveName;//大图
          $image->thumb(600,400,image::IMAGE_THUMB_FILLED)->save($unfoldPath);          
          $imageArr = array(
              'thumb'=>$thumbPath,
              'unfold'=>$unfoldPath,
              'source'=>$imgPath,
          );
      }else{
          $imageArr=$upload->getError();
      }
  
      $this->ajaxReturn($imageArr);
  } 
  
  //头像上传
  public function face(){
      $upload=new Upload();
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $Upload->rootPath = C('UPLOAD_PATH');// 设置附件上传根目录
      $info   =   $upload->upload();
      if ($info) {
          $savePath = $info['Filedata']['savepath'];
          $saveName = $info['Filedata']['savename'];
          $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
          $image = new Image();
          $image->open($imgPath);
          $image->thumb(500,500)->save($imgPath);
          $this->ajaxReturn($imgPath);
      }else{
          $imageArr=$upload->getError();
      }
      
  }
  
  //保存头像
  public function crop(){
      if (IS_AJAX){
          $bigPath = C('FACE_PATH').session('user_auth.id').'.jpg';
          $smallPath = C('FACE_PATH').session('user_auth.id').'_small.jpg';
          $image = new Image();
          $image->open(I('post.url'));
          $image->crop(I('post.w'),I('post.h'),I('post.x'),I('post.y'))->save(I('post.url'));
          $image->thumb(200, 200, Image::IMAGE_THUMB_FIXED)->save($bigPath);
          $image->thumb(50, 50, Image::IMAGE_THUMB_FIXED)->save($smallPath);
          $imageArr = array(
              'big'=>$bigPath,
              'small'=>$smallPath,
          );
          $user=D("User");
          $face=json_encode($imageArr);
          session('user_auth.face',json_decode($face));
          $user->updateface(json_encode($imageArr));
          echo json_encode($imageArr);
      }
  }
    
}