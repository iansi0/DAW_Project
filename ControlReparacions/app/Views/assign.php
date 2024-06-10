<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="flex justify-between items-center mb-1">
    <h1 class="text-left text-5xl text-primario"> <?= strtoupper(lang('titles.assign').' '.lang("titles.$filter")) ?></h1>
</div>

<main class="flex gap-7 py-1 ">

    <article class="flex flex-col gap-2 w-full">

        <div>
            <div class="flex justify-between w-auto items-center text-center  text-primario pr-8 rounded-t-2xl">
                <div class="flex align-left mb-1">
                    <h1 class="text-2xl"><?= lang('forms.assign_to') ?>: &nbsp; </h1>

                    <div class='flex align-left relative searchable-device-list'>
                        <input id="institute" name="d" type='text' class='data-device-list peer w-full h-8 rounded-sm bg-secundario cursor-pointer outline-none text-primario
                          caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false" placeholder="<?= lang('forms.s_ins') ?>">
                        <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M0 256l512 512L1024 256z"></path>
                        </svg>
                        <ul class='absolute option-device-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
                          left-0 w-full bg-secundario rounded-sm scale-0 opacity-0 
                          transition-all 
                          duration-200 origin-top-left'>
                        </ul>
                    </div>
                   
                    <button onclick="assignIns()"  class="bg-primario text-white px-8 text-base ml-2.5 py-1 border border-terciario-4 font-semibold hover:bg-terciario-4 cursor-pointer hover:text-secundario rounded-lg transition hover:ease-in ease-out duration-250"><?= lang('forms.apply') ?></button>
                </div>

                <div class="flex text-4xl align-right gap-1">
                    <a class="transition hover:ease-in ease-out duration-250 pb-1 <?= $filter == 'sender' ? "bg-primario rounded-t-lg text-white px-4" : "border border-primario rounded-t-lg px-4" ?>" href="<?= base_url('assign/filterSender') ?>"><?= lang('titles.sender') ?></a>
                    <a class="transition hover:ease-in ease-out duration-250 pb-1 <?= $filter == 'receiver' ? "bg-primario rounded-t-lg text-white px-4" : "border border-primario rounded-t-lg px-4" ?>" href="<?= base_url('assign/filterReceiver') ?>"><?= lang('titles.receiver') ?></a>
                </div>
            </div>

            <?php
            echo $table->generate();
            ?>
            <div class="border-b border-primario"></div>
        </div>
        <br><br><br>
    </article>
</main>

<script src="/assets/js/dataList.js"></script>

<script>
    // CREADOR DE DATALIST DISPOSITIVOS
    const dataList_device = new DataList('searchable-device-list', 'data-device-list', 'option-device-list', 'option-device');
    // Inicializamos
    dataList_device.init();
    // Generamos el array de opciones 
    var devicesJSON = `<?php echo json_encode($institutes) ?>`;
    var devices = JSON.parse(devicesJSON);
    var arrDevices = [];
    devices.forEach(element => {
        arrDevices.push(element['nom'] + " (" + element['codi'] + ")")
    });
    // Añadimos cada elemento al dataList_device
    arrDevices.forEach(v => (dataList_device.append(v)));

    var selectedIds = [];

    document.addEventListener('DOMContentLoaded', (event) => {
        const masterCheckbox = document.getElementById('all');
        const subCheckboxes = document.querySelectorAll('.subCheckbox');

        masterCheckbox.addEventListener('change', () => {
            const isChecked = masterCheckbox.checked;
            selectedIds = [];
            subCheckboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
                if (isChecked) {
                    selectedIds.push(checkbox.id);
                }
            });
            console.log(selectedIds);
        });

        subCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                if (!checkbox.checked) {
                    masterCheckbox.checked = false;
                    const index = selectedIds.indexOf(checkbox.id);
                    if (index > -1) {
                        selectedIds.splice(index, 1);
                    }
                } else {
                    if (!selectedIds.includes(checkbox.id)) {
                        selectedIds.push(checkbox.id);
                    }
                    const allChecked = Array.from(subCheckboxes).every((checkbox) => checkbox.checked);
                    masterCheckbox.checked = allChecked;
                }
                console.log(selectedIds);
            });
        });
    });

    function assignIns() {
        let error = false;
        event.preventDefault();

        ins = document.getElementById('institute').value;
        console.log(selectedIds);

        if (selectedIds.length == 0) {
            error = true;
            Swal.fire({
                icon: "error",
                title: "<?= lang('alerts.ticket_not') ?>",
                text: "<?= lang('alerts.ticket_not_sub') ?>",
                confirmButtonColor: '#003049',
            });
        }
        console.log(ins);
        if (ins == '') {
            error = true;
            Swal.fire({
                icon: "error",
                title: "<?= lang('alerts.ins_not') ?>",
                text: "<?= lang('alerts.ins_not_sub') ?>",
                confirmButtonColor: '#003049',
            });
        }

        if (!error) {
            Swal.fire({
                title: `<?= lang('alerts.sure') ?>`,
                text: `<?= lang('alerts.sure_sub') ?>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `<?= lang('alerts.yes_ass') ?>`,
                cancelButtonText: `<?= lang('alerts.cancel') ?>`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({

                        title: `<?= lang('alerts.assigned') ?>`,
                        text: `<?= lang('alerts.assigned_sub') ?>`,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,

                    }).then(() => {

                        var arrJSON = JSON.stringify(selectedIds);
                        console.log(arrJSON);

                        var form_tmp = document.createElement('form');
                        form_tmp.action = '';
                        form_tmp.method = 'POST';
                        form_tmp.style.display = 'none';

                        // Creamos un input con los datos del JSON y lo añadimos al formulario anterior
                        let input_ids = document.createElement('input');
                        input_ids.type = 'hidden';
                        input_ids.name = 'ids';
                        input_ids.value = arrJSON;
                        form_tmp.appendChild(input_ids);

                        let input_ins = document.createElement('input');
                        input_ins.type = 'hidden';
                        input_ins.name = 'ins';
                        input_ins.value = ins;
                        form_tmp.appendChild(input_ins);


                        // Añadimos el formulario al documento y lo enviamos
                        document.body.appendChild(form_tmp);
                        form_tmp.submit();

                        form_tmp.remove();
                    });
                }
            });



        }
    }
</script>
<script src="node_modules/@material-tailwind/html@latest/scripts/ripple.js"></script>
<?= $this->endSection() ?>