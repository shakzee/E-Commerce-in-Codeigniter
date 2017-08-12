$(function(){
	$('#q_3_t').keyup(function(){
		var data = {
			prodct:$(this).val()
			}
		var tag = ""
		if (jQuery.trim($(this).val()) == "")
		{	
			$('.show_tags').removeClass('tagscr');
			$('.show_tags').text('please insert somthing to')
		}
		else
		{
			$('.show_tags').html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
			$.post(surl+'admin/findproduct',data,function(fdata){
				var obje = JSON.parse(fdata);
				if (obje.length != 0)
				{
					for (var i = 0; i < obje.length; i++)
						{
							if ( obje.length > 10)
							{
								$('.show_tags').addClass('tagscr');

							}

								tag+='<a class="tcont" href="javascript:void(0)" id="tcont'+obje[i].pId+'" onclick="selecttag('+obje[i].pId+')">'
								tag+=''+obje[i].productName+'</a>'

								$('.show_tags').html(tag);
							}
						}
						else
						{
							$('.show_tags').removeClass('tagscr');
							$('.show_tags').text('tag not found..')
						}
					});
				$('.show_tags').removeClass('tagscr');
			}

		});//keyup 
	
	})


	function selecttag(myid)
	{
		//alert(myid);
		var tagname = $('#tcont'+myid).text();
		var user_tag = "";
		user_tag+='<span id="utags'+myid+'" class="udes utags'+myid+'">'+tagname+'<a href="javascript:void(0)" onclick="removetag('+myid+')">';
		user_tag+='<i class="fa fa-times"></i></a></apan>'
		user_tag+='<input type="hidden" name="productId" value="'+myid+'"  class="utags'+myid+'">'
		if (!$('#tag_fed').find('span').hasClass('utags'+myid))
		{
			if ($('#tag_fed').find('span').length == 1)
			{
				
			} 
			else
			{
				$('.tag_fed').append(user_tag);
			};

			$('.show_tags').empty();
			$('#q_3_t').val('');
			$('.show_tags').removeClass('tagscr');

			//$('.tag_fed').append(user_tag);
		}
	}

	function removetag (rem)
	{
		$('.utags'+rem).remove();
	}