@component($typeForm, get_defined_vars())
    <div data-controller="fields">
        <draggable v-model="list" item-key="name">
            <template #item="{element}">
                <field-item :item="element" />
            </template>
        </draggable>
    </div>
@endcomponent