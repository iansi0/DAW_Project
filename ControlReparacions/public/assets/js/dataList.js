/**
*
*    HTML SINTAXIS
*
*    <div class='relative [[CLASSNAME TO PASS BY PARAMS (ex. searchable-list)]]'>
*        <input type='text' class='[[CLASSNAME TO PASS BY PARAMS (ex. data-list)]] peer w-30 h-10 rounded-sm bg-white cursor-pointer outline-none text-gray-700
*                caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false"  placeholder="Select a fruit"></input>
*        <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]"
*        viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
*        xmlns:xlink="http://www.w3.org/1999/xlink">
*        <path d="M0 256l512 512L1024 256z"></path>
*        </svg>
*        <ul class='absolute [[CLASSNAME TO PASS BY PARAMS (ex. option-list)]] overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
*                left-0 max-w-[120%] min-w-[120%] bg-white rounded-sm   scale-0 opacity-0 
*                transition-all 
*                duration-200 origin-top-left'>
*        </ul>
*    </div>
*
*
*   JAVASCRIPT EXAMPLE USE
*
*   const dataList = new DataList('searchable-list', 'data-list', 'option-list', 'option');
*   dataList.init();
*   var array = ['Apple', 'Banana', 'Orange', 'Blueberry']
*   array.forEach(v=>(dataList.append(v)));
*
*   @see source: https://tailwindcomponents.com/component/custom-style-datalist
*
**/

const domParser = new DOMParser();

class DataList {

    // PARAMS ARE NOT LITERALLY ID. THEY ARE CLASSNAMES FOR NOT GETTING IDs REPEATED (see sintaxis above)
    constructor(div_id, input_id, list_id, option_id, custom_class = 'select-none break-words inline-block text-sm text-gray-500 bg-gray-100 odd:bg-gray-200 hover:bg-gray-300 hover:text-gray-700 transition-all duration-200 font-bold p-3 cursor-pointer max-w-full'){

        this.dataList = {
            
            // GETTING INPUT
            el:document.querySelector(`.${input_id}`),
            // GETTING LIST
            listEl:document.querySelector(`.${list_id}`),
            // GETTING DIV->ICON
            arrow:document.querySelector(`.${div_id}>svg`),
            // GETTING DEFAULT VALUE (default null)
            currentValue:null,
            // OPEN LIST (default false)
            listOpened:false,
            // OPTIONS TEMPLATE
            optionTemplate:
            `<li class='${option_id} ${custom_class}'>
                [[REPLACEMENT]]
            </li>`,
            optionElements:[],
            options:[]
            
        }

    }

    // ADD BLOCK OR HIDE IF THE ELEMENT IS SEARCHED
    find(str){
        for(let i = 0;i<this.dataList.options.length;i++){
            const option = this.dataList.options[i];
            if(!option.toLowerCase().includes(str.toLowerCase())){
                this.dataList.optionElements[i].classList.remove('block');
                this.dataList.optionElements[i].classList.add('hidden');
            }else{
                this.dataList.optionElements[i].classList.remove('hidden');
                this.dataList.optionElements[i].classList.add('block');
            }
        }
    }

    // REMOVE ANY ELEMENT
    remove(value){
        const foundIndex = this.dataList.options.findIndex(v=>v===value);
        if(foundIndex!==-1){
            this.dataList.listEl.removeChild(this.dataList.optionElements[foundIndex])
            this.dataList.optionElements.splice(foundIndex,1);
            this.dataList.options.splice(value,1);
        }
    }

    // APPEND ANY ELEMENT
    append(value){    
        if(!value || typeof value === 'object' || typeof value === 'symbol' || typeof value ==='function') return;
        value = value.toString().trim();
        if(value.length === 0) return; 
        if(this.dataList.options.includes(value)) return;

        const html = this.dataList.optionTemplate.replace('[[REPLACEMENT]]', value);
        const targetEle = domParser.parseFromString(html, "text/html").querySelector('li');
        targetEle.innerHTML = targetEle.innerHTML.trim();
        this.dataList.listEl.appendChild(targetEle);
        this.dataList.optionElements.push(targetEle);  
        this.dataList.options.push(value);

        // SET FIRST OPTION AS VALUE
        // if(!this.dataList.currentValue) this.setValue(value);

        targetEle.onmousedown = (e)=>{
            this.dataList.optionElements.forEach((el,index)=>{
                if(e.target===el){
                    this.setValue(this.dataList.options[index]);
                    this.hideList();
                    return;
                }
            })
        }
    }  

    // ADDING VALUE TO AN ELEMENT
    setValue(value){
        this.dataList.el.value = value;
        this.dataList.currentValue = value;
    }

    // SHOW OR HIDE LIST
    showList(){
        this.dataList.listOpened = true;
        this.dataList.listEl.classList.add('opacity-100');
        this.dataList.listEl.classList.remove('opacity-0');
        this.dataList.listEl.classList.add('scale-100');
        this.dataList.listEl.classList.remove('scale-0');
        this.dataList.arrow.classList.add("rotate-0");
    }
    hideList(){
        this.dataList.listOpened = false;
        this.dataList.listEl.classList.remove('opacity-100');
        this.dataList.listEl.classList.add('opacity-0');
        this.dataList.listEl.classList.remove('scale-100');
        this.dataList.listEl.classList.add('scale-0');
        this.dataList.arrow.classList.remove("rotate-0");
    }

    // DATALIST INITIALIZER
    init(){ 
        this.dataList.arrow.onclick = ()=>{
            this.dataList.listOpened ? this.hideList(): this.showList();
        } 
        this.dataList.el.oninput = (e)=>{
            this.find(e.target.value);
        }
        this.dataList.el.onclick= (el)=>{
            this.showList();
            for(let el of this.dataList.optionElements){
                el.classList.remove('hidden');
            }
        }
        this.dataList.el.onblur = (e)=>{
            this.hideList();
            this.setValue(this.dataList.currentValue);
        }
    }

}
