(function (factory) {
  typeof define === 'function' && define.amd ? define(factory) :
  factory();
}((function () { 'use strict';

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  var Header = /*#__PURE__*/function () {
    function Header() {
      _classCallCheck(this, Header);

      this.el = document.querySelector('.site-header');
      this.refs = {
        navigation: this.el.querySelector('nav'),
        opener: this.el.querySelector('[aria-controls]')
      };
      this.data = {
        opened: false
      };
      this.bind();
    }

    _createClass(Header, [{
      key: "bind",
      value: function bind() {
        var _this = this;

        this.refs.opener.addEventListener('click', function (event) {
          _this.opened = !_this.opened;
        });
        this.refs.navigation.addEventListener('transitionend', function (event) {
          if (event.target !== _this.refs.navigation) {
            return;
          }

          _this.refs.navigation.removeAttribute('style');

          _this.refs.navigation.classList.remove('t-play');

          _this.refs.navigation.classList.remove('t-close');
        });
      }
    }, {
      key: "animate",
      value: function animate() {
        var _this2 = this;

        this.refs.navigation.classList.add('t-play');
        window.requestAnimationFrame(function () {
          if (!_this2.opened) {
            _this2.refs.navigation.style.height = "".concat(_this2.navigationHeight, "px");
            window.requestAnimationFrame(function () {
              _this2.refs.navigation.style.height = '0';
            });
            return;
          }

          _this2.refs.navigation.style.display = 'block';
          _this2.navigationHeight = _this2.refs.navigation.clientHeight;
          _this2.refs.navigation.style.height = '0';
          window.requestAnimationFrame(function () {
            _this2.refs.navigation.style.height = "".concat(_this2.navigationHeight, "px");
          });
        });
      }
    }, {
      key: "navigationHeight",
      get: function get() {
        return this.data.navigationHeight;
      },
      set: function set(value) {
        this.data.navigationHeight = value;
      }
    }, {
      key: "opened",
      get: function get() {
        return this.data.opened;
      },
      set: function set(value) {
        this.data.opened = value;
        this.el.classList.toggle('opened');
        this.refs.opener.setAttribute('aria-expanded', value);
        this.refs.navigation.setAttribute('aria-hidden', !value);
        this.animate();
      }
    }]);

    return Header;
  }();

  new Header();

  var Ui = /*#__PURE__*/function () {
    function Ui() {
      var _this = this;

      _classCallCheck(this, Ui);

      this.data = {};
      this.tick = {};
      this.observers = {};
      window.addEventListener('resize', function (event) {
        _this.resized();
      });
      window.addEventListener('scroll', function (event) {
        _this.scrolled();
      }, {
        passive: true
      });

      if (window.PointerEvent) {
        window.addEventListener('pointerdown', function (event) {
          return _this.detectInputType(event);
        });
        window.addEventListener('pointermove', function (event) {
          return _this.detectInputType(event);
        });
      } else {
        window.addEventListener('mousemove', function (event) {
          return _this.detectInputTypeFallback(event);
        });
        window.addEventListener('touchstart', function (event) {
          return _this.detectInputTypeFallback(event);
        });
      }

      window.addEventListener('keydown', function (event) {
        return _this.handleKeys(event);
      });
    }

    _createClass(Ui, [{
      key: "detectInputType",
      value: function detectInputType(event) {
        this.inputType = event.pointerType;
      }
    }, {
      key: "detectInputTypeFallback",
      value: function detectInputTypeFallback(event) {
        this.inputType = event.type === 'mousemove' ? 'mouse' : 'touch';
      }
    }, {
      key: "handleKeys",
      value: function handleKeys() {
        this.inputType = 'keyboard';
      }
    }, {
      key: "observe",
      value: function observe(property, callback) {
        var _this2 = this;

        if (!this.observers[property]) {
          this.observers[property] = [];
        }

        var length = this.observers[property].push(callback);

        var unobserver = function unobserver() {
          _this2.observers[property].splice(length - 1, 1);
        };

        return unobserver;
      }
    }, {
      key: "resized",
      value: function resized() {
        this.height = window.innerHeight;
        this.width = window.innerWidth;
      }
    }, {
      key: "scrolled",
      value: function scrolled() {
        this.scrollY = window.scrollY;
      }
    }, {
      key: "signal",
      value: function signal(entry, value) {
        var _this3 = this;

        if (this.tick[entry]) {
          window.cancelAnimationFrame(this.tick[entry]);
        }

        this.tick[entry] = window.requestAnimationFrame(function () {
          if (_this3.observers[entry]) {
            _this3.observers[entry].forEach(function (callback) {
              return callback(value);
            });
          }

          _this3.tick[entry] = null;
        });
      }
    }, {
      key: "height",
      set: function set(value) {
        if (value !== this.data.height) {
          this.data.height = value;
          this.signal('height', value);
        }
      },
      get: function get() {
        return this.data.height;
      }
    }, {
      key: "inputType",
      set: function set(value) {
        this.data.inputType = value;
        document.documentElement.setAttribute('data-input', value);
      }
    }, {
      key: "scrollY",
      set: function set(value) {
        if (value !== this.data.scrollY) {
          this.data.scrollY = value;
          this.signal('scrollY', value);
        }
      },
      get: function get() {
        return this.data.scrollY;
      }
    }, {
      key: "width",
      set: function set(value) {
        if (value !== this.data.width) {
          this.data.width = value;
          this.signal('width', value);
        }
      },
      get: function get() {
        return this.data.width;
      }
    }]);

    return Ui;
  }();

  var UI = new Ui();

  var Slider = /*#__PURE__*/function () {
    function Slider(el) {
      _classCallCheck(this, Slider);

      this.el = el;
      this.refs = {
        scroller: this.el.querySelector('div > ul'),
        pagination: Array.from(this.el.querySelectorAll('[role="presentation"] > li:empty'))
      };
      var data = {
        scrollPos: this.refs.scroller.scrollLeft,
        step: this.refs.scroller.offsetWidth
      };
      this.data = data;
      this.current = this.page;
      this.bind();
    }

    _createClass(Slider, [{
      key: "bind",
      value: function bind() {
        var _this = this;

        this.refs.scroller.addEventListener('scroll', function (event) {
          _this.handleScroll(event.target.scrollLeft);
        }, {
          passive: true
        });
        UI.observe('width', function () {
          _this.data.resized = true;
        });
      }
    }, {
      key: "handleScroll",
      value: function handleScroll(scrollPos) {
        if (this.data.resized) {
          this.data.scrollPos = this.refs.scroller.scrollLeft;
          this.data.step = this.refs.scroller.offsetWidth;
          this.data.resized = false;
        }

        this.scrollPos = scrollPos;
        var page = this.page;

        if (page !== this.current) {
          this.current = page;
        }
      }
    }, {
      key: "page",
      get: function get() {
        return Math.round(this.data.scrollPos / this.data.step);
      }
    }, {
      key: "current",
      get: function get() {
        return this.data.page;
      },
      set: function set(page) {
        this.data.page = page;
        this.refs.pagination.forEach(function (el, index) {
          return el.classList.toggle('current', index === page);
        });
      }
    }, {
      key: "scrollPos",
      get: function get() {
        return this.data.scrollPos;
      },
      set: function set(pos) {
        this.data.scrollPos = pos;
      }
    }]);

    return Slider;
  }();

  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = document.querySelectorAll('[data-bind="scroll-slider"]')[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var el = _step.value;
      new Slider(el);
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator.return != null) {
        _iterator.return();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

})));
