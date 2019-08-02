/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 54);
/******/ })
/************************************************************************/
/******/ ({

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(55);


/***/ }),

/***/ 55:
/***/ (function(module, exports) {

var bar = {
	init: function init() {
		var self = this;
		self.menubar();
		self.userDropdown();
		$('.loading-div').fadeOut();
	},
	menubar: function menubar() {
		var start = function start() {
			$('.menu-icon').on('click', toggleSideBar);
			$('.menu-parent').on('click', toggleSubMenu);
			$('.sub-menubar').hide();
			activeLink();
		},
		    toggleSideBar = function toggleSideBar() {
			var el = $('.sidebar'),
			    i = $('.menu-icon'),
			    container = $('.main-container');
			// sb = $('.sidebar');
			if (el.hasClass('inactive')) {
				// el.removeClass('close');
				// el.css('display', 'block');
				el.removeClass('inactive');
				i.removeClass('text-blue');
				container.removeClass('pl-0');
			} else {
				// el.addClass('close');
				// el.css('display', 'none');
				el.addClass('inactive');
				i.addClass('text-blue');
				container.addClass('pl-0');
			}
		},
		    toggleSubMenu = function toggleSubMenu() {
			var el = $(this);
			el.find('.sub-menubar').slideToggle();
		},
		    activeLink = function activeLink() {
			var pathname = window.location.pathname;
			$('.a-link').removeClass('active');
			$.each($('.a-link'), function () {
				var el = $(this);
				if (el.attr('href') == pathname) {
					el.addClass('active');
					el.closest('.sub-menubar').show();
				}
			});
		};
		start();
	},
	userDropdown: function userDropdown() {
		var start = function start() {
			$('.user-dropdown').on('click', dropdown);
			// $('.user-dropdown-menu').on('focusout', focusout);
			// $('.user-dropdown').focusout(focusout);
		},
		    dropdown = function dropdown() {
			$(this).attr('tabindex', 1).focus();
			$('.user-dropdown-menu').slideToggle('fast').toggleClass('active');
		},
		    focusout = function focusout() {
			var dd = $('.user-dropdown-menu');
			if (dd.hasClass('active')) {
				dd.slideToggle('fast').toggleClass('active');
			}
		};
		start();
	}

};
bar.init();

var dashboard = {
	init: function init() {
		var self = this;
	}
};
dashboard.init();

/***/ })

/******/ });