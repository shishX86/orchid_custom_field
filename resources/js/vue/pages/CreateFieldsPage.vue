<script setup>
import { ref } from 'vue';
import { SlVueTreeNext } from 'sl-vue-tree-next'

const selectedField = ref();

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
}
</script>

<template>
    <h2>Конструктор полей</h2>

    <div>
        <select v-model="selectedField">
            <option :value="item.id" v-for="item in fields">
                {{ item.title }}
            </option>
        </select>

        <button type="button" @click="add">
            Добавить
        </button>
    </div>


    <sl-vue-tree-next v-model="nodes">
        <template #title="{ node }">
            <span class="fa fa-file" v-if="node.isLeaf">Поле</span>
            <span class="fa fa-folder" v-if="!node.isLeaf">Группа</span>
            {{ node.title }}
        </template>
    </sl-vue-tree-next>
</template>

<style>
  @import 'sl-vue-tree-next/sl-vue-tree-next-minimal.css';
</style>