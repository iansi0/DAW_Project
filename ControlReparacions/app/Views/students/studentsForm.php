<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>

<h1 class="text-5xl text-primario mt-14"><?= lang("titles.n_students") ?></h1>

<section style="view-transition-name: addTicket;" class=" mx-auto px-4 py-8 mt-10 text-base">
    <form action="add" method="POST" class="flex flex-col gap-20" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="grid grid-cols-3 gap-x-2 gap-y-2">

            <!-- Correo  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.email") ?>*</label>
                <input type="mail" name="email" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['email'] ?></p>
                <?php endif ?>
            </div>

            <!-- Nombre  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.name") ?>*</label>
                <input type="text" name="name" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['name'] ?></p>
                <?php endif ?>
            </div>

            <!-- Apellidos  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.surnames") ?>*</label>
                <input type="text" name="surnames" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 "></input>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200  border-t-4 border-red-300 "><?= validation_errors()['surnames'] ?></p>
                <?php endif ?>
            </div>

            <!-- Curs  -->
            <div class="flex flex-col mt-5">
                <label class=""><?= lang("forms.course") ?>*</label>
                <select type="text" name="course" class="border-2 border-terciario-1 px-2 py-3 rounded hover:bg-secundario transition hover:ease-in ease-out duration-150 ">

                <option value="" disabled selected hidden><?= lang("forms.s_course") ?></option>
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?= $course["id"] ?>"><?= $course["titol"] . " " .  $course['clase'] . " " . $course['any'] ?></option>
                    <?php endforeach; ?>

                </select>
                <?php
                if (validation_errors()) : ?>
                    <p class="font-medium flex justify-center mt-2 p-4 mb-4 bg-red-200 border-t-4 border-red-300 "><?= validation_errors()['course'] ?></p>
                <?php endif ?>
            </div>



        </div>

        <div>
            <input type="file" name="csv" id="csv">
        </div>

        <div class="flex gap-5 justify-end w-full">

            <a href="<?= strpos(previous_url(), 'students?') !== false
                            ? str_replace('index.php/', '', previous_url())
                            : base_url('/students');
                        ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250"><?= lang("buttons.cancel") ?></a>

            <input type="submit" value="<?= lang("buttons.add") ?>" class="bg-green-700 hover:bg-green-500 cursor-pointer text-white px-4 py-2 rounded transition hover:ease-in ease-out duration-250">

        </div>
    </form>
</section>



<?= $this->endSection() ?><?= $this->extend('layouts/master.php') ?>