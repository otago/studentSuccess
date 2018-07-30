/*!
 *  -  - Build  
 */
if(typeof app === 'undefined') { var app = {}; }

(function($){
	"use strict";

	app.accordion = (function(){
		
		var items = $('.accordion-c');
		
		var initItem = function(container) {
			var holder = container;

			holder.find('.title-c a').click(function() {
				var title = $(this).parent();
				
				if(!title.hasClass('active')) { 
					var nextItem = title.next('.accordion-item');

					holder.find('.accordion-item').hide().each(function(i, elem) {
						$(elem).prev('.title-c').removeClass('active');
					});

					title.addClass('active');
					nextItem.addClass('active').show();

					app.carousel.init();
                                        if (typeof dataLayer !== 'undefined') {
                                        
                                        
                                        $(".flex-nav-next, .slide-letters li").click(function(){
                                          dataLayer.push({
                                                'event':'ForceClick',
                                                'eventCategory': "carousals", //create a datalayer variable macro called eventCategory
                                                'eventAction': $("h2.active a").html(), //create a datalayer variable macro called eventAction
                                                'eventLabel': window.location.href //create a datalayer variable macro called eventLabel
                                            });
                                            

                                          });
}
                                          
					if(title.offset().top < $(window).scrollTop()) {
						$('html, body').animate({
							'scrollTop': title.offset().top
						}, 0, function() {
							$(window).trigger('resize');
						});
					} else {
						$(window).trigger('resize');
					}
				}
				else {
					title.removeClass('active').next('.accordion-item').hide();
				}
				
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			$(".accordion-c .accordion-item:not(.active)").hide();

			items.each(function(){
				initItem($(this));
			});
			
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($) {
	app.activities = (function() {
		
		var can = function() {
			return $(".activity_navigation .btn").length > 0;
		};
		
		var init = function () {
			$(".activity_text__ShowContent li").on('click', function(e) {
				var id = $(this).data('activity-value');

				$(this).parents('.activity_content').fadeOut(function() {
					$('.activity_content__answer').each(function(i, elem) {
						if($(elem).data('answer-id') === id) {
							$(elem).fadeIn();
						}
					});
				});
			});

			$(".activity_navigation .btn").on('click', function(e) {
				
				e.preventDefault();

				if($(this).hasClass('loading')) {
					return;
				}

				$(this).addClass('loading');
                                
                                header='Activity ' + $(".activity_header h3").text();

				// validate the current step
				var valid = true,
					btn = $(this),
					activity = $(this).parents('.activity'),
					step = activity.find('.activity_individual.current'),
					steps = activity.find('.activity_individual'),
					text = step.find('.activity_text'),
					nextStep = step.next('.activity_individual'),
					options = text.find('ul:not(.labels) > li'),
					canProgress = true,
					currentProgress,
					isValidAnswer;

				if($(this).hasClass('back') && !$(this).hasClass('review')) {
					nextStep = step.prev('.activity_individual');

					//
					// The user has requested to go back. Perform animation
					// in reverse.
					//
					// progress the top count
					currentProgress = $(".activity_header .progress .current");

					currentProgress
						.removeClass('current').parents('li').prev('li').find('a')
						.addClass('current');

					// progress the next button
					step.animate({
						left: '20px',
						opacity: 0
					}).removeClass('current');

					nextStep.css({
						opacity: 0,
						left: '-20px'
					}).addClass('current').animate({
						opacity: 1,
						left: 0
					}, function() {
						// now we have the new slide we need to update the footer
						// to include a back button and update the text.
						var remaining = nextStep.prevAll('.activity_individual').length;

						if(remaining < 1) {
							btn.addClass('hidden');
							var text = nextStep.prevAll('.activity_individual').first().hasClass('activity_TextSlide') ? 'Start' : 'Next';

							btn.siblings('.next').html(text).removeClass('hidden');
						} else {
							btn.siblings('.next').html("Next").removeClass('hidden');
						}

						btn.removeClass('loading');

						if(step.parents('.fancybox-outer').length < 1) {
							$('html, body').animate({
								'scrollTop': nextStep.offset().top
							});
						}
					});

					return;
				}

				if($(this).hasClass('review')) {
					// review. If button has review class then we're going back
					// in each step in read only mode.

					// special case for on the results slide, go back to the 
					// first non text slide
					if(step.hasClass('activity_ResultsSlide')) {
						// take the user back to the first slide
						steps.each(function(i, elem) {
							if($(elem).hasClass('activity_TextSlide')) {
								return;
							}

							step.animate({
								left: '-20px',
								opacity: 0
							}).removeClass('current');

							$(elem).css({
								opacity: 0,
								left: '20px'
							}).addClass('current').animate({
								opacity: 1,
								left: 0
							}, function() {
								// go through each of the steps and make sure they have been displaying results
								steps.each(function(i, s) {
									if($(s).hasClass('activity_ResultsSlide') || $(s).hasClass('.activity_TextSlide')) {
										return;
									}

									$(s).find('[data-validation=correct]').addClass('correct');
									$(s).find('[data-validation=wrong]').addClass('wrong');

									if($(s).data('valid')) {
										$(s).find('.activity_fail_warning').hide();
										$(s).find('.activity_fail').hide();
										$(s).find('.activity_success').show();
									} else {
										$(s).find('.activity_fail_warning').hide();
										$(s).find('.activity_fail').show();
										$(s).find('.activity_success').hide();
									}
								});

								btn.removeClass('loading');

								if($(elem).hasClass('activity_ResultsSlide')) {
									btn.text('See correct answers');
								} else {
									btn.text('Next');
								}
							});

							return false;
						});
					} else {
						if($(this).hasClass('back')) {
							nextStep = step.prev('.activity_individual');
						}
						
						step.animate({
							left: '20px',
							opacity: 0
						}).removeClass('current');

						nextStep.css({
							opacity: 0,
							left: '-20px'
						}).addClass('current').animate({
							opacity: 1,
							left: 0
						}, function() {
							if(step.parents('.fancybox-outer').length < 1) {
								$('html, body').animate({
									'scrollTop': nextStep.offset().top
								});
							}
						});

					}

					return;
				}

				// we need to know whether this is valid on each step or at
				// the end. If this is the last stop then we need to populate
				// the 
				var validationModel = activity.data('validation-method');
				var showResults = (validationModel === "OnEachStep");

				// validate the users current step first. Ensure that 
				// options exist.
				var attempt = step.data('attempt');
				var allowedAttempts = activity.data('max-attempts');
					
				if(!allowedAttempts) {
					allowedAttempts = 3;
				}

				var answers = step.find('.activity_answers li');

				if(!attempt) {
					attempt = 0;
				}

				attempt++;
                                dataLayer.push({
                                    'event':'ForceClick',
                                    'eventCategory':  header, //create a datalayer variable macro called eventCategory
                                    'eventAction': 'Attemp ' + attempt, //create a datalayer variable macro called eventAction
                                    'eventLabel': '' //create a datalayer variable macro called eventLabel
                                });
				step.data('attempt', attempt);
				var selected;

				if(options.length > 1) {
					if(step.find('.activity_text__SelectAny').length > 0) {
						// user must select at least one option.
						selected = options.filter('.selected');

						if(selected.length < 1) {
							valid = false;
							canProgress = false;
						}
					}
					else if(step.find('.activity_fail').length < 1) {
						// has no wrong content so assume no validation.
						valid = true;
					}
					else if(step.find('.activity_text__MultiChoice').length > 0 || step.find('.activity_text__SingleChoice').length || step.find('.activity_text__Paragraph').length > 0) {
						selected = options.filter('.selected');

						selected.each(function(i,  check) {
							isValidAnswer = false;

							answers.each(function(x, answer) {
								if($(answer).text() === $(check).text()) {
									isValidAnswer = true;
								}
							});

							if(!isValidAnswer) {
								valid = false;

								// if this is on the 3rd attempt then show the user the error messages
								if(attempt >= allowedAttempts) {
									if(showResults) {
										$(check).removeClass('correct');
										$(check).addClass('wrong');
									}
								}

								$(check).attr('data-validation', 'wrong');
							} else {
								if(showResults) {
									$(check).removeClass('wrong');
									$(check).addClass('correct');
								}
								
								$(check).attr('data-validation', 'correct');
							}
						});

						answers.each(function(x, answer) {
							options.each(function(o, opt) {
								if(($(opt).text() === $(answer).text())) {
									$(opt).addClass('correctAnswer');
									
									if(!$(opt).hasClass('selected')) {
										isValidAnswer = false;
										valid = false;

										if(attempt >= allowedAttempts) {
											if(showResults) {
												$(opt).removeClass('correct');
												$(opt).addClass('wrong');
											}
										}

										$(opt).attr('data-validation', 'wrong');
									}
								}
							});
						});

						if(valid || attempt >= allowedAttempts) {						
							step.addClass('readonly');
							markReadonly(step);
						}
					} else if(step.find('.activity_text__Replace').length > 0) {
						options.filter('.replaceable').each(function(i, elem) {
							if($(answers.get(i)).text() !== $(elem).text()) {
								valid = false;

								$(elem).removeClass('correct');
								$(elem).addClass('wrong');

								if(attempt >= allowedAttempts) {
									if(showResults) {
										step.addClass('readonly');
										markReadonly(step);
									}
								}

								$(elem).attr('data-validation', 'wrong');
							} else {
								$(elem).addClass('correct');
								$(elem).removeClass('wrong');
								
								$(elem).attr('data-validation', 'correct');
							}
						});

						if(valid || (attempt >= allowedAttempts)) {
							step.addClass('readonly');
							markReadonly(step);
						}
					} else if(step.find('.activity_text__DragAndDrop').length > 0 || step.find('.activity_text__DragAndDropToMatch').length > 0) {
						options.each(function(i, elem) {
							if($(answers.get(i)).text() !== $(elem).text()) {
								valid = false;

								if(attempt >= allowedAttempts) {
									if(showResults) {
										$(elem).removeClass('correct');
										$(elem).addClass('wrong');

										step.addClass('readonly');
										markReadonly(step);
									}
								}

								$(elem).attr('data-validation', 'wrong');
							} else {
								if(attempt >= allowedAttempts) {
									if(showResults) {
										$(elem).addClass('correct');
										$(elem).removeClass('wrong');
									}
								}

								$(elem).attr('data-validation', 'correct');
							}
						});

						if(valid || (attempt >= allowedAttempts)) {
							step.addClass('readonly');
							markReadonly(step);
						}
					}

					if(!valid) {
						step.data('valid', false);

						if(showResults) {
							step.find('.activity_success').hide();

							if(attempt >= allowedAttempts) {
								step.find('.activity_fail_warning').hide();

								if(step.find(".activity_fail").is(":visible")) {
									canProgress = true;
								} else {
									step.find(".activity_fail").show();
									canProgress = false;
								}
							} else {
								step.find(".activity_fail").hide();
								step.find('.activity_fail_warning').show();

								canProgress = false;
							}
						}
					} else {
						step.data('valid', true);

						if(showResults) {
							step.find('.activity_fail_warning').hide();
							step.find('.activity_fail').hide();

							if(step.find('.activity_success').is(":visible")) {
								canProgress = true;
							} else {
								if(step.find('.activity_success').length > 0) {
									canProgress = false;
									
									step.find('[data-validation=correct]').addClass('correct');
									step.find('[data-validation=wrong]').addClass('wrong');

									step.find('.activity_success').show();
								} else {
									canProgress = true;
								}
							}
						}
					}
				}

				// all valid so do the form animation
				if(canProgress) {
					// progress the top count
					currentProgress = $(".activity_header .progress .current");

					currentProgress
						.removeClass('current').parents('li').next('li').find('a')
						.addClass('current');

					if(nextStep.hasClass('activity_ResultsSlide')) {
						// this slide is a results slide so go through each of the previous steps and get the count of
						// valid and invalid results.

						var existing = nextStep.find('.activity_results');

						if(existing.length < 1) {
							existing = $("<div class='activity_results'><span class='right'></span><span class='wrong'></span></div>");

							nextStep.find('h3').after(existing);
						}

						steps = activity.find('.activity_individual');
						
						var right = 0,
							wrong = 0;

						steps.each(function(i, elem) {
							if($(elem).data('valid') === false) {
								wrong++;
							} else if($(elem).data('valid') === true) {
								right++;
							}
						});

						nextStep.find('.right').text(right);
						nextStep.find('.wrong').text(wrong);
					}
					// progress the next button
					step.animate({
						left: '-20px',
						opacity: 0
					}).removeClass('current');

					nextStep.css({
						opacity: 0,
						left: '20px'
					}).addClass('current').animate({
						opacity: 1,
						left: 0
					}, function() {
						// now we have the new slide we need to update the footer
						// to include a back button and update the text.
						btn.siblings('.back').removeClass('hidden');

						var remaining = nextStep.nextAll('.activity_individual').length;
						if(remaining < 1 && nextStep.hasClass('activity_ResultsSlide')) {
							activity.addClass('readonly');
							markReadonly();

							if(validationModel === "OnComplete") {
								// add a button to see your results
								btn.text('See correct answers').addClass('review');
								btn.siblings('.back').addClass('review').addClass('hidden');
							} else {
								btn.addClass('hidden');
							}
                                                        dataLayer.push({
                                                        'event':'ForceClick',
                                                                'eventCategory':  header, //create a datalayer variable macro called eventCategory
                                                                'eventAction': 'Finished ', //create a datalayer variable macro called eventAction
                                                                'eventLabel': '' //create a datalayer variable macro called eventLabel
                                                            });
						} else if(remaining === 1) {
							btn.html('Finish');
                                                        dataLayer.push({
                                                        'event':'ForceClick',
                                                                'eventCategory':  header, //create a datalayer variable macro called eventCategory
                                                                'eventAction': 'Finished ', //create a datalayer variable macro called eventAction
                                                                'eventLabel': '' //create a datalayer variable macro called eventLabel
                                                            });
						} else if(remaining > 0) {
							btn.html("Next");
						} else {
							btn.addClass('hidden');
                                                        test=$(".activity_header h3").text();
                                                        //alert($(".activity_header #h3").text());
                                                        dataLayer.push({
                                                        'event':'ForceClick',
                                                                'eventCategory':  header, //create a datalayer variable macro called eventCategory
                                                                'eventAction': 'Finished ', //create a datalayer variable macro called eventAction
                                                                'eventLabel': '' //create a datalayer variable macro called eventLabel
                                                            });
						}

						btn.removeClass('loading');

						if(step.parents('.fancybox-outer').length < 1) {
							$('html, body').animate({
								'scrollTop': nextStep.offset().top
							});
						}
					});
				} else {
					btn.removeClass('loading');
				}
			});
			
			var markReadonly = function(activity) {
				if(!activity) {
					activity = $("body");
				}

				activity.find('.activity_individual').addClass('readonly');

				activity.find(".activity_text__DragAndDrop").each(function(i, elem) {
					$(elem).find('ul.ui-sortable').sortable('disable');
				});

				activity.find(".activity_text__DragAndDropToMatch").each(function(i, elem) {
					$(elem).find('ul.ui-sortable').sortable('disable');
				});

				activity.find(".activity_text__Replace").each(function(i, elem) {
					$('li', elem).attr('contenteditable', false);
				});
			};

			$(".activity_text__DragAndDrop").each(function(i, elem) {
				$('ul', elem).addClass('hassortable').sortable({
					start: function(event, ui) {
						$(ui.item).addClass('changed');
					}
				});
			});

			$(".activity_text__DragAndDropToMatch").each(function(i, elem) {
				$('ul:not(.labels)', elem).sortable({
					start: function(event, ui) {
						$(ui.item).addClass('changed');
					}
				});
			});

			$(".activity_text__Paragraph, .activity_text__MultiChoice").each(function(i, elem) {
				$('li', elem).click(function() {
					if($(this).parents('.activity').hasClass('readonly')) {
						return false;
					}

					if($(this).parents('.activity_individual').hasClass('readonly')) {
						return false;
					}

					$(this).toggleClass('selected');
				});
			});

			$(".activity_text__SingleChoice, .activity_text__SelectAny").each(function(i, elem) {
				$('li', elem).click(function() {
					if($(this).parents('.activity').hasClass('readonly')) {
						return false;
					}

					if($(this).parents('.activity_individual').hasClass('readonly')) {
						return false;
					}

					$(this).toggleClass('selected');
					$(this).toggleClass('changed');

					$(this).siblings('.selected').removeClass('selected');
					$(this).siblings('.changed').removeClass('changed');

					$(this).parents('.activity').find(".activity_navigation .next").click();
				});
			});

			$(".activities-trigger").trigger('click');
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.bgimage = (function(){
		
		var items = $('.bg-image');
		
		var setSize = function(holder){
			
			var images = holder.find('img');
			var topMargin = 0;
			
			if(holder.hasClass('fixed') && holder.data('top') && $(holder.data('top')).length){
				topMargin = $(holder.data('top')).height();
			}
			
			var rootWidth = holder.width();
			var rootHeight = holder.height();
			
			images.each(function(){
				var img = $(this);
				var ratio = img.data('ratio');
				var bgCSS = {left: 0, top: 0};
				
				if(!ratio){
					ratio = img.width() / img.height();
					img.data('ratio', ratio);
				} 
				
				var imgWidth = rootWidth;
				var imgHeight = rootWidth / ratio;
				
				if(imgHeight > rootHeight){
					var topPos = (-1 * ((imgHeight - rootHeight) / 2)) + topMargin;
					
	            	bgCSS.top = topPos + 'px';
				}
				else{
					imgHeight = rootHeight;
	                imgWidth = imgHeight * ratio;
                  	bgCSS.left = '-' + ((imgWidth - rootWidth) / 2) + 'px';
				}
				
				
				img.css({width: imgWidth, height: imgHeight}).css(bgCSS);
				
				
			});
			
			holder.addClass('loaded');
				
			
		};
		
		var setSizeAll = function(){
			items.each(function(){
				setSize($(this));
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			
			items.each(function(){
				var item = this;
				imagesLoaded(item, function(){
					setSize($(item));
				});
			});
			
			$(window).resize(setSizeAll);
		};
		
		return {
			'init'			: init,
			'can'			: can,
			'setSize'		: setSize
		};
		
	})();
	
	
})(jQuery);;
if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($) {
	app.carousel = (function() {
		var items = $('.carousel-items');
		var smartItems = $('.smart-slider');
		
		var  initSmartSlider = function(holder){
            var top = holder.closest('.smart-slide');
            var letters = top.find('.slide-letters li');
            top.find('.slide-letters li:first-child').addClass('active');
			
			holder.flexslider({
				animation 	    : 'slide',
				smoothHeight	: false,
				prevText		: "",
				slideshow		: false,
				animationSpeed  : 200,
			    nextText		: "",
				after: function(slider) {
                    var current = slider.currentSlide + 1;
                    letters.removeClass('active');
                    top.find('li.letter-' + current).addClass('active');
				},
				start: function() {
					$(window).trigger('resize');
				}
			});

            letters.click(function(){
                var index = $(this).data('count');
                index -= 1;
                if(index < 0){
                    index = 0;
                }
                holder.flexslider(index);
                return false;
            });
			
			
		};
		
		var initSlider = function(holder) {
			
			holder.flexslider({
				'animation' 	: 'slide',
				'smoothHeight'	: false,
				slideshow		: false,
				animationSpeed  : 200,
				prevText		: "",
			    nextText		: "",
			    start: function(slider) {
			    	$(window).trigger('resize');
			    }
			});
			
		};

		
		var can = function(){
			return items.length > 0 || smartItems.length > 0;
		};
		
		var init = function () {
			function setEqualHeight(selector) {
	      		var heights = [];

	       		 $(selector).each(function() {
					$(this).css('min-height', '0');
					$(this).css('max-height', 'none');
					$(this).css('height', 'auto');
					heights.push($(this).height());
				});

				var max = Math.max.apply( Math, heights );
				
				$(selector).each(function() {
					$(this).css('height', max + 'px');
				}); 
			}

			var setHeights = function() {
				$('.slides').each(function(i, elem) {
					setEqualHeight($(elem).find('li'));
	            });
			};

	        $(window).resize(function() {
	            setTimeout(function() {
	            	setHeights();
	            }, 120);
	        });

			items.filter(":visible").each(function() {
				if(!$(this).data('inited')) {
					$(this).data('inited', true);

					initSlider($(this));

	        		setHeights();
				}
			});
			
			smartItems.filter(":visible").each(function() {
				if(!$(this).data('inited')) {
					$(this).data('inited', true);

					initSmartSlider($(this));

	       			setHeights();
				}
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.chosen = (function(){
		
		var items = $('select');
		
		var openDropdown = function() {
			items.chosen({
				disable_search: true
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			openDropdown();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.dropdownmenu = (function(){
		
		var items = $('.has_dropdown a');
		
		var openDropdown = function() {
			items.click(function(e) {
				var span = $(this).siblings('.drop-down-span');
				var target = $(span.data('target'));
				
				function scrollToPos() {
					if($(document).width() <= 660) {
						$('html, body').animate({
							scrollTop: target.offset().top
						});
					}
				}

				if(target.length) {
					if(span.hasClass('active')) {
						$(".has_dropdown a.open").removeClass('open');

						$('.drop-menu').slideUp(scrollToPos);
						$(".main nav .level-2 li span").removeClass('active');
					}
					else {
						$(".has_dropdown a.open").removeClass('open');
						$(this).addClass('open');

						$(".main nav .level-2 li span").removeClass('active');
						$('.drop-menu').not(target).slideUp();
						target.slideDown(scrollToPos);
						span.addClass('active');
					}
				}


				
				return false;
			});

			// clicking the arrow should trigger the link
			$(".drop-down-span").click(function() {
				$(this).siblings('a').trigger('click');
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function () {
			openDropdown();

			$(".level-1 input").on('focus', function() {
				$(this).addClass('wide');
			});

			$(".level-1 input").on('blur', function() {
				$(this).removeClass('wide');
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.fancybox = (function() {
        var items = $('.fancybox-link');

        var initFancyBox = function() {
            items.fancybox({
                openEffect : 'none',
                closeEffect : 'none',
                prevEffect : 'none',
                padding: 0,
                nextEffect : 'none',
                minWidth: 320,
                minHeight: 320,
                arrows : false,
                helpers : {
                    media : true,
                    buttons : {}
                },
                afterShow: function() {
                    app.activities.init();
                },
                ajax: {
                    dataFilter: function(data) {
                        if($(data).find('.modal-content').length > 0) {
                            return $(data).find('.modal-content').first();
                        }

                        return data;
                    }
                }
            });

            items.click(function(e) {
                if (this.className.indexOf("video-image") != -1)
                {
                    CategoryName="Featured Video Plays";
                }else
                {
                    CategoryName=this.className;
                }
                
                dataLayer.push({
                    'event':'ForceClick',
                    'eventCategory': CategoryName, //create a datalayer variable macro called eventCategory
                    'eventAction': this.href, //create a datalayer variable macro called eventAction
                    'eventLabel': '' //create a datalayer variable macro called eventLabel
                });
                e.preventDefault();
            });

        };

        var can = function(){
            return items.length > 0;
        };

        var init = function (){
            $(document).ready(function() {
                initFancyBox();
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);

;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.fullheight = (function(){
		
		var items = $('.full-height');
		
		var fixHeights = function(){
			var windowWidth = $(window).width();
			
			items.each(function(){
				$(this).attr('style', '');
				if(windowWidth <= 980){
					return;
                }
				
				var parent = $(this).parent();
				$(this).css('min-height', parent.height() + 'px');
				
				var bgImages = $(this).find('.bg-image');
				if(bgImages.length){
					bgImages.each(function(){
						app.bgimage.setSize($(this));
					});
				}
				
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			fixHeights();
			
			$(window).load(function(){
				fixHeights();
				window.setTimeout(fixHeights, 600);
			});
			
			$(window).resize(fixHeights);
			
			
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
;
if(typeof app === 'undefined') { var app = {}; }

(function($){
    app.glossary = (function() {
        var items = $('.glossary-item'),
            inited = false;

        var can = function(){
            return items.length > 0;
        };

        var init = function () {
            if(inited) {
                return false;
            }

            inited = true;
            
            var list = [];
            
            items.each(function(i, elem) {
                if($(elem).find('h4')) {
                    var itemName = $(elem).find('h4').text().replace('(', ' ').replace(')', ' ');
                    list.push({
                        "id": i,
                        "name": itemName
                    });
                }
            });

            $(".filter-form").on('submit', function(e) {
                e.preventDefault();

                var input = $(".token-input-input-token-mac input").val();

                items.each(function(i, elem) {
                    var matches = $(elem).text().toLowerCase().indexOf(input.toLowerCase());
                    
                    if(matches !== -1) {
                        $(elem).parents('.glossary-letter').show();
                    }
                });

                $('.glossary-letter').filter(':visible').first().find('.title-c a').trigger('click');
            });


            $(".template_GlossaryPage .keywords").tokenInput(list, {
                hintText: 'Search by keyword',
                theme: 'mac',
                tokenLimit: 1,
                onAdd: function (item) {
                    // take the user to that accordion item
                    var heading = items.find('h4:contains('+ item.name+')');
                    var container = heading.parents('.glossary-letter');

                    var toggle = container.find('.title-c');

                    if(toggle.hasClass('active')) {
                        if(heading.length > 0) {
                            $(document).scrollTop(heading.offset().top);  
                        }
                    } else {
                        toggle.find('a').trigger('click');

                        if(heading.length > 0) {
                            setTimeout(function() {
                                $(document).scrollTop(heading.offset().top);
                            }, 500);
                        }
                    }
                },
                onDelete: function (item) {
                    $('.glossary-letter').siblings('.glossary-letter').show();
                }
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };
    })();
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.hamburger = (function(){
		
		var items = $('.hamburger');
		
		var openOrCloseMenu = function(){
			$('header.main').toggleClass('opened');

			if(!$('header.main').hasClass('opened')) {
				$(".drop-menu").hide();
			}
			return false;
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			$('.hamburger').click(function(){
				openOrCloseMenu();
				return false;
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){

	app.helpful = (function(){

		var items = $('.was-this-helpful');

		var can = function(){
			return items.length > 0;
		};

		var SetCookieVal = function(id, type ) {
			$.cookie('helpful'+id, type, { expires: 7, path: '/' });
		};

		var init = function (){

			$(document).ready(function(){
				items.find('a').click(function() {
					var button = $(this);
					
					$('.was-this-helpful a').removeClass('active');
					SetCookieVal(button.data('id'), button.attr('class'));
                                            
					$.ajax({
						url: button.attr('href')
					});
                                        
					button.addClass('active');
					button.siblings('.active').removeClass('active');
                                        dataLayer.push({
                                            'event':'ForceClick',
                                            'eventCategory': 'Helpful', //create a datalayer variable macro called eventCategory
                                            'eventAction': 'Was this Helpful - '+button.text(), //create a datalayer variable macro called eventAction
                                            'eventLabel': window.location.href  //create a datalayer variable macro called eventLabel
                                        });
					return false;
				});
			});

			items.each(function(){
				var id = $(this).data('id');
				var cookieVal  = $.cookie('helpful'+id);

				if(cookieVal === "yes") {
					$(this).find('a.yes').addClass('active');
				}
				else if(cookieVal === "no") {
					$(this).find('a.no').addClass('active');
				}
			});
		};

		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);
// 
;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.itemlist = (function() {
		
		var items = $('.checklist');
		
		var toggleItems = function(item) {
			var holder = item.closest('.checklist');
			var desc = holder.find('.' + item.data('for'));

			holder.find('.desc').not(desc).removeClass('active');
			holder.find('.index li').not(item).removeClass('active');
			
			if(item.hasClass('active')) {
				return;
			}
			else {
				desc.addClass('active');
				item.addClass('active');
			}
		};
		
		var toggleSecondLevels = function(item) {
			if(item.hasClass('active')) {
				item.removeClass('active');

				item.parent().find('input.'+item.data('input')).prop('checked', false);
			} else {
				item.addClass('active');
				item.parent().find('input.'+item.data('input')).prop('checked', true);
			}
			
			
			var icon =item.find('.icon');
			if(icon.hasClass('icon-tick')) {
				icon.removeClass('icon-tick');
				icon.addClass('icon-dot');
			}else{
				icon.addClass('icon-tick');
				icon.removeClass('icon-dot');
			}
			
			CheckALLSelected(item.parents('.desc'),item.parents('.desc'));
		};
		
		var CheckALLSelected = function(item,parent) {
			var allselected = true;
			var selector = item.data('parent');
			$('.'+selector+' ul li').each(function(i){
				
				if(!$(this).hasClass('active')){
					
					allselected = false;
					return false;
				}
			});
			
			var parentSelector= parent.data('parent');

            var holder = parent.closest('.checklist');
            var indexli = holder.find(".index li[data-for ='"+parentSelector+"']");
			if(allselected){
				indexli.find('.icon').addClass('icon-tick');
				indexli.parent().find('input.'+indexli.data('for')).prop('checked', true);
			}else{
				indexli.find('.icon').removeClass('icon-tick');
				indexli.find('.icon').addClass('icon-select');
				indexli.parent().find('input.'+indexli.data('for')).prop('checked', false);
			}
			
			
		};
		
		var initFirst = function() {
			items.each(function(){
				toggleItems($(this).find('.index li:first-child'));
			});
		};
		
		var initEvents = function() {
			// load from 
			items.find('.index .icon').each(function(i, elem) {
				if($(elem).hasClass('arrow')) {
					return;
				}

				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('for'))) {
						$(this).removeClass('icon-select');
						$(this).addClass('icon-tick');
						$(this).parents('li').first().addClass('ticked');
					} else {
						$(this).addClass('icon-select');
					}
				}
			});

			items.find('.index li .icon').click(function(e) {
				if($(this).hasClass('arrow')) {
					return;
				}

				if($(this).hasClass('icon-select')) {
					$(this).removeClass('icon-select');
					$(this).addClass('icon-tick');
					$(this).parents('li').first().addClass('ticked');

					if(window.localStorage !== "undefined") {
						localStorage.setItem($(this).data('for'), true);
					}
				} else {
					$(this).removeClass('icon-tick');
					$(this).addClass('icon-select');
					$(this).parents('li').first().removeClass('ticked');

					if(window.localStorage !== "undefined") {
						localStorage.setItem($(this).data('for'), false);
					}
				}

				return false;
			});

			var resizePaddingTop = function(self) {
				// set the padding for the element
				var $pt = $(self).offset().top - $(self).parents('.index').offset().top;
		
				$('.mainlist.'+ $(self).data('for')).css('padding-top', $pt);
			};

			items.find('.index li.main').click(function() {
				resizePaddingTop($(this));
				
				$(this).addClass('changed');

				toggleItems($(this));

				// scroll the user 
				if($(window).scrollTop() > $(this).offset().top) {
					$("html, body").animate({
						'scrollTop': $(this).offset().top
					});
				}

				return false;
			});

			$(window).resize(function() {
				$(".index li.main.changed").each(function() {
					resizePaddingTop($(this));
				});
			});
			
			items.find('.desc li').each(function(i, elem) {
				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('input')) === "true") {
						toggleSecondLevels($(elem));
					}
				}
			}).click(function() {
				if(window.localStorage !== "undefined") {
					if($(this).find('.icon-dot').length > 0) {
						localStorage.setItem($(this).data('input'), "true");
					} else {
						localStorage.setItem($(this).data('input'), "false");
					}
				}

				toggleSecondLevels($(this));

				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			initEvents();
			initFirst();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.leftrightcont = (function(){
		
		var leftBlock = $('.left-content');
		var rightBlock = $('.right-content');
		
		var sideGaps = function(){
/*


			var sideGap = $(window).width();
			
			if( sideGap >= 1200) {
				var leftMargin = (sideGap - 1200) / 2;
				$(leftBlock).css('margin-left',leftMargin);
				$(rightBlock).css('margin-right',(leftMargin + 28));
			}else{
				$(leftBlock).css('margin-left', 0);
				$(rightBlock).css('margin-right', 0);
			}*/

            leftBlock.addClass('init');
            rightBlock.addClass('init');
			
			return false;
		};
		
		var can = function(){
			return leftBlock.length > 0 || rightBlock.length > 0;
		};
		
		var init = function (){
			sideGaps();
			
			$(window).load(function(){
				sideGaps();
			});
			
			$('.togglereadmore').click(function(e) {
				e.preventDefault();
				
				var toggle = $(this);

				$(this).parents('.element-content-generic').first().find('.readmore-content').slideToggle(function() {
					if($(this).is(":visible")) {
						toggle.data('text', toggle.text());
						toggle.text('Hide');
					} else {
						toggle.text(toggle.data('text'));
					}
				});
			});

			$(window).resize(sideGaps);
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.packery = (function() {

        $(".separator-link").click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            if($(this).hasClass('fancybox-link')) {
                 $(this).fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    padding: 0,
                    nextEffect : 'none',
                    minWidth: 320,
                    minHeight: 320,
                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    },
                    afterShow: function() {
                        app.activities.init();
                    },
                    ajax: {
                        dataFilter: function(data) {
                            if($(data).find('.modal-content').length > 0) {
                                return $(data).find('.modal-content').first();
                            }

                            return data;
                        }
                    }
                });
            } else {
                if($(this).data('target') === '_blank') {
                    var win = window.open($(this).attr('href'), '_blank');
                    win.focus();
                } else {
                    window.location.href = $(this).attr('href');
                }
            }
        });

		var items = $('.packery');
		
		var configs = {
            'itemSelector'      : '.tile',
			'stamp'				: '.fixed',
            'transitionDuration': '0.2s'
		};

        var isotopeconfigs = {
            'itemSelector'      : '.tile',
            'stamp'				: '.fixed',
            'layout'			: 'packery',
            'transitionDuration': '0.2s',
            'getSortData'       : {
                title: '[data-title]',
                views: '[data-views]',
                order: '[data-sort]'
            }
        };


        var packIt = function() {
			items.each(function() {
				var item = $(this);

                if(item.hasClass('filters')){
                    doIsotope(item);
                }
                else{
                    doMasonry(item);
                }
			});
		};

        var scheme = [
            'red',
            'black',
            'green',
            'yellow',
            'white',
            'blue',
            'mint'
        ];

        var resetColors = function() {
            var v = 0;

            $('.tile-c').each(function(i, elem) {
                if($(elem).hasClass('image-tile') || $(elem).hasClass('list-menu') || $(elem).hasClass('fixed-right') || $(elem).hasClass('contact-tile')) {
                    return;
                }

                $(elem)
                    .removeClass('scheme_red scheme_black scheme_blue scheme_green scheme_yellow scheme_white scheme_mint');
                
                if($(elem).is(":visible")) {
                    $(elem).attr('data-v', v);
                    $(elem).addClass('scheme_'+ scheme[v % 7]);

                    v++;
                }
            });
        };

        function onArrange( event, filteredItems) {
            var v = 0, lowestY = 0;

            $.each(filteredItems, function(i, elem) {
                var element = $(elem).get(0).element;

                if($(element).hasClass('list-menu') || $(element).hasClass('contact-tile') || $(element).hasClass('image-tile') || $(elem).hasClass('fixed-right')) {
                    return;
                }

                $(element)
                    .removeClass('scheme_red scheme_black scheme_blue scheme_green scheme_yellow scheme_white scheme_mint');

                $(element).addClass('scheme_'+ scheme[v % 7]);

                if(lowestY === 0 || lowestY > $(element).offset().top) {
                    lowestY = $(element).offset().top;
                }

                v++;
            });

            return lowestY;
        }


        resetColors();
        var lastKeyword = null;

        var doIsotopeFilters = function(item, form) {
            var configs = isotopeconfigs;

            var keyword = form.find('.keywords').val().toLowerCase();
            var sort = form.find('select.sort-filter').val();
            var sortAscending = true;

            if($(".token-input-input-token-mac input").length > 0) {
                keyword = $.trim($(".token-input-input-token-mac input").val() + ' '+ $(".token-input-token-mac p").map(function() {
                    return $(this).text();
                }).get().join());
            }

            if(sort === 'views') {
                sortAscending = false;
            }

            configs.filter = function() {
                if(keyword === '') {
                    return true;
                }

                var bKeyword = false;
                var tile = $(this);

                if(keyword) {
                    var title = tile.data('title');

                    if(title && title.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
                        return true;
                    }
                    
                    var html = tile.text();

                    if(html && html.indexOf(keyword.toLowerCase()) >= 0) {
                        bKeyword = true;
                    }
                }

                return bKeyword;
            };

            configs.sortBy = sort;
            configs.sortAscending = sortAscending;
            var $pack = item.isotope(configs);
            
            // bind event listener
            $pack.on( 'layoutComplete', function(le, efi) {
                var lowestY = onArrange(le, efi);
                
                if(keyword && keyword !== lastKeyword) {
                    $('html, body').animate({
                        'scrollTop': lowestY
                    });
                }

                lastKeyword = keyword;
            });
        };

        /**
         *
         * @param item
         */
        var doIsotope = function(item) {
            var form = $('.' + item.data('filterform'));

            form.submit(function() {
                doIsotopeFilters(item, form);

                return false;
            });

            form.find('select.sort-filter').change(function(){
                doIsotopeFilters(item, form);
            });
			
			form.find('input.keywords').keyup(function(){
				if(!$(this).val()) {
					doIsotopeFilters(item, form);
				}
			});


            var images = item.find('img');

            if(images.length){
                imagesLoaded(this, function(){
                    item.isotope(isotopeconfigs);
                    item.addClass('loaded');
                });
            }
            else{
                item.addClass('loaded');
            }

            if(!item.hasClass('init')){
                item.isotope(isotopeconfigs);
                item.addClass('init');
            }
            else{
                item.isotope(isotopeconfigs);
            }


        };

        /**
         *
         * @param item
         */
        var doMasonry = function(item) {
            var images = item.find('img');
            var itemConfigs = configs;

            if(images.length){
                imagesLoaded(this, function(){
                    item.packery(itemConfigs);
                    item.addClass('loaded');
                });
            }
            else{
                item.addClass('loaded');
            }

            if(!item.hasClass('init')){
                item.packery(itemConfigs);
                item.addClass('init');
            }
            else{
                item.packery(itemConfigs);
            }


            item.packery('unbindResize');

            resetColors();

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this, args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) {
                            func.apply(context, args);
                        }
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) {
                        func.apply(context, args);
                    }
                };
            }

            var repackIt = debounce(function() {
                item.packery().css('opacity', 1);
            }, 250);

            $(window).on("resize", function () {
                item.css('opacity', 0.1);

                repackIt();
            });
        };
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			packIt();
			$(window).load(packIt);

            $(".image-tile").click(function(e) {
                
                //alert("sss");
               e.preventDefault();
               // e.stopPropagation();
                if($(this).hasClass('has-link')) {
                    var link = $(this).find('a').first().clone();
                    
                    link.css({
                        'opacity': 0,
                        'height': 0,
                        'display': 'block'
                    });
                    dataLayer.push({
                        'event':'ForceClick',
                        'eventCategory': 'Outbound Link', //create a datalayer variable macro called eventCategory
                        'eventAction': link.attr("href"), //create a datalayer variable macro called eventAction
                        'eventLabel': '' //create a datalayer variable macro called eventLabel
                    });
                    $(link.first()).trigger('click');
                    link.get(0).click();

                    if(typeof MouseEvent !== "undefined") {
                        var clickEvent = new MouseEvent("click", {
                            "view": window,
                            "bubbles": true,
                             "cancelable": false
                        });

                        link.get(0).dispatchEvent(clickEvent);
                    }
                }
                
            });

            var list = [];
            
            $(".tile").each(function(i, elem) {
                if($(elem).data('title')) {
                    list.push({
                        "id": i,
                        "name": $(elem).data('title')
                    });
                }
            });

            $(".template_LandingSearchPage .keywords").tokenInput(list, {
                hintText: 'Search by keyword',
                theme: 'mac',
                tokenLimit: 1,
                onAdd: function (item) {
                    $(".filter-form").trigger('submit');
                },
                onDelete: function (item) {
                    $(".filter-form").trigger('submit');
                }
            });

            $('.searchf').click(function(e) {
                e.preventDefault();

                var ids = $(this).data('show-items');

                var configs = isotopeconfigs;
                var sort = $('body').find('select.sort-filter').val();
                var sortAscending = true;

                if(sort === 'views') {
                    sortAscending = false;
                }

                configs.filter = function() {
                   var tile = $(this);

                    if(ids.indexOf(tile.data('itemid')) > -1) {
                       return true;
                    } else {
                       return false;
                    }
                };

                configs.sortBy = sort;
                configs.sortAscending = sortAscending;

                var $pack = $(this).parents('.packery').isotope(configs);

                // bind event listener
                $pack.on( 'layoutComplete', onArrange );
            });
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery); ;if(typeof app === 'undefined') { var app = {}; }

(function($) {
	app.squareblocks = (function() {
		var items = $('.priority-tasks .block-row');
		
		var showHideOverlay = function() {
			$('.botLine').click(function() {
				$(this).siblings('.overlay').show();

				return false;
			});
			
			$('.overlay .close').click(function() {
				$(this).parent().hide();

				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function () {
			showHideOverlay();
			
            $('.priority-tasks').addClass('init');
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($) {
    app.svgpng = (function() {
        var can = function() {
            var Modernizr = Modernizr || undefined;
            return (typeof Modernizr !== "undefined" && !Modernizr.svg);
        };

        var init = function (){
            $('img').each(function(){
                var img = $(this);
                var src = img.attr('src');
                if(src){
                    if(src.indexOf('.svg', src.length - 4) !== -1){
                        src = src.replace('.svg', '.png');
                        img.attr('src', src);
                    }
                }

            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.tabbedcontent = (function(){
		
		var items = $('.tabbed-content');
		
		var tabbedContent = function(){
						
			$('.tab-index ul li').click(function(){
                var tab_id = $(this).attr('data-for');

                $('.tab-index ul li').removeClass('active');
                $('.tab-section').removeClass('active');

                $(this).addClass('active');
                $('section'+"."+tab_id).addClass('active');
            });

		};
		
		var can = function(){
			return items.length > 0 || $('.template_FilterableCheckList').length > 0;
		};
		
		var init = function () {
			tabbedContent();

			$('.checkform').each(function(i, elem) {
				$(elem).find('#moving').hide();
				$(elem).find('#location').hide();
				$(elem).find('#starting').hide();
				$(elem).find('.action').attr('disabled', 'disabled');

				$("#iam select").change(function(e) {
					$("#moving").show();
				});

				$('#moving select').change(function(e) {
					$("#location").show();
				});

				$("#location select").change(function(e) {
					$(elem).find('.action').removeAttr('disabled');

					$("#starting").show();
				});
			});

			$(".checkable .icon-tick").each(function(i, elem) {
				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('item'))) {
						$(elem).parents('.checkable').addClass('checked');
					}
				}

				$(elem).click(function(e) {
					var checkable = $(this).parents('.checkable');

					if(checkable.hasClass('checked')) {
						checkable.removeClass('checked');

						if(window.localStorage !== "undefined") {
							localStorage.setItem($(this).data('item'), false);
						}
					} else {
						checkable.addClass('checked');

						if(window.localStorage !== "undefined") {
							localStorage.setItem($(this).data('item'), true);
						}
					}
					
					return false;
				});
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
;/* Placeholders.js v4.0.1 */
/*!
 * The MIT License
 *
 * Copyright (c) 2012 James Allardice
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */
!function(a){"use strict";function b(){}function c(){try{return document.activeElement}catch(a){}}function d(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return!0;return!1}function e(a,b,c){return a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent?a.attachEvent("on"+b,c):void 0}function f(a,b){var c;a.createTextRange?(c=a.createTextRange(),c.move("character",b),c.select()):a.selectionStart&&(a.focus(),a.setSelectionRange(b,b))}function g(a,b){try{return a.type=b,!0}catch(c){return!1}}function h(a,b){if(a&&a.getAttribute(B))b(a);else for(var c,d=a?a.getElementsByTagName("input"):N,e=a?a.getElementsByTagName("textarea"):O,f=d?d.length:0,g=e?e.length:0,h=f+g,i=0;h>i;i++)c=f>i?d[i]:e[i-f],b(c)}function i(a){h(a,k)}function j(a){h(a,l)}function k(a,b){var c=!!b&&a.value!==b,d=a.value===a.getAttribute(B);if((c||d)&&"true"===a.getAttribute(C)){a.removeAttribute(C),a.value=a.value.replace(a.getAttribute(B),""),a.className=a.className.replace(A,"");var e=a.getAttribute(I);parseInt(e,10)>=0&&(a.setAttribute("maxLength",e),a.removeAttribute(I));var f=a.getAttribute(D);return f&&(a.type=f),!0}return!1}function l(a){var b=a.getAttribute(B);if(""===a.value&&b){a.setAttribute(C,"true"),a.value=b,a.className+=" "+z;var c=a.getAttribute(I);c||(a.setAttribute(I,a.maxLength),a.removeAttribute("maxLength"));var d=a.getAttribute(D);return d?a.type="text":"password"===a.type&&g(a,"text")&&a.setAttribute(D,"password"),!0}return!1}function m(a){return function(){P&&a.value===a.getAttribute(B)&&"true"===a.getAttribute(C)?f(a,0):k(a)}}function n(a){return function(){l(a)}}function o(a){return function(){i(a)}}function p(a){return function(b){return v=a.value,"true"===a.getAttribute(C)&&v===a.getAttribute(B)&&d(x,b.keyCode)?(b.preventDefault&&b.preventDefault(),!1):void 0}}function q(a){return function(){k(a,v),""===a.value&&(a.blur(),f(a,0))}}function r(a){return function(){a===c()&&a.value===a.getAttribute(B)&&"true"===a.getAttribute(C)&&f(a,0)}}function s(a){var b=a.form;b&&"string"==typeof b&&(b=document.getElementById(b),b.getAttribute(E)||(e(b,"submit",o(b)),b.setAttribute(E,"true"))),e(a,"focus",m(a)),e(a,"blur",n(a)),P&&(e(a,"keydown",p(a)),e(a,"keyup",q(a)),e(a,"click",r(a))),a.setAttribute(F,"true"),a.setAttribute(B,T),(P||a!==c())&&l(a)}var t=document.createElement("input"),u=void 0!==t.placeholder;if(a.Placeholders={nativeSupport:u,disable:u?b:i,enable:u?b:j},!u){var v,w=["text","search","url","tel","email","password","number","textarea"],x=[27,33,34,35,36,37,38,39,40,8,46],y="#ccc",z="placeholdersjs",A=new RegExp("(?:^|\\s)"+z+"(?!\\S)"),B="data-placeholder-value",C="data-placeholder-active",D="data-placeholder-type",E="data-placeholder-submit",F="data-placeholder-bound",G="data-placeholder-focus",H="data-placeholder-live",I="data-placeholder-maxlength",J=100,K=document.getElementsByTagName("head")[0],L=document.documentElement,M=a.Placeholders,N=document.getElementsByTagName("input"),O=document.getElementsByTagName("textarea"),P="false"===L.getAttribute(G),Q="false"!==L.getAttribute(H),R=document.createElement("style");R.type="text/css";var S=document.createTextNode("."+z+" {color:"+y+";}");R.styleSheet?R.styleSheet.cssText=S.nodeValue:R.appendChild(S),K.insertBefore(R,K.firstChild);for(var T,U,V=0,W=N.length+O.length;W>V;V++)U=V<N.length?N[V]:O[V-N.length],T=U.attributes.placeholder,T&&(T=T.nodeValue,T&&d(w,U.type)&&s(U));var X=setInterval(function(){for(var a=0,b=N.length+O.length;b>a;a++)U=a<N.length?N[a]:O[a-N.length],T=U.attributes.placeholder,T?(T=T.nodeValue,T&&d(w,U.type)&&(U.getAttribute(F)||s(U),(T!==U.getAttribute(B)||"password"===U.type&&!U.getAttribute(D))&&("password"===U.type&&!U.getAttribute(D)&&g(U,"text")&&U.setAttribute(D,"password"),U.value===U.getAttribute(B)&&(U.value=T),U.setAttribute(B,T)))):U.getAttribute(C)&&(k(U),U.removeAttribute(B));Q||clearInterval(X)},J);e(a,"beforeunload",function(){M.disable()})}}(this);

/*
 * jQuery Plugin: Tokenizing Autocomplete Text Entry
 * Version 1.6.2
 *
 * Copyright (c) 2009 James Smith (http://loopj.com)
 * Licensed jointly under the GPL and MIT licenses,
 * choose which one suits your project best!
 *
 */

;(function ($) {
  var DEFAULT_SETTINGS = {
    // Search settings
    method: "GET",
    queryParam: "q",
    searchDelay: 300,
    minChars: 1,
    propertyToSearch: "name",
    jsonContainer: null,
    contentType: "json",
    excludeCurrent: false,
    excludeCurrentParameter: "x",

    // Prepopulation settings
    prePopulate: null,
    processPrePopulate: false,

    // Display settings
    hintText: "Type in a search term",
    noResultsText: "No results",
    searchingText: "Searching...",
    deleteText: "&#215;",
    animateDropdown: true,
    placeholder: null,
    theme: null,
    zindex: 9999,
    resultsLimit: null,

    enableHTML: false,

    resultsFormatter: function(item) {
      var string = item[this.propertyToSearch];
      return "<li>" + (this.enableHTML ? string : _escapeHTML(string)) + "</li>";
    },

    tokenFormatter: function(item) {
      var string = item[this.propertyToSearch];
      return "<li><p>" + (this.enableHTML ? string : _escapeHTML(string)) + "</p></li>";
    },

    // Tokenization settings
    tokenLimit: null,
    tokenDelimiter: ",",
    preventDuplicates: false,
    tokenValue: "id",

    // Behavioral settings
    allowFreeTagging: false,
    allowTabOut: false,
    autoSelectFirstResult: false,

    // Callbacks
    onResult: null,
    onCachedResult: null,
    onAdd: null,
    onFreeTaggingAdd: null,
    onDelete: null,
    onReady: null,

    // Other settings
    idPrefix: "token-input-",

    // Keep track if the input is currently in disabled mode
    disabled: false
  };

  // Default classes to use when theming
  var DEFAULT_CLASSES = {
    tokenList            : "token-input-list",
    token                : "token-input-token",
    tokenReadOnly        : "token-input-token-readonly",
    tokenDelete          : "token-input-delete-token",
    selectedToken        : "token-input-selected-token",
    highlightedToken     : "token-input-highlighted-token",
    dropdown             : "token-input-dropdown",
    dropdownItem         : "token-input-dropdown-item",
    dropdownItem2        : "token-input-dropdown-item2",
    selectedDropdownItem : "token-input-selected-dropdown-item",
    inputToken           : "token-input-input-token",
    focused              : "token-input-focused",
    disabled             : "token-input-disabled"
  };

  // Input box position "enum"
  var POSITION = {
    BEFORE : 0,
    AFTER  : 1,
    END    : 2
  };

  // Keys "enum"
  var KEY = {
    BACKSPACE    : 8,
    TAB          : 9,
    ENTER        : 13,
    ESCAPE       : 27,
    SPACE        : 32,
    PAGE_UP      : 33,
    PAGE_DOWN    : 34,
    END          : 35,
    HOME         : 36,
    LEFT         : 37,
    UP           : 38,
    RIGHT        : 39,
    DOWN         : 40,
    NUMPAD_ENTER : 108,
    COMMA        : 188
  };

  var HTML_ESCAPES = {
    '&' : '&amp;',
    '<' : '&lt;',
    '>' : '&gt;',
    '"' : '&quot;',
    "'" : '&#x27;',
    '/' : '&#x2F;'
  };

  var HTML_ESCAPE_CHARS = /[&<>"'\/]/g;

  function coerceToString(val) {
    return String((val === null || val === undefined) ? '' : val);
  }

  function _escapeHTML(text) {
    return coerceToString(text).replace(HTML_ESCAPE_CHARS, function(match) {
      return HTML_ESCAPES[match];
    });
  }

  // Additional public (exposed) methods
  var methods = {
      init: function(url_or_data_or_function, options) {
          var settings = $.extend({}, DEFAULT_SETTINGS, options || {});

          return this.each(function () {
              $(this).data("settings", settings);
              $(this).data("tokenInputObject", new $.TokenList(this, url_or_data_or_function, settings));
          });
      },
      clear: function() {
          this.data("tokenInputObject").clear();
          return this;
      },
      add: function(item) {
          this.data("tokenInputObject").add(item);
          return this;
      },
      remove: function(item) {
          this.data("tokenInputObject").remove(item);
          return this;
      },
      get: function() {
          return this.data("tokenInputObject").getTokens();
      },
      toggleDisabled: function(disable) {
          this.data("tokenInputObject").toggleDisabled(disable);
          return this;
      },
      setOptions: function(options){
          $(this).data("settings", $.extend({}, $(this).data("settings"), options || {}));
          return this;
      },
      destroy: function () {
        if (this.data("tokenInputObject")) {
          this.data("tokenInputObject").clear();
          var tmpInput = this;
          var closest = this.parent();
          closest.empty();
          tmpInput.show();
          closest.append(tmpInput);
          return tmpInput;
        }
      }
  };

  // Expose the .tokenInput function to jQuery as a plugin
  $.fn.tokenInput = function (method) {
      // Method calling and initialization logic
      if (methods[method]) {
          return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else {
          return methods.init.apply(this, arguments);
      }
  };

  // TokenList class for each input
  $.TokenList = function (input, url_or_data, settings) {
      //
      // Initialization
      //

      // Configure the data source
      if (typeof(url_or_data) === "string" || typeof(url_or_data) === "function") {
          // Set the url to query against
          $(input).data("settings").url = url_or_data;

          // If the URL is a function, evaluate it here to do our initalization work
          var url = computeURL();

          // Make a smart guess about cross-domain if it wasn't explicitly specified
          if ($(input).data("settings").crossDomain === undefined && typeof url === "string") {
              if(url.indexOf("://") === -1) {
                  $(input).data("settings").crossDomain = false;
              } else {
                  $(input).data("settings").crossDomain = (location.href.split(/\/+/g)[1] !== url.split(/\/+/g)[1]);
              }
          }
      } else if (typeof(url_or_data) === "object") {
          // Set the local data to search through
          $(input).data("settings").local_data = url_or_data;
      }

      // Build class names
      if($(input).data("settings").classes) {
          // Use custom class names
          $(input).data("settings").classes = $.extend({}, DEFAULT_CLASSES, $(input).data("settings").classes);
      } else if($(input).data("settings").theme) {
          // Use theme-suffixed default class names
          $(input).data("settings").classes = {};
          $.each(DEFAULT_CLASSES, function(key, value) {
              $(input).data("settings").classes[key] = value + "-" + $(input).data("settings").theme;
          });
      } else {
          $(input).data("settings").classes = DEFAULT_CLASSES;
      }

      // Save the tokens
      var saved_tokens = [];

      // Keep track of the number of tokens in the list
      var token_count = 0;

      // Basic cache to save on db hits
      var cache = new $.TokenList.Cache();

      // Keep track of the timeout, old vals
      var timeout;
      var input_val;

      // Create a new text input an attach keyup events
      var input_box = $("<input placeholder=\"Filter page by keyword\" type=\"text\" autocomplete=\"off\" autocapitalize=\"off\"/>")
          .css({
              outline: "none"
          })
          .attr("id", $(input).data("settings").idPrefix + input.id)
          .focus(function () {
              if ($(input).data("settings").disabled) {
                  return false;
              } else
              if ($(input).data("settings").tokenLimit === null || $(input).data("settings").tokenLimit !== token_count) {
                  show_dropdown_hint();
              }
              token_list.addClass($(input).data("settings").classes.focused);
          })
          .blur(function () {
              hide_dropdown();

              if ($(input).data("settings").allowFreeTagging) {
                add_freetagging_tokens();
              }

              $(this).val("");
              token_list.removeClass($(input).data("settings").classes.focused);
          })
          .bind("keyup keydown blur update", resize_input)
          .keydown(function (event) {
              var previous_token;
              var next_token;

              switch(event.keyCode) {
                  case KEY.LEFT:
                  case KEY.RIGHT:
                  case KEY.UP:
                  case KEY.DOWN:
                    if(this.value.length === 0) {
                        previous_token = input_token.prev();
                        next_token = input_token.next();

                        if((previous_token.length && previous_token.get(0) === selected_token) ||
               (next_token.length && next_token.get(0) === selected_token)) {
                            // Check if there is a previous/next token and it is selected
                            if(event.keyCode === KEY.LEFT || event.keyCode === KEY.UP) {
                                deselect_token($(selected_token), POSITION.BEFORE);
                            } else {
                                deselect_token($(selected_token), POSITION.AFTER);
                            }
                        } else if((event.keyCode === KEY.LEFT || event.keyCode === KEY.UP) && previous_token.length) {
                            // We are moving left, select the previous token if it exists
                            select_token($(previous_token.get(0)));
                        } else if((event.keyCode === KEY.RIGHT || event.keyCode === KEY.DOWN) && next_token.length) {
                            // We are moving right, select the next token if it exists
                            select_token($(next_token.get(0)));
                        }
                    } else {
                      var dropdown_item = null;

                      if (event.keyCode === KEY.DOWN || event.keyCode === KEY.RIGHT) {
                        dropdown_item = $(dropdown).find('li').first();

                        if (selected_dropdown_item) {
                          dropdown_item = $(selected_dropdown_item).next();
                        }
                      } else {
                        dropdown_item = $(dropdown).find('li').last();

                        if (selected_dropdown_item) {
                          dropdown_item = $(selected_dropdown_item).prev();
                        }
                      }

                      select_dropdown_item(dropdown_item);
                    }

                    break;

                  case KEY.BACKSPACE:
                      previous_token = input_token.prev();

                      if (this.value.length === 0) {
                        if (selected_token) {
                          delete_token($(selected_token));
                          hiddenInput.change();
                        } else if(previous_token.length) {
                          select_token($(previous_token.get(0)));
                        }

                        return false;
                      } else if($(this).val().length === 1) {
                          hide_dropdown();
                      } else {
                          // set a timeout just long enough to let this function finish.
                          setTimeout(function(){ do_search(); }, 5);
                      }
                      break;

                  case KEY.TAB:
                  case KEY.ENTER:
                  case KEY.NUMPAD_ENTER:
                  case KEY.COMMA:
                    if(selected_dropdown_item) {
                      add_token($(selected_dropdown_item).data("tokeninput"));
                      hiddenInput.change();
                    } else {
                      if ($(input).data("settings").allowFreeTagging) {
                        if($(input).data("settings").allowTabOut && $(this).val() === "") {
                          return true;
                        } else {
                          add_freetagging_tokens();
                        }
                      } else {
                        $(this).val("");
                        if($(input).data("settings").allowTabOut) {
                          return true;
                        }
                      }
                      event.stopPropagation();
                      event.preventDefault();
                    }
                    return false;

                  case KEY.ESCAPE:
                    hide_dropdown();
                    return true;

                  default:
                    if (String.fromCharCode(event.which)) {
                      // set a timeout just long enough to let this function finish.
                      setTimeout(function(){ do_search(); }, 5);
                    }
                    break;
              }
          });

      // Keep reference for placeholder
      if (settings.placeholder) {
        input_box.attr("placeholder", settings.placeholder);
      }

      // Keep a reference to the original input box
      var hiddenInput = $(input)
        .hide()
        .val("")
        .focus(function () {
          focusWithTimeout(input_box);
        })
        .blur(function () {
          input_box.blur();

          //return the object to this can be referenced in the callback functions.
          return hiddenInput;
        })
      ;

      // Keep a reference to the selected token and dropdown item
      var selected_token = null;
      var selected_token_index = 0;
      var selected_dropdown_item = null;

      // The list to store the token items in
      var token_list = $("<ul />")
          .addClass($(input).data("settings").classes.tokenList)
          .click(function (event) {
              var li = $(event.target).closest("li");
              if(li && li.get(0) && $.data(li.get(0), "tokeninput")) {
                  toggle_select_token(li);
              } else {
                  // Deselect selected token
                  if(selected_token) {
                      deselect_token($(selected_token), POSITION.END);
                  }

                  // Focus input box
                  focusWithTimeout(input_box);
              }
          })
          .mouseover(function (event) {
              var li = $(event.target).closest("li");
              if(li && selected_token !== this) {
                  li.addClass($(input).data("settings").classes.highlightedToken);
              }
          })
          .mouseout(function (event) {
              var li = $(event.target).closest("li");
              if(li && selected_token !== this) {
                  li.removeClass($(input).data("settings").classes.highlightedToken);
              }
          })
          .insertBefore(hiddenInput);

      // The token holding the input box
      var input_token = $("<li />")
          .addClass($(input).data("settings").classes.inputToken)
          .appendTo(token_list)
          .append(input_box);

      // The list to store the dropdown items in
      var dropdown = $("<div/>")
          .addClass($(input).data("settings").classes.dropdown)
          .appendTo("body")
          .hide();

      // Magic element to help us resize the text input
      var input_resizer = $("<tester/>")
          .insertAfter(input_box)
          .css({
              position: "absolute",
              top: -9999,
              left: -9999,
              width: "auto",
              fontSize: input_box.css("fontSize"),
              fontFamily: input_box.css("fontFamily"),
              fontWeight: input_box.css("fontWeight"),
              letterSpacing: input_box.css("letterSpacing"),
              whiteSpace: "nowrap"
          });

      // Pre-populate list if items exist
      hiddenInput.val("");
      var li_data = $(input).data("settings").prePopulate || hiddenInput.data("pre");

      if ($(input).data("settings").processPrePopulate && $.isFunction($(input).data("settings").onResult)) {
          li_data = $(input).data("settings").onResult.call(hiddenInput, li_data);
      }

      if (li_data && li_data.length) {
          $.each(li_data, function (index, value) {
              insert_token(value);
              checkTokenLimit();
              input_box.attr("placeholder", null)
          });
      }

      // Check if widget should initialize as disabled
      if ($(input).data("settings").disabled) {
          toggleDisabled(true);
      }

      // Initialization is done
      if (typeof($(input).data("settings").onReady) === "function") {
        $(input).data("settings").onReady.call();
      }

      //
      // Public functions
      //

      this.clear = function() {
          token_list.children("li").each(function() {
              if ($(this).children("input").length === 0) {
                  delete_token($(this));
              }
          });
      };

      this.add = function(item) {
          add_token(item);
      };

      this.remove = function(item) {
          token_list.children("li").each(function() {
              if ($(this).children("input").length === 0) {
                  var currToken = $(this).data("tokeninput");
                  var match = true;
                  for (var prop in item) {
                      if (item[prop] !== currToken[prop]) {
                          match = false;
                          break;
                      }
                  }
                  if (match) {
                      delete_token($(this));
                  }
              }
          });
      };

      this.getTokens = function() {
          return saved_tokens;
      };

      this.toggleDisabled = function(disable) {
          toggleDisabled(disable);
      };

      // Resize input to maximum width so the placeholder can be seen
      resize_input();

      //
      // Private functions
      //

      function escapeHTML(text) {
        return $(input).data("settings").enableHTML ? text : _escapeHTML(text);
      }

      // Toggles the widget between enabled and disabled state, or according
      // to the [disable] parameter.
      function toggleDisabled(disable) {
          if (typeof disable === 'boolean') {
              $(input).data("settings").disabled = disable
          } else {
              $(input).data("settings").disabled = !$(input).data("settings").disabled;
          }
          input_box.attr('disabled', $(input).data("settings").disabled);
          token_list.toggleClass($(input).data("settings").classes.disabled, $(input).data("settings").disabled);
          // if there is any token selected we deselect it
          if(selected_token) {
              deselect_token($(selected_token), POSITION.END);
          }
          hiddenInput.attr('disabled', $(input).data("settings").disabled);
      }

      function checkTokenLimit() {
          if($(input).data("settings").tokenLimit !== null && token_count >= $(input).data("settings").tokenLimit) {
              input_box.hide();
              hide_dropdown();
              return;
          }
      }

      function resize_input() {
          if(input_val === (input_val = input_box.val())) {return;}

          // Get width left on the current line
          var width_left = token_list.width() - input_box.offset().left - token_list.offset().left;
          // Enter new content into resizer and resize input accordingly
          input_resizer.html(_escapeHTML(input_val) || _escapeHTML(settings.placeholder));
          // Get maximum width, minimum the size of input and maximum the widget's width
          input_box.width(Math.min(token_list.width(),
                                   Math.max(width_left, input_resizer.width() + 30)));
      }

      function add_freetagging_tokens() {
          var value = $.trim(input_box.val());
          var tokens = value.split($(input).data("settings").tokenDelimiter);
          $.each(tokens, function(i, token) {
            if (!token) {
              return;
            }

            if ($.isFunction($(input).data("settings").onFreeTaggingAdd)) {
              token = $(input).data("settings").onFreeTaggingAdd.call(hiddenInput, token);
            }
            var object = {};
            object[$(input).data("settings").tokenValue] = object[$(input).data("settings").propertyToSearch] = token;
            add_token(object);
          });
      }

      // Inner function to a token to the list
      function insert_token(item) {
          var $this_token = $($(input).data("settings").tokenFormatter(item));
          var readonly = item.readonly === true;

          if(readonly) $this_token.addClass($(input).data("settings").classes.tokenReadOnly);

          $this_token.addClass($(input).data("settings").classes.token).insertBefore(input_token);

          // The 'delete token' button
          if(!readonly) {
            $("<span>" + $(input).data("settings").deleteText + "</span>")
                .addClass($(input).data("settings").classes.tokenDelete)
                .appendTo($this_token)
                .click(function () {
                    if (!$(input).data("settings").disabled) {
                        delete_token($(this).parent());
                        hiddenInput.change();
                        return false;
                    }
                });
          }

          // Store data on the token
          var token_data = item;
          $.data($this_token.get(0), "tokeninput", item);

          // Save this token for duplicate checking
          saved_tokens = saved_tokens.slice(0,selected_token_index).concat([token_data]).concat(saved_tokens.slice(selected_token_index));
          selected_token_index++;

          // Update the hidden input
          update_hiddenInput(saved_tokens, hiddenInput);

          token_count += 1;

          // Check the token limit
          if($(input).data("settings").tokenLimit !== null && token_count >= $(input).data("settings").tokenLimit) {
              input_box.hide();
              hide_dropdown();
          }

          return $this_token;
      }

      // Add a token to the token list based on user input
      function add_token (item) {
          var callback = $(input).data("settings").onAdd;

          // See if the token already exists and select it if we don't want duplicates
          if(token_count > 0 && $(input).data("settings").preventDuplicates) {
              var found_existing_token = null;
              token_list.children().each(function () {
                  var existing_token = $(this);
                  var existing_data = $.data(existing_token.get(0), "tokeninput");
                  if(existing_data && existing_data[settings.tokenValue] === item[settings.tokenValue]) {
                      found_existing_token = existing_token;
                      return false;
                  }
              });

              if(found_existing_token) {
                  select_token(found_existing_token);
                  input_token.insertAfter(found_existing_token);
                  focusWithTimeout(input_box);
                  return;
              }
          }

          // Squeeze input_box so we force no unnecessary line break
          input_box.width(1);

          // Insert the new tokens
          if($(input).data("settings").tokenLimit == null || token_count < $(input).data("settings").tokenLimit) {
              insert_token(item);
              // Remove the placeholder so it's not seen after you've added a token
              input_box.attr("placeholder", null);
              checkTokenLimit();
          }

          // Clear input box
          input_box.val("");

          // Don't show the help dropdown, they've got the idea
          hide_dropdown();

          // Execute the onAdd callback if defined
          if($.isFunction(callback)) {
              callback.call(hiddenInput,item);
          }
      }

      // Select a token in the token list
      function select_token (token) {
          if (!$(input).data("settings").disabled) {
              token.addClass($(input).data("settings").classes.selectedToken);
              selected_token = token.get(0);

              // Hide input box
              input_box.val("");

              // Hide dropdown if it is visible (eg if we clicked to select token)
              hide_dropdown();
          }
      }

      // Deselect a token in the token list
      function deselect_token (token, position) {
          token.removeClass($(input).data("settings").classes.selectedToken);
          selected_token = null;

          if(position === POSITION.BEFORE) {
              input_token.insertBefore(token);
              selected_token_index--;
          } else if(position === POSITION.AFTER) {
              input_token.insertAfter(token);
              selected_token_index++;
          } else {
              input_token.appendTo(token_list);
              selected_token_index = token_count;
          }

          // Show the input box and give it focus again
          focusWithTimeout(input_box);
      }

      // Toggle selection of a token in the token list
      function toggle_select_token(token) {
          var previous_selected_token = selected_token;

          if(selected_token) {
              deselect_token($(selected_token), POSITION.END);
          }

          if(previous_selected_token === token.get(0)) {
              deselect_token(token, POSITION.END);
          } else {
              select_token(token);
          }
      }

      // Delete a token from the token list
      function delete_token (token) {
          // Remove the id from the saved list
          var token_data = $.data(token.get(0), "tokeninput");
          var callback = $(input).data("settings").onDelete;

          var index = token.prevAll().length;
          if(index > selected_token_index) index--;

          // Delete the token
          token.remove();
          selected_token = null;

          // Show the input box and give it focus again
          focusWithTimeout(input_box);

          // Remove this token from the saved list
          saved_tokens = saved_tokens.slice(0,index).concat(saved_tokens.slice(index+1));
          if (saved_tokens.length == 0) {
              input_box.attr("placeholder", settings.placeholder)
          }
          if(index < selected_token_index) selected_token_index--;

          // Update the hidden input
          update_hiddenInput(saved_tokens, hiddenInput);

          token_count -= 1;

          if($(input).data("settings").tokenLimit !== null) {
              input_box
                  .show()
                  .val("");
              focusWithTimeout(input_box);
          }

          // Execute the onDelete callback if defined
          if($.isFunction(callback)) {
              callback.call(hiddenInput,token_data);
          }
      }

      // Update the hidden input box value
      function update_hiddenInput(saved_tokens, hiddenInput) {
          var token_values = $.map(saved_tokens, function (el) {
              if(typeof $(input).data("settings").tokenValue == 'function')
                return $(input).data("settings").tokenValue.call(this, el);

              return el[$(input).data("settings").tokenValue];
          });
          hiddenInput.val(token_values.join($(input).data("settings").tokenDelimiter));

      }

      // Hide and clear the results dropdown
      function hide_dropdown () {
          dropdown.hide().empty();
          selected_dropdown_item = null;
      }

      function show_dropdown() {
          dropdown
              .css({
                  position: "absolute",
                  top: token_list.offset().top + token_list.outerHeight(true),
                  left: token_list.offset().left,
                  width: token_list.width(),
                  'z-index': $(input).data("settings").zindex
              })
              .show();
      }

      function show_dropdown_searching () {
          if($(input).data("settings").searchingText) {
              dropdown.html("<p>" + escapeHTML($(input).data("settings").searchingText) + "</p>");
              show_dropdown();
          }
      }

      function show_dropdown_hint () {
          if($(input).data("settings").hintText) {
              dropdown.html("<p>" + escapeHTML($(input).data("settings").hintText) + "</p>");
              show_dropdown();
          }
      }

      var regexp_special_chars = new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\-]', 'g');
      function regexp_escape(term) {
          return term.replace(regexp_special_chars, '\\$&');
      }

      // Highlight the query part of the search term
      function highlight_term(value, term) {
          return value.replace(
            new RegExp(
              "(?![^&;]+;)(?!<[^<>]*)(" + regexp_escape(term) + ")(?![^<>]*>)(?![^&;]+;)",
              "gi"
            ), function(match, p1) {
              return "<b>" + escapeHTML(p1) + "</b>";
            }
          );
      }

      function find_value_and_highlight_term(template, value, term) {
          return template.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + regexp_escape(value) + ")(?![^<>]*>)(?![^&;]+;)", "g"), highlight_term(value, term));
      }

      // exclude existing tokens from dropdown, so the list is clearer
      function excludeCurrent(results) {
          if ($(input).data("settings").excludeCurrent) {
              var currentTokens = $(input).data("tokenInputObject").getTokens(),
                  trimmedList = [];
              if (currentTokens.length) {
                  $.each(results, function(index, value) {
                      var notFound = true;
                      $.each(currentTokens, function(cIndex, cValue) {
                          if (value[$(input).data("settings").propertyToSearch] == cValue[$(input).data("settings").propertyToSearch]) {
                              notFound = false;
                              return false;
                          }
                      });

                      if (notFound) {
                          trimmedList.push(value);
                      }
                  });
                  results = trimmedList;
              }
          }

          return results;
      }

      // Populate the results dropdown with some results
      function populateDropdown (query, results) {
          // exclude current tokens if configured
          results = excludeCurrent(results);

          if(results && results.length) {
              dropdown.empty();
              var dropdown_ul = $("<ul/>")
                  .appendTo(dropdown)
                  .mouseover(function (event) {
                      select_dropdown_item($(event.target).closest("li"));
                  })
                  .mousedown(function (event) {
                      add_token($(event.target).closest("li").data("tokeninput"));
                      hiddenInput.change();
                      return false;
                  })
                  .hide();

              if ($(input).data("settings").resultsLimit && results.length > $(input).data("settings").resultsLimit) {
                  results = results.slice(0, $(input).data("settings").resultsLimit);
              }

              $.each(results, function(index, value) {
                  var this_li = $(input).data("settings").resultsFormatter(value);

                  this_li = find_value_and_highlight_term(this_li ,value[$(input).data("settings").propertyToSearch], query);
                  this_li = $(this_li).appendTo(dropdown_ul);

                  if(index % 2) {
                      this_li.addClass($(input).data("settings").classes.dropdownItem);
                  } else {
                      this_li.addClass($(input).data("settings").classes.dropdownItem2);
                  }

                  if(index === 0 && $(input).data("settings").autoSelectFirstResult) {
                      select_dropdown_item(this_li);
                  }

                  $.data(this_li.get(0), "tokeninput", value);
              });

              show_dropdown();

              if($(input).data("settings").animateDropdown) {
                  dropdown_ul.slideDown("fast");
              } else {
                  dropdown_ul.show();
              }
          } else {
              if($(input).data("settings").noResultsText) {
                  dropdown.html("<p>" + escapeHTML($(input).data("settings").noResultsText) + "</p>");
                  show_dropdown();
              }
          }
      }

      // Highlight an item in the results dropdown
      function select_dropdown_item (item) {
          if(item) {
              if(selected_dropdown_item) {
                  deselect_dropdown_item($(selected_dropdown_item));
              }

              item.addClass($(input).data("settings").classes.selectedDropdownItem);
              selected_dropdown_item = item.get(0);
          }
      }

      // Remove highlighting from an item in the results dropdown
      function deselect_dropdown_item (item) {
          item.removeClass($(input).data("settings").classes.selectedDropdownItem);
          selected_dropdown_item = null;
      }

      // Do a search and show the "searching" dropdown if the input is longer
      // than $(input).data("settings").minChars
      function do_search() {
          var query = input_box.val();

          if(query && query.length) {
              if(selected_token) {
                  deselect_token($(selected_token), POSITION.AFTER);
              }

              if(query.length >= $(input).data("settings").minChars) {
                  show_dropdown_searching();
                  clearTimeout(timeout);

                  timeout = setTimeout(function(){
                      run_search(query);
                  }, $(input).data("settings").searchDelay);
              } else {
                  hide_dropdown();
              }
          }
      }

      // Do the actual search
      function run_search(query) {
          var cache_key = query + computeURL();
          var cached_results = cache.get(cache_key);
          if (cached_results) {
              if ($.isFunction($(input).data("settings").onCachedResult)) {
                cached_results = $(input).data("settings").onCachedResult.call(hiddenInput, cached_results);
              }
              populateDropdown(query, cached_results);
          } else {
              // Are we doing an ajax search or local data search?
              if($(input).data("settings").url) {
                  var url = computeURL();
                  // Extract existing get params
                  var ajax_params = {};
                  ajax_params.data = {};
                  if(url.indexOf("?") > -1) {
                      var parts = url.split("?");
                      ajax_params.url = parts[0];

                      var param_array = parts[1].split("&");
                      $.each(param_array, function (index, value) {
                          var kv = value.split("=");
                          ajax_params.data[kv[0]] = kv[1];
                      });
                  } else {
                      ajax_params.url = url;
                  }

                  // Prepare the request
                  ajax_params.data[$(input).data("settings").queryParam] = query;
                  ajax_params.type = $(input).data("settings").method;
                  ajax_params.dataType = $(input).data("settings").contentType;
                  if ($(input).data("settings").crossDomain) {
                      ajax_params.dataType = "jsonp";
                  }

                  // exclude current tokens?
                  // send exclude list to the server, so it can also exclude existing tokens
                  if ($(input).data("settings").excludeCurrent) {
                      var currentTokens = $(input).data("tokenInputObject").getTokens();
                      var tokenList = $.map(currentTokens, function (el) {
                          if(typeof $(input).data("settings").tokenValue == 'function')
                              return $(input).data("settings").tokenValue.call(this, el);

                          return el[$(input).data("settings").tokenValue];
                      });

                      ajax_params.data[$(input).data("settings").excludeCurrentParameter] = tokenList.join($(input).data("settings").tokenDelimiter);
                  }

                  // Attach the success callback
                  ajax_params.success = function(results) {
                    cache.add(cache_key, $(input).data("settings").jsonContainer ? results[$(input).data("settings").jsonContainer] : results);
                    if($.isFunction($(input).data("settings").onResult)) {
                        results = $(input).data("settings").onResult.call(hiddenInput, results);
                    }

                    // only populate the dropdown if the results are associated with the active search query
                    if(input_box.val() === query) {
                        populateDropdown(query, $(input).data("settings").jsonContainer ? results[$(input).data("settings").jsonContainer] : results);
                    }
                  };

                  // Provide a beforeSend callback
                  if (settings.onSend) {
                    settings.onSend(ajax_params);
                  }

                  // Make the request
                  $.ajax(ajax_params);
              } else if($(input).data("settings").local_data) {
                  // Do the search through local data
                  var results = $.grep($(input).data("settings").local_data, function (row) {
                      return row[$(input).data("settings").propertyToSearch].toLowerCase().indexOf(query.toLowerCase()) > -1;
                  });

                  cache.add(cache_key, results);
                  if($.isFunction($(input).data("settings").onResult)) {
                      results = $(input).data("settings").onResult.call(hiddenInput, results);
                  }
                  populateDropdown(query, results);
              }
          }
      }

      // compute the dynamic URL
      function computeURL() {
          var settings = $(input).data("settings");
          return typeof settings.url == 'function' ? settings.url.call(settings) : settings.url;
      }

      // Bring browser focus to the specified object.
      // Use of setTimeout is to get around an IE bug.
      // (See, e.g., http://stackoverflow.com/questions/2600186/focus-doesnt-work-in-ie)
      //
      // obj: a jQuery object to focus()
      function focusWithTimeout(object) {
          setTimeout(
            function() {
        object.focus();
            },
      50
      );
      }
  };

  // Really basic cache for the results
  $.TokenList.Cache = function (options) {
    var settings, data = {}, size = 0, flush;

    settings = $.extend({ max_size: 500 }, options);

    flush = function () {
      data = {};
      size = 0;
    };

    this.add = function (query, results) {
      if (size > settings.max_size) {
        flush();
      }

      if (!data[query]) {
        size += 1;
      }

      data[query] = results;
    };

    this.get = function (query) {
      return data[query];
    };
  };

}(jQuery));

if(typeof app === 'undefined') var app = {};

app.MobileSize = 640;

app.Modules = [
    'svgpng',
    'activities',
	'hamburger',
	'bgimage',
	'packery',
	'dropdownmenu',
	'chosen',
	'accordion',
	'carousel',
	'fullheight',
	'itemlist',
	'squareblocks',
	'tabbedcontent',
    'fancybox',
    'helpful',
    'glossary',
	'leftrightcont',
	'tests'
];




(function($) {
	for(key in app.Modules) {
		var moduleKey = app.Modules[key];
		var module = app[moduleKey]


		if(module && typeof module.init !== 'undefined' && typeof module.can !== 'undefined'){			
			if(module.can()) {
				module.init();
			}
		}
	}
})(jQuery);

$( document ).ready(function() {
    $(".flex-nav-next").click(function(){
      // Holds the product ID of the clicked element
     // var productId = $(this).attr('class').replace('addproduct ', '');
    console.log("ssssss");
      //addToCart(productId);
    });
});