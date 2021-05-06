var $body = $('body');
/**
 * [preview 图片预览]
 * @Author   PengJun
 * @DateTime 2018-06-18
 * @param    {[type]}   image    [预览图的img名称 class名或ID名或标签名]
 * @param    {[type]}   input    [触发的input文件框]
 * @param    {[type]}   batch    [是否多图上传 如要上传多图需要在图片预览的html父标签添加 id='images']
 * @param    {[type]}   name     [是多图上传的name名称]
 * @param    {[type]}   maxsize  [限制上传的文件大小 默认：2M]
 */
function preview(image,input,batch=false,name='file',maxsize=1024*1024*1)
{   
    $($body).on('click',image,function(){
        var $this = $(this);
        var num = $(image).index($(this));
        $(input).eq(num).click();
        $(input).eq(num).change(function(){
            var objUrl = getObjectURL(this.files[0]);
            console.log(objUrl);
            var fileSize = this.files[0].size;
            if(fileSize > maxsize){
                layer.msg('图片大小超出限制，请上传'+renderSize(maxsize)+'以内的图片');
                $(input).eq(num).val('');
                $this.attr("src",'/static/Admin/images/add.png');
                return;
            }
            if (objUrl) {
                if(batch != false && num == ($(image).length -1)){
                    var str = '';
                    str += '<div class="layui-inline deledata">';
                    str += '<input type="file" name="'+name+'[]" class="album" style="display: none">';
                    str += '<img class="layui-upload-img albums" src="/static/Admin/images/add.png" id="test-upload-normal-img">';
                    str += '<div class="dele" style="display: none;">删除</div>';
                    str += '</div>';
                    $(str).appendTo($('#images'));
                    $('.dele').eq(num).show(500);
                }
                $this.attr("src", objUrl);
            }
        });
    })

    //建立一個可存取到該file的url
    function getObjectURL(file) {
        var url = null ; 
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
}

/**
 * [renderSize 格式化文件大小]
 * @Author   PengJun
 * @DateTime 2018-10-30
 * @param    {[type]}   value [description]
 * @return   {[type]}         [description]
 */
function renderSize(value){
    if(null==value||value==''){
        return "0 Bytes";
    }
    var unitArr = new Array("Bytes","KB","MB","GB","TB","PB","EB","ZB","YB");
    var index=0;
    var srcsize = parseFloat(value);
    var index=Math.floor(Math.log(srcsize)/Math.log(1024));
    var size =srcsize/Math.pow(1024,index);
    //  保留的小数位数
    size = size.toFixed(2);
    return size+unitArr[index];
}

/**
 * [相册元素删除]
 * @Author   PengJun
 * @DateTime 2018-08-09
 * @param    {[type]}   ){} [description]
 * @return   {[type]}         [description]
 */
$body.on('click','.dele',function(){
    var num = $('.dele').index($(this));
    $(this).closest('.deledata').remove();
})


/**
 * [pages 分页按钮]
 * @Author   PengJun
 * @DateTime 2018-07-20
 * @param    {[type]}   elem  [分页按钮显示的元素ID]
 * @param    {[type]}   count [总数量]
 * @param    {[type]}   limit [每页显示的数量]
 * @param    {[type]}   page  [当前页码]
 * @param    {[type]}   url   [点击跳转的地址]
 */
function pages(elem,count,limit=10,page,url='')
{
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        var parameter = GetRequest();
        delete parameter.page
        var str = '?';
        if(parameter){
            var arr = Object.keys(parameter); //获取对象下标
            var i  = arr.length,t = 0;
            $.each(parameter,function(index,value){
                str += index+'='+value;
                if(t < i-1){
                    str += '&';
                }
                t++;
            });
        }
        //分页
        laypage.render({
            elem: elem, //注意，这里的 test1 是 ID，不用加 # 号
            count: count, //数据总数，从服务端得到
            limit:limit,
            layout:['count','prev','page','next'],
            curr:page,
            // hash:'page',
            jump:function(obj,first){
                //首次不执行
                if(!first){
                    var page = obj.curr; //获取当前点击的页数
                    if(url){
                        window.location.href = url;
                    } else {
                        window.location.href = 'http://'+document.location.host+document.location.pathname+str+'&page='+page;
                    }
                    
                }
            }
          });
    })
}

/**
 * [fromUpload 表单元素]
 * @Author   PengJun
 * @DateTime 2018-07-20
 * @param    {[type]}   table [表单元素]
 * @param    {[type]}   url   [提交地址]
 */
function fromUpload(table,url,functions='')
{
    layui.use('form', function(){
        var form = layui.form;
        form.on('submit(LAY-user-back-submit)', function(data){
            var num = $('[lay-submit]').index($(this));
            console.log(num);
            var formData = new FormData($(table)[num]);
            $.ajax({
                url:url,
                type:'post',
                data:formData,
                dataType:'json',
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function(data){
                    if(functions != ''){
                        functions(data);
                    } else {
                        if(data.code == 200){
                            layer.msg(data.msg,{time:1000},function(){
                                //返回上一页刷新
                                self.location=document.referrer;
                            });
                        } else {
                            layer.msg(data.msg,{time:3000});
                        }
                    }
                    
                },
                error:function(){
                    layer.msg('网络错误，请稍后再试');
                }
            });
        });
    });
}

/**
 * [删除数据]
 * @Author   PengJun
 * @DateTime 2018-07-25
 */
$body.on('click','.delete',function(){
    var url = $(this).attr('data-url');
    if(url == null){ url = '/admin/Common/delete'; }
    var id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    layer.confirm('是否删除？', {icon: 3, title:'是否删除'}, function(index) {
        if(id == null || url == null){
            layer.msg('缺少请求参数', {icon: 2, time: 3000});
        } else {
            $.ajax({
                url:url,
                data:{
                    id:id,
                    table:table,
                },
                type:'post',
                dataType:'json',
                success:function (data) {
                    if (data.code == 200) {
                        layer.msg(data.msg, {icon: 1, time: 1000},function(){
                            location.reload();
                        });
                    } else {
                        layer.msg(data.msg, {icon: 2, time: 3000});
                    }
                    layer.close(index);
                },
                error:function () {
                    layer.msg('网络错误，请稍后再试', {icon: 2, time: 2000});
                    layer.close(index);
                }
            });
        }
    });
})

/**
 * [area 三级联动]
 * @Author   PengJun
 * @DateTime 2018-07-25
 * @param    {Number}   province [省ID]
 * @param    {Number}   city     [市ID]
 * @param    {Number}   area     [区ID]
 */
function area(url,id=0,type=0)
{   
    layui.use(['element','form'], function(){
        var element = layui.element;
        var form = layui.form;
        var province = $('#province').attr('lay-selected');
        var city = $('#city').attr('lay-selected');
        var area = $('#area').attr('lay-selected');
        if(province)
        {  
            if(areaForm(url,0,0,province))
            {   
                if(areaForm(url,province,1,city))
                {   
                    areaForm(url,city,2,area);
                }
            }
        }else{
            areaForm(url);
        }

        form.on('select(province)', function(data){
            if(data.value != 0){
                areaForm(url,data.value,1);
            }
            $('#city').html('<option value="">请选择</option>');
            $('#area').html('<option value="">请选择</option>');
            form.render();
        });
        form.on('select(city)', function(data){
            if(data.value != 0){
                areaForm(url,data.value,2);
            }
            $('#area').html('<option value="">请选择</option>');
            form.render();
        });
        
    })
}

//发送请求
function areaForm(url,id=0,type=0,selected=0)
{   
    layui.use(['element','form'], function(){
        var element = layui.element;
        var form = layui.form;
        $.ajax({
            type:'post',
            url:url,
            data:{
                id:id,
                type:type,
            },
            dataType:'json',
            success:function(data){
                var str = '';
                str += '<option value="">请选择</option>';
                $(data.data).each(function(index,val){
                    if(val.id == selected){
                        str += '<option selected value="'+val.id+'">'+val.name+'</option>';
                    } else {
                        str += '<option value="'+val.id+'">'+val.name+'</option>';
                    }
                });
                if(type == 0){
                    $('#province').html(str);
                } else if(type == 1){
                    $('#city').html(str);
                } else if(type == 2){
                    $('#area').html(str);
                }
                form.render();
            }
        })
    });
    return true;
}

/**
 * [GetRequest 获取url参数]
 * @Author   PengJun
 * @DateTime 2018-08-29
 */
function GetRequest() {   
   var url = decodeURI(location.search); //获取url中"?"符后的字串   
   var theRequest = new Object();  
   if (url.indexOf("?") != -1) {   
      var str = url.substr(1);   
      strs = str.split("&");   
      for(var i = 0; i < strs.length; i ++) {   
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);   
      }   
   }
   return theRequest;   
}

/**
 * [get_request 发起请求]
 * @Author   PengJun
 * @DateTime 2018-09-13
 * @param    {[type]}   url       [请求地址]
 * @param    {String}   data      [请求参数]
 * @param    {String}   functions [回调]
 */
function get_request(url,data='',functions='')
{   
    if(!url){
        layer.msg('缺少请求地址');
        return;
    } else {
        $.ajax({
            type:'post',
            url:url,
            data:data,
            dataType:'json',
            success:function(data){
                if(functions != ''){
                    functions(data);
                } else {
                    if(data.code == 200){
                        layer.msg(data.msg,{time:1000},function(){
                            location.reload();
                        });
                    } else {
                        layer.msg(data.msg,{time:3000});
                    }
                }
            },
            error:function(){
                layer.msg('网络错误，请稍后再试');
            }
        })
    }
}

/*
在当前页面打开新页面
 */
$body.on('click','.open',function(){
    var url = $(this).attr('url');
    var title = $(this).attr('data-title');
    if(title == ''){ title = '信息'; }
    
    if(url){
        layer.open({
            type:2,
            title:title,
            area:['80%','90%'],
            content:url,
        })
    }
})

/**
 * [更新单个字段]
 * @Author   PengJun
 * @DateTime 2019-01-14
 */
$body.on('click','.odd',function(){
    var url = "/admin/common/odd_edit";
    var data = {
        id:$(this).attr('data-id'),
        key:$(this).attr('key'),
        val:$(this).attr('val'),
        table:$(this).attr('table'),
    };
    get_request(url,data)
})
 