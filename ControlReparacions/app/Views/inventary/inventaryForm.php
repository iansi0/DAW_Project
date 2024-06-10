<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div style="view-transition-name: addInventary;">

    <div>
        <div class="flex">

            <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.n_inventory")) ?></h1>

        </div>

        <!-- BOTONES -->
        <div class="flex justify-end align-middle pr-20">

            <a href="<?= strpos(previous_url(), 'inventary?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/inventary');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <button onclick="sendInventory()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.save") ?></button>
        
        </div>
    </div>

    <div class="text-base">

        <!-- LIST TICKETS -->
        <form id="inventoryList" action="add" method="POST" class="mt-4 flex flex-col gap-20 px-20">

        </form>
        
    </div>

</div>

<script>
    var count_ins = 0;

    function addLine() {

        event.preventDefault();

        count_ins++;

        let div = document.createElement('div');
        div.classList = 'inventory shadow-xl border-b border-primario rounded-t-xl';
        div.id = 'inventory_' + count_ins;

        let div_header = document.createElement('div');
        div_header.classList = 'col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4';

        let header = document.createElement('h2');
        header.id = 'header_' + count_ins;
        header.classList = 'text-2xl font-semibold';
        header.innerText = '<?=mb_strtoupper(lang('titles.inventory_2'))?> #'+count_ins;

        div_header.appendChild(header);
        div.appendChild(div_header)

        let div_form =document.createElement('div');
        div_form.classList = 'grid grid-cols-12 mt-2 p-4';

        let row = document.createElement('div');
        row.classList = 'col-span-11 grid grid-cols-12 px-2';

        // Input nombre inventario
        let div_input_nc = document.createElement('div');
        div_input_nc.classList = 'col-span-12 pe-2 text-left';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.name")) ?>*';
        
        input_nc = document.createElement('input')
        input_nc.type = 'text';
        input_nc.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_nc.name = 'name';

        // Añadimos el label e input al div
        div_input_nc.appendChild(label);
        div_input_nc.appendChild(input_nc);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_nc);

        // Select tipo inventario
        let div_input_td = document.createElement('div');
        div_input_td.classList = 'col-span-4 pe-2 text-left mt-2';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.type_inventary")) ?>*';
        
        let input_td = document.createElement('select');
        input_td.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_td.name = 'id_type';
        input_td.id = 'id_type_' + count_ins;
        input_td.value = null;
        
        var option = document.createElement('option');
        option.value = null;
        option.disabled = true;
        option.selected = true;
        option.innerText = '<?= lang("forms.type_inventary") ?>';
        input_td.appendChild(option);
        <?php foreach ($types as $type): ?>
            option = document.createElement('option');
            option.value = '<?= $type["id"] ?>';
            option.innerText = '<?= $type["nom"] ?>';
            input_td.appendChild(option);
        <?php endforeach; ?>

        // Añadimos el label e input al div
        div_input_td.appendChild(label);
        div_input_td.appendChild(input_td);

        row.appendChild(div_input_td);

        // Input precio
        let div_input_ec = document.createElement('div');
        div_input_ec.classList = 'col-span-2 pe-2 text-left mt-2';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.price")) ?>*';

        input_ec = document.createElement('input')
        input_ec.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_ec.name = 'price';
        input_ec.type = 'number';
        input_ec.value = '1';

        // Añadimos el label e input al div
        div_input_ec.appendChild(label);
        div_input_ec.appendChild(input_ec);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_ec);

        // Input fecha compra
        let div_input_fc = document.createElement('div');
        div_input_fc.classList = 'col-span-4 pe-2 text-left mt-2';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.shop_date")) ?>*';

        input_fc = document.createElement('input')
        input_fc.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_fc.name = 'shop_date';
        input_fc.type = 'date';

        // Añadimos el label e input al div
        div_input_fc.appendChild(label);
        div_input_fc.appendChild(input_fc);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_fc);

        // Input Cantidad
        let div_input_q = document.createElement('div');
        div_input_q.classList = 'col-span-2 pe-2 text-left mt-2';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.quantity")) ?>*';

        input_q = document.createElement('input')
        input_q.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_q.name = 'quantity';
        input_q.type = 'number';
        input_q.min = '1';
        input_q.value = '1';

        // Añadimos el label e input al div
        div_input_q.appendChild(label);
        div_input_q.appendChild(input_q);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_q);

        div_form.appendChild(row);
        
        // Div que contiene la parte derecha del formulario (botones)
        row = document.createElement('div');
        row.classList = 'grid grid-cols-1';
        row.id = 'buttons';

        let div_btn_copy = document.createElement('div');
        div_btn_copy.classList = 'col-span-12 h-auto';

        // Añadimos los botones de copiar y añadir tiquet y eliminar tiquet
        let copy = document.createElement('button');
        copy.classList = 'rounded text-2xl mt-1 outline outline-orange-500 text-orange-500 w-full mx-1 transition hover:ease-in ease-out duration-250 hover:bg-orange-500 hover:text-white';
        copy.style = 'height: 50px;';
        copy.innerHTML = '<i class="fa-regular fa-copy"></i>';
        copy.id = 'c_inventory_' + count_ins;
        copy.setAttribute('onclick', 'copyInventory('+count_ins+')');

        div_btn_copy.appendChild(copy);

        row.appendChild(div_btn_copy);
        div_form.appendChild(row);

        let div_btn_add = document.createElement('div');
        div_btn_add.classList = 'col-span-12 h-auto';

        let add = document.createElement('button');
        add.classList = 'rounded text-2xl outline outline-blue-500 text-blue-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-blue-500 hover:text-white';
        add.style = 'height: 50px;';
        add.innerHTML = '<i class="fa-regular fa-add"></i>';
        add.id = 'a_inventory_' + count_ins;
        add.setAttribute('onclick', 'addLine('+count_ins+')');

        div_btn_add.appendChild(add);

        row.appendChild(div_btn_add);
        div_form.appendChild(row);

        if (document.getElementById('inventoryList').childElementCount >= 1) {
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'col-span-12';

            let remove = document.createElement('button');
            remove.classList = 'rounded text-2xl outline outline-red-500 text-red-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 50px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_inventory_' + count_ins;
            remove.setAttribute('onclick', 'removeInventory('+count_ins+')');

            div_btn_remove.appendChild(remove);

            row.appendChild(div_btn_remove);
            div_form.appendChild(row);
        }

        // Añadimos al formulario
        div.appendChild(div_form);
        document.getElementById('inventoryList').prepend(div);
    }

    function removeInventory(id){
        event.preventDefault();
        document.getElementById('inventory_' + id).remove();
    }

    function copyInventory(id_ticket){

        event.preventDefault();

        // Clonamos el ticket
        let old_div = document.getElementById('inventory_' + id_ticket);
        let new_div = document.getElementById('inventory_' + id_ticket).cloneNode(true);
        count_ins++;

        // Cambiamos todos los id para evitar conflictos
        new_div.id = 'inventory_'+count_ins;

        new_div.querySelector('#header_'+id_ticket).id = 'header_' + count_ins;
        new_div.querySelector('#header_'+count_ins).innerText = '<?=mb_strtoupper(lang('titles.inventory_2'))?> #'+count_ins;
        
        if (new_div.querySelector('#r_inventory_'+id_ticket)) {
            new_div.querySelector('#r_inventory_'+id_ticket).setAttribute('id', 'r_inventory_' + count_ins);
        } else {
            // Añadimos el boton de eliminar ticket
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'flex flex-col mt-3';

            let remove = document.createElement('button');
            remove.classList = 'rounded text-2xl outline outline-offset-1 outline-red-500 w-full text-red-500 mt-4 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 50px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_inventory_' + count_ins;
            remove.setAttribute('onclick', 'removeInventory('+count_ins+')');

            div_btn_remove.appendChild(remove);
            
            new_div.querySelector("#buttons").appendChild(div_btn_remove);
        }
        new_div.querySelector('#c_inventory_'+id_ticket).setAttribute('id', 'c_inventory_' + count_ins);

        // Obtenemos los valores de los select
        let val_td = old_div.querySelector('#id_type_'+id_ticket).value;

        // Modificación de tipo dispositivo
        let input_td = new_div.querySelector('#id_type_'+id_ticket);
        input_td.setAttribute('id', 'id_type_' + count_ins);
        input_td.value = val_td;

        document.getElementById('inventoryList').prepend(new_div);
    }

    function sendInventory() {

        let error = false;

        event.preventDefault();

        // Eliminamos todos los mensajes de error
        let errors = document.querySelectorAll('.error');
        errors.forEach(error => {
            error.remove();
        })
        
        // Obtenemos todos los elementos con clase ticket
        let inventories = document.querySelectorAll('.inventory');

        // Los vamos recorriendo y obteniendo los valores del input y añadiendolos a un array
        var arrInventory = [];
        inventories.forEach(inventory => {

            // Generamos el array que tendra los datos de cada tiquet
            let arrData = [];
            // Le añadimos el id_front del inventory
            arrData.push({id:inventory.id});

            // Recorremos todos los inputs y obteniendo sus valores
            var inputs = inventory.querySelectorAll('input');
            var arrInputs = [];
            inputs.forEach(input => {
                let name = input.name;
                let value = input.value;
                let tmp = {
                    [name]:value
                }
                arrInputs.push(tmp);

                // Comprobación de inputs
                if (value == '' || value == null || value == 0) {
                    error = true;
                    let error_msg = document.createElement('p');
                    error_msg.classList = 'error font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    input.parentElement.appendChild(error_msg);
                }
            });
            
            // Recorremos todos los selects y obteniendo sus valores
            var selects = inventory.querySelectorAll('select');
            var arrSelects = [];
            selects.forEach(select => {
                let name = select.name
                let value = select.value
                let tmp = {
                    [name]:value
                }
                arrSelects.push(tmp)

                // Comprobación de selects
                if (name == 'id_type' && (value == '' || value == null || value == 'null')) {
                    error = true;
                    let error_msg = document.createElement('p');
                    error_msg.classList = 'error font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    select.parentElement.appendChild(error_msg);
                }
            });
            
            // Combinamos ambos arrays (inputs y selects) para formar un tiquet entero
            arrData = arrData.concat(arrSelects.concat(arrInputs));

            // Añadimos el tiquet al array principal
            arrInventory.push(arrData);
        });

        if (!error) {
            Swal.fire({
                title: `<?= lang('alerts.sure') ?>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `<?= lang('alerts.yes_add') ?>`,
                cancelButtonText: `<?= lang('alerts.cancel') ?>`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `<?= lang('alerts.added') ?>`,
                        text: `<?= lang('alerts.added_sub') ?>`,
                        icon: 'success',
                        showConfirmButton: false,
                        timer:2000,
                    }).then(() => {
                        // Convertimos el array a JSON
                        var arrJSON = JSON.stringify(arrInventory);
                        console.log(arrJSON)

                        // Creamos un formulario temporal
                        var form_tmp = document.createElement('form');
                        form_tmp.action = 'add';
                        form_tmp.method = 'POST';
                        form_tmp.style.display = 'none';
                        
                        // Creamos un input con los datos del JSON y lo añadimos al formulario anterior
                        let input_tmp = document.createElement('input');
                        input_tmp.type = 'hidden';
                        input_tmp.name = 'arrInventory';
                        input_tmp.value = arrJSON;
                        form_tmp.appendChild(input_tmp);
                        
                        // Añadimos el formulario al documento y lo enviamos
                        document.body.appendChild(form_tmp);
                        form_tmp.submit();
                        
                        // Eliminamos el formulario para no dejar rastro
                        form_tmp.remove();

                    });
                }
            });
            
        }

    }
    
    document.addEventListener('DOMContentLoaded', function(){
        addLine();
    });
</script>


<?= $this->endSection() ?>