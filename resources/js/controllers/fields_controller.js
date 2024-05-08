import { createApp } from 'vue'
import CreateFieldsPage from '../vue/pages/CreateFieldsPage.vue';

export default class extends window.Controller {
    connect() {
        this.app = createApp({
            components: {
                CreateFieldsPage
            },
        });

        this.app.mount(this.element);
    }

    disconnect() {
        this.app.unmount();
    }
}