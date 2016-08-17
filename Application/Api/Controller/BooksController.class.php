<?php
/**
 *   Author: Alixez
 *   E-Mail: alixe.z@outlook.com
 * CreateAt: 16-7-11 下午1:56
 *  Company: 成都计速科技
 */

namespace Api\Controller;


use Think\Exception;

class BooksController extends Controller
{
    public function listByBook()
    {
        $user = $this->getUser();

        try {
            $students = M('bookinfo')->field('bookinfo.id,bookname,number,inTime,pubname')->join('publishing ON bookinfo.ISBN =publishing.ISBN')->where(array(
                'schoolid' => $user['school_id'],
            ))->select();
            $this->doSuccess(array('students' => $students));
        } catch (Exception $e) {
            $this->doFailed('服务器出现错误,请稍后在试');
        }
    }
    
    public function backByBook()
    {
        $user = $this->getUser();
    
        try {
            $borrow = M('borrow')->field('borrow.id,bookname,borrowTime,backTime,rental')->join('bookinfo ON borrow.bookid =bookinfo.id')->where(array(
                'borrow.userid' => $user['id'],
                'ifback' => 0,
            ))->select();
            $this->doSuccess(array('borrow' => $borrow));
        } catch (Exception $e) {
            $this->doFailed('服务器出现错误,请稍后在试');
        }
    }
    
    public function borrowByBook()
    {
            $user = $this->getUser();
    
        try {
            $borrow = M('borrow')->field('borrow.id,bookname,borrowTime,backTime,rental')->join('bookinfo ON borrow.bookid =bookinfo.id')->where(array(
                'borrow.userid' => $user['id'],
                'ifback' => 1,
            ))->select();
            $this->doSuccess(array('borrow' => $borrow));
        } catch (Exception $e) {
            $this->doFailed('服务器出现错误,请稍后在试');
        }
    }
}