import Sortable from 'sortablejs';

// Базовые компоненты полей
export const fieldComponents = {
  text: ({ data, onChange }) => {
    const input = document.createElement('input');
    input.type = 'text';
    input.value = data.value || '';
    input.addEventListener('input', (e) => onChange({ value: e.target.value }));
    return input;
  },
  
  // Другие простые поля
  textarea: ({ data, onChange }) => {
    const textarea = document.createElement('textarea');
    textarea.value = data.value || '';
    textarea.addEventListener('input', (e) => onChange({ value: e.target.value }));
    return textarea;
  },
  
  checkbox: ({ data, onChange }) => {
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.checked = data.value || false;
    checkbox.addEventListener('change', (e) => onChange({ value: e.target.checked }));
    return checkbox;
  },
  
  // Специальные компоненты
  repeater: class RepeaterField {
    constructor({ data, config, onChange }) {
      this.data = data || { items: [] };
      this.fields = config.fields || [];
      this.onChange = onChange;
      this.wrapper = document.createElement('div');
    }

    render() {
      this.wrapper.innerHTML = '';
      
      // Кнопка добавления
      const addButton = document.createElement('button');
      addButton.textContent = 'Добавить элемент';
      addButton.className = 'repeater-add-btn';
      addButton.addEventListener('click', this.addItem.bind(this));
      
      // Контейнер для элементов
      const itemsContainer = document.createElement('div');
      itemsContainer.className = 'repeater-items';
      
      // Рендер существующих элементов
      this.data.items.forEach((item, index) => {
        itemsContainer.appendChild(this.renderItem(item, index));
      });
      
      // Инициализация сортировки
      new Sortable(itemsContainer, {
        handle: '.repeater-item-handle',
        animation: 150,
        onEnd: () => {
          const newItems = [...itemsContainer.children].map((_, i) => this.data.items[i]);
          this.data.items = newItems;
          this.onChange(this.data);
        }
      });
      
      this.wrapper.appendChild(itemsContainer);
      this.wrapper.appendChild(addButton);
      
      return this.wrapper;
    }

    renderItem(itemData, index) {
      const itemWrapper = document.createElement('div');
      itemWrapper.className = 'repeater-item';
      
      // Кнопка перетаскивания
      const handle = document.createElement('div');
      handle.className = 'repeater-item-handle';
      handle.innerHTML = '☰';
      
      // Контейнер полей
      const fieldsWrapper = document.createElement('div');
      fieldsWrapper.className = 'repeater-item-fields';
      
      // Рендер полей
      this.fields.forEach(field => {
        const fieldContainer = document.createElement('div');
        fieldContainer.className = 'repeater-field';
        
        const label = document.createElement('label');
        label.textContent = field.title;
        
        const input = fieldComponents[field.value]({
          data: itemData[field.key] || {},
          onChange: (newData) => {
            itemData[field.key] = { ...itemData[field.key], ...newData };
            this.onChange(this.data);
          }
        });
        
        fieldContainer.appendChild(label);
        fieldContainer.appendChild(input);
        fieldsWrapper.appendChild(fieldContainer);
      });
      
      // Кнопка удаления
      const deleteBtn = document.createElement('button');
      deleteBtn.textContent = '×';
      deleteBtn.className = 'repeater-item-delete';
      deleteBtn.addEventListener('click', () => {
        this.data.items.splice(index, 1);
        this.onChange(this.data);
        this.render();
      });
      
      itemWrapper.appendChild(handle);
      itemWrapper.appendChild(fieldsWrapper);
      itemWrapper.appendChild(deleteBtn);
      
      return itemWrapper;
    }

    addItem() {
      const newItem = {};
      this.fields.forEach(field => {
        newItem[field.key] = { value: null };
      });
      
      this.data.items.push(newItem);
      this.onChange(this.data);
      this.render();
    }
  },
  
  posttypes_list: ({ data, onChange }) => {
    const wrapper = document.createElement('div');
    
    // Загрузка типов постов (заглушка)
    const postTypes = [
      { id: 'news', name: 'Новости' },
      { id: 'articles', name: 'Статьи' }
    ];
    
    // Выбор количества
    const countWrapper = document.createElement('div');
    const countLabel = document.createElement('label');
    countLabel.textContent = 'Количество:';
    const countInput = document.createElement('input');
    countInput.type = 'number';
    countInput.value = data.count || 5;
    countInput.addEventListener('change', (e) => {
      onChange({ ...data, count: parseInt(e.target.value) });
    });
    
    // Выбор типов
    const typesWrapper = document.createElement('div');
    postTypes.forEach(postType => {
      const typeLabel = document.createElement('label');
      const typeCheckbox = document.createElement('input');
      typeCheckbox.type = 'checkbox';
      typeCheckbox.value = postType.id;
      typeCheckbox.checked = data.types?.includes(postType.id) || false;
      typeCheckbox.addEventListener('change', (e) => {
        const types = data.types || [];
        if (e.target.checked) {
          types.push(postType.id);
        } else {
          const index = types.indexOf(postType.id);
          if (index > -1) types.splice(index, 1);
        }
        onChange({ ...data, types });
      });
      
      typeLabel.appendChild(typeCheckbox);
      typeLabel.appendChild(document.createTextNode(postType.name));
      typesWrapper.appendChild(typeLabel);
    });
    
    countWrapper.appendChild(countLabel);
    countWrapper.appendChild(countInput);
    
    wrapper.appendChild(countWrapper);
    wrapper.appendChild(typesWrapper);
    
    return wrapper;
  }
};