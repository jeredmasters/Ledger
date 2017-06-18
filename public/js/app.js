/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

window.calendar = {};

$(document).ready(function () {
    $('#bookingForm').modal('hide');
    $('#from').change(checkDates);
    $('#to').change(checkDates);
    $('#main').change(checkDates);
    $('#flat').change(checkDates);
    $('#studio').change(checkDates);
    $('#calendar').fullCalendar({
        header: { "right": "prev,next", "left": "title" },
        eventLimit: false,
        events: window.calendar.events,
        dayClick: function dayClick(date, jsEvent, view, resourceObj) {
            window.calendar.selectedEvent = -1;
            $('#from').val(date.format());
            $('#to').val(date.add(1, 'day').format());
            $('#bookingForm').modal('show');
            checkDates();
        },
        eventClick: function eventClick(event) {
            window.location = '/m/bookings/' + event.id + '/edit';
        },
        eventRender: function eventRender(event, element) {
            if (event.type == 2) {
                element.html(event.title + ' <i class="fa fa-lock" aria-hidden="true"></i>');
            }
            if (event.type == 1) {
                element.html(event.title + ' <i class="fa fa-question" aria-hidden="true"></i>');
            }
        }
    });
});

function checkDates() {
    var from = moment($('#from').val()).add(1, 'day');
    var to = moment($('#to').val()).add(2, 'day');
    var main = $('#main').is(":checked");
    var flat = $('#flat').is(":checked");
    var studio = $('#studio').is(":checked");

    var conflict = false;
    if (!(main || flat || studio)) {
        $('#conflict-message').hide();
        $('#bookingForm input[type="submit"]').prop('disabled', true);
    } else {
        while (from < to) {
            conflict = checkDate(from, main, flat, studio);
            if (conflict !== false) {
                break;
            }
            from = from.clone().add(1, 'day');
        }

        if (conflict) {
            $('#conflict-message').show();
            $('#bookingForm input[type="submit"]').prop('disabled', true);
            var text = [];
            for (var i in conflict) {
                text.push(conflict[i].title + ": " + conflict[i].start.format('DD/MM/YYYY') + " - " + conflict[i].end.clone().add(-1, 'day').format('DD/MM/YYYY'));
            };

            $('#conflict-info').html(text.join('<br/>'));
        } else {
            $('#conflict-message').hide();
            $('#bookingForm input[type="submit"]').prop('disabled', false);
        }
    }
}
function checkDate(date, main, flat, studio) {
    var e = _.filter(window.calendar.events, function (event) {
        if (date >= event.start && date <= event.end) {
            if (main && event.area == 'main' || flat && event.area == 'flat' || studio && event.area == 'studio') {
                if (event.id != window.calendar.selectedEvent) {
                    return true;
                }
            }
        }
        return false;
    });
    return e.length > 0 ? e : false;
}
window.checkDates = checkDates;

/***/ }),
/* 1 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(0);
module.exports = __webpack_require__(1);


/***/ })
/******/ ]);