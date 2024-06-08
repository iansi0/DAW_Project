<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div style="view-transition-name: addTicket;" class="container mx-auto px-4 py-8 text-base">

    <div>
        <div class="flex">

            <h1 class="text-5xl text-primario"><?= mb_strtoupper(lang("titles.n_int")) ?></h1>

        </div>

        <!-- BOTONES -->
        <div class="flex justify-end align-middle pr-20">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <button onclick="sendIntervention()" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.save") ?></button>
        
        </div>
    </div>

    <!-- LISTADO INTERVENCIONES -->
    <form action="add" method="POST" class="mt-4 grid grid-cols-12 px-20">

        <div class="shadow-lg border-b border-primario rounded-t-xl mb-4 pb-2 col-span-12">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h1 class="text-2xl font-semibold"><?=mb_strtoupper(lang('titles.int_2'))?></h1>
            </div>

            <div class="grid grid-cols-12">
                <div class="col-span-8" style="position: relative;">
                    <label class="text-terciario-4" style="position: absolute; top: 0; left: 5px;"><?= lang("forms.description") ?>* (<span id="char_description">0</span>/100)</label>
                    <textarea id="description" maxlength="100" oninput="sumChar()" name="description" class="border-2 border-terciario-1 h-full w-full pt-5 ps-2 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></textarea>
                </div>

                <div id="interventionList" class="col-span-4 pl-3 p-1 overflow-auto" style="height: 260px">

                </div>
            </div>
        </div>
    
    </form>

</div>

<script>
    var count_ins = 0;

    function addLine() {

        event.preventDefault();

        count_ins++;

        let div = document.createElement('div');
        div.classList = 'intervention';
        div.id = 'intervention_' + count_ins;

        let div_form = document.createElement('div');
        div_form.classList = 'grid grid-cols-2-large-1-small p-1';

        // Div que contiene la parte izquierda del formulario (tipo inventario)
        var row = document.createElement('div');
        row.classList = 'col-span-12 grid grid-cols-12 px-1';

        // Select tipo inventario
        let div_input_td = document.createElement('div');
        div_input_td.classList = 'col-span-10 text-left';
        label = document.createElement('label');
        label.classList = 'text-primario font-semibold';
        label.innerText = '<?= mb_strtoupper(lang("titles.inventory_2")) ?> '+count_ins+'*';
        
        let input_td = document.createElement('select');
        input_td.classList = 'border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150';
        input_td.name = 'id_type';
        input_td.id = 'id_type_' + count_ins;
        input_td.setAttribute('onchange', 'disableInventory('+count_ins+')');
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

        // Añadimos todo al div del formulario
        row.appendChild(div_input_td);
        div_form.appendChild(row);

        // Añadimos los botones de añadir inventario y eliminar inventario
        if (document.getElementById('interventionList').childElementCount >= 1) {
            let div_btn_remove = document.createElement('div');
            div_btn_remove.classList = 'col-span-2 ml-1 h-auto';

            let remove = document.createElement('button');
            remove.classList = 'rounded text-2xl outline outline-red-500 text-red-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-red-500 hover:text-white';
            remove.style = 'height: 50px;';
            remove.innerHTML = '<i class="fa-solid fa-trash"></i>';
            remove.id = 'r_intervention_' + count_ins;
            remove.setAttribute('onclick', 'removeIntervention('+count_ins+')');

            div_btn_remove.appendChild(remove);

            row.appendChild(div_btn_remove);
            div_form.appendChild(row);
        } else {
            let div_btn_add = document.createElement('div');
            div_btn_add.classList = 'col-span-2 ml-1 h-auto';

            let add = document.createElement('button');
            add.classList = 'rounded text-2xl outline outline-blue-500 text-blue-500 w-full mt-6 mx-1 transition hover:ease-in ease-out duration-250 hover:bg-blue-500 hover:text-white';
            add.style = 'height: 50px;';
            add.innerHTML = '<i class="fa-regular fa-add"></i>';
            add.id = 'a_intervention_' + count_ins;
            add.setAttribute('onclick', 'addLine('+count_ins+')');

            div_btn_add.appendChild(add);

            row.appendChild(div_btn_add);
            div_form.appendChild(row);
        }

        // Añadimos al formulario
        div.appendChild(div_form);
        document.getElementById('interventionList').append(div);

        disableInventory();
    }

    function removeIntervention(id){
        event.preventDefault();
        document.getElementById('intervention_' + id).remove();
    }

    function sendIntervention() {

        let error = false;

        event.preventDefault();

        // Obtenemos todos los elementos con clase intervention
        let interventions = document.querySelectorAll('.intervention');

        // Los vamos recorriendo y obteniendo los valores del input y añadiendolos a un array
        var arrInterventions = [];
        interventions.forEach(intervention => {

            // Generamos el array que tendra los datos de cada tiquet
            let arrData = [];
            // Le añadimos el id_front del intervention
            arrData.push({id:intervention.id});
            
            // Recorremos todos los selects y obteniendo sus valores
            var selects = intervention.querySelectorAll('select');
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
                    error_msg.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
                    error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
                    select.parentElement.appendChild(error_msg);
                }
            });
            
            // Combinamos ambos arrays (inputs y selects) para formar un tiquet entero
            arrData = arrData.concat(arrSelects);

            // Añadimos el tiquet al array principal
            arrInterventions.push(arrData);
        });

        // Obtenemos el valor del textarea (descripcion)
        var textarea = document.getElementById('description');
        var arrTextareas = [];
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
            error_msg.classList = 'font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300';
            error_msg.innerText = '<?=lang('error.empty_slot_2')?>';
            textarea.parentElement.appendChild(error_msg);
        }

        // Añadimos el array de textareas al array de datos
        var arrFinal = [];
        arrFinal.push(arrInterventions);
        arrFinal.push(arrTextareas);

        if (!error) {

            // Convertimos el array a JSON
            var arrJSON = JSON.stringify(arrFinal);

            // Creamos un formulario temporal
            var form_tmp = document.createElement('form');
            form_tmp.action = 'add';
            form_tmp.method = 'POST';
            form_tmp.style.display = 'none';

            // Creamos un input con los datos del JSON y lo añadimos al formulario anterior
            let input_tmp = document.createElement('input');
            input_tmp.type = 'hidden';
            input_tmp.name = 'arrInterventions';
            input_tmp.value = arrJSON;
            form_tmp.appendChild(input_tmp);

            let id_tmp = document.createElement('input');
            id_tmp.type = 'hidden';
            id_tmp.name = 'id_ticket';
            id_tmp.value = '<?=$id_ticket?>';
            form_tmp.appendChild(id_tmp);

            // Añadimos el formulario al documento y lo enviamos
            document.body.appendChild(form_tmp);
            form_tmp.submit();

            // Eliminamos el formulario para no dejar rastro
            form_tmp.remove();
            
        }

    }

    function disableInventory(){
        let arrSelectInventory = document.getElementsByName('id_type');

        // Primero obtenemos los valores de todos los select
        let arrSelectValue = [];
        arrSelectInventory.forEach(inventario => {
            arrSelectValue.push(inventario.value)
        })

        // Luego en todos los selects vamos marcando en disabled la opcion
        arrSelectInventory.forEach(inventario => {
            let opciones = inventario.querySelectorAll('option');
            opciones.forEach(opcion => {
                if (arrSelectValue.includes(opcion.value)) {
                    opcion.setAttribute('disabled', '');
                } else {
                    opcion.removeAttribute('disabled')
                }
            })
        })
    }
    
    function sumChar(){
        var spanElement = document.getElementById('char_description');
        spanElement.innerText = document.getElementById('description').value.length;
    }

    document.addEventListener('DOMContentLoaded', function(){
        addLine();
    });
</script>

<?= $this->endSection() ?>