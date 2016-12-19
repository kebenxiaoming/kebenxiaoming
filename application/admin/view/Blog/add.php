<?php
require dirname(dirname(__FILE__))."/Public/header.php";
require dirname(dirname(__FILE__))."/Public/navibar.php";
require dirname(dirname(__FILE__))."/Public/sidebar.php";
?>
<script src="<?php echo config('PUBLIC');?>/Admin/js/jquery.uploadifive.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo config('PUBLIC');?>/Admin/css/uploadifive.css">
<div class="cpgl_cplb">
    <form method="post" action="">
        <table width="855" border="0" cellspacing="0" cellpadding="0" class="cpgl_cptj">
            <tr>
                <td height="80">标题</td>
                <td><input name="title" type="text" class="cpgl_cptj_mc" value="<?php echo input('post.title');?>" required="true"></td>
            </tr>
            <tr>
                <td width="106" height="80">所属分类菜单</td>
                <td width="749"><div class="cpgl_cptj_xl">
                        <select name="cat_id" style="margin:5px 0px 0px">
                                <option value="0">暂无</option>
                        </select>
                    </div></td>
            </tr>
            <tr>
                <td height="200">简介</td>
                <td><textarea name="description" type="text" class="cpgl_cptj_mc" required="true"  style="width:400px;height:200px;" ><?php echo input('post.description');?></textarea></td>
            </tr>
                <input type="hidden" value="<?php echo input('post.pics');?>" name="pics" id="picsval">
                <tr>
                    <td height="80">文章图片</td>
                    <td class="cpgl_cptj_sc">
                        <input type="file" id="coverimages" class="input-xlarge" autofocus="true">
                        <p>最大100KB，支持jpg，gif，png格式。</p>
                        <div id="preview"></div>
                    </td>
                </tr>
            <tr>
                <td height="80">排序</td>
                <td><input name="sort" type="text" class="cpgl_cptj_mc"  value="<?php echo input('post.sort');?>" placeholder="数字越小越靠前"></td>
            </tr>
            <tr>
                <td height="80">文章详情</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="106" height="80">编辑器选择</td>
                <td width="749"><div class="cpgl_cptj_xl">
                        <select name="editor" onchange="javascript:location.replace('<?php echo url('Blog/add');?>&editor='+this.options[this.selectedIndex].value)" style="margin:5px 0px 0px">
                            <?php if($this->vars['editor']=='markdown'){?>
                                 <option value="kindeditor" >kindeditor</option><option value="markdown" selected>markdown</option>';
                            <?php }else{ ?>
                                <option value="kindeditor" selected>kindeditor</option><option value="markdown" >markdown</option>';
                            <?php } ?>
                        </select>
                    </div></td>
            </tr>
            <!-- 编辑器 -->
            <?php if($this->vars['editor']=='markdown'){?>
            <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Admin/js/markdown/css/style.css">
            <tr>
                 <td  colspan="2"><div class="dsjj_nr1">
                 <textarea style="height: 450px" autocomplete="off" id="text" name="content" class="markdown-textarea"><?php echo input('post.content');?></textarea></div></td>
            </tr>
                <script src="<?php echo config('PUBLIC');?>/Admin/js/markdown/js/jquery.scrollto.js"></script>
                <script src="<?php echo config('PUBLIC');?>/Admin/js/markdown/js/pagedown.js"></script>
                <script src="<?php echo config('PUBLIC');?>/Admin/js/markdown/js/pagedown-extra.js"></script>
                <script src="<?php echo config('PUBLIC');?>/Admin/js/markdown/js/diff.js"></script>
                <script>
                    $(document).ready(function () {
                        var textarea = $('#text'),
                            toolbar = $('<div class="markdown-editor" id="md-button-bar" />').insertBefore(textarea.parent())
                        preview = $('<div id="md-preview" class="md-hidetab" />').insertAfter('.markdown-editor');

                        var options = {};

                        options.strings = {
                            bold: '加粗 <strong> Ctrl+B',
                            boldexample: '加粗文字',

                            italic: '斜体 <em> Ctrl+I',
                            italicexample: '斜体文字',

                            link: '链接 <a> Ctrl+L',
                            linkdescription: '请输入链接描述',

                            quote:  '引用 <blockquote> Ctrl+Q',
                            quoteexample: '引用文字',

                            code: '代码 <pre><code> Ctrl+K',
                            codeexample: '请输入代码',

                            image: '图片 <img> Ctrl+G',
                            imagedescription: '请输入图片描述',

                            olist: '数字列表 <ol> Ctrl+O',
                            ulist: '普通列表 <ul> Ctrl+U',
                            litem: '列表项目',

                            heading: '标题 <h1>/<h2> Ctrl+H',
                            headingexample: '标题文字',

                            hr: '分割线 <hr> Ctrl+R',
                            more: '摘要分割线 <!--more--> Ctrl+M',

                            undo: '撤销 - Ctrl+Z',
                            redo: '重做 - Ctrl+Y',
                            redomac: '重做 - Ctrl+Shift+Z',

                            fullscreen: '全屏 - Ctrl+J',
                            exitFullscreen: '退出全屏 - Ctrl+E',
                            fullscreenUnsupport: '此浏览器不支持全屏操作',

                            imagedialog: '<p><b>插入图片</b></p><p>请在下方的输入框内输入要插入的远程图片地址</p>',
                            linkdialog: '<p><b>插入链接</b></p><p>请在下方的输入框内输入要插入的链接地址</p>',

                            ok: '确定',
                            cancel: '取消'
                        };

                        var converter = new Markdown.Converter(),
                            editor = new Markdown.Editor(converter, '', options),
                            diffMatch = new diff_match_patch(), last = '', preview = $('#md-preview'),
                            mark = '@mark' + Math.ceil(Math.random() * 100000000) + '@',
                            span = '<span class="diff" />';

                        // 设置markdown
                        Markdown.Extra.init(converter, {
                            extensions  :   ["tables", "fenced_code_gfm", "def_list", "attr_list", "footnotes"]
                        });

                        // 自动跟随
                        converter.hooks.chain('postConversion', function (html) {
                            // clear special html tags
                            html = html.replace(/<\/?(\!doctype|html|head|body|link|title|input|select|button|textarea|style|noscript)[^>]*>/ig, function (all) {
                                return all.replace(/&/g, '&amp;')
                                    .replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/'/g, '&#039;')
                                    .replace(/"/g, '&quot;');
                            });

                            // clear hard breaks
                            html = html.replace(/\s*((?:<br>\n)+)\s*(<\/?(?:p|div|h[1-6]|blockquote|pre|table|dl|ol|ul|address|form|fieldset|iframe|hr|legend|article|section|nav|aside|hgroup|header|footer|figcaption|li|dd|dt)[^\w])/gm, '$2');

                            if (html.indexOf('<!--more-->') > 0) {
                                var parts = html.split(/\s*<\!\-\-more\-\->\s*/),
                                    summary = parts.shift(),
                                    details = parts.join('');

                                html = '<div class="summary">' + summary + '</div>'
                                    + '<div class="details">' + details + '</div>';
                            }


                            var diffs = diffMatch.diff_main(last, html);
                            last = html;

                            if (diffs.length > 0) {
                                var stack = [], markStr = mark;

                                for (var i = 0; i < diffs.length; i ++) {
                                    var diff = diffs[i], op = diff[0], str = diff[1]
                                    sp = str.lastIndexOf('<'), ep = str.lastIndexOf('>');

                                    if (op != 0) {
                                        if (sp >=0 && sp > ep) {
                                            if (op > 0) {
                                                stack.push(str.substring(0, sp) + markStr + str.substring(sp));
                                            } else {
                                                var lastStr = stack[stack.length - 1], lastSp = lastStr.lastIndexOf('<');
                                                stack[stack.length - 1] = lastStr.substring(0, lastSp) + markStr + lastStr.substring(lastSp);
                                            }
                                        } else {
                                            if (op > 0) {
                                                stack.push(str + markStr);
                                            } else {
                                                stack.push(markStr);
                                            }
                                        }

                                        markStr = '';
                                    } else {
                                        stack.push(str);
                                    }
                                }

                                html = stack.join('');

                                if (!markStr) {
                                    var pos = html.indexOf(mark), prev = html.substring(0, pos),
                                        next = html.substr(pos + mark.length),
                                        sp = prev.lastIndexOf('<'), ep = prev.lastIndexOf('>');

                                    if (sp >= 0 && sp > ep) {
                                        html = prev.substring(0, sp) + span + prev.substring(sp) + next;
                                    } else {
                                        html = prev + span + next;
                                    }
                                }
                            }

                            return html;
                        });

                        editor.hooks.chain('onPreviewRefresh', function () {
                            var diff = $('.diff', preview), scrolled = false;

                            $('img', preview).load(function () {
                                if (scrolled) {
                                    preview.scrollTo(diff, {
                                        offset  :   - 50
                                    });
                                }
                            });

                            if (diff.length > 0) {
                                var p = diff.position(), lh = diff.parent().css('line-height');
                                lh = !!lh ? parseInt(lh) : 0;

                                if (p.top < 0 || p.top > preview.height() - lh) {
                                    preview.scrollTo(diff, {
                                        offset  :   - 50
                                    });
                                    scrolled = true;
                                }
                            }
                        });

                        var input = $('#text'), th = textarea.height(), ph = preview.height();

                        editor.hooks.chain('enterFakeFullScreen', function () {
                            th = textarea.height();
                            ph = preview.height();
                            $(document.body).addClass('fullscreen');
                            var h = $(window).height() - toolbar.outerHeight();

                            textarea.css('height', h);
                            preview.css('height', h);
                        });

                        editor.hooks.chain('enterFullScreen', function () {
                            $(document.body).addClass('fullscreen');

                            var h = window.screen.height - toolbar.outerHeight();
                            textarea.css('height', h);
                            preview.css('height', h);
                        });

                        editor.hooks.chain('exitFullScreen', function () {
                            $(document.body).removeClass('fullscreen');
                            textarea.height(th);
                            preview.height(ph);
                        });

                        editor.run();

                        // 编辑预览切换
                        var edittab = $('#md-button-bar').prepend('<div class="md-edittab"><a href="#md-editarea" class="active">撰写</a><a href="#md-preview">预览</a></div>'),
                            editarea = $(textarea.parent()).attr("id", "md-editarea");

                        $(".md-edittab a").click(function() {
                            $(".md-edittab a").removeClass('active');
                            $(this).addClass("active");
                            $("#md-editarea, #md-preview").addClass("md-hidetab");

                            var selected_tab = $(this).attr("href"),
                                selected_el = $(selected_tab).removeClass("md-hidetab");

                            // 预览时隐藏编辑器按钮
                            if (selected_tab == "#md-preview") {
                                $("#md-button-row").addClass("md-visualhide");
                            } else {
                                $("#md-button-row").removeClass("md-visualhide");
                            }

                            // 预览和编辑窗口高度一致
                            $("#md-preview").outerHeight($("#md-editarea").innerHeight());

                            return false;
                        });
                    });
                </script>
            <?php }else{ ?>
            <tr>
                <td  colspan="2"><div class="dsjj_nr1">

                        <textarea name="content" id="detail" ><?php echo input('post.content');?></textarea>

                    </div></td>
            </tr>
            <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/default/default.css" />
            <script charset="utf-8" src="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/kindeditor-min.js"></script>
            <script charset="utf-8" src="<?php echo config('PUBLIC');?>/Admin/js/kindeditor/zh_CN.js"></script>
            <script type="text/javascript">
                var editor_content;
                KindEditor.ready(function(K) {
                    editor_content = K.create('textarea[name="content"]', {
                        allowFileManager : false,
                        themesPath: K.basePath,
                        width: '100%',
                        height: '450',
                        resizeType: 1,
                        pasteType : 2,
                        urlType : 'absolute',
                        fileManagerJson : '',
                        uploadJson : '<?php echo url("File/uploadEdit");?>',
                        extraFileUploadParams: {
                        }
                    });
                });
                </script>
            <?php }?>
                <!-- 编辑器 -->
            <tr>
                <td height="80" colspan="2"><div class="dsjj_nr_menu">
                        <input name="" type="submit" value="提交" />
                    </div></td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
<script>
    $(function() {
        $('#coverimages').uploadifive({
            'uploadScript': '<?php echo url("File/uploadPicture");?>',
            'auto': true,
            'buttonText': "",
            'uploadLimit': 1,
            'onUploadComplete': function (file, data, response) {
                var filedata = JSON.parse(data);
                var images = $("#picsval").val();
                if (images == "") {
                    var newimages = filedata.data.id;
                } else {
                    var newimages = images + "," + filedata.data.id;
                }
                if (filedata.status == 1) {
                    $("#preview").append("<div style='width:100px;height:100px;float:left;'><img style='width:100px;height:100px;' src='" + filedata.data.ossres + "'></div>");
                    $("#preview").css("display", "block");
                    $("#picsval").val(newimages);
                } else {
                    alert(filedata.info);
                    return;
                }
            }
        })
    });
</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php
require dirname(dirname(__FILE__))."/Public/footer.php";
?>

