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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/scripts/admin/_confirmation-popup.js":
/*!*********************************************************!*\
  !*** ./assets/src/scripts/admin/_confirmation-popup.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Confirmation Popup
 */
jQuery(document).ready(function ($) {
  $(".cd-popup").each(function () {
    $this = $(this);

    $this.init.prototype.open = function (e) {
      $(this).find('.spinner').css('visibility', 'hidden');
      $(this).addClass('is-visible').trigger('open');
    };

    $this.init.prototype.close = function (e) {
      $(this).removeClass('is-visible').trigger('close');
    };
  }).on('click', '.status-ok', function (e) {
    $(this).closest('.cd-popup').find('.spinner').css('visibility', 'visible');
  }).on('click', '.cd-popup-close', function (e) {
    e.preventDefault();
    $(this).closest('.cd-popup').close();
  }); //open a popup via registered trigger element

  $('.cd-popup-trigger').on('click', function (event) {
    event.preventDefault();
    var $this = $(this);
    var popup_id;

    if ($this.is('a')) {
      //get the popup id from the href
      popup_id = this.attr('href');
    } else if ($this.find('a').length) {
      //get the popup id from a child a.href
      popup_id = $this.find('a')[0].href;
    } else if ($this.closest('a').length) {
      //get the popup id from a parent a.href
      popup_id = $this.closest('a');
    }

    if (typeof popup_id === 'string') {
      var hash_index = popup_id.indexOf('#');

      if (hash_index >= 0) {
        $(popup_id.substr(hash_index)).open();
      }
    }
  }); //close popup when clicking the esc keyboard button

  $(document).keyup(function (event) {
    if (event.which === '27') {
      $('.cd-popup.is-visible').close();
    }
  });
});

/***/ }),

/***/ "./assets/src/scripts/admin/_unity3-adminimize.js":
/*!********************************************************!*\
  !*** ./assets/src/scripts/admin/_unity3-adminimize.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Adminimize
 */
jQuery(document).ready(function ($) {
  //adminimize helper function
  $('.settings_page_adminimize-adminimize').on('click', 'input[type="checkbox"]', function (e) {
    if (e.shiftKey) {
      var checkstate = $(this).is(":checked"); //check all sibling checkboxes

      $(this).parents('tr').find('input[type="checkbox"]').prop('checked', checkstate);
    }
  });
});

/***/ }),

/***/ "./assets/src/scripts/admin/_unity3-drag-sort-posts.js":
/*!*************************************************************!*\
  !*** ./assets/src/scripts/admin/_unity3-drag-sort-posts.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Drag Sort Posts
 */
jQuery(document).ready(function ($) {
  if ('undefined' === typeof unity3.dragsort) return;
  "use strict"; //Attach sortable to the tbody, NOT tr


  $("tbody#the-list").sortable({
    cursor: "move",
    axis: "y",
    start: function start(e, ui) {
      ui.placeholder.height(ui.item.height());
    },
    update: function update(event, ui) {
      var serialized = {};
      $(this).children().each(function (index, el) {
        serialized[el.id.split("-")[1]] = index;
      });
      $.post(ajaxurl, {
        action: 'unity3_drag_sort_posts',
        posts: serialized
      });
    }
  });
  $("#the-list .column-dragsort").attr('title', unity3.dragsort.tooltip);
});

/***/ }),

/***/ "./assets/src/scripts/admin/_unity3-site-updated-notice.js":
/*!*****************************************************************!*\
  !*** ./assets/src/scripts/admin/_unity3-site-updated-notice.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Site Update Notice
 */
jQuery(document).ready(function ($) {
  var isUpdating = false;
  var $popup = $("#update-site-notice-popup");
  if ($popup.length === 0) return;
  $popup.on('click', '.status-ok', function (e) {
    e.preventDefault();
    if (isUpdating) return;
    isUpdating = true;
    var $this = $(this);
    $.ajax({
      url: ajaxurl,
      data: {
        action: 'unity3_site_updated_notice',
        unity3_time: $("#unity3-site-update-time").val(),
        unity3_message: $("#unity3-site-update-message").val()
      },
      success: function success(data) {
        if ($.trim(data)) {
          $('.unity3-site-updated-notice .content').html(data.data);
        }

        $popup.close();
        isUpdating = false;
      }
    });
  });
  $(document).on('click', '.unity3-site-updated-notice .notice-dismiss', function () {
    $.ajax({
      url: ajaxurl,
      data: {
        action: 'unity3_site_updated_notice_dismiss'
      }
    });
  });
});

/***/ }),

/***/ "./assets/src/scripts/admin/unity3-admin.js":
/*!**************************************************!*\
  !*** ./assets/src/scripts/admin/unity3-admin.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _confirmation_popup__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_confirmation-popup */ "./assets/src/scripts/admin/_confirmation-popup.js");
/* harmony import */ var _confirmation_popup__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_confirmation_popup__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _unity3_adminimize__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_unity3-adminimize */ "./assets/src/scripts/admin/_unity3-adminimize.js");
/* harmony import */ var _unity3_adminimize__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_unity3_adminimize__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _unity3_drag_sort_posts__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_unity3-drag-sort-posts */ "./assets/src/scripts/admin/_unity3-drag-sort-posts.js");
/* harmony import */ var _unity3_drag_sort_posts__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_unity3_drag_sort_posts__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _unity3_site_updated_notice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./_unity3-site-updated-notice */ "./assets/src/scripts/admin/_unity3-site-updated-notice.js");
/* harmony import */ var _unity3_site_updated_notice__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_unity3_site_updated_notice__WEBPACK_IMPORTED_MODULE_3__);





/***/ }),

/***/ 1:
/*!********************************************************!*\
  !*** multi ./assets/src/scripts/admin/unity3-admin.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! S:\WORDPRESS\unity3dev\wp-content\plugins\unity3\assets\src\scripts\admin\unity3-admin.js */"./assets/src/scripts/admin/unity3-admin.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2FkbWluL19jb25maXJtYXRpb24tcG9wdXAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2FkbWluL191bml0eTMtYWRtaW5pbWl6ZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3JjL3NjcmlwdHMvYWRtaW4vX3VuaXR5My1kcmFnLXNvcnQtcG9zdHMuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2FkbWluL191bml0eTMtc2l0ZS11cGRhdGVkLW5vdGljZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3JjL3NjcmlwdHMvYWRtaW4vdW5pdHkzLWFkbWluLmpzIl0sIm5hbWVzIjpbImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiLCIkIiwiZWFjaCIsIiR0aGlzIiwiaW5pdCIsInByb3RvdHlwZSIsIm9wZW4iLCJlIiwiZmluZCIsImNzcyIsImFkZENsYXNzIiwidHJpZ2dlciIsImNsb3NlIiwicmVtb3ZlQ2xhc3MiLCJvbiIsImNsb3Nlc3QiLCJwcmV2ZW50RGVmYXVsdCIsImV2ZW50IiwicG9wdXBfaWQiLCJpcyIsImF0dHIiLCJsZW5ndGgiLCJocmVmIiwiaGFzaF9pbmRleCIsImluZGV4T2YiLCJzdWJzdHIiLCJrZXl1cCIsIndoaWNoIiwic2hpZnRLZXkiLCJjaGVja3N0YXRlIiwicGFyZW50cyIsInByb3AiLCJ1bml0eTMiLCJkcmFnc29ydCIsInNvcnRhYmxlIiwiY3Vyc29yIiwiYXhpcyIsInN0YXJ0IiwidWkiLCJwbGFjZWhvbGRlciIsImhlaWdodCIsIml0ZW0iLCJ1cGRhdGUiLCJzZXJpYWxpemVkIiwiY2hpbGRyZW4iLCJpbmRleCIsImVsIiwiaWQiLCJzcGxpdCIsInBvc3QiLCJhamF4dXJsIiwiYWN0aW9uIiwicG9zdHMiLCJ0b29sdGlwIiwiaXNVcGRhdGluZyIsIiRwb3B1cCIsImFqYXgiLCJ1cmwiLCJkYXRhIiwidW5pdHkzX3RpbWUiLCJ2YWwiLCJ1bml0eTNfbWVzc2FnZSIsInN1Y2Nlc3MiLCJ0cmltIiwiaHRtbCJdLCJtYXBwaW5ncyI6IjtRQUFBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBOzs7UUFHQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMENBQTBDLGdDQUFnQztRQUMxRTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLHdEQUF3RCxrQkFBa0I7UUFDMUU7UUFDQSxpREFBaUQsY0FBYztRQUMvRDs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0EseUNBQXlDLGlDQUFpQztRQUMxRSxnSEFBZ0gsbUJBQW1CLEVBQUU7UUFDckk7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSwyQkFBMkIsMEJBQTBCLEVBQUU7UUFDdkQsaUNBQWlDLGVBQWU7UUFDaEQ7UUFDQTtRQUNBOztRQUVBO1FBQ0Esc0RBQXNELCtEQUErRDs7UUFFckg7UUFDQTs7O1FBR0E7UUFDQTs7Ozs7Ozs7Ozs7O0FDbEZBOzs7QUFHQUEsTUFBTSxDQUFDQyxRQUFELENBQU4sQ0FBaUJDLEtBQWpCLENBQXVCLFVBQVNDLENBQVQsRUFBVztBQUU5QkEsR0FBQyxDQUFDLFdBQUQsQ0FBRCxDQUFlQyxJQUFmLENBQW9CLFlBQVU7QUFDMUJDLFNBQUssR0FBR0YsQ0FBQyxDQUFDLElBQUQsQ0FBVDs7QUFFQUUsU0FBSyxDQUFDQyxJQUFOLENBQVdDLFNBQVgsQ0FBcUJDLElBQXJCLEdBQTRCLFVBQVNDLENBQVQsRUFBWTtBQUNwQ04sT0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRTyxJQUFSLENBQWEsVUFBYixFQUF5QkMsR0FBekIsQ0FBNkIsWUFBN0IsRUFBMkMsUUFBM0M7QUFDQVIs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QUcsS0FBYjtBQUNIO0FBYkUsS0FBUDtBQWVILEdBdkJEO0FBeUJBckQsR0FBQyxDQUFDRixRQUFELENBQUQsQ0FBWWUsRUFBWixDQUFnQixPQUFoQixFQUF5Qiw2Q0FBekIsRUFBd0UsWUFBVztBQUUvRWIsS0FBQyxDQUFDdUQsSUFBRixDQUFPO0FBQ0hDLFNBQUcsRUFBRVAsT0FERjtBQUVIUSxVQUFJLEVBQUU7QUFDRlAsY0FBTSxFQUFFO0FBRE47QUFGSCxLQUFQO0FBT0gsR0FURDtBQVdILENBM0NELEU7Ozs7Ozs7Ozs7OztBQ0hBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQSIsImZpbGUiOiJ1bml0eTMtYWRtaW4uanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIlwiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMSk7XG4iLCIvKlxyXG5Db25maXJtYXRpb24gUG9wdXBcclxuICovXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XHJcblxyXG4gICAgJChcIi5jZC1wb3B1cFwiKS5lYWNoKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJHRoaXMgPSAkKHRoaXMpO1xyXG5cclxuICAgICAgICAkdGhpcy5pbml0LnByb3RvdHlwZS5vcGVuID0gZnVuY3Rpb24oZSkge1xyXG4gICAgICAgICAgICAkKHRoaXMpLmZpbmQoJy5zcGlubmVyJykuY3NzKCd2aXNpYmlsaXR5JywgJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdpcy12aXNpYmxlJykudHJpZ2dlcignb3BlbicpO1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgICR0aGlzLmluaXQucHJvdG90eXBlLmNsb3NlID0gZnVuY3Rpb24oZSkge1xyXG4gICAgICAgICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdpcy12aXNpYmxlJykudHJpZ2dlcignY2xvc2UnKTtcclxuICAgICAgICB9O1xyXG5cclxuICAgIH0pLm9uKCdjbGljaycsJy5zdGF0dXMtb2snLCBmdW5jdGlvbihlKXtcclxuXHJcbiAgICAgICAgJCh0aGlzKS5jbG9zZXN0KCcuY2QtcG9wdXAnKS5maW5kKCcuc3Bpbm5lcicpLmNzcygndmlzaWJpbGl0eScsICd2aXNpYmxlJyk7XHJcblxyXG4gICAgfSkub24oJ2NsaWNrJywnLmNkLXBvcHVwLWNsb3NlJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICQodGhpcykuY2xvc2VzdCgnLmNkLXBvcHVwJykuY2xvc2UoKTtcclxuICAgIH0pO1xyXG5cclxuXHJcbiAgICAvL29wZW4gYSBwb3B1cCB2aWEgcmVnaXN0ZXJlZCB0cmlnZ2VyIGVsZW1lbnRcclxuICAgICQoJy5jZC1wb3B1cC10cmlnZ2VyJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyICR0aGlzID0gJCh0aGlzKTtcclxuICAgICAgICB2YXIgcG9wdXBfaWQ7XHJcblxyXG4gICAgICAgIGlmICgkdGhpcy5pcygnYScpKSB7XHJcbiAgICAgICAgICAgIC8vZ2V0IHRoZSBwb3B1cCBpZCBmcm9tIHRoZSBocmVmXHJcbiAgICAgICAgICAgIHBvcHVwX2lkID0gKHRoaXMpLmF0dHIoJ2hyZWYnKTtcclxuICAgICAgICB9IGVsc2UgaWYoICR0aGlzLmZpbmQoJ2EnKS5sZW5ndGggKSB7XHJcbiAgICAgICAgICAgIC8vZ2V0IHRoZSBwb3B1cCBpZCBmcm9tIGEgY2hpbGQgYS5ocmVmXHJcbiAgICAgICAgICAgIHBvcHVwX2lkID0gJHRoaXMuZmluZCgnYScpWzBdLmhyZWZcclxuICAgICAgICB9IGVsc2UgaWYgKCAkdGhpcy5jbG9zZXN0KCdhJykubGVuZ3RoICkge1xyXG4gICAgICAgICAgICAvL2dldCB0aGUgcG9wdXAgaWQgZnJvbSBhIHBhcmVudCBhLmhyZWZcclxuICAgICAgICAgICAgcG9wdXBfaWQgPSAkdGhpcy5jbG9zZXN0KCdhJyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBpZiAodHlwZW9mIHBvcHVwX2lkID09PSAnc3RyaW5nJykge1xyXG4gICAgICAgICAgICB2YXIgaGFzaF9pbmRleCA9IHBvcHVwX2lkLmluZGV4T2YoJyMnKTtcclxuICAgICAgICAgICAgaWYgKGhhc2hfaW5kZXggPj0gMCkge1xyXG4gICAgICAgICAgICAgICAgJCggcG9wdXBfaWQuc3Vic3RyKGhhc2hfaW5kZXgpICkub3BlbigpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG5cclxuICAgIC8vY2xvc2UgcG9wdXAgd2hlbiBjbGlja2luZyB0aGUgZXNjIGtleWJvYXJkIGJ1dHRvblxyXG4gICAgJChkb2N1bWVudCkua2V5dXAoZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgIGlmKGV2ZW50LndoaWNoID09PSAnMjcnKXtcclxuICAgICAgICAgICAgJCgnLmNkLXBvcHVwLmlzLXZpc2libGUnKS5jbG9zZSgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTsiLCIvKlxyXG5BZG1pbmltaXplXHJcbiAqL1xyXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KCBmdW5jdGlvbigkKSB7XHJcblxyXG4gICAgLy9hZG1pbmltaXplIGhlbHBlciBmdW5jdGlvblxyXG4gICAgJCgnLnNldHRpbmdzX3BhZ2VfYWRtaW5pbWl6ZS1hZG1pbmltaXplJykub24oJ2NsaWNrJywgJ2lucHV0W3R5cGU9XCJjaGVja2JveFwiXScsIGZ1bmN0aW9uKGUpIHtcclxuICAgICAgICBpZiAoZS5zaGlmdEtleSkge1xyXG4gICAgICAgICAgICB2YXIgY2hlY2tzdGF0ZSA9ICQodGhpcykuaXMoXCI6Y2hlY2tlZFwiKTtcclxuICAgICAgICAgICAgLy9jaGVjayBhbGwgc2libGluZyBjaGVja2JveGVzXHJcbiAgICAgICAgICAgICQodGhpcykucGFyZW50cygndHInKS5maW5kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl0nKS5wcm9wKCdjaGVja2VkJywgY2hlY2tzdGF0ZSk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pOyIsIi8qXHJcbkRyYWcgU29ydCBQb3N0c1xyXG4gKi9cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeSggZnVuY3Rpb24oJCkge1xyXG5cclxuICAgIGlmICggJ3VuZGVmaW5lZCcgPT09IHR5cGVvZiB1bml0eTMuZHJhZ3NvcnQgKVxyXG4gICAgICAgIHJldHVybjtcclxuXHJcbiAgICBcInVzZSBzdHJpY3RcIjtcclxuXHJcbiAgICAvL0F0dGFjaCBzb3J0YWJsZSB0byB0aGUgdGJvZHksIE5PVCB0clxyXG4gICAgJChcInRib2R5I3RoZS1saXN0XCIpLnNvcnRhYmxlKHtcclxuICAgICAgICBjdXJzb3I6IFwibW92ZVwiLFxyXG4gICAgICAgIGF4aXM6IFwieVwiLFxyXG4gICAgICAgIHN0YXJ0OiBmdW5jdGlvbihlLCB1aSl7XHJcbiAgICAgICAgICAgIHVpLnBsYWNlaG9sZGVyLmhlaWdodCh1aS5pdGVtLmhlaWdodCgpKTtcclxuICAgICAgICB9LFxyXG4gICAgICAgIHVwZGF0ZTogZnVuY3Rpb24oZXZlbnQsIHVpKSB7XHJcbiAgICAgICAgICAgIHZhciBzZXJpYWxpemVkID0ge307XHJcblxyXG4gICAgICAgICAgICAkKHRoaXMpLmNoaWxkcmVuKCkuZWFjaCggZnVuY3Rpb24oaW5kZXgsIGVsKSB7XHJcbiAgICAgICAgICAgICAgICBzZXJpYWxpemVkW2VsLmlkLnNwbGl0KFwiLVwiKVsxXV0gPSBpbmRleDtcclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAkLnBvc3QoYWpheHVybCwge1xyXG4gICAgICAgICAgICAgICAgYWN0aW9uOid1bml0eTNfZHJhZ19zb3J0X3Bvc3RzJyxcclxuICAgICAgICAgICAgICAgIHBvc3RzOiBzZXJpYWxpemVkXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuICAgICQoXCIjdGhlLWxpc3QgLmNvbHVtbi1kcmFnc29ydFwiKS5hdHRyKCd0aXRsZScsIHVuaXR5My5kcmFnc29ydC50b29sdGlwKTtcclxufSk7XHJcbiIsIi8qXHJcblNpdGUgVXBkYXRlIE5vdGljZVxyXG4gKi9cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeSggZnVuY3Rpb24oJCkge1xyXG5cclxuICAgIHZhciBpc1VwZGF0aW5nID0gZmFsc2U7XHJcbiAgICB2YXIgJHBvcHVwID0gJCggXCIjdXBkYXRlLXNpdGUtbm90aWNlLXBvcHVwXCIgKTtcclxuICAgIGlmICggJHBvcHVwLmxlbmd0aCA9PT0gMClcclxuICAgICAgICByZXR1cm47XHJcblxyXG4gICAgJHBvcHVwLm9uKCdjbGljaycsICcuc3RhdHVzLW9rJywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcblxyXG4gICAgICAgIGlmIChpc1VwZGF0aW5nKVxyXG4gICAgICAgICAgICByZXR1cm47XHJcblxyXG4gICAgICAgIGlzVXBkYXRpbmcgPSB0cnVlO1xyXG4gICAgICAgIHZhciAkdGhpcyA9ICQodGhpcyk7XHJcbiAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgdXJsOiBhamF4dXJsLFxyXG4gICAgICAgICAgICBkYXRhOiB7XHJcbiAgICAgICAgICAgICAgICBhY3Rpb246ICd1bml0eTNfc2l0ZV91cGRhdGVkX25vdGljZScsXHJcbiAgICAgICAgICAgICAgICB1bml0eTNfdGltZTogJChcIiN1bml0eTMtc2l0ZS11cGRhdGUtdGltZVwiKS52YWwoKSxcclxuICAgICAgICAgICAgICAgIHVuaXR5M19tZXNzYWdlOiAkKFwiI3VuaXR5My1zaXRlLXVwZGF0ZS1tZXNzYWdlXCIpLnZhbCgpXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpIHtcclxuICAgICAgICAgICAgICAgIGlmICgkLnRyaW0oZGF0YSkpIHtcclxuICAgICAgICAgICAgICAgICAgICAkKCcudW5pdHkzLXNpdGUtdXBkYXRlZC1ub3RpY2UgLmNvbnRlbnQnKS5odG1sKGRhdGEuZGF0YSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAkcG9wdXAuY2xvc2UoKTtcclxuICAgICAgICAgICAgICAgIGlzVXBkYXRpbmcgPSBmYWxzZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJChkb2N1bWVudCkub24oICdjbGljaycsICcudW5pdHkzLXNpdGUtdXBkYXRlZC1ub3RpY2UgLm5vdGljZS1kaXNtaXNzJywgZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHVybDogYWpheHVybCxcclxuICAgICAgICAgICAgZGF0YToge1xyXG4gICAgICAgICAgICAgICAgYWN0aW9uOiAndW5pdHkzX3NpdGVfdXBkYXRlZF9ub3RpY2VfZGlzbWlzcydcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pXHJcblxyXG4gICAgfSk7XHJcblxyXG59KTtcclxuXHJcblxyXG4iLCJpbXBvcnQgJy4vX2NvbmZpcm1hdGlvbi1wb3B1cCc7XHJcbmltcG9ydCAnLi9fdW5pdHkzLWFkbWluaW1pemUnO1xyXG5pbXBvcnQgJy4vX3VuaXR5My1kcmFnLXNvcnQtcG9zdHMnO1xyXG5pbXBvcnQgJy4vX3VuaXR5My1zaXRlLXVwZGF0ZWQtbm90aWNlJzsiXSwic291cmNlUm9vdCI6IiJ9