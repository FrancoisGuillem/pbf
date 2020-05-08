class Filter {
  constructor(el) {
    this.el = el;

    this.refs = {
      list: Array.from(
        document.querySelectorAll(
          `#${el.getAttribute('data-controls')} [data-category]`,
        ),
      ),
    };

    const categories = [];

    for (const el of this.el.elements) {
      if (el.checked) {
        categories.push(el.value);
      }
    }

    this.data = {
      categories,
    };

    this.bind();
  }

  bind() {
    this.el.addEventListener('input', event => {
      this.setFilterState(event.target);
    });
  }

  filter() {
    this.refs.list.forEach(el => {
      const category = el.getAttribute('data-category');
      el[
        this.categories.includes(category) ? 'removeAttribute' : 'setAttribute'
      ]('hidden', true);
    });
  }

  setFilterState(target) {
    const reverse = this.categories.length === this.refs.list.length;
    const categories = [];

    if (reverse) {
      for (const el of this.el.elements) {
        if (el.checked) {
          el.checked = false;
        } else {
          el.checked = true;
          categories.push(el.value);
        }
      }
    } else {
      for (const el of this.el.elements) {
        if (el.checked) {
          categories.push(el.value);
        }
      }
    }

    this.categories = categories;
  }

  set categories(value) {
    this.data.categories = value;

    this.filter();
  }

  get categories() {
    return this.data.categories;
  }
}

for (const el of document.querySelectorAll(
  'form.category-filters[data-controls]',
)) {
  new Filter(el);
}
