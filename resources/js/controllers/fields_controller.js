import {createApp} from 'vue'
import draggable from 'vuedraggable';
import fieldItem from './../vue/components/fields/FieldItem.vue';

export default class extends window.Controller {
    connect() {
        this.app = createApp({
            data() {
                return {
                    list: [
                        {
                          name: "task 1",
                          tasks: [
                            {
                              name: "task 2",
                              tasks: []
                            }
                          ]
                        },
                        {
                          name: "task 3",
                          tasks: [
                            {
                              name: "task 4",
                              tasks: []
                            }
                          ]
                        },
                        {
                          name: "task 5",
                          tasks: []
                        }
                      ]
                }
            },
            components: {
                draggable,
                fieldItem
            },
        });

        this.app.mount(this.element);
    }

    disconnect() {
        this.app.unmount();
    }
}