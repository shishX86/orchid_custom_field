@component($typeForm, get_defined_vars())
    <div data-controller="editor">
        <div id="{{$containerid}}"></div>
        <input name="{{$containerid}}" type="hidden" id="{{$containerid}}-input"></input>
    </div>
@endcomponent