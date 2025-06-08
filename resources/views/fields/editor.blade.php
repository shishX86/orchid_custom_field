@component($typeForm, get_defined_vars())
    <div data-controller="editor" data-editor-blocks-data-value="{{$blocksData}}">
        <div id="{{$containerid}}"></div>
        <input name="{{$containerid}}" type="hidden" id="{{$containerid}}-input"></input>
    </div>
@endcomponent