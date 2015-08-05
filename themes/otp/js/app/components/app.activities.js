if(typeof app === 'undefined') { var app = {}; }

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
						if($(elem).data('answer-id') == id) {
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


				// validate the current step
				var valid = true,
					btn = $(this),
					activity = $(this).parents('.activity'),
					step = activity.find('.activity_individual.current'),
					steps = activity.find('.activity_individual'),
					text = step.find('.activity_text'),
					nextStep = step.next('.activity_individual'),
					options = text.find('li'),
					canProgress = true;

				if($(this).hasClass('back') && !$(this).hasClass('review')) {
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
				var showResults = (validationModel == "OnEachStep");

				// validate the users current step first. Ensure that 
				// options exist.
				var attempt = step.data('attempt');
				var allowedAttempts = activity.data('max-attempts');
					
				if(!allowedAttempts) {
					allowedAttempts = 3;
				}

				var answers = step.find('.activity_answers li');

				if(!attempt) attempt = 0;
				attempt++;

				step.data('attempt', attempt);

				if(options.length > 1) {
					if(step.find('.activity_text__SelectAny').length > 0) {
						// user must select at least one option.
						var selected = options.filter('.selected');

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
						var selected = options.filter('.selected');

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
								if(($(opt).text() == $(answer).text()) && !$(opt).hasClass('selected')) {
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
							});
						});

						if(valid || attempt >= allowedAttempts) {						
							step.addClass('readonly');
							markReadonly(step);
						}
					} else if(step.find('.activity_text__Replace').length > 0) {
						options.filter('.replaceable').each(function(i, elem) {
							if($(answers.get(i)).text() != $(elem).text()) {
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
					} else if(step.find('.activity_text__DragAndDrop').length > 0 || step.find('.activity_text__DragAndDropToMatch').length > 0) {
						options.each(function(i, elem) {
							if($(answers.get(i)).text() != $(elem).text()) {
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
					var currentProgress = $(".activity_header .progress .current");

					currentProgress
						.removeClass('current').parents('li').next('li').find('a')
						.addClass('current');

					if(nextStep.hasClass('activity_ResultsSlide')) {
						// this slide is a results slide so go through each of the previous steps and get the count of
						// valid and invalid results.

						var existing = nextStep.find('.results');

						if(existing.length < 1) {
							existing = $("<div class='activity_results'><span class='right'></span><span class='wrong'></span></div>");

							nextStep.find('h3').after(existing);
						}

						var steps = activity.find('.activity_individual'),
							right = 0,
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
						if(remaining < 1) {
							activity.addClass('readonly');
							markReadonly();

							if(validationModel == "OnComplete") {
								// add a button to see your results
								btn.text('See correct answers').addClass('review');
								btn.siblings('.back').addClass('review').addClass('hidden');
							} else {
								btn.addClass('hidden');
							}
						} else if(remaining == 1) {
							btn.html('Finish');
						} else {
							btn.html("Next");
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

				activity.find(".activity_text__DragAndDrop").each(function(i, elem) {
					$('ul.hassortable', elem).sortable('disable');
				});

				activity.find(".activity_text__DragAndDropToMatch").each(function(i, elem) {
					$('ul.hassortable', elem).sortable('disable');
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

					$(this).toggleClass('selected');
				});
			});

			$(".activity_text__SingleChoice, .activity_text__SelectAny").each(function(i, elem) {
				$('li', elem).click(function() {
					if($(this).parents('.activity').hasClass('readonly')) {
						return false;
					}

					$(this).toggleClass('selected');
					$(this).siblings('.selected').removeClass('selected');

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
})(jQuery);