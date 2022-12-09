layui.use(function() {
	var form = layui.form;


	var layer = layui.layer,
		form = layui.form,
		laypage = layui.laypage,
		element = layui.element,
		laydate = layui.laydate,
		util = layui.util;

	form.on('select(qdlist)', function(data) {
		if(data.value == 'a') {
			document.getElementById('input').setAttribute('style', 'display:block');
			document.getElementById('urlinput').setAttribute('value', "");
			document.getElementById('urlinput').setAttribute('lay-verify', 'url');
			form.render(null, 'url');
		} else if(data.value == 'b') {
			document.getElementById('input').setAttribute('style', 'display:block');
			document.getElementById('urlinput').setAttribute('value', "");
			document.getElementById("qdlist").innerHTML = html + '<option value="b" disabled>正在载入</option>';
			form.render('select');
			form.render(null, 'url');

			page++;
			$.ajax({
				type: 'get',
				url: 'api/',
				data: {
					"page": page
				},
				dataType: 'json',
				success: function(data) {
					if(data.code == 0 || data.code == 1) {
						if(data.data.length != 0) {
							for(var i in data.data) {
								data2 = data2.concat(data.data[i]);
								html = html + '<option value="' + size + '">' + data.data[i].title + '</option>';
								size++;
							}
							document.getElementById("qdlist").innerHTML = html + '<option value="b">加载更多...</option>';
						} else
							document.getElementById("qdlist").innerHTML = html;
					} else
						document.getElementById("qdlist").innerHTML = html + '<option value="b" disabled>' + data.msg + '</option>';
					form.render('select');

				},
				error: function() {
					document.getElementById("qdlist").innerHTML = html + '<option value="b" disabled>载入失败</option>';
					form.render('select');
				}
			});
		} else {
			document.getElementById('input').setAttribute('style', 'display:none');
			document.getElementById('urlinput').setAttribute('value', data2[data.value].url);
			document.getElementById('urlinput').setAttribute('lay-verify', null);
			form.render(null, 'url');
		}
	});

	html = '<option value="a">其他</option>';
	page = 1;
	data2 = [];
	size = 0;

	$.ajax({
		type: 'get',
		url: 'api/',
		data: {},
		dataType: 'json',
		success: function(data) {
			if(data.code == 0 || data.code == 1) {
				if(data.length != 0) {
					for(var i in data.data) {
						data2 = data2.concat(data.data[i]);
						html = html + '<option value="' + size + '">' + data.data[i].title + '</option>';
						size++;
					}
				}
				document.getElementById("qdlist").innerHTML = html + '<option value="b">加载更多...</option>';
			} else
				document.getElementById("qdlist").innerHTML = html + '<option value="b" disabled>' + data.msg + '</option>';
			form.render('select');

		},
		error: function() {
			document.getElementById("qdlist").innerHTML = '<option value="a">其他</option><option value="b" disabled>载入失败</option>';
			form.render('select');
		}
	});

	//监听提交
	form.on('submit(*)', function(data) {
		var index = layer.msg('正在跳转，请稍候...', {
			icon: 16,
			time: false,
			shade: 0.8
		});
		if(data.field.ui == 0) {
			spanedit(data.field.url, "qndxx.php")
		} else if(data.field.ui == 1) {
			spanedit(data.field.url, "bg.php")
		}else if(data.field.ui == 2) {
			spanedit(data.field.url, "bg2.php")
		} else {
			layer.close(index);
			layer.alert("你选择了一个未知页面", {
				icon: 2
			});
		}
		return false;
	});
});

function spanedit(link, url) {
	event.stopPropagation();
	var params = new Array();
	params['url'] = link;
	var temp = document.createElement("form");
	temp.action = url;
	temp.method = "post";
	temp.style.display = "none";
	for(var x in params) {
		var opt = document.createElement("input");
		opt.name = x;
		opt.value = params[x];
		temp.appendChild(opt);
	}
	document.body.appendChild(temp);
	temp.submit();
	return temp;
}