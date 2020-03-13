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
      this.refs.navigation.classList.remove('t-play');
      this.refs.navigation.classList.remove('t-close');
    });
  }

  animate() {
    this.refs.navigation.classList.add('t-play');
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
    this.data.opened = value;

    this.el.classList.toggle('opened');

    this.refs.opener.setAttribute('aria-expanded', value);
    this.refs.navigation.setAttribute('aria-hidden', !value);

    this.animate();
  }
}

export default new Header();
