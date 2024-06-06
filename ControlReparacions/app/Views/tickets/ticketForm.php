<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_ticket") ?></h1>

<div class="flex content-start mt-16 ms-4">
    <button onclick="addLine()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-plus"></i></button>
</div>

<section style="view-transition-name: addTicket;" class="mx-auto px-4 py-8 text-base">

    <!-- LIST TICKETS -->
    <form id="ticketList" action="add" method="POST" class="flex flex-col gap-20">

    </form>
    
    <!-- botons -->
    <div class="flex mt-5 justify-end w-full">

        <a href="<?= strpos(previous_url(), 'tickets?') !== false
                        ? str_replace('index.php/', '', previous_url())
                        : base_url('/tickets');
                    ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

        <button onclick="sendTicket()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.add") ?></button>
    </div>
    
</section>

<script>

    var count_ins = 0;

    function addLine() {

        count_ins++;

        let div = document.createElement('div');
        div.classList = 'ticket grid grid-cols-3 gap-x-2';
        div.id = 'ticket_' + count_ins;

        // Input descripcion
        let div_input_desc = document.createElement('div');
        div_input_desc.classList = 'flex flex-col mt-2';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.description") ?>*';

        input_desc = document.createElement('input')
        input_desc.type = 'text';
        input_desc.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_desc.name = 'description';

        // Añadimos el label e input al div
        div_input_desc.appendChild(label);
        div_input_desc.appendChild(input_desc);

        // Añadimos todo al div del formulario
        div.appendChild(div_input_desc);

        // Input nombre contacto
        let div_input_nc = document.createElement('div');
        div_input_nc.classList = 'flex flex-col mt-2';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.contact_name") ?>*';
        
        input_nc = document.createElement('input')
        input_nc.type = 'text';
        input_nc.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_nc.name = 'nameContact';

        // Añadimos el label e input al div
        div_input_nc.appendChild(label);
        div_input_nc.appendChild(input_nc);

        // Añadimos todo al div del formulario
        div.appendChild(div_input_nc);

        // Input email contacto
        let div_input_ec = document.createElement('div');
        div_input_ec.classList = 'flex flex-col mt-2';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.contact_email") ?>*';

        input_ec = document.createElement('input')
        input_ec.type = 'text';
        input_ec.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_ec.name = 'emailContact';
        input_ec.type = 'email';

        // Añadimos el label e input al div
        div_input_ec.appendChild(label);
        div_input_ec.appendChild(input_ec);

        // Añadimos todo al div del formulario
        div.appendChild(div_input_ec);

        // Select tipo dispositivo
        let div_input_td = document.createElement('div');
        div_input_td.classList = 'flex flex-col mt-2';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.s_disp") ?>*';
        
        let input_td = document.createElement('select');
        input_td.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_td.name = 'id_type';
        input_td.id = 'id_type_' + count_ins;
        input_td.value = null;
        
        var option = document.createElement('option');
        option.value = null;
        option.disabled = true;
        option.selected = true;
        option.innerText = '<?= lang("forms.s_disp") ?>';
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

        // Añadimos todo al div del formulario
        div.appendChild(div_input_td);

        <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>

            // Select instituto emisor
            let div_input_ie = document.createElement('div');
            div_input_ie.classList = 'flex flex-col mt-2';
            
            let label_ie = document.createElement('label');
            label_ie.innerText = '<?= lang("forms.s_ins") ?>';
            label_ie.id = 'labelSender_' + count_ins;
            label_ie.for = 'sender_' + count_ins;
            label_ie.classList = 'hidden';

            let button_ie = document.createElement('button');
            button_ie.type = "button";
            button_ie.id = 'assignSender_' + count_ins;
            button_ie.classList = "bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ie.innerText = '<?= lang("forms.s_ins") ?>';
            button_ie.setAttribute('onclick', 'showSender(this)');

            let input_ie = document.createElement('select');
            input_ie.classList = 'border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
            input_ie.id = 'sender_' + count_ins;
            input_ie.name = 'sender';
            input_ie.value = null;

            option = document.createElement('option');
            option.value = null;
            option.disabled = true;
            option.selected = true;
            option.innerText = '<?= lang("forms.s_ins") ?>';
            input_ie.appendChild(option);
            <?php foreach ($centers as $center): ?>
                option = document.createElement('option');
                option.value = '<?= $center["codi"] ?>';
                option.innerText = `<?= $center["nom"] ?>`;
                input_ie.appendChild(option);
            <?php endforeach; ?>

            // Añadimos el label e input al div
            div_input_ie.appendChild(button_ie);
            div_input_ie.appendChild(label_ie);
            div_input_ie.appendChild(input_ie);
            div.appendChild(div_input_ie);

            // Select instituto reparador
            let div_input_ir = document.createElement('div');
            div_input_ir.classList = 'flex flex-col mt-2';
            
            let label_ir = document.createElement('label');
            label_ir.innerText = '<?= lang("forms.s_ins") . ' ' . lang("forms.work") ?>';
            label_ir.id = 'labelRepair_' + count_ins;
            label_ir.for = 'repair_' + count_ins;
            label_ir.classList = 'hidden';

            let button_ir =document.createElement('button');
            button_ir.type = "button";
            button_ir.id = 'assignRepair_' + count_ins;
            button_ir.classList = "bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ir.innerText = '<?= lang("forms.s_ins") . ' ' . lang("forms.work") ?>';
            button_ir.setAttribute('onclick', 'showRepair(this)');

            let input_ir = document.createElement('select');
            input_ir.classList = 'border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
            input_ir.id = 'repair_' + count_ins;
            input_ir.name = 'repair';
            input_ir.value = null;

            option = document.createElement('option');
            option.value = null;
            option.disabled = true;
            option.selected = true;
            option.innerText = '<?= lang("forms.s_ins") . ' ' . lang("forms.work") ?>';
            input_ir.appendChild(option);
            <?php foreach ($repairs as $repair): ?>
                option = document.createElement('option');
                option.value = '<?= $repair["codi"] ?>';
                option.innerText = `<?= $repair["nom"] ?>`;
                input_ir.appendChild(option);
            <?php endforeach; ?>

            // Añadimos el label e input al div
            div_input_ir.appendChild(button_ir);
            div_input_ir.appendChild(label_ir);
            div_input_ir.appendChild(input_ir);
            div.appendChild(div_input_ir);
        <?php endif ?>

        let div_btn_copy = document.createElement('div');
        div_btn_copy.classList = 'flex flex-col mt-3';

        // Añadimos los botones de copiar tiquet y eliminar tiquet
        let copy = document.createElement('button');
        copy.classList = 'outline outline-blue-500 text-blue-500  mx-1 transition hover:ease-in ease-out duration-250 hover:bg-blue-500 hover:text-white';
        copy.style = 'height: 35px;';
        copy.innerHTML = '<i class="fa-regular fa-copy"></i>';
        copy.id = 'c_ticket_' + count_ins;
        copy.setAttribute('onclick', 'copyTicket(this)');

        div_btn_copy.appendChild(copy);

        div.appendChild(div_btn_copy);

        if (document.getElementById('ticketList').childElementCount >= 1) {
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'flex flex-col mt-3';

            let remove = document.createElement('button');
            remove.classList = 'outline outline-red-500 text-red-500  mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 35px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_ticket_' + count_ins;
            remove.setAttribute('onclick', 'removeTicket(this)');

            div_btn_remove.appendChild(remove);

            div.appendChild(div_btn_remove);
        }

        // Añadimos al formulario
        document.getElementById('ticketList').appendChild(div);
    }

    function showSender(obj){
        event.preventDefault();
        let num = obj.id.replace('assignSender_', '');

        document.getElementById('labelSender_'+num).style.display = 'block';
        document.getElementById('sender_'+num).style.display = 'block';
        document.getElementById('assignSender_'+num).style.display = 'none';
    }

    function showRepair(obj){
        event.preventDefault();
        let num = obj.id.replace('assignRepair_', '');

        document.getElementById('labelRepair_'+num).style.display = 'block';
        document.getElementById('repair_'+num).style.display = 'block';
        document.getElementById('assignRepair_'+num).style.display = 'none';
    }

    function removeTicket(obj){
        event.preventDefault();
        let num = obj.id.replace('r_ticket_', '');
        document.getElementById('ticket_' + num).remove();
    }

    function copyTicket(obj){
        event.preventDefault();
        // Obtenemos el numero de ticket
        let num = obj.id.replace('c_ticket_', '');
        // Clonamos el ticket
        let old_div = document.getElementById('ticket_' + num);
        let new_div = document.getElementById('ticket_' + num).cloneNode(true);
        count_ins++;

        // Cambiamos todos los id para evitar conflictos
        new_div.id = 'ticket_'+count_ins;
        if (new_div.querySelector('#r_ticket_'+num)) {
            new_div.querySelector('#r_ticket_'+num).setAttribute('id', 'r_ticket_' + count_ins);
        } else {
            // Añadimos el boton de eliminar ticket
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'flex flex-col mt-3';

            let remove = document.createElement('button');
            remove.classList = 'outline outline-offset-1 outline-red-500 text-red-500  mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 35px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_ticket_' + count_ins;
            remove.setAttribute('onclick', 'removeTicket(this)');

            div_btn_remove.appendChild(remove);

            new_div.appendChild(div_btn_remove);
        }
        new_div.querySelector('#c_ticket_'+num).setAttribute('id', 'c_ticket_' + count_ins);

        // Obtenemos los valores de los select
        let val_ie = old_div.querySelector('#sender_'+num).value;
        let val_ir = old_div.querySelector('#repair_'+num).value;
        let val_td = old_div.querySelector('#id_type_'+num).value;

        // Modificación de instituto emisor
        let label_ie = new_div.querySelector('#labelSender_'+num).setAttribute('id', 'labelSender_' + count_ins);
        let input_ie = new_div.querySelector('#sender_'+num);
        input_ie.setAttribute('id', 'sender_' + count_ins);
        input_ie.value = val_ie;
        let button_ie = new_div.querySelector('#assignSender_'+num).setAttribute('id', 'assignSender_' + count_ins);

        // Modificación de instituto reparador
        let label_ir = new_div.querySelector('#labelRepair_'+num).setAttribute('id', 'labelRepair_' + count_ins);
        let input_ir = new_div.querySelector('#repair_'+num);
        input_ir.setAttribute('id', 'repair_' + count_ins);
        input_ir.value = val_ir;
        let button_ir = new_div.querySelector('#assignRepair_'+num).setAttribute('id', 'assignRepair_' + count_ins);

        // Modificación de tipo dispositivo
        let input_td = new_div.querySelector('#id_type_'+num);
        input_td.setAttribute('id', 'id_type_' + count_ins);
        input_td.value = val_td;

        document.getElementById('ticketList').appendChild(new_div);
    }

    function sendTicket() {

        let error = false;

        event.preventDefault();
        // Obtenemos todos los elementos con clase ticket
        let tickets = document.querySelectorAll('.ticket');

        // Los vamos recorriendo y obteniendo los valores del input y añadiendolos a un array
        var arrTickets = [];
        tickets.forEach(ticket => {

            // Generamos el array que tendra los datos de cada tiquet
            let arrData = [];
            // Le añadimos el id_front del ticket
            arrData.push({id:ticket.id});

            // Recorremos todos los inputs y obteniendo sus valores
            var inputs = ticket.querySelectorAll('input');
            var arrInputs = [];
            inputs.forEach(input => {
                let name = input.name;
                let value = input.value;
                let tmp = {
                    [name]:value
                }
                arrInputs.push(tmp);

                // Comprobación de inputs
                if (value == '' || value == null) {
                    error = true;
                    let error_msg = document.createElement('p');
                    error_msg.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    input.parentElement.appendChild(error_msg);
                }
            });
            
            // Recorremos todos los selects y obteniendo sus valores
            var selects = ticket.querySelectorAll('select');
            var arrSelects = [];
            selects.forEach(select => {
                let name = select.name
                let value = (select.value == 'null')?0:select.value;
                let tmp = {
                    [name]:value
                }
                arrSelects.push(tmp)

                // Comprobación de selects
                if (name == 'id_type' && (value == '' || value == null || value == 'null')) {
                    error = true;
                    let error_msg = document.createElement('p');
                    error_msg.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    select.parentElement.appendChild(error_msg);
                }
            });
            
            // Combinamos ambos arrays (inputs y selects) para formar un tiquet entero
            arrData = arrData.concat(arrSelects.concat(arrInputs));

            // Añadimos el tiquet al array principal
            arrTickets.push(arrData);
        });

        if (!error) {

            // Convertimos el array a JSON
            var arrJSON = JSON.stringify(arrTickets);
            console.log(arrJSON)

            // Creamos un formulario temporal
            var form_tmp = document.createElement('form');
            form_tmp.action = 'add';
            form_tmp.method = 'POST';
            form_tmp.style.display = 'none';

            // Creamos un input con los datos del JSON y lo añadimos al formulario anterior
            let inout_tmp = document.createElement('input');
            inout_tmp.type = 'hidden';
            inout_tmp.name = 'arrTickets';
            inout_tmp.value = arrJSON;
            form_tmp.appendChild(inout_tmp);

            // Añadimos el formulario al documento y lo enviamos
            document.body.appendChild(form_tmp);
            form_tmp.submit();

            form_tmp.remove();
            
        } else {
            console.log('no fino')
        }

    }

    document.addEventListener('DOMContentLoaded', function(){
        addLine();
    });
</script>

<?= $this->endSection() ?>
    