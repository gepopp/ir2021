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
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/js/single-video.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/single-video.js":
/*!***********************************!*\
  !*** ./assets/js/single-video.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("window.prerolled = function (main_id, preroll_id, image, skip) {\n  return {\n    mainId: main_id,\n    prerollId: preroll_id,\n    image: image,\n    played: false,\n    prerolls: false,\n    main: false,\n    countdown: skip,\n    loading: false,\n    video01Player: false,\n    play: function play() {\n      var _this = this;\n\n      this.loading = true;\n      var preroll = {\n        id: this.prerollId,\n        width: \"1280\",\n        controls: false,\n        quality: \"1080p\"\n      };\n      this.video01Player = new Vimeo.Player('preroll', preroll);\n      this.video01Player.play().then(function () {\n        _this.loading = false;\n        _this.played = true;\n        _this.prerolls = true;\n        var timer = window.setInterval(function () {\n          if (_this.countdown > 0) {\n            _this.countdown--;\n          } else {\n            clearInterval(timer);\n          }\n        }, 1000);\n      });\n      this.video01Player.on('ended', function () {\n        _this.playMain();\n      });\n      this.video01Player.on('play', function () {\n        console.log('Played the first video');\n      });\n    },\n    playMain: function playMain() {\n      var autoplay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;\n      this.video01Player.pause();\n      var main = {\n        id: this.mainId,\n        width: \"1280\",\n        controls: true\n      };\n      var video01Player = new Vimeo.Player('clip', main);\n      this.played = true;\n      this.prerolls = false;\n      this.main = true;\n\n      if (autoplay) {\n        video01Player.play().then(function () {});\n      }\n    }\n  };\n};\n\n//# sourceURL=webpack:///./assets/js/single-video.js?");

/***/ })

/******/ });