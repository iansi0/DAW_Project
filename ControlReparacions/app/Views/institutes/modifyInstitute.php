<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div>
    <div class="flex">

        <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.e_ins")) ?></h1>

    </div>

    <form action="add" method="POST" class="mt-4 flex flex-col gap-2 px-20">

        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'institutes?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/institutes');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.save") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

        <div class="shadow-xl border-b border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?=mb_strtoupper(lang('titles.ins_2'))?></h2>
            </div>

            <div class="grid grid-cols-12 mt-2 p-4">

                <div class="col-span-12 grid grid-cols-12">

                    <!-- codi  -->
                    <div class="col-span-2 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.code")) ?>*</label>
                        <input value="<?=$institute['codi']?>" type="text" name="code" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['code'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['code'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- nom  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.name")) ?>*</label>
                        <input value="<?=$institute['nom']?>" type="text" name="name" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['name'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- actiu  -->
                    <div class="col-span-2 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.active")) ?>*</label>
                        <select value="<?=$institute['actiu']?>" name="active" id="active" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <option value="" selected><?= lang("forms.active") ?></option>
                            <option value='0' <?=$institute['actiu']==0?'selected':''?>>No</option>
                            <option value='1' <?=$institute['actiu']==1?'selected':''?>>Si</option>
                        </select>
                        <?php
                        if (isset(validation_errors()['active'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['active'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- taller  -->
                    <div class="col-span-2 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.work")) ?>*</label>
                        <select name="work" id="work" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <option value="" selected hidden><?= lang("forms.work") ?></option>
                            <option value='0' <?=$institute['taller']==0?'selected':''?>>No</option>
                            <option value='1' <?=$institute['taller']==1?'selected':''?>>Si</option>
                        </select>
                        <?php
                        if (isset(validation_errors()['work'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['work'] ?></p>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-span-12 grid grid-cols-12 mt-5 mb-3">

                    <!-- telefon  -->
                    <div class="col-span-2 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.phone")) ?>*</label>
                        <input value="<?=$institute['telefon']?>" type="text" name="phone" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150"></input>
                        <?php
                        if (isset(validation_errors()['phone'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['phone'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- adreca  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.adress")) ?>*</label>
                        <input value="<?=$institute['adreca_fisica']?>" type="text" name="adress" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['adress'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['adress'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- poblacio -->
                    <div class="col-span-4 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.pobl")) ?>*</label>
                        <select name="population" id="" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <option value="" disabled hidden><?= lang("forms.s_pobl") ?></option>
                            <?php foreach ($populations as $population):?>
                                <option value="<?=$population['id']?>" <?=($institute['id_poblacio']==$population["id"])?'selected':''?>><?=$population["nom"]?></option>;
                            <?php endforeach; ?>
                        </select>
                        <?php
                        if (isset(validation_errors()['population'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['population'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {

        event.preventDefault();

        Swal.fire({
            title: `<?= lang('alerts.sure') ?>`,
            text: `<?= lang('alerts.sure_sub') ?>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `<?= lang('alerts.yes_upd') ?>`,
            cancelButtonText: `<?= lang('alerts.cancel') ?>`
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `<?= lang('alerts.updated') ?>`,
                    text: `<?= lang('alerts.updated_sub') ?>`,
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

<?= $this->endSection() ?>