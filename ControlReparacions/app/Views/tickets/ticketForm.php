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
                    ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

        <button onclick="sendTicket()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.add") ?></button>
    </div>
    
</section>

<script>

    var count_ins = 0;

    function addLine() {

        let div = document.createElement('div');
        div.classList = 'ticket grid grid-cols-3 gap-x-2 gap-y-2'

        // Generacion de plantillas de elementos
        let div_input, input, label, error;

        error.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';

        // Input descripcion
        let div_input_desc = document.createElement('div');
        div_input_desc.classList = 'flex flex-col mt-5';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.description") ?>*';

        input_desc = document.createElement('input')
        input_desc.type = 'text';
        input_desc.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_desc.name = 'description';

        // Añadimos el label e input al div
        div_input_desc.appendChild(label);
        div_input_desc.appendChild(input_desc);

        <?php if (validation_errors()) : ?>
            // Comprobamos si hay errores
            error_desc = document.createElement('p');
            error_desc.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
            error_desc.innerText = '<?= validation_errors()['description'] ?>';
            // Añadimos los errores al div
            div_input_desc.appendChild(error_desc);
        <?php endif ?>

        // Añadimos todo al div del formulario
        div.appendChild(div_input_desc);

        // Input nombre contacto
        let div_input_nc = document.createElement('div');
        div_input_nc.classList = 'flex flex-col mt-5';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.contact_name") ?>*';
        
        input_nc = document.createElement('input')
        input_nc.type = 'text';
        input_nc.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_nc.name = 'nameContact';

        // Añadimos el label e input al div
        div_input_nc.appendChild(label);
        div_input_nc.appendChild(input_nc);

        <?php if (validation_errors()) : ?>
            // Comprobamos si hay errores
            error_nc = document.createElement('p');
            error_nc.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
            error_nc.innerText = '<?= validation_errors()['nameContact'] ?>';
            // Añadimos los errores al div
            div_input_nc.appendChild(error_nc);
        <?php endif ?>

        // Añadimos todo al div del formulario
        div.appendChild(div_input_nc);

        // Input email contacto
        let div_input_ec = document.createElement('div');
        div_input_ec.classList = 'flex flex-col mt-5';
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

        <?php if (validation_errors()) : ?>
            // Comprobamos si hay errores
            error_ec = document.createElement('p');
            error_ec.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
            error_ec.innerText = '<?= validation_errors()['emailContact'] ?>';
            // Añadimos los errores al div
            div_input_ec.appendChild(error_ec);
        <?php endif ?>

        // Añadimos todo al div del formulario
        div.appendChild(div_input_ec);

        // Select tipo dispositivo
        let div_input_td = document.createElement('div');
        div_input_td.classList = 'flex flex-col mt-5';
        label = document.createElement('label');
        label.innerText = '<?= lang("forms.s_disp") ?>*';
        
        let input_td = document.createElement('select');
        input_td.classList = 'border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_td.name = 'id_type';
        
        var option = document.createElement('option');
        option.value = '';
        option.disabled = true;
        option.selected = true;
        option.hidden = true;
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

        <?php if (validation_errors()) : ?>
            // Comprobamos si hay errores
            error_td = document.createElement('p');
            error_td.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
            error_td.innerText = '<?= validation_errors()['id_type'] ?>';
            // Añadimos los errores al div
            div_input_td.appendChild(error_td);
        <?php endif ?>

        // Añadimos todo al div del formulario
        div.appendChild(div_input_td);

        <?php if ((session()->get('user')['role']=="sstt") || (session()->get('user')['role']=="admin") ) : ?>

            // Select instituto emisor
            let div_input_ie = document.createElement('div');
            div_input_ie.classList = 'flex flex-col mt-5';
            
            label = document.createElement('label');
            label.innerText = '<?= lang("forms.s_ins") ?>';
            label.id = 'labelSender_' + count_ins;
            label.for = 'sender';
            label.classList = 'hidden';

            let button_ie =document.createElement('button');
            button_ie.type = "button";
            button_ie.id = 'assignSender_' + count_ins;
            button_ie.classList = "bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ie.innerText = '<?= lang("forms.s_ins") ?>';

            button_ie.addEventListener('click', () => {
                document.getElementById('labelSender_' + count_ins).style.display = 'block';
                document.getElementById('sender_' + count_ins).style.display = 'block';
                document.getElementById('assignSender_' + count_ins).style.display = 'none';
            });

            let input_ie = document.createElement('select');
            input_ie.classList = 'border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
            input_ie.id = 'sender_' + count_ins;
            input_ie.name = 'sender';

            option = document.createElement('option');
            option.value = '';
            option.disabled = true;
            option.selected = true;
            option.hidden = true;
            input_ie.appendChild(option);
            <?php foreach ($centers as $center): ?>
                option = document.createElement('option');
                option.value = '<?= $center["codi"] ?>';
                option.innerText = `<?= $center["nom"] ?>`;
                input_ie.appendChild(option);
            <?php endforeach; ?>

            // Añadimos el label e input al div
            div_input_ie.appendChild(button_ie);
            div_input_ie.appendChild(label);
            div_input_ie.appendChild(input_ie);
            div.appendChild(div_input_ie);

            // Select instituto reparador
            let div_input_ir = document.createElement('div');
            div_input_ir.classList = 'flex flex-col mt-5';
            
            label = document.createElement('label');
            label.innerText = '<?= lang("forms.s_ins") ?>';
            label.id = 'labelRepair_' + count_ins;
            label.for = 'repair';
            label.classList = 'hidden';

            let button_ir =document.createElement('button');
            button_ir.type = "button";
            button_ir.id = 'assignRepair_' + count_ins;
            button_ir.classList = "bg-primario text-white mt-[22px] px-2 py-3  hover:bg-terciario-4 border border-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250";
            button_ir.innerText = '<?= lang("forms.s_ins") ?>';

            button_ir.addEventListener('click', () => {
                document.getElementById('labelRepair_' + count_ins).style.display = 'block';
                document.getElementById('repair_' + count_ins).style.display = 'block';
                document.getElementById('assignRepair_' + count_ins).style.display = 'none';
            });

            let input_ir = document.createElement('select');
            input_ir.classList = 'border-2 hidden border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
            input_ir.id = 'repair_' + count_ins;
            input_ir.name = 'repair';

            option = document.createElement('option');
            option.value = '';
            option.disabled = true;
            option.selected = true;
            option.hidden = true;
            option.innerText = '<?= lang("forms.s_ins") ?>';
            input_ir.appendChild(option);
            <?php foreach ($repairs as $repair): ?>
                option = document.createElement('option');
                option.value = '<?= $repair["codi"] ?>';
                option.innerText = `<?= $repair["nom"] ?>`;
                input_ir.appendChild(option);
            <?php endforeach; ?>

            // Añadimos el label e input al div
            div_input_ir.appendChild(button_ir);
            div_input_ir.appendChild(label);
            div_input_ir.appendChild(input_ir);
            div.appendChild(div_input_ir);
        <?php endif ?>

        // Añadimos al formulario
        document.getElementById('ticketList').appendChild(div);

        count_ins++;
    }

    function sendTicket() {
        let tickets = document.getElementsByClassName('ticket');

        tickets.forEach(ticket => {
            
        });
    }

    document.addEventListener('DOMContentLoaded', function(){
        addLine();
    })
</script>

<?= $this->endSection() ?>
    