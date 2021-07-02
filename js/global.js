//$.ajaxSettings.async = false;
//常用正则规则
var rule_phone = /^((1[0-9]{10})|(029[0-9]{8}))$/;
var rule_qq = /^[0-9]{5,10}$/;
var rule_email = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[a-z]{2,3}$/;
var rule_zh = /^[\u4e00-\u9fa5]+$/;

/* ====================== jq全局操作函数 ====================== */
//全选操作(修正版) 
function bro_checkall(_this, inputname) {
	var checkname = $(_this).attr("name");
	
	if ($(_this).is(":checked")) {
		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").attr("checked","checked");
	}
	else {
		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").removeAttr("checked");
	}
} 
//带提醒批量操作(修正版) 
function bro_cfall(_this, inputname, formid, show) {
	if ($("input[name='"+inputname+"[]']").filter(":checked").length == 0) {
		alert('请先勾选需要'+show+'的信息!');
		return false;
	}
	else if (confirm('您确认执行'+show+'操作吗?')) {
		$("#"+formid).attr("action", $(_this).attr("href")).submit();
	}
	return false;
}


//dialog函数
function bro_dialog(_this, title, width, height, id) {
	art.dialog.open($(_this).attr("href"), {title:title, width: width, height: height, id: id});
	return false;
}
//商品购买数量
function bro_numchange(inputname, type, limit) 
{
	var _input = $(":input[name='"+inputname+"']");
	var _input_val = parseInt(_input.val());
	var limit = parseInt(limit);
	if (type == '+') {
		if (_input_val < limit) _input.val(_input_val + 1)
	}
	else {
		if (_input_val > limit) _input.val(_input_val - 1)
	}
}
