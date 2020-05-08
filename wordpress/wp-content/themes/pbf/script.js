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
      this.resized();
      this.scrolled();
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

        var immediate = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

        if (!this.observers[property]) {
          this.observers[property] = [];
        }

        var length = this.observers[property].push(callback);

        var unobserver = function unobserver() {
          _this2.observers[property].splice(length - 1, 1);
        };

        if (immediate && this.data[property]) {
          callback(this.data[property]);
        }

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

  var Header = /*#__PURE__*/function () {
    function Header() {
      _classCallCheck(this, Header);

      this.el = document.querySelector('.site-header');
      this.refs = {
        navigation: this.el.querySelector('nav'),
        opener: this.el.querySelector('[aria-controls]'),
        dropdowns: Array.prototype.slice.call(this.el.querySelectorAll('.dropdown')),
        menus: Array.prototype.slice.call(this.el.querySelectorAll('.dropdown-menu')),
        items: Array.prototype.slice.call(this.el.querySelectorAll('nav>ul>li'))
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
        this.refs.navigation.addEventListener('click', function (event) {
          _this.toggleSubmenu(event);
        });
        this.refs.navigation.addEventListener('keypress', function (event) {
          if (event.keyCode !== 32) {
            return;
          }

          _this.toggleSubmenu(event);
        });
        this.refs.navigation.addEventListener('focusin', function (event) {
          return _this.handleInteraction(event);
        });
        this.refs.navigation.addEventListener('focusout', function (event) {
          return _this.handleInteraction(event);
        });
        this.refs.navigation.addEventListener('mouseleave', function (event) {
          _this.handleInteraction(event);
        }, true);
        this.refs.navigation.addEventListener('mouseenter', function (event) {
          _this.handleInteraction(event);
        }, true);
        UI.observe('scrollY', function (position) {
          _this.top = position <= 0;
        });
        UI.observe('width', function (width) {
          _this.layout = width < 768 ? 'mobile' : 'tablet';
        });
      }
    }, {
      key: "animate",
      value: function animate(el) {
        var _this2 = this;

        el.classList.add('t-play');
        this.el.classList.add('t-play');

        var callback = function callback(event) {
          if (event.target !== el) {
            return;
          }

          el.removeAttribute('style');
          el.classList.remove('t-play');

          _this2.el.classList.remove('t-play');

          el.removeEventListener('transitionend', callback);
        };

        el.addEventListener('transitionend', callback);
        window.requestAnimationFrame(function () {
          if (el.getAttribute('aria-hidden') === 'true') {
            el.style.height = "".concat(_this2.navigationHeight, "px");
            window.requestAnimationFrame(function () {
              el.style.height = '0';
            });
            return;
          }

          el.style.display = 'block';
          _this2.navigationHeight = el.clientHeight;
          el.style.height = '0';
          window.requestAnimationFrame(function () {
            el.style.height = "".concat(_this2.navigationHeight, "px");
          });
        });
      }
    }, {
      key: "handleInteraction",
      value: function handleInteraction(event) {
        if (this.layout === 'mobile') {
          return;
        }

        if (event.type === 'focusin' || event.type === 'mouseenter') {
          this.refs.items.forEach(function (item) {
            if (item.contains(event.target) && item !== event.target) {
              item.classList.add('interact-within');
            } else if (item === event.target) {
              item.classList.remove('interact-within');
            }
          });
          return;
        }

        if (event.type === 'focusout' || event.type === 'mouseleave') {
          this.refs.items.forEach(function (item) {
            if (item.contains(event.target) && (event.target.tagName === 'A' || event.target.tagName === 'UL')) {
              item.classList.remove('interact-within');
            }
          });
        }
      }
    }, {
      key: "removeAttributes",
      value: function removeAttributes() {
        this.refs.dropdowns.forEach(function (el) {
          el.removeAttribute('role');
          el.removeAttribute('aria-expanded');
        });
        this.refs.menus.forEach(function (el) {
          el.removeAttribute('aria-hidden');
        });
      }
    }, {
      key: "setAttributes",
      value: function setAttributes() {
        this.refs.dropdowns.forEach(function (el) {
          el.setAttribute('role', 'button');
          el.setAttribute('aria-expanded', 'false');
        });
        this.refs.menus.forEach(function (el) {
          el.setAttribute('aria-hidden', 'true');
        });
      }
    }, {
      key: "toggleSubmenu",
      value: function toggleSubmenu(event) {
        if (this.layout !== 'mobile') {
          return;
        }

        var dropdownIndex;
        this.refs.dropdowns.some(function (dropdown, index) {
          if (dropdown.contains(event.target)) {
            dropdownIndex = index;
            return true;
          }
        });
        var selectedDropdown = this.refs.dropdowns[dropdownIndex];
        var selectedMenu = this.refs.menus[dropdownIndex];

        if (!selectedDropdown) {
          return;
        }

        event.preventDefault();
        var opened = selectedDropdown.getAttribute('aria-expanded') === 'true';
        selectedDropdown.setAttribute('aria-expanded', !opened);
        selectedMenu.setAttribute('aria-hidden', opened);
        this.animate(selectedMenu);
      }
    }, {
      key: "updateNaveState",
      value: function updateNaveState() {
        if (this.layout === 'mobile') {
          this.opened = false;
          return;
        }

        this.opened = true;
      }
    }, {
      key: "layout",
      get: function get() {
        return this.data.layout;
      },
      set: function set(value) {
        if (this.data.layout === value) {
          return;
        }

        this.data.layout = value;
        this.updateNaveState();
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
        this.refs.opener.setAttribute('aria-expanded', value);
        this.refs.navigation.setAttribute('aria-hidden', !value);

        if (this.data.opened === value || this.layout !== 'mobile') {
          return;
        }

        this.data.opened = value;

        if (this.data.opened) {
          this.el.classList.add('opened');
        } else {
          this.el.classList.remove('opened');
        }

        if (value) {
          this.setAttributes();
        } else {
          this.removeAttributes();
        }

        this.animate(this.refs.navigation);
      }
    }, {
      key: "top",
      get: function get() {
        return this.data.top;
      },
      set: function set(value) {
        if (value === this.data.top) {
          return;
        }

        this.data.top = value;
        this.el.classList.toggle('sticky', !value);
      }
    }]);

    return Header;
  }();

  new Header();

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

  var Filter = /*#__PURE__*/function () {
    function Filter(el) {
      _classCallCheck(this, Filter);

      this.el = el;
      this.refs = {
        list: Array.from(document.querySelectorAll("#".concat(el.getAttribute('data-controls'), " [data-category]")))
      };
      this.data = {
        categories: []
      };
      this.bind();
    }

    _createClass(Filter, [{
      key: "bind",
      value: function bind() {
        var _this = this;

        this.el.addEventListener('input', function (event) {
          _this.setFilterState();
        });
      }
    }, {
      key: "filter",
      value: function filter() {
        var _this2 = this;

        this.refs.list.forEach(function (el) {
          var category = el.getAttribute('data-category');
          el[_this2.categories.includes(category) ? 'removeAttribute' : 'setAttribute']('hidden', true);
        });
      }
    }, {
      key: "setFilterState",
      value: function setFilterState() {
        var categories = [];
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = this.el.elements[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var el = _step.value;

            if (el.checked) {
              categories.push(el.value);
            }
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

        this.categories = categories;
      }
    }, {
      key: "categories",
      set: function set(value) {
        this.data.categories = value;
        this.filter();
      },
      get: function get() {
        return this.data.categories;
      }
    }]);

    return Filter;
  }();

  var _iteratorNormalCompletion2 = true;
  var _didIteratorError2 = false;
  var _iteratorError2 = undefined;

  try {
    for (var _iterator2 = document.querySelectorAll('form.category-filters[data-controls]')[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
      var el$1 = _step2.value;
      new Filter(el$1);
    }
  } catch (err) {
    _didIteratorError2 = true;
    _iteratorError2 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion2 && _iterator2.return != null) {
        _iterator2.return();
      }
    } finally {
      if (_didIteratorError2) {
        throw _iteratorError2;
      }
    }
  }

})));
