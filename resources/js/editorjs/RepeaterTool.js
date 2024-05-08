import Sortable from 'sortablejs/modular/sortable.complete.esm.js';

export default class RepeaterTool {
    static get toolbox() {
        return {
            title: 'ВДНХ. Список',
            icon: `
                <svg width="66" height="73" viewBox="0 0 66 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 23.139H65.6759V20.407H0V23.139Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M50.3148 28.1153H43.055V53.6578H39.5819V36.3271C39.5819 34.876 39.4979 33.9584 39.2254 33.0617C38.6994 31.2692 37.4778 29.3534 35.9424 28.5844C35.0154 28.1153 33.9429 27.9232 32.8275 27.9232C31.5237 27.9232 30.302 28.2005 29.272 28.8408C27.9032 29.6732 26.8509 31.4822 26.3678 33.2329C26.1365 34.0437 26.0731 34.9394 26.0731 36.3271V53.6578H22.6017V28.1153H15.3412V53.6578H11.9117L11.8688 28.1153H4.84029V53.6578H1.38948V28.1153H0V25.3833H65.6756V28.1153H64.2878V53.6578H60.837V28.1153H53.7656V53.6578H50.3148V28.1153Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.981301 16.1713L3.00141 13.4393L5.00092 16.1713L3.00141 18.9033L0.981301 16.1713Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1356 64.7651C11.3128 65.2777 12.3235 66.5161 12.3235 68.3086C12.3235 70.6139 11.0815 72.0859 9.5033 72.5341C8.53511 72.833 7.52604 72.833 6.6007 72.833H0.980621V57.2317H6.93662C7.67323 57.2317 8.49423 57.2523 9.3149 57.4663C10.725 57.8501 12.0288 59.0458 12.0288 61.2443C12.0288 63.2716 10.8928 64.2533 10.1356 64.659V64.7651ZM7.04096 63.9971C7.58949 63.9971 8.09321 63.9328 8.51451 63.6773C9.12453 63.3356 9.54615 62.6101 9.54615 61.5216C9.54615 60.4544 9.0408 59.7497 8.30386 59.4943C7.94766 59.3447 7.50543 59.3012 6.93662 59.3012H3.42236V63.9971H7.04096ZM9.77741 68.3086C9.77741 67.1773 9.23084 66.537 8.57796 66.2597C8.15667 66.0885 7.67323 66.046 7.25194 66.046H3.42236V70.7841H7.21072C7.67323 70.7841 8.11546 70.7416 8.47362 70.6139C9.29429 70.2931 9.77741 69.546 9.77741 68.3086Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0557 16.0643C12.5298 15.8722 12.151 15.3812 12.151 14.7844C12.151 14.037 12.7404 13.4391 13.498 13.4391C14.2346 13.4391 14.824 14.037 14.824 14.7844C14.824 15.3812 14.4658 15.8722 13.9399 16.0434L15.2234 18.6901H11.7722L13.0557 16.0643Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M31.8069 70.5491L30.1656 72.8325H14.7191L23.0942 57.2312H28.2292V70.6134L31.8069 70.5491ZM25.8303 70.7193V59.1305H24.2318L18.1493 70.7193H25.8303Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.5687 18.4942H43.022V15.7622H22.5687V18.4942Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28.7818 13.5184H37.0732V10.7865H28.7818V13.5184Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.7641 3.54408H35.8673V0.833008H29.7641V3.54408Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30.4184 5.80921H34.9214L32.6698 8.88255L30.4184 5.80921Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9959 57.2312V72.8329H45.5542V65.5973H37.7478V72.8329H35.3267V57.2312H37.7478V63.4632H45.5542V57.2312H47.9959Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M51.6587 16.0434C51.1328 15.8722 50.7746 15.3812 50.7746 14.7844C50.7746 14.037 51.364 13.4391 52.1009 13.4391C52.8582 13.4391 53.4476 14.037 53.4476 14.7844C53.4476 15.3812 53.0688 15.8722 52.5428 16.0643L53.8263 18.6901H50.3752L51.6587 16.0434Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M58.6768 66.4721L54.4481 72.8324H52.0064L57.5202 64.7864L52.2599 57.2311H55.1847L59.0143 62.7375L62.6535 57.2311H65.0112L60.1503 64.4023L66 72.8324H63.0958L58.6768 66.4721Z" fill="#FF3815"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M60.5105 16.1713L62.51 13.4393L64.5302 16.1713L62.51 18.9032L60.5105 16.1713Z" fill="#FF3815"/>
                </svg>
            `
        };
    }

    constructor({ data, api }) {
        this.data = data;
        this.api = api;
        this.wrapper = null;
        this.container = null;
        this.sortable = null;
        this.template = `
            <div class="vdnh-list__item">
                <div class="vdnh-list__cell vdnh-list__cell--img">
                    <div>
                        <input data-id="file" type="file" name="files[]">
                    </div>
                </div>
                <div class="vdnh-list__cell vdnh-list__cell--title">
                    <input data-id="name" placeholder="Введите имя" value="" type="text">
                </div>
                <div class="vdnh-list__cell vdnh-list__cell--link">
                    <input data-id="link" placeholder="Введите ccskre" value="" type="text">
                </div>
                <div class="vdnh-list__cell vdnh-list__cell--description">
                    <input data-id="description" placeholder="Описание" value="" type="text"/>
                </div>
                <div class="vdnh-list__cell vdnh-list__cell--btns">
                    <button class="vdnh-list__del" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    }

    render() {
        console.log(this.api.blocks.getCurrentBlockIndex())

        this.wrapper = document.createElement('div');
        this.wrapper.classList.add('vdnh-component');
        
        this.createList();
        this.createBtns();

        return this.wrapper;
    }

    createList() {
        this.container = document.createElement('div');
        this.container.classList.add('vdnh-list');
        this.wrapper.appendChild(this.container);
        this.sortable = Sortable.create(this.container);

        this.addRow();
    }

    addRow() {
        this.container.insertAdjacentHTML('beforeend', this.template)
        const row = this.container.lastElementChild
        const delBtn = row?.querySelector('.vdnh-list__del');
        const file = row?.querySelector('[data-id="file"]');

        if(!delBtn) return;

        delBtn.onclick = () => {
            row.remove();
        }

        file.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                const fileCont = row.querySelector('.vdnh-list__cell--img')
                const img = fileCont.querySelector('img')

                if(img) img.remove()

                fileCont.insertAdjacentHTML('beforeend', `
                    <img width="100" src="${URL.createObjectURL(e.target.files[0])}">
                `)
            }
        } 
    }

    createBtns() {
        const cont = document.createElement('div');

        cont.innerHTML = `
            <button type="button">Добавить</button>
        `

        this.wrapper.appendChild(cont);

        const btn = cont.querySelector('button');
        btn.onclick = () => this.addRow();
    }

    save(blockContent) {
        const els = blockContent.querySelectorAll('.vdnh-list__item')
        if(!els.length) return

        const output = [];
        els.forEach(el => {
            const name = el.querySelector('[data-id="name"]')?.value
            const link = el.querySelector('[data-id="link"]')?.value
            const description = el.querySelector('[data-id="description"]')?.value
            const file = el.querySelector('[data-id="file"]')?.value

            output.push({name, link, description, file})
        })

        return output
    }
}