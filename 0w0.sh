#!/bin/bash
#以下为代码部分，不懂请不要乱改
#二改请标注来源
#反馈或者提供意见请加作者QQ好友
#聪明猫<1922920373>
#版本号
version_now=0.5
#-----------------分割线--------------------
#下面是加载头
replace(){
	url0=$(curl -s $target)
	url1=${url0/%"["$1"尾]"*/}
	url2=$(echo ${url1/*"["$1"头]"/})
	url3=${url2//'<div>'/}
	url4=${url3//'</div>'/}
	url5=${url4//"[换行]"/"\n"}
	echo $url5
}
update(){
	version_new=$(replace "版本")
if [ $version_new = $version_now ]
then
	echo "当前为最新版本喵！"
else
	echo "当前版本与最新版本不一致！"
	echo "当前版本:"$version_now
	echo "最新版本:"$version_new
	echo "更新日志:"$(replace "日志")
	echo "正在更新..."
#	curl --progress-bar -o $sh_name1".sh" https://maoyuna0w0.github.io/0w0.sh | tee /dev/null
	echo "更新完成喵！请重新启动脚本喵！"
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
notice(){
	echo "正在获取信息...请稍等喵"
	target="https://sharechain.qq.com/36e88405300762a1fcdf52f399b818c9"
	sh_name1=$(basename "$0" .sh)
	sh_name2=$(basename "$0" sh)
	sh_name3=$(basename "$0" h)
	network
if [ $? -eq 0 ];then
	echo "获取失败喵！请检查网络后重试喵！"
	function_list_1
fi
	update
	replace "公告"
	switch
}
switch(){
if [ $(replace "开关") = "关" ]
then
	echo "本脚本暂时停止运行喵！"
	exit
else
	echo "欢迎使用本脚本！"
fi
	function_list_1
}
getJsonValuesByAwk() {
    awk -v json="$1" -v key="$2" -v defaultValue="$3" 'BEGIN{
        foundKeyCount = 0
        while (length(json) > 0) {
            # pos = index(json, "\""key"\""); ## 这行更快一些，但是如果有value是字符串，且刚好与要查找的key相同，会被误认为是key而导致值获取错误
            pos = match(json, "\""key"\"[ \\t]*?:[ \\t]*");
            if (pos == 0) {if (foundKeyCount == 0) {print defaultValue;} exit 0;}

            ++foundKeyCount;
            start = 0; stop = 0; layer = 0;
            for (i = pos + length(key) + 1; i <= length(json); ++i) {
                lastChar = substr(json, i - 1, 1)
                currChar = substr(json, i, 1)

                if (start <= 0) {
                    if (lastChar == ":") {
                        start = currChar == " " ? i + 1: i;
                        if (currChar == "{" || currChar == "[") {
                            layer = 1;
                        }
                    }
                } else {
                    if (currChar == "{" || currChar == "[") {
                        ++layer;
                    }
                    if (currChar == "}" || currChar == "]") {
                        --layer;
                    }
                    if ((currChar == "," || currChar == "}" || currChar == "]") && layer <= 0) {
                        stop = currChar == "," ? i : i + 1 + layer;
                        break;
                    }
                }
            }

            if (start <= 0 || stop <= 0 || start > length(json) || stop > length(json) || start >= stop) {
                if (foundKeyCount == 0) {print defaultValue;} exit 0;
            } else {
                print substr(json, start, stop - start);
            }

            json = substr(json, stop + 1, length(json) - stop)
        }
    }'
}
#--------------分割线-----------------
#下面是功能列表
function_list_1(){
	echo "功能列表:"
	echo "1.批量修改文件名"
	echo "2.批量修改文件内文本"
	echo "3.生成QQ昵称后缀(效果：别人@你后输入的文字会出现在两个文本的中间)"
	echo "4.批量下载二次元涩图"
	echo "5.重新下载脚本"
	echo "6.退出脚本"
	echo "请选择功能[1-6]"
	read function_number
	function_list_2
}
function_list_2(){
if [ $function_number = 1 ]
then
	echo "输入你想修改的原文件后缀（为空则直接在所有文件后面添加后缀）"
	read data_1
	echo "输入你想修改的后缀（为空则删除上一个输入的后缀）"
	read data_2
	function_1
elif [ $function_number = 2 ]
then
	echo "输入你想修改的文件名或后缀（为空则为所有文件）"
	read data_1
	echo "输入你想替换的原文本（不能为空）"
	read data_2
	echo "输入你想替换后的文本（为空则为删除）"
	read data_3
	function_1
elif [ $function_number = 3 ]
then
	echo "请输入你要的名字前缀(例如:聪明猫)"
	read name1
	echo "请输入你要的名字后缀[注意！！请反着输入！](例如~喵，发出来就是'喵~'！)"
	read name2
	function_2
elif [ $function_number = 4 ]
then
	echo "请输入要下载的图片张数"
	read num_1
	echo "是否过滤r18图片"
	echo "请选择[0(是)|1(否)]"
	read r18
	echo "请输入搜索图片的关键词(多个请用|分割，不需要就直接回车)"
	read keyword
	echo "请稍后喵..."
	function_3
elif [ $function_number = 5 ]
then
	function_4
elif [ $function_number = 6 ]
then
	exit
else
	echo "你这选了个什么喵！"
	exit
fi
	function_end
}
#---------------分割线-------------------
#下面是具体功能
function_1(){
if [ $data_1 ] || [ $data_2 ] || [ $data_3 ]
then
	echo "正在修改喵..."
	for file in `ls *$data_1`
	do
		if [ $function_number = 1 ]
		then
		mv $file ${file%$data_1}$data_2
		elif [ $function_number = 2 ]
		then
		sed -i 's/'$data_2/$data_3'/g' "$file"
	  fi
	done
else
	echo "你玩我呢喵！这不是什么都没改吗？！"
	exit
fi
}
function_1_1(){
if [ $data_1 = ".sh" ]
then
	mv $sh_name1$data_2 $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 = "sh" ]
then
	mv $sh_name2$data_2 $sh_name2"sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 = "h" ]
then
	mv $sh_name3$data_2 $sh_name3"h"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 ]
then
	echo "修改完成喵！"
else
	mv $sh_name1".sh"$data_2 $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
fi
}
function_1_2(){
if [ $data_1 = ".sh" ]
then
	sed -i 's/'$data_3/$data_2'/g' $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 = "sh" ]
then
	sed -i 's/'$data_3/$data_2'/g' $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 = "h" ]
then
	sed -i 's/'$data_3/$data_2'/g' $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
elif [ $data_1 ]
then
	echo "修改完成喵！"
else
	sed -i 's/'$data_3/$data_2'/g' $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
fi
}
function_2(){
	touch 昵称.txt
	echo $name2 > 昵称.txt
	name3=$(awk '{array[NR]=$0} END { for(i=NR;i>0;i--){print array[i];} }' 昵称.txt)
	name4=$name1"⁧"$name3"⁧‭"
	echo $name4 > 昵称.txt
	echo "生成完成！请退出脚本后查看<昵称.txt>！"
	echo "可直接全选复制后设置成自己的QQ昵称！"
	exit
}
function_3(){
	num_2=$(seq $num_1)
	target="https://image.anosu.top/pixiv/json"
	if [ $r18 = 1 ]
	then
	r18=2
	fi
	mkdir setu
	for number in $num_2
	do
		network
	if [ $? -eq 0 ];then
		echo "下载失败喵！请检查网络后重试喵！"
		function_list_1
	fi
		json=$(curl -s $target -d "r18="$r18"&keyword="$keyword)
		url=$(getJsonValuesByAwk "$json" "url" "https://maoyuna0w0.github.io/Error.jpg")
		pid=$(getJsonValuesByAwk "$json" "pid")
		uid=$(getJsonValuesByAwk "$json" "uid")
		title=$(getJsonValuesByAwk "$json" "title")
		user=$(getJsonValuesByAwk "$json" "user")
		tag_1=$(getJsonValuesByAwk "$json" "tags")
		tag_2=${tag_1//[/}
		tag=${tag_2//]/}
		echo "正在下载第"$number"张"
		echo "涩图信息:"
		echo "标题:"${title//'"'/}"\n作者:"${user//'"'/}"\npid:"$pid"\nuid:"$uid"\n标签:"${tag//'"'/}
		curl --progress-bar -o setu/$pid".jpg" ${url//'"'/} | tee /dev/null
		echo "下载完成喵！"
	done
	echo "所有下载的涩图都在[当前文件夹/setu/]里"
}
function_4(){
	replace "关于"
}
function_end(){
if [ $function_number = 1 ]
then
	function_1_1
elif [ $function_number = 2 ]
then
	function_1_2
elif [ $function_number = 5 ]
then
	echo "正在重新下载...请稍等喵..."
	curl --progress-bar -o $sh_name1".sh" https://maoyuna0w0.github.io/0w0.sh | tee /dev/null
	echo "下载完成喵！请重新启动脚本喵！"
	exit
fi
echo "正在返回选择功能区..."
function_list_1
}
#-----------------分割线--------------------
#开始脚本
notice