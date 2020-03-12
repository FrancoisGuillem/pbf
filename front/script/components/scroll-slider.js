import UI from '../ui';

class Slider {
  constructor(el) {
    this.el = el;
    this.refs = {
      scroller: this.el.querySelector('div > ul'),
      pagination: Array.from(
        this.el.querySelectorAll('[role="presentation"] > li:empty'),
      ),
    };
    const data = {
      scrollPos: this.refs.scroller.scrollLeft,
      step: this.refs.scroller.offsetWidth,
    };

    this.data = data;
    this.current = this.page;

    this.bind();
  }

  bind() {
    this.refs.scroller.addEventListener(
      'scroll',
      event => {
        this.handleScroll(event.target.scrollLeft);
      },
      {
        passive: true,
      },
    );

    UI.observe('width', () => {
      this.data.resized = true;
    });
  }

  handleScroll(scrollPos) {
    if (this.data.resized) {
      this.data.scrollPos = this.refs.scroller.scrollLeft;
      this.data.step = this.refs.scroller.offsetWidth;
      this.data.resized = false;
    }

    this.scrollPos = scrollPos;

    const page = this.page;

    if (page !== this.current) {
      this.current = page;
    }
  }

  get page() {
    return Math.round(this.data.scrollPos / this.data.step);
  }

  get current() {
    return this.data.page;
  }

  set current(page) {
    this.data.page = page;
    this.refs.pagination.forEach((el, index) =>
      el.classList.toggle('current', index === page),
    );
  }

  get scrollPos() {
    return this.data.scrollPos;
  }

  set scrollPos(pos) {
    this.data.scrollPos = pos;
  }
}

for (const el of document.querySelectorAll('[data-bind="scroll-slider"]')) {
  new Slider(el);
}
