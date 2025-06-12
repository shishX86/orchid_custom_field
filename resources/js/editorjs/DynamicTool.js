export default class DynamicTool {
    constructor({ data, api, config }) {
        this.api = api;
        this.data = data || {};
        this.config = config || {};
        
        // Сохраняем название блока в классе
        this.blockName = config.blockName || 'Динамический блок';
    }

    static get toolbox() {
        // Статический метод не имеет доступа к конфигу
        return {
            title: 'Динамический блок', // Заглушка, будет переопределено в конфиге
            icon: '<svg width="17" height="15" viewBox="0 0 17 15" xmlns="http://www.w3.org/2000/svg"><path d="M15 3V1H1V3H15ZM15 8V6H1V8H15ZM15 13V11H1V13H15Z"/></svg>'
        };
    }

    render() {
        const wrapper = document.createElement('div');
        wrapper.className = 'dynamic-tool';
        wrapper.innerHTML = `
            <div class="dynamic-tool-header">
                <h3>${this.blockName}</h3>
            </div>
            <div class="dynamic-tool-content">
                <pre>${JSON.stringify(this.config.content, null, 2)}</pre>
            </div>
        `;
        return wrapper;
    }

    save() {
        return {
            ...this.data,
            config: this.config
        };
    }
}