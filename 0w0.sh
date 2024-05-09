#!/bin/bash
#以下为代码部分，不懂请不要乱改
#二改请标注来源
#反馈或者提供意见请加作者QQ好友
#聪明猫<1922920373>
#-----------------分割线--------------------
#下面是加载头
notice(){
	sh_name1=$(basename "$0" .sh)
	sh_name2=$(basename "$0" sh)
	sh_name3=$(basename "$0" h)
	mao=$(echo 'dmVyc2lvbl9ub3c9IjEuMSI7bmV0d29yaygpeyBsb2NhbCB0aW1lb3V0PTE7bG9jYWwgcmV0X2Nv ZGU9YGN1cmwgLUkgLXMgLS1jb25uZWN0LXRpbWVvdXQgJHt0aW1lb3V0fSAiaHR0cDovL2NhdGF4 eS5mdW46MjMzL3dwLWpzb24vd3AvdjIvcG9zdHM/Y2F0ZWdvcmllcz0yJnBlcl9wYWdlPTEiIC13 ICV7aHR0cF9jb2RlfSB8IHRhaWwgLW4xYDtpZiBbICJ4JHJldF9jb2RlIiA9ICJ4MjAwIiBdO3Ro ZW4gcmV0dXJuIDE7ZWxzZSByZXR1cm4gMDtmaTtyZXR1cm4gMDt9O3JlcGxhY2UoKXsgYT0kKGN1 cmwgLXMgImh0dHA6Ly9jYXRheHkuZnVuOjIzMy93cC1qc29uL3dwL3YyL3Bvc3RzP2NhdGVnb3Jp ZXM9MiZwZXJfcGFnZT0xIik7eD0kKGVjaG8gJHthLy8nXC8nLycvJ30pO2M9JChlY2hvICR7eC8v J1x1Jy8n54yqJ30pO2Q9JChnZXRKc29uVmFsdWVzQnlBd2sgIiRjIiAiJDEiKTtlPSQoZ2V0SnNv blZhbHVlc0J5QXdrICIkZCIgInJlbmRlcmVkIiAiZXJyb3IiKTtmPSR7ZS8vJ+eMqicvJ1x1J307 Zz0kKGVjaG8gLWVuICR7Zi8nIicvfSk7aD0ke2cvJSciJy99O2o9JHtoLy8nPHA+Jy99O2s9JChl Y2hvICR7ai8vJzwvcD4nLydcbid9KTtsPSR7ay8n5rKh55So55qE6aG555uuJy99O209JHtsLy8n ICcvfTtuPSQoZWNobyAke20vLyc8YnIvPicvJ1xuJ30pO3U9JHtuLyc8ZGl2Y2xhc3M9IndwLWJs b2NrLWZpbGUiPicqL307bz0ke24vLyonPGFocmVmPSInL307cT0ke28vLyciJyonPC9hPjwvZGl2 Pid9O2lmIFsgJDIgXTt0aGVuIHByaW50ZiAkcTtlbHNlIHByaW50ZiAkdTtmaTt9O2xpc3RfbT0i 5Yqf6IO95YiX6KGoOlxuMC7ph43mlrDkuIvovb3ohJrmnKxcbjEu5om56YeP5L+u5pS55paH5Lu2 5ZCNXG4yLuaJuemHj+S/ruaUueaWh+S7tuWGheaWh+acrFxuMy7nlJ/miJBRUeaYteensOWQjue8 gCjmlYjmnpzvvJrliKvkurpA5L2g5ZCO6L6T5YWl55qE5paH5a2X5Lya5Ye6546w5Zyo5Lik5Liq 5paH5pys55qE5Lit6Ze0KVxuNC7mibnph4/kuIvovb3kuozmrKHlhYPmtqnlm75cbjUu5om56YeP 5Yig6Zmk5paH5Lu2XG7or7fpgInmi6nlip/og71bMC01XToiO2VjaG8gIuato+WcqOiOt+WPluS/ oeaBry4uLuivt+eojeetieWWtSI7bmV0d29yaztpZiBbICQ/IC1lcSAwIF07dGhlbiBlY2hvICLo jrflj5blpLHotKXllrXvvIHor7fmo4Dmn6XnvZHnu5zlkI4g6YeN6K+V5Za177yBIjtwcmludGYg JGxpc3RfbTtlbGlmIFsgJHZlcnNpb25fbm93ID0gJChyZXBsYWNlIHRpdGxlKSBdO3RoZW4gZWNo byAi5b2T5YmN5Li65pyA5paw54mI5pys5Za177yBIjtyZXBsYWNlIGV4Y2VycHQ7cHJpbnRmICRs aXN0X207ZWxzZSBwcmludGYgIuW9k+WJjeeJiOacrOS4juacgOaWsOeJiOacrOS4jeS4gOiHtO+8 gVxu5b2T5YmN54mI5pysOiIkdmVyc2lvbl9ub3c7cHJpbnRmICJcbuacgOaWsOeJiOacrDoiJChy ZXBsYWNlIHRpdGxlKTtwcmludGYgIlxu5pu05paw5pel5b+XOlxuIjtyZXBsYWNlIGNvbnRlbnQ7 cHJpbnRmICJcbuato+WcqOabtOaWsC4uLiI7Y3VybCAtLXByb2dyZXNzLWJhciAtbyAkc2hfbmFt ZTEiLnNoIiAkKHJlcGxhY2UgY29udGVudCB1cmwpIHwgdGVlIC9kZXYvbnVsbDtwcmludGYgIlxu 5pu05paw5a6M5oiQ5Za177yB6K+36YeN5paw5ZCv5Yqo6ISa5pys5Za177yBIjtleGl0O2ZpO3Jl YWQgZnVuY3Rpb25fbnVtYmVyO2Z1bmN0aW9uX2xpc3Q=' | base64 -d -i)
	eval $mao
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
function_list(){
if [ $function_number ]
then
	if [ $function_number = 0 ]
	then
	echo "正在重新下载...请稍等喵..."
	elif [ $function_number = 1 ]
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
	function_3
	elif [ $function_number = 4 ]
	then
	echo "请输入要下载的图片张数"
	read num_1
	echo "是否过滤r18图片"
	echo "请选择[0(是)|1(否)]"
	read r18
	echo "请输入搜索图片的关键词(多个请用|分割，不需要就直接回车)"
	read keyword
		if [ ! "$(ls -A setu)" ]
		then
		mkdir setu
		echo "是否需要隐藏涩图文件夹？"
		echo "反悔了请删除setu文件夹或者重命名setu文件夹！"
		echo "1:是"
		echo "2:否"
		echo "请选择[1-2]"
		read setu_set
		fi
	echo "请稍后喵..."
	function_4
	elif [ $function_number = 5 ]
	then
	echo "请输入你想批量删除文件的后缀(为空则所有文件)"
	read delete_name
	function_5
	else
	echo "你这选了个什么喵！"
	exit
	fi
	function_end
fi
}
#---------------分割线-------------------
#下面是具体功能
function_1(){
if [ $data_1 ] || [ $data_2 ] || [ $data_3 ]
then
	echo "正在修改喵..."
	for file in `ls -1 -F *$data_1 | grep -v [/$]`
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
if [ $data_1 ]
then
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
	else
	echo "修改完成喵！"
	fi
else
	mv $sh_name1".sh"$data_2 $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
fi
}
function_1_2(){
if [ $data_1 ]
then
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
	else
	echo "修改完成喵！"
	fi
else
	sed -i 's/'$data_3/$data_2'/g' $sh_name1".sh"
	echo "检测到可能修改了sh文件，已恢复喵！"
fi
}
function_3(){
	touch 昵称.txt
	echo $name2 > 昵称.txt
	name3=$(awk '{array[NR]=$0} END { for(i=NR;i>0;i--){print array[i];} }' 昵称.txt)
	name4=$name1"⁧"$name3"⁧‭"
	echo $name4 > 昵称.txt
	echo "生成完成！请退出脚本后查看<昵称.txt>！"
	echo "可直接全选复制后设置成自己的QQ昵称！"
	exit
}
function_4(){
	num_2=$(seq $num_1)
	target="https://image.anosu.top/pixiv/json"
	if [ $r18 = 1 ]
	then
	r18=2
	fi
	for number in $num_2
	do
		network
	if [ $? -eq 0 ];then
		echo "下载失败喵！请检查网络后重试喵！"
		function_list
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
		printf "标题:"${title//'"'/}"\n作者:"${user//'"'/}"\npid:"$pid"\nuid:"$uid"\n标签:"${tag//'"'/}"\n"
		curl --progress-bar -o setu/$pid".jpg" ${url//'"'/} | tee /dev/null
		echo "下载完成喵！"
	done
	echo "所有下载的涩图都在[当前文件夹/setu/]里"
}
function_5(){
	for delete_file in $(ls -1 -F *$delete_name | grep -v [/$])
	do
	rm -f $delete_file
	done
}
function_5_1(){
if [ $delete_name ]
then
	if [ $delete_name = ".sh" ]
	then
	curl -s -o $sh_name1".sh" $(replace content url) | tee /dev/null
	echo "检测到可能删除了sh文件，已恢复喵！"
	elif [ $delete_name = "sh" ]
	then
	curl -s -o $sh_name1".sh" $(replace content url) | tee /dev/null
	echo "检测到可能删除了sh文件，已恢复喵！"
	elif [ $delete_name = "h" ]
	then
	curl -s -o $sh_name1".sh" $(replace content url) | tee /dev/null
	echo "检测到可能删除了sh文件，已恢复喵！"
	else
	echo "删除完成喵！"
	fi
else
	curl -s -o $sh_name1".sh" $(replace content url) | tee /dev/null
	echo "检测到可能删除了sh文件，已恢复喵！"
fi
}
function_end(){
if [ $function_number = 0 ]
then
	curl --progress-bar -o $sh_name1".sh" $(replace content url) | tee /dev/null
	echo "下载完成喵！请重新启动脚本喵！"
	exit
elif [ $function_number = 1 ]
then
	function_1_1
elif [ $function_number = 2 ]
then
	function_1_2
elif [ $function_number = 4 ]
then
	if [ $setu_set ]
	then
		if [ $setu_set = 1 ]
		then
		touch setu/.nomedia
		echo "可能需要重启手机后相册才不会检测到涩图"
		fi
	fi
elif [ $function_number = 5 ]
then
	function_5_1
fi
}
#-----------------分割线--------------------
#开始脚本
notice
