<?php
namespace Org\Util;

//工具类
class Tool{
    	
	
	//表单选项转换
	static public function setFormItem($_data, $_key, $_value) {
	    $_items = array();
	    if (is_array(($_data))) {
	        foreach ($_data as $_v) {
	            $_items[$_v[$_key]] = $_v[$_value];
	        }
	    }
	    return $_items;
	}
	
	//字符串截取
	static public function subStr(&$_object,$_field,$_length,$_encoding) {
	    
	    if ($_object) {
	        if (is_array($_object)) {
	            foreach ($_object as $_value) {
	                if (mb_strlen($_value[$_field],$_encoding) > $_length) {
	                    $_value[$_field] = mb_substr($_value[$_field],0,$_length,$_encoding).'...';
	                }
	            }
	        } else {
	            if (mb_strlen($_object,$_encoding) > $_length) {
	                return mb_substr($_object,0,$_length,$_encoding).'...';
	            } else {
	                return $_object;
	            }
	        }
	    }
	}

}



?>