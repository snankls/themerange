/** Mega Menu **/
(function($) {
	
	"use strict";
	
	if( $('p.field-tr-is-megamenu').length > 0 ){
		$(document).on('change', 'p.field-tr-is-megamenu input[type="checkbox"]', function(){
			var is_megamenu = $(this).is(':checked');
			var megamenu_field = $(this).parents('p.field-tr-is-megamenu');
			var li_parent = $(this).parents('li.menu-item');
			
			var menu_li_child = li_parent.nextUntil('.menu-item-depth-0');
			if( is_megamenu ){
				megamenu_field.siblings('.tr-custom-menu, .wp-editor-wrap').show();
			}
			else{
				megamenu_field.siblings('.tr-custom-menu, .wp-editor-wrap').hide();
			}
			menu_li_child.find('.tr-custom-menu, .wp-editor-wrap').hide();
		});
		
		$(document).on('mouseup', 'ul#menu-to-edit li.menu-item a.item-edit', function(){
			$(this).parents('li.menu-item').trigger('click');
		});
		
		$(document).on('click', 'ul#menu-to-edit > li', function(){
			if( $(this).hasClass('menu-item-depth-0') ){
				var is_megamenu = $(this).find('.edit-menu-item-tr-is-megamenu').is(':checked');
				var menu_li_child = $(this).nextUntil('.menu-item-depth-0');
				if( is_megamenu ){
					$(this).find('.tr-custom-menu, .wp-editor-wrap').show();
				}
				else{
					$(this).find('.tr-custom-menu, .wp-editor-wrap').hide();
				}
				$(this).find('.field-tr-is-megamenu').show(); /* Always show checkbox */
				menu_li_child.find('.tr-custom-menu, .wp-editor-wrap').hide();
				$(this).find('.field-tr-bg-color').show(); /* background color */
			}
			else{
				$(this).find('.tr-custom-menu, .wp-editor-wrap').hide();
				$(this).find('.field-tr-bg-color').hide(); /* background color */
				$(this).find('.field-tr-bg-color .edit-menu-item-tr-bg-color').val(''); /* background color */
			}
		});
		
		$('#menu-to-edit').on('sortstop', function(event, ui){
			var current_item = ui.item;
			setTimeout(function(){
				current_item.trigger('click');
			},100);
		});
		
		/* Upload thumbnail */
		$(document).on('click', '.tr_mega_menu_upload_image', function(){
			var current_add_ele = $(this);
			var current_rmv_ele = $(this).siblings('a.tr_mega_menu_clear_image');
			var preview = $(this).siblings('span.preview-thumbnail-wrapper');
			var thumbnail_id_value = $(this).siblings('.thumbnail-id-hidden');  
			wp.media.editor.send.attachment = function(props, attachment){
				var thumb_id  = attachment.id;
				var thumb_url = '';
				if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
					thumb_url = attachment.sizes.thumbnail.url;
				}else{
					thumb_url = attachment.sizes[props.size].url;
				}
				var img_html = '<img src="'+thumb_url+'" width="32" height="32" >';
				preview.html(img_html);
				thumbnail_id_value.val(thumb_id);
				
				current_add_ele.hide();
				current_rmv_ele.show();
			}
			wp.media.editor.open(current_add_ele);
		}); 

		$(document).on('click', '.tr_mega_menu_clear_image', function(){
			var current_rmv_ele = $(this);
			var current_add_ele = $(this).siblings('a.tr_mega_menu_upload_image');
			var preview = $(this).siblings('span.preview-thumbnail-wrapper');
			var thumbnail_id_value = $(this).siblings('.thumbnail-id-hidden');  
			preview.html('');
			thumbnail_id_value.val('');
			current_add_ele.show();
			current_rmv_ele.hide();
			return false;  
		}); 
	}
	
	/* Sub Label Background Color */
	if( typeof $.fn.wpColorPicker == 'function' ){
		$('.field-tr-sub-label-bg-color input, .field-tr-bg-color input').wpColorPicker();
		$(document).on('menu-item-added', function(e, added_menu){
			added_menu.find('.field-tr-sub-label-bg-color input, .field-tr-bg-color input').wpColorPicker();
		});
	}

	
	$(document).on('click', '.tr_meta_box_upload_button', function(){
		var button = $(this);
		var clear_button = button.siblings('.tr_meta_box_clear_image_button');
		var input_field = button.siblings('.upload_field');   
		wp.media.editor.send.attachment = function(props, attachment){
			var attachment_url = '';
			attachment_url = attachment.sizes[props.size].url;
			input_field.val(attachment_url);
			if( input_field.siblings('.preview-image').length > 0 ){
				input_field.siblings('.preview-image').attr('src', attachment_url);
			}
			else{
				var img_html = '<img class="preview-image" src="' + attachment_url + '" />';
				input_field.parent().append(img_html);
			}
			clear_button.attr('disabled', false);
			input_field.trigger('change'); /* For widget */
		}
		wp.media.editor.open(button);
	}); 
	
	$(document).on('click', '.tr_meta_box_clear_image_button', function(){
		var button = $(this);
		button.attr('disabled', true);
		button.siblings('.upload_field').val('');
		button.siblings('.preview-image').fadeOut(250, function(){
			button.siblings('.preview-image').remove();
		});
		button.siblings('.upload_field').trigger('change'); /* For widget */
	});
	
	$(document).on('change', '.tr-meta-box-field .upload_field, .widget .upload_field', function(){
		var input_field = $(this);
		var input_value = input_field.val().trim();
		if( input_value == '' ){
			input_field.siblings('.tr_meta_box_clear_image_button').trigger('click'); /* don't loop because button is disabled */
		}
		else{
			if( input_field.siblings('.preview-image').length > 0 ){
				input_field.siblings('.preview-image').attr('src', input_value);
			}
			else{
				var img_html = '<img class="preview-image" src="' + input_value + '" />';
				input_field.parent().append(img_html);
			}
			input_field.siblings('.tr_meta_box_clear_image_button').attr('disabled', false);
		}
	});
	
	/* Gallery */
	var file_frame;
	var _add_img_button;
	$('.tr-gallery-box .add-image').on('click', function(event){
		event.preventDefault();
		_add_img_button = jQuery(this);
        
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: themerange_admin_texts.select_images,
            multiple: true,
            priority:  20
        })];
			 
        file_frame = wp.media.frames.file_frame = wp.media({
            states: _states,
            button: {
                text: themerange_admin_texts.use_images
            }
        });

        file_frame.on( 'select', function() {
			var object = file_frame.state().get('selection').toJSON();
			
			var img_html = '';
			if( object.length > 0 ){
				for( var i = 0; i < object.length; i++ ){
					var image_url = object[i].url;
					if( typeof object[i].sizes.thumbnail != "undefined" ){
						image_url = object[i].sizes.thumbnail.url;
					}
					img_html += '<li class="image"><span class="del-image"></span><img src="'+image_url+'" alt="awesome image" data-id="'+object[i].id+'"/></li>';
				}
			}
			
			_add_img_button.siblings('ul.images').append(img_html);
			
			var arr_ids = new Array();
			_add_img_button.siblings('ul.images').find('li img').each(function(index, ele){
				arr_ids.push( $(ele).data('id') );
			});
			
			_add_img_button.siblings('.meta-value').val(arr_ids.join(','));
        });
		 
        file_frame.open();
	});
	
	$(document).on('click', '.tr-gallery-box .del-image', function(){
		var image = $(this).parent('.image');
		var container = $(this).parents('.tr-gallery-box');
		image.fadeOut(300, function(){
			image.remove();
			update_gallery_ids_field( container );
		});
	});
	
	if( typeof $.fn.sortable == 'function' ){
		$('.tr-gallery-box .images').sortable({revert: true, update: function(e, ui){ update_gallery_ids_field($(ui.item).parents('.tr-gallery-box')); }});
		$('.tr-gallery-box .images').disableSelection();
	}
	
	function update_gallery_ids_field(container){
		var arr_ids = new Array();
		container.find('.images img').each(function(index, ele){
			arr_ids.push( $(ele).data('id') );
		});
		container.find('.meta-value').val( arr_ids.join(',') );
	}
	
	/* Colorpicker */
	if( typeof $.fn.wpColorPicker == 'function' ){
		var params = {
			change: function(e, ui){
				$(e.target).val( ui.color.toString() );
				$(e.target).trigger('change');
			}
		};
		$('.tr-meta-box-field .colorpicker, #widgetr-right .colorpicker').wpColorPicker( params );
		$(document).on('widget-updated widget-added', function(e, widget){
			widget.find('.colorpicker').wpColorPicker( params );
		});
	}
	
	/* Table */
	$(document).on('click', '.tr-meta-box-field.table .table-button', function(e){
		e.preventDefault();
		var table = $(this).closest('table');
		var action = $(this).attr('class').replace('table-button', '').replace(' ', '');
		switch( action ){
			case 'add-col':
				if( table.find('thead td').length > 20 ){
					return;
				}
				var col = $(this).parent('td');
				var index = col.parent().children('td').index(col);
				var tbody = $(this).closest('thead').siblings('tbody');
				col.after( col.clone() );
				tbody.find('tr').each(function(i, e){
					var row = $(e);
					var col = row.find('td').eq(index);
					var new_col = col.clone();
					new_col.find('input').val('');
					col.after( new_col );
				});
			break;
			case 'del-col':
				if( table.find('thead td').length == 2 ){
					return;
				}
				var col = $(this).parent('td');
				var index = col.parent().children('td').index(col);
				var tbody = $(this).closest('thead').siblings('tbody');
				col.remove();
				tbody.find('tr').each(function(i, e){
					$(e).find('td').eq(index).remove();
				});
			break;
			case 'add-row':
				var row = $(this).closest('tr');
				var new_row = row.clone();
				new_row.find('input').val('');
				row.after( new_row );
			break;
			case 'del-row':
				if( table.find('tbody tr').length == 1 ){
					return;
				}
				$(this).closest('tr').remove();
			break;
		}
		update_table_value( table );
	});
	
	$(document).on('change', '.tr-meta-box-field.table table input', function(){
		update_table_value( $(this).closest('table') );
	});
	
	if( $('.tr-meta-box-field.table').length ){
		$('.tr-meta-box-field.table table').each(function(){
			update_table_value( $(this) );
		});
	}
	
	function update_table_value( table ){
		var value = new Array();
		table.find('tbody tr').each(function(){
			var row_val = new Array();
			$(this).find('input').each(function(i, e){
				row_val.push( $(e).val() );
			});
			value.push( row_val );
		});
		table.siblings('.table-value').val( JSON.stringify(value) );
	}
	
	/* Multi Select */
	$('.tr-meta-box-field.multi-select select').on('change', function(){
		$(this).siblings('.select-value').val( $(this).val() );
	});
	
	$('.tr-meta-box-field.multi-select select').trigger('change');
	
	if( typeof $.fn.selectWoo == 'function' ){
		$('.tr-meta-box-field.multi-select select').selectWoo();
	}

	
	if( $('select#page_template').length > 0 ){
		$('select#page_template').on('change initial', function(){
			var template = $(this).val();
			if( template == 'page-templates/blank-page-template.php' ){
				$('#page_options').addClass('tr-hidden');
			}
			else{
				$('#page_options').removeClass('tr-hidden');
			}
		});
		$('select#page_template').trigger('initial');
	}
	
	/* Transparent header */
	$('.tr-meta-box-field #tr_header_layout').on('change', function(){
		if( $.inArray( $(this).val(), ['v6'] ) != -1 ){
			$('#tr_header_transparent').parents('.tr-meta-box-field').show();
		}
		else{
			$('#tr_header_transparent').parents('.tr-meta-box-field').hide();
			$('#tr_header_transparent').val(0);
		}
		$('.tr-meta-box-field #tr_header_transparent').trigger('change');
	});
	
	$('.tr-meta-box-field #tr_header_transparent').on('change', function(){
		if( $(this).val() == 1 ){
			$('#tr_header_text_color').parents('.tr-meta-box-field').show();
		}
		else{
			$('#tr_header_text_color').parents('.tr-meta-box-field').hide();
		}
	});
	
	$('.tr-meta-box-field #tr_header_layout').trigger('change');
	
	/* Fullwidth layout */
	$('#page_options #tr_layout_fullwidth').on('change', function(){
		var val = $(this).val();
		if( val == '1' ){
			$('#tr_header_layout_fullwidth').parents('.tr-meta-box-field').fadeIn();
			$('#tr_main_content_layout_fullwidth').parents('.tr-meta-box-field').fadeIn();
			
			$('#tr_layout_style').parents('.tr-meta-box-field').fadeOut();
		}
		else{
			$('#tr_header_layout_fullwidth').parents('.tr-meta-box-field').fadeOut();
			$('#tr_main_content_layout_fullwidth').parents('.tr-meta-box-field').fadeOut();
			
			$('#tr_layout_style').parents('.tr-meta-box-field').fadeIn();
		}
	});
	$('#page_options #tr_layout_fullwidth').trigger('change');

	
	var add_sidebar_form = $('#tr-form-add-sidebar');
	if( add_sidebar_form.length > 0 ){
		var add_sidebar_form_new = add_sidebar_form.clone();
		add_sidebar_form.remove();
		jQuery('#widgetr-right').append('<div style="clear:both;"></div>');
		jQuery('#widgetr-right').append(add_sidebar_form_new);
		
		$('#tr-add-sidebar').on('click', function(e){
			e.preventDefault();
			var sidebar_name = $.trim( $(this).siblings('#sidebar_name').val() );
			var sidebar_nonce = $('#tr_custom_sidebar_nonce').val();
			if( sidebar_name != '' ){
				$('#tr-form-add-sidebar').addClass('loading');
				$(this).attr('disabled', true);
				var data = {
					action: 'themerange_add_custom_sidebar'
					,sidebar_name: sidebar_name
					,sidebar_nonce: sidebar_nonce
				};
				
				$.ajax({
					type : 'POST'
					,url : ajaxurl	
					,data : data
					,success : function(response){
						if( response ){
							alert( response );
						}
						window.location.reload(true);
					}
				});
			}
		});
	}
	
	if( $('.sidebar-tr-custom-sidebar').length > 0 ){
		var delete_button = '<span class="delete-sidebar"></span>';
		$('.sidebar-tr-custom-sidebar .sidebar-name').prepend(delete_button);
		
		$('.sidebar-tr-custom-sidebar .delete-sidebar').on('click', function(){
			var sidebar_name = $(this).parent().find('h2').text();
			var widget_block = $(this).parents('.widgetr-holder-wrap');
			var sidebar_nonce = $('#tr_custom_sidebar_nonce').val();
			var ok = confirm( themerange_admin_texts.delete_sidebar_confirm );
			if( ok ){
				widget_block.hide();
				var data = {
					action: 'themerange_delete_custom_sidebar'
					,sidebar_name: sidebar_name
					,sidebar_nonce: sidebar_nonce
				};
				
				$.ajax({
					type : 'POST'
					,url : ajaxurl	
					,data : data
					,success : function(response){
						if( response != '' ){
							widget_block.remove();
						}
						else{
							widget_block.show();
							alert( themerange_admin_texts.delete_sidebar_failed );
						}
					}
				});
			}
		});
	}

	
	/* Only show the "remove image" button when needed */
	$('.tr-product-cat-upload-field').each(function(){
		if( ! $(this).find('.value-field').val() ){
			$(this).find('.remove-button').hide();
		}
	});

	/* Uploading files */
	var file_frame;
	var upload_button;

	$( document ).on( 'click', '.tr-product-cat-upload-field .upload-button', function( event ) {

		event.preventDefault();
		
		upload_button = $(this);

		/* If the media frame already exists, reopen it. */
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		/* Create the media frame. */
		file_frame = wp.media.frames.downloadable_file = wp.media({
			title: themerange_admin_texts.choose_an_image,
			button: {
				text: themerange_admin_texts.use_image
			},
			multiple: false
		});

		/* When an image is selected, run a callback. */
		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get( 'selection' ).first().toJSON();
			var thumb_url = attachment.url;
			if( typeof attachment.sizes.thumbnail != 'undefined' ){
				thumb_url = attachment.sizes.thumbnail.url;
			}

			upload_button.siblings('.value-field').val( attachment.id );
			upload_button.parents('.tr-product-cat-upload-field').find('.preview-image img').attr( {'src': thumb_url, 'width': '', 'height': ''} );
			upload_button.siblings('.remove-button').show();
		});

		/* Finally, open the modal. */
		file_frame.open();
	});
	
	if( typeof $.fn.wpColorPicker == 'function' ){
		$('.tr-color-picker').wpColorPicker();
	}

})(window.jQuery);
