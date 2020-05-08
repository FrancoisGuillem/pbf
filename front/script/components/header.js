import UI from '../ui';

class Header {
  constructor() {
    this.el = document.querySelector('.site-header');

    this.refs = {
      navigation: this.el.querySelector('nav'),
      opener: this.el.querySelector('[aria-controls]'),
      dropdowns: Array.prototype.slice.call(
        this.el.querySelectorAll('.dropdown'),
      ),
      menus: Array.prototype.slice.call(
        this.el.querySelectorAll('.dropdown-menu'),
      ),
      items: Array.prototype.slice.call(this.el.querySelectorAll('nav>ul>li')),
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

    this.refs.navigation.addEventListener('click', event => {
      this.toggleSubmenu(event);
    });

    this.refs.navigation.addEventListener('keypress', event => {
      if (event.keyCode !== 32) {
        return;
      }

      this.toggleSubmenu(event);
    });

    this.refs.navigation.addEventListener('focusin', event =>
      this.handleInteraction(event),
    );
    this.refs.navigation.addEventListener('focusout', event =>
      this.handleInteraction(event),
    );
    this.refs.navigation.addEventListener(
      'mouseleave',
      event => {
        this.handleInteraction(event);
      },
      true,
    );

    this.refs.navigation.addEventListener(
      'mouseenter',
      event => {
        this.handleInteraction(event);
      },
      true,
    );

    UI.observe('scrollY', position => {
      this.top = position <= 0;
    });

    UI.observe('width', width => {
      this.layout = width < 768 ? 'mobile' : 'tablet';
    });
  }

  animate(el) {
    el.classList.add('t-play');
    this.el.classList.add('t-play');

    const callback = event => {
      if (event.target !== el) {
        return;
      }

      el.removeAttribute('style');
      el.classList.remove('t-play');
      this.el.classList.remove('t-play');

      el.removeEventListener('transitionend', callback);
    };

    el.addEventListener('transitionend', callback);

    window.requestAnimationFrame(() => {
      if (el.getAttribute('aria-hidden') === 'true') {
        el.style.height = `${this.navigationHeight}px`;
        window.requestAnimationFrame(() => {
          el.style.height = '0';
        });
        return;
      }

      el.style.display = 'block';
      this.navigationHeight = el.clientHeight;
      el.style.height = '0';

      window.requestAnimationFrame(() => {
        el.style.height = `${this.navigationHeight}px`;
      });
    });
  }

  handleInteraction(event) {
    if (this.layout === 'mobile') {
      return;
    }

    if (event.type === 'focusin' || event.type === 'mouseenter') {
      this.refs.items.forEach(item => {
        if (item.contains(event.target) && item !== event.target) {
          item.classList.add('interact-within');
        } else if (item === event.target) {
          item.classList.remove('interact-within');
        }
      });
      return;
    }

    if (event.type === 'focusout' || event.type === 'mouseleave') {
      this.refs.items.forEach(item => {
        if (
          item.contains(event.target) &&
          (event.target.tagName === 'A' || event.target.tagName === 'UL')
        ) {
          item.classList.remove('interact-within');
        }
      });
    }
  }

  removeAttributes() {
    this.refs.dropdowns.forEach(el => {
      el.removeAttribute('role');
      el.removeAttribute('aria-expanded');
    });

    this.refs.menus.forEach(el => {
      el.removeAttribute('aria-hidden');
    });
  }

  setAttributes() {
    this.refs.dropdowns.forEach(el => {
      el.setAttribute('role', 'button');
      el.setAttribute('aria-expanded', 'false');
    });

    this.refs.menus.forEach(el => {
      el.setAttribute('aria-hidden', 'true');
    });
  }

  toggleSubmenu(event) {
    if (this.layout !== 'mobile') {
      return;
    }

    let dropdownIndex;

    this.refs.dropdowns.some((dropdown, index) => {
      if (dropdown.contains(event.target)) {
        dropdownIndex = index;

        return true;
      }
    });

    const selectedDropdown = this.refs.dropdowns[dropdownIndex];
    const selectedMenu = this.refs.menus[dropdownIndex];

    if (!selectedDropdown) {
      return;
    }

    event.preventDefault();

    const opened = selectedDropdown.getAttribute('aria-expanded') === 'true';

    selectedDropdown.setAttribute('aria-expanded', !opened);
    selectedMenu.setAttribute('aria-hidden', opened);

    this.animate(selectedMenu);
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

    if (value) {
      this.setAttributes();
    } else {
      this.removeAttributes();
    }

    this.animate(this.refs.navigation);
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
