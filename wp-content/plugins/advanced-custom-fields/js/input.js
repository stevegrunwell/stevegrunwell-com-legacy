/*----------------------------------------------------------------------
*
*	vars
*
*---------------------------------------------------------------------*/

var acf = {
	validation : false,
	validation_message : "Validation error", // this is overriden by a script tag generated in admin_head for translation
	data : {
		action 			:	'get_input_metabox_ids',
		post_id			:	false,
		page_template	:	false,
		page_parent		:	false,
		page_type		:	false,
		page			:	false,
		post			:	false,
		post_category	:	false,
		post_format		:	false
	}
};


(function($){
	
		
	/*----------------------------------------------------------------------
	*
	*	Exists
	*
	*---------------------------------------------------------------------*/
	
	$.fn.exists = function()
	{
		return $(this).length>0;
	};
	
		
	/*----------------------------------------------------------------------
	*
	*	Document Ready
	*
	*---------------------------------------------------------------------*/
	
	$(document).ready(function(){
		
		// vars
		var post_id = $('input#post_ID').val();
	
		// show metaboxes for this post
		acf.data = {
			action 			:	'get_input_metabox_ids',
			post_id			:	post_id,
			page_template	:	false,
			page_parent		:	false,
			page_type		:	false,
			page			:	post_id,
			post			:	post_id,
			post_category	:	false,
			post_format		:	false,
			taxonomy		:	false
		};
		
		// update fields from ajax response
		function update_fields()
		{		
			$.ajax({
				url: ajaxurl,
				data: acf.data,
				type: 'post',
				dataType: 'json',
				success: function(result){
					
					// hide all metaboxes
					$('#poststuff .acf_postbox').hide();
					$('#adv-settings .acf_hide_label').hide();
					
					// show the new postboxes
					$.each(result, function(k, v) {
						$('#poststuff #acf_' + v).show();
						$('#adv-settings .acf_hide_label[for="acf_' + v + '-hide"]').show();
					});
					
					// load style
					$.ajax({
						url: ajaxurl,
						data: {
							action : 'get_input_style',
							acf_id : result[0]
						},
						type: 'post',
						dataType: 'html',
						success: function(result){
						
							$('#acf_style').html(result);
							
						}
					});
					
				}
			});
		}
		//update_fields();
		
		// hide acf stuff
		/*$('#poststuff .acf_postbox').hide();
		$('#adv-settings .acf_hide_label').hide();
		
		// show acf?
		$('#poststuff .acf_postbox').each(function(){
			
			// vars
			var show = $(this).children('.inside').children('.options').attr('data-show');
			var id = $(this).attr('id').replace('acf_', '');
			
			if(show == 'true')
			{
				$(this).show();
				$('#adv-settings .acf_hide_label[for="acf_' + id + '-hide"]').show();
			}
			
		});*/
		
		
		
		
		/*--------------------------------------------------------------------------------------
		*
		*	Change
		*
		*-------------------------------------------------------------------------------------*/
	
		$('#page_template').change(function(){
			
			acf.data.page_template = $(this).val();
			update_fields();
		    
		});
		
		$('#parent_id').change(function(){
			
			var page_parent = $(this).val();
			
			if($(this).val() != "")
			{
				acf.data.page_type = 'child';
			}
			else
			{
				acf.data.page_type = 'parent';
			}
			
			update_fields();
		    
		});
		
		$('#categorychecklist input[type="checkbox"]').change(function(){
			
			acf.data.post_category = ['0'];
			
			$('#categorychecklist :checked').each(function(){
				acf.data.post_category.push($(this).val())
			});
			
			//console.log(data.post_category);
					
			update_fields();
			
		});	
		
		
		$('#post-formats-select input[type="radio"]').change(function(){
			
			acf.data.post_format = $(this).val();
			update_fields();
			
		});	
		
		// taxonomy
		$('div[id*="taxonomy-"] input[type="checkbox"]').change(function(){
			
			acf.data.taxonomy = ['0'];
			
			$(this).closest('ul').find('input[type="checkbox"]:checked').each(function(){
				acf.data.taxonomy.push($(this).val())
			});

			update_fields();
			
		});	
		
	});
	
	
	/*----------------------------------------------------------------------
	*
	*	Save
	*
	*---------------------------------------------------------------------*/
	
	// on save, delete all unused metaboxes
	$('form#post').live("submit", function(){
		
		// do validation
		do_validation()
		
		if(acf.valdation == false)
		{
			// reset validation for next time
			acf.valdation = true;
			
			// show message
			$('#post').siblings('#message').remove();
			$('#post').before('<div id="message" class="error"><p>' + acf.validation_message + '</p></div>');
			
			
			// hide ajax stuff on submit button
			$('#publish').removeClass('button-primary-disabled');
			$('#ajax-loading').attr('style','');
			
			return false;
		}
		
		$('#post-body .acf_postbox:hidden').remove();
		
		
		return true;
	});
	
	
	/*----------------------------------------------------------------------
	*
	*	Validation
	*
	*---------------------------------------------------------------------*/
	
	function do_validation(){
		
		$('#post-body .acf_postbox:visible .field.required').each(function(){
			
			var validation = true;

			// text / textarea
			if($(this).find('input[type="text"], input[type="hidden"], textarea').val() == "")
			{
				validation = false;
			}
			
			// select
			if($(this).find('select').exists())
			{
				if($(this).find('select').val() == "null" || !$(this).find('select').val())
				{
					validation = false;
				}
			}
			
			// checkbox
			if($(this).find('input[type="checkbox"]:checked').exists())
			{
				validation = true;
			}
			
			// checkbox
			if($(this).find('.acf_relationship').exists() && $(this).find('input[type="hidden"]').val() != "")
			{
				validation = true;
			}
			
			// repeater
			if($(this).find('.repeater').exists())
			{
				if($(this).find('.repeater tr.row').exists())
				{
					validation = true;
				}
				else
				{
					validation = false;
				}
				
			}
			
			
			
			
			// set validation
			if(!validation)
			{
				acf.valdation = false;
				$(this).closest('.field').addClass('error');
			}
			
		});
		
		
	}
	
	
	/*----------------------------------------------------------------------
	*
	*	Add simple events to remove error class on field
	*
	*---------------------------------------------------------------------*/
	
	// inputs / textareas
	$('#post-body .acf_postbox .field.required input, #post-body .acf_postbox .field.required textarea, .acf_postbox .field.required select').live('focus', function(){
		$(this).closest('.field').removeClass('error');
	});
	
	// checkbox
	$('#post-body .acf_postbox .field.required input:checkbox').live('click', function(){
		$(this).closest('.field').removeClass('error');
	});
	
	// wysiwyg
	$('#post-body .acf_postbox .field.required .acf_wysiwyg').live('mousedown', function(){
		$(this).closest('.field').removeClass('error');
	});

	

	
	
	
})(jQuery);