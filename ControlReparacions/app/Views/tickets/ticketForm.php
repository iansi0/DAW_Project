<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div style="view-transition-name: addTicket;">

    <div>
        <div class="flex">

            <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.n_ticket")) ?></h1>

        </div>

        <!-- BOTONES -->
        <div class="flex justify-end align-middle pr-20">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <button onclick="sendTicket()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.save") ?></button>
        
        </div>
    </div>


    <div class="text-base">

        <!-- LIST TICKETS -->
        <form id="ticketList" action="add" method="POST" class="mt-4 flex flex-col gap-20 px-20">

        </form>
        
    </div>
</div>


<script>
    document.getElementById('submitButton').addEventListener('click', function() {

        event.preventDefault();

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

                    document.getElementById('form').submit();
                });
            }
        });
    });
</script>

<script>

    var count_ins = 0;

    function addLine() {

        event.preventDefault();

        count_ins++;

        let div = document.createElement('div');
        div.classList = 'ticket shadow-xl border-b border-primario rounded-t-xl';
        div.id = 'ticket_' + count_ins;

        let div_header = document.createElement('div');
        div_header.classList = 'col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4';

        let header = document.createElement('h2');
        header.id = 'header_' + count_ins;
        header.classList = 'text-2xl font-semibold';
        header.innerText = '<?=mb_strtoupper(lang('titles.ticket_2'))?> #'+count_ins;

        div_header.appendChild(header);
        div.appendChild(div_header)

        let div_form =document.createElement('div');
        div_form.classList = 'grid grid-cols-2-large-1-small mt-2 p-4';

        // Div que contiene la parte izquierda del formulario (datos de contacto)
        let row = document.createElement('div');
        row.classList = 'grid grid-cols-12 px-2';

        // Input nombre contacto
        let div_input_nc = document.createElement('div');
        div_input_nc.classList = 'col-span-12 text-left';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.contact_name")) ?>*';
        
        input_nc = document.createElement('input')
        input_nc.type = 'text';
        input_nc.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_nc.name = 'nameContact';

        // Añadimos el label e input al div
        div_input_nc.appendChild(label);
        div_input_nc.appendChild(input_nc);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_nc);
        div_form.appendChild(row);

        // Input email contacto
        let div_input_ec = document.createElement('div');
        div_input_ec.classList = 'col-span-12 mt-5 text-left';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.contact_email")) ?>*';

        input_ec = document.createElement('input')
        input_ec.type = 'text';
        input_ec.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_ec.name = 'emailContact';
        input_ec.type = 'email';

        // Añadimos el label e input al div
        div_input_ec.appendChild(label);
        div_input_ec.appendChild(input_ec);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_ec);
        div_form.appendChild(row);

        // Select tipo dispositivo
        let div_input_td = document.createElement('div');
        div_input_td.classList = 'col-span-12 mt-5 text-left';
        label = document.createElement('label');
        label.classList = 'font-semibold text-primario';
        label.innerText = '<?= mb_strtoupper(lang("forms.s_disp")) ?>*';
        
        let input_td = document.createElement('select');
        input_td.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
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
        row.appendChild(div_input_td);
        div_form.appendChild(row);
        
        // Div que contiene la parte central del formulario (descripcion)
        row = document.createElement('div');
        row.classList = 'grid grid-cols-12 px-2';

        // Input descripcion
        let div_input_desc = document.createElement('div');
        div_input_desc.classList = 'col-span-12';
        div_input_desc.style.position = 'relative';
        label = document.createElement('label');
        label.classList = 'text-terciario-4';
        label.style.position = 'absolute';
        label.style.top = '0';
        label.style.left = '5px';
        label.innerHTML = '<?= lang("forms.description") ?>* (<span id="char_'+count_ins+'">0</span>/200)';

        input_desc = document.createElement('textarea')
        input_desc.classList = 'border-2 border-terciario-1 h-full w-full pt-5 ps-2 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_desc.name = 'description';
        input_desc.id = 'description_'+count_ins;
        input_desc.setAttribute('maxlength', '200');
        input_desc.setAttribute('oninput', 'sumChar(' + count_ins + ')');

        // Añadimos el label e input al div
        div_input_desc.appendChild(label);
        div_input_desc.appendChild(input_desc);

        // Añadimos todo al div del formulario
        row.appendChild(div_input_desc);
        div_form.appendChild(row);

        // Div que contiene la parte derecha del formulario (botones)
        row = document.createElement('div');
        // row.classList = 'grid grid-cols-1';
        row.id = 'buttons';

        let div_btn_copy = document.createElement('div');
        div_btn_copy.classList = 'col-span-12 h-auto';

        // Añadimos los botones de copiar y añadir tiquet y eliminar tiquet
        let copy = document.createElement('button');
        copy.classList = 'rounded text-2xl mt-1 outline outline-orange-500 text-orange-500 w-full mx-1 transition hover:ease-in ease-out duration-250 hover:bg-orange-500 hover:text-white';
        copy.style = 'height: 50px;';
        copy.innerHTML = '<i class="fa-regular fa-copy"></i>';
        copy.id = 'c_ticket_' + count_ins;
        copy.setAttribute('onclick', 'copyTicket('+count_ins+')');

        div_btn_copy.appendChild(copy);

        row.appendChild(div_btn_copy);
        div_form.appendChild(row);

        let div_btn_add = document.createElement('div');
        div_btn_add.classList = 'col-span-12 h-auto';

        let add = document.createElement('button');
        add.classList = 'rounded text-2xl outline outline-blue-500 text-blue-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-blue-500 hover:text-white';
        add.style = 'height: 50px;';
        add.innerHTML = '<i class="fa-regular fa-add"></i>';
        add.id = 'a_ticket_' + count_ins;
        add.setAttribute('onclick', 'addLine('+count_ins+')');

        div_btn_add.appendChild(add);

        row.appendChild(div_btn_add);
        div_form.appendChild(row);

        if (document.getElementById('ticketList').childElementCount >= 1) {
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'col-span-12';

            let remove = document.createElement('button');
            remove.classList = 'rounded text-2xl outline outline-red-500 text-red-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 50px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_ticket_' + count_ins;
            remove.setAttribute('onclick', 'removeTicket('+count_ins+')');

            div_btn_remove.appendChild(remove);

            row.appendChild(div_btn_remove);
            div_form.appendChild(row);
        }

        <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>

            // Div que contiene los select de institutos
            row = document.createElement('div');
            row.classList = 'col-span-12 grid grid-cols-2-large-1-small';

            // Select instituto emisor
            let div_input_ie = document.createElement('div');
            div_input_ie.classList = 'pe-2 text-left ml-2 mt-2';
            
            let label_ie = document.createElement('label');
            label_ie.innerText = '<?= mb_strtoupper(lang("forms.s_ins")) ?>';
            label_ie.id = 'labelSender_' + count_ins;
            label_ie.for = 'sender_' + count_ins;
            label_ie.classList = 'hidden font-semibold text-primario';

            let button_ie = document.createElement('button');
            button_ie.type = "button";
            button_ie.id = 'assignSender_' + count_ins;
            button_ie.classList = "bg-primario text-white mt-[22px] px-2 py-3 w-full hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ie.innerText = '<?= lang("forms.s_ins") ?>';
            button_ie.setAttribute('onclick', 'showSender('+count_ins+')');

            let input_ie = document.createElement('select');
            input_ie.classList = 'border-2 hidden border-terciario-1 px-2 py-3 w-full rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
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
            row.appendChild(div_input_ie);

            // Select instituto reparador
            let div_input_ir = document.createElement('div');
            div_input_ir.classList = 'ps-2 text-left mt-2';
            
            let label_ir = document.createElement('label');
            label_ir.innerText = '<?= mb_strtoupper(lang("forms.s_ins") . ' ' . lang("forms.work")) ?>';
            label_ir.id = 'labelRepair_' + count_ins;
            label_ir.for = 'repair_' + count_ins;
            label_ir.classList = 'hidden font-semibold text-primario';

            let button_ir =document.createElement('button');
            button_ir.type = "button";
            button_ir.id = 'assignRepair_' + count_ins;
            button_ir.classList = "bg-primario text-white mt-[22px] px-2 py-3 w-full hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ir.innerText = '<?= lang("forms.s_ins") . ' ' . lang("forms.work") ?>';
            button_ir.setAttribute('onclick', 'showRepair('+count_ins+')');

            let input_ir = document.createElement('select');
            input_ir.classList = 'border-2 hidden border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
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
            row.appendChild(div_input_ir);
            div_form.appendChild(row);
        <?php endif ?>

        // Añadimos al formulario
        div.appendChild(div_form);
        document.getElementById('ticketList').prepend(div);
    }

    <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>

    function showSender(id){
        event.preventDefault();

        document.getElementById('labelSender_'+id).style.display = 'block';
        document.getElementById('sender_'+id).style.display = 'block';
        document.getElementById('assignSender_'+id).style.display = 'none';
    }

    function showRepair(id){
        event.preventDefault();

        document.getElementById('labelRepair_'+id).style.display = 'block';
        document.getElementById('repair_'+id).style.display = 'block';
        document.getElementById('assignRepair_'+id).style.display = 'none';
    }

    <?php endif; ?>

    function removeTicket(id){
        event.preventDefault();
        document.getElementById('ticket_' + id).remove();
    }

    function copyTicket(id_ticket){

        event.preventDefault();

        // Clonamos el ticket
        let old_div = document.getElementById('ticket_' + id_ticket);
        let new_div = document.getElementById('ticket_' + id_ticket).cloneNode(true);
        count_ins++;

        // Cambiamos todos los id para evitar conflictos
        new_div.id = 'ticket_'+count_ins;

        new_div.querySelector('#description_'+id_ticket).id = 'description_' + count_ins;
        new_div.querySelector('#description_'+count_ins).setAttribute('oninput', 'sumChar('+count_ins+')');
        new_div.querySelector('#char_'+id_ticket).id = 'char_' + count_ins;

        new_div.querySelector('#header_'+id_ticket).id = 'header_' + count_ins;
        new_div.querySelector('#header_'+count_ins).innerText = '<?=mb_strtoupper(lang('titles.ticket_2'))?> #'+count_ins;
        
        if (new_div.querySelector('#r_ticket_'+id_ticket)) {
            new_div.querySelector('#r_ticket_'+id_ticket).setAttribute('id', 'r_ticket_' + count_ins);
        } else {
            // Añadimos el boton de eliminar ticket
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'flex flex-col mt-3';

            let remove = document.createElement('button');
            remove.classList = 'rounded text-2xl outline outline-offset-1 outline-red-500 w-full text-red-500 mt-4 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 50px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_ticket_' + count_ins;
            remove.setAttribute('onclick', 'removeTicket('+count_ins+')');

            div_btn_remove.appendChild(remove);
            
            new_div.querySelector("#buttons").appendChild(div_btn_remove);
        }
        new_div.querySelector('#c_ticket_'+id_ticket).setAttribute('id', 'c_ticket_' + count_ins);

        // Obtenemos los valores de los select
        let val_td = old_div.querySelector('#id_type_'+id_ticket).value;

        <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>
            let val_ie = old_div.querySelector('#sender_'+id_ticket).value;
            let val_ir = old_div.querySelector('#repair_'+id_ticket).value;

            // Modificación de instituto emisor
            let label_ie = new_div.querySelector('#labelSender_'+id_ticket).setAttribute('id', 'labelSender_' + count_ins);
            let input_ie = new_div.querySelector('#sender_'+id_ticket);
            input_ie.setAttribute('id', 'sender_' + count_ins);
            input_ie.value = val_ie;
            let button_ie = new_div.querySelector('#assignSender_'+id_ticket).setAttribute('id', 'assignSender_' + count_ins);

            // Modificación de instituto reparador
            let label_ir = new_div.querySelector('#labelRepair_'+id_ticket).setAttribute('id', 'labelRepair_' + count_ins);
            let input_ir = new_div.querySelector('#repair_'+id_ticket);
            input_ir.setAttribute('id', 'repair_' + count_ins);
            input_ir.value = val_ir;
            let button_ir = new_div.querySelector('#assignRepair_'+id_ticket).setAttribute('id', 'assignRepair_' + count_ins);
        <?php endif; ?>

        // Modificación de tipo dispositivo
        let input_td = new_div.querySelector('#id_type_'+id_ticket);
        input_td.setAttribute('id', 'id_type_' + count_ins);
        input_td.value = val_td;

        document.getElementById('ticketList').prepend(new_div);
    }

    function sendTicket() {

        let error = false;

        event.preventDefault();

        // Eliminamos todos los mensajes de error
        let errors = document.querySelectorAll('.error');
        errors.forEach(error => {
            error.remove();
        })

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
                    error_msg.classList = 'error font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    input.parentElement.appendChild(error_msg);
                }
            });

            // Recorremos todos los textareas y obteniendo sus valores
            var textarea = ticket.querySelectorAll('textarea');
            var arrTextareas = [];
            textarea.forEach(textarea => {
                let name = textarea.name;
                let value = textarea.value;
                let tmp = {
                    [name]:value
                }
                arrTextareas.push(tmp);

                // Comprobación de textarea
                if (value == '' || value == null) {
                    error = true;
                    let error_msg = document.createElement('p');
                    error_msg.classList = 'error font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    textarea.parentElement.appendChild(error_msg);
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
                    error_msg.classList = 'error font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    select.parentElement.appendChild(error_msg);
                }
            });
            
            // Combinamos ambos arrays (inputs y selects) para formar un tiquet entero
            arrData = arrData.concat(arrSelects.concat(arrInputs.concat(arrTextareas)));

            // Añadimos el tiquet al array principal
            arrTickets.push(arrData);
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
                    var arrJSON = JSON.stringify(arrTickets);
                    console.log(arrJSON)
                    
                    // Creamos un formulario temporal
                    var form_tmp = document.createElement('form');
                    form_tmp.action = 'add';
                    form_tmp.method = 'POST';
                    form_tmp.style.display = 'none';
                    
                    // Creamos un input con los datos del JSON y lo añadimos al formulario anterior
                    let input_tmp = document.createElement('input');
                    input_tmp.type = 'hidden';
                    input_tmp.name = 'arrTickets';
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

    function sumChar(id){
        var spanElement = document.getElementById('char_' + id);
        spanElement.innerText = document.getElementById('description_'+id).value.length;
    }

    document.addEventListener('DOMContentLoaded', function(){
        addLine();

        document.getElementById('ticketList').addEventListener('keypress', function(event){
            if(event.keyCode == '13'){
                event.preventDefault();
            }
        })
    });
</script>

<?= $this->endSection() ?>
    