<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div>
    <div class="flex">

        <h1 class="text-5xl text-primario"><?= mb_strtoupper(lang("titles.e_locations_2")) ?></h1>

    </div>

    <form id="form" action="" method="POST" class="mt-4 flex flex-col gap-2 px-20">

        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'locations?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/locations');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 mr-3 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" id="submitButton" value="<?= lang("buttons.save") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>

        <div class="shadow-xl border-b border-primario rounded-t-xl">

            <div class="col-span-12 text-left mb-3 bg-primario text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-semibold"><?= mb_strtoupper(lang('titles.poblacio')) ?></h2>
            </div>

            <div class="grid grid-cols-12 mt-2 p-4">

                <div class="col-span-12 grid grid-cols-12">

                    <!-- codi  -->
                    <div class="col-span-2 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.code")) ?></label>
                        <input type="text" disabled value="<?=$info[0]['id']?>" class="border-2 border-terciario-1 w-full px-2 py-3 rounded bg-terciario-2 transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['code'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['code'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- nom  -->
                    <div class="col-span-5 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.name")) ?>*</label>
                        <input type="text" value="<?=$info[0]['nom']?>" name="name" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['name'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- Comarca  -->
                    <div class="col-span-5 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.coma")) ?>*</label>
                        <select name="population" id="" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                            <option value="" disabled hidden><?= lang("forms.s_coma") ?></option>
                            <?php foreach ($comarcas as $comarca):?>
                                <option value='<?=$comarca["codi"]?>' <?=(($comarca["codi"]==$info[0]['id_comarca'])?'selected':'')?>><?=$comarca["nom"]?></option>
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
                    timer: 2000,
                }).then(() => {

                    document.getElementById('form').submit();
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>