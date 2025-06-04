<script setup>
import { ref, onMounted } from 'vue';
import { SlVueTreeNext } from 'sl-vue-tree-next'

const selectedField = ref('');
const slVueTree = ref();

const props = defineProps({
    initialData: {
        type: Array
    }
});

const fields = ref([
    { id: 1, value: 'text', title: 'Текстовое поле', isLeaf: true },
    { id: 2, value: 'quil', title: 'Визуальный редактор', isLeaf: true },
    { id: 3, value: 'editorjs', title: 'Блочный редактор', isLeaf: true },
    { id: 4, value: 'textarea', title: 'Область текста', isLeaf: true },
    { id: 5, value: 'link', title: 'Ссылка', isLeaf: true },
    { id: 6, value: 'phone', title: 'Телефон', isLeaf: true },
    { id: 7, value: 'email', title: 'Email', isLeaf: true },
    { id: 8, value: 'checkbox', title: 'Чекбокс', isLeaf: true },
    { id: 9, value: 'select', title: 'Выбор', isLeaf: true },
    { id: 10, value: 'image', title: 'Изображение', isLeaf: true },
    { id: 11, value: 'video', title: 'Видео', isLeaf: true },
    { id: 12, value: 'gallery', title: 'Галерея', isLeaf: true },
    { id: 13, value: 'map', title: 'Карта', isLeaf: true },
    { id: 14, value: 'group', title: 'Группа полей', isLeaf: false },
    { id: 15, value: 'repeater', title: 'Повторитель полей', isLeaf: false },
]);

const nodes = ref([]);
const isDropDownOpen = ref(false);


const addNewField = (field) => {
    nodes.value.push(field);
}

const selectField = () => {
    isDropDownOpen.value = !isDropDownOpen.value;
}

const remove = (node) => {
    slVueTree.value.remove([node.path]);
}

const inputKey = (node, e) => {
    slVueTree.value.updateNode({path:node.path, patch: {data: {key : e.target.value}}})
}

const inputName = (node, e) => {
    slVueTree.value.updateNode({path:node.path, patch: {data: {name : e.target.value}}})
}

onMounted(() => {
    nodes.value = props.initialData;
})

</script>

<template>
    <h2 class="b-title">Конструктор данных компонента</h2>

    <div class="b-field-add">
        <button type="button" @click="selectField" class="b-mainbtn b-field-add__btn">
            + добавить поле 
            <span class="b-mainbtn__arrow" :class="{'b-mainbtn__arrow--invert': isDropDownOpen}">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z" fill="#000000"/>
                </svg>
            </span>
        </button>

        <div class="b-field-add__menu" v-if="isDropDownOpen">
            <button 
                type="button" 
                @click="addNewField(field)" 
                class="b-mainbtn b-mainbtn--secondry b-mainbtn--small" 
                v-for="field in fields">

                {{ field.title }}
            </button>
        </div>
    </div>

    <sl-vue-tree-next ref="slVueTree" v-model="nodes" class="b-field-diplayer" v-if="nodes.length">
        <template #title="{ node }">
            <div 
                class="b-field-diplayer__node"
                :class="{ 'b-field-diplayer__node--group' : node.isLeaf}">

                <div class="b-field-diplayer__title">
                    {{ node.title }}
                </div>

                <div class="b-field-diplayer__inputs">
                    <input class="b-input" type="text" @input="inputName(node, $event)" :value="node.data.name" placeholder="Название">
                    <input class="b-input" type="text" @input="inputKey(node, $event)" :value="node.data.key" placeholder="Ключ поля">
                </div>

                <button type="button" @click="remove(node)" class="b-iconbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.646447 0.647423C0.841709 0.452161 1.15829 0.452161 1.35355 0.647423L5 4.29387L8.64645 0.647423C8.84171 0.452161 9.15829 0.452161 9.35355 0.647423C9.54881 0.842685 9.54881 1.15927 9.35355 1.35453L5.70711 5.00098L9.35355 8.64742C9.54881 8.84268 9.54881 9.15927 9.35355 9.35453C9.15829 9.54979 8.84171 9.54979 8.64645 9.35453L5 5.70808L1.35355 9.35453C1.15829 9.54979 0.841709 9.54979 0.646447 9.35453C0.451184 9.15927 0.451184 8.84268 0.646447 8.64742L4.29289 5.00098L0.646447 1.35453C0.451184 1.15927 0.451184 0.842685 0.646447 0.647423Z" fill="#262633"/>
                    </svg>
                </button>
            </div>
        </template>
    </sl-vue-tree-next>

    <div class="b-field-add__info" v-if="!nodes.length">
        Поля пока не добавлены
    </div>

    <input type="hidden" name="model[content]" :value="nodes ? JSON.stringify(nodes) : ''">
</template>

<style>
  .b-title {
    margin-bottom: 20px;
  }

  .sl-vue-tree-next {
        position: relative;
        cursor: default;
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none;
    }
    .sl-vue-tree-next-root.sl-vue-tree-next {
        margin-left: 0;
    }
    .sl-vue-tree-next-root > .sl-vue-tree-next-nodes-list {
        overflow: hidden;
        position: relative;
        padding-bottom: 4px;
    }
    .sl-vue-tree-next-selected > .sl-vue-tree-next-node-item .b-field-diplayer__node {
        background-color: #fff;
    }
    .sl-vue-tree-next-node-list {
        position: relative;
        display: flex;
        flex-direction: row;
    }
    .sl-vue-tree-next-node-item {
        position: relative;
        display: flex;
        flex-direction: row;
    }
    .sl-vue-tree-next-node-item.sl-vue-tree-next-cursor-inside {
        outline: 1px solid rgba(100, 100, 255, 0.5);
    }
    .sl-vue-tree-next-gap {
        min-height: 1px;
    }
    .sl-vue-tree-next-sidebar {
        margin-left: auto;
    }
    .sl-vue-tree-next-cursor {
        position: absolute;
        border: 1px solid #D3112B;
        height: 1px;
        width: 100%;
    }
    .sl-vue-tree-next-drag-info {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0.5;
        margin-left: 20px;
        margin-bottom: 20px;
        padding: 5px 10px;
    }

    .sl-vue-tree-next-title {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        z-index: 5;
        position: relative;
    }

    .sl-vue-tree-next-node {
        margin-bottom: 12px;
    }

    .sl-vue-tree-next-node-is-folder .sl-vue-tree-next-title {
        margin-bottom: 0;
    }

    .sl-vue-tree-next-toggle {
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
    }

    .sl-vue-tree-next {
        border-radius: 12px;

        padding: 17px 12px 1px 12px;
        border: none;
        /*border: 2px dashed #e1e1e4;*/
        margin-bottom: 12px;
        margin-left: 25px;
        background-color: rgba(0, 0, 10, 0.07);
    }

    .sl-vue-tree-next-node-is-leaf .sl-vue-tree-next-gap {
        display: none;
    }

    .sl-vue-tree-next-node-is-folder + .sl-vue-tree-next {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        margin-top: -5px;
    }

    .b-input {
        border: 1px solid #e1e1e4;
        border-radius: 7px;
        padding: 5px 10px;
    }

    .b-mainbtn {
        border: none;
        border-radius: 10px;
        background: #D3112B;
        color: #fff;
        height: 40px;
        padding: 0 20px;
        transition: transform .3s ease-in-out;
    }

    .b-mainbtn__arrow {
        position: relative;
    }
    
    .b-mainbtn__arrow > svg {
        transition: transform .2s ease-in-out;
    }

    .b-mainbtn__arrow > svg path {
        fill: #fff;
    }

    .b-mainbtn__arrow--invert > svg {
        transform: rotate(180deg);
    }

    .b-mainbtn:hover {
        transform: scale(1.1);
    }

    .b-mainbtn--secondry {
        background: transparent;
        border: 1px solid #D3112B;
        color: #D3112B;
    }

    .b-mainbtn--small {
        height: 30px;
    }

    /* NODE */
    .b-field-diplayer__node {
        padding: 12px;
        
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        gap: 12px;
        align-items: center;
        flex: 1;
        background: #fff;
        border-radius: 12px;
    }

    .b-field-diplayer__title {
        width: 175px;
    }

    .b-field-diplayer__inputs {
        flex: 1;
        display: flex;
        gap: 10px;
    }

    .b-field-diplayer__inputs .b-input {
        flex: 1;
    }

    .b-iconbtn {
        border: none;
        background: transparent;
        transition: transform .3s ease-in-out;
    }

    .b-iconbtn:hover {
        transform: scale(1.3);
    }

    .b-field-add {
        margin-bottom: 0px;
    }

    .b-field-add__btn {
        margin-bottom: 12px;
    }

    .b-field-add__menu {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        padding: 12px 12px 20px 12px;
        background-color: rgba(239, 239, 240, 1);
        border-radius: 10px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        margin-bottom: -12px;
        position: relative;
        z-index: 7;
    }

    .b-field-add__info {
        color: #676767;
        padding: 12px;
        background-color: rgba(239, 239, 240, 1);
        text-align: center;
        border-radius: 12px;
    }
</style>