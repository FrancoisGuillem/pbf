import UI from '../ui';

class Header {
  constructor() {
    this.el = document.querySelector('.site-header');

    this.refs = {
      navigation: this.el.querySelector('nav'),
      opener: this.el.querySelector('[aria-controls]'),
    };

    this.data = {
      opened: false,
    };

    this.bind();
  }

  bind() {
    this.refs.opener.addEventListener('click', event => {
      this.opened = !this.opened;
    });

    this.refs.navigation.addEventListener('transitionend', event => {
      if (event.target !== this.refs.navigation) {
        return;
      }

      this.refs.navigation.removeAttribute('style');
      this.el.classList.remove('t-play');
    });

    UI.observe('scrollY', position => {
      this.top = position <= 0;
    });

    UI.observe('width', width => {
      this.layout = width < 768 ? 'mobile' : 'tablet';
    });
  }

  animate() {
    this.el.classList.add('t-play');
    window.requestAnimationFrame(() => {
      if (!this.opened) {
        this.refs.navigation.style.height = `${this.navigationHeight}px`;
        window.requestAnimationFrame(() => {
          this.refs.navigation.style.height = '0';
        });
        return;
      }

      this.refs.navigation.style.display = 'block';
      this.navigationHeight = this.refs.navigation.clientHeight;
      this.refs.navigation.style.height = '0';

      window.requestAnimationFrame(() => {
        this.refs.navigation.style.height = `${this.navigationHeight}px`;
      });
    });
  }

  updateNaveState() {
    if (this.layout === 'mobile') {
      this.opened = false;

      return;
    }

    this.opened = true;
  }

  get layout() {
    return this.data.layout;
  }

  set layout(value) {
    if (this.data.layout === value) {
      return;
    }

    this.data.layout = value;

    this.updateNaveState();
  }

  get navigationHeight() {
    return this.data.navigationHeight;
  }

  set navigationHeight(value) {
    this.data.navigationHeight = value;
  }

  get opened() {
    return this.data.opened;
  }

  set opened(value) {
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

    this.animate();
  }

  get top() {
    return this.data.top;
  }

  set top(value) {
    if (value === this.data.top) {
      return;
    }

    this.data.top = value;

    this.el.classList.toggle('sticky', !value);
  }
}

export default new Header();
