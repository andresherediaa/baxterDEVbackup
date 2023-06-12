/*------------------------------------------------------------------------------
 Main JS file for baxter theme
----------------------------------------------------------------------------- */

(function($) {

  function updateExhibition() {
    const scheduleSelect = $('.gallery-form #schedule')
    // const locationSelect = $('.gallery-form #location')
    // const yearSelect = $('.gallery-form #exhibition_year')
  
    const schedule = scheduleSelect.val()
    // const location = locationSelect.val()
    // const year = yearSelect.val()
  
    // const url = `/all-exhibitions?schedule=${schedule}&location=${location}&exhibition_year=${year}`
    console.log("pafina de all exibithions", url)
    const url = `/baxter/all-exhibitions?schedule=${schedule}`
    document.location.href = url
  }

  function updateVideo() {
    const categorySelect = $('.video-form #category');
  
    const category = categorySelect.val();
  
    const url = `/videos?category=${category}`;
    document.location.href = url;
  }
  
  function updateCalendar() {
    const scheduleSelect = $('.gallery-form.calendar-form #schedule')
    // const locationSelect = $('.gallery-form.calendar-form #location')
    // const yearSelect = $('.gallery-form.calendar-form #exhibition_year')
    const typeSelect = $('.gallery-form.calendar-form #type')
  
    const schedule = scheduleSelect.val()
    // const location = locationSelect.val()
    // const year = yearSelect.val()
    const type = typeSelect.val()
  
    // const url = `/calendar?schedule=${schedule}&location=${location}&exhibition_year=${year}`
    const url = `/calendar?schedule=${schedule}&type=${type}`
    document.location.href = url
  }

  // Gallery
  const galleryScheduleSelect = $('.gallery-form #schedule')
  const galleryLocationSelect = $('.gallery-form #location')
  const galleryYearSelect = $('.gallery-form #exhibition_year')

  galleryScheduleSelect.change(function() {
    updateExhibition()
  })

  galleryLocationSelect.change(function() {
    updateExhibition()
  })

  galleryYearSelect.change(function() {
    updateExhibition()
  })
	
  //Videos
  /* const videosCategorySelect = $('.video-form #category');
  videosCategorySelect.change(function() {
    updateVideo()
  }); */

  // Calendar
  const calendarScheduleSelect = $('.gallery-form.calendar-form #schedule')
  // const calendarLocationSelect = $('.gallery-form.calendar-form #location')
  // const calendarYearSelect = $('.gallery-form.calendar-form #exhibition_year')
  const calendarTypeSelect = $('.gallery-form.calendar-form #type')

  calendarScheduleSelect.change(function() {
    updateCalendar()
  })

  // calendarLocationSelect.change(function() {
  //   updateCalendar()
  // })

  // calendarYearSelect.change(function() {
  //   updateCalendar()
  // })

  calendarTypeSelect.change(function() {
    updateCalendar()
  })
	
  // Newsletter
  const form = document.getElementById("hidden-form-js")
  const message = document.getElementById("mce-success-response")
  
  if (message.style.display == "block"){
	  form.style.display = 'none'
  } else {
	  form.style.display = 'block'
  }

  // Residency
  const residencyYearSelect = $('.gallery-form.residency-form #residency_year')

  residencyYearSelect.change(function() {
    const year = residencyYearSelect.val()
    if (year) {
      const url = `/artist-in-residence?residency_year=${year}#content-residency`
      document.location.href = url
    }
  })


  $('#burger').change(function(e) {
    $('html').toggleClass('hamburger-enabled')
  })

  $('.primary-events-slider').slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    dots: true
  })

  $('.secondary-events-slider .left-right-inner').slick({
    arrows: true,
    autoplay: false,
    dots: false,
	adaptiveHeight: true
  })

  $('.exhibitions-slider').slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    dots: true
  })

  $('.modal__close').click(function(e) {
    $('.modal').toggleClass('active')
  })

  $('.subscribe-button').click(function(e) {
    e.preventDefault()
    $('.modal').toggleClass('active')
  })

  $('.load-more a').click(function(e) {
    e.preventDefault()
    const page = baxter_pagination.paged
    const query_vars = baxter_pagination.query
    const categoryTerm =baxter_pagination.categoryTerm
    const content = $(e.currentTarget).parent('.load-more').data('content')
    $.ajax({
      url: '/wp-admin/admin-ajax.php', //aha
      type: 'post',
      data: {
        action: 'baxter_pagination_' + content,
        page: page,
        query_vars: query_vars
      },
      success: function(result) {
        if (result) {
          $('#content-loop').append(result)
        } else {
          $('.load-more').remove()
        }
        baxter_pagination.paged += 1
      }
    })
  })
	
  //Menu
  var $conversation = $(".post-eyebrow").hasClass("conversation");
  var $competition = $(".post-eyebrow").hasClass("juried_competition");
  var $bookFair = $(".post-eyebrow").hasClass("book_fair");
  var $coffeeTalk = $(".post-eyebrow").hasClass("coffee_talk");
  if ($conversation || $competition || $bookFair || $coffeeTalk) {
	$(".menu-item-20687").addClass("removeHighlight");
	$(".menu-item-20692").addClass("addHighlight");
  }
	
  //Calendar options on Menu bar
  var currentUrl = window.location.href;
  var paramString = currentUrl.split('?')[1];
  let queryString = new URLSearchParams(paramString);
  for(let pair of queryString.entries()) {
 	if("event_from" == pair[0]) {
	  let source = pair[1];
	  if("menu" == source) {
	    $(".menu-item-20665").addClass("removeHighlight");
		$(".calendar-form").css("display", "none");
	  }
	  else {
		$(".menu-item-20692").addClass("removeHighlight");
	  }
	}
  }
	
  //Exhibitions highlight
  var currentUrl = window.location.href;
  var currentPage = currentUrl.split('/')[3];
  if('all-exhibitions' == currentPage) {
	  $('.menu-item-20687').addClass('addHighlight');
  }
  else {
	  $('.menu-item-20687').addClass('removeHighlight');
  }
  /*let queryString = new URLSearchParams(paramString);
  for(let pair of queryString.entries()) {
 	if("event_from" == pair[0]) {
	  let source = pair[1];
	  if("menu" == source) {
	    $(".menu-item-20665").addClass("removeHighlight");
		$(".calendar-form").css("display", "none");
	  }
	  else {
		$(".menu-item-20692").addClass("removeHighlight");
	  }
	}
  }*/
	
  //Filter and Search in Alumni
  function filterAlumniType() {
    const typeSelect = $('.alumni-form #filter_type')
    const alumni_type = typeSelect.val()
    const url = `/all-alumni?alumni_type=${alumni_type}`;
    document.location.href = url;
  }
	
  function filterAlumniProgram() {
    const programSelect = $('.alumni-form #filter_program');
	const related_program = programSelect.val();
	const url = `/all-alumni?related_program=${related_program}`;
	document.location.href = url;
  }
	
  function filterAlumniOrder() {
	const orderBySelect = $('.alumni-form #filter_order_by');
	const order_by = orderBySelect.val();
    const url = `/all-alumni?order_by=${order_by}`;
	document.location.href = url; 
  }
	
  function searchAlumni() {
	const searchInput = $('.alumni-form #search_param');
	const search_param = searchInput.val();
	const url = `/all-alumni?search_param=${search_param}`;
	document.location.href = url;
  }
	
  const alumniSearchButton = $('.alumni-form .search-button-alumni');
  alumniSearchButton.click(function() {
	  searchAlumni();
  })
	
  $(document).on('change', '.alumni-form #filter_type', function() {
	  filterAlumniType();
  })
  $(document).on('change', '.alumni-form #filter_program', function() {
	  filterAlumniProgram();
  })
  $(document).on('change', '.alumni-form #filter_order_by', function() {
	  filterAlumniOrder();
  })
	
  //Set image width and height for Alumni gallery with CSS
  function setMeasure() {
	  $('.alumni-gallery-img').one('load', function(){
		  var height = $(this).height();
		  var width = $(this).width();
		  if(width > height){
			  $(this).addClass("full-width-img")
		  }
		  else {
			  $(this).addClass("full-height-img")
		  }
	  })
  }

  //Reset search results on Alumni page
  const resetLinkRef = $('.alumni-form .reset-link')
  resetLinkRef.click(function() {
	  const url = '/all-alumni'
      document.location.href = url
  })
	
  function setImageInViewer(imgElement) {
    imgElement.addClass('active-img-alumni');
	$('.single-selected-img').attr('src',imgElement.attr('src'));
	var title = $('.title--img').append(imgElement.attr('title'));
	var description = $('.description--img').append(imgElement.attr('alt'));
	if(title != '')
		$('.alumni-gallery-viewer').removeClass('hide-gallery-viewer');
	if(description != '')
		$('.alumni-gallery-viewer').addClass('show-gallery-viewer');
  }
	
  //Alumni gallery viewer
  $(document).on('click', '.alumni-gallery-img', function() {
	setImageInViewer($(this)); 
  })
  
  $(document).on('click', '.close-alumni-gallery', function() {
	$('.alumni-gallery-viewer').removeClass('show-gallery-viewer');
	$('.alumni-gallery-viewer').addClass('hide-gallery-viewer');
	$('.title--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
	$('.description--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
  })
	
  $(document).on('click', '.right-arrow--alumni', function() {
	var currentImg = $('.active-img-alumni');
	var nextImg = currentImg.next();
	if (nextImg.length){
	  $('.title--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
	  $('.description--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
	  setImageInViewer(nextImg);
	  currentImg.removeClass('active-img-alumni');
	  nextImg.addClass('active-img-alumni');
	}
  })
	
	
  $(document).on('click', '.left-arrow--alumni', function() {
	var currentImg = $('.active-img-alumni');
	var prevImg = currentImg.prev();
	if (prevImg.length){
	  $('.title--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
	  $('.description--img').contents().filter(function(){ return this.nodeType != 1; }).remove();
	  setImageInViewer(prevImg);
	  currentImg.removeClass('active-img-alumni');
	  prevImg.addClass('active-img-alumni');
	}
  })
	
  //Fix long strings in Select Elements
  $('select').on('change', function() {
	$(this).find('option').removeClass('selected');
	$(this).find('option:selected').addClass('selected');
  });
	
  $('.single-baxter_alumni').ready(setMeasure());
	
	
  //Hide and show arrows in Alumni Gallery
  var timeout = null;
  function animateArrows() {
    clearTimeout(timeout);
    $('.right-arrow--alumni').css('visibility', 'visible');
    $('.left-arrow--alumni').css('visibility', 'visible');
    timeout = setTimeout(function() {
      $('.right-arrow--alumni').css('visibility', 'hidden');
      $('.left-arrow--alumni').css('visibility', 'hidden');
    }, 3000);
  }

  $(document).on('mousemove', '.single-alumni-page', function() {
    animateArrows();
  });

  var paged = 1;
  var category_def = '';
  function ajax_call (category_def, paged) {
    $.ajax({
            url: url_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_posts_by_category',
                category: category_def,
                paged
            },
            success: function(response) {
            if (response.success) {
                var container = jQuery('#content-loop');
                container.append(response.data.html);
                if (response.data.max_num_pages > paged) {
                    $('.load-more-video').show();
                } else {
                    $('.load-more-video').hide();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
        }
        });
  }

  $('.video-form #category').on('change', function() {
    category_def = $(this).val();
    if (!category_def.length) {
        category_def = "Conversations,Interviews,Lectures,Auctions"
    }
    paged = 1;
    var container = jQuery('#content-loop');
    container.html(''); 
    ajax_call(category_def, paged);
  });

  $('.load-more-video').click(function(e) {
    e.preventDefault();
    paged +=1;
    ajax_call(category_def, paged);
  })

  $(document).ready(function() {
    $('.video-form #category').trigger("change")
  });

  jQuery(document).ajaxStart(function () {
    jQuery('.loader').show();
  });

  jQuery(document).ajaxStop(function () {
    jQuery('.loader').hide();
  });

})(jQuery)


