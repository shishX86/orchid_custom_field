import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import RawTool from '@editorjs/raw';
import SimpleImage from "@editorjs/simple-image";
import DragDrop from 'editorjs-drag-drop';
import TestTool from './../editorjs/TestTool'
import RepeaterTool from './../editorjs/RepeaterTool'

export default class extends window.Controller {
    connect() {
        const id = this.data.get('containerId') ?? 'editorjs'

        const editor = new EditorJS({
            /**
             * Id of Element that should contain Editor instance
             */
            holder: id,

            tools: {
                header: {
                    class: Header,
                    inlineToolbar: ['link']
                },
                raw: RawTool,
                image: TestTool,
                repeater: RepeaterTool
            },

            onReady: () => {
                new DragDrop(editor);
            },

            onChange: (api, event) => {
                editor.save().then((outputData) => {
                    document.getElementById(`${id}-input`).value = JSON.stringify(outputData)
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });
            }
        });
    }
}