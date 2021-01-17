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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.scss":
/*!********************************!*\
  !*** ./resources/css/app.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cart__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cart */ "./resources/js/cart.js");
/* harmony import */ var _imageUploader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./imageUploader */ "./resources/js/imageUploader.js");


window.initAddToCart = _cart__WEBPACK_IMPORTED_MODULE_0__["initAddToCart"];
window.initCartDeleteButton = _cart__WEBPACK_IMPORTED_MODULE_0__["initCartDeleteButton"];
window.imageUploader = _imageUploader__WEBPACK_IMPORTED_MODULE_1__["default"];

/***/ }),

/***/ "./resources/js/cart.js":
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
/*! exports provided: initAddToCart, initCartDeleteButton */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initAddToCart", function() { return initAddToCart; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCartDeleteButton", function() { return initCartDeleteButton; });
function getCart() {
  var cart = Cookies.get('cart');
  return !cart ? {} : JSON.parse(cart);
}

function addProductToCart(productId, quantity) {
  var cart = getCart();
  var currentQuantity = parseInt(cart[productId]) || 0;
  var addQuantity = parseInt(quantity) || 0;
  var newQuantity = currentQuantity + addQuantity;
  updateProductToCart(productId, newQuantity);
}

function updateProductToCart(productId, newQuantity) {
  var cart = getCart();
  cart[productId] = newQuantity;
  saveCart(cart);
}

function alertProductQuantity(productId) {
  var cart = getCart();
  var quantity = parseInt(cart[productId]) || 0;
  alert(quantity);
}

function saveCart(cart) {
  Cookies.set("cart", JSON.stringify(cart));
}

function initAddToCart(productId) {
  var addToCartBtn = document.querySelector("#addToCart");

  if (addToCartBtn) {
    addToCartBtn.addEventListener("click", function () {
      var quantityInput = document.querySelector('input[name="quantity"]');

      if (quantityInput) {
        console.log(quantityInput, quantityInput.value);
        addProductToCart(productId, quantityInput.value);
        alertProductQuantity(productId);
      }
    });
  }
}

function initCartDeleteButton(actionUrl) {
  var cartDeleteButtons = document.querySelectorAll('.cartDeleteBtn');

  for (var index = 0; index < cartDeleteButtons.length; index++) {
    var cartDeleteButton = cartDeleteButtons[index];
    cartDeleteButton.addEventListener('click', function (e) {
      var btn = e.target;
      var dataId = btn.getAttribute('data-id');
      var formData = new FormData();
      formData.append("_method", "DELETE");
      var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
      var csrfToken = csrfTokenMeta.content;
      formData.append("_token", csrfToken);
      formData.append('id', dataId);
      var request = new XMLHttpRequest();
      request.open('POST', actionUrl);

      request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200 && request.responseText === "success") {
          window.location.reload();
        }
      };

      request.send(formData);
    });
  }
}



/***/ }),

/***/ "./resources/js/imageUploader.js":
/*!***************************************!*\
  !*** ./resources/js/imageUploader.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var imageUploader = function imageUploader(className) {
  var containers = document.querySelectorAll(".".concat(className));

  var _iterator = _createForOfIteratorHelper(containers),
      _step;

  try {
    var _loop = function _loop() {
      var container = _step.value;
      var input = container.querySelector("input[type=file]");
      img = document.querySelector("img");
      oldSrc = img.src;
      input.addEventListener("change", function (e) {
        readURL(e.target);
      });

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            console.log(e.target.result);
            img.setAttribute('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
        } else {
          img.setAttribute('src', oldSrc);
        }
      }
    };

    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var img;
      var oldSrc;

      _loop();
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  ;
};

/* harmony default export */ __webpack_exports__["default"] = (imageUploader);

/***/ }),

/***/ 0:
/*!************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/css/app.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\1234\Desktop\pb_controller\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\1234\Desktop\pb_controller\resources\css\app.scss */"./resources/css/app.scss");


/***/ })

/******/ });