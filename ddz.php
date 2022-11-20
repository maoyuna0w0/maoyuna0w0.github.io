<?php 
header("Content-type: text/html; charset=utf-8");
header("Content-Type:text/json");
header('content-type:image/*');

date_default_timezone_set('prc');


$msg=$_GET[msg];
$qq=$_GET[qq];
$nick=$_GET[nick];
$group=$_GET[group];

$mrlj = "ddz/$group";
$time = date("Y-m-d H:i:s");

function dwj($dqlj,$dqwj,$mrz){
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
  $fp = fopen("$DOCUMENT_ROOT/$dqlj/$dqwj",'r');//打开文件
  if(file_exists("$DOCUMENT_ROOT/$dqlj/$dqwj")){//当文件存在时，才读取内容
    //while(!feof($fp)){//判断文件指针是否到达末尾
      //$c = fgetc($fp);//每执行一次fgetc()，文件指针就向后移动一位
      //$dqwj=$dqwj.$c;//输出获取到的字节
    //}
    $mrz = fgets($fp);//读取一行字节
  }
  fclose($fp);//关闭文件
  return $mrz;
}

function xwj($xrlj,$xrwj,$xrz){
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
  mkdir(iconv("UTF-8","GBK","$DOCUMENT_ROOT/$xrlj"),0777,true);
  $fp = fopen("$DOCUMENT_ROOT/$xrlj/$xrwj",'w');
  fwrite($fp,$xrz);
  fclose($fp);
}

function deldir($dir) {
   $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
   //先删除目录下的文件：
   $dh=opendir("$DOCUMENT_ROOT/$dir");
   while ($file=readdir($dh)) {
      if($file!="." && $file!="..") {
         $fullpath=$dir."/".$file;
         if(!is_dir($fullpath)) {
            unlink($fullpath);
         } else {
            deldir($fullpath);
         }
      }
   }
 
   closedir($dh);
   //删除当前文件夹：
   if(rmdir($dir)) {
      return true;
   } else {
      return false;
   }
}


function jssj($lssj,$dqsj,$xcrq){
  // 指定两个日期，转换为 Unix 时间戳
  $date1 = strtotime($dqsj); 
  $date2 = strtotime($lssj);
  $diff= $date1 - $date2;
  $days =abs(round($diff / $xcrq));
  return $days;
}

function px($msg){
  $len = strlen($msg);
  $cp = str_split($msg);
  /* 数组转字符串
  $cppd = array("3","4","5","6","7","8","9","B","J","Q","K","A","2","G","W");
  $string = implode($cppd);
  */
  $string = "3456789BJQKA2GW";
  $cplx = array();
  for($x=0;$x<$len;$x++){
    $cplx[] = strpos($string,$cp[$x]);
  }
  if(preg_match("/[0-9]/",implode($cplx))=="1"){
    if($len == 1){
      return "1";
      //echo "单";
    }else{//不是单的情况
      if($len == 2){
        if($cplx[0] == $cplx[1]){
          return "2";
          //echo "双";
        }
      }else{//不是双的情况
        if($len == 3){//判断三张，不带的情况
          if($cplx[0] == $cplx[1] & $cplx[1] == $cplx[2]){
            return "3";
            //echo "三张";
          }
        }else{//不是三张
          if($len == 4){//判断四张相等
            if( $cplx[0] == $cplx[1] & $cplx[1] == $cplx[2] & $cplx[2] == $cplx[3] ){
              return "4";
              //echo "炸弹";
            }else{//四张不相等
              if( $cplx[0] == $cplx[1] & $cplx[1] == $cplx[2] ){//三张相等
                return "31";
                //echo "三带一";
              }else{//三张不相等
                if( $cplx[0] == $cplx[1] & $cplx[2] == $cplx[3] ){
                  if( $cplx[0] < 11){//第一张小于A
                    if( $cplx[0] + 1 == $cplx[2] ){//连对
                      return "22";
                      //echo "连对";
                    }
                  }
                }
              }
            }
          }else{//不是四张牌
            if($len < 21){
              if($len % 5 == 0 & $len / 5 > 1){
                $a = $len / 5;
                $i = false;
                for($y = 0;$y < ($a - 1);$y++){
                  $g = $y * 3;
                  $f = ($y + 1) * 3;
                  if($cplx[$g] + 1 == $cplx[$f]){
                    $i = true;
                  }else{
                    $i = false;
                    break;
                  }
                }//循环检测是否连续
                if($i){//判断结果
                  for($x = 0;$x < ($a - 1);$x++){
                    $h = $x * 3;
                    $b = $x * 3 + 1;
                    $c = $x * 3 + 2;
                    $d = $a * 3 + $x * 2;
                    $e = $a * 3 + $x * 2 + 1;
                    if($cplx[$h] == $cplx[$b] & $cplx[$b] == $cplx[$c] & $cplx[$d] == $cplx[$e]){
                      $i = true;
                    }else{
                      $i = false;
                      break;
                    }
                  }//循环判断是否都是三带二
                  if($i){
                    return "32.$a";
                    //echo "飞机双";
                  }
                }
              }
              if($len % 4 == 0 & $len / 4 > 1){
                $a = $len / 4;
                $i = false;
                for($y = 0;$y < ($a - 1);$y++){
                  $g = $y * 3;
                  $f = ($y + 1) * 3;
                  if($cplx[$g] + 1 == $cplx[$f]){
                    $i = true;
                  }else{
                    $i = false;
                    break;
                  }
                }//循环检测是否连续
                if($i){//判断结果
                  for($x = 0;$x < ($a - 1);$x++){
                    $h = $x * 3;
                    $b = $x * 3 + 1;
                    $c = $x * 3 + 2;
                    if($cplx[$h] == $cplx[$b] & $cplx[$b] == $cplx[$c]){
                      $i = true;
                    }else{
                      $i = false;
                      break;
                    }
                  }//循环判断是否都是三带一
                  if($i){
                    $x = $a * 3;
                    $y = $x + 1;
                    $z = $x + 2;
                    if($cplx[$x] != $cplx[$y] & $cplx[$y] != $cplx[$z] & $cplx[$z] != $cplx[$x]){
                      return "31.$a";
                      //echo "飞机单";
                    }
                  }
                }
              }
              if($len % 3 == 0){
                $a = $len / 3;
                $i = false;
                for($y = 0;$y < ($a - 1);$y++){
                  $g = $y * 3;
                  $f = ($y + 1) * 3;
                  if($cplx[$g] + 1 == $cplx[$f]){
                    $i = true;
                  }else{
                    $i = false;
                    break;
                  }
                }//循环检测是否连续
                if($i){
                  for($x = 0;$x < $a;$x++){
                    $h = $x * 3;
                    $b = $x * 3 + 1;
                    $c = $x * 3 + 2;
                    if($cplx[$h] == $cplx[$b] & $cplx[$b] == $cplx[$c]){
                      $i = true;
                    }else{
                      $i = false;
                      break;
                    }
                  }
                  if($i){
                    return "30.$a";
                    //echo "三连张";
                  }
                }
              }
              if($len <13 & $cplx[0] < (13 - $len)){
                $i = false;
                for($x = 0;$x < ($len - 1);$x++){
                  $y = $x + 1;
                  if($cplx[$x] + 1 == $cplx[$y]){
                    $i = true;
                  }else{
                    $i = false;
                    break;
                  }
                }
                if($i){
                  return $len;
                  //echo "顺子";
                }
              }//判断顺子
              if($len == 5){
                if($cplx[0] == $cplx[1] & $cplx[1] == $cplx[2] & $cplx[3] == $cplx[4]){
                  return "32";
                  //echo "三带二";
                }
              }//不是三带二
              if($len == 6){
                if($cplx[0] == $cplx[1] & $cplx[1] == $cplx[2] & $cplx[2] == $cplx[3]){
                  return "42";
                  //echo "四带二";
                }
              }//不是六张牌
              if($len % 2 == 0 & $cplx[0] < 11){//判断是否连对
                $i = false;
                $a = $len / 2;
                for($x = 0;$x < ($a - 1);$x++){
                  $b = $x *2;
                  $c = ($x + 1) * 2;
                  if($cplx[$b] + 1 == $cplx[$c]){
                    $i = true;
                  }else{
                    $i = false;
                    break;
                  }
                }
                if($i){
                  return "22.$a";
                  //echo "连对";
                }
              }//判断连对
            }//判断出牌数
          }
        }
      }
    }
  }
  return "无";
}

function fp($group,$qqa,$qqb,$qqc){
  $qa = array();
  $qb = array();
  $qc = array();
  //$arr = array(3,3,3,3,4,4,4,4,5,5,5,5,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,9,10,10,10,10,"J","J","J","J","Q","Q","Q","Q","K","K","K","K","A","A","A","A",2,2,2,2,"鬼","王");
  $arr = array(3,3,3,3,4,4,4,4,5,5,5,5,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,9,10,10,10,10,11,11,11,11,12,12,12,12,13,13,13,13,14,14,14,14,15,15,15,15,16,17);
  shuffle($arr);//洗牌
  for($i = 0;$i < 17;$i++){
    $a = $i * 3;
    $b = $a + 1;
    $c = $a + 2;
    $qa[] = $arr[$a];
    $qb[] = $arr[$b];
    $qc[] = $arr[$c];
  }//发牌结束
  $qd = array($arr[51],$arr[52],$arr[53]);//地主牌
  asort($qa);
  asort($qb);
  asort($qc);
  $arra = array(10,11,12,13,14,15,16,17);
  $arrb = array("B","J","Q","K","A",2,"G","W");
  $spa = str_replace($arra,$arrb,$qa);
  $spb = str_replace($arra,$arrb,$qb);
  $spc = str_replace($arra,$arrb,$qc);
  $dz = str_replace($arra,$arrb,$qd);
  //修改对应的牌名
  $sp1 = implode(',',$spa);
  $sp2 = implode(',',$spb);
  $sp3 = implode(',',$spc);
  $sp4 = implode(',',$dz);
  xwj("ddz/$group/game",$qqa,$sp1);
  xwj("ddz/$group/game",$qqb,$sp2);
  xwj("ddz/$group/game",$qqc,$sp3);
  xwj("ddz/$group/game","dzp",$sp4);
  xwj("ddz/$group/game/qq",$qqa,$qqb);
  xwj("ddz/$group/game/qq",$qqb,$qqc);
  xwj("ddz/$group/game/qq",$qqc,$qqa);
  //写入文件
  $arrc = array("B","G","W");
  $arrd = array("10","鬼","王");
  $fpa = str_replace($arrc,$arrd,$spa);
  $fpb = str_replace($arrc,$arrd,$spb);
  $fpc = str_replace($arrc,$arrd,$spc);
  $fp1 = '['.implode('][',$fpa)."]\r\r温馨提示:[鬼]比[王]小";
  $fp2 = '['.implode('][',$fpb)."]\r\r温馨提示:[鬼]比[王]小";
  $fp3 = '['.implode('][',$fpc)."]\r\r温馨提示:[鬼]比[王]小";
  echo '$'."私聊 $group $qqa $fp1".'$'.'$'."私聊 $group $qqb $fp2".'$'.'$'."私聊 $group $qqc $fp3".'$';
  $dzq =array("空",$qqa,$qqb,$qqc);
  $qdz = mt_rand(1,3);
  $qdzq = dwj("ddz/$group/game",$qdz,"0");
  $nicka = dwj("ddz/$group/game/nick",$qdzq,"0");
  xwj("ddz/$group/game/qdz","dqr",$qdzq);
  xwj("ddz/$group/game","sykjp","3");
  xwj("ddz/$group/game","jdz","1");
  echo "当前叫地主玩家为\r\r昵称:$nicka\r号码:$qdzq\r\r是否要叫地主\r\r ps:倒计时为一分半";
}

function dz($group,$qq){
  $xrlj = "ddz/$group/game";
  $dzp = dwj($xrlj,"dzp","0");
  $sp = dwj($xrlj,$qq,"0");
  $time = date("Y-m-d H:i:s");
  $sysp = $dzp.','.$sp;
  $dza = explode(",",$sysp);
  $dza = str_replace(2,22,$dza);
  $arra = array(10,11,12,13,14,15,16,17);
  $arrb = array("B","J","Q","K","A",22,"G","W");
  $dzb = str_replace($arrb,$arra,$dza);
  asort($dzb);
  $dz = str_replace($arra,$arrb,$dzb);
  $dz = str_replace(22,2,$dz);
  $dzp = implode(",",$dz);
  $arrc = array("B","G","W");
  $arrd = array(10,"鬼","王");
  $fpa = str_replace($arrc,$arrd,$dz);
  $fp = '['.implode('][',$fpa).']';
  
  xwj($xrlj,"jdz","3");
  xwj($xrlj,"cpqq",$qq);
  xwj($xrlj,$qq,$dzp);
  xwj($xrlj,"jdz","0");
  xwj($xrlj,"time",$time);
  xwj($xrlj,"dqdz",$qq);
  
  echo '$'."私聊 $group $qq $fp".'$$'."调用 0 <*发*送*地*主*牌*>".'$';
}

function cppd($msg,$group,$qq){
  $pd = false;
  $cp = str_split($msg);
  $string = "3456789BJQKA2GW";
  $cpmin = strpos($string,$cp[0]);
  $sp = dwj("ddz/$group/game",$qq,"0");
  $sp = str_replace("10","B",$sp);
  $sp = str_replace("22","2",$sp);
  $min = dwj("ddz/$group/game","min","-1");
  $len = strlen($msg);
  $sysp = $sp;
  $jlpx = dwj("$mrlj/game","pxjl","无");
  $px = px($msg);
  if($px == $jlpx | $jlpx == "无"){
    if($min < $cpmin){
      for($i = 0;$i<$len;$i++){
        $sppd = $sysp;
        $sysp = preg_replace("/$cp[$i]/","",$sysp,1);
        $sysp = preg_replace("/^,/","",$sysp);
        $sysp = preg_replace("/,$/","",$sysp);
        $sysp = str_replace(",,",",",$sysp);
        if($sysp == $sppd){
          $pd = false;
          break;
        }else{
          $pd = true;
        }
      }
    }else{
      $pd = false;
    }
  }
  if($pd){
    $sp = str_replace(",","",$sp);
    $lan = strlen($sp);
    if($lan != $len){
      $sysp = str_replace("2","22",$sysp);
      xwj("ddz/$group/game",$qq,$sysp);
      xwj("ddz/$group/game","games",$qq);
      xwj("ddz/$group/game","min",$cpmin);
      
      $arra = array(22,"B","G","W");
      $arrb = array(2,10,"鬼","王");
      $sysp = str_replace($arra,$arrb,$sysp);
      $fp = '['.str_replace(",","][",$sysp).']';
      echo '$'."私聊 $group $qq $fp".'$';
    }
  }
  return $pd;
}


$pj = dwj("$mrlj/game","pj","0");
$oldtime = dwj("$mrlj/game","time","0");
if($oldtime != "0"){
  $sj = jssj($oldtime,$time,1);
  $cpqq = dwj("$mrlj/game","cpqq",0);
  
  if($sj > 90){
    $qq = $cpqq;
    xwj("$mrlj/game","time",$time);
    if($pj == "1"){
      
      $xqq = dwj("$mrlj/game/ddz",$cpqq,0);
      $cpnick = dwj("$mrlj/game/nick",$qq,0);
      $xnick = dwj("$mrlj/game/nick",$xqq,0);
      $jdz = dwj("$mrlj/game","jdz",0);
      if($jdz == "1"){
        xwj("$mrlj/game","cpqq",$xqq);
        echo "@$cpnick\r指令超时自动判定为不叫\r\r@$xnick\r是否叫地主";
      }
      if($jdz == "2"){
        xwj("$mrlj/game","cpqq",$xqq);
        echo "@$cpnick\r指令超时自动判定为不抢\r\r@$xnick\r是否抢地主";
      }
      if($jdz == "3"){
        $sqq = dwj("$mrlj/game","games","0");
        if($sqq != "0"){//判定出牌人是不是第一个
          xwj("$mrlj/game","time",$time);
          xwj("$mrlj/game","key","0");
          $xqq = dwj("$mrlj/game/ddz",$qq,"0");
          if($xqq == $sqq){
            xwj("$mrlj/game","pxjl","无");
            xwj("$mrlj/game","min","-1");
            xwj("$mrlj/game","games","0");
          }
          xwj("$mrlj/game","cpqq",$xqq);
          $xnick = dwj("$mrlj/game/nick",$xqq,"无");
          echo "@$cpnick\r指令超时自动判定为不要\r\r@$xnick\r请出牌";
        }else{
          $qq = $cpqq;
          $dz = dwj("$mrlj/game","dqdz","0");
          $qp = dwj("$mrlj/game","qp","0");
          $bs = dwj("$mrlj/game","bs","1") * 100;
          xwj("$mrlj/game","time",$time);
          xwj("$mrlj/game","key","0");
          if($qp == "0"){
            $qqb = dwj("$mrlj/game/ddz",$qq,"0");
            $qqc = dwj("$mrlj/game/ddz",$qqb,"0");
            $nickb = dwj("$mrlj/game/nick",$qqb,"无");
            $nickc = dwj("$mrlj/game/nick",$qqc,"无");
            $jfa = dwj("$mrlj/jf",$qq,"0");
            if($dz == $qq){
              $jfb = dwj("$mrlj/jf",$qqb,"0");
              $jfc = dwj("$mrlj/jf",$qqc,"0");
              $jfa = $jfa - $bs - 1000;
              xwj("$mrlj/jf",$qq,$jfa);
              $pmf = $bs / 2;
              $jfb = $jfb + $pmf;
              xwj("$mrlj/jf",$qqa,$jfb);
              $jfc = $jfc + $pmf;
              xwj("$mrlj/jf",$qqb,$jfc);
              deldir("$mrlj/game");
              echo "由于地主出牌超时,所以农民获得胜利\r出牌超时扣除1000积分\r\r@$nick\r剩余积分:$jfa\r\r@$nickb\r剩余积分:$jfb\r\r@$nickc\r剩余积分:$jfc";
            }else{
              $jfa = $jfa - 1000;
              xwj("$mrlj/jf",$qq,$jfa);
              xwj("$mrlj/game","qp",$qq);
              xwj("$mrlj/game/ddz",$qq,"0");
              xwj("$mrlj/game/ddz",$qqb,$qqc);
              xwj("$mrlj/game/ddz",$qqc,$qqb);
              echo "@$nick\r出牌超时扣除1000积分\r\r@$nickb\r请出牌";
            }
          }else{
            $qqa = dwj("$mrlj/game/ddz",$qq,"0");
            $nicka = dwj("$mrlj/game/nick",$qqa,"无");
            $nickq = dwj("$mrlj/game/nick",$qp,"无");
            $bs = dwj("$mrlj/game","bs","1") * 100;
            $jf = dwj("$mrlj/jf",$qq,"0");
            $jfa = dwj("$mrlj/jf",$qqa,"0");
            $jfq = dwj("$mrlj/jf",$qp,"0");
            if($qq == $dz){
              $jf = $jf - $bs -1000;
              $jfa = $jfa + $bs;
              xwj("$mrlj/jf",$qq,$jf);
              xwj("$mrlj/jf",$qqa,$jfa);
              deldir("$mrlj/game");
              echo "@$nick\r地主出牌超时扣除1000积分\r农民获得胜利✌🏻\r\r\r@$nick\r剩余积分:$jf\r\r@$nicka\r剩余积分:$jfa\r\r@$nickq\r剩余积分:$jfq";
            }else{
              $jfa = $jfa + $bs;
              $pmf = $bs / 2;
              $jf = $jf - $pmf - 1000;
              $jfq = $jfq - $pmf;
              xwj("$mrlj/jf",$qq,$jf);
              xwj("$mrlj/jf",$qqa,$jfa);
              xwj("$mrlj/jf",$qp,$jfq);
              deldir("$mrlj/game");
              echo "@$nick\r出牌超时扣除1000积分\r农民全部弃牌,地主胜利\r\r@$nick\r剩余积分:$jf\r\r@$nicka\r剩余积分:$nicka\r\r@$nickq\r剩余积分:$jfq";
            }
          }
          return;
        }
        
      }
    }else{
      deldir("$mrlj/game");
      echo "由于时间加入牌局时间超过90秒，所以牌桌失效，已扣除的积分不归还";
      return;
    }
  }
  if($sj >= 60){
    $key = dwj("$mrlj/game","key","0");
    if($key == "0"){
      xwj("$mrlj/game","key","1");
      $sysj = 90 - $sj;
      echo "斗地主决策时间还剩:$sysj 秒";
    }
  }
}


if($msg == "斗地主"){
  echo "斗地主\r游戏规则\r每日积分\r积分查询\r游戏指令";
}

if($msg == "游戏规则"){
  echo "¸斗地主游戏规则¸\r每次游戏底分为 100 \r加入牌桌立即扣除100积分\r开始游戏发送:加入牌局\r等待游戏人数达到3人后立即开始游戏\r\r游戏指令如下\r当第一人发送\"叫地主\"后其他人要抢地主的话发送:\"抢地主\"\r出牌过程中发送:出**\r如:出33\r中间不需要空格和其他符号\r出牌请根据牌型按从小到大顺序\r如:出5553(牌型为三带一)\r不跟牌发送:不要\r\r如果你不想玩了发送:弃牌\r\r ps:弃牌了不能返回牌桌\r\rpps:游戏时间统一90秒。";
}

if($msg == "游戏指令"){
  echo "¸斗地主游戏所有指令¸\r斗地主\r游戏规则\r游戏指令\r每日积分\r积分查询\r加入牌局\r叫地主\r抢地主\r不叫\r不抢\r出**\r弃牌";
}

if($msg == "每日积分"){
  $mrjf = dwj("$mrlj/qd",$qq,"0");
  $rq = date("d");
  if($mrjf == $rq){
    echo "@$nick\r你已领取每日积分";
  }else{
    $syjf = dwj("$mrlj/jf",$qq,"0");
    if($syjf > 50000){
      echo "@$nick\r你的剩余积分已经超过五万";
    }else{
      $jf = $syjf + 2000;
      xwj("$mrlj/qd",$qq,$rq);
      xwj("$mrlj/jf",$qq,$jf);
      echo "@$nick\r成功领取每日积分2000\r当前剩余积分:$jf";
    }
  }
}

if($msg == "积分查询"){
  $jf = dwj("$mrlj/jf",$qq,"0");
  echo "@$nick\r当前积分剩余:$jf";
}

$pj = dwj("$mrlj/game","pj","0");

if($msg == "加入牌局"){
  if($pj == "1"){
    echo "@$nick\r牌局已经开始\r请等待牌局结束";
  }else{
    $jf = dwj("$mrlj/jf",$qq,"0");
    if($jf >= 1000){
      $rya = dwj("$mrlj/game","1","0");
      $ryb = dwj("$mrlj/game","2","0");
      if($rya != $qq & $ryb != $qq){
        $rs = dwj("$mrlj/game","rs","1");
        if($rs == "1"){
          xwj("$mrlj/game","time",$time);
        }
        $syjf = $jf - 100;
        xwj("$mrlj/jf",$qq,$syjf);
        xwj("$mrlj/game",$rs,$qq);
        xwj("$mrlj/game/nick",$qq,$nick);
        if($rs == "3"){
          xwj("$mrlj/game","pj","1");
          xwj("$mrlj/game/ddz",$rya,$ryb);
          xwj("$mrlj/game/ddz",$ryb,$qq);
          xwj("$mrlj/game/ddz",$qq,$rya);//记录该人后面是谁
          xwj("$mrlj/game","time",$time);
          xwj("$mrlj/game","key","0");
          echo "斗地主牌局开始\r";
          fp($group,$rya,$ryb,$qq);
        }else{
          $rss = $rs + 1;
          xwj("$mrlj/game","rs",$rss);
          $hxrs = 3 - $rs;
          echo "@$nick\r加入牌局成功，当前还需要 $hxrs 人\r已扣除100积分";
        }
      }else{
        echo "@$nick\r你已经加入了。请等待游戏开始";
      }
    }else{
      echo "@$nick\r你的剩余积分不足1000\r加入失败";
    }
  }
}

if($msg == "叫地主"){
  if($pj == "1"){
    $jdz = dwj("$mrlj/game","jdz","0");
    if($jdz == "1"){
      $dqqq = dwj("$mrlj/game/qdz","dqr","0");
      if($dqqq == $qq){
        $sykjp = dwj("$mrlj/game","sykjp","3");
        xwj("$mrlj/game","bs","1");
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        if($sykjp == "1"){
          dz($group,$qq);
          
          echo "@$nick\r\r叫地主\r你是当前地主\r请出牌👊";
        }else{
          xwj("$mrlj/game","dqdz",$qq);
          xwj("$mrlj/game","jdz","2");
          $xqq = dwj("$mrlj/game/ddz",$qq,"0");
          xwj("$mrlj/game/qdz","dqr",$xqq);
          $zg = dwj("$mrlj/game/dz",$xqq,"1");
          if($zg == "0"){
            $xqq = dwj("$mrlj/game/ddz",$xqq,"0");
          }
          $xnick = dwj("$mrlj/game/nick",$xqq,"0");
          
          echo "@$nick\r叫地主\r\r@$xnick\r是否要抢地主\r倒计时:90s";
        }
      }
    }
  }
}

if($msg == "不叫"){
  if($pj == "1"){
    $jdz = dwj("$mrlj/game","jdz","0");
    if($jdz == "1"){
      $dqqq = dwj("$mrlj/game/qdz","dqr","0");
      if($dqqq == $qq){
        $sykjp = dwj("$mrlj/game","sykjp","0");
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        if($sykjp == "1"){
          $qqa = dwj("$mrlj/game/ddz",$qq,"0");
          $qqb = dwj("$mrlj/game/ddz",$qqa,"0");
          echo "由于当前没有人叫地主,所以重新发牌\r\r";
          fp($group,$qq,$qqa,$qqb);
        }else{
          $sykjp = $sykjp - 1;
          xwj("$mrlj/game","sykjp",$sykjp);
          xwj("$mrlj/game/dz",$qq,"0");
          $xqq = dwj("$mrlj/game/ddz",$qq,"0");
          $xnick = dwj("$mrlj/game/nick",$xqq,"0");
          xwj("$mrlj/game/qdz","dqr",$xqq);
          
          echo "@$nick\r不叫地主\r\r@$xnick\r是否叫地主";
        }
      }
    }
  }
  
}

if($msg == "抢地主"){
  if($pj == "1"){
    $jdz = dwj("$mrlj/game","jdz","0");
    if($jdz == "2"){
      $dqqq = dwj("$mrlj/game/qdz","dqr","0");
      if($dqqq == $qq){
        $sykjp = dwj("$mrlj/game","sykjp","0");
        $bs = dwj("$mrlj/game","bs","1");
        $bs = $bs * 2;
        xwj("$mrlj/game","bs",$bs);
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        if($sykjp == "1"){
          dz($group,$qq);
          
          echo "@$nick\r\r抢地主\r你是当前地主\r请出牌👊";
        }else{
          $syjp = $sykjp - 1;
          xwj("$mrlj/game","sykjp",$syjp);
          $xqq = dwj("$mrlj/game/ddz",$qq,"0");
          $zg = dwj("$mrlj/game/dz",$xqq,"1");
          $xnick = dwj("$mrlj/game/nick",$xqq);
          if($zg != "1"){
            $xqq = dwj("$mrlj/game/ddz",$xqq,"0");
            $xnick = dwj("$mrlj/game/nick",$xqq,"0");
          }
          xwj("$mrlj/game","dqdz",$qq);
          xwj("$mrlj/game/qdz","dqr",$xqq);
          xwj("$mrlj/game","time",$time);
          xwj("$mrlj/game","key","0");
          
          echo "@$nick\r抢地主\r\r@$xnick\r是否要抢地主\r倒计时:90s";
        }
      }
    }
  }
}

if($msg == "不抢"){
  if($pj == "1"){
    $jdz = dwj("$mrlj/game","jdz","0");
    if($jdz == "2"){
      $dqqq = dwj("$mrlj/game/qdz","dqr","0");
      if($dqqq == $qq){
        $sykjp = dwj("$mrlj/game","sykjp","0");
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        $dzqq = dwj("$mrlj/game","dqdz","0");
        if($sykjp == "1"){
          dz($group,$dzqq);
          $nicka = dwj("$mrlj/game/nick",$dzqq,"0");
          echo "@$nicka\r\r你是当前地主\r请出牌👊";
        }else{
          
          $sykjp = $sykjp - 1;
          xwj("$mrlj/game","sykjp",$sykjp);
          xwj("$mrlj/game/dz",$qq,"0");
          $xqq = dwj("$mrlj/game/ddz",$qq,"0");
          $zg = dwj("$mrlj/game/dz",$xqq,"1");
          if($zg == "0"){
            $xqq = dwj("$mrlj/game/ddz",$xqq,"0");
            $zg = dwj("$mrlj/game/dz",$xqq,"1");
          }
          if($zg = "0"){
            dz($group,$dzqq);
            $nicka = dwj("$mrlj/game/nick",$dzqq,"0");
            echo "@$nicka\r\r你是当前地主\r请出牌👊";
          }else{
            $xnick = dwj("$mrlj/game/nick",$xqq,"0");
            xwj("$mrlj/game/qdz","dqr",$xqq);
            echo "@$nick\r不抢地主\r\r@$xnick\r是否抢地主";
          }
        }
      }
    }
  }
}

if(preg_match("/^出./",$msg)=="1"){
  if($pj == "1"){
    $cpqq = dwj("$mrlj/game","cpqq","0");
    if($cpqq == $qq){
      $msg = str_replace("出","",$msg);
      $msg = str_replace("10","B",$msg);
      $msg = str_replace("鬼","G",$msg);
      $msg = str_replace("王","W",$msg);
      $len = strlen($msg);
      $px = px($msg);
      $jlpx = dwj("$mrlj/game","pxjl","无");
      $sp = dwj("$mrlj/game",$qq,"0");
      $cd = dwj("$mrlj/game","long","0");
      $sp = str_replace("22","2",$sp);
      $sp = str_replace(",","",$sp);
      $lan = strlen($sp);
      $pd = false;
      $pd = cppd($msg,$group,$qq);
      if($pd){
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        if($lan == $len){
          $bs = dwj("$mrlj/game","bs","1") * 100;
          $dz = dwj("$mrlj/game","dqdz","0");
          $qqa = dwj("$mrlj/game/qq",$dz,"0");
          $qqb = dwj("$mrlj/game/qq",$qqa,"0");
          $qpq = dwj("$mrlj/game","qp","0");
          $jfa = dwj("$mrlj/jf",$dz,"0");
          $jfb = dwj("$mrlj/jf",$qqa,"0");
          $jfc = dwj("$mrlj/jf",$qqb,"0");
          $nicka = dwj("$mrlj/game/nick",$dz,"无");
          $nickb = dwj("$mrlj/game/nick",$qqa,"无");
          $nickc = dwj("$mrlj/game/nick",$qqb,"无");
          $nickd = dwj("$mrlj/game/nick",$qpq,"无");
          $jg = "无";
          if($dz == $qq){//判定最后一张牌是否是地主出的
            if($qpq == "0"){
              $jfa = $jfa + $bs;
              xwj("$mrlj/jf",$dz,$jfa);
              $pmf = $bs / 2;
              $jfb = $jfb - $pmf;
              xwj("$mrlj/jf",$qqa,$jfb);
              $jfc = $jfc - $pmf;
              xwj("$mrlj/jf",$qqb,$jfc);
              $jg = "地主胜利\r$nicka \r当前剩余:$jfa 积分\r\r$nickb \r当前剩余:$jfb 积分\r\r$nickc \r当前剩余$jfc 积分";
            }else{
              if($qpq == $qqa){
                $jfa = $jfa + $bs;
                xwj("$mrlj/jf",$dz,$jfa);
                $jfb = $jfb - $bs ;
                xwj("$mrlj/jf",$qqa,$jfb);
                $jg = "地主胜利\r$nicka \r当前剩余:$jfa 积分\r\r$nickb \r当前剩余:$jfb 积分\r\r$nickc \r当前剩余$jfc \r\r由于\r$nickd \r弃牌，所以\r$nickc \r不扣积分";
              }else{
                $jfa = $jfa + $bs;
                xwj("$mrlj/jf",$dz,$jfa);
                $jfc = $jfc - $bs ;
                xwj("$mrlj/jf",$qqb,$jfc);
                $jg = "地主胜利\r$nicka \r当前剩余:$jfa 积分\r\r$nickb \r当前剩余:$jfb 积分\r\r$nickc \r当前剩余$jfc \r\r由于\r$nickd \r弃牌，所以\r$nickb \r不扣积分";
              }
            }
          }else{
            if($qpq == "0"){
              $jfa = $jfa - $bs;
              xwj("$mrlj/jf",$qq,$jfa);
              $jfb = $jfb + ($bs / 2);
              xwj("$mrlj/jf",$qqa,$jfb);
              $jfc = $jfc + ($bs / 2);
              xwj("$mrlj/jf",$qqb,$jfc);
              $jg = "农民胜利\r$nicka \r当前剩余:$jfa 积分\r\r$nickb \r当前剩余:$jfb 积分\r\r$nickc \r当前剩余$jfc 积分";
            }else{
              $jfa = $jfa - $bs;
              xwj("$mrlj/jf",$dz,$jfa);
              $jfd = dwj("$mrlj/jf",$qq,"0");
              $jfd = $jfd + $bs ;
              xwj("$mrlj/jf",$qq,$jfd);
              $jfe = dwj("$mrlj/jf",$qpq,"0");
              $jfe = $jfe - $bs;
              xwj("$mrlj/jf",$qq,$jfe);
              $jg = "农民胜利\r$nicka \r当前剩余:$jfa 积分\r\r$nick \r当前剩余:$jfd 积分\r\r$nickd \r当前剩余$jfe 由于\r$nickd \r弃牌，所以\r$nickd \r扣除当前倍数*100的积分";
            }
          }
          deldir("$mrlj/game");
          echo $jg;
        }else{
          if($px == "4"|$msg == "GW"){
            if($pd){
            $jf = dwj("$mrlj/game","bs",1);
            $xqq = dwj("$mrlj/game/ddz",$qq,"0");
            $xnick = dwj("$mrlj/game/nick",$xqq,"无");
            xwj("$mrlj/game","cpqq",$xqq);
            $jf = $jf * 2;
            xwj("$mrlj/game","bs",$jf);
            xwj("$mrlj/game","pxjl",$px);
            $cp = str_split($msg);
            $cp = str_replace("B","10",$cp);
            $cp = str_replace("G","鬼",$cp);
            $cp = str_replace("W","王",$cp);
            $cp = '['.implode('][',$cp)."]";
            echo "@$nick \r出牌$cp\r\r@$xnick\r是否出牌";
            }else{
            echo "@$nick\r出牌错误，请仔细核对你的手牌";
          }
        }else{
          if($jlpx == "无"){
            if($px == "无"){
              echo "@$nick\r出牌错误。请重新出牌";
            }else{
              if($pd){
                $xqq = dwj("$mrlj/game/ddz",$qq,"0");
                $xnick = dwj("$mrlj/game/nick",$xqq," ");
                xwj("$mrlj/game","cpqq",$xqq);
                xwj("$mrlj/game","pxjl",$px);
                $cp = str_split($msg);
                $cp = str_replace("B","10",$cp);
                $cp = str_replace("G","鬼",$cp);
                $cp = str_replace("W","王",$cp);
                $cp = '['.implode('][',$cp)."]";
                echo "@$nick \r出牌$cp\r\r@$xnick\r是否出牌";
              }else{
                echo "@$nick\r出牌错误,请仔细查看你的手牌a";
              }
            }
          }else{
            if($px == $jlpx){
              if($pd){
                $xqq = dwj("$mrlj/game/ddz",$qq,"0");
                $xnick = dwj("$mrlj/game/nick",$xqq," ");
                xwj("$mrlj/game","cpqq",$xqq);
                xwj("$mrlj/game","pxjl",$px);
                $cp = str_split($msg);
                $cp = str_replace("B","10",$cp);
                $cp = str_replace("G","鬼",$cp);
                $cp = str_replace("W","王",$cp);
                $cp = '['.implode('][',$cp)."]";
                echo "@$nick \r出牌$cp\r\r@$xnick\r是否出牌";
              }else{
                echo "@$nick\r出牌错误,请仔细查看你的手牌b";
              }
            }else{
              echo "@$nick\r出牌错误。请重新出牌";
            }
          }
          }
        }
      }
    }//判断出牌人
  }//判断开局
}

if($msg == "不要"){
  if($pj == "1"){
    $cpqq = dwj("$mrlj/game","cpqq","0");
    if($cpqq == $qq){
      $sqq = dwj("$mrlj/game","games","0");
      if($sqq != "0"){
        xwj("$mrlj/game","time",$time);
        xwj("$mrlj/game","key","0");
        $xqq = dwj("$mrlj/game/ddz",$qq,"0");
        if($xqq == $sqq){
          xwj("$mrlj/game","pxjl","无");
          xwj("$mrlj/game","min","-1");
          xwj("$mrlj/game","games","0");
        }
        xwj("$mrlj/game","cpqq",$xqq);
        $xnick = dwj("$mrlj/game/nick",$xqq,"无");
        echo "@$xnick\r请出牌";
        
      }
    }
  }
}

if($msg == "弃牌"){
  if($pj == "1"){
    $cpqq = dwj("$mrlj/game","cpqq","0");
    if($cpqq == $qq){
      $dz = dwj("$mrlj/game","dqdz","0");
      $qp = dwj("$mrlj/game","qp","0");
      $bs = dwj("$mrlj/game","bs","1") * 100;
      xwj("$mrlj/game","time",$time);
      xwj("$mrlj/game","key","0");
      if($qp == "0"){
        $qqb = dwj("$mrlj/game/ddz",$qq,"0");
        $qqc = dwj("$mrlj/game/ddz",$qqb,"0");
        $nickb = dwj("$mrlj/game/nick",$qqb,"无");
        $nickc = dwj("$mrlj/game/nick",$qqc,"无");
        $jfa = dwj("$mrlj/jf",$qq,"0");
        if($dz == $qq){
          $jfb = dwj("$mrlj/jf",$qqb,"0");
          $jfc = dwj("$mrlj/jf",$qqc,"0");
          $jfa = $jfa - $bs - 1000;
          xwj("$mrlj/jf",$qq,$jfa);
          $pmf = $bs / 2;
          $jfb = $jfb + $pmf;
          xwj("$mrlj/jf",$qqa,$jfb);
          $jfc = $jfc + $pmf;
          xwj("$mrlj/jf",$qqb,$jfc);
          deldir("$mrlj/game");
          echo "由于地主弃牌,所以农民获得胜利\r弃牌扣除1000积分\r\r@$nick\r剩余积分:$jfa\r\r@$nickb\r剩余积分:$jfb\r\r@$nickc\r剩余积分:$jfc";
        }else{
          $jfa = $jfa - 1000;
          xwj("$mrlj/jf",$qq,$jfa);
          xwj("$mrlj/game","qp",$qq);
          xwj("$mrlj/game/ddz",$qq,"0");
          xwj("$mrlj/game/ddz",$qqb,$qqc);
          xwj("$mrlj/game/ddz",$qqc,$qqb);
          echo "@$nick\r弃牌扣除1000积分\r\r@$nickb\r请出牌";
        }
      }else{
        $qqa = dwj("$mrlj/game/ddz",$qq,"0");
        $nicka = dwj("$mrlj/game/nick",$qqa,"无");
        $nickq = dwj("$mrlj/game/nick",$qp,"无");
        $bs = dwj("$mrlj/game","bs","1") * 100;
        $jf = dwj("$mrlj/jf",$qq,"0");
        $jfa = dwj("$mrlj/jf",$qqa,"0");
        $jfq = dwj("$mrlj/jf",$qp,"0");
        if($qq == $dz){
          $jf = $jf - $bs -1000;
          $jfa = $jfa + $bs;
          xwj("$mrlj/jf",$qq,$jf);
          xwj("$mrlj/jf",$qqa,$jfa);
          deldir("$mrlj/game");
          echo "@$nick\r弃牌扣除1000积分\r农民获得胜利✌🏻\r\r\r@$nick\r剩余积分:$jf\r\r@$nicka\r剩余积分:$jfa\r\r@$nickq\r剩余积分:$jfq";
        }else{
          $jfa = $jfa + $bs;
          $pmf = $bs / 2;
          $jf = $jf - $pmf - 1000;
          $jfq = $jfq - $pmf;
          xwj("$mrlj/jf",$qq,$jf);
          xwj("$mrlj/jf",$qqa,$jfa);
          xwj("$mrlj/jf",$qp,$jfq);
          deldir("$mrlj/game");
          echo "@$nick\r弃牌扣除1000积分\r农民全部弃牌,地主胜利\r\r@$nick\r剩余积分:$jf\r\r@$nicka\r剩余积分:$nicka\r\r@$nickq\r剩余积分:$jfq";
        }
      }
    }
  }
}

if($msg == "清除全部数据"){
  if($qq == "1129317309"){
    deldir("ddz");
    echo "清除成功";
  }
}


if(preg_match("/^清除[0-9]/",$msg)=="1"){
  if($qq == "1129317309"){
    $gh = str_replace("清除","",$msg);
    deldir("ddz/$gh");
    echo "清除群号$gh\r清除成功";
  }
}





if($msg == "<*发*送*地*主*牌*>"){
  $dz = dwj("$mrlj/game","dzp","0");
  $arra = array(22,"B","G","W");
  $arrb = array(2,10,"鬼","王");
  $dz = str_replace($arra,$arrb,$dz);
  $dzp = '['.str_replace(",","][",$dz).']';
  
  echo "地主牌为\r$dzp";
}

/*
  
  jf/qq号              每个人的剩余积分
  game/qq号          当前剩余手牌       用 , 分割
  game/dzp           还没分配的地主牌   用 , 分割
  game/nick/qq号      参与人员昵称
  game/cpqq          当前可以出牌的qq
  game/sykjp          判定剩余可以叫(抢)地主次数
  game/jdz            判定叫地主情况 1为可叫地主，2为可抢地主
  game/pj             判定牌局是否开始
  game/qdz/dqr       当前叫(抢)地主的人
  qd/qq号             今日是否领取积分
  game/dqdz          有人叫地主后记录的预备地主
  game/time           用于记录倒计时
  game/ddz/qq号      用于记录下一个人(有人弃牌时替换)
  game/dz/qq号       用于是否可以叫(抢)地主
  game/bs            记录牌局倍数
  game/数字          记录参与第几个参与的qq号
  game/px            记录上一个出牌人的牌型
  game/long          记录上一个出牌的人的张数
  game/min           记录上一个出牌的第一张牌(内容是数字)
  game/games         记录最后一个出牌人的qq
  game/qq/qq号       读取下一个qq
  game/qp            如果有人弃牌。里面记录的是弃牌的qq号
  
*/

?>