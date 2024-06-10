<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<div>
    <div class="flex">

        <h1 class="text-5xl text-primario"><?= strtoupper(lang("titles.n_ins")) ?></h1>

    </div>

    <form action="" method="POST" class="mt-4 flex flex-col gap-2 px-20">

        <!-- BOTONES -->
        <div class="flex justify-end align-middle">

            <a href="<?= strpos(previous_url(), 'locations?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/locations');
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
                    <div class="col-span-3 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.code")) ?>*</label>
                        <input type="text" name="code" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['code'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['code'] ?></p>
                        <?php endif ?>
                    </div>

                    <!-- nom  -->
                    <div class="col-span-6 grid-cols-12 text-left px-2">
                        <label class="font-semibold text-primario"><?= mb_strtoupper(lang("forms.name")) ?>*</label>
                        <input type="text" name="name" class="border-2 border-terciario-1 w-full px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150">
                        <?php
                        if (isset(validation_errors()['name'])) : ?>
                            <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                        <?php endif ?>
                    </div>

                </div>

            </div>
        </div>

    </form>
</div>

<?= $this->endSection() ?>