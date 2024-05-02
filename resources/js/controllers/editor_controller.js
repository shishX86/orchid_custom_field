import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header'; 
import RawTool from '@editorjs/raw';
import SimpleImage from "@editorjs/simple-image";

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
                image: SimpleImage,
            }, 

            onChange: (api, event) => {
                editor.save().then((outputData) => {
                    document.getElementById(`${id}-input`).value = JSON.stringify(outputData)
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });
            }
        });

        // const btn = document.getElementById('editorjs-btn')
        
        // btn.addEventListener('click', () => {
        //     editor.save().then((outputData) => {
        //         document.getElementById('editorjs-input').value = JSON.stringify(outputData)
        //         console.log('Article data: ', outputData)
        //     }).catch((error) => {
        //         console.log('Saving failed: ', error)
        //     });
        // })
    }
}