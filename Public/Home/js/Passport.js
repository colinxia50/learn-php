var loop = 1;
var appState = true;
var _Passport = {
    load: function (isApply) {
        $('.tips').each(function () {
            $(this).click(function () {
                $(this).hide().parent('li').find('input').focus();
            })
        })
        $('.vlt input').each(function (i) {
            if ($(this).val().length > 0) {
                $('.vlt').eq(i).find('.tips').hide();
            }
            $(this).focus(function () {
                $('.vlt').eq(i).find('.tips').hide();
            }).blur(function () {
                if ($(this).val().length < 1) {
                    $('.vlt').eq(i).find('.tips').show();
                }
            })
        })

        $('#password').keydown(function () {
            var event = arguments.callee.caller.arguments[0] || window.event;
            if (event.keyCode == 13) {
                _Passport.Login();
            }
        })

        $('#btnSubmit').click(function () {
            _Passport.Login();
        })
        _Passport.loopPhone();

        if (isApply) {
            $('#userName').focus().val('606283337');
            $('#password').focus().val('000000')
        }
    },
    loopPhone: function () {
        $('.slide').each(function (i) {
            if (loop % 3 == i) {
                $('.slide').hide();
                $(this).show();
                $('.dian a').removeClass('in').eq(i).addClass('in')
            }
        })
        loop++;
        setTimeout(function () { _Passport.loopPhone(); }, 2500)
    },
    clickPic: function (n) {
        $('.slide').each(function (i) {
            if ($(this).css('display') == 'block') {
                if (n == 0) {
                    if (i == 0) return;
                    loop = loop - 1;
                    n = i - 1;
                } else {
                    if (i == 2) return;
                    loop = loop + 1;
                    n = i + 1;
                }
                $('.slide').hide().eq(n).show();
                $('.dian a').removeClass('in').eq(n).addClass('in')
            }
        })
    },
    Login: function () {
        $('.login_error').hide();
        var isPost = true;
        var uname = $('#userName').val();
        var pwd = $('#password').val();
        if (uname == undefined || pwd == undefined)
            isPost = false;

        if (uname.length < 1) {
            $('.login_error').show().html('帐号长度不符合规范');
            isPost = false;
        }

        if (pwd.length < 1 && isPost) {
            $('.login_error').show().html('密码长度不符合规范');
            isPost = false;
        }

        var islast = $('#autologin').is(':checked');

        if (isPost) {
	    $('body').append('<div class="guideLoad"><div class="guideMark"></div><p></p></div>');
	    if($.browser.version == 6) $('.guideMark').height($('body').height());
            $.post('/passport/login', { 'data[userName]': $('#userName').val(), 'data[password]': $('#password').val(), 'data[islast]': islast }, function (d) {
                var json = eval('(' + d + ')');
                if (json.error == 1) {
                    $('.login_error').show().html('您输入的帐号或密码错误');
                } else {
                    window.location.href = json.url;
                }
		$('.guideLoad').remove();
            })
        }
    },
    Apply: function () {
        $('.test_input').each(function (i) {
            var _this = $(this);

            _this.focus(function () {
                _this.addClass('focus');
                if (_this.hasClass('address')) {
                    var _val = _this.val();
                    _this.addClass('light');
                    if (_val == '详细地址...') {
                        _this.val('')
                    } else {
                        _this.val(_val)
                    }
                }
            }).blur(function () {
                    _this.removeClass('focus');
                    if (_this.hasClass('address')) {
                        var _val = _this.val();
                        if (_val == '') {
                            _this.val('详细地址...').removeClass('light');
                        } else {
                            _this.val(_val);
                        }
                    }
                })
        });

        XmlHelper.list(110000, 110100)

        $('.applysubmit').click(function () {
            //if (!appState) { return; }

            var app_name = $('#app_name').val().replace(/(^\s*)|(\s*$)/g, "");
            var loca = $('#province option:selected').text() + '-' + $('#city option:selected').text() + $('#app_addr').val();
            var contact = $('#contact').val().replace(/(^\s*)|(\s*$)/g, "");
            //var position = $('#position').val().replace(/(^\s*)|(\s*$)/g, "");
            var app_mobile = $('#app_mobile').val().replace(/(^\s*)|(\s*$)/g, ""),
                err = $('#applyErr');

            if (app_name.length < 1) {
                err.text('幼儿园名称不能为空')
                return;
            }

            if (contact.length < 1) {
                err.text('请输入联系人');
                return;
            }
//            if (position.length < 1) {
//                err.text('请输入您的职务');
//                return;
//            }
            if (app_mobile.length !=11 || isNaN(app_mobile)) {
                err.text('请填写正确的手机号');
                return;
            } else {
                err.text('');
            }
            appState = false;
            $.post('/apply/testAccount', {
                app_name: app_name,
                app_address: loca,
                app_contact: contact,
                //app_position: position,
                app_mobile: app_mobile
            }, function (d) {
                if (d == 'true') {
                    alert('感谢申请，我们会及时与你联系。');
                } else {
                    alert('申请测试帐号失败，请重新提交！')
                }
                appState = true;
            })
        })

    },
    Register: function () {
    	$('.test_input').each(function (i) {
            var _this = $(this);

            _this.focus(function () {
                _this.addClass('focus');               
            }).blur(function () {
                _this.removeClass('focus');
                    
            })
        });

        $('.registerSubmit').click(function () {
            var name = $('#name').val().replace(/(^\s*)|(\s*$)/g, ""),
            	mobile = $('#mobile').val().replace(/(^\s*)|(\s*$)/g, ""),
            	pwd = $('#pwd').val().replace();

            if (name.length < 1) {
            	$('#name').next('.tip').addClass('error').text('姓名不能为空')
                return;
            }

            if (mobile.length !=11 || isNaN(mobile)) {
            	$('#mobile').next('.tip').addClass('error').text('请填写正确的手机号');
                return;
            } else {
            	$('#mobile').next('.tip').text('');
            }
            appState = false;
            $.post('/apply/testAccount', {
                app_name: app_name,
                app_address: loca,
                app_contact: contact,
                //app_position: position,
                app_mobile: app_mobile
            }, function (d) {
                if (d == 'true') {
                    alert('感谢申请，我们会及时与你联系。');
                } else {
                    alert('申请测试帐号失败，请重新提交！')
                }
                appState = true;
            })
        })
    }
}

var XmlHelper = {
    init: function (xmlFile) {
        var xmlDoc;
        if (window.ActiveXObject) {
            xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
            xmlDoc.async = false;
            xmlDoc.load(xmlFile);
        }
        else if (document.implementation && document.implementation.createDocument) {
            xmlDoc = document.implementation.createDocument("", "", null);
            xmlDoc.async = false;
            xmlDoc.load(xmlFile);
        } else {
            alert('Your   browser   cannot   handle   this   script');
        }
        return xmlDoc;
    },
    list: function (p, c) {
        $.ajax({
            type: "get",
            url: 'http://102.89cv.top/city.xml',
            dataType: 'xml',
            success: function (xml) {
                //省
                var province = '<option value="0">请选择</option>'
                $(xml).find("root > I").each(function (i) {
                    province += '<option value="{0}">{1}</option>'.format($(this).attr("V"), $(this).attr("T"));
                })
                $('#province').html(province);
                $('#province').val(p);
                //市
                var city = '<option value="0">请选择</option>';
                $(xml).find("root > I").each(function () {
                    if (p == $(this).attr("V")) {
                        $(this).children("I").each(function () {
                            city += '<option value="{0}">{1}</option>'.format($(this).attr("V"), $(this).attr("T"))
                        })
                    }
                })
                $('#city').html(city);
                $('#city').val(c);
                //省下拉时间
                $('#province').change(function () {
                    var code = '';

                    var pid = $(this).val();
                    //$('#loc').val($(this).find('option:selected').text());
                    $(xml).find("root > I").each(function () {
                        if (pid == $(this).attr("V")) {
                            $(this).children("I").each(function (i) {
                                code += '<option value="{0}">{1}</option>'.format($(this).attr("V"), $(this).attr("T"))
                                if (i == 0) {
                                    $('#loc').val($('#province').find('option:selected').text() + $(this).attr('T'));
                                }
                            });
                        }
                    })
                    $('#city').html(code);

                })
                $('#city').change(function () {
                    $('#loc').val($('#province').find('option:selected').text() + $('#city').find('option:selected').text())
                })
            }
        })

        $('#city').val(c);
    }
}
