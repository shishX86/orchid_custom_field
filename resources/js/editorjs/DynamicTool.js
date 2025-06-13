import { fieldComponents } from './Fields.js'
import Sortable from 'sortablejs';

export default class DynamicTool {
    constructor({ data, api, config }) {
        this.api = api;
        this.data = data || {};
        this.config = config || {};
        this.blockName = config.blockName || 'Блок';
    }

    static get toolbox() {
        return {
            title: 'Динамический блок',
            icon: '<svg>...</svg>'
        };
    }

    render() {
        const wrapper = document.createElement('div');
        wrapper.className = 'dynamic-block';

        // Обработка полей контента
        if (this.config.content) {
            this.config.content.forEach(field => {
                if (field.value === 'repeater') {
                    wrapper.appendChild(this.renderRepeater(field));
                } else {
                    wrapper.appendChild(this.renderField(field));
                }
            });
        }

        return wrapper;
    }

    renderRepeater(fieldConfig) {
        const repeaterWrapper = document.createElement('div');
        repeaterWrapper.className = 'repeater-field';

        // Заголовок повторяющегося поля
        const title = document.createElement('h4');
        title.textContent = fieldConfig.title;
        repeaterWrapper.appendChild(title);

        // Контейнер для элементов
        const itemsContainer = document.createElement('div');
        itemsContainer.className = 'repeater-items';

        // Инициализация данных (если их нет)
        this.data[fieldConfig.key] = this.data[fieldConfig.key] || { items: [] };

        // Рендер существующих элементов
        this.data[fieldConfig.key].items.forEach((item, index) => {
            itemsContainer.appendChild(
                this.renderRepeaterItem(fieldConfig, item, index)
            );
        });

        // Кнопка добавления (ТОЛЬКО ДЛЯ REPEATER)
        const addButton = document.createElement('button');
        addButton.className = 'repeater-add-btn';
        addButton.textContent = '+ Добавить элемент';
        addButton.addEventListener('click', () => {
            this.addRepeaterItem(fieldConfig, itemsContainer);
        });

        // Инициализация сортировки
        new Sortable(itemsContainer, {
            handle: '.drag-handle',
            animation: 150,
            onEnd: () => this.updateRepeaterOrder(fieldConfig, itemsContainer)
        });

        repeaterWrapper.appendChild(itemsContainer);
        repeaterWrapper.appendChild(addButton);

        return repeaterWrapper;
    }

    renderRepeaterItem(fieldConfig, itemData, index) {
        const itemWrapper = document.createElement('div');
        itemWrapper.className = 'repeater-item';

        // Кнопка перетаскивания
        const dragHandle = document.createElement('div');
        dragHandle.className = 'drag-handle';
        dragHandle.innerHTML = '☰';

        // Поля элемента
        const fieldsWrapper = document.createElement('div');
        fieldsWrapper.className = 'repeater-fields';

        fieldConfig.children?.forEach(childField => {
            fieldsWrapper.appendChild(
                this.renderField(childField, itemData[childField.key])
            );
        });

        // Кнопка удаления
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'repeater-delete-btn';
        deleteBtn.textContent = '×';
        deleteBtn.addEventListener('click', () => {
            this.data[fieldConfig.key].items.splice(index, 1);
            this.api.blocks.render();
        });

        itemWrapper.appendChild(dragHandle);
        itemWrapper.appendChild(fieldsWrapper);
        itemWrapper.appendChild(deleteBtn);

        return itemWrapper;
    }

    addRepeaterItem(fieldConfig, container) {
        const newItem = {};

        // Инициализация полей элемента
        fieldConfig.children?.forEach(child => {
            newItem[child.key] = this.getDefaultFieldValue(child.value);
        });

        if (!this.data[fieldConfig.key]) {
            this.data[fieldConfig.key] = { items: [] };
        }

        this.data[fieldConfig.key].items.push(newItem);
        container.appendChild(
            this.renderRepeaterItem(fieldConfig, newItem,
                this.data[fieldConfig.key].items.length - 1)
        );
    }

    updateRepeaterOrder(fieldConfig, container) {
        const newItems = Array.from(container.children)
            .map((_, index) => this.data[fieldConfig.key].items[index]);
        this.data[fieldConfig.key].items = newItems;
    }

    renderField(fieldConfig, fieldData = {}) {
        const fieldWrapper = document.createElement('div');
        fieldWrapper.className = `field field-${fieldConfig.value}`;

        const label = document.createElement('label');
        label.textContent = fieldConfig.data.name;

        console.log(fieldConfig)

        let input;

        switch (fieldConfig.value) {
            case 'text':
                input = document.createElement('input');
                input.type = 'text';
                input.value = fieldData.value || '';
                input.addEventListener('input', (e) => {
                    fieldData.value = e.target.value;
                });
                break;
            
            case 'textarea': 
                input = document.createElement('textarea');
                input.value = fieldData.value || '';
                input.addEventListener('textarea', (e) => {
                    fieldData.value = e.target.value;
                });
                break;

            // Добавьте другие типы полей по аналогии
            default:
                input = document.createElement('div');
                input.textContent = `Поле типа ${fieldConfig.value} не поддерживается`;
        }

        fieldWrapper.appendChild(label);
        fieldWrapper.appendChild(input);

        return fieldWrapper;
    }

    getDefaultFieldValue(type) {
        const defaults = {
            text: '',
            checkbox: false,
            number: 0
            // Добавьте значения по умолчанию для других типов
        };
        return { value: defaults[type] || null };
    }

    save() {
        return this.data;
    }
}