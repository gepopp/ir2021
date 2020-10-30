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
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/js/single.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/single.js":
/*!*****************************!*\
  !*** ./assets/js/single.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var readingTime = __webpack_require__(/*! reading-time */ \"./node_modules/reading-time/index.js\");\n\nwindow.readTime = function (text) {\n  return {\n    text: text,\n\n    get minutes() {\n      var reading = readingTime(this.text);\n      var seconds = reading.time / 1000;\n      return parseInt(seconds / 60);\n    }\n\n  };\n};\n\n//# sourceURL=webpack:///./assets/js/single.js?");

/***/ }),

/***/ "./node_modules/reading-time/index.js":
/*!********************************************!*\
  !*** ./node_modules/reading-time/index.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = __webpack_require__(/*! ./lib/reading-time */ \"./node_modules/reading-time/lib/reading-time.js\");\n\n//# sourceURL=webpack:///./node_modules/reading-time/index.js?");

/***/ }),

/***/ "./node_modules/reading-time/lib/reading-time.js":
/*!*******************************************************!*\
  !*** ./node_modules/reading-time/lib/reading-time.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("/*!\n * reading-time\n * Copyright (c) Nicolas Gryman <ngryman@gmail.com>\n * MIT Licensed\n */\n\n\nfunction ansiWordBound(c) {\n  return ' ' === c || '\\n' === c || '\\r' === c || '\\t' === c;\n}\n\nfunction readingTime(text, options) {\n  var words = 0,\n      start = 0,\n      end = text.length - 1,\n      wordBound,\n      i;\n  options = options || {}; // use default values if necessary\n\n  options.wordsPerMinute = options.wordsPerMinute || 200; // use provided function if available\n\n  wordBound = options.wordBound || ansiWordBound; // fetch bounds\n\n  while (wordBound(text[start])) {\n    start++;\n  }\n\n  while (wordBound(text[end])) {\n    end--;\n  } // calculate the number of words\n\n\n  for (i = start; i <= end;) {\n    for (; i <= end && !wordBound(text[i]); i++) {\n      ;\n    }\n\n    words++;\n\n    for (; i <= end && wordBound(text[i]); i++) {\n      ;\n    }\n  } // reading time stats\n\n\n  var minutes = words / options.wordsPerMinute;\n  var time = minutes * 60 * 1000;\n  var displayed = Math.ceil(minutes.toFixed(2));\n  return {\n    text: displayed + ' min read',\n    minutes: minutes,\n    time: time,\n    words: words\n  };\n}\n/**\n * Export\n */\n\n\nmodule.exports = readingTime;\n\n//# sourceURL=webpack:///./node_modules/reading-time/lib/reading-time.js?");

/***/ })

/******/ });