if(typeof app === 'undefined') { var app = {}; }

(function($) {
	app.activities = (function() {
		
		var can = function() {
			return $(".activity_navigation .btn").length > 0;
		};
		
		var init = function () {
			$(".activity_navigation .btn").on('click', function(e) {
				
				e.preventDefault();

				if($(this).hasClass('loading')) {
					return;
				}

				$(this).addClass('loading');


				// validate the current step
				var valid = true,
					btn = $(this),
					activity = $(this).parents('.activity'),
					step = activity.find('.activity_individual.current'),
					text = step.find('.activity_text'),
					nextStep = step.next('.activity_individual'),
					options = text.find('li');

				if($(this).hasClass('back')) {
					nextStep = step.prev('.activity_individual');

					//
					// The user has requested to go back. Perform animation
					// in reverse.
					//
					// progress the top count
					var currentProgress = $(".activity_header .progress .current");

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
							btn.siblings('.next').html("Start &rarr;").removeClass('hidden');
						} else {
							btn.siblings('.next').html("Next &rarr;").removeClass('hidden');
						}

						btn.removeClass('loading');

						$('html, body').animate({
							'scrollTop': nextStep.offset().top
						});
					});

					return;
				}

				// we need to know whether this is valid on each step or at
				// the end. If this is the last stop then we need to populate
				// the 
				var validationModel = activity.data('validation-method');

				if(validationModel == "OnComplete") {

				} else if(validationModel == "OnEachStep") {
					// validate the users current step first. Ensure that 
					// options exist.
					var attempt = step.data('attempt');
					
					if(!attempt) attempt = 0;
					attempt++;

					step.data('attempt', attempt);

					if(options.length > 1) {
				
						var answers = step.find('.activity_answers li');
					
						// validate the options based on the the type of field
						// the user has created
						if(step.find('.activity_text__MultiChoice').length > 0 || step.find('.activity_text__Paragraph').length > 0) {
							var selected = options.find('.selected');

							selected.each(function(i,  check) {
								var isValidAnswer = false;

								answers.each(function(x, answer) {
									if($(answer).text() == $(check).text()) {
										isValidAnswer = true;
									}
								});

								if(!isValidAnswer) {
									valid = false;

									// if this is on the 3rd attempt then show the user the error messages
									if(attempt > 2) {
										$(check).removeClass('correct');
										$(check).addClass('wrong');
									}
								} else {
									if(attempt > 2) {
										$(check).removeClass('wrong');
										$(check).addClass('correct');
									}
								}
							});

							// if this is on the 3rd attempt then show the user the error messages
							answers.each(function(x, answer) {
								options.each(function(o, opt) {
									if(($(opt).text() == $(answer).text()) && !$(opt).hasClass('selected')) {
										isValidAnswer = false;
										valid = false;

										if(attempt > 2) {
											$(opt).removeClass('correct');
											$(opt).addClass('wrong');
										}
									}
								});
							});
						} else if(step.find('.activity_text__DragAndDrop').length > 0 || step.find('.activity_text__Replace').length > 0) {
							options.each(function(i, elem) {
								if($(answers.get(i)).text() != $(elem).text()) {
									valid = false;

									if(attempt > 2) {
										$(elem).removeClass('correct');
										$(elem).addClass('wrong');
									}
								} else {
									if(attempt > 2) {
										$(elem).addClass('correct');
										$(elem).removeClass('wrong');
									}
								}
							});
						}

						if(!valid) {
							step.find('.activity_success').hide();

							if(attempt > 2) {
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
						} else {
							step.find('.activity_fail_warning').hide();
							step.find('.activity_fail').hide();

							if(step.find('.activity_success').is(":visible")) {
								canProgress = true;
							} else {
								canProgress = false;
								step.find('.activity_success').show();
							}
						}
					}
				}

				// all valid so do the form animation
				if(canProgress) {
					// progress the top count
					var currentProgress = $(".activity_header .progress .current");

					currentProgress
						.removeClass('current').parents('li').next('li').find('a')
						.addClass('current');

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
						if(remaining < 1) {
							btn.addClass('hidden');
						} else if(remaining == 1) {
							btn.html('Finish');
						} else {
							btn.html("Next &rarr;")
						}

						btn.removeClass('loading');

						$('html, body').animate({
							'scrollTop': nextStep.offset().top
						});
					});
				} else {
					btn.removeClass('loading');
				}
			});
			
			$(".activity_text__DragAndDrop").each(function(i, elem) {
				$('ul', elem).sortable();
			});

			$(".activity_text__Paragraph, .activity_text__MultiChoice").each(function(i, elem) {
				$('li', elem).click(function() {
					$(this).toggleClass('selected');
				});
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);