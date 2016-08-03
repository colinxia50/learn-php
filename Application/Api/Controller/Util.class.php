<?php
namespace Api\Controller;

use Think\Controller;


include_once 'ServicesJSON.class.php';


class Util
{
	
	public static function getPhotoByUid($url,$sex='')
	{
// 		if(empty($url)) return '';
		if(!$sex)
		{
			$sex=1;
		}
		
		if($url && file_exists(DATA.$url))
		{
			return DATA_URL.$url;
 		}else
 		{
 			if($sex==1) return P_M;
 			if($sex==2) return P_F;
 		}
 		
 		return P_M;
	}

	
	public static  function getRealPath($url)
	{
		if(empty($url)) return DEFAULT_PIC;
		if(file_exists(DATA.$url))
		{
			return DATA_URL.$url;
		}
		return DEFAULT_PIC;
	}
	
	public static function getAge( $age)
	{
		if(is_int($age))
		{
			$year_b=date("Y",$age);
			$year_n=date("Y",time());
				
			return ($year_n-$year_b)+1;
		}else if(is_string($age))
		{
			$year_b=date("Y",strtotime($age));
			$year_n=date("Y",time());
			
			return ($year_n-$year_b)+1;
		}
		
		return 0;
	}
	
	public static function getSaveString($name)
	{
		return (isset($_REQUEST[$name])) ? trim($_REQUEST[$name]) : '';
	}
	
	public static function getSaveInteger($name)
	{
		return (isset($_REQUEST[$name])) ? intval($_REQUEST[$name]) : 0;
	}
	
	public static function IsNull($arr,$options='')
	{
		$r=0;
		if(is_array($arr))
		{
			foreach ($arr as $v)
			{
				$r=self::IsNull($v,$options);
				if($r!=1)
				{
					return $r;
				}
			}
				
		}elseif(is_string($arr))
		{
			if($options=='int')
			{
				if(!intval(@$_REQUEST[$arr]))
				{
					if(property_exists("ErrorCode", $arr))
					{
						return ErrorCode::${$arr};
					}else
					{
						
					}
					return array('code' => -1, 'msg' => " $arr is not int",'data' => array());
				}
				
				
			}
			elseif(!@$_REQUEST[$arr])
			{
				if(property_exists("ErrorCode", $arr))
				{
					return ErrorCode::${$arr};
				}else
				{
					return array('code' => -1, 'msg' => " $arr is null",'data' => array());
				}
			}
			return  1;
		}
	}
	
	/**
	 * utf8 trim
	 * @return type
	 */
	public static function utf8Trim($str)
	{
		$hex='';
		$len = strlen($str);
		for ($i = $len - 1; $i >= 0; $i--)
		{
			$hex .= ' ' . ord($str[$i]);
			$ch = ord($str[$i]);
			if (($ch & 128) == 0)
			{
				return substr($str, 0, $i);
			}
			if (($ch & 192) == 192)
			{
				return substr($str, 0, $i);
			}
		}
		return($str . $hex);
	}
	
	/**
	 *获取新的字符串，按一定长度截取
	 * @param String $str
	 * @param int  $length
	 * @param String $dot
	 * @param String $charset
	 * @return String
	 */
	public static function str($str, $length, $dot = '...', $charset = 'utf-8')
	{
		if ($length && strlen($str) > $length)
		{
			if ('utf-8' != $charset)
			{
				$retstr = '';
				for ($i = 0; $i < $length - 2; $i++)
				{
					$retstr .= ord($str[$i]) > 127 ? $str[$i] . $str[++$i] : $str[$i];
				}
				return $retstr . $dot;
			}
			return self::utf8Trim(substr($str, 0, $length)) . $dot;
		}
		return $str;
	}
	
	public static function nullToString($var)
	{
		$result=array();
		
		if(is_array($var)){
			$data=array();
			foreach ($var as $key=>$v){
				$data[$key]=Util::nullToString($v);
			}
			return $data;
		}else{
			return is_null($var)?" ":(string)$var;
		}
	}


	public static function getThumb($url,$width=100,$height=100)
	{
		if(empty($url)) return " ";
		$ext = strtolower(substr(strrchr($url, '.'), 1)); //获取图片类型
		
		$new_path=$url.$width."_".$height.".".$ext;
		$thumb=self::getRealPath($new_path);
		empty($thumb) && $a=JJImage::make_thumb(DATA.$url,DATA.$url.$width."_".$height,$width,$height);
		return self::getRealPath($new_path);
	}
	
	
	private static  function rad($d)
	{
		return $d* 3.1415926 / 180.0;
	}
	
	/**
	 * 距离计算
	 * @param unknown_type $lat1
	 * @param unknown_type $lng1
	 * @param unknown_type $lat2
	 * @param unknown_type $lng2
	 * @return number
	 */
	public static function getDistance($lat1, $lng1, $lat2, $lng2)
	{
		$radLat1 = Util::rad($lat1);
		$radLat2 = Util::rad($lat2);
		$a = $radLat1 - $radLat2;
		$b = Util::rad($lng1) - Util::rad($lng2);
	
		$s = 2 * Asin(Sqrt(Pow(Sin($a/2),2) + Cos($radLat1)*Cos($radLat2)*Pow(Sin($b/2),2)));
	
		$s = $s * 6378.137;
		$s = Round($s * 10000) / 10000;
		return $s;
	}
	

	/**
	 *计算某个经纬度的周围某段距离的正方形的四个点
	 *
	 *@param lng float 经度
	 *@param lat float 纬度
	 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为5千米
	 *@return array 正方形的四个点的经纬度坐标
	 */
	
	public static function returnSquarePoint($lng, $lat,$distance = 5)
	{
		$dlng =  2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));
		$dlng = rad2deg($dlng);
		 
		$dlat = $distance/EARTH_RADIUS;
		$dlat = rad2deg($dlat);
		return array(
				'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
				'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
				'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
				'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
		);
	}
	
	/**
	 * 
	 * @param unknown_type $timeInt
	 * @param unknown_type $format
	 * @return string
	 */
	public static function timeFormat($timeInt,$format='Y-m-d H:i:s'){
		if(empty($timeInt)||!is_numeric($timeInt)||!$timeInt){
			return '';
		}
		
		$d=time()-$timeInt;
		if($d<0){
			return '';
		}else{
			if($d<60){
				return $d.'秒前';
			}else{
				if($d<3600){
					return floor($d/60).'分钟前';
				}else{
					if($d<86400){
						return floor($d/3600).'小时前';
					}else{
						if($d<259200){//3天内
							return floor($d/86400).'天前';
						}else{
							return date($format,$timeInt);
						}
					}
				}
			}
		}
	}
	
	/**
	 * 生成随机数
	 */
	
	static public function randString($len=4,$type='1',$addChars='') {
        $str ='';
        switch($type) {
            case 0:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 1:
                $chars= str_repeat('0123456789',3);
                break;
            case 2:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
                break;
            case 3:
                $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 4:
                $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
                break;
            default :
                // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
                break;
        }
        if($len>10 ) {//位数过长重复字符串一定次数
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
        }
        if($type!=4) {
            $chars   =   str_shuffle($chars);
            $str     =   substr($chars,0,$len);
        }else{
            // 中文随机字
            for($i=0;$i<$len;$i++){
              $str.= self::msubstr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1,'utf-8',false);
            }
        }
        return $str;
    }
    
    
    /**
     * 将子数组的某个元素 更改为子元素数组在父数组的 key
     */
    static function arrayUtileTOFormat($array,$clumn)
    {
    	if($array)
    	{
    		$List  = array();
    		
    		foreach ($array as $vl)
    		{
    			$List[$vl[$clumn]] = $vl;
    		}
    		
    		return $List;
    	}else
    	{
    		return $array;
    	}
    }

	static function http_get($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
}