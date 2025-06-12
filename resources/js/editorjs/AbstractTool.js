export default class AbstractTool {
    constructor({ data, config, api }) {
        console.log('Constructor data:', config); // Debug
        this.api = api;
        this.data = data || { items: [] };
        this.fields = config.fields || []; // Фиксированный набор полей
        this.wrapper = null;
    }

    render() {
        this.wrapper = document.createElement('div');
        this.renderItems();
        this.addAddButton();
        return this.wrapper;
    }

    renderItems() {
        console.log('Render items:', this.data.items)
        this.fields.forEach((field, index) => {
            const itemElement = this.renderItem(field, index);
            this.wrapper.appendChild(itemElement);
        });
    }

    renderItem(itemData, index) {
        const itemElement = document.createElement('div');
        itemElement.className = 'repeater-item';

        // Рендерим каждое поле из конфига
        this.fields.forEach(field => {
            const fieldElement = this.renderField(field, itemData, index);
            itemElement.appendChild(fieldElement);
        });

        // Кнопка удаления элемента
        const deleteButton = document.createElement('button');
        deleteButton.textContent = '×';
        deleteButton.onclick = () => this.deleteItem(index);
        itemElement.appendChild(deleteButton);

        return itemElement;
    }

    renderField(field, itemData, itemIndex) {
        const fieldWrapper = document.createElement('div');
        fieldWrapper.className = 'repeater-field';

        if (field.type === 'repeater') {
            // Рекурсивный рендер вложенного Repeater'а
            const nestedRepeater = new AbstractTool({
                data: { items: itemData[field.name] || [] },
                config: { fields: field.fields },
                api: this.api,
            });
            fieldWrapper.appendChild(nestedRepeater.render());
        } else {
            // Обычное поле (input, textarea и т.д.)
            const label = document.createElement('label');
            label.textContent = field.label || field.name;
            const input = document.createElement('input');
            input.type = field.type || 'text';
            input.value = itemData[field.name] || '';
            input.onchange = (e) => {
                this.data.items[itemIndex][field.name] = e.target.value;
            };
            fieldWrapper.appendChild(label);
            fieldWrapper.appendChild(input);
        }

        return fieldWrapper;
    }

    addAddButton() {
        const addButton = document.createElement('button');
        addButton.textContent = '+ Добавить элемент';
        addButton.onclick = () => this.addItem();
        this.wrapper.appendChild(addButton);
    }

    addItem() {
        const newItem = {};
        this.fields.forEach(field => {
            if (field.type === 'repeater') {
                newItem[field.name] = []; // Инициализируем вложенный Repeater
            } else {
                newItem[field.name] = ''; // Пустое значение для обычного поля
            }
        });
        this.data.items.push(newItem);
        this.wrapper.appendChild(this.renderItem(newItem, this.data.items.length - 1));
    }

    deleteItem(index) {
        this.data.items.splice(index, 1);
        this.rerender();
    }

    rerender() {
        this.wrapper.innerHTML = '';
        this.renderItems();
        this.addAddButton();
    }

    save() {
        return this.data;
    }
}