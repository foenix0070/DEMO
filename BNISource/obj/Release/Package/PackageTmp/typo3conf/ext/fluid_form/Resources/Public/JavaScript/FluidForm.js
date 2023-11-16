/**
 * Fluid-Form
 * Thomas Deuling <typo3@Coding.ms>
 * 2015-09-19 - Muenster/Germany
 *
 * initialize
 * -> submit
 *
 * -> beforeSend
 * -> send
 * -> afterSend
 *
 * -> beforeSuccess
 * -> success
 * -> afterSuccess
 *
 */
var FluidForm = {

	fluidForms: {},
	functions: {},

	icons: {
		fa: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-history',
			clear: 'fa fa-calendar-times-o',
			close: 'fa fa-times'
		},
		glyphicon: {
			time: 'glyphicon glyphicon-time',
			date: 'glyphicon glyphicon-calendar',
			up: 'glyphicon glyphicon-chevron-up',
			down: 'glyphicon glyphicon-chevron-down',
			previous: 'glyphicon glyphicon-chevron-left',
			next: 'glyphicon glyphicon-chevron-right',
			today: 'glyphicon glyphicon-screenshot',
			clear: 'glyphicon glyphicon-trash',
			close: 'glyphicon glyphicon-remove'
		}
	},

	initialize: function() {
		this.fluidForms = jQuery('.tx-fluid-form form');
		if(this.fluidForms.length>0) {
			jQuery.each(this.fluidForms, function(key, value) {
				var formUid = jQuery(value).attr('id').replace('form-', '');
				if(jQuery(value).hasClass('ajax')) {
					// bind on submit
					jQuery(value).submit(function(event) {
						FluidForm.submit(event);
					});
					//
					// Bind date picker
					var datePicker = jQuery('#form-' + formUid + ' .form-field-date input');
					if(datePicker.length>0) {
						datePicker.datetimepicker({
							locale: 'de',
							icons: FluidForm.icons['fa'],
							format: 'DD.MM.YYYY'
						});
					}
					var timePicker = jQuery('#form-' + formUid + ' .form-field-time input');
					if(timePicker.length>0) {
						timePicker.datetimepicker({
							locale: 'de',
							icons: FluidForm.icons['fa'],
							format: 'LT'
						});
					}
					var dateTimePicker = jQuery('#form-' + formUid + ' .form-field-datetime input');
					if(dateTimePicker.length>0) {
						dateTimePicker.datetimepicker({
							locale: 'de',
							icons: FluidForm.icons['fa']
						});
					}
					//
					// Insert selected file in file upload
					jQuery('#form-' + formUid + ' input[type=\'file\']').change(function() {
						var field = jQuery(this);
						var value = field.val();
						var id = field.attr('id');
						jQuery('label[for=\'' + id + '\']').text(value);
						jQuery('#' + id + '-wrapper').addClass('has-file-selected');
					});
					// Trigger on initialize
					FluidForm.callEvent('onInitialize', formUid);
				}
			})
		}
	},

	submit: function(event) {
		// Prepare variables
		var form = jQuery(event.target);
		var formUid = form.attr('id').substr(5);
		var action = form.attr('action');
		// Trigger on send
		FluidForm.callEvent('onSend', formUid);
		var formData = new FormData(jQuery(form)[0]);
		jQuery.ajax({
			type: 'POST',
			url: action,
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				jQuery('html, body').animate({
					scrollTop: jQuery('#form-' + data.uid).offset().top - 50
				}, 500);
				// Reset all messages
				FluidForm.clearInlineMessages(data);
				// Set messages
				jQuery.each(data.fieldsets, function(fieldsetKey, fieldset) {
					if(fieldset.valid===0) {
						jQuery.each(fieldset.fields, function(fieldKey, field) {
							//
							// Refresh captcha
							if (fieldKey === 'captcha') {
								var parent = jQuery('#form-' + data.uid + '-complete-captcha-wrapper #mathguard').parent();
								jQuery('#form-' + data.uid + '-complete-captcha-wrapper #mathguard').remove();
								jQuery('#form-' + data.uid + '-complete-captcha-wrapper input[name=\'mathguard_answer\']').remove();
								jQuery('#form-' + data.uid + '-complete-captcha-wrapper input[name=\'mathguard_code\']').remove();
								parent.prepend(field.html);
							}
							//
							var fieldId = 'form-' + data.uid + '-' + fieldsetKey + '-' + fieldKey;
							var $field = jQuery('#' + fieldId);
							var $fieldNoticeElement = jQuery('#' + fieldId + '-message');
							var $fieldWrapperElement = jQuery('#' + fieldId + '-wrapper');
							if(field.valid===0) {
								if($fieldNoticeElement.length>0 && typeof(field.message)!=='undefined') {
									$fieldNoticeElement.html(field.message);
								}
								if ($fieldWrapperElement.length>0) {
									$field.addClass('is-invalid');
								}
							}
						});
					}
				});
				// Everything is alright?!
				if(data.valid===1 && data.finished===1) {
					FluidForm.success(data);
				}
				else {
					FluidForm.error(data);
				}
			} // end of success ;)
		});
		event.preventDefault();
	},

	onSend: function(formUid, data) {
		jQuery('#form-' + formUid).addClass('sending');
	},

	onInitialize: function(formUid, data) {
	},

	beforeSuccess: function(formUid, data) {
	},

	success: function(data) {
		FluidForm.callEvent('beforeSuccess', data.uid);
		jQuery('#form-' + data.uid).removeClass('sending').removeClass('invalid').addClass('valid');
		jQuery('#form-' + data.uid + '-inner').hide();
		// Display messages
		FluidForm.clearMessages(data.uid);
		jQuery.each(data.messages.ok, function(okKey, ok) {
			FluidForm.pushMessages(data.uid, 'ok', ok.message, ok.title);
		});
		FluidForm.callEvent('afterSuccess', data.uid);
	},

	afterSuccess: function(formUid, data) {
	},

	beforeError: function(formUid, data) {
	},

	error: function(data) {
		FluidForm.callEvent('beforeError', data.uid);
		jQuery('#form-' + data.uid).removeClass('sending').removeClass('valid').addClass('invalid');
		// Display messages
		FluidForm.clearMessages(data.uid);
		jQuery.each(data.messages.error, function(errorKey, error) {
			FluidForm.pushMessages(data.uid, 'error', error.message, error.title);
		});
		FluidForm.callEvent('afterError', data.uid);
	},

	afterError: function(formUid, data) {
	},

	clearInlineMessages: function(data) {
		// Remove all error classes
		var $form = jQuery('#form-' + data.uid);
		$form.find('.is-invalid').removeClass('is-invalid');
		// Remove all error messages
		jQuery.each(data.fieldsets, function(fieldsetKey, fieldset) {
			jQuery.each(fieldset.fields, function(fieldKey, field) {
				var fieldId = 'form-' + data.uid + '-' + fieldsetKey + '-' + fieldKey;
				var $fieldNoticeElement = jQuery('#' + fieldId + '-message');
				if($fieldNoticeElement.length>0) {
					$fieldNoticeElement.html('');
				}
			});
		});
	},

	clearMessages: function(formUid) {
		jQuery('#form-' + formUid + '-messages').html('');
	},

	pushMessages: function(formUid, severity, message, title) {
		var html = '';
		if(severity==='ok') {
			html = '<div class="alert alert-success" role="alert">';
		}
		else if(severity==='error') {
			html = '<div class="alert alert-danger" role="alert">';
		}
		else {
			html = '<div class="alert alert-info" role="alert">';
		}
		if(typeof(title)!=='undefined') {
			html += '<h4 class="alert-heading">' + title + '</h4>';
		}
		if(typeof(message)!=='undefined') {
			html += message;
		}
		html += '</div>';
		jQuery('#form-' + formUid + '-messages').append(html);
	},

	callEvent: function(event, uid, data) {
		// Custom event code from typoscript setup
		if(typeof(FluidForm.functions[uid])!=='undefined') {
			if(typeof(FluidForm.functions[uid][event])!=='undefined') {
				FluidForm.functions[uid][event](uid, data);
			}
		}
		// JavaScript event method
		if(typeof(FluidForm[event])!=='undefined') {
			FluidForm[event](uid, data)
		}
		else {
			console.warn(event, uid);
		}
	},

	onUploadOk: function(formUid, data) {
	},

	onUploadError: function(formUid, data) {
	},

	displayFileName: function() {
		jQuery('.custom-file input').on('change',function (e) {
			var files = [];
			for (var i = 0; i < $(this)[0].files.length; i++) {
				files.push($(this)[0].files[i].name);
			}
			jQuery(this).next('.custom-file-label').html(files.join(', '));
		});
	}
};

// Initiate FluidForm object
jQuery(document).ready(function() {
	FluidForm.initialize();
});
