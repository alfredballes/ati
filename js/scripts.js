jQuery(document).ready(function($) {
	/*
	* Detect if the viewer is desktop or mobile
	*/
	var isMobile = false; //initiate as false
	// device detection
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
		isMobile = true;
	}
  
	/*$('.wpb-popup-content').each(function(){
		$(this).wrap('<div class="wpb-popup-wrapper"><div class="wpb-popup-inside">');
	});
    
    
	$('.wpb-popup-trigger, .wpb-popup-menu > a').off().click(function(e){
		e.preventDefault();
		SectionID = $(this).attr('href');
		$(SectionID).closest('.wpb-popup-wrapper').addClass('popup-is-visible');
		$(SectionID).closest('.et_builder_inner_content').addClass('popup-is-visible');
		$('body').addClass('wpb-noscroll');
	});  
      
	$('.wpb-popup-close').click(function(e){
		e.preventDefault();
		$('.popup-is-visible').removeClass('popup-is-visible');
		$('body').removeClass('wpb-noscroll');

		var PopupVideoIframe = $(this).closest('.wpb-popup-content').find('.et_pb_video_box iframe');
		var PopupVideoSrc = PopupVideoIframe.attr("src");
		PopupVideoIframe.attr("src", PopupVideoSrc);

		var PopupVideoHTML = $(this).closest('.wpb-popup-content').find('.et_pb_video_box video');
		PopupVideoHTML.trigger('pause');
	}); */
	
	$("a.nav-link").on('click',function(e){
		e.preventDefault();
		$(".nav-link").removeClass('active');
		$(this).addClass('active');
		$(".tab-pane").hide();
		$(".tab-pane").removeClass('active');
		$(".tab-pane").addClass('fade');
		$($(this).attr("href")).show();
		$(".tab-pane").removeClass('fade');
		$(".tab-pane").addClass('active');
	});
	
	$("#related").slick({
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		infinite: true,
		autoplay: false,
		dots:true,
		dotsClass:'slick-dots',
		slidesToShow: 4,
		responsive: [
		{
		  // tablet
		  breakpoint: 991,
		  settings: {
			slidesToShow: 2
		  }
		},
		{
		  // mobile portrait
		  breakpoint: 479,
		  settings: {
			slidesToShow: 1
		  }
		}
		]
	});
	
	/* $('.related-link').mouseenter(function () {
       $(this).children("p.learn-more").show("slow");
       
     });

	 $('.related-link').mouseleave(function () {
		  $(this).children("p.learn-more").hide();
	 	}
	 ).mouseleave();//trigger mouseleave to hide second div in beginning */ 
	
	$( "select#industries" ).on( "change", function() {
	  window.location = document.location.origin + "/industries/" + this.value;
	} );
	
	$( "select.filter" ).on( "change", function() {
	 	var delivery = $("select#delivery").val();
		
		if(delivery == "all") {
			$("li.course").show();
		} else {
			$("li.course").hide();
			$("li.course."+delivery).show();
		}
	} );
	
	$( "select#sort" ).on( "change", function() {
		var sort = $(this).val();
		if(sort == "ascending") {
			$('ul.courses').append(function() {
			  return $(this).children().sort(function(a, b) {
				  var aText = $(a).find('.entry-title').text().trim(),
				      bText = $(b).find('.entry-title').text().trim();
				  return aText.localeCompare(bText);
			  });
			});
		} else if(sort == "descending") {
			$('ul.courses').append(function() {
			  return $(this).children().sort(function(a, b) {
				  var aText = $(a).find('.entry-title').text().trim(),
				      bText = $(b).find('.entry-title').text().trim();
				  return bText.localeCompare(aText);
			  });
			});
		} else if(sort == "price-asc") {
			$('ul.courses').append(function() {
			  return $(this).children().sort(function(a, b) {
				  var aText = $(a).data('price'),
				      bText = $(b).data('price');
				  return aText - bText;
			  });
			});
		} else if(sort == "price-desc") {
			$('ul.courses').append(function() {
			  return $(this).children().sort(function(a, b) {
				   var aText = $(a).data('price'),
				      bText = $(b).data('price');
				  return bText - aText;
			  });
			});
		}
	});
	
	$( "select.filter2" ).on( "change", function() {
	 	var delivery = $("select#delivery2").val();
		var location = $("select#location2").val();
		var level = $("select#experience_level").val();
		
		if(delivery == "all" && location == "all" && level == "all") {
			$("li.course").show();
		} else if(delivery != "all" && location == "all" && level == "all") {
			$("li.course").hide();
			$("li.course."+delivery).show();
		} else if(delivery == "all" && location != "all" && level == "all") {
			$("li.course").hide();
			$("li.course."+location).show();
		} else if(delivery == "all" && location == "all" && level != "all") {
			$("li.course").hide();
			$("li.course."+level).show();
		} else if(delivery != "all" && location != "all" && level == "all") {
			$("li.course").hide();
			$("li.course."+delivery+"."+location).show();
		} else if(delivery != "all" && location == "all" && level != "all") {
			$("li.course").hide();
			$("li.course."+delivery+"."+level).show();
		} else if(delivery == "all" && location != "all" && level != "all") {
			$("li.course").hide();
			$("li.course."+location+"."+level).show();
		} else if(delivery != "all" && location != "all" && level != "all") {
			$("li.course").hide();
			$("li.course."+delivery+"."+location+"."+level).show();
		}
	} );
	
	$( "select.filter3" ).on( "change", function() {
	 	var delivery = $("select#delivery").val();
		var industry = $("select#industries2").val();
		
		if(delivery == "all" && industry == "all") {
			$("li.course").show();
		} else if(delivery == "all" && industry != "all") {
			$("li.course").hide();
			$("li.course."+industry).show();
		} else if(delivery != "all" && industry == "all") {
			$("li.course").hide();
			$("li.course."+delivery).show();
		} else if(delivery != "all" && industry != "all") {
			$("li.course").hide();
			$("li.course."+delivery+"."+industry).show();
		}
	} );
	
	/*$('li.mega-menu').mouseenter(function () {
       $("#et-main-area").append("<div id='mega-menu-bg'></div>");
       
     });*/

	 $('li.mega-menu').mouseleave(function () {
		  $("#mega-menu-bg").remove();
	 	}
	 ).mouseleave();//trigger mouseleave to hide second div in beginning
	 
	 $('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-100').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/aviation-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/aviation-blue-1.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-43').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/business-white-icon.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/businnes-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-45').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/construction-white-icon.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/construction-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-74').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/fire-safety-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/fire-safety-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-69').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/first-aid-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/first-aid-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-47').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/hospitality-white-icon.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/06/hospitality-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-44').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/mining-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/mining-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-75').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/rsa-rsg-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/rsa-rsg-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-46').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/work-health-safety-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/work-health-safety-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-118').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/working-at-heights-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/working-at-heights-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-48').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/security-training-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/security-training-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-70').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/justice-for-the-peace-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/justice-for-the-peace-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-117').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/confined-spaces-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/confined-spaces-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-73').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/white-card-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/white-card-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-50').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/05/firearms-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/03/firearms-icon.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-90').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/online-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/online-icon-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-246499').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/funded-training-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/funded-training-icon-blue.png');
	  }
	);
	
	$('li.mega-menu ul.sub-menu li.et_pb_menu_page_id-246507').hover(
	  function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/group-bookings-icon-white.png');
	  }, function() {
		$( this ).find( "img" ).attr('src','https://ansicvpn.com/wp-content/uploads/2024/07/group-bookings-icon-blue.png');
	  }
	);
	
	$('a.button2, a.ul-button').append('<i class="fa-solid fa-arrow-right"></i>');
	$('a.more-link').append('<i class="fa-solid fa-chevron-right"></i>');
	
	$(".sidebar a.button5").click(function(){
		$("a.button5").removeClass("current");
		$(this).addClass("current");
	});
	
	$(".testi").append('<div class="dipl_testimonial_rating"><span itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating"><span class="dipl_testimonial_rating_value" itemprop="ratingValue">5</span><span class="dipl_testimonial_star dipl_testimonial_filled_star"></span><span class="dipl_testimonial_star dipl_testimonial_filled_star"></span><span class="dipl_testimonial_star dipl_testimonial_filled_star"></span><span class="dipl_testimonial_star dipl_testimonial_filled_star"></span><span class="dipl_testimonial_star dipl_testimonial_filled_star"></span></span></div>');
	
	$(".dipl_tabs_0 .dipl_tabs_controls .dipl_tabs_item_title_inner_wrap").append('<i class="fa-solid fa-arrow-right"></i>');
	
	$(".pa-blog-meta-icons .post-meta").each(function() {
		var text2 = $(this).html();
		var result2 = text2.replace(" | ", "");
		$(this).html(result2);
	});
	
	$(".et_pb_search input.et_pb_searchsubmit").attr("value", "");
	
	$(".df-button").click(function() {
		$(".to-hide").css("display", "none");
		$(".to-show").css("display", "block");
		
		var title = $(this).text();
		$("#article-title h3").text(title);
		$("#scroll-btn").css("display","inline-block");
	});
	
	$('#description-box span').replaceWith(function()
	{
	  return '<p>' + $(this).html() + '</p>';
	});
	
	$(".modes span.price p").each(function() {
		$(this).parent("span.price").text("$"+$(this).text());
		$(this).remove();
	});
	
	$('.excerpt span, .course-excerpt span, .excerpt p').replaceWith(function()
	{
	  return '<p>' + $(this).text() + '</p>';
	});
	
	/*window.addEventListener("scroll", function(){
		var title = $("body.single-courses h2.course-title");
		title.toggleClass("sticky", window.scrollY > 200);
    });
	
	$(window).scroll(function () {
		$('#menu-item-251078').toggleClass("on-scroll", ($(window).scrollTop() > 100));
	 });*/
	
	$(".et_pb_menu__search-container form.et_pb_menu__search-form").append('<input type="hidden" name="post_type" value="courses" />');
	
	$('.numbers .title').each(function () {
		var title = $(this).html();
		$(this).parent('.numbers').prepend('<h3 class="title">'+title+'</h3>');
		$(this).remove();
	});
	
	$('.interested-tabs .et_pb_tab_0').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/05/interested-in.jpg">');
	});
	
	$('.interested-tabs .et_pb_tab_1').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/06/peyment-information-scaled.jpg">');
	});
	
	$('.interested-tabs .et_pb_tab_2').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/06/what-to-expect-scaled.jpg">');
	});
	
	$('.interested-tabs .et_pb_tab_3').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/06/what-to-expect2-scaled.jpg">');
	});
	
	$('.interested-tabs .et_pb_tab_4').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/06/elegibility-check-scaled.jpg">');
	});
	
	$('.interested-tabs .et_pb_tab_5').click(function () {
		$('.image-swap .et_pb_image_wrap').html('<img src="https://ansicvpn.com/wp-content/uploads/2024/03/entering-the-workforce-scaled.jpg">');
	});
	
	var maxHeight = 0;
	$("ul.equal li.course .entry-title").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	var maxHeight = 0;
	$("ul.equal li.course .course-code").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	var maxHeight = 0;
	$("ul.equal li.course .study").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	var maxHeight = 0;
	$("#related-articles li.course .entry-title").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	var maxHeight = 0;
	$("#related-articles li.course .post-meta").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	var maxHeight = 0;
	$(".related-post p.entry-title").each(function() {
		if ($(this).outerHeight() > maxHeight) {
		  maxHeight = $(this).outerHeight();
		}
	}).height(maxHeight);
	
	$(".et-blog-css-grid .post-content-inner, #related-articles .excerpt").html(function (i, html) {
		return html.replace(/&nbsp;/g, '');
	});
	
	var href = $('.student-flyer a').attr("href");
	$('.student-flyer img').click(function () {
		window.open(href);
	});
	
	$('#404-search .et_pb_searchform').prepend('<input type="hidden" name="post_type" value="courses" />');
	$('input[name=et_pb_searchform_submit], input[name=et_pb_include_posts], input[name=et_pb_include_pages]').remove();
	
	$('.course-fee span').text(function (_,txt) {
		return txt.slice(0, -1);
	});
	
	$('.course-fee span').each(function () {
		var coursefee = $(this).text();
		let withcomma = coursefee.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		$(this).html(withcomma + ".00");
	});
	
	/* const myTimeout = setTimeout(rearrange_steps, 2000);
	
	function rearrange_steps() {
		var logins = $('#userLogin_step div.enroller-blurb-holder').next('div').html();
		$(logins).insertAfter($('#contactForm'));
		$('#userLogin_step div.enroller-blurb-holder').next('div').remove();
	} */
	
	$('.back-btn').attr('href', document.referrer);
	
    $('#tab_selector').on('change', function (e) {
		var tabID = $(this).val();
		$('.tab-content .tab-pane').removeClass("active");
		$('.tab-content .tab-pane').hide();
		$('.tab-content .tab-pane').addClass("fade");
		$(tabID).removeClass("fade");
		$(tabID).addClass("active");
		$(tabID).show();
    });
	
	$('a.enrol-link').click(function () {
		$(this).css({
			background: "#82AC2B",
			color: "#fff"
		});
		setTimeout(remove_background, 500);
	});
	
	function remove_background() {
		$('a.enrol-link').css({
			background: "#fff",
			color: "#00203C"
		});
	}
	
	$('#delivery').select2({
		theme: "classic"
	});
	$('#sort').select2({
		theme: "classic"
	});
	
	$('#industries2').select2({
		theme: "classic"
	});
	
	$('.launch-btn').click(function () {
		var id = $(this).attr("data-target");
		$(id).modal('show');
	});
	
	$('button.close').click(function () {
		$('#enrolmentEnquiry').modal('hide');
	});
	
	if(isMobile == true) {
		$('<a href="tel:1300100284" class="call-btn"><i class="fa-solid fa-phone"></i></a>').insertAfter('.main-menu button.et_pb_menu__icon.et_pb_menu__search-button');
	}
	
	if(isMobile == true) {
		$('.select2-container').css("width", "100%");
	}
	
	/*if(isMobile == true) {
		$('.et_pb_menu__logo a').append('<h1>Australian Training<br /> Institute</h1>');
	}*/
	
	function dvcs_collapse_menu_module_submenus_on_mobile(parentClickable = false) {
      // Mobile menu
      let $menu = $('.et_pb_module .et_mobile_menu');
      // Iterate the mobile menu links
      $menu.find('a').each(function() {
      
      // Menu hamburger icon
      let $menu_icon = $(this).parents('.mobile_nav').find('.mobile_menu_bar');
      // Remove click event handlers from the link
      $(this).off('click');
      // If the menu item DOESN'T HAVE submenus
      if( ! $(this).siblings('.sub-menu').length ) {
        // Close the mobile menu on link click
        $(this).on('click', (e) => $menu_icon.trigger('click'));
      } else {
        // If parent items links are DISABLED
        if( ! parentClickable ){
          // Replace the URL with the # symbol
          $(this).attr('href', '#');
          // Open/close the submenu on link click
          $(this).on('click', (e) => toggle_visible(e, $(this).parent()));
        } else {
          // Add the "clickable" class to the parent(<li> tag)
          $(this).parent().addClass('clickable')
            // Prepend the icon to parent
            .prepend('<span class="parent_icon"></span>')
            // Open/close the submenu on icon click
            .find('.parent_icon').on('click', (e) => toggle_visible(e, $(this).parent()));
          // Link click
          $(this).on('click', function(e){
            // Toggle the submenu if the link doesn't have a URL or anchor
            if ( $(this).attr('href') === '#' ) {
              toggle_visible(e, $(this).parent());
            } else {
              // Close the mobile menu
              $menu_icon.trigger('click');
            }
          });
        }
      }
    });
    
    /**
     * Toggles the 'visible' class on passed element.
     */
    const toggle_visible = (e, elem) => {
      e.preventDefault();
      elem.toggleClass('visible');
    }
   }
    $(function() {
    /**
     * Call the function with a delay to allow
     * the mobile menu(s) be ready first.
     * 
     * To keep parent links clickable pass true (boolean) as argument.
     */
     setTimeout(function() {
         dvcs_collapse_menu_module_submenus_on_mobile(true);
     }, 700);
   });
	
	$('td.instance_startdate').each(function() {
		let times = $(this).find('br').get(0).nextSibling.nodeValue;
		var myarr = times.split("-");
		var from = myarr[0].trim();
		if(from.charAt(0) == "0") {
			from = from.substring(1);
		}
		var to = myarr[1].trim();
		if(to.charAt(0) == "0") {
			to = to.substring(1);
		}
		$(this).find('br').get(0).nextSibling.nodeValue = from + " - " + to;
	});
	
	$('td.instance_name').each(function() {
		let times = $(this).find('br').get(0).nextSibling.nodeValue;
		var myarr = times.split("-");
		var from = myarr[0].trim();
		if(from.charAt(0) == "0") {
			from = from.substring(1);
		}
		var to = myarr[1].trim();
		if(to.charAt(0) == "0") {
			to = to.substring(1);
		}
		$(this).find('br').get(0).nextSibling.nodeValue = from + " - " + to;
	});
	
	$("p").each(function(){
		if($(this).html()=="&nbsp;") {
			$(this).remove();
		}   
	});
	
	if(isMobile == false && $("#enroller").length == 1) {
		setTimeout($("#enroller").addClass('enroller-layout-left'), 500);
	} 
	
	$("#upcoming h4").remove();
	$("<h4>Upcoming Courses</h4>").insertBefore("#upcoming h2");
	
	/*if(isMobile == false && $(".white-bg-sidebar").length == 1 ) {
		var course_fee = $(".course-fee").outerHeight(true);
		var single_course__calendar = $(".single-course__calendar").outerHeight(true);
		var course_image = $(".course-image").outerHeight(true);
		var student_flyer = $(".student-flyer").outerHeight(true);
	}*/
	
	if($('.enroller-content').length == 1 && isMobile == true) {
		function autoScroll() {
			var div = document.getElementById("page-container");
			div.style.display = '';
			var top = div.offsetTop;
			if(window.scrollTop != top) 
				window.scrollTo(0, top);
		}
		function loadAutoScroll() {
			autoScroll();
			window.onload = null;
			return false;
		}
		function scrollAutoScroll() {
			autoScroll();
			window.setTimeout(function(){ window.onscroll = null; }, 100);
			return false;
		}
		window.onload = loadAutoScroll;
		window.onscroll = scrollAutoScroll;
	}
	
	$('a.worksholp-link').click(function () {
		const id = $(this).data('id');
		const worktable = $("#"+id).html();
		$("#upcoming").html(worktable);
	});
	
	setTimeout(setRequired, 1500); 
	
	function setRequired() {
		$("#contactCreate .enroller-field-holder:first-child .enroller-field-label").addClass(" ui-nodisc-icon ui-icon-required ui-btn-icon-right required-field");
	}
	
	if($('.dipl_testimonial_slider_0 .swiper-container').length == 1) {
		var dipl_testimonial_slider_0_swiper = new Swiper('.dipl_testimonial_slider_0 .swiper-container',{
			slidesPerView: 1,
			autoplay: {
				delay: 3000,
				disableOnInteraction: true,
			},
			spaceBetween: 20,
			slidesPerGroup: 1,
			slidesPerGroupSkip: 0,
			effect: "slide",
			cubeEffect: false,
			coverflowEffect: false,
			fadeEffect: false,
			speed: 1000,
			loop: true,
			autoHeight: false,
			pagination: {
				el: '.dipl_testimonial_slider_0 .swiper-pagination',
				dynamicBullets: false,
				clickable: true,
			},
			navigation: {
				nextEl: '.dipl_testimonial_slider_0 .swiper-button-next',
				prevEl: '.dipl_testimonial_slider_0 .swiper-button-prev',
			},
			grabCursor: 'true',
			observer: true,
			observeParents: true,
			breakpoints: {
				981: {
					slidesPerView: 1,
					spaceBetween: 20,
					slidesPerGroup: 1,
					slidesPerGroupSkip: 0,
				},
				768: {
					slidesPerView: 1,
					spaceBetween: 20,
					slidesPerGroup: 1,
					slidesPerGroupSkip: 0,
				},
				0: {
					slidesPerView: 1,
					spaceBetween: 20,
					slidesPerGroup: 1,
					slidesPerGroupSkip: 0,
				}
			},
		});
		$(".dipl_testimonial_slider_0 .swiper-container").on("mouseenter", function(e) {
			if (typeof dipl_testimonial_slider_0_swiper.autoplay.stop === "function") {
				dipl_testimonial_slider_0_swiper.autoplay.stop();
			}
		});
		$(".dipl_testimonial_slider_0 .swiper-container").on("mouseleave", function(e) {
			if (typeof dipl_testimonial_slider_0_swiper.autoplay.start === "function") {
				dipl_testimonial_slider_0_swiper.autoplay.start();
			}
		});
	}
});
