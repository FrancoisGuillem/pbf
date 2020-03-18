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

    this.data = {
      categories: [],
    };

    this.bind();
  }

  bind() {
    this.el.addEventListener('input', event => {
      this.setFilterState();
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

  setFilterState() {
    const categories = [];
    for (const el of this.el.elements) {
      if (el.checked) {
        categories.push(el.value);
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
