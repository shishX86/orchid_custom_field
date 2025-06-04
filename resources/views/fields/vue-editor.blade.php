@component($typeForm, get_defined_vars())
    <div data-controller="fields" id="{{ $containerid }}">
        <create-fields-page :initial-data="{{ $initialData }}" />
    </div>
@endcomponent