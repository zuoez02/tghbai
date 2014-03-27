function submitData(data, url) {
	$.post(
        url,
        data,
        function (data) {
        	$("p.v-note").css("display", "none");
        	$("input.textbox").css("background", "#fff")
                    .css("border-color", "#d7d7d7");
        	if (data.HasFormError) {
        		$.each(data.ErrorList, function (i, err) {
        			$("#" + err.ElementId)
                        .css("background", "#fee")
                        .css("border-color", "#f33");

        			$("#" + err.ElementId + " ~ p.v-note")
                        .css("display", "block")
                        .text(err.ErrorMessage);
        		});
        	} else if (data.IsRedirect) {
        		window.location = data.RedirectUrl;
        	} else if (data.IsActionDone) {

        		var d = $("#dialog");
        		if (d.length > 0) {
        			if (data.IsActionSuccess) {
        				d.dialog("option", "title", "操作成功");
        				d.html(data.ActionMsg);
        			} else {
        				d.dialog("option", "title", "操作失败");
        				d.html(data.ActionMsg);
        			}
        			d.dialog("open");
        		}
        	}
        }
    );
}


function submitForm(formId, url) {
	var formData = $(formId).serialize();
	submitData(formData, url);
}

// 获取动作节点类型，0主菜单，1左栏菜单，2动作
function getActionType(actionId, menuId) {
	if (actionId != 0) return 2;
	if (actionId == 0 && menuId != 0) return 1;
	return 0;
}

// 设置CheckBox选中的级联关系
function setCheckbox(id, checked) {
	var topId = id.split('-')[0];
	var menuId = id.split('-')[1];
	var actionId = id.split('-')[2];
	var type = getActionType(actionId, menuId);

	if (type == 0 && checked) {
		$(".auth input:checkbox[id|='" + topId + "']").each(function () {
			this.checked = true;
		});
	} else if (type == 0 && !checked) {
		$(".auth input:checkbox[id|='" + topId + "']").attr("checked", false);
	}

	if (type == 1 && checked) {
		$(".auth input:checkbox[id|='" + topId + "-" + menuId + "']").each(function () {
			this.checked = true;
		});
		$(".auth input:checkbox[id=" + topId + "-0-0]").each(function () {
			this.checked = true;
		});
	} else if (type == 1 && !checked) {
		$(".auth input:checkbox[id|='" + topId + "-" + menuId + "']").attr("checked", false);
	}

	if (type == 2 && checked) {
		$(".auth input:checkbox[id=" + topId + "-0-0]").each(function () {
			this.checked = true;
		});
		$(".auth input:checkbox[id=" + topId + "-" + menuId + "-0]").each(function () {
			this.checked = true;
		});
	}
}

//两个参数，一个是cookie的名子，一个是值
function setCookie(name, value) {
	var Days = 30; //此 cookie 将被保存 30 天
	var exp = new Date();    //new Date("December 31, 9998");
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}

//取cookies函数        
function getCookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (arr != null) return unescape(arr[2]); return null;
}

//删除cookie
function removeCookie(name) {
	var exp = new Date();
	exp.setTime(exp.getTime() - 2 * 24 * 60 * 60 * 1000);
	var cval = getCookie(name);
	cval = null;
	if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}