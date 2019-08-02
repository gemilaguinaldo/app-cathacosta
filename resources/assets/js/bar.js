var bar = {
	init: function() {
		var self = this;
		self.menubar();
		self.userDropdown();
		$('.loading-div').fadeOut();
	},
	menubar: function() {
		var start = function() {
			$('.menu-icon').on('click', toggleSideBar);
			$('.menu-parent').on('click', toggleSubMenu);
			$('.sub-menubar').hide();
			activeLink();
		},
		toggleSideBar = function() {
			var el = $('.sidebar'),
				i = $('.menu-icon'),
				container = $('.main-container');
				// sb = $('.sidebar');
			if(el.hasClass('inactive') ) {
				// el.removeClass('close');
				// el.css('display', 'block');
				el.removeClass('inactive');
				i.removeClass('text-blue');
				container.removeClass('pl-0');
			}
			else 
			{
				// el.addClass('close');
				// el.css('display', 'none');
				el.addClass('inactive');
				i.addClass('text-blue');
				container.addClass('pl-0');
			}
		},
		toggleSubMenu = function() {
			var el = $(this);
			el.find('.sub-menubar').slideToggle();
		},
		activeLink = function() {
			var pathname = window.location.pathname;
			$('.a-link').removeClass('active');
			$.each($('.a-link'), function() {
				var el = $(this);
				if(el.attr('href') == pathname)
				{
					el.addClass('active');
					el.closest('.sub-menubar').show();
				}
			});
			
		};
		start();
	},
	userDropdown: function() {
		var start = function() {
			$('.user-dropdown').on('click',dropdown);
			// $('.user-dropdown-menu').on('focusout', focusout);
			// $('.user-dropdown').focusout(focusout);

		},
		dropdown = function() {
		  	$(this).attr('tabindex', 1).focus();
			$('.user-dropdown-menu').slideToggle('fast')
									.toggleClass('active');

		},
		focusout = function() {
			var dd = $('.user-dropdown-menu');
			if(dd.hasClass('active')) {
				dd.slideToggle('fast')
					.toggleClass('active');
			}

		};
		start();

	},

};
bar.init();




var dashboard = {
	init() {
		var self = this;
		
	},

};
dashboard.init();


