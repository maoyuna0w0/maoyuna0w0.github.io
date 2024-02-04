version=1
target="https://sharechain.qq.com/36e88405300762a1fcdf52f399b818c9"
sh_name1=$(basename "$0" .sh)
sh_name2=$(basename "$0" sh)
sh_name3=$(basename "$0" h)
update(){
url=$(curl -s $target)
url1=${url/%"[版本尾]"*/}
url2=$(echo ${url1/*"[版本头]"/})
url3=${url2//'<div>'/}
url4=${url3//'</div>'/}
url1=${url/%"[日志尾]"*/}
url2=$(echo ${url1/*"[日志头]"/})
url3=${url2//'<div>'/}
url5=${url3//'</div>'/}
url6=${url5//"[换行]"/"\n"}
if [ $url4 = $version ]
then
echo "当前为最新版本喵！"
else
echo "当前版本与最新版本不一致！请更新喵！"
echo "当前版本:"$version
echo "最新版本:"$url4
echo "更新日志:"$url6
exit
fi
}
network()
{
    #超时时间
    local timeout=1
    #获取响应状态码
    local ret_code=`curl -I -s --connect-timeout ${timeout} ${target} -w %{http_code} | tail -n1`

    if [ "x$ret_code" = "x200" ]; then
        #网络畅通
        return 1
    else
        #网络不畅通
        return 0
    fi
    return 0
}
miao(){
echo "正在获取信息...请稍等喵"
network
if [ $? -eq 0 ];then
	echo "获取失败喵！请检查网络后重试喵！"
	exit
fi
update
url1=${url/%"[公告尾]"*/}
url2=$(echo ${url1/*"[公告头]"/})
url3=${url2//'<div>'/}
url4=${url3//'</div>'/}
echo ${url4//"[换行]"/"\n"}
}
miao0(){
url1=${url/%"[开关尾]"*/}
url2=$(echo ${url1/*"[开关头]"/})
url3=${url2//'<div>'/}
url4=${url3//'</div>'/}
if [ $url4 = "关" ]
then
echo "本脚本暂时停止运行喵！"
exit
else
echo "欢迎使用本脚本！"
fi
}
miao3(){
if [ $aa1 ] || [ $aa2 ] || [ $aa3 ]
then
echo "正在修改喵..."
for file in `ls *$aa1`
do
    if [ $a1 = 1 ]
    then
    mv $file ${file%$aa1}$aa2
    elif [ $a1 = 2 ]
    then
    sed -i 's/'$aa2/$aa3'/g' "$file"
    fi
done
else
echo "你玩我呢喵！这不是什么都没改吗？！"
exit
fi
}
miao6(){
   if [ $aa1 = ".sh" ]
   then
   sed -i 's/'$aa3/$aa2'/g' $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 = "sh" ]
   then
   sed -i 's/'$aa3/$aa2'/g' $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 = "h" ]
   then
   sed -i 's/'$aa3/$aa2'/g' $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 ]
   then
   echo "修改完成喵！"
   else
   sed -i 's/'$aa3/$aa2'/g' $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   fi
}

miao5(){
   if [ $aa1 = ".sh" ]
   then
   mv $sh_name1$aa2 $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 = "sh" ]
   then
   mv $sh_name2$aa2 $sh_name2"sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 = "h" ]
   then
   mv $sh_name3$aa2 $sh_name3"h"
   echo "检测到可能修改了sh文件，已恢复喵！"
   elif [ $aa1 ]
   then
   echo "修改完成喵！"
   else
   mv $sh_name1".sh"$aa2 $sh_name1".sh"
   echo "检测到可能修改了sh文件，已恢复喵！"
   fi
}
miao2(){
if [ $a1 = 1 ]
then
echo "输入你想修改的原文件后缀（为空则直接在所有文件后面添加后缀）"
read aa1
echo "输入你想修改的后缀（为空则删除上一个输入的后缀）"
read aa2
elif [ $a1 = 2 ]
then
echo "输入你想修改的文件名或后缀（为空则为所有文件）"
read aa1
echo "输入你想替换的原文本（不能为空）"
read aa2
echo "输入你想替换后的文本（为空则为删除）"
read aa3
else
echo "你这选了个什么喵！"
exit
fi
}
miao4(){
if [ $a1 = 1 ]
then
miao5
elif [ $a1 = 2 ]
then
miao6
fi
}
miao1(){
echo "功能列表:"
echo "1.批量修改文件名"
echo "2.批量修改文件内文本"
echo "请选择功能[1-2]"
read a1
}

echo "是否离线运行"
echo "1.否"
echo "2.是"
echo "请选择[1-2]"
read www
if [ $www = 2 ]
then
 miao1
 miao2
 miao3
 miao4
elif [ $www = 1 ]
then
 miao
 miao0
 miao1
 miao2
 miao3
 miao4
else
 echo "你这选了个什么喵！"
fi