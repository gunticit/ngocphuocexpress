if (typeof ckeditorfull_load !== 'undefined') {
CKEDITOR.on("dialogDefinition",function(e){for(var t=e.editor,n=e.data.definition,i=n.contents.length,a=0;i>a;a++){var o=n.contents[a].get("browse");null!==o&&(o.hidden=!1,o.onClick=function(n,i){t._.filebrowserSe=this,$("#modal-image").remove(),$.ajax({url:"index.php?route=common/filemanager&token="+getURLVar("token")+"&target="+e.editor.name+"&CKEditorFuncNum="+CKEDITOR.instances[e.editor.name]._.filebrowserFn,dataType:"html",success:function(e){$("body").append('<div id="modal-image" class="modal" style="z-index:10150;">'+e+"</div>"),$("#modal-image").modal("show")}})})}}),CKEDITOR.scriptLoader.load(CKEDITOR.basePath+"adapters/jquery.js"),$.extend($.fn,{summernote:function(e,t){if(!CKEDITOR.env.isCompatible)throw new Error("The environment is incompatible.");if(!$.isFunction(e)){var n=t;t=e,e=n}var i=[],a={width:"width",height:"height",minHeight:"resize_minHeight",maxHeight:"resize_maxHeight",focus:"startupFocus",tabsize:"sourceAreaTabSize",lang:"language",direction:"contentsLangDirection"},o={disableResizeEditor:function(e){return{name:"resize_enabled",value:!e}},fontSizes:function(e){for(var t=0;t<e.length;t++)e[t]=e[t]+"/"+e[t];return{name:"fontSize_sizes",value:e.join("px;")+"px"}},fontNames:function(e){return{name:"font_names",value:e.join(";")}},lineHeights:function(e){return{name:"line_height",value:e.join(";")}}},r={language:ck_settings.language};for(var s in t)if(s in a)r[a[s]]=t[s];else if(s in o){var d=o[s](t[s]);r[d.name]=d.value}ck_settings.skin&&(r.skin=ck_settings.skin),ck_settings.height&&(r.height=ck_settings.height),ck_settings.apikey&&(r.leaflet_maps_google_api_key=ck_settings.apikey),"false"===ck_settings.acf?r.allowedContent=null:r.allowedContent=!0,this.each(function(){var t=$(this),n=t.data("ckeditorInstance"),a=t.data("_ckeditorInstanceLock"),o=this,s=new $.Deferred;i.push(s.promise()),n&&!a?(e&&e.apply(n,[this]),s.resolve()):a?n.once("instanceReady",function(){setTimeout(function(){return n.element?(n.element.$==o&&e&&e.apply(n,[o]),void s.resolve()):void setTimeout(arguments.callee,100)},0)},null,null,9999):((r.autoUpdateElement||"undefined"==typeof r.autoUpdateElement&&CKEDITOR.config.autoUpdateElement)&&(r.autoUpdateElementJquery=!0),r.autoUpdateElement=!1,t.data("_ckeditorInstanceLock",!0),n=$(this).is("textarea")?CKEDITOR.replace(o,r):CKEDITOR.inline(o,r),t.data("ckeditorInstance",n),n.on("instanceReady",function(n){var i=n.editor;setTimeout(function(){if(!i.element)return void setTimeout(arguments.callee,100);if(n.removeListener(),i.on("dataReady",function(){t.trigger("dataReady.ckeditor",[i])}),i.on("setData",function(e){t.trigger("setData.ckeditor",[i,e.data])}),i.on("getData",function(e){t.trigger("getData.ckeditor",[i,e.data])},999),i.on("destroy",function(){t.trigger("destroy.ckeditor",[i])}),i.on("save",function(){return $(o.form).submit(),!1},null,null,20),i.config.autoUpdateElementJquery&&t.is("textarea")&&$(o.form).length){var a=function(){t.ckeditor(function(){i.updateElement()})};$(o.form).submit(a),$(o.form).bind("form-pre-serialize",a),t.bind("destroy.ckeditor",function(){$(o.form).unbind("submit",a),$(o.form).unbind("form-pre-serialize",a)})}i.on("destroy",function(){t.removeData("ckeditorInstance")}),t.removeData("_ckeditorInstanceLock"),t.trigger("instanceReady.ckeditor",[i]),e&&e.apply(i,[o]),s.resolve()},0)},null,null,9999))});var c=new $.Deferred;return this.promise=c.promise(),$.when.apply(this,i).then(function(){c.resolve()}),this.editor=this.eq(0).data("ckeditorInstance"),this},code:function(e){for(var t in CKEDITOR.instances)CKEDITOR.instances[t].updateElement();return void 0===e?this.val():(void 0===CKEDITOR.instances[this.get(0).id]?this.val(e):CKEDITOR.instances[this.get(0).id].setData(e),this)},destroy:function(){return CKEDITOR.instances[this.get(0).id].destroy(),this}});
}

function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

function insertShortCodes(text, elm, range, w_select) {
	if (w_select) {
		var para  = document.createElement('p');
		para.innerHTML = text;
		range.deleteContents();
		range.insertNode(para);
	} else {
		elm.text = text;
	}
}

$(document).ready(function() {
	//Form Submit for IE Browser
	$('button[type=\'submit\']').on('click', function() {
		$("form[id*='form-']").submit();
	});

	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();

		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});

	// Set last page opened on the menu
	$('#menu a[href]').on('click', function() {
		sessionStorage.setItem('menu', $(this).attr('href'));
	});

	if (!sessionStorage.getItem('menu')) {
		$('#menu #dashboard').addClass('active');
	} else {
		// Sets active and open to selected page in the left column menu.
		$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active open');
	}

	if (localStorage.getItem('column-left') == 'active') {
		$('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

		$('#column-left').addClass('active');

		// Slide Down Menu
		$('#menu li.active').has('ul').children('ul').addClass('collapse in');
		$('#menu li').not('.active').has('ul').children('ul').addClass('collapse');
	} else {
		$('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

		$('#menu li li.active').has('ul').children('ul').addClass('collapse in');
		$('#menu li li').not('.active').has('ul').children('ul').addClass('collapse');
	}

	// Menu button
	$('#button-menu').on('click', function() {
		// Checks if the left column is active or not.
		if ($('#column-left').hasClass('active')) {
			localStorage.setItem('column-left', '');

			$('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

			$('#column-left').removeClass('active');

			$('#menu > li > ul').removeClass('in collapse');
			$('#menu > li > ul').removeAttr('style');
		} else {
			localStorage.setItem('column-left', 'active');

			$('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

			$('#column-left').addClass('active');

			// Add the slide down to open menu items
			$('#menu li.open').has('ul').children('ul').addClass('collapse in');
			$('#menu li').not('.open').has('ul').children('ul').addClass('collapse');
		}
	});

	// Menu
	$('#menu').find('li').has('ul').children('a').on('click', function() {
		if ($('#column-left').hasClass('active')) {
			$(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			$(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		} else if (!$(this).parent().parent().is('#menu')) {
			$(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			$(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		}
	});

	// Override summernotes image manager
	// Deleted

	$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
		$('#modal-image').remove();

		$(this).parents('.note-editor').find('.note-editable').focus();
		
		var directory = localStorage.getItem('directory');
		
		if(directory == 'null') directory = '';
		
		$.ajax({
			url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&directory=' + directory,
			dataType: 'html',
			beforeSend: function() {
				$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-image').prop('disabled', true);
			},
			complete: function() {
				$('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
				$('#button-image').prop('disabled', false);
			},
			success: function(html) {
				$('body').append('<div id="modal-image" class="modal">' + html + '</div>');

				$('#modal-image').modal('show');
			}
		});
	});

	// Image Manager
	$(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
		e.preventDefault();

		$('.popover').popover('hide', function() {
			$('.popover').remove();
		});

		var element = this;

		$(element).popover({
			html: true,
			placement: 'right',
			trigger: 'manual',
			content: function() {
				return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
			}
		});

		$(element).popover('show');

		$('#button-image').on('click', function() {
			$('#modal-image').remove();
			
			var directory = localStorage.getItem('directory');
			
			if(directory == 'null') directory = '';

			$.ajax({
				url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&directory=' + directory + '&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
				dataType: 'html',
				beforeSend: function() {
					$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-image').prop('disabled', true);
				},
				complete: function() {
					$('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
					$('#button-image').prop('disabled', false);
				},
				success: function(html) {
					$('body').append('<div id="modal-image" class="modal">' + html + '</div>');

					$('#modal-image').modal('show');
				}
			});

			$(element).popover('hide', function() {
				$('.popover').remove();
			});
		});

		$('#button-clear').on('click', function() {
			$(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

			$(element).parent().find('input').attr('value', '');

			$(element).popover('hide', function() {
				$('.popover').remove();
			});
		});
	});

	// tooltips on hover
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});

	// https://github.com/opencart/opencart/issues/2595
	$.event.special.remove = {
		remove: function(o) {
			if (o.handler) {
				o.handler.apply(this, arguments);
			}
		}
	}

	$('[data-toggle=\'tooltip\']').on('remove', function() {
		$(this).tooltip('destroy');
	});
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();

			$.extend(this, option);

			$(this).attr('autocomplete', 'off');

			// Focus
			$(this).on('focus', function() {
				this.request();
			});

			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}

			// Show
			this.show = function() {
				var pos = $(this).position();

				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					left: pos.left
				});

				$(this).siblings('ul.dropdown-menu').show();
			}

			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}

			// Request
			this.request = function() {
				clearTimeout(this.timer);

				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}

			// Response
			this.response = function(json) {
				html = '';

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}

					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						}
					}

					// Get all the ones with a categories
					var category = new Array();

					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}

							category[json[i]['category']]['item'].push(json[i]);
						}
					}

					for (i in category) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';

						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$(this).siblings('ul.dropdown-menu').html(html);
			}

			$(this).after('<ul class="dropdown-menu"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));

		});
	}
})(window.jQuery);
