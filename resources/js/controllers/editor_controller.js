import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import RawTool from '@editorjs/raw';
import SimpleImage from "@editorjs/simple-image";
import DragDrop from 'editorjs-drag-drop';
import TestTool from './../editorjs/TestTool'
import RepeaterTool from './../editorjs/RepeaterTool'

export default class extends window.Controller {
    static values = {
        blocksData: Array
    }

    connect() {
        const id = this.data.get('containerId') ?? 'editorjs'
        const blocksData = this.blocksDataValue

        //TODO: Надо перебрать все блоки и добавить их в tools editorjs
        console.log('Blocks Data:', JSON.parse(blocksData[0]))

        const editor = new EditorJS({
            /**
             * Id of Element that should contain Editor instance
             */
            holder: id,

            tools: {
                paragraph: false,
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
            },

            defaultBlock: "repeater"
        });
    }
}