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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/js/diskutieren.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/diskutieren.js":
/*!**********************************!*\
  !*** ./assets/js/diskutieren.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("window.calendar = function () {\n  return {\n    month: '',\n    year: '',\n    no_of_days: [],\n    blankdays: [],\n    days: ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],\n    month_names: ['Jänner', 'Feber', 'März', 'April', 'Main', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],\n    events: [{\n      event_date: new Date(2020, 11, 10),\n      event_title: \"April Fool's Day\",\n      event_theme: 'blue',\n      event_time: '16:00'\n    }, {\n      event_date: new Date(2020, 11, 10),\n      event_title: \"Birthday\",\n      event_theme: 'red',\n      event_time: '16:00'\n    }, {\n      event_date: new Date(2020, 11, 16),\n      event_title: \"Upcoming Event\",\n      event_theme: 'green',\n      event_time: '16:00'\n    }],\n    event_title: '',\n    event_date: '',\n    event_theme: 'blue',\n    themes: [{\n      value: \"blue\",\n      label: \"Blue Theme\"\n    }, {\n      value: \"red\",\n      label: \"Red Theme\"\n    }, {\n      value: \"yellow\",\n      label: \"Yellow Theme\"\n    }, {\n      value: \"green\",\n      label: \"Green Theme\"\n    }, {\n      value: \"purple\",\n      label: \"Purple Theme\"\n    }],\n    openEventModal: false,\n    initDate: function initDate() {\n      var _this = this;\n\n      var today = new Date();\n      this.month = today.getMonth();\n      this.year = today.getFullYear();\n      this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();\n      setTimeout(function () {\n        _this.events.push({\n          event_date: new Date(2020, 11, 1),\n          event_title: \"Upcoming Event\",\n          event_theme: 'green',\n          event_time: '16:00'\n        });\n      }, 3000);\n    },\n    isToday: function isToday(date) {\n      var today = new Date();\n      var d = new Date(this.year, this.month, date);\n      return today.toDateString() === d.toDateString() ? true : false;\n    },\n    showEventModal: function showEventModal(date) {\n      // open the modal\n      this.openEventModal = true;\n      this.event_date = new Date(this.year, this.month, date).toDateString();\n    },\n    addEvent: function addEvent() {\n      if (this.event_title == '') {\n        return;\n      }\n\n      this.events.push({\n        event_date: this.event_date,\n        event_title: this.event_title,\n        event_theme: this.event_theme\n      });\n      console.log(this.events); // clear the form data\n\n      this.event_title = '';\n      this.event_date = '';\n      this.event_theme = 'blue'; //close the modal\n\n      this.openEventModal = false;\n    },\n    prevMonth: function prevMonth() {\n      if (this.month > 0) {\n        this.month--;\n      } else {\n        this.year--;\n        this.month = 11;\n      }\n    },\n    nextMonth: function nextMonth() {\n      if (this.month < 11) {\n        this.month++;\n      } else {\n        this.year++;\n        this.month = 0;\n      }\n    },\n    getNoOfDays: function getNoOfDays() {\n      var daysInMonth = new Date(this.year, this.month + 1, 0).getDate(); // find where to start calendar day of week\n\n      var dayOfWeek = new Date(this.year, this.month).getDay();\n      dayOfWeek--;\n      if (dayOfWeek < 0) dayOfWeek = 6;\n      var blankdaysArray = [];\n\n      for (var i = 1; i <= dayOfWeek; i++) {\n        blankdaysArray.push(i);\n      }\n\n      var daysArray = [];\n\n      for (var i = 1; i <= daysInMonth; i++) {\n        daysArray.push(i);\n      }\n\n      this.blankdays = blankdaysArray;\n      this.no_of_days = daysArray;\n    }\n  };\n};\n\n//# sourceURL=webpack:///./assets/js/diskutieren.js?");

/***/ })

/******/ });