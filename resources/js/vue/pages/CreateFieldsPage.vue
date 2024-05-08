<script setup>
import { ref } from 'vue';
import draggable from 'vuedraggable';
import fieldItem from '../components/fields/FieldItem.vue';

const list = ref([
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
])
</script>

<template>
    <draggable v-model="list" item-key="name">
        <template #item="{ element }">
            <field-item :item="element" />
        </template>
    </draggable>
</template>