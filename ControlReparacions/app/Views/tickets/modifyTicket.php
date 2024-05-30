<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<h1 class="text-5xl text-primario mt-14"><?= lang("titles.e_ticket")?></h1>

<section style="view-transition-name: addTicket;" class="container mx-auto px-4 py-8 mt-10 text-base">
    <span class="text-danger">
        <?= validation_list_errors(); ?>
    </span>
    <form id="form" action="<?= $ticket['id']; ?>" method="POST" class="flex flex-col gap-20">

        <div class="grid grid-cols-3 gap-x-2">

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.description")?></label>
                <input type="text" name="description" value="<?= $ticket['descripcio_avaria']; ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_name")?></label>
                <input type="text" name="nameContact" value="<?= $ticket['nom_persona_contacte_centre']; ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.contact_email")?></label>
                <input type="text" name="emailContact" value="<?= $ticket['correu_persona_contacte_centre']; ?>" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
            </div>


            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.s_disp")?></label>
                <select name="id_type" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                        foreach ($types as $type) {
                            if ($type["id"]==$ticket["id_tipus_dispositiu"]) {
                                echo "<option selected value='".$type["id"]."'>".$type["nom"]."</option>";
                            } else {
                                echo "<option value='".$type["id"]."'>".$type["nom"]."</option>";
                            }
                            
                        }
                    ?>
                </select>
            </div>

            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.state")?></label>
                <select name="id_state" id="" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                <?php
                        foreach ($states as $state) {
                            if ($state["id"]==$ticket["id_estat"]) {
                                echo "<option selected value='".$state["id"]."'>".$state["nom"]."</option>";
                            } else {
                                echo "<option value='".$state["id"]."'>".$state["nom"]."</option>";
                            }
                            
                        }
                    ?>
                </select>
            </div>
            
            <?php if (((session()->get('user')['role']=="sstt") && $ticket['id_estat']!=6) || (session()->get('user')['role']=="admin") ) : ?>
            <div class="flex flex-col justify-end  mt-5">
                
                
                <label class="block" for="sender" id="labelSender"><?= lang("forms.s_ins")?></label>
                <select name="sender" id="sender" class="border-2  border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    
                    <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                    <?php
                        foreach ($centers as $center) {
                            if ($center["codi"]==$ticket["codi_centre_emissor"]) {
                                echo "<option selected value='".$center["codi"]."'>".$center["nom"]."</option>";
                            }else{
                                echo "<option value='".$center["codi"]."'>".$center["nom"]."</option>";

                            }
                        }
                    ?>
                    
                </select>
            </div>
            <?php else : ?>
                <input type="text" name="sender" id="sender" hidden value="<?= session()->get('user')['code']; ?>">

            <?php endif ?>
            
            <?php if (((session()->get('user')['role']=="sstt") && $ticket['id_estat']!=6) || (session()->get('user')['role']=="admin") ) : ?>
            <div class="flex flex-col justify-end  mt-5">
                
                <label class="block" for="repair" id="labelRepair"><?= lang("forms.s_ins")." ".lang("forms.work")?></label>
                <select name="repair" id="repair" class="border-2 border-terciario-1 px-2 py-3 rounded   hover:bg-secundario transition hover:ease-in ease-out duration-150 ">
                    <option value="" disabled selected hidden><?= lang("forms.s_ins")?></option>
                    <?php
                        foreach ($repairs as $repair) {
                            if ($repair["codi"]==$ticket["codi_centre_reparador"]) {
                                echo "<option selected value='".$repair["codi"]."'>".$repair["nom"]."</option>";
                            }else{
                                echo "<option value='".$repair["codi"]."'>".$repair["nom"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <?php endif ?>
        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'tickets?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/tickets');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel")?></a>

            <input type="button" id="submitButton" value="<?= lang("buttons.save")?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

    </form>
</section>

<script>
document.getElementById('submitButton').addEventListener('click', function() {
    Swal.fire({
        title: `<?=lang('alerts.sure')?>`,
        text: `<?=lang('alerts.sure_sub')?>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `<?=lang('alerts.yes_upd')?>`,
        cancelButtonText: `<?=lang('alerts.cancel')?>`
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `<?=lang('alerts.updated')?>`,
                text: `<?=lang('alerts.updated_sub')?>`,
                icon: 'success'
            }).then(() => {
                
                document.getElementById('form').submit();
            });
        }
    });
});
</script>


<?= $this->endSection() ?>