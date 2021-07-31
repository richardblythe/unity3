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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/scripts/editor/aos-effect-control.js":
/*!*********************************************************!*\
  !*** ./assets/src/scripts/editor/aos-effect-control.js ***!
  \*********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_assign__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash.assign */ "./node_modules/lodash.assign/index.js");
/* harmony import */ var lodash_assign__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_assign__WEBPACK_IMPORTED_MODULE_0__);

var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
var Fragment = wp.element.Fragment;
var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    SelectControl = _wp$components.SelectControl;
var addFilter = wp.hooks.addFilter;
var __ = wp.i18n.__; // Enable effect control on the following blocks
// const enableSpacingControlOnBlocks = [
// 	'core/image',
// ];
// Available effect control options

var effectControlOptions = [{
  label: __('None'),
  value: ''
}, {
  label: __('Fade'),
  value: 'fade'
}, {
  label: __('Fade Up'),
  value: 'fade-up'
}, {
  label: __('Fade Down'),
  value: 'fade-down'
}, {
  label: __('Fade Right'),
  value: 'fade-right'
}, {
  label: __('Fade Up Down'),
  value: 'fade-up-right'
}, {
  label: __('Fade Up Left'),
  value: 'fade-up-left'
}, {
  label: __('Fade Down Right'),
  value: 'fade-down-right'
}, {
  label: __('Fade Down Left'),
  value: 'fade-down-left'
}, {
  label: __('Flip Up'),
  value: 'flip-up'
}, {
  label: __('Flip Down'),
  value: 'flip-down'
}, {
  label: __('Flip Left'),
  value: 'flip-left'
}, {
  label: __('Flip Right'),
  value: 'flip-right'
}, {
  label: __('Slide Up'),
  value: 'slide-up'
}, {
  label: __('Slide Down'),
  value: 'slide-down'
}, {
  label: __('Slide left'),
  value: 'slide-left'
}, {
  label: __('Slide Right'),
  value: 'slide-right'
}, {
  label: __('Zoom In'),
  value: 'zoom-in'
}, {
  label: __('Zoom In Up'),
  value: 'zoom-in-up'
}, {
  label: __('Zoom In Down'),
  value: 'zoom-in-down'
}, {
  label: __('Zoom In Left'),
  value: 'zoom-in-left'
}, {
  label: __('Zoom In Right'),
  value: 'zoom-in-right'
}, {
  label: __('Zoom Out'),
  value: 'zoom-out'
}, {
  label: __('Zoom Out Up'),
  value: 'zoom-out-up'
}, {
  label: __('Zoom Out Down'),
  value: 'zoom-out-down'
}, {
  label: __('Zoom Out Left'),
  value: 'zoom-out-left'
}, {
  label: __('Zoom Out Right'),
  value: 'zoom-out-right'
}
/*
 */
];
/**
 * Add effect control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */

var addSpacingControlAttribute = function addSpacingControlAttribute(settings, name) {
  // // Do nothing if it's another block than our defined ones.
  // if ( ! enableSpacingControlOnBlocks.includes( name ) ) {
  // 	return settings;
  // }
  // Use Lodash's assign to gracefully handle if attributes are undefined
  settings.attributes = lodash_assign__WEBPACK_IMPORTED_MODULE_0___default()(settings.attributes, {
    aosEffect: {
      type: 'string',
      "default": effectControlOptions[0].value
    }
  });
  return settings;
};

addFilter('blocks.registerBlockType', 'aos/attribute/effect', addSpacingControlAttribute);
/**
 * Create HOC to add effect control to inspector controls of block.
 */

var withSpacingControl = createHigherOrderComponent(function (BlockEdit) {
  return function (props) {
    // // Do nothing if it's another block than our defined ones.
    // if ( ! enableSpacingControlOnBlocks.includes( props.name ) ) {
    // 	return (
    // 		<BlockEdit { ...props } />
    // );
    // }
    var aosEffect = props.attributes.aosEffect;
    return React.createElement(Fragment, null, React.createElement(BlockEdit, props), React.createElement(InspectorControls, null, React.createElement(PanelBody, {
      title: __('AOS Effect'),
      initialOpen: true
    }, React.createElement(SelectControl, {
      label: __('Effect'),
      value: aosEffect,
      options: effectControlOptions,
      onChange: function onChange(selectedSpacingOption) {
        props.setAttributes({
          aosEffect: selectedSpacingOption
        });
      }
    }))));
  };
}, 'withSpacingControl');
addFilter('editor.BlockEdit', 'aos/with-effect-control', withSpacingControl);
/**
 * Add margin style attribute to save element of block.
 *
 * @param {object} saveElementProps Props of save element.
 * @param {Object} blockType Block type information.
 * @param {Object} attributes Attributes of block.
 *
 * @returns {object} Modified props of save element.
 */

var addSpacingExtraProps = function addSpacingExtraProps(saveElementProps, blockType, attributes) {
  // // Do nothing if it's another block than our defined ones.
  // if ( ! enableSpacingControlOnBlocks.includes( blockType.name ) ) {
  // 	return saveElementProps;
  // }
  // const margins = {
  // 	small: '5px',
  // 	medium: '15px',
  // 	large: '30px',
  // };
  // if ( attributes.effect in margins ) {
  // 	// Use Lodash's assign to gracefully handle if attributes are undefined
  // 	assign( saveElementProps, { style: { 'margin-bottom': margins[ attributes.effect ] } } );
  // }
  // Use Lodash's assign to gracefully handle if attributes are undefined
  // assign( saveElementProps, { style: { 'margin-bottom': margins[ attributes.effect ] } } );
  // return saveElementProps;
  if (attributes.aosEffect) {
    var extraAttrs = {};
    extraAttrs['data-aos'] = escape(attributes.aosEffect);
    lodash_assign__WEBPACK_IMPORTED_MODULE_0___default()(saveElementProps, extraAttrs);
  }

  return saveElementProps;
};

addFilter('blocks.getSaveContent.extraProps', 'aos/get-save-content/extra-props', addSpacingExtraProps);

/***/ }),

/***/ "./assets/src/scripts/editor/unity3-editor.js":
/*!****************************************************!*\
  !*** ./assets/src/scripts/editor/unity3-editor.js ***!
  \****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _aos_effect_control__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./aos-effect-control */ "./assets/src/scripts/editor/aos-effect-control.js");


/***/ }),

/***/ "./node_modules/lodash.assign/index.js":
/*!*********************************************!*\
  !*** ./node_modules/lodash.assign/index.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */

/** Used as references for various `Number` constants. */
var MAX_SAFE_INTEGER = 9007199254740991;
/** `Object#toString` result references. */

var argsTag = '[object Arguments]',
    funcTag = '[object Function]',
    genTag = '[object GeneratorFunction]';
/** Used to detect unsigned integer values. */

var reIsUint = /^(?:0|[1-9]\d*)$/;
/**
 * A faster alternative to `Function#apply`, this function invokes `func`
 * with the `this` binding of `thisArg` and the arguments of `args`.
 *
 * @private
 * @param {Function} func The function to invoke.
 * @param {*} thisArg The `this` binding of `func`.
 * @param {Array} args The arguments to invoke `func` with.
 * @returns {*} Returns the result of `func`.
 */

function apply(func, thisArg, args) {
  switch (args.length) {
    case 0:
      return func.call(thisArg);

    case 1:
      return func.call(thisArg, args[0]);

    case 2:
      return func.call(thisArg, args[0], args[1]);

    case 3:
      return func.call(thisArg, args[0], args[1], args[2]);
  }

  return func.apply(thisArg, args);
}
/**
 * The base implementation of `_.times` without support for iteratee shorthands
 * or max array length checks.
 *
 * @private
 * @param {number} n The number of times to invoke `iteratee`.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the array of results.
 */


function baseTimes(n, iteratee) {
  var index = -1,
      result = Array(n);

  while (++index < n) {
    result[index] = iteratee(index);
  }

  return result;
}
/**
 * Creates a unary function that invokes `func` with its argument transformed.
 *
 * @private
 * @param {Function} func The function to wrap.
 * @param {Function} transform The argument transform.
 * @returns {Function} Returns the new function.
 */


function overArg(func, transform) {
  return function (arg) {
    return func(transform(arg));
  };
}
/** Used for built-in method references. */


var objectProto = Object.prototype;
/** Used to check objects for own properties. */

var hasOwnProperty = objectProto.hasOwnProperty;
/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */

var objectToString = objectProto.toString;
/** Built-in value references. */

var propertyIsEnumerable = objectProto.propertyIsEnumerable;
/* Built-in method references for those with the same name as other `lodash` methods. */

var nativeKeys = overArg(Object.keys, Object),
    nativeMax = Math.max;
/** Detect if properties shadowing those on `Object.prototype` are non-enumerable. */

var nonEnumShadows = !propertyIsEnumerable.call({
  'valueOf': 1
}, 'valueOf');
/**
 * Creates an array of the enumerable property names of the array-like `value`.
 *
 * @private
 * @param {*} value The value to query.
 * @param {boolean} inherited Specify returning inherited property names.
 * @returns {Array} Returns the array of property names.
 */

function arrayLikeKeys(value, inherited) {
  // Safari 8.1 makes `arguments.callee` enumerable in strict mode.
  // Safari 9 makes `arguments.length` enumerable in strict mode.
  var result = isArray(value) || isArguments(value) ? baseTimes(value.length, String) : [];
  var length = result.length,
      skipIndexes = !!length;

  for (var key in value) {
    if ((inherited || hasOwnProperty.call(value, key)) && !(skipIndexes && (key == 'length' || isIndex(key, length)))) {
      result.push(key);
    }
  }

  return result;
}
/**
 * Assigns `value` to `key` of `object` if the existing value is not equivalent
 * using [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * for equality comparisons.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {string} key The key of the property to assign.
 * @param {*} value The value to assign.
 */


function assignValue(object, key, value) {
  var objValue = object[key];

  if (!(hasOwnProperty.call(object, key) && eq(objValue, value)) || value === undefined && !(key in object)) {
    object[key] = value;
  }
}
/**
 * The base implementation of `_.keys` which doesn't treat sparse arrays as dense.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 */


function baseKeys(object) {
  if (!isPrototype(object)) {
    return nativeKeys(object);
  }

  var result = [];

  for (var key in Object(object)) {
    if (hasOwnProperty.call(object, key) && key != 'constructor') {
      result.push(key);
    }
  }

  return result;
}
/**
 * The base implementation of `_.rest` which doesn't validate or coerce arguments.
 *
 * @private
 * @param {Function} func The function to apply a rest parameter to.
 * @param {number} [start=func.length-1] The start position of the rest parameter.
 * @returns {Function} Returns the new function.
 */


function baseRest(func, start) {
  start = nativeMax(start === undefined ? func.length - 1 : start, 0);
  return function () {
    var args = arguments,
        index = -1,
        length = nativeMax(args.length - start, 0),
        array = Array(length);

    while (++index < length) {
      array[index] = args[start + index];
    }

    index = -1;
    var otherArgs = Array(start + 1);

    while (++index < start) {
      otherArgs[index] = args[index];
    }

    otherArgs[start] = array;
    return apply(func, this, otherArgs);
  };
}
/**
 * Copies properties of `source` to `object`.
 *
 * @private
 * @param {Object} source The object to copy properties from.
 * @param {Array} props The property identifiers to copy.
 * @param {Object} [object={}] The object to copy properties to.
 * @param {Function} [customizer] The function to customize copied values.
 * @returns {Object} Returns `object`.
 */


function copyObject(source, props, object, customizer) {
  object || (object = {});
  var index = -1,
      length = props.length;

  while (++index < length) {
    var key = props[index];
    var newValue = customizer ? customizer(object[key], source[key], key, object, source) : undefined;
    assignValue(object, key, newValue === undefined ? source[key] : newValue);
  }

  return object;
}
/**
 * Creates a function like `_.assign`.
 *
 * @private
 * @param {Function} assigner The function to assign values.
 * @returns {Function} Returns the new assigner function.
 */


function createAssigner(assigner) {
  return baseRest(function (object, sources) {
    var index = -1,
        length = sources.length,
        customizer = length > 1 ? sources[length - 1] : undefined,
        guard = length > 2 ? sources[2] : undefined;
    customizer = assigner.length > 3 && typeof customizer == 'function' ? (length--, customizer) : undefined;

    if (guard && isIterateeCall(sources[0], sources[1], guard)) {
      customizer = length < 3 ? undefined : customizer;
      length = 1;
    }

    object = Object(object);

    while (++index < length) {
      var source = sources[index];

      if (source) {
        assigner(object, source, index, customizer);
      }
    }

    return object;
  });
}
/**
 * Checks if `value` is a valid array-like index.
 *
 * @private
 * @param {*} value The value to check.
 * @param {number} [length=MAX_SAFE_INTEGER] The upper bounds of a valid index.
 * @returns {boolean} Returns `true` if `value` is a valid index, else `false`.
 */


function isIndex(value, length) {
  length = length == null ? MAX_SAFE_INTEGER : length;
  return !!length && (typeof value == 'number' || reIsUint.test(value)) && value > -1 && value % 1 == 0 && value < length;
}
/**
 * Checks if the given arguments are from an iteratee call.
 *
 * @private
 * @param {*} value The potential iteratee value argument.
 * @param {*} index The potential iteratee index or key argument.
 * @param {*} object The potential iteratee object argument.
 * @returns {boolean} Returns `true` if the arguments are from an iteratee call,
 *  else `false`.
 */


function isIterateeCall(value, index, object) {
  if (!isObject(object)) {
    return false;
  }

  var type = _typeof(index);

  if (type == 'number' ? isArrayLike(object) && isIndex(index, object.length) : type == 'string' && index in object) {
    return eq(object[index], value);
  }

  return false;
}
/**
 * Checks if `value` is likely a prototype object.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a prototype, else `false`.
 */


function isPrototype(value) {
  var Ctor = value && value.constructor,
      proto = typeof Ctor == 'function' && Ctor.prototype || objectProto;
  return value === proto;
}
/**
 * Performs a
 * [`SameValueZero`](http://ecma-international.org/ecma-262/7.0/#sec-samevaluezero)
 * comparison between two values to determine if they are equivalent.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to compare.
 * @param {*} other The other value to compare.
 * @returns {boolean} Returns `true` if the values are equivalent, else `false`.
 * @example
 *
 * var object = { 'a': 1 };
 * var other = { 'a': 1 };
 *
 * _.eq(object, object);
 * // => true
 *
 * _.eq(object, other);
 * // => false
 *
 * _.eq('a', 'a');
 * // => true
 *
 * _.eq('a', Object('a'));
 * // => false
 *
 * _.eq(NaN, NaN);
 * // => true
 */


function eq(value, other) {
  return value === other || value !== value && other !== other;
}
/**
 * Checks if `value` is likely an `arguments` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an `arguments` object,
 *  else `false`.
 * @example
 *
 * _.isArguments(function() { return arguments; }());
 * // => true
 *
 * _.isArguments([1, 2, 3]);
 * // => false
 */


function isArguments(value) {
  // Safari 8.1 makes `arguments.callee` enumerable in strict mode.
  return isArrayLikeObject(value) && hasOwnProperty.call(value, 'callee') && (!propertyIsEnumerable.call(value, 'callee') || objectToString.call(value) == argsTag);
}
/**
 * Checks if `value` is classified as an `Array` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array, else `false`.
 * @example
 *
 * _.isArray([1, 2, 3]);
 * // => true
 *
 * _.isArray(document.body.children);
 * // => false
 *
 * _.isArray('abc');
 * // => false
 *
 * _.isArray(_.noop);
 * // => false
 */


var isArray = Array.isArray;
/**
 * Checks if `value` is array-like. A value is considered array-like if it's
 * not a function and has a `value.length` that's an integer greater than or
 * equal to `0` and less than or equal to `Number.MAX_SAFE_INTEGER`.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is array-like, else `false`.
 * @example
 *
 * _.isArrayLike([1, 2, 3]);
 * // => true
 *
 * _.isArrayLike(document.body.children);
 * // => true
 *
 * _.isArrayLike('abc');
 * // => true
 *
 * _.isArrayLike(_.noop);
 * // => false
 */

function isArrayLike(value) {
  return value != null && isLength(value.length) && !isFunction(value);
}
/**
 * This method is like `_.isArrayLike` except that it also checks if `value`
 * is an object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array-like object,
 *  else `false`.
 * @example
 *
 * _.isArrayLikeObject([1, 2, 3]);
 * // => true
 *
 * _.isArrayLikeObject(document.body.children);
 * // => true
 *
 * _.isArrayLikeObject('abc');
 * // => false
 *
 * _.isArrayLikeObject(_.noop);
 * // => false
 */


function isArrayLikeObject(value) {
  return isObjectLike(value) && isArrayLike(value);
}
/**
 * Checks if `value` is classified as a `Function` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a function, else `false`.
 * @example
 *
 * _.isFunction(_);
 * // => true
 *
 * _.isFunction(/abc/);
 * // => false
 */


function isFunction(value) {
  // The use of `Object#toString` avoids issues with the `typeof` operator
  // in Safari 8-9 which returns 'object' for typed array and other constructors.
  var tag = isObject(value) ? objectToString.call(value) : '';
  return tag == funcTag || tag == genTag;
}
/**
 * Checks if `value` is a valid array-like length.
 *
 * **Note:** This method is loosely based on
 * [`ToLength`](http://ecma-international.org/ecma-262/7.0/#sec-tolength).
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a valid length, else `false`.
 * @example
 *
 * _.isLength(3);
 * // => true
 *
 * _.isLength(Number.MIN_VALUE);
 * // => false
 *
 * _.isLength(Infinity);
 * // => false
 *
 * _.isLength('3');
 * // => false
 */


function isLength(value) {
  return typeof value == 'number' && value > -1 && value % 1 == 0 && value <= MAX_SAFE_INTEGER;
}
/**
 * Checks if `value` is the
 * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
 * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an object, else `false`.
 * @example
 *
 * _.isObject({});
 * // => true
 *
 * _.isObject([1, 2, 3]);
 * // => true
 *
 * _.isObject(_.noop);
 * // => true
 *
 * _.isObject(null);
 * // => false
 */


function isObject(value) {
  var type = _typeof(value);

  return !!value && (type == 'object' || type == 'function');
}
/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */


function isObjectLike(value) {
  return !!value && _typeof(value) == 'object';
}
/**
 * Assigns own enumerable string keyed properties of source objects to the
 * destination object. Source objects are applied from left to right.
 * Subsequent sources overwrite property assignments of previous sources.
 *
 * **Note:** This method mutates `object` and is loosely based on
 * [`Object.assign`](https://mdn.io/Object/assign).
 *
 * @static
 * @memberOf _
 * @since 0.10.0
 * @category Object
 * @param {Object} object The destination object.
 * @param {...Object} [sources] The source objects.
 * @returns {Object} Returns `object`.
 * @see _.assignIn
 * @example
 *
 * function Foo() {
 *   this.a = 1;
 * }
 *
 * function Bar() {
 *   this.c = 3;
 * }
 *
 * Foo.prototype.b = 2;
 * Bar.prototype.d = 4;
 *
 * _.assign({ 'a': 0 }, new Foo, new Bar);
 * // => { 'a': 1, 'c': 3 }
 */


var assign = createAssigner(function (object, source) {
  if (nonEnumShadows || isPrototype(source) || isArrayLike(source)) {
    copyObject(source, keys(source), object);
    return;
  }

  for (var key in source) {
    if (hasOwnProperty.call(source, key)) {
      assignValue(object, key, source[key]);
    }
  }
});
/**
 * Creates an array of the own enumerable property names of `object`.
 *
 * **Note:** Non-object values are coerced to objects. See the
 * [ES spec](http://ecma-international.org/ecma-262/7.0/#sec-object.keys)
 * for more details.
 *
 * @static
 * @since 0.1.0
 * @memberOf _
 * @category Object
 * @param {Object} object The object to query.
 * @returns {Array} Returns the array of property names.
 * @example
 *
 * function Foo() {
 *   this.a = 1;
 *   this.b = 2;
 * }
 *
 * Foo.prototype.c = 3;
 *
 * _.keys(new Foo);
 * // => ['a', 'b'] (iteration order is not guaranteed)
 *
 * _.keys('hi');
 * // => ['0', '1']
 */

function keys(object) {
  return isArrayLike(object) ? arrayLikeKeys(object) : baseKeys(object);
}

module.exports = assign;

/***/ }),

/***/ 2:
/*!**********************************************************!*\
  !*** multi ./assets/src/scripts/editor/unity3-editor.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! S:\WORDPRESS\unity3dev\wp-content\plugins\unity3\assets\src\scripts\editor\unity3-editor.js */"./assets/src/scripts/editor/unity3-editor.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2VkaXRvci9hb3MtZWZmZWN0LWNvbnRyb2wuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3NyYy9zY3JpcHRzL2VkaXRvci91bml0eTMtZWRpdG9yLmpzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy9sb2Rhc2guYXNzaWduL2luZGV4LmpzIl0sIm5hbWVzIjpbImNyZWF0ZUhpZ2hlck9yZGVyQ29tcG9uZW50Iiwid3AiLCJjb21wb3NlIiwiRnJhZ21lbnQiLCJlbGVtZW50IiwiSW5zcGVjdG9yQ29udHJvbHMiLCJlZGl0b3IiLCJjb21wb25lbnRzIiwiUGFuZWxCb2R5IiwiU2VsZWN0Q29udHJvbCIsImFkZEZpbHRlciIsImhvb2tzIiwiX18iLCJpMThuIiwiZWZmZWN0Q29udHJvbE9wdGlvbnMiLCJsYWJlbCIsInZhbHVlIiwiYWRkU3BhY2luZ0NvbnRyb2xBdHRyaWJ1dGUiLCJzZXR0aW5ncyIsIm5hbWUiLCJhdHRyaWJ1dGVzIiwiYXNzaWduIiwiYW9zRWZmZWN0IiwidHlwZSIsIndpdGhTcGFjaW5nQ29udHJvbCIsIkJsb2NrRWRpdCIsInByb3BzIiwic2VsZWN0ZWRTcGFjaW5nT3B0aW9uIiwic2V0QXR0cmlidXRlcyIsImFkZFNwYWNpbmdFeHRyYVByb3BzIiwic2F2ZUVsZW1lbnRQcm9wcyIsImJsb2NrVHlwZSIsImV4dHJhQXR0cnMiLCJlc2NhcGUiLCJNQVhfU0FGRV9JTlRFR0VSIiwiYXJnc1RhZyIsImZ1bmNUYWciLCJnZW5UYWciLCJyZUlzVWludCIsImFwcGx5IiwiZnVuYyIsInRoaXNBcmciLCJhcmdzIiwibGVuZ3RoIiwiY2FsbCIsImJhc2VUaW1lcyIsIm4iLCJpdGVyYXRlZSIsImluZGV4IiwicmVzdWx0IiwiQXJyYXkiLCJvdmVyQXJnIiwidHJhbnNmb3JtIiwiYXJnIiwib2JqZWN0UHJvdG8iLCJPYmplY3QiLCJwcm90b3R5cGUiLCJoYXNPd25Qcm9wZXJ0eSIsIm9iamVjdFRvU3RyaW5nIiwidG9TdHJpbmciLCJwcm9wZXJ0eUlzRW51bWVyYWJsZSIsIm5hdGl2ZUtleXMiLCJrZXlzIiwibmF0aXZlTWF4IiwiTWF0aCIsIm1heCIsIm5vbkVudW1TaGFkb3dzIiwiYXJyYXlMaWtlS2V5cyIsImluaGVyaXRlZCIsImlzQXJyYXkiLCJpc0FyZ3VtZW50cyIsIlN0cmluZyIsInNraXBJbmRleGVzIiwia2V5IiwiaXNJbmRleCIsInB1c2giLCJhc3NpZ25WYWx1ZSIsIm9iamVjdCIsIm9ialZhbHVlIiwiZXEiLCJ1bmRlZmluZWQiLCJiYXNlS2V5cyIsImlzUHJvdG90eXBlIiwiYmFzZVJlc3QiLCJzdGFydCIsImFyZ3VtZW50cyIsImFycmF5Iiwib3RoZXJBcmdzIiwiY29weU9iamVjdCIsInNvdXJjZSIsImN1c3RvbWl6ZXIiLCJuZXdWYWx1ZSIsImNyZWF0ZUFzc2lnbmVyIiwiYXNzaWduZXIiLCJzb3VyY2VzIiwiZ3VhcmQiLCJpc0l0ZXJhdGVlQ2FsbCIsInRlc3QiLCJpc09iamVjdCIsImlzQXJyYXlMaWtlIiwiQ3RvciIsImNvbnN0cnVjdG9yIiwicHJvdG8iLCJvdGhlciIsImlzQXJyYXlMaWtlT2JqZWN0IiwiaXNMZW5ndGgiLCJpc0Z1bmN0aW9uIiwiaXNPYmplY3RMaWtlIiwidGFnIiwibW9kdWxlIiwiZXhwb3J0cyJdLCJtYXBwaW5ncyI6IjtRQUFBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBOzs7UUFHQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMENBQTBDLGdDQUFnQztRQUMxRTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLHdEQUF3RCxrQkFBa0I7UUFDMUU7UUFDQSxpREFBaUQsY0FBYztRQUMvRDs7UUFFQTtRQUNBO1FBQ0E7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QUFJSyxNQUFNLEdBQUd1RSxjQUFjLENBQUMsVUFBU2YsTUFBVCxFQUFpQlksTUFBakIsRUFBeUI7QUFDbkQsTUFBSXZCLGNBQWMsSUFBSWdCLFdBQVcsQ0FBQ08sTUFBRCxDQUE3QixJQUF5Q1UsV0FBVyxDQUFDVixNQUFELENBQXhELEVBQWtFO0FBQ2hFRCxjQUFVLENBQUNDLE1BQUQsRUFBUzNCLElBQUksQ0FBQzJCLE1BQUQsQ0FBYixFQUF1QlosTUFBdkIsQ0FBVjtBQUNBO0FBQ0Q7O0FBQ0QsT0FBSyxJQUFJSixHQUFULElBQWdCZ0IsTUFBaEIsRUFBd0I7QUFDdEIsUUFBSWhDLGNBQWMsQ0FBQ2IsSUFBZixDQUFvQjZDLE1BQXBCLEVBQTRCaEIsR0FBNUIsQ0FBSixFQUFzQztBQUNwQ0csaUJBQVcsQ0FBQ0MsTUFBRCxFQUFTSixHQUFULEVBQWNnQixNQUFNLENBQUNoQixHQUFELENBQXBCLENBQVg7QUFDRDtBQUNGO0FBQ0YsQ0FWMEIsQ0FBM0I7QUFZQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUE0QkEsU0FBU1gsSUFBVCxDQUFjZSxNQUFkLEVBQXNCO0FBQ3BCLFNBQU9zQixXQUFXLENBQUN0QixNQUFELENBQVgsR0FBc0JWLGFBQWEsQ0FBQ1UsTUFBRCxDQUFuQyxHQUE4Q0ksUUFBUSxDQUFDSixNQUFELENBQTdEO0FBQ0Q7O0FBRURnQyxNQUFNLENBQUNDLE9BQVAsR0FBaUJ6RixNQUFqQixDIiwiZmlsZSI6InVuaXR5My1lZGl0b3IuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIlwiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMik7XG4iLCJpbXBvcnQgYXNzaWduIGZyb20gJ2xvZGFzaC5hc3NpZ24nO1xuXG5jb25zdCB7IGNyZWF0ZUhpZ2hlck9yZGVyQ29tcG9uZW50IH0gPSB3cC5jb21wb3NlO1xuY29uc3QgeyBGcmFnbWVudCB9ID0gd3AuZWxlbWVudDtcbmNvbnN0IHsgSW5zcGVjdG9yQ29udHJvbHMgfSA9IHdwLmVkaXRvcjtcbmNvbnN0IHsgUGFuZWxCb2R5LCBTZWxlY3RDb250cm9sIH0gPSB3cC5jb21wb25lbnRzO1xuY29uc3QgeyBhZGRGaWx0ZXIgfSA9IHdwLmhvb2tzO1xuY29uc3QgeyBfXyB9ID0gd3AuaTE4bjtcblxuLy8gRW5hYmxlIGVmZmVjdCBjb250cm9sIG9uIHRoZSBmb2xsb3dpbmcgYmxvY2tzXG4vLyBjb25zdCBlbmFibGVTcGFjaW5nQ29udHJvbE9uQmxvY2tzID0gW1xuLy8gXHQnY29yZS9pbWFnZScsXG4vLyBdO1xuXG4vLyBBdmFpbGFibGUgZWZmZWN0IGNvbnRyb2wgb3B0aW9uc1xuY29uc3QgZWZmZWN0Q29udHJvbE9wdGlvbnMgPSBbXG5cdHtcblx0XHRsYWJlbDogX18oICdOb25lJyApLFxuXHRcdHZhbHVlOiAnJyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ0ZhZGUnICksXG5cdFx0dmFsdWU6ICdmYWRlJyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ0ZhZGUgVXAnICksXG5cdFx0dmFsdWU6ICdmYWRlLXVwJyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ0ZhZGUgRG93bicgKSxcblx0XHR2YWx1ZTogJ2ZhZGUtZG93bicsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdGYWRlIFJpZ2h0JyApLFxuXHRcdHZhbHVlOiAnZmFkZS1yaWdodCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdGYWRlIFVwIERvd24nICksXG5cdFx0dmFsdWU6ICdmYWRlLXVwLXJpZ2h0Jyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ0ZhZGUgVXAgTGVmdCcgKSxcblx0XHR2YWx1ZTogJ2ZhZGUtdXAtbGVmdCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdGYWRlIERvd24gUmlnaHQnICksXG5cdFx0dmFsdWU6ICdmYWRlLWRvd24tcmlnaHQnLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnRmFkZSBEb3duIExlZnQnICksXG5cdFx0dmFsdWU6ICdmYWRlLWRvd24tbGVmdCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdGbGlwIFVwJyApLFxuXHRcdHZhbHVlOiAnZmxpcC11cCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdGbGlwIERvd24nICksXG5cdFx0dmFsdWU6ICdmbGlwLWRvd24nLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnRmxpcCBMZWZ0JyApLFxuXHRcdHZhbHVlOiAnZmxpcC1sZWZ0Jyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ0ZsaXAgUmlnaHQnICksXG5cdFx0dmFsdWU6ICdmbGlwLXJpZ2h0Jyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ1NsaWRlIFVwJyApLFxuXHRcdHZhbHVlOiAnc2xpZGUtdXAnLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnU2xpZGUgRG93bicgKSxcblx0XHR2YWx1ZTogJ3NsaWRlLWRvd24nLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnU2xpZGUgbGVmdCcgKSxcblx0XHR2YWx1ZTogJ3NsaWRlLWxlZnQnLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnU2xpZGUgUmlnaHQnICksXG5cdFx0dmFsdWU6ICdzbGlkZS1yaWdodCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIEluJyApLFxuXHRcdHZhbHVlOiAnem9vbS1pbicsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIEluIFVwJyApLFxuXHRcdHZhbHVlOiAnem9vbS1pbi11cCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIEluIERvd24nICksXG5cdFx0dmFsdWU6ICd6b29tLWluLWRvd24nLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnWm9vbSBJbiBMZWZ0JyApLFxuXHRcdHZhbHVlOiAnem9vbS1pbi1sZWZ0Jyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ1pvb20gSW4gUmlnaHQnICksXG5cdFx0dmFsdWU6ICd6b29tLWluLXJpZ2h0Jyxcblx0fSxcblx0e1xuXHRcdGxhYmVsOiBfXyggJ1pvb20gT3V0JyApLFxuXHRcdHZhbHVlOiAnem9vbS1vdXQnLFxuXHR9LFxuXHR7XG5cdFx0bGFiZWw6IF9fKCAnWm9vbSBPdXQgVXAnICksXG5cdFx0dmFsdWU6ICd6b29tLW91dC11cCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIE91dCBEb3duJyApLFxuXHRcdHZhbHVlOiAnem9vbS1vdXQtZG93bicsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIE91dCBMZWZ0JyApLFxuXHRcdHZhbHVlOiAnem9vbS1vdXQtbGVmdCcsXG5cdH0sXG5cdHtcblx0XHRsYWJlbDogX18oICdab29tIE91dCBSaWdodCcgKSxcblx0XHR2YWx1ZTogJ3pvb20tb3V0LXJpZ2h0Jyxcblx0fSxcblx0Lypcblx0ICovXG5dO1xuXG4vKipcbiAqIEFkZCBlZmZlY3QgY29udHJvbCBhdHRyaWJ1dGUgdG8gYmxvY2suXG4gKlxuICogQHBhcmFtIHtvYmplY3R9IHNldHRpbmdzIEN1cnJlbnQgYmxvY2sgc2V0dGluZ3MuXG4gKiBAcGFyYW0ge3N0cmluZ30gbmFtZSBOYW1lIG9mIGJsb2NrLlxuICpcbiAqIEByZXR1cm5zIHtvYmplY3R9IE1vZGlmaWVkIGJsb2NrIHNldHRpbmdzLlxuICovXG5jb25zdCBhZGRTcGFjaW5nQ29udHJvbEF0dHJpYnV0ZSA9ICggc2V0dGluZ3MsIG5hbWUgKSA9PiB7XG5cdC8vIC8vIERvIG5vdGhpbmcgaWYgaXQncyBhbm90aGVyIGJsb2NrIHRoYW4gb3VyIGRlZmluZWQgb25lcy5cblx0Ly8gaWYgKCAhIGVuYWJsZVNwYWNpbmdDb250cm9sT25CbG9ja3MuaW5jbHVkZXMoIG5hbWUgKSApIHtcblx0Ly8gXHRyZXR1cm4gc2V0dGluZ3M7XG5cdC8vIH1cblxuXHQvLyBVc2UgTG9kYXNoJ3MgYXNzaWduIHRvIGdyYWNlZnVsbHkgaGFuZGxlIGlmIGF0dHJpYnV0ZXMgYXJlIHVuZGVmaW5lZFxuXHRzZXR0aW5ncy5hdHRyaWJ1dGVzID0gYXNzaWduKCBzZXR0aW5ncy5hdHRyaWJ1dGVzLCB7XG5cdFx0YW9zRWZmZWN0OiB7XG5cdFx0XHR0eXBlOiAnc3RyaW5nJyxcblx0XHRcdGRlZmF1bHQ6IGVmZmVjdENvbnRyb2xPcHRpb25zWyAwIF0udmFsdWUsXG5cdFx0fSxcblx0fSApO1xuXG5cdHJldHVybiBzZXR0aW5ncztcbn07XG5cbmFkZEZpbHRlciggJ2Jsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZScsICdhb3MvYXR0cmlidXRlL2VmZmVjdCcsIGFkZFNwYWNpbmdDb250cm9sQXR0cmlidXRlICk7XG5cbi8qKlxuICogQ3JlYXRlIEhPQyB0byBhZGQgZWZmZWN0IGNvbnRyb2wgdG8gaW5zcGVjdG9yIGNvbnRyb2xzIG9mIGJsb2NrLlxuICovXG5jb25zdCB3aXRoU3BhY2luZ0NvbnRyb2wgPSBjcmVhdGVIaWdoZXJPcmRlckNvbXBvbmVudCggKCBCbG9ja0VkaXQgKSA9PiB7XG5cdHJldHVybiAoIHByb3BzICkgPT4ge1xuXHRcdC8vIC8vIERvIG5vdGhpbmcgaWYgaXQncyBhbm90aGVyIGJsb2NrIHRoYW4gb3VyIGRlZmluZWQgb25lcy5cblx0XHQvLyBpZiAoICEgZW5hYmxlU3BhY2luZ0NvbnRyb2xPbkJsb2Nrcy5pbmNsdWRlcyggcHJvcHMubmFtZSApICkge1xuXHRcdC8vIFx0cmV0dXJuIChcblx0XHQvLyBcdFx0PEJsb2NrRWRpdCB7IC4uLnByb3BzIH0gLz5cblx0XHQvLyApO1xuXHRcdC8vIH1cblxuXHRcdGNvbnN0IHsgYW9zRWZmZWN0IH0gPSBwcm9wcy5hdHRyaWJ1dGVzO1xuXG5cdFx0cmV0dXJuIChcblx0XHRcdDxGcmFnbWVudD5cblx0XHRcdDxCbG9ja0VkaXQgeyAuLi5wcm9wcyB9IC8+XG5cdFx0PEluc3BlY3RvckNvbnRyb2xzPlxuXHRcdDxQYW5lbEJvZHlcblx0XHR0aXRsZT17IF9fKCAnQU9TIEVmZmVjdCcgKSB9XG5cdFx0aW5pdGlhbE9wZW49eyB0cnVlIH1cblx0XHRcdD5cblx0XHRcdDxTZWxlY3RDb250cm9sXG5cdFx0bGFiZWw9eyBfXyggJ0VmZmVjdCcgKSB9XG5cdFx0dmFsdWU9eyBhb3NFZmZlY3QgfVxuXHRcdG9wdGlvbnM9eyBlZmZlY3RDb250cm9sT3B0aW9ucyB9XG5cdFx0b25DaGFuZ2U9eyAoIHNlbGVjdGVkU3BhY2luZ09wdGlvbiApID0+IHtcblx0XHRcdHByb3BzLnNldEF0dHJpYnV0ZXMoIHtcblx0XHRcdFx0YW9zRWZmZWN0OiBzZWxlY3RlZFNwYWNpbmdPcHRpb24sXG5cdFx0XHR9ICk7XG5cdFx0fSB9XG5cdFx0Lz5cblx0XHQ8L1BhbmVsQm9keT5cblx0XHQ8L0luc3BlY3RvckNvbnRyb2xzPlxuXHRcdDwvRnJhZ21lbnQ+XG5cdCk7XG5cdH07XG59LCAnd2l0aFNwYWNpbmdDb250cm9sJyApO1xuXG5hZGRGaWx0ZXIoICdlZGl0b3IuQmxvY2tFZGl0JywgJ2Fvcy93aXRoLWVmZmVjdC1jb250cm9sJywgd2l0aFNwYWNpbmdDb250cm9sICk7XG5cbi8qKlxuICogQWRkIG1hcmdpbiBzdHlsZSBhdHRyaWJ1dGUgdG8gc2F2ZSBlbGVtZW50IG9mIGJsb2NrLlxuICpcbiAqIEBwYXJhbSB7b2JqZWN0fSBzYXZlRWxlbWVudFByb3BzIFByb3BzIG9mIHNhdmUgZWxlbWVudC5cbiAqIEBwYXJhbSB7T2JqZWN0fSBibG9ja1R5cGUgQmxvY2sgdHlwZSBpbmZvcm1hdGlvbi5cbiAqIEBwYXJhbSB7T2JqZWN0fSBhdHRyaWJ1dGVzIEF0dHJpYnV0ZXMgb2YgYmxvY2suXG4gKlxuICogQHJldHVybnMge29iamVjdH0gTW9kaWZpZWQgcHJvcHMgb2Ygc2F2ZSBlbGVtZW50LlxuICovXG5jb25zdCBhZGRTcGFjaW5nRXh0cmFQcm9wcyA9ICggc2F2ZUVsZW1lbnRQcm9wcywgYmxvY2tUeXBlLCBhdHRyaWJ1dGVzICkgPT4ge1xuXHQvLyAvLyBEbyBub3RoaW5nIGlmIGl0J3MgYW5vdGhlciBibG9jayB0aGFuIG91ciBkZWZpbmVkIG9uZXMuXG5cdC8vIGlmICggISBlbmFibGVTcGFjaW5nQ29udHJvbE9uQmxvY2tzLmluY2x1ZGVzKCBibG9ja1R5cGUubmFtZSApICkge1xuXHQvLyBcdHJldHVybiBzYXZlRWxlbWVudFByb3BzO1xuXHQvLyB9XG5cblx0Ly8gY29uc3QgbWFyZ2lucyA9IHtcblx0Ly8gXHRzbWFsbDogJzVweCcsXG5cdC8vIFx0bWVkaXVtOiAnMTVweCcsXG5cdC8vIFx0bGFyZ2U6ICczMHB4Jyxcblx0Ly8gfTtcblxuXHQvLyBpZiAoIGF0dHJpYnV0ZXMuZWZmZWN0IGluIG1hcmdpbnMgKSB7XG5cdC8vIFx0Ly8gVXNlIExvZGFzaCdzIGFzc2lnbiB0byBncmFjZWZ1bGx5IGhhbmRsZSBpZiBhdHRyaWJ1dGVzIGFyZSB1bmRlZmluZWRcblx0Ly8gXHRhc3NpZ24oIHNhdmVFbGVtZW50UHJvcHMsIHsgc3R5bGU6IHsgJ21hcmdpbi1ib3R0b20nOiBtYXJnaW5zWyBhdHRyaWJ1dGVzLmVmZmVjdCBdIH0gfSApO1xuXHQvLyB9XG5cblx0Ly8gVXNlIExvZGFzaCdzIGFzc2lnbiB0byBncmFjZWZ1bGx5IGhhbmRsZSBpZiBhdHRyaWJ1dGVzIGFyZSB1bmRlZmluZWRcblx0Ly8gYXNzaWduKCBzYXZlRWxlbWVudFByb3BzLCB7IHN0eWxlOiB7ICdtYXJnaW4tYm90dG9tJzogbWFyZ2luc1sgYXR0cmlidXRlcy5lZmZlY3QgXSB9IH0gKTtcblxuXHQvLyByZXR1cm4gc2F2ZUVsZW1lbnRQcm9wcztcblxuXHRpZiAoIGF0dHJpYnV0ZXMuYW9zRWZmZWN0ICkge1xuXHRcdGNvbnN0IGV4dHJhQXR0cnMgPSB7fTtcblx0XHRleHRyYUF0dHJzWyAnZGF0YS1hb3MnIF0gPSBlc2NhcGUoIGF0dHJpYnV0ZXMuYW9zRWZmZWN0ICk7XG5cdFx0YXNzaWduKCBzYXZlRWxlbWVudFByb3BzLCBleHRyYUF0dHJzICk7XG5cdH1cblxuXHRyZXR1cm4gc2F2ZUVsZW1lbnRQcm9wcztcbn07XG5cbmFkZEZpbHRlciggJ2Jsb2Nrcy5nZXRTYXZlQ29udGVudC5leHRyYVByb3BzJywgJ2Fvcy9nZXQtc2F2ZS1jb250ZW50L2V4dHJhLXByb3BzJywgYWRkU3BhY2luZ0V4dHJhUHJvcHMgKTtcbiIsImltcG9ydCAnLi9hb3MtZWZmZWN0LWNvbnRyb2wnOyIsIi8qKlxuICogbG9kYXNoIChDdXN0b20gQnVpbGQpIDxodHRwczovL2xvZGFzaC5jb20vPlxuICogQnVpbGQ6IGBsb2Rhc2ggbW9kdWxhcml6ZSBleHBvcnRzPVwibnBtXCIgLW8gLi9gXG4gKiBDb3B5cmlnaHQgalF1ZXJ5IEZvdW5kYXRpb24gYW5kIG90aGVyIGNvbnRyaWJ1dG9ycyA8aHR0cHM6Ly9qcXVlcnkub3JnLz5cbiAqIFJlbGVhc2VkIHVuZGVyIE1JVCBsaWNlbnNlIDxodHRwczovL2xvZGFzaC5jb20vbGljZW5zZT5cbiAqIEJhc2VkIG9uIFVuZGVyc2NvcmUuanMgMS44LjMgPGh0dHA6Ly91bmRlcnNjb3JlanMub3JnL0xJQ0VOU0U+XG4gKiBDb3B5cmlnaHQgSmVyZW15IEFzaGtlbmFzLCBEb2N1bWVudENsb3VkIGFuZCBJbnZlc3RpZ2F0aXZlIFJlcG9ydGVycyAmIEVkaXRvcnNcbiAqL1xuXG4vKiogVXNlZCBhcyByZWZlcmVuY2VzIGZvciB2YXJpb3VzIGBOdW1iZXJgIGNvbnN0YW50cy4gKi9cbnZhciBNQVhfU0FGRV9JTlRFR0VSID0gOTAwNzE5OTI1NDc0MDk5MTtcblxuLyoqIGBPYmplY3QjdG9TdHJpbmdgIHJlc3VsdCByZWZlcmVuY2VzLiAqL1xudmFyIGFyZ3NUYWcgPSAnW29iamVjdCBBcmd1bWVudHNdJyxcbiAgICBmdW5jVGFnID0gJ1tvYmplY3QgRnVuY3Rpb25dJyxcbiAgICBnZW5UYWcgPSAnW29iamVjdCBHZW5lcmF0b3JGdW5jdGlvbl0nO1xuXG4vKiogVXNlZCB0byBkZXRlY3QgdW5zaWduZWQgaW50ZWdlciB2YWx1ZXMuICovXG52YXIgcmVJc1VpbnQgPSAvXig/OjB8WzEtOV1cXGQqKSQvO1xuXG4vKipcbiAqIEEgZmFzdGVyIGFsdGVybmF0aXZlIHRvIGBGdW5jdGlvbiNhcHBseWAsIHRoaXMgZnVuY3Rpb24gaW52b2tlcyBgZnVuY2BcbiAqIHdpdGggdGhlIGB0aGlzYCBiaW5kaW5nIG9mIGB0aGlzQXJnYCBhbmQgdGhlIGFyZ3VtZW50cyBvZiBgYXJnc2AuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7RnVuY3Rpb259IGZ1bmMgVGhlIGZ1bmN0aW9uIHRvIGludm9rZS5cbiAqIEBwYXJhbSB7Kn0gdGhpc0FyZyBUaGUgYHRoaXNgIGJpbmRpbmcgb2YgYGZ1bmNgLlxuICogQHBhcmFtIHtBcnJheX0gYXJncyBUaGUgYXJndW1lbnRzIHRvIGludm9rZSBgZnVuY2Agd2l0aC5cbiAqIEByZXR1cm5zIHsqfSBSZXR1cm5zIHRoZSByZXN1bHQgb2YgYGZ1bmNgLlxuICovXG5mdW5jdGlvbiBhcHBseShmdW5jLCB0aGlzQXJnLCBhcmdzKSB7XG4gIHN3aXRjaCAoYXJncy5sZW5ndGgpIHtcbiAgICBjYXNlIDA6IHJldHVybiBmdW5jLmNhbGwodGhpc0FyZyk7XG4gICAgY2FzZSAxOiByZXR1cm4gZnVuYy5jYWxsKHRoaXNBcmcsIGFyZ3NbMF0pO1xuICAgIGNhc2UgMjogcmV0dXJuIGZ1bmMuY2FsbCh0aGlzQXJnLCBhcmdzWzBdLCBhcmdzWzFdKTtcbiAgICBjYXNlIDM6IHJldHVybiBmdW5jLmNhbGwodGhpc0FyZywgYXJnc1swXSwgYXJnc1sxXSwgYXJnc1syXSk7XG4gIH1cbiAgcmV0dXJuIGZ1bmMuYXBwbHkodGhpc0FyZywgYXJncyk7XG59XG5cbi8qKlxuICogVGhlIGJhc2UgaW1wbGVtZW50YXRpb24gb2YgYF8udGltZXNgIHdpdGhvdXQgc3VwcG9ydCBmb3IgaXRlcmF0ZWUgc2hvcnRoYW5kc1xuICogb3IgbWF4IGFycmF5IGxlbmd0aCBjaGVja3MuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7bnVtYmVyfSBuIFRoZSBudW1iZXIgb2YgdGltZXMgdG8gaW52b2tlIGBpdGVyYXRlZWAuXG4gKiBAcGFyYW0ge0Z1bmN0aW9ufSBpdGVyYXRlZSBUaGUgZnVuY3Rpb24gaW52b2tlZCBwZXIgaXRlcmF0aW9uLlxuICogQHJldHVybnMge0FycmF5fSBSZXR1cm5zIHRoZSBhcnJheSBvZiByZXN1bHRzLlxuICovXG5mdW5jdGlvbiBiYXNlVGltZXMobiwgaXRlcmF0ZWUpIHtcbiAgdmFyIGluZGV4ID0gLTEsXG4gICAgICByZXN1bHQgPSBBcnJheShuKTtcblxuICB3aGlsZSAoKytpbmRleCA8IG4pIHtcbiAgICByZXN1bHRbaW5kZXhdID0gaXRlcmF0ZWUoaW5kZXgpO1xuICB9XG4gIHJldHVybiByZXN1bHQ7XG59XG5cbi8qKlxuICogQ3JlYXRlcyBhIHVuYXJ5IGZ1bmN0aW9uIHRoYXQgaW52b2tlcyBgZnVuY2Agd2l0aCBpdHMgYXJndW1lbnQgdHJhbnNmb3JtZWQuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7RnVuY3Rpb259IGZ1bmMgVGhlIGZ1bmN0aW9uIHRvIHdyYXAuXG4gKiBAcGFyYW0ge0Z1bmN0aW9ufSB0cmFuc2Zvcm0gVGhlIGFyZ3VtZW50IHRyYW5zZm9ybS5cbiAqIEByZXR1cm5zIHtGdW5jdGlvbn0gUmV0dXJucyB0aGUgbmV3IGZ1bmN0aW9uLlxuICovXG5mdW5jdGlvbiBvdmVyQXJnKGZ1bmMsIHRyYW5zZm9ybSkge1xuICByZXR1cm4gZnVuY3Rpb24oYXJnKSB7XG4gICAgcmV0dXJuIGZ1bmModHJhbnNmb3JtKGFyZykpO1xuICB9O1xufVxuXG4vKiogVXNlZCBmb3IgYnVpbHQtaW4gbWV0aG9kIHJlZmVyZW5jZXMuICovXG52YXIgb2JqZWN0UHJvdG8gPSBPYmplY3QucHJvdG90eXBlO1xuXG4vKiogVXNlZCB0byBjaGVjayBvYmplY3RzIGZvciBvd24gcHJvcGVydGllcy4gKi9cbnZhciBoYXNPd25Qcm9wZXJ0eSA9IG9iamVjdFByb3RvLmhhc093blByb3BlcnR5O1xuXG4vKipcbiAqIFVzZWQgdG8gcmVzb2x2ZSB0aGVcbiAqIFtgdG9TdHJpbmdUYWdgXShodHRwOi8vZWNtYS1pbnRlcm5hdGlvbmFsLm9yZy9lY21hLTI2Mi83LjAvI3NlYy1vYmplY3QucHJvdG90eXBlLnRvc3RyaW5nKVxuICogb2YgdmFsdWVzLlxuICovXG52YXIgb2JqZWN0VG9TdHJpbmcgPSBvYmplY3RQcm90by50b1N0cmluZztcblxuLyoqIEJ1aWx0LWluIHZhbHVlIHJlZmVyZW5jZXMuICovXG52YXIgcHJvcGVydHlJc0VudW1lcmFibGUgPSBvYmplY3RQcm90by5wcm9wZXJ0eUlzRW51bWVyYWJsZTtcblxuLyogQnVpbHQtaW4gbWV0aG9kIHJlZmVyZW5jZXMgZm9yIHRob3NlIHdpdGggdGhlIHNhbWUgbmFtZSBhcyBvdGhlciBgbG9kYXNoYCBtZXRob2RzLiAqL1xudmFyIG5hdGl2ZUtleXMgPSBvdmVyQXJnKE9iamVjdC5rZXlzLCBPYmplY3QpLFxuICAgIG5hdGl2ZU1heCA9IE1hdGgubWF4O1xuXG4vKiogRGV0ZWN0IGlmIHByb3BlcnRpZXMgc2hhZG93aW5nIHRob3NlIG9uIGBPYmplY3QucHJvdG90eXBlYCBhcmUgbm9uLWVudW1lcmFibGUuICovXG52YXIgbm9uRW51bVNoYWRvd3MgPSAhcHJvcGVydHlJc0VudW1lcmFibGUuY2FsbCh7ICd2YWx1ZU9mJzogMSB9LCAndmFsdWVPZicpO1xuXG4vKipcbiAqIENyZWF0ZXMgYW4gYXJyYXkgb2YgdGhlIGVudW1lcmFibGUgcHJvcGVydHkgbmFtZXMgb2YgdGhlIGFycmF5LWxpa2UgYHZhbHVlYC5cbiAqXG4gKiBAcHJpdmF0ZVxuICogQHBhcmFtIHsqfSB2YWx1ZSBUaGUgdmFsdWUgdG8gcXVlcnkuXG4gKiBAcGFyYW0ge2Jvb2xlYW59IGluaGVyaXRlZCBTcGVjaWZ5IHJldHVybmluZyBpbmhlcml0ZWQgcHJvcGVydHkgbmFtZXMuXG4gKiBAcmV0dXJucyB7QXJyYXl9IFJldHVybnMgdGhlIGFycmF5IG9mIHByb3BlcnR5IG5hbWVzLlxuICovXG5mdW5jdGlvbiBhcnJheUxpa2VLZXlzKHZhbHVlLCBpbmhlcml0ZWQpIHtcbiAgLy8gU2FmYXJpIDguMSBtYWtlcyBgYXJndW1lbnRzLmNhbGxlZWAgZW51bWVyYWJsZSBpbiBzdHJpY3QgbW9kZS5cbiAgLy8gU2FmYXJpIDkgbWFrZXMgYGFyZ3VtZW50cy5sZW5ndGhgIGVudW1lcmFibGUgaW4gc3RyaWN0IG1vZGUuXG4gIHZhciByZXN1bHQgPSAoaXNBcnJheSh2YWx1ZSkgfHwgaXNBcmd1bWVudHModmFsdWUpKVxuICAgID8gYmFzZVRpbWVzKHZhbHVlLmxlbmd0aCwgU3RyaW5nKVxuICAgIDogW107XG5cbiAgdmFyIGxlbmd0aCA9IHJlc3VsdC5sZW5ndGgsXG4gICAgICBza2lwSW5kZXhlcyA9ICEhbGVuZ3RoO1xuXG4gIGZvciAodmFyIGtleSBpbiB2YWx1ZSkge1xuICAgIGlmICgoaW5oZXJpdGVkIHx8IGhhc093blByb3BlcnR5LmNhbGwodmFsdWUsIGtleSkpICYmXG4gICAgICAgICEoc2tpcEluZGV4ZXMgJiYgKGtleSA9PSAnbGVuZ3RoJyB8fCBpc0luZGV4KGtleSwgbGVuZ3RoKSkpKSB7XG4gICAgICByZXN1bHQucHVzaChrZXkpO1xuICAgIH1cbiAgfVxuICByZXR1cm4gcmVzdWx0O1xufVxuXG4vKipcbiAqIEFzc2lnbnMgYHZhbHVlYCB0byBga2V5YCBvZiBgb2JqZWN0YCBpZiB0aGUgZXhpc3RpbmcgdmFsdWUgaXMgbm90IGVxdWl2YWxlbnRcbiAqIHVzaW5nIFtgU2FtZVZhbHVlWmVyb2BdKGh0dHA6Ly9lY21hLWludGVybmF0aW9uYWwub3JnL2VjbWEtMjYyLzcuMC8jc2VjLXNhbWV2YWx1ZXplcm8pXG4gKiBmb3IgZXF1YWxpdHkgY29tcGFyaXNvbnMuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7T2JqZWN0fSBvYmplY3QgVGhlIG9iamVjdCB0byBtb2RpZnkuXG4gKiBAcGFyYW0ge3N0cmluZ30ga2V5IFRoZSBrZXkgb2YgdGhlIHByb3BlcnR5IHRvIGFzc2lnbi5cbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGFzc2lnbi5cbiAqL1xuZnVuY3Rpb24gYXNzaWduVmFsdWUob2JqZWN0LCBrZXksIHZhbHVlKSB7XG4gIHZhciBvYmpWYWx1ZSA9IG9iamVjdFtrZXldO1xuICBpZiAoIShoYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwga2V5KSAmJiBlcShvYmpWYWx1ZSwgdmFsdWUpKSB8fFxuICAgICAgKHZhbHVlID09PSB1bmRlZmluZWQgJiYgIShrZXkgaW4gb2JqZWN0KSkpIHtcbiAgICBvYmplY3Rba2V5XSA9IHZhbHVlO1xuICB9XG59XG5cbi8qKlxuICogVGhlIGJhc2UgaW1wbGVtZW50YXRpb24gb2YgYF8ua2V5c2Agd2hpY2ggZG9lc24ndCB0cmVhdCBzcGFyc2UgYXJyYXlzIGFzIGRlbnNlLlxuICpcbiAqIEBwcml2YXRlXG4gKiBAcGFyYW0ge09iamVjdH0gb2JqZWN0IFRoZSBvYmplY3QgdG8gcXVlcnkuXG4gKiBAcmV0dXJucyB7QXJyYXl9IFJldHVybnMgdGhlIGFycmF5IG9mIHByb3BlcnR5IG5hbWVzLlxuICovXG5mdW5jdGlvbiBiYXNlS2V5cyhvYmplY3QpIHtcbiAgaWYgKCFpc1Byb3RvdHlwZShvYmplY3QpKSB7XG4gICAgcmV0dXJuIG5hdGl2ZUtleXMob2JqZWN0KTtcbiAgfVxuICB2YXIgcmVzdWx0ID0gW107XG4gIGZvciAodmFyIGtleSBpbiBPYmplY3Qob2JqZWN0KSkge1xuICAgIGlmIChoYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwga2V5KSAmJiBrZXkgIT0gJ2NvbnN0cnVjdG9yJykge1xuICAgICAgcmVzdWx0LnB1c2goa2V5KTtcbiAgICB9XG4gIH1cbiAgcmV0dXJuIHJlc3VsdDtcbn1cblxuLyoqXG4gKiBUaGUgYmFzZSBpbXBsZW1lbnRhdGlvbiBvZiBgXy5yZXN0YCB3aGljaCBkb2Vzbid0IHZhbGlkYXRlIG9yIGNvZXJjZSBhcmd1bWVudHMuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7RnVuY3Rpb259IGZ1bmMgVGhlIGZ1bmN0aW9uIHRvIGFwcGx5IGEgcmVzdCBwYXJhbWV0ZXIgdG8uXG4gKiBAcGFyYW0ge251bWJlcn0gW3N0YXJ0PWZ1bmMubGVuZ3RoLTFdIFRoZSBzdGFydCBwb3NpdGlvbiBvZiB0aGUgcmVzdCBwYXJhbWV0ZXIuXG4gKiBAcmV0dXJucyB7RnVuY3Rpb259IFJldHVybnMgdGhlIG5ldyBmdW5jdGlvbi5cbiAqL1xuZnVuY3Rpb24gYmFzZVJlc3QoZnVuYywgc3RhcnQpIHtcbiAgc3RhcnQgPSBuYXRpdmVNYXgoc3RhcnQgPT09IHVuZGVmaW5lZCA/IChmdW5jLmxlbmd0aCAtIDEpIDogc3RhcnQsIDApO1xuICByZXR1cm4gZnVuY3Rpb24oKSB7XG4gICAgdmFyIGFyZ3MgPSBhcmd1bWVudHMsXG4gICAgICAgIGluZGV4ID0gLTEsXG4gICAgICAgIGxlbmd0aCA9IG5hdGl2ZU1heChhcmdzLmxlbmd0aCAtIHN0YXJ0LCAwKSxcbiAgICAgICAgYXJyYXkgPSBBcnJheShsZW5ndGgpO1xuXG4gICAgd2hpbGUgKCsraW5kZXggPCBsZW5ndGgpIHtcbiAgICAgIGFycmF5W2luZGV4XSA9IGFyZ3Nbc3RhcnQgKyBpbmRleF07XG4gICAgfVxuICAgIGluZGV4ID0gLTE7XG4gICAgdmFyIG90aGVyQXJncyA9IEFycmF5KHN0YXJ0ICsgMSk7XG4gICAgd2hpbGUgKCsraW5kZXggPCBzdGFydCkge1xuICAgICAgb3RoZXJBcmdzW2luZGV4XSA9IGFyZ3NbaW5kZXhdO1xuICAgIH1cbiAgICBvdGhlckFyZ3Nbc3RhcnRdID0gYXJyYXk7XG4gICAgcmV0dXJuIGFwcGx5KGZ1bmMsIHRoaXMsIG90aGVyQXJncyk7XG4gIH07XG59XG5cbi8qKlxuICogQ29waWVzIHByb3BlcnRpZXMgb2YgYHNvdXJjZWAgdG8gYG9iamVjdGAuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7T2JqZWN0fSBzb3VyY2UgVGhlIG9iamVjdCB0byBjb3B5IHByb3BlcnRpZXMgZnJvbS5cbiAqIEBwYXJhbSB7QXJyYXl9IHByb3BzIFRoZSBwcm9wZXJ0eSBpZGVudGlmaWVycyB0byBjb3B5LlxuICogQHBhcmFtIHtPYmplY3R9IFtvYmplY3Q9e31dIFRoZSBvYmplY3QgdG8gY29weSBwcm9wZXJ0aWVzIHRvLlxuICogQHBhcmFtIHtGdW5jdGlvbn0gW2N1c3RvbWl6ZXJdIFRoZSBmdW5jdGlvbiB0byBjdXN0b21pemUgY29waWVkIHZhbHVlcy5cbiAqIEByZXR1cm5zIHtPYmplY3R9IFJldHVybnMgYG9iamVjdGAuXG4gKi9cbmZ1bmN0aW9uIGNvcHlPYmplY3Qoc291cmNlLCBwcm9wcywgb2JqZWN0LCBjdXN0b21pemVyKSB7XG4gIG9iamVjdCB8fCAob2JqZWN0ID0ge30pO1xuXG4gIHZhciBpbmRleCA9IC0xLFxuICAgICAgbGVuZ3RoID0gcHJvcHMubGVuZ3RoO1xuXG4gIHdoaWxlICgrK2luZGV4IDwgbGVuZ3RoKSB7XG4gICAgdmFyIGtleSA9IHByb3BzW2luZGV4XTtcblxuICAgIHZhciBuZXdWYWx1ZSA9IGN1c3RvbWl6ZXJcbiAgICAgID8gY3VzdG9taXplcihvYmplY3Rba2V5XSwgc291cmNlW2tleV0sIGtleSwgb2JqZWN0LCBzb3VyY2UpXG4gICAgICA6IHVuZGVmaW5lZDtcblxuICAgIGFzc2lnblZhbHVlKG9iamVjdCwga2V5LCBuZXdWYWx1ZSA9PT0gdW5kZWZpbmVkID8gc291cmNlW2tleV0gOiBuZXdWYWx1ZSk7XG4gIH1cbiAgcmV0dXJuIG9iamVjdDtcbn1cblxuLyoqXG4gKiBDcmVhdGVzIGEgZnVuY3Rpb24gbGlrZSBgXy5hc3NpZ25gLlxuICpcbiAqIEBwcml2YXRlXG4gKiBAcGFyYW0ge0Z1bmN0aW9ufSBhc3NpZ25lciBUaGUgZnVuY3Rpb24gdG8gYXNzaWduIHZhbHVlcy5cbiAqIEByZXR1cm5zIHtGdW5jdGlvbn0gUmV0dXJucyB0aGUgbmV3IGFzc2lnbmVyIGZ1bmN0aW9uLlxuICovXG5mdW5jdGlvbiBjcmVhdGVBc3NpZ25lcihhc3NpZ25lcikge1xuICByZXR1cm4gYmFzZVJlc3QoZnVuY3Rpb24ob2JqZWN0LCBzb3VyY2VzKSB7XG4gICAgdmFyIGluZGV4ID0gLTEsXG4gICAgICAgIGxlbmd0aCA9IHNvdXJjZXMubGVuZ3RoLFxuICAgICAgICBjdXN0b21pemVyID0gbGVuZ3RoID4gMSA/IHNvdXJjZXNbbGVuZ3RoIC0gMV0gOiB1bmRlZmluZWQsXG4gICAgICAgIGd1YXJkID0gbGVuZ3RoID4gMiA/IHNvdXJjZXNbMl0gOiB1bmRlZmluZWQ7XG5cbiAgICBjdXN0b21pemVyID0gKGFzc2lnbmVyLmxlbmd0aCA+IDMgJiYgdHlwZW9mIGN1c3RvbWl6ZXIgPT0gJ2Z1bmN0aW9uJylcbiAgICAgID8gKGxlbmd0aC0tLCBjdXN0b21pemVyKVxuICAgICAgOiB1bmRlZmluZWQ7XG5cbiAgICBpZiAoZ3VhcmQgJiYgaXNJdGVyYXRlZUNhbGwoc291cmNlc1swXSwgc291cmNlc1sxXSwgZ3VhcmQpKSB7XG4gICAgICBjdXN0b21pemVyID0gbGVuZ3RoIDwgMyA/IHVuZGVmaW5lZCA6IGN1c3RvbWl6ZXI7XG4gICAgICBsZW5ndGggPSAxO1xuICAgIH1cbiAgICBvYmplY3QgPSBPYmplY3Qob2JqZWN0KTtcbiAgICB3aGlsZSAoKytpbmRleCA8IGxlbmd0aCkge1xuICAgICAgdmFyIHNvdXJjZSA9IHNvdXJjZXNbaW5kZXhdO1xuICAgICAgaWYgKHNvdXJjZSkge1xuICAgICAgICBhc3NpZ25lcihvYmplY3QsIHNvdXJjZSwgaW5kZXgsIGN1c3RvbWl6ZXIpO1xuICAgICAgfVxuICAgIH1cbiAgICByZXR1cm4gb2JqZWN0O1xuICB9KTtcbn1cblxuLyoqXG4gKiBDaGVja3MgaWYgYHZhbHVlYCBpcyBhIHZhbGlkIGFycmF5LWxpa2UgaW5kZXguXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHBhcmFtIHtudW1iZXJ9IFtsZW5ndGg9TUFYX1NBRkVfSU5URUdFUl0gVGhlIHVwcGVyIGJvdW5kcyBvZiBhIHZhbGlkIGluZGV4LlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYSB2YWxpZCBpbmRleCwgZWxzZSBgZmFsc2VgLlxuICovXG5mdW5jdGlvbiBpc0luZGV4KHZhbHVlLCBsZW5ndGgpIHtcbiAgbGVuZ3RoID0gbGVuZ3RoID09IG51bGwgPyBNQVhfU0FGRV9JTlRFR0VSIDogbGVuZ3RoO1xuICByZXR1cm4gISFsZW5ndGggJiZcbiAgICAodHlwZW9mIHZhbHVlID09ICdudW1iZXInIHx8IHJlSXNVaW50LnRlc3QodmFsdWUpKSAmJlxuICAgICh2YWx1ZSA+IC0xICYmIHZhbHVlICUgMSA9PSAwICYmIHZhbHVlIDwgbGVuZ3RoKTtcbn1cblxuLyoqXG4gKiBDaGVja3MgaWYgdGhlIGdpdmVuIGFyZ3VtZW50cyBhcmUgZnJvbSBhbiBpdGVyYXRlZSBjYWxsLlxuICpcbiAqIEBwcml2YXRlXG4gKiBAcGFyYW0geyp9IHZhbHVlIFRoZSBwb3RlbnRpYWwgaXRlcmF0ZWUgdmFsdWUgYXJndW1lbnQuXG4gKiBAcGFyYW0geyp9IGluZGV4IFRoZSBwb3RlbnRpYWwgaXRlcmF0ZWUgaW5kZXggb3Iga2V5IGFyZ3VtZW50LlxuICogQHBhcmFtIHsqfSBvYmplY3QgVGhlIHBvdGVudGlhbCBpdGVyYXRlZSBvYmplY3QgYXJndW1lbnQuXG4gKiBAcmV0dXJucyB7Ym9vbGVhbn0gUmV0dXJucyBgdHJ1ZWAgaWYgdGhlIGFyZ3VtZW50cyBhcmUgZnJvbSBhbiBpdGVyYXRlZSBjYWxsLFxuICogIGVsc2UgYGZhbHNlYC5cbiAqL1xuZnVuY3Rpb24gaXNJdGVyYXRlZUNhbGwodmFsdWUsIGluZGV4LCBvYmplY3QpIHtcbiAgaWYgKCFpc09iamVjdChvYmplY3QpKSB7XG4gICAgcmV0dXJuIGZhbHNlO1xuICB9XG4gIHZhciB0eXBlID0gdHlwZW9mIGluZGV4O1xuICBpZiAodHlwZSA9PSAnbnVtYmVyJ1xuICAgICAgICA/IChpc0FycmF5TGlrZShvYmplY3QpICYmIGlzSW5kZXgoaW5kZXgsIG9iamVjdC5sZW5ndGgpKVxuICAgICAgICA6ICh0eXBlID09ICdzdHJpbmcnICYmIGluZGV4IGluIG9iamVjdClcbiAgICAgICkge1xuICAgIHJldHVybiBlcShvYmplY3RbaW5kZXhdLCB2YWx1ZSk7XG4gIH1cbiAgcmV0dXJuIGZhbHNlO1xufVxuXG4vKipcbiAqIENoZWNrcyBpZiBgdmFsdWVgIGlzIGxpa2VseSBhIHByb3RvdHlwZSBvYmplY3QuXG4gKlxuICogQHByaXZhdGVcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYSBwcm90b3R5cGUsIGVsc2UgYGZhbHNlYC5cbiAqL1xuZnVuY3Rpb24gaXNQcm90b3R5cGUodmFsdWUpIHtcbiAgdmFyIEN0b3IgPSB2YWx1ZSAmJiB2YWx1ZS5jb25zdHJ1Y3RvcixcbiAgICAgIHByb3RvID0gKHR5cGVvZiBDdG9yID09ICdmdW5jdGlvbicgJiYgQ3Rvci5wcm90b3R5cGUpIHx8IG9iamVjdFByb3RvO1xuXG4gIHJldHVybiB2YWx1ZSA9PT0gcHJvdG87XG59XG5cbi8qKlxuICogUGVyZm9ybXMgYVxuICogW2BTYW1lVmFsdWVaZXJvYF0oaHR0cDovL2VjbWEtaW50ZXJuYXRpb25hbC5vcmcvZWNtYS0yNjIvNy4wLyNzZWMtc2FtZXZhbHVlemVybylcbiAqIGNvbXBhcmlzb24gYmV0d2VlbiB0d28gdmFsdWVzIHRvIGRldGVybWluZSBpZiB0aGV5IGFyZSBlcXVpdmFsZW50LlxuICpcbiAqIEBzdGF0aWNcbiAqIEBtZW1iZXJPZiBfXG4gKiBAc2luY2UgNC4wLjBcbiAqIEBjYXRlZ29yeSBMYW5nXG4gKiBAcGFyYW0geyp9IHZhbHVlIFRoZSB2YWx1ZSB0byBjb21wYXJlLlxuICogQHBhcmFtIHsqfSBvdGhlciBUaGUgb3RoZXIgdmFsdWUgdG8gY29tcGFyZS5cbiAqIEByZXR1cm5zIHtib29sZWFufSBSZXR1cm5zIGB0cnVlYCBpZiB0aGUgdmFsdWVzIGFyZSBlcXVpdmFsZW50LCBlbHNlIGBmYWxzZWAuXG4gKiBAZXhhbXBsZVxuICpcbiAqIHZhciBvYmplY3QgPSB7ICdhJzogMSB9O1xuICogdmFyIG90aGVyID0geyAnYSc6IDEgfTtcbiAqXG4gKiBfLmVxKG9iamVjdCwgb2JqZWN0KTtcbiAqIC8vID0+IHRydWVcbiAqXG4gKiBfLmVxKG9iamVjdCwgb3RoZXIpO1xuICogLy8gPT4gZmFsc2VcbiAqXG4gKiBfLmVxKCdhJywgJ2EnKTtcbiAqIC8vID0+IHRydWVcbiAqXG4gKiBfLmVxKCdhJywgT2JqZWN0KCdhJykpO1xuICogLy8gPT4gZmFsc2VcbiAqXG4gKiBfLmVxKE5hTiwgTmFOKTtcbiAqIC8vID0+IHRydWVcbiAqL1xuZnVuY3Rpb24gZXEodmFsdWUsIG90aGVyKSB7XG4gIHJldHVybiB2YWx1ZSA9PT0gb3RoZXIgfHwgKHZhbHVlICE9PSB2YWx1ZSAmJiBvdGhlciAhPT0gb3RoZXIpO1xufVxuXG4vKipcbiAqIENoZWNrcyBpZiBgdmFsdWVgIGlzIGxpa2VseSBhbiBgYXJndW1lbnRzYCBvYmplY3QuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSAwLjEuMFxuICogQGNhdGVnb3J5IExhbmdcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYW4gYGFyZ3VtZW50c2Agb2JqZWN0LFxuICogIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc0FyZ3VtZW50cyhmdW5jdGlvbigpIHsgcmV0dXJuIGFyZ3VtZW50czsgfSgpKTtcbiAqIC8vID0+IHRydWVcbiAqXG4gKiBfLmlzQXJndW1lbnRzKFsxLCAyLCAzXSk7XG4gKiAvLyA9PiBmYWxzZVxuICovXG5mdW5jdGlvbiBpc0FyZ3VtZW50cyh2YWx1ZSkge1xuICAvLyBTYWZhcmkgOC4xIG1ha2VzIGBhcmd1bWVudHMuY2FsbGVlYCBlbnVtZXJhYmxlIGluIHN0cmljdCBtb2RlLlxuICByZXR1cm4gaXNBcnJheUxpa2VPYmplY3QodmFsdWUpICYmIGhhc093blByb3BlcnR5LmNhbGwodmFsdWUsICdjYWxsZWUnKSAmJlxuICAgICghcHJvcGVydHlJc0VudW1lcmFibGUuY2FsbCh2YWx1ZSwgJ2NhbGxlZScpIHx8IG9iamVjdFRvU3RyaW5nLmNhbGwodmFsdWUpID09IGFyZ3NUYWcpO1xufVxuXG4vKipcbiAqIENoZWNrcyBpZiBgdmFsdWVgIGlzIGNsYXNzaWZpZWQgYXMgYW4gYEFycmF5YCBvYmplY3QuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSAwLjEuMFxuICogQGNhdGVnb3J5IExhbmdcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYW4gYXJyYXksIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc0FycmF5KFsxLCAyLCAzXSk7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc0FycmF5KGRvY3VtZW50LmJvZHkuY2hpbGRyZW4pO1xuICogLy8gPT4gZmFsc2VcbiAqXG4gKiBfLmlzQXJyYXkoJ2FiYycpO1xuICogLy8gPT4gZmFsc2VcbiAqXG4gKiBfLmlzQXJyYXkoXy5ub29wKTtcbiAqIC8vID0+IGZhbHNlXG4gKi9cbnZhciBpc0FycmF5ID0gQXJyYXkuaXNBcnJheTtcblxuLyoqXG4gKiBDaGVja3MgaWYgYHZhbHVlYCBpcyBhcnJheS1saWtlLiBBIHZhbHVlIGlzIGNvbnNpZGVyZWQgYXJyYXktbGlrZSBpZiBpdCdzXG4gKiBub3QgYSBmdW5jdGlvbiBhbmQgaGFzIGEgYHZhbHVlLmxlbmd0aGAgdGhhdCdzIGFuIGludGVnZXIgZ3JlYXRlciB0aGFuIG9yXG4gKiBlcXVhbCB0byBgMGAgYW5kIGxlc3MgdGhhbiBvciBlcXVhbCB0byBgTnVtYmVyLk1BWF9TQUZFX0lOVEVHRVJgLlxuICpcbiAqIEBzdGF0aWNcbiAqIEBtZW1iZXJPZiBfXG4gKiBAc2luY2UgNC4wLjBcbiAqIEBjYXRlZ29yeSBMYW5nXG4gKiBAcGFyYW0geyp9IHZhbHVlIFRoZSB2YWx1ZSB0byBjaGVjay5cbiAqIEByZXR1cm5zIHtib29sZWFufSBSZXR1cm5zIGB0cnVlYCBpZiBgdmFsdWVgIGlzIGFycmF5LWxpa2UsIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc0FycmF5TGlrZShbMSwgMiwgM10pO1xuICogLy8gPT4gdHJ1ZVxuICpcbiAqIF8uaXNBcnJheUxpa2UoZG9jdW1lbnQuYm9keS5jaGlsZHJlbik7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc0FycmF5TGlrZSgnYWJjJyk7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc0FycmF5TGlrZShfLm5vb3ApO1xuICogLy8gPT4gZmFsc2VcbiAqL1xuZnVuY3Rpb24gaXNBcnJheUxpa2UodmFsdWUpIHtcbiAgcmV0dXJuIHZhbHVlICE9IG51bGwgJiYgaXNMZW5ndGgodmFsdWUubGVuZ3RoKSAmJiAhaXNGdW5jdGlvbih2YWx1ZSk7XG59XG5cbi8qKlxuICogVGhpcyBtZXRob2QgaXMgbGlrZSBgXy5pc0FycmF5TGlrZWAgZXhjZXB0IHRoYXQgaXQgYWxzbyBjaGVja3MgaWYgYHZhbHVlYFxuICogaXMgYW4gb2JqZWN0LlxuICpcbiAqIEBzdGF0aWNcbiAqIEBtZW1iZXJPZiBfXG4gKiBAc2luY2UgNC4wLjBcbiAqIEBjYXRlZ29yeSBMYW5nXG4gKiBAcGFyYW0geyp9IHZhbHVlIFRoZSB2YWx1ZSB0byBjaGVjay5cbiAqIEByZXR1cm5zIHtib29sZWFufSBSZXR1cm5zIGB0cnVlYCBpZiBgdmFsdWVgIGlzIGFuIGFycmF5LWxpa2Ugb2JqZWN0LFxuICogIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc0FycmF5TGlrZU9iamVjdChbMSwgMiwgM10pO1xuICogLy8gPT4gdHJ1ZVxuICpcbiAqIF8uaXNBcnJheUxpa2VPYmplY3QoZG9jdW1lbnQuYm9keS5jaGlsZHJlbik7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc0FycmF5TGlrZU9iamVjdCgnYWJjJyk7XG4gKiAvLyA9PiBmYWxzZVxuICpcbiAqIF8uaXNBcnJheUxpa2VPYmplY3QoXy5ub29wKTtcbiAqIC8vID0+IGZhbHNlXG4gKi9cbmZ1bmN0aW9uIGlzQXJyYXlMaWtlT2JqZWN0KHZhbHVlKSB7XG4gIHJldHVybiBpc09iamVjdExpa2UodmFsdWUpICYmIGlzQXJyYXlMaWtlKHZhbHVlKTtcbn1cblxuLyoqXG4gKiBDaGVja3MgaWYgYHZhbHVlYCBpcyBjbGFzc2lmaWVkIGFzIGEgYEZ1bmN0aW9uYCBvYmplY3QuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSAwLjEuMFxuICogQGNhdGVnb3J5IExhbmdcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYSBmdW5jdGlvbiwgZWxzZSBgZmFsc2VgLlxuICogQGV4YW1wbGVcbiAqXG4gKiBfLmlzRnVuY3Rpb24oXyk7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc0Z1bmN0aW9uKC9hYmMvKTtcbiAqIC8vID0+IGZhbHNlXG4gKi9cbmZ1bmN0aW9uIGlzRnVuY3Rpb24odmFsdWUpIHtcbiAgLy8gVGhlIHVzZSBvZiBgT2JqZWN0I3RvU3RyaW5nYCBhdm9pZHMgaXNzdWVzIHdpdGggdGhlIGB0eXBlb2ZgIG9wZXJhdG9yXG4gIC8vIGluIFNhZmFyaSA4LTkgd2hpY2ggcmV0dXJucyAnb2JqZWN0JyBmb3IgdHlwZWQgYXJyYXkgYW5kIG90aGVyIGNvbnN0cnVjdG9ycy5cbiAgdmFyIHRhZyA9IGlzT2JqZWN0KHZhbHVlKSA/IG9iamVjdFRvU3RyaW5nLmNhbGwodmFsdWUpIDogJyc7XG4gIHJldHVybiB0YWcgPT0gZnVuY1RhZyB8fCB0YWcgPT0gZ2VuVGFnO1xufVxuXG4vKipcbiAqIENoZWNrcyBpZiBgdmFsdWVgIGlzIGEgdmFsaWQgYXJyYXktbGlrZSBsZW5ndGguXG4gKlxuICogKipOb3RlOioqIFRoaXMgbWV0aG9kIGlzIGxvb3NlbHkgYmFzZWQgb25cbiAqIFtgVG9MZW5ndGhgXShodHRwOi8vZWNtYS1pbnRlcm5hdGlvbmFsLm9yZy9lY21hLTI2Mi83LjAvI3NlYy10b2xlbmd0aCkuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSA0LjAuMFxuICogQGNhdGVnb3J5IExhbmdcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgYSB2YWxpZCBsZW5ndGgsIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc0xlbmd0aCgzKTtcbiAqIC8vID0+IHRydWVcbiAqXG4gKiBfLmlzTGVuZ3RoKE51bWJlci5NSU5fVkFMVUUpO1xuICogLy8gPT4gZmFsc2VcbiAqXG4gKiBfLmlzTGVuZ3RoKEluZmluaXR5KTtcbiAqIC8vID0+IGZhbHNlXG4gKlxuICogXy5pc0xlbmd0aCgnMycpO1xuICogLy8gPT4gZmFsc2VcbiAqL1xuZnVuY3Rpb24gaXNMZW5ndGgodmFsdWUpIHtcbiAgcmV0dXJuIHR5cGVvZiB2YWx1ZSA9PSAnbnVtYmVyJyAmJlxuICAgIHZhbHVlID4gLTEgJiYgdmFsdWUgJSAxID09IDAgJiYgdmFsdWUgPD0gTUFYX1NBRkVfSU5URUdFUjtcbn1cblxuLyoqXG4gKiBDaGVja3MgaWYgYHZhbHVlYCBpcyB0aGVcbiAqIFtsYW5ndWFnZSB0eXBlXShodHRwOi8vd3d3LmVjbWEtaW50ZXJuYXRpb25hbC5vcmcvZWNtYS0yNjIvNy4wLyNzZWMtZWNtYXNjcmlwdC1sYW5ndWFnZS10eXBlcylcbiAqIG9mIGBPYmplY3RgLiAoZS5nLiBhcnJheXMsIGZ1bmN0aW9ucywgb2JqZWN0cywgcmVnZXhlcywgYG5ldyBOdW1iZXIoMClgLCBhbmQgYG5ldyBTdHJpbmcoJycpYClcbiAqXG4gKiBAc3RhdGljXG4gKiBAbWVtYmVyT2YgX1xuICogQHNpbmNlIDAuMS4wXG4gKiBAY2F0ZWdvcnkgTGFuZ1xuICogQHBhcmFtIHsqfSB2YWx1ZSBUaGUgdmFsdWUgdG8gY2hlY2suXG4gKiBAcmV0dXJucyB7Ym9vbGVhbn0gUmV0dXJucyBgdHJ1ZWAgaWYgYHZhbHVlYCBpcyBhbiBvYmplY3QsIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc09iamVjdCh7fSk7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc09iamVjdChbMSwgMiwgM10pO1xuICogLy8gPT4gdHJ1ZVxuICpcbiAqIF8uaXNPYmplY3QoXy5ub29wKTtcbiAqIC8vID0+IHRydWVcbiAqXG4gKiBfLmlzT2JqZWN0KG51bGwpO1xuICogLy8gPT4gZmFsc2VcbiAqL1xuZnVuY3Rpb24gaXNPYmplY3QodmFsdWUpIHtcbiAgdmFyIHR5cGUgPSB0eXBlb2YgdmFsdWU7XG4gIHJldHVybiAhIXZhbHVlICYmICh0eXBlID09ICdvYmplY3QnIHx8IHR5cGUgPT0gJ2Z1bmN0aW9uJyk7XG59XG5cbi8qKlxuICogQ2hlY2tzIGlmIGB2YWx1ZWAgaXMgb2JqZWN0LWxpa2UuIEEgdmFsdWUgaXMgb2JqZWN0LWxpa2UgaWYgaXQncyBub3QgYG51bGxgXG4gKiBhbmQgaGFzIGEgYHR5cGVvZmAgcmVzdWx0IG9mIFwib2JqZWN0XCIuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSA0LjAuMFxuICogQGNhdGVnb3J5IExhbmdcbiAqIEBwYXJhbSB7Kn0gdmFsdWUgVGhlIHZhbHVlIHRvIGNoZWNrLlxuICogQHJldHVybnMge2Jvb2xlYW59IFJldHVybnMgYHRydWVgIGlmIGB2YWx1ZWAgaXMgb2JqZWN0LWxpa2UsIGVsc2UgYGZhbHNlYC5cbiAqIEBleGFtcGxlXG4gKlxuICogXy5pc09iamVjdExpa2Uoe30pO1xuICogLy8gPT4gdHJ1ZVxuICpcbiAqIF8uaXNPYmplY3RMaWtlKFsxLCAyLCAzXSk7XG4gKiAvLyA9PiB0cnVlXG4gKlxuICogXy5pc09iamVjdExpa2UoXy5ub29wKTtcbiAqIC8vID0+IGZhbHNlXG4gKlxuICogXy5pc09iamVjdExpa2UobnVsbCk7XG4gKiAvLyA9PiBmYWxzZVxuICovXG5mdW5jdGlvbiBpc09iamVjdExpa2UodmFsdWUpIHtcbiAgcmV0dXJuICEhdmFsdWUgJiYgdHlwZW9mIHZhbHVlID09ICdvYmplY3QnO1xufVxuXG4vKipcbiAqIEFzc2lnbnMgb3duIGVudW1lcmFibGUgc3RyaW5nIGtleWVkIHByb3BlcnRpZXMgb2Ygc291cmNlIG9iamVjdHMgdG8gdGhlXG4gKiBkZXN0aW5hdGlvbiBvYmplY3QuIFNvdXJjZSBvYmplY3RzIGFyZSBhcHBsaWVkIGZyb20gbGVmdCB0byByaWdodC5cbiAqIFN1YnNlcXVlbnQgc291cmNlcyBvdmVyd3JpdGUgcHJvcGVydHkgYXNzaWdubWVudHMgb2YgcHJldmlvdXMgc291cmNlcy5cbiAqXG4gKiAqKk5vdGU6KiogVGhpcyBtZXRob2QgbXV0YXRlcyBgb2JqZWN0YCBhbmQgaXMgbG9vc2VseSBiYXNlZCBvblxuICogW2BPYmplY3QuYXNzaWduYF0oaHR0cHM6Ly9tZG4uaW8vT2JqZWN0L2Fzc2lnbikuXG4gKlxuICogQHN0YXRpY1xuICogQG1lbWJlck9mIF9cbiAqIEBzaW5jZSAwLjEwLjBcbiAqIEBjYXRlZ29yeSBPYmplY3RcbiAqIEBwYXJhbSB7T2JqZWN0fSBvYmplY3QgVGhlIGRlc3RpbmF0aW9uIG9iamVjdC5cbiAqIEBwYXJhbSB7Li4uT2JqZWN0fSBbc291cmNlc10gVGhlIHNvdXJjZSBvYmplY3RzLlxuICogQHJldHVybnMge09iamVjdH0gUmV0dXJucyBgb2JqZWN0YC5cbiAqIEBzZWUgXy5hc3NpZ25JblxuICogQGV4YW1wbGVcbiAqXG4gKiBmdW5jdGlvbiBGb28oKSB7XG4gKiAgIHRoaXMuYSA9IDE7XG4gKiB9XG4gKlxuICogZnVuY3Rpb24gQmFyKCkge1xuICogICB0aGlzLmMgPSAzO1xuICogfVxuICpcbiAqIEZvby5wcm90b3R5cGUuYiA9IDI7XG4gKiBCYXIucHJvdG90eXBlLmQgPSA0O1xuICpcbiAqIF8uYXNzaWduKHsgJ2EnOiAwIH0sIG5ldyBGb28sIG5ldyBCYXIpO1xuICogLy8gPT4geyAnYSc6IDEsICdjJzogMyB9XG4gKi9cbnZhciBhc3NpZ24gPSBjcmVhdGVBc3NpZ25lcihmdW5jdGlvbihvYmplY3QsIHNvdXJjZSkge1xuICBpZiAobm9uRW51bVNoYWRvd3MgfHwgaXNQcm90b3R5cGUoc291cmNlKSB8fCBpc0FycmF5TGlrZShzb3VyY2UpKSB7XG4gICAgY29weU9iamVjdChzb3VyY2UsIGtleXMoc291cmNlKSwgb2JqZWN0KTtcbiAgICByZXR1cm47XG4gIH1cbiAgZm9yICh2YXIga2V5IGluIHNvdXJjZSkge1xuICAgIGlmIChoYXNPd25Qcm9wZXJ0eS5jYWxsKHNvdXJjZSwga2V5KSkge1xuICAgICAgYXNzaWduVmFsdWUob2JqZWN0LCBrZXksIHNvdXJjZVtrZXldKTtcbiAgICB9XG4gIH1cbn0pO1xuXG4vKipcbiAqIENyZWF0ZXMgYW4gYXJyYXkgb2YgdGhlIG93biBlbnVtZXJhYmxlIHByb3BlcnR5IG5hbWVzIG9mIGBvYmplY3RgLlxuICpcbiAqICoqTm90ZToqKiBOb24tb2JqZWN0IHZhbHVlcyBhcmUgY29lcmNlZCB0byBvYmplY3RzLiBTZWUgdGhlXG4gKiBbRVMgc3BlY10oaHR0cDovL2VjbWEtaW50ZXJuYXRpb25hbC5vcmcvZWNtYS0yNjIvNy4wLyNzZWMtb2JqZWN0LmtleXMpXG4gKiBmb3IgbW9yZSBkZXRhaWxzLlxuICpcbiAqIEBzdGF0aWNcbiAqIEBzaW5jZSAwLjEuMFxuICogQG1lbWJlck9mIF9cbiAqIEBjYXRlZ29yeSBPYmplY3RcbiAqIEBwYXJhbSB7T2JqZWN0fSBvYmplY3QgVGhlIG9iamVjdCB0byBxdWVyeS5cbiAqIEByZXR1cm5zIHtBcnJheX0gUmV0dXJucyB0aGUgYXJyYXkgb2YgcHJvcGVydHkgbmFtZXMuXG4gKiBAZXhhbXBsZVxuICpcbiAqIGZ1bmN0aW9uIEZvbygpIHtcbiAqICAgdGhpcy5hID0gMTtcbiAqICAgdGhpcy5iID0gMjtcbiAqIH1cbiAqXG4gKiBGb28ucHJvdG90eXBlLmMgPSAzO1xuICpcbiAqIF8ua2V5cyhuZXcgRm9vKTtcbiAqIC8vID0+IFsnYScsICdiJ10gKGl0ZXJhdGlvbiBvcmRlciBpcyBub3QgZ3VhcmFudGVlZClcbiAqXG4gKiBfLmtleXMoJ2hpJyk7XG4gKiAvLyA9PiBbJzAnLCAnMSddXG4gKi9cbmZ1bmN0aW9uIGtleXMob2JqZWN0KSB7XG4gIHJldHVybiBpc0FycmF5TGlrZShvYmplY3QpID8gYXJyYXlMaWtlS2V5cyhvYmplY3QpIDogYmFzZUtleXMob2JqZWN0KTtcbn1cblxubW9kdWxlLmV4cG9ydHMgPSBhc3NpZ247XG4iXSwic291cmNlUm9vdCI6IiJ9