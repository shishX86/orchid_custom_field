<script setup>
import { ref } from 'vue';
import { SlVueTreeNext } from 'sl-vue-tree-next'

const selectedField = ref('');
const slVueTree = ref();

const fields = ref([
    { id: 1, value: 'text', title: 'Текстовое поле', isLeaf: true },
    { id: 2, value: 'textarea', title: 'Область текста', isLeaf: true },
    { id: 3, value: 'quil', title: 'Визуальный редактор', isLeaf: true },
    { id: 4, value: 'editorjs', title: 'Блочный редактор', isLeaf: true },
    { id: 5, value: 'image', title: 'Изображение', isLeaf: true },
    { id: 6, value: 'gallery', title: 'Галерея', isLeaf: true },
    { id: 7, value: 'phone', title: 'Телефон', isLeaf: true },
    { id: 8, value: 'email', title: 'Email', isLeaf: true },
    { id: 9, value: 'map', title: 'Карта', isLeaf: true },
    { id: 10, value: 'repeater', title: 'Повторитель полей', isLeaf: false },
    { id: 11, value: 'group', title: 'Группа полей', isLeaf: false },
]);

const nodes = ref([]);

const add = () => {
    const field = fields.value.find((item) => item.id === selectedField.value);
    if(!field) return;

    nodes.value.push(field);
    selectedField.value = '';
}

const remove = (node) => {
    console.log(node.path)
    slVueTree.value.remove([node.path]);
}
</script>

<template>
    <h2 class="b-title">Конструктор компонента</h2>

    <div class="b-field-selecter">
        <div class="b-field-selecter__cont">
            <select 
                class="b-field-selecter__select" 
                v-model="selectedField">
    
                <option value="" disabled selected>
                    Выберите поле и нажмите добавить
                </option>
    
                <option :value="item.id" v-for="item in fields">
                    {{ item.title }}
                </option>
            </select>
        </div>

        <button type="button" @click="add" class="b-mainbtn">
            Добавить
        </button>
    </div>

    <sl-vue-tree-next ref="slVueTree" v-model="nodes" class="b-field-diplayer">
        <template #title="{ node }">
            <div 
                class="b-field-diplayer__node"
                :class="{ 'b-field-diplayer__node--group' : node.isLeaf}">

                <div class="b-field-diplayer__title">
                    {{ node.title }}
                </div>

                <button type="button" @click="remove(node)" class="b-iconbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.646447 0.647423C0.841709 0.452161 1.15829 0.452161 1.35355 0.647423L5 4.29387L8.64645 0.647423C8.84171 0.452161 9.15829 0.452161 9.35355 0.647423C9.54881 0.842685 9.54881 1.15927 9.35355 1.35453L5.70711 5.00098L9.35355 8.64742C9.54881 8.84268 9.54881 9.15927 9.35355 9.35453C9.15829 9.54979 8.84171 9.54979 8.64645 9.35453L5 5.70808L1.35355 9.35453C1.15829 9.54979 0.841709 9.54979 0.646447 9.35453C0.451184 9.15927 0.451184 8.84268 0.646447 8.64742L4.29289 5.00098L0.646447 1.35453C0.451184 1.15927 0.451184 0.842685 0.646447 0.647423Z" fill="#262633"/>
                    </svg>
                </button>
            </div>
        </template>
    </sl-vue-tree-next>
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
        background-color: #e1e1e4;
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
        width: 20px;
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
        margin-bottom: 12px;
    }

    .sl-vue-tree-next-toggle {
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
    }

    .sl-vue-tree-next {
        border-radius: 12px;
        padding: 12px;
        padding-bottom: 0;
        border: 2px dashed #e1e1e4;
        margin-bottom: 12px;
        margin-left: 25px;
    }

    .sl-vue-tree-next-node-is-leaf .sl-vue-tree-next-gap {
        display: none;
    }

    /* SELECT */
    .b-field-selecter {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .b-field-selecter__cont {
        padding-right: 12px;
        background-color: #EFF2F7;
        border-radius: 10px;
        transition: background-color .3s ease-in-out;
    }

    .b-field-selecter__cont:hover {
        background-color: #e6e9ed;
    }

    .b-field-selecter__select {
        border: none;
        cursor: pointer;
        background-color: transparent;
        padding: 12px 5px 12px 12px;
    }

    .b-mainbtn {
        border: none;
        border-radius: 10px;
        background: #D3112B;
        color: #fff;
        padding: 0 20px;
    }

    /* NODE */
    .b-field-diplayer__node {
        padding: 12px;
        border: 1px solid #e1e1e4;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        gap: 12px;
    }

    .b-iconbtn {
        border: none;
        background: transparent;
    }

</style>