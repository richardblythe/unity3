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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/scripts/front/_aos.js":
/*!******************************************!*\
  !*** ./assets/src/scripts/front/_aos.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! aos */ "./node_modules/aos/dist/aos.js");
/* harmony import */ var aos__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(aos__WEBPACK_IMPORTED_MODULE_0__);
/** Vendor: AOS */

jQuery(document).ready(function () {
  if (typeof unity3 != "undefined") {
    aos__WEBPACK_IMPORTED_MODULE_0___default.a.init(unity3.aos.init);
  }
});

/***/ }),

/***/ "./assets/src/scripts/front/unity3-front.js":
/*!**************************************************!*\
  !*** ./assets/src/scripts/front/unity3-front.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _aos__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_aos */ "./assets/src/scripts/front/_aos.js");


/***/ }),

/***/ "./node_modules/aos/dist/aos.js":
/*!**************************************!*\
  !*** ./node_modules/aos/dist/aos.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(module) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

!function (e, t) {
  "object" == ( false ? undefined : _typeof(exports)) && "object" == ( false ? undefined : _typeof(module)) ? module.exports = t() :  true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (t),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : undefined;
}(this, function () {
  return function (e) {
    function t(o) {
      if (n[o]) return n[o].exports;
      var i = n[o] = {
        exports: {},
        id: o,
        loaded: !1
      };
      return e[o].call(i.exports, i, i.exports, t), i.loaded = !0, i.exports;
    }

    var n = {};
    return t.m = e, t.c = n, t.p = "dist/", t(0);
  }([function (e, t, n) {
    "use strict";

    function o(e) {
      return e && e.__esModule ? e : {
        "default": e
      };
    }

    var i = Object.assign || function (e) {
      for (var t = 1; t < arguments.length; t++) {
        var n = arguments[t];

        for (var o in n) {
          Object.prototype.hasOwnProperty.call(n, o) && (e[o] = n[o]);
        }
      }

      return e;
    },
        r = n(1),
        a = (o(r), n(6)),
        u = o(a),
        c = n(7),
        s = o(c),
        f = n(8),
        d = o(f),
        l = n(9),
        p = o(l),
        m = n(10),
        b = o(m),
        v = n(11),
        y = o(v),
        g = n(14),
        h = o(g),
        w = [],
        k = !1,
        x = {
      offset: 120,
      delay: 0,
      easing: "ease",
      duration: 400,
      disable: !1,
      once: !1,
      startEvent: "DOMContentLoaded",
      throttleDelay: 99,
      debounceDelay: 50,
      disableMutationObserver: !1
    },
        j = function j() {
      var e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
      if (e && (k = !0), k) return w = (0, y["default"])(w, x), (0, b["default"])(w, x.once), w;
    },
        O = function O() {
      w = (0, h["default"])(), j();
    },
        M = function M() {
      w.forEach(function (e, t) {
        e.node.removeAttribute("data-aos"), e.node.removeAttribute("data-aos-easing"), e.node.removeAttribute("data-aos-duration"), e.node.removeAttribute("data-aos-delay");
      });
    },
        S = function S(e) {
      return e === !0 || "mobile" === e && p["default"].mobile() || "phone" === e && p["default"].phone() || "tablet" === e && p["default"].tablet() || "function" == typeof e && e() === !0;
    },
        _ = function _(e) {
      x = i(x, e), w = (0, h["default"])();
      var t = document.all && !window.atob;
      return S(x.disable) || t ? M() : (x.disableMutationObserver || d["default"].isSupported() || (console.info('\n      aos: MutationObserver is not supported on this browser,\n      code mutations observing has been disabled.\n      You may have to call "refreshHard()" by yourself.\n    '), x.disableMutationObserver = !0), document.querySelector("body").setAttribute("data-aos-easing", x.easing), document.querySelector("body").setAttribute("data-aos-duration", x.duration), document.querySelector("body").setAttribute("data-aos-delay", x.delay), "DOMContentLoaded" === x.startEvent && ["complete", "interactive"].indexOf(document.readyState) > -1 ? j(!0) : "load" === x.startEvent ? window.addEventListener(x.startEvent, function () {
        j(!0);
      }) : document.addEventListener(x.startEvent, function () {
        j(!0);
      }), window.addEventListener("resize", (0, s["default"])(j, x.debounceDelay, !0)), window.addEventListener("orientationchange", (0, s["default"])(j, x.debounceDelay, !0)), window.addEventListener("scroll", (0, u["default"])(function () {
        (0, b["default"])(w, x.once);
      }, x.throttleDelay)), x.disableMutationObserver || d["default"].ready("[data-aos]", O), w);
    };

    e.exports = {
      init: _,
      refresh: j,
      refreshHard: O
    };
  }, function (e, t) {},,,,, function (e, t) {
    (function (t) {
      "use strict";

      function n(e, t, n) {
        function o(t) {
          var n = b,
              o = v;
          return b = v = void 0, k = t, g = e.apply(o, n);
        }

        function r(e) {
          return k = e, h = setTimeout(f, t), M ? o(e) : g;
        }

        function a(e) {
          var n = e - w,
              o = e - k,
              i = t - n;
          return S ? j(i, y - o) : i;
        }

        function c(e) {
          var n = e - w,
              o = e - k;
          return void 0 === w || n >= t || n < 0 || S && o >= y;
        }

        function f() {
          var e = O();
          return c(e) ? d(e) : void (h = setTimeout(f, a(e)));
        }

        function d(e) {
          return h = void 0, _ && b ? o(e) : (b = v = void 0, g);
        }

        function l() {
          void 0 !== h && clearTimeout(h), k = 0, b = w = v = h = void 0;
        }

        function p() {
          return void 0 === h ? g : d(O());
        }

        function m() {
          var e = O(),
              n = c(e);

          if (b = arguments, v = this, w = e, n) {
            if (void 0 === h) return r(w);
            if (S) return h = setTimeout(f, t), o(w);
          }

          return void 0 === h && (h = setTimeout(f, t)), g;
        }

        var b,
            v,
            y,
            g,
            h,
            w,
            k = 0,
            M = !1,
            S = !1,
            _ = !0;

        if ("function" != typeof e) throw new TypeError(s);
        return t = u(t) || 0, i(n) && (M = !!n.leading, S = "maxWait" in n, y = S ? x(u(n.maxWait) || 0, t) : y, _ = "trailing" in n ? !!n.trailing : _), m.cancel = l, m.flush = p, m;
      }

      function o(e, t, o) {
        var r = !0,
            a = !0;
        if ("function" != typeof e) throw new TypeError(s);
        return i(o) && (r = "leading" in o ? !!o.leading : r, a = "trailing" in o ? !!o.trailing : a), n(e, t, {
          leading: r,
          maxWait: t,
          trailing: a
        });
      }

      function i(e) {
        var t = "undefined" == typeof e ? "undefined" : c(e);
        return !!e && ("object" == t || "function" == t);
      }

      function r(e) {
        return !!e && "object" == ("undefined" == typeof e ? "undefined" : c(e));
      }

      function a(e) {
        return "symbol" == ("undefined" == typeof e ? "undefined" : c(e)) || r(e) && k.call(e) == d;
      }

      function u(e) {
        if ("number" == typeof e) return e;
        if (a(e)) return f;

        if (i(e)) {
          var t = "function" == typeof e.valueOf ? e.valueOf() : e;
          e = i(t) ? t + "" : t;
        }

        if ("string" != typeof e) return 0 === e ? e : +e;
        e = e.replace(l, "");
        var n = m.test(e);
        return n || b.test(e) ? v(e.slice(2), n ? 2 : 8) : p.test(e) ? f : +e;
      }

      var c = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          s = "Expected a function",
          f = NaN,
          d = "[object Symbol]",
          l = /^\s+|\s+$/g,
          p = /^[-+]0x[0-9a-f]+$/i,
          m = /^0b[01]+$/i,
          b = /^0o[0-7]+$/i,
          v = parseInt,
          y = "object" == ("undefined" == typeof t ? "undefined" : c(t)) && t && t.Object === Object && t,
          g = "object" == ("undefined" == typeof self ? "undefined" : c(self)) && self && self.Object === Object && self,
          h = y || g || Function("return this")(),
          w = Object.prototype,
          k = w.toString,
          x = Math.max,
          j = Math.min,
          O = function O() {
        return h.Date.now();
      };

      e.exports = o;
    }).call(t, function () {
      return this;
    }());
  }, function (e, t) {
    (function (t) {
      "use strict";

      function n(e, t, n) {
        function i(t) {
          var n = b,
              o = v;
          return b = v = void 0, O = t, g = e.apply(o, n);
        }

        function r(e) {
          return O = e, h = setTimeout(f, t), M ? i(e) : g;
        }

        function u(e) {
          var n = e - w,
              o = e - O,
              i = t - n;
          return S ? x(i, y - o) : i;
        }

        function s(e) {
          var n = e - w,
              o = e - O;
          return void 0 === w || n >= t || n < 0 || S && o >= y;
        }

        function f() {
          var e = j();
          return s(e) ? d(e) : void (h = setTimeout(f, u(e)));
        }

        function d(e) {
          return h = void 0, _ && b ? i(e) : (b = v = void 0, g);
        }

        function l() {
          void 0 !== h && clearTimeout(h), O = 0, b = w = v = h = void 0;
        }

        function p() {
          return void 0 === h ? g : d(j());
        }

        function m() {
          var e = j(),
              n = s(e);

          if (b = arguments, v = this, w = e, n) {
            if (void 0 === h) return r(w);
            if (S) return h = setTimeout(f, t), i(w);
          }

          return void 0 === h && (h = setTimeout(f, t)), g;
        }

        var b,
            v,
            y,
            g,
            h,
            w,
            O = 0,
            M = !1,
            S = !1,
            _ = !0;

        if ("function" != typeof e) throw new TypeError(c);
        return t = a(t) || 0, o(n) && (M = !!n.leading, S = "maxWait" in n, y = S ? k(a(n.maxWait) || 0, t) : y, _ = "trailing" in n ? !!n.trailing : _), m.cancel = l, m.flush = p, m;
      }

      function o(e) {
        var t = "undefined" == typeof e ? "undefined" : u(e);
        return !!e && ("object" == t || "function" == t);
      }

      function i(e) {
        return !!e && "object" == ("undefined" == typeof e ? "undefined" : u(e));
      }

      function r(e) {
        return "symbol" == ("undefined" == typeof e ? "undefined" : u(e)) || i(e) && w.call(e) == f;
      }

      function a(e) {
        if ("number" == typeof e) return e;
        if (r(e)) return s;

        if (o(e)) {
          var t = "function" == typeof e.valueOf ? e.valueOf() : e;
          e = o(t) ? t + "" : t;
        }

        if ("string" != typeof e) return 0 === e ? e : +e;
        e = e.replace(d, "");
        var n = p.test(e);
        return n || m.test(e) ? b(e.slice(2), n ? 2 : 8) : l.test(e) ? s : +e;
      }

      var u = "function" == typeof Symbol && "symbol" == _typeof(Symbol.iterator) ? function (e) {
        return _typeof(e);
      } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : _typeof(e);
      },
          c = "Expected a function",
          s = NaN,
          f = "[object Symbol]",
          d = /^\s+|\s+$/g,
          l = /^[-+]0x[0-9a-f]+$/i,
          p = /^0b[01]+$/i,
          m = /^0o[0-7]+$/i,
          b = parseInt,
          v = "object" == ("undefined" == typeof t ? "undefined" : u(t)) && t && t.Object === Object && t,
          y = "object" == ("undefined" == typeof self ? "undefined" : u(self)) && self && self.Object === Object && self,
          g = v || y || Function("return this")(),
          h = Object.prototype,
          w = h.toString,
          k = Math.max,
          x = Math.min,
          j = function j() {
        return g.Date.now();
      };

      e.exports = n;
    }).call(t, function () {
      return this;
    }());
  }, function (e, t) {
    "use strict";

    function n(e) {
      var t = void 0,
          o = void 0,
          i = void 0;

      for (t = 0; t < e.length; t += 1) {
        if (o = e[t], o.dataset && o.dataset.aos) return !0;
        if (i = o.children && n(o.children)) return !0;
      }

      return !1;
    }

    function o() {
      return window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    }

    function i() {
      return !!o();
    }

    function r(e, t) {
      var n = window.document,
          i = o(),
          r = new i(a);
      u = t, r.observe(n.documentElement, {
        childList: !0,
        subtree: !0,
        removedNodes: !0
      });
    }

    function a(e) {
      e && e.forEach(function (e) {
        var t = Array.prototype.slice.call(e.addedNodes),
            o = Array.prototype.slice.call(e.removedNodes),
            i = t.concat(o);
        if (n(i)) return u();
      });
    }

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var u = function u() {};

    t["default"] = {
      isSupported: i,
      ready: r
    };
  }, function (e, t) {
    "use strict";

    function n(e, t) {
      if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
    }

    function o() {
      return navigator.userAgent || navigator.vendor || window.opera || "";
    }

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var i = function () {
      function e(e, t) {
        for (var n = 0; n < t.length; n++) {
          var o = t[n];
          o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o);
        }
      }

      return function (t, n, o) {
        return n && e(t.prototype, n), o && e(t, o), t;
      };
    }(),
        r = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i,
        a = /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,
        u = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i,
        c = /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,
        s = function () {
      function e() {
        n(this, e);
      }

      return i(e, [{
        key: "phone",
        value: function value() {
          var e = o();
          return !(!r.test(e) && !a.test(e.substr(0, 4)));
        }
      }, {
        key: "mobile",
        value: function value() {
          var e = o();
          return !(!u.test(e) && !c.test(e.substr(0, 4)));
        }
      }, {
        key: "tablet",
        value: function value() {
          return this.mobile() && !this.phone();
        }
      }]), e;
    }();

    t["default"] = new s();
  }, function (e, t) {
    "use strict";

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var n = function n(e, t, _n) {
      var o = e.node.getAttribute("data-aos-once");
      t > e.position ? e.node.classList.add("aos-animate") : "undefined" != typeof o && ("false" === o || !_n && "true" !== o) && e.node.classList.remove("aos-animate");
    },
        o = function o(e, t) {
      var o = window.pageYOffset,
          i = window.innerHeight;
      e.forEach(function (e, r) {
        n(e, i + o, t);
      });
    };

    t["default"] = o;
  }, function (e, t, n) {
    "use strict";

    function o(e) {
      return e && e.__esModule ? e : {
        "default": e
      };
    }

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var i = n(12),
        r = o(i),
        a = function a(e, t) {
      return e.forEach(function (e, n) {
        e.node.classList.add("aos-init"), e.position = (0, r["default"])(e.node, t.offset);
      }), e;
    };

    t["default"] = a;
  }, function (e, t, n) {
    "use strict";

    function o(e) {
      return e && e.__esModule ? e : {
        "default": e
      };
    }

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var i = n(13),
        r = o(i),
        a = function a(e, t) {
      var n = 0,
          o = 0,
          i = window.innerHeight,
          a = {
        offset: e.getAttribute("data-aos-offset"),
        anchor: e.getAttribute("data-aos-anchor"),
        anchorPlacement: e.getAttribute("data-aos-anchor-placement")
      };

      switch (a.offset && !isNaN(a.offset) && (o = parseInt(a.offset)), a.anchor && document.querySelectorAll(a.anchor) && (e = document.querySelectorAll(a.anchor)[0]), n = (0, r["default"])(e).top, a.anchorPlacement) {
        case "top-bottom":
          break;

        case "center-bottom":
          n += e.offsetHeight / 2;
          break;

        case "bottom-bottom":
          n += e.offsetHeight;
          break;

        case "top-center":
          n += i / 2;
          break;

        case "bottom-center":
          n += i / 2 + e.offsetHeight;
          break;

        case "center-center":
          n += i / 2 + e.offsetHeight / 2;
          break;

        case "top-top":
          n += i;
          break;

        case "bottom-top":
          n += e.offsetHeight + i;
          break;

        case "center-top":
          n += e.offsetHeight / 2 + i;
      }

      return a.anchorPlacement || a.offset || isNaN(t) || (o = t), n + o;
    };

    t["default"] = a;
  }, function (e, t) {
    "use strict";

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var n = function n(e) {
      for (var t = 0, n = 0; e && !isNaN(e.offsetLeft) && !isNaN(e.offsetTop);) {
        t += e.offsetLeft - ("BODY" != e.tagName ? e.scrollLeft : 0), n += e.offsetTop - ("BODY" != e.tagName ? e.scrollTop : 0), e = e.offsetParent;
      }

      return {
        top: n,
        left: t
      };
    };

    t["default"] = n;
  }, function (e, t) {
    "use strict";

    Object.defineProperty(t, "__esModule", {
      value: !0
    });

    var n = function n(e) {
      return e = e || document.querySelectorAll("[data-aos]"), Array.prototype.map.call(e, function (e) {
        return {
          node: e
        };
      });
    };

    t["default"] = n;
  }]);
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../webpack/buildin/module.js */ "./node_modules/webpack/buildin/module.js")(module)))

/***/ }),

/***/ "./node_modules/webpack/buildin/module.js":
/*!***********************************!*\
  !*** (webpack)/buildin/module.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function (module) {
  if (!module.webpackPolyfill) {
    module.deprecate = function () {};

    module.paths = []; // module.parent = undefined by default

    if (!module.children) module.children = [];
    Object.defineProperty(module, "loaded", {
      enumerable: true,
      get: function get() {
        return module.l;
      }
    });
    Object.defineProperty(module, "id", {
      enumerable: true,
      get: function get() {
        return module.i;
      }
    });
    module.webpackPolyfill = 1;
  }

  return module;
};

/***/ }),

/***/ 0:
/*!********************************************************!*\
  !*** multi ./assets/src/scripts/front/unity3-front.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! S:\WORDPRESS\unity3dev\wp-content\plugins\unity3\assets\src\scripts\front\unity3-front.js */"./assets/src/scripts/front/unity3-front.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2Zyb250L19hb3MuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2Zyb250L3VuaXR5My1mcm9udC5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvYW9zL2Rpc3QvYW9zLmpzIiwid2VicGFjazovLy8od2VicGFjaykvYnVpbGRpbi9tb2R1bGUuanMiXSwibmFtZXMiOlsialF1ZXJ5IiwiZG9jdW1lbnQiLCJyZWFkeSIsInVuaXR5MyIsIkFPUyIsImluaXQiLCJhb3MiLCJlIiwidCIsImV4cG9ydHMiLCJtb2R1bGUiLCJkZWZpbmUiLCJvIiwibiIsImkiLCJpZCIsImxvYWRlZCIsImNhbGwiLCJtIiwiYyIsInAiLCJfX2VzTW9kdWxlIiwiT2JqZWN0IiwiYXNzaWduIiwiYXJndW1lbnRzIiwibGVuZ3RoIiwicHJvdG90eXBlIiwiaGFzT3duUHJvcGVydHkiLCJyIiwiYSIsInUiLCJzIiwiZiIsImQiLCJsIiwiYiIsInYiLCJ5IiwiZyIsImgiLCJ3IiwiayIsIngiLCJvZmZzZXQiLCJkZWxheSIsImVhc2luZyIsImR1cmF0aW9uIiwiZGlzYWJsZSIsIm9uY2UiLCJzdGFydEV2ZW50IiwidGhyb3R0bGVEZWxheSIsImRlYm91bmNlRGVsYXkiLCJkaXNhYmxlTXV0YXRpb25PYnNlcnZlciIsImoiLCJPIiwiTSIsImZvckVhY2giLCJub2RlIiwicmVtb3ZlQXR0cmlidXRlIiwiUyIsIm1vYmlsZSIsInBob25lIiwidGFibGV0IiwiXyIsImFsbCIsIndpbmRvdyIsImF0b2IiLCJpc1N1cHBvcnRlZCIsImNvbnNvbGUiLCJpbmZvIiwicXVlcnlTZWxlY3RvciIsInNldEF0dHJpYnV0ZSIsImluZGV4T2YiLCJyZWFkeVN0YXRlIiwiYWRkRXZlbnRMaXN0ZW5lciIsInJlZnJlc2giLCJyZWZyZXNoSGFyZCIsImFwcGx5Iiwic2V0VGltZW91dCIsImNsZWFyVGltZW91dCIsIlR5cGVFcnJvciIsImxlYWRpbmciLCJtYXhXYWl0IiwidHJhaWxpbmciLCJjYW5jZWwiLCJmbHVzaCIsInZhbHVlT2YiLCJyZXBsYWNlIiwidGVzdCIsInNsaWNlIiwiU3ltYm9sIiwiaXRlcmF0b3IiLCJjb25zdHJ1Y3RvciIsIk5hTiIsInBhcnNlSW50Iiwic2VsZiIsIkZ1bmN0aW9uIiwidG9TdHJpbmciLCJNYXRoIiwibWF4IiwibWluIiwiRGF0ZSIsIm5vdyIsImRhdGFzZXQiLCJjaGlsZHJlbiIsIk11dGF0aW9uT2JzZXJ2ZXIiLCJXZWJLaXRNdXRhdGlvbk9ic2VydmVyIiwiTW96TXV0YXRpb25PYnNlcnZlciIsIm9ic2VydmUiLCJkb2N1bWVudEVsZW1lbnQiLCJjaGlsZExpc3QiLCJzdWJ0cmVlIiwicmVtb3ZlZE5vZGVzIiwiQXJyYXkiLCJhZGRlZE5vZGVzIiwiY29uY2F0IiwiZGVmaW5lUHJvcGVydHkiLCJ2YWx1ZSIsIm5hdmlnYXRvciIsInVzZXJBZ2VudCIsInZlbmRvciIsIm9wZXJhIiwiZW51bWVyYWJsZSIsImNvbmZpZ3VyYWJsZSIsIndyaXRhYmxlIiwia2V5Iiwic3Vic3RyIiwiZ2V0QXR0cmlidXRlIiwicG9zaXRpb24iLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiLCJwYWdlWU9mZnNldCIsImlubmVySGVpZ2h0IiwiYW5jaG9yIiwiYW5jaG9yUGxhY2VtZW50IiwiaXNOYU4iLCJxdWVyeVNlbGVjdG9yQWxsIiwidG9wIiwib2Zmc2V0SGVpZ2h0Iiwib2Zmc2V0TGVmdCIsIm9mZnNldFRvcCIsInRhZ05hbWUiLCJzY3JvbGxMZWZ0Iiwic2Nyb2xsVG9wIiwib2Zmc2V0UGFyZW50IiwibGVmdCIsIm1hcCIsIndlYnBhY2tQb2x5ZmlsbCIsImRlcHJlY2F0ZSIsInBhdGhzIiwiZ2V0Il0sIm1hcHBpbmdzIjoiO1FBQUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFD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RixNQUFNLENBQUM4RixRQUFQLEdBQWtCLEVBQWxCO0FBQ3RCbEYsVUFBTSxDQUFDOEYsY0FBUCxDQUFzQjFHLE1BQXRCLEVBQThCLFFBQTlCLEVBQXdDO0FBQ3ZDZ0gsZ0JBQVUsRUFBRSxJQUQyQjtBQUV2QzZCLFNBQUcsRUFBRSxlQUFXO0FBQ2YsZUFBTzdJLE1BQU0sQ0FBQ3dCLENBQWQ7QUFDQTtBQUpzQyxLQUF4QztBQU1BWixVQUFNLENBQUM4RixjQUFQLENBQXNCMUcsTUFBdEIsRUFBOEIsSUFBOUIsRUFBb0M7QUFDbkNnSCxnQkFBVSxFQUFFLElBRHVCO0FBRW5DNkIsU0FBRyxFQUFFLGVBQVc7QUFDZixlQUFPN0ksTUFBTSxDQUFDSSxDQUFkO0FBQ0E7QUFKa0MsS0FBcEM7QUFNQUosVUFBTSxDQUFDMEksZUFBUCxHQUF5QixDQUF6QjtBQUNBOztBQUNELFNBQU8xSSxNQUFQO0FBQ0EsQ0FyQkQsQyIsImZpbGUiOiJ1bml0eTMtZnJvbnQuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIlwiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMCk7XG4iLCIvKiogVmVuZG9yOiBBT1MgKi9cclxuaW1wb3J0IEFPUyBmcm9tICdhb3MnO1xyXG5cclxualF1ZXJ5KCBkb2N1bWVudCApLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgaWYgKCB0eXBlb2YgdW5pdHkzICE9IFwidW5kZWZpbmVkXCIgKSB7XHJcbiAgICAgICAgQU9TLmluaXQoIHVuaXR5My5hb3MuaW5pdCApO1xyXG4gICAgfVxyXG59KTsiLCJpbXBvcnQgJy4vX2Fvcyc7XHJcblxyXG4iLCIhZnVuY3Rpb24oZSx0KXtcIm9iamVjdFwiPT10eXBlb2YgZXhwb3J0cyYmXCJvYmplY3RcIj09dHlwZW9mIG1vZHVsZT9tb2R1bGUuZXhwb3J0cz10KCk6XCJmdW5jdGlvblwiPT10eXBlb2YgZGVmaW5lJiZkZWZpbmUuYW1kP2RlZmluZShbXSx0KTpcIm9iamVjdFwiPT10eXBlb2YgZXhwb3J0cz9leHBvcnRzLkFPUz10KCk6ZS5BT1M9dCgpfSh0aGlzLGZ1bmN0aW9uKCl7cmV0dXJuIGZ1bmN0aW9uKGUpe2Z1bmN0aW9uIHQobyl7aWYobltvXSlyZXR1cm4gbltvXS5leHBvcnRzO3ZhciBpPW5bb109e2V4cG9ydHM6e30saWQ6byxsb2FkZWQ6ITF9O3JldHVybiBlW29dLmNhbGwoaS5leHBvcnRzLGksaS5leHBvcnRzLHQpLGkubG9hZGVkPSEwLGkuZXhwb3J0c312YXIgbj17fTtyZXR1cm4gdC5tPWUsdC5jPW4sdC5wPVwiZGlzdC9cIix0KDApfShbZnVuY3Rpb24oZSx0LG4pe1widXNlIHN0cmljdFwiO2Z1bmN0aW9uIG8oZSl7cmV0dXJuIGUmJmUuX19lc01vZHVsZT9lOntkZWZhdWx0OmV9fXZhciBpPU9iamVjdC5hc3NpZ258fGZ1bmN0aW9uKGUpe2Zvcih2YXIgdD0xO3Q8YXJndW1lbnRzLmxlbmd0aDt0Kyspe3ZhciBuPWFyZ3VtZW50c1t0XTtmb3IodmFyIG8gaW4gbilPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwobixvKSYmKGVbb109bltvXSl9cmV0dXJuIGV9LHI9bigxKSxhPShvKHIpLG4oNikpLHU9byhhKSxjPW4oNykscz1vKGMpLGY9big4KSxkPW8oZiksbD1uKDkpLHA9byhsKSxtPW4oMTApLGI9byhtKSx2PW4oMTEpLHk9byh2KSxnPW4oMTQpLGg9byhnKSx3PVtdLGs9ITEseD17b2Zmc2V0OjEyMCxkZWxheTowLGVhc2luZzpcImVhc2VcIixkdXJhdGlvbjo0MDAsZGlzYWJsZTohMSxvbmNlOiExLHN0YXJ0RXZlbnQ6XCJET01Db250ZW50TG9hZGVkXCIsdGhyb3R0bGVEZWxheTo5OSxkZWJvdW5jZURlbGF5OjUwLGRpc2FibGVNdXRhdGlvbk9ic2VydmVyOiExfSxqPWZ1bmN0aW9uKCl7dmFyIGU9YXJndW1lbnRzLmxlbmd0aD4wJiZ2b2lkIDAhPT1hcmd1bWVudHNbMF0mJmFyZ3VtZW50c1swXTtpZihlJiYoaz0hMCksaylyZXR1cm4gdz0oMCx5LmRlZmF1bHQpKHcseCksKDAsYi5kZWZhdWx0KSh3LHgub25jZSksd30sTz1mdW5jdGlvbigpe3c9KDAsaC5kZWZhdWx0KSgpLGooKX0sTT1mdW5jdGlvbigpe3cuZm9yRWFjaChmdW5jdGlvbihlLHQpe2Uubm9kZS5yZW1vdmVBdHRyaWJ1dGUoXCJkYXRhLWFvc1wiKSxlLm5vZGUucmVtb3ZlQXR0cmlidXRlKFwiZGF0YS1hb3MtZWFzaW5nXCIpLGUubm9kZS5yZW1vdmVBdHRyaWJ1dGUoXCJkYXRhLWFvcy1kdXJhdGlvblwiKSxlLm5vZGUucmVtb3ZlQXR0cmlidXRlKFwiZGF0YS1hb3MtZGVsYXlcIil9KX0sUz1mdW5jdGlvbihlKXtyZXR1cm4gZT09PSEwfHxcIm1vYmlsZVwiPT09ZSYmcC5kZWZhdWx0Lm1vYmlsZSgpfHxcInBob25lXCI9PT1lJiZwLmRlZmF1bHQucGhvbmUoKXx8XCJ0YWJsZXRcIj09PWUmJnAuZGVmYXVsdC50YWJsZXQoKXx8XCJmdW5jdGlvblwiPT10eXBlb2YgZSYmZSgpPT09ITB9LF89ZnVuY3Rpb24oZSl7eD1pKHgsZSksdz0oMCxoLmRlZmF1bHQpKCk7dmFyIHQ9ZG9jdW1lbnQuYWxsJiYhd2luZG93LmF0b2I7cmV0dXJuIFMoeC5kaXNhYmxlKXx8dD9NKCk6KHguZGlzYWJsZU11dGF0aW9uT2JzZXJ2ZXJ8fGQuZGVmYXVsdC5pc1N1cHBvcnRlZCgpfHwoY29uc29sZS5pbmZvKCdcXG4gICAgICBhb3M6IE11dGF0aW9uT2JzZXJ2ZXIgaXMgbm90IHN1cHBvcnRlZCBvbiB0aGlzIGJyb3dzZXIsXFxuICAgICAgY29kZSBtdXRhdGlvbnMgb2JzZXJ2aW5nIGhhcyBiZWVuIGRpc2FibGVkLlxcbiAgICAgIFlvdSBtYXkgaGF2ZSB0byBjYWxsIFwicmVmcmVzaEhhcmQoKVwiIGJ5IHlvdXJzZWxmLlxcbiAgICAnKSx4LmRpc2FibGVNdXRhdGlvbk9ic2VydmVyPSEwKSxkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiYm9keVwiKS5zZXRBdHRyaWJ1dGUoXCJkYXRhLWFvcy1lYXNpbmdcIix4LmVhc2luZyksZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcImJvZHlcIikuc2V0QXR0cmlidXRlKFwiZGF0YS1hb3MtZHVyYXRpb25cIix4LmR1cmF0aW9uKSxkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiYm9keVwiKS5zZXRBdHRyaWJ1dGUoXCJkYXRhLWFvcy1kZWxheVwiLHguZGVsYXkpLFwiRE9NQ29udGVudExvYWRlZFwiPT09eC5zdGFydEV2ZW50JiZbXCJjb21wbGV0ZVwiLFwiaW50ZXJhY3RpdmVcIl0uaW5kZXhPZihkb2N1bWVudC5yZWFkeVN0YXRlKT4tMT9qKCEwKTpcImxvYWRcIj09PXguc3RhcnRFdmVudD93aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcih4LnN0YXJ0RXZlbnQsZnVuY3Rpb24oKXtqKCEwKX0pOmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoeC5zdGFydEV2ZW50LGZ1bmN0aW9uKCl7aighMCl9KSx3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcInJlc2l6ZVwiLCgwLHMuZGVmYXVsdCkoaix4LmRlYm91bmNlRGVsYXksITApKSx3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcIm9yaWVudGF0aW9uY2hhbmdlXCIsKDAscy5kZWZhdWx0KShqLHguZGVib3VuY2VEZWxheSwhMCkpLHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKFwic2Nyb2xsXCIsKDAsdS5kZWZhdWx0KShmdW5jdGlvbigpeygwLGIuZGVmYXVsdCkodyx4Lm9uY2UpfSx4LnRocm90dGxlRGVsYXkpKSx4LmRpc2FibGVNdXRhdGlvbk9ic2VydmVyfHxkLmRlZmF1bHQucmVhZHkoXCJbZGF0YS1hb3NdXCIsTyksdyl9O2UuZXhwb3J0cz17aW5pdDpfLHJlZnJlc2g6aixyZWZyZXNoSGFyZDpPfX0sZnVuY3Rpb24oZSx0KXt9LCwsLCxmdW5jdGlvbihlLHQpeyhmdW5jdGlvbih0KXtcInVzZSBzdHJpY3RcIjtmdW5jdGlvbiBuKGUsdCxuKXtmdW5jdGlvbiBvKHQpe3ZhciBuPWIsbz12O3JldHVybiBiPXY9dm9pZCAwLGs9dCxnPWUuYXBwbHkobyxuKX1mdW5jdGlvbiByKGUpe3JldHVybiBrPWUsaD1zZXRUaW1lb3V0KGYsdCksTT9vKGUpOmd9ZnVuY3Rpb24gYShlKXt2YXIgbj1lLXcsbz1lLWssaT10LW47cmV0dXJuIFM/aihpLHktbyk6aX1mdW5jdGlvbiBjKGUpe3ZhciBuPWUtdyxvPWUtaztyZXR1cm4gdm9pZCAwPT09d3x8bj49dHx8bjwwfHxTJiZvPj15fWZ1bmN0aW9uIGYoKXt2YXIgZT1PKCk7cmV0dXJuIGMoZSk/ZChlKTp2b2lkKGg9c2V0VGltZW91dChmLGEoZSkpKX1mdW5jdGlvbiBkKGUpe3JldHVybiBoPXZvaWQgMCxfJiZiP28oZSk6KGI9dj12b2lkIDAsZyl9ZnVuY3Rpb24gbCgpe3ZvaWQgMCE9PWgmJmNsZWFyVGltZW91dChoKSxrPTAsYj13PXY9aD12b2lkIDB9ZnVuY3Rpb24gcCgpe3JldHVybiB2b2lkIDA9PT1oP2c6ZChPKCkpfWZ1bmN0aW9uIG0oKXt2YXIgZT1PKCksbj1jKGUpO2lmKGI9YXJndW1lbnRzLHY9dGhpcyx3PWUsbil7aWYodm9pZCAwPT09aClyZXR1cm4gcih3KTtpZihTKXJldHVybiBoPXNldFRpbWVvdXQoZix0KSxvKHcpfXJldHVybiB2b2lkIDA9PT1oJiYoaD1zZXRUaW1lb3V0KGYsdCkpLGd9dmFyIGIsdix5LGcsaCx3LGs9MCxNPSExLFM9ITEsXz0hMDtpZihcImZ1bmN0aW9uXCIhPXR5cGVvZiBlKXRocm93IG5ldyBUeXBlRXJyb3Iocyk7cmV0dXJuIHQ9dSh0KXx8MCxpKG4pJiYoTT0hIW4ubGVhZGluZyxTPVwibWF4V2FpdFwiaW4gbix5PVM/eCh1KG4ubWF4V2FpdCl8fDAsdCk6eSxfPVwidHJhaWxpbmdcImluIG4/ISFuLnRyYWlsaW5nOl8pLG0uY2FuY2VsPWwsbS5mbHVzaD1wLG19ZnVuY3Rpb24gbyhlLHQsbyl7dmFyIHI9ITAsYT0hMDtpZihcImZ1bmN0aW9uXCIhPXR5cGVvZiBlKXRocm93IG5ldyBUeXBlRXJyb3Iocyk7cmV0dXJuIGkobykmJihyPVwibGVhZGluZ1wiaW4gbz8hIW8ubGVhZGluZzpyLGE9XCJ0cmFpbGluZ1wiaW4gbz8hIW8udHJhaWxpbmc6YSksbihlLHQse2xlYWRpbmc6cixtYXhXYWl0OnQsdHJhaWxpbmc6YX0pfWZ1bmN0aW9uIGkoZSl7dmFyIHQ9XCJ1bmRlZmluZWRcIj09dHlwZW9mIGU/XCJ1bmRlZmluZWRcIjpjKGUpO3JldHVybiEhZSYmKFwib2JqZWN0XCI9PXR8fFwiZnVuY3Rpb25cIj09dCl9ZnVuY3Rpb24gcihlKXtyZXR1cm4hIWUmJlwib2JqZWN0XCI9PShcInVuZGVmaW5lZFwiPT10eXBlb2YgZT9cInVuZGVmaW5lZFwiOmMoZSkpfWZ1bmN0aW9uIGEoZSl7cmV0dXJuXCJzeW1ib2xcIj09KFwidW5kZWZpbmVkXCI9PXR5cGVvZiBlP1widW5kZWZpbmVkXCI6YyhlKSl8fHIoZSkmJmsuY2FsbChlKT09ZH1mdW5jdGlvbiB1KGUpe2lmKFwibnVtYmVyXCI9PXR5cGVvZiBlKXJldHVybiBlO2lmKGEoZSkpcmV0dXJuIGY7aWYoaShlKSl7dmFyIHQ9XCJmdW5jdGlvblwiPT10eXBlb2YgZS52YWx1ZU9mP2UudmFsdWVPZigpOmU7ZT1pKHQpP3QrXCJcIjp0fWlmKFwic3RyaW5nXCIhPXR5cGVvZiBlKXJldHVybiAwPT09ZT9lOitlO2U9ZS5yZXBsYWNlKGwsXCJcIik7dmFyIG49bS50ZXN0KGUpO3JldHVybiBufHxiLnRlc3QoZSk/dihlLnNsaWNlKDIpLG4/Mjo4KTpwLnRlc3QoZSk/ZjorZX12YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiBTeW1ib2wmJlwic3ltYm9sXCI9PXR5cGVvZiBTeW1ib2wuaXRlcmF0b3I/ZnVuY3Rpb24oZSl7cmV0dXJuIHR5cGVvZiBlfTpmdW5jdGlvbihlKXtyZXR1cm4gZSYmXCJmdW5jdGlvblwiPT10eXBlb2YgU3ltYm9sJiZlLmNvbnN0cnVjdG9yPT09U3ltYm9sJiZlIT09U3ltYm9sLnByb3RvdHlwZT9cInN5bWJvbFwiOnR5cGVvZiBlfSxzPVwiRXhwZWN0ZWQgYSBmdW5jdGlvblwiLGY9TmFOLGQ9XCJbb2JqZWN0IFN5bWJvbF1cIixsPS9eXFxzK3xcXHMrJC9nLHA9L15bLStdMHhbMC05YS1mXSskL2ksbT0vXjBiWzAxXSskL2ksYj0vXjBvWzAtN10rJC9pLHY9cGFyc2VJbnQseT1cIm9iamVjdFwiPT0oXCJ1bmRlZmluZWRcIj09dHlwZW9mIHQ/XCJ1bmRlZmluZWRcIjpjKHQpKSYmdCYmdC5PYmplY3Q9PT1PYmplY3QmJnQsZz1cIm9iamVjdFwiPT0oXCJ1bmRlZmluZWRcIj09dHlwZW9mIHNlbGY/XCJ1bmRlZmluZWRcIjpjKHNlbGYpKSYmc2VsZiYmc2VsZi5PYmplY3Q9PT1PYmplY3QmJnNlbGYsaD15fHxnfHxGdW5jdGlvbihcInJldHVybiB0aGlzXCIpKCksdz1PYmplY3QucHJvdG90eXBlLGs9dy50b1N0cmluZyx4PU1hdGgubWF4LGo9TWF0aC5taW4sTz1mdW5jdGlvbigpe3JldHVybiBoLkRhdGUubm93KCl9O2UuZXhwb3J0cz1vfSkuY2FsbCh0LGZ1bmN0aW9uKCl7cmV0dXJuIHRoaXN9KCkpfSxmdW5jdGlvbihlLHQpeyhmdW5jdGlvbih0KXtcInVzZSBzdHJpY3RcIjtmdW5jdGlvbiBuKGUsdCxuKXtmdW5jdGlvbiBpKHQpe3ZhciBuPWIsbz12O3JldHVybiBiPXY9dm9pZCAwLE89dCxnPWUuYXBwbHkobyxuKX1mdW5jdGlvbiByKGUpe3JldHVybiBPPWUsaD1zZXRUaW1lb3V0KGYsdCksTT9pKGUpOmd9ZnVuY3Rpb24gdShlKXt2YXIgbj1lLXcsbz1lLU8saT10LW47cmV0dXJuIFM/eChpLHktbyk6aX1mdW5jdGlvbiBzKGUpe3ZhciBuPWUtdyxvPWUtTztyZXR1cm4gdm9pZCAwPT09d3x8bj49dHx8bjwwfHxTJiZvPj15fWZ1bmN0aW9uIGYoKXt2YXIgZT1qKCk7cmV0dXJuIHMoZSk/ZChlKTp2b2lkKGg9c2V0VGltZW91dChmLHUoZSkpKX1mdW5jdGlvbiBkKGUpe3JldHVybiBoPXZvaWQgMCxfJiZiP2koZSk6KGI9dj12b2lkIDAsZyl9ZnVuY3Rpb24gbCgpe3ZvaWQgMCE9PWgmJmNsZWFyVGltZW91dChoKSxPPTAsYj13PXY9aD12b2lkIDB9ZnVuY3Rpb24gcCgpe3JldHVybiB2b2lkIDA9PT1oP2c6ZChqKCkpfWZ1bmN0aW9uIG0oKXt2YXIgZT1qKCksbj1zKGUpO2lmKGI9YXJndW1lbnRzLHY9dGhpcyx3PWUsbil7aWYodm9pZCAwPT09aClyZXR1cm4gcih3KTtpZihTKXJldHVybiBoPXNldFRpbWVvdXQoZix0KSxpKHcpfXJldHVybiB2b2lkIDA9PT1oJiYoaD1zZXRUaW1lb3V0KGYsdCkpLGd9dmFyIGIsdix5LGcsaCx3LE89MCxNPSExLFM9ITEsXz0hMDtpZihcImZ1bmN0aW9uXCIhPXR5cGVvZiBlKXRocm93IG5ldyBUeXBlRXJyb3IoYyk7cmV0dXJuIHQ9YSh0KXx8MCxvKG4pJiYoTT0hIW4ubGVhZGluZyxTPVwibWF4V2FpdFwiaW4gbix5PVM/ayhhKG4ubWF4V2FpdCl8fDAsdCk6eSxfPVwidHJhaWxpbmdcImluIG4/ISFuLnRyYWlsaW5nOl8pLG0uY2FuY2VsPWwsbS5mbHVzaD1wLG19ZnVuY3Rpb24gbyhlKXt2YXIgdD1cInVuZGVmaW5lZFwiPT10eXBlb2YgZT9cInVuZGVmaW5lZFwiOnUoZSk7cmV0dXJuISFlJiYoXCJvYmplY3RcIj09dHx8XCJmdW5jdGlvblwiPT10KX1mdW5jdGlvbiBpKGUpe3JldHVybiEhZSYmXCJvYmplY3RcIj09KFwidW5kZWZpbmVkXCI9PXR5cGVvZiBlP1widW5kZWZpbmVkXCI6dShlKSl9ZnVuY3Rpb24gcihlKXtyZXR1cm5cInN5bWJvbFwiPT0oXCJ1bmRlZmluZWRcIj09dHlwZW9mIGU/XCJ1bmRlZmluZWRcIjp1KGUpKXx8aShlKSYmdy5jYWxsKGUpPT1mfWZ1bmN0aW9uIGEoZSl7aWYoXCJudW1iZXJcIj09dHlwZW9mIGUpcmV0dXJuIGU7aWYocihlKSlyZXR1cm4gcztpZihvKGUpKXt2YXIgdD1cImZ1bmN0aW9uXCI9PXR5cGVvZiBlLnZhbHVlT2Y/ZS52YWx1ZU9mKCk6ZTtlPW8odCk/dCtcIlwiOnR9aWYoXCJzdHJpbmdcIiE9dHlwZW9mIGUpcmV0dXJuIDA9PT1lP2U6K2U7ZT1lLnJlcGxhY2UoZCxcIlwiKTt2YXIgbj1wLnRlc3QoZSk7cmV0dXJuIG58fG0udGVzdChlKT9iKGUuc2xpY2UoMiksbj8yOjgpOmwudGVzdChlKT9zOitlfXZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIFN5bWJvbCYmXCJzeW1ib2xcIj09dHlwZW9mIFN5bWJvbC5pdGVyYXRvcj9mdW5jdGlvbihlKXtyZXR1cm4gdHlwZW9mIGV9OmZ1bmN0aW9uKGUpe3JldHVybiBlJiZcImZ1bmN0aW9uXCI9PXR5cGVvZiBTeW1ib2wmJmUuY29uc3RydWN0b3I9PT1TeW1ib2wmJmUhPT1TeW1ib2wucHJvdG90eXBlP1wic3ltYm9sXCI6dHlwZW9mIGV9LGM9XCJFeHBlY3RlZCBhIGZ1bmN0aW9uXCIscz1OYU4sZj1cIltvYmplY3QgU3ltYm9sXVwiLGQ9L15cXHMrfFxccyskL2csbD0vXlstK10weFswLTlhLWZdKyQvaSxwPS9eMGJbMDFdKyQvaSxtPS9eMG9bMC03XSskL2ksYj1wYXJzZUludCx2PVwib2JqZWN0XCI9PShcInVuZGVmaW5lZFwiPT10eXBlb2YgdD9cInVuZGVmaW5lZFwiOnUodCkpJiZ0JiZ0Lk9iamVjdD09PU9iamVjdCYmdCx5PVwib2JqZWN0XCI9PShcInVuZGVmaW5lZFwiPT10eXBlb2Ygc2VsZj9cInVuZGVmaW5lZFwiOnUoc2VsZikpJiZzZWxmJiZzZWxmLk9iamVjdD09PU9iamVjdCYmc2VsZixnPXZ8fHl8fEZ1bmN0aW9uKFwicmV0dXJuIHRoaXNcIikoKSxoPU9iamVjdC5wcm90b3R5cGUsdz1oLnRvU3RyaW5nLGs9TWF0aC5tYXgseD1NYXRoLm1pbixqPWZ1bmN0aW9uKCl7cmV0dXJuIGcuRGF0ZS5ub3coKX07ZS5leHBvcnRzPW59KS5jYWxsKHQsZnVuY3Rpb24oKXtyZXR1cm4gdGhpc30oKSl9LGZ1bmN0aW9uKGUsdCl7XCJ1c2Ugc3RyaWN0XCI7ZnVuY3Rpb24gbihlKXt2YXIgdD12b2lkIDAsbz12b2lkIDAsaT12b2lkIDA7Zm9yKHQ9MDt0PGUubGVuZ3RoO3QrPTEpe2lmKG89ZVt0XSxvLmRhdGFzZXQmJm8uZGF0YXNldC5hb3MpcmV0dXJuITA7aWYoaT1vLmNoaWxkcmVuJiZuKG8uY2hpbGRyZW4pKXJldHVybiEwfXJldHVybiExfWZ1bmN0aW9uIG8oKXtyZXR1cm4gd2luZG93Lk11dGF0aW9uT2JzZXJ2ZXJ8fHdpbmRvdy5XZWJLaXRNdXRhdGlvbk9ic2VydmVyfHx3aW5kb3cuTW96TXV0YXRpb25PYnNlcnZlcn1mdW5jdGlvbiBpKCl7cmV0dXJuISFvKCl9ZnVuY3Rpb24gcihlLHQpe3ZhciBuPXdpbmRvdy5kb2N1bWVudCxpPW8oKSxyPW5ldyBpKGEpO3U9dCxyLm9ic2VydmUobi5kb2N1bWVudEVsZW1lbnQse2NoaWxkTGlzdDohMCxzdWJ0cmVlOiEwLHJlbW92ZWROb2RlczohMH0pfWZ1bmN0aW9uIGEoZSl7ZSYmZS5mb3JFYWNoKGZ1bmN0aW9uKGUpe3ZhciB0PUFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKGUuYWRkZWROb2Rlcyksbz1BcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChlLnJlbW92ZWROb2RlcyksaT10LmNvbmNhdChvKTtpZihuKGkpKXJldHVybiB1KCl9KX1PYmplY3QuZGVmaW5lUHJvcGVydHkodCxcIl9fZXNNb2R1bGVcIix7dmFsdWU6ITB9KTt2YXIgdT1mdW5jdGlvbigpe307dC5kZWZhdWx0PXtpc1N1cHBvcnRlZDppLHJlYWR5OnJ9fSxmdW5jdGlvbihlLHQpe1widXNlIHN0cmljdFwiO2Z1bmN0aW9uIG4oZSx0KXtpZighKGUgaW5zdGFuY2VvZiB0KSl0aHJvdyBuZXcgVHlwZUVycm9yKFwiQ2Fubm90IGNhbGwgYSBjbGFzcyBhcyBhIGZ1bmN0aW9uXCIpfWZ1bmN0aW9uIG8oKXtyZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudHx8bmF2aWdhdG9yLnZlbmRvcnx8d2luZG93Lm9wZXJhfHxcIlwifU9iamVjdC5kZWZpbmVQcm9wZXJ0eSh0LFwiX19lc01vZHVsZVwiLHt2YWx1ZTohMH0pO3ZhciBpPWZ1bmN0aW9uKCl7ZnVuY3Rpb24gZShlLHQpe2Zvcih2YXIgbj0wO248dC5sZW5ndGg7bisrKXt2YXIgbz10W25dO28uZW51bWVyYWJsZT1vLmVudW1lcmFibGV8fCExLG8uY29uZmlndXJhYmxlPSEwLFwidmFsdWVcImluIG8mJihvLndyaXRhYmxlPSEwKSxPYmplY3QuZGVmaW5lUHJvcGVydHkoZSxvLmtleSxvKX19cmV0dXJuIGZ1bmN0aW9uKHQsbixvKXtyZXR1cm4gbiYmZSh0LnByb3RvdHlwZSxuKSxvJiZlKHQsbyksdH19KCkscj0vKGFuZHJvaWR8YmJcXGQrfG1lZWdvKS4rbW9iaWxlfGF2YW50Z298YmFkYVxcL3xibGFja2JlcnJ5fGJsYXplcnxjb21wYWx8ZWxhaW5lfGZlbm5lY3xoaXB0b3B8aWVtb2JpbGV8aXAoaG9uZXxvZCl8aXJpc3xraW5kbGV8bGdlIHxtYWVtb3xtaWRwfG1tcHxtb2JpbGUuK2ZpcmVmb3h8bmV0ZnJvbnR8b3BlcmEgbShvYnxpbilpfHBhbG0oIG9zKT98cGhvbmV8cChpeGl8cmUpXFwvfHBsdWNrZXJ8cG9ja2V0fHBzcHxzZXJpZXMoNHw2KTB8c3ltYmlhbnx0cmVvfHVwXFwuKGJyb3dzZXJ8bGluayl8dm9kYWZvbmV8d2FwfHdpbmRvd3MgY2V8eGRhfHhpaW5vL2ksYT0vMTIwN3w2MzEwfDY1OTB8M2dzb3w0dGhwfDUwWzEtNl1pfDc3MHN8ODAyc3xhIHdhfGFiYWN8YWMoZXJ8b298c1xcLSl8YWkoa298cm4pfGFsKGF2fGNhfGNvKXxhbW9pfGFuKGV4fG55fHl3KXxhcHR1fGFyKGNofGdvKXxhcyh0ZXx1cyl8YXR0d3xhdShkaXxcXC1tfHIgfHMgKXxhdmFufGJlKGNrfGxsfG5xKXxiaShsYnxyZCl8YmwoYWN8YXopfGJyKGV8dil3fGJ1bWJ8YndcXC0obnx1KXxjNTVcXC98Y2FwaXxjY3dhfGNkbVxcLXxjZWxsfGNodG18Y2xkY3xjbWRcXC18Y28obXB8bmQpfGNyYXd8ZGEoaXR8bGx8bmcpfGRidGV8ZGNcXC1zfGRldml8ZGljYXxkbW9ifGRvKGN8cClvfGRzKDEyfFxcLWQpfGVsKDQ5fGFpKXxlbShsMnx1bCl8ZXIoaWN8azApfGVzbDh8ZXooWzQtN10wfG9zfHdhfHplKXxmZXRjfGZseShcXC18Xyl8ZzEgdXxnNTYwfGdlbmV8Z2ZcXC01fGdcXC1tb3xnbyhcXC53fG9kKXxncihhZHx1bil8aGFpZXxoY2l0fGhkXFwtKG18cHx0KXxoZWlcXC18aGkocHR8dGEpfGhwKCBpfGlwKXxoc1xcLWN8aHQoYyhcXC18IHxffGF8Z3xwfHN8dCl8dHApfGh1KGF3fHRjKXxpXFwtKDIwfGdvfG1hKXxpMjMwfGlhYyggfFxcLXxcXC8pfGlicm98aWRlYXxpZzAxfGlrb218aW0xa3xpbm5vfGlwYXF8aXJpc3xqYSh0fHYpYXxqYnJvfGplbXV8amlnc3xrZGRpfGtlaml8a2d0KCB8XFwvKXxrbG9ufGtwdCB8a3djXFwtfGt5byhjfGspfGxlKG5vfHhpKXxsZyggZ3xcXC8oa3xsfHUpfDUwfDU0fFxcLVthLXddKXxsaWJ3fGx5bnh8bTFcXC13fG0zZ2F8bTUwXFwvfG1hKHRlfHVpfHhvKXxtYygwMXwyMXxjYSl8bVxcLWNyfG1lKHJjfHJpKXxtaShvOHxvYXx0cyl8bW1lZnxtbygwMXwwMnxiaXxkZXxkb3x0KFxcLXwgfG98dil8enopfG10KDUwfHAxfHYgKXxtd2JwfG15d2F8bjEwWzAtMl18bjIwWzItM118bjMwKDB8Mil8bjUwKDB8Mnw1KXxuNygwKDB8MSl8MTApfG5lKChjfG0pXFwtfG9ufHRmfHdmfHdnfHd0KXxub2soNnxpKXxuenBofG8yaW18b3AodGl8d3YpfG9yYW58b3dnMXxwODAwfHBhbihhfGR8dCl8cGR4Z3xwZygxM3xcXC0oWzEtOF18YykpfHBoaWx8cGlyZXxwbChheXx1Yyl8cG5cXC0yfHBvKGNrfHJ0fHNlKXxwcm94fHBzaW98cHRcXC1nfHFhXFwtYXxxYygwN3wxMnwyMXwzMnw2MHxcXC1bMi03XXxpXFwtKXxxdGVrfHIzODB8cjYwMHxyYWtzfHJpbTl8cm8odmV8em8pfHM1NVxcL3xzYShnZXxtYXxtbXxtc3xueXx2YSl8c2MoMDF8aFxcLXxvb3xwXFwtKXxzZGtcXC98c2UoYyhcXC18MHwxKXw0N3xtY3xuZHxyaSl8c2doXFwtfHNoYXJ8c2llKFxcLXxtKXxza1xcLTB8c2woNDV8aWQpfHNtKGFsfGFyfGIzfGl0fHQ1KXxzbyhmdHxueSl8c3AoMDF8aFxcLXx2XFwtfHYgKXxzeSgwMXxtYil8dDIoMTh8NTApfHQ2KDAwfDEwfDE4KXx0YShndHxsayl8dGNsXFwtfHRkZ1xcLXx0ZWwoaXxtKXx0aW1cXC18dFxcLW1vfHRvKHBsfHNoKXx0cyg3MHxtXFwtfG0zfG01KXx0eFxcLTl8dXAoXFwuYnxnMXxzaSl8dXRzdHx2NDAwfHY3NTB8dmVyaXx2aShyZ3x0ZSl8dmsoNDB8NVswLTNdfFxcLXYpfHZtNDB8dm9kYXx2dWxjfHZ4KDUyfDUzfDYwfDYxfDcwfDgwfDgxfDgzfDg1fDk4KXx3M2MoXFwtfCApfHdlYmN8d2hpdHx3aShnIHxuY3xudyl8d21sYnx3b251fHg3MDB8eWFzXFwtfHlvdXJ8emV0b3x6dGVcXC0vaSx1PS8oYW5kcm9pZHxiYlxcZCt8bWVlZ28pLittb2JpbGV8YXZhbnRnb3xiYWRhXFwvfGJsYWNrYmVycnl8YmxhemVyfGNvbXBhbHxlbGFpbmV8ZmVubmVjfGhpcHRvcHxpZW1vYmlsZXxpcChob25lfG9kKXxpcmlzfGtpbmRsZXxsZ2UgfG1hZW1vfG1pZHB8bW1wfG1vYmlsZS4rZmlyZWZveHxuZXRmcm9udHxvcGVyYSBtKG9ifGluKWl8cGFsbSggb3MpP3xwaG9uZXxwKGl4aXxyZSlcXC98cGx1Y2tlcnxwb2NrZXR8cHNwfHNlcmllcyg0fDYpMHxzeW1iaWFufHRyZW98dXBcXC4oYnJvd3NlcnxsaW5rKXx2b2RhZm9uZXx3YXB8d2luZG93cyBjZXx4ZGF8eGlpbm98YW5kcm9pZHxpcGFkfHBsYXlib29rfHNpbGsvaSxjPS8xMjA3fDYzMTB8NjU5MHwzZ3NvfDR0aHB8NTBbMS02XWl8Nzcwc3w4MDJzfGEgd2F8YWJhY3xhYyhlcnxvb3xzXFwtKXxhaShrb3xybil8YWwoYXZ8Y2F8Y28pfGFtb2l8YW4oZXh8bnl8eXcpfGFwdHV8YXIoY2h8Z28pfGFzKHRlfHVzKXxhdHR3fGF1KGRpfFxcLW18ciB8cyApfGF2YW58YmUoY2t8bGx8bnEpfGJpKGxifHJkKXxibChhY3xheil8YnIoZXx2KXd8YnVtYnxid1xcLShufHUpfGM1NVxcL3xjYXBpfGNjd2F8Y2RtXFwtfGNlbGx8Y2h0bXxjbGRjfGNtZFxcLXxjbyhtcHxuZCl8Y3Jhd3xkYShpdHxsbHxuZyl8ZGJ0ZXxkY1xcLXN8ZGV2aXxkaWNhfGRtb2J8ZG8oY3xwKW98ZHMoMTJ8XFwtZCl8ZWwoNDl8YWkpfGVtKGwyfHVsKXxlcihpY3xrMCl8ZXNsOHxleihbNC03XTB8b3N8d2F8emUpfGZldGN8Zmx5KFxcLXxfKXxnMSB1fGc1NjB8Z2VuZXxnZlxcLTV8Z1xcLW1vfGdvKFxcLnd8b2QpfGdyKGFkfHVuKXxoYWllfGhjaXR8aGRcXC0obXxwfHQpfGhlaVxcLXxoaShwdHx0YSl8aHAoIGl8aXApfGhzXFwtY3xodChjKFxcLXwgfF98YXxnfHB8c3x0KXx0cCl8aHUoYXd8dGMpfGlcXC0oMjB8Z298bWEpfGkyMzB8aWFjKCB8XFwtfFxcLyl8aWJyb3xpZGVhfGlnMDF8aWtvbXxpbTFrfGlubm98aXBhcXxpcmlzfGphKHR8dilhfGpicm98amVtdXxqaWdzfGtkZGl8a2VqaXxrZ3QoIHxcXC8pfGtsb258a3B0IHxrd2NcXC18a3lvKGN8ayl8bGUobm98eGkpfGxnKCBnfFxcLyhrfGx8dSl8NTB8NTR8XFwtW2Etd10pfGxpYnd8bHlueHxtMVxcLXd8bTNnYXxtNTBcXC98bWEodGV8dWl8eG8pfG1jKDAxfDIxfGNhKXxtXFwtY3J8bWUocmN8cmkpfG1pKG84fG9hfHRzKXxtbWVmfG1vKDAxfDAyfGJpfGRlfGRvfHQoXFwtfCB8b3x2KXx6eil8bXQoNTB8cDF8diApfG13YnB8bXl3YXxuMTBbMC0yXXxuMjBbMi0zXXxuMzAoMHwyKXxuNTAoMHwyfDUpfG43KDAoMHwxKXwxMCl8bmUoKGN8bSlcXC18b258dGZ8d2Z8d2d8d3QpfG5vayg2fGkpfG56cGh8bzJpbXxvcCh0aXx3dil8b3Jhbnxvd2cxfHA4MDB8cGFuKGF8ZHx0KXxwZHhnfHBnKDEzfFxcLShbMS04XXxjKSl8cGhpbHxwaXJlfHBsKGF5fHVjKXxwblxcLTJ8cG8oY2t8cnR8c2UpfHByb3h8cHNpb3xwdFxcLWd8cWFcXC1hfHFjKDA3fDEyfDIxfDMyfDYwfFxcLVsyLTddfGlcXC0pfHF0ZWt8cjM4MHxyNjAwfHJha3N8cmltOXxybyh2ZXx6byl8czU1XFwvfHNhKGdlfG1hfG1tfG1zfG55fHZhKXxzYygwMXxoXFwtfG9vfHBcXC0pfHNka1xcL3xzZShjKFxcLXwwfDEpfDQ3fG1jfG5kfHJpKXxzZ2hcXC18c2hhcnxzaWUoXFwtfG0pfHNrXFwtMHxzbCg0NXxpZCl8c20oYWx8YXJ8YjN8aXR8dDUpfHNvKGZ0fG55KXxzcCgwMXxoXFwtfHZcXC18diApfHN5KDAxfG1iKXx0MigxOHw1MCl8dDYoMDB8MTB8MTgpfHRhKGd0fGxrKXx0Y2xcXC18dGRnXFwtfHRlbChpfG0pfHRpbVxcLXx0XFwtbW98dG8ocGx8c2gpfHRzKDcwfG1cXC18bTN8bTUpfHR4XFwtOXx1cChcXC5ifGcxfHNpKXx1dHN0fHY0MDB8djc1MHx2ZXJpfHZpKHJnfHRlKXx2ayg0MHw1WzAtM118XFwtdil8dm00MHx2b2RhfHZ1bGN8dngoNTJ8NTN8NjB8NjF8NzB8ODB8ODF8ODN8ODV8OTgpfHczYyhcXC18ICl8d2ViY3x3aGl0fHdpKGcgfG5jfG53KXx3bWxifHdvbnV8eDcwMHx5YXNcXC18eW91cnx6ZXRvfHp0ZVxcLS9pLHM9ZnVuY3Rpb24oKXtmdW5jdGlvbiBlKCl7bih0aGlzLGUpfXJldHVybiBpKGUsW3trZXk6XCJwaG9uZVwiLHZhbHVlOmZ1bmN0aW9uKCl7dmFyIGU9bygpO3JldHVybiEoIXIudGVzdChlKSYmIWEudGVzdChlLnN1YnN0cigwLDQpKSl9fSx7a2V5OlwibW9iaWxlXCIsdmFsdWU6ZnVuY3Rpb24oKXt2YXIgZT1vKCk7cmV0dXJuISghdS50ZXN0KGUpJiYhYy50ZXN0KGUuc3Vic3RyKDAsNCkpKX19LHtrZXk6XCJ0YWJsZXRcIix2YWx1ZTpmdW5jdGlvbigpe3JldHVybiB0aGlzLm1vYmlsZSgpJiYhdGhpcy5waG9uZSgpfX1dKSxlfSgpO3QuZGVmYXVsdD1uZXcgc30sZnVuY3Rpb24oZSx0KXtcInVzZSBzdHJpY3RcIjtPYmplY3QuZGVmaW5lUHJvcGVydHkodCxcIl9fZXNNb2R1bGVcIix7dmFsdWU6ITB9KTt2YXIgbj1mdW5jdGlvbihlLHQsbil7dmFyIG89ZS5ub2RlLmdldEF0dHJpYnV0ZShcImRhdGEtYW9zLW9uY2VcIik7dD5lLnBvc2l0aW9uP2Uubm9kZS5jbGFzc0xpc3QuYWRkKFwiYW9zLWFuaW1hdGVcIik6XCJ1bmRlZmluZWRcIiE9dHlwZW9mIG8mJihcImZhbHNlXCI9PT1vfHwhbiYmXCJ0cnVlXCIhPT1vKSYmZS5ub2RlLmNsYXNzTGlzdC5yZW1vdmUoXCJhb3MtYW5pbWF0ZVwiKX0sbz1mdW5jdGlvbihlLHQpe3ZhciBvPXdpbmRvdy5wYWdlWU9mZnNldCxpPXdpbmRvdy5pbm5lckhlaWdodDtlLmZvckVhY2goZnVuY3Rpb24oZSxyKXtuKGUsaStvLHQpfSl9O3QuZGVmYXVsdD1vfSxmdW5jdGlvbihlLHQsbil7XCJ1c2Ugc3RyaWN0XCI7ZnVuY3Rpb24gbyhlKXtyZXR1cm4gZSYmZS5fX2VzTW9kdWxlP2U6e2RlZmF1bHQ6ZX19T2JqZWN0LmRlZmluZVByb3BlcnR5KHQsXCJfX2VzTW9kdWxlXCIse3ZhbHVlOiEwfSk7dmFyIGk9bigxMikscj1vKGkpLGE9ZnVuY3Rpb24oZSx0KXtyZXR1cm4gZS5mb3JFYWNoKGZ1bmN0aW9uKGUsbil7ZS5ub2RlLmNsYXNzTGlzdC5hZGQoXCJhb3MtaW5pdFwiKSxlLnBvc2l0aW9uPSgwLHIuZGVmYXVsdCkoZS5ub2RlLHQub2Zmc2V0KX0pLGV9O3QuZGVmYXVsdD1hfSxmdW5jdGlvbihlLHQsbil7XCJ1c2Ugc3RyaWN0XCI7ZnVuY3Rpb24gbyhlKXtyZXR1cm4gZSYmZS5fX2VzTW9kdWxlP2U6e2RlZmF1bHQ6ZX19T2JqZWN0LmRlZmluZVByb3BlcnR5KHQsXCJfX2VzTW9kdWxlXCIse3ZhbHVlOiEwfSk7dmFyIGk9bigxMykscj1vKGkpLGE9ZnVuY3Rpb24oZSx0KXt2YXIgbj0wLG89MCxpPXdpbmRvdy5pbm5lckhlaWdodCxhPXtvZmZzZXQ6ZS5nZXRBdHRyaWJ1dGUoXCJkYXRhLWFvcy1vZmZzZXRcIiksYW5jaG9yOmUuZ2V0QXR0cmlidXRlKFwiZGF0YS1hb3MtYW5jaG9yXCIpLGFuY2hvclBsYWNlbWVudDplLmdldEF0dHJpYnV0ZShcImRhdGEtYW9zLWFuY2hvci1wbGFjZW1lbnRcIil9O3N3aXRjaChhLm9mZnNldCYmIWlzTmFOKGEub2Zmc2V0KSYmKG89cGFyc2VJbnQoYS5vZmZzZXQpKSxhLmFuY2hvciYmZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChhLmFuY2hvcikmJihlPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoYS5hbmNob3IpWzBdKSxuPSgwLHIuZGVmYXVsdCkoZSkudG9wLGEuYW5jaG9yUGxhY2VtZW50KXtjYXNlXCJ0b3AtYm90dG9tXCI6YnJlYWs7Y2FzZVwiY2VudGVyLWJvdHRvbVwiOm4rPWUub2Zmc2V0SGVpZ2h0LzI7YnJlYWs7Y2FzZVwiYm90dG9tLWJvdHRvbVwiOm4rPWUub2Zmc2V0SGVpZ2h0O2JyZWFrO2Nhc2VcInRvcC1jZW50ZXJcIjpuKz1pLzI7YnJlYWs7Y2FzZVwiYm90dG9tLWNlbnRlclwiOm4rPWkvMitlLm9mZnNldEhlaWdodDticmVhaztjYXNlXCJjZW50ZXItY2VudGVyXCI6bis9aS8yK2Uub2Zmc2V0SGVpZ2h0LzI7YnJlYWs7Y2FzZVwidG9wLXRvcFwiOm4rPWk7YnJlYWs7Y2FzZVwiYm90dG9tLXRvcFwiOm4rPWUub2Zmc2V0SGVpZ2h0K2k7YnJlYWs7Y2FzZVwiY2VudGVyLXRvcFwiOm4rPWUub2Zmc2V0SGVpZ2h0LzIraX1yZXR1cm4gYS5hbmNob3JQbGFjZW1lbnR8fGEub2Zmc2V0fHxpc05hTih0KXx8KG89dCksbitvfTt0LmRlZmF1bHQ9YX0sZnVuY3Rpb24oZSx0KXtcInVzZSBzdHJpY3RcIjtPYmplY3QuZGVmaW5lUHJvcGVydHkodCxcIl9fZXNNb2R1bGVcIix7dmFsdWU6ITB9KTt2YXIgbj1mdW5jdGlvbihlKXtmb3IodmFyIHQ9MCxuPTA7ZSYmIWlzTmFOKGUub2Zmc2V0TGVmdCkmJiFpc05hTihlLm9mZnNldFRvcCk7KXQrPWUub2Zmc2V0TGVmdC0oXCJCT0RZXCIhPWUudGFnTmFtZT9lLnNjcm9sbExlZnQ6MCksbis9ZS5vZmZzZXRUb3AtKFwiQk9EWVwiIT1lLnRhZ05hbWU/ZS5zY3JvbGxUb3A6MCksZT1lLm9mZnNldFBhcmVudDtyZXR1cm57dG9wOm4sbGVmdDp0fX07dC5kZWZhdWx0PW59LGZ1bmN0aW9uKGUsdCl7XCJ1c2Ugc3RyaWN0XCI7T2JqZWN0LmRlZmluZVByb3BlcnR5KHQsXCJfX2VzTW9kdWxlXCIse3ZhbHVlOiEwfSk7dmFyIG49ZnVuY3Rpb24oZSl7cmV0dXJuIGU9ZXx8ZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIltkYXRhLWFvc11cIiksQXJyYXkucHJvdG90eXBlLm1hcC5jYWxsKGUsZnVuY3Rpb24oZSl7cmV0dXJue25vZGU6ZX19KX07dC5kZWZhdWx0PW59XSl9KTsiLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuXHRpZiAoIW1vZHVsZS53ZWJwYWNrUG9seWZpbGwpIHtcblx0XHRtb2R1bGUuZGVwcmVjYXRlID0gZnVuY3Rpb24oKSB7fTtcblx0XHRtb2R1bGUucGF0aHMgPSBbXTtcblx0XHQvLyBtb2R1bGUucGFyZW50ID0gdW5kZWZpbmVkIGJ5IGRlZmF1bHRcblx0XHRpZiAoIW1vZHVsZS5jaGlsZHJlbikgbW9kdWxlLmNoaWxkcmVuID0gW107XG5cdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG1vZHVsZSwgXCJsb2FkZWRcIiwge1xuXHRcdFx0ZW51bWVyYWJsZTogdHJ1ZSxcblx0XHRcdGdldDogZnVuY3Rpb24oKSB7XG5cdFx0XHRcdHJldHVybiBtb2R1bGUubDtcblx0XHRcdH1cblx0XHR9KTtcblx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkobW9kdWxlLCBcImlkXCIsIHtcblx0XHRcdGVudW1lcmFibGU6IHRydWUsXG5cdFx0XHRnZXQ6IGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRyZXR1cm4gbW9kdWxlLmk7XG5cdFx0XHR9XG5cdFx0fSk7XG5cdFx0bW9kdWxlLndlYnBhY2tQb2x5ZmlsbCA9IDE7XG5cdH1cblx0cmV0dXJuIG1vZHVsZTtcbn07XG4iXSwic291cmNlUm9vdCI6IiJ9