<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>


<div class="flex gap-16 items-center  text-primario p-3 rounded-lg pl-5 w-full mb-3">
    <a href="<?= strpos(previous_url(), 'tickets?') !== false
                    ? str_replace('index.php/', '', previous_url())
                    : base_url('/tickets'); ?>">
        <button id="" class="hover:bg-[#FFB053] hover:text-terciario-1 p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-arrow-left text-3xl"></i></button>
    </a>
    <h1 class=" text-left text-5xl ml-48"><?= mb_strtoupper(lang('titles.id_ticket'), 'utf-8'); ?> <?= explode("-", $ticket['id'])[4] ?></h1>
</div>

<main style="view-transition-name: info<?= $ticket['id'] ?>;" class="flex gap-7 py-1 ">

    <section class="flex flex-col gap-2">

        <div class="p-5">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscU3jYwiMibdPrr7f7S2htGvZGqUWHKr6gSuuUYKQkA&s" alt="imagen dispositivo" class="w-full">
        </div>

        <div class=" text-secundario min-w-72 max-w-80 rounded-lg overflow-hidden text-left">
            <h3 class="bg-primario font-semibold text-lg p-3"> <?= lang('forms.info'); ?> </h3>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="m-auto fa-solid fa-hashtag"></i> : <span class="text-sm"><?= $ticket['id'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto flex-col gap-1"><span class="flex items-center"><span class='size-3 inline-block mt-4 estat_<?=$ticket['id_estat']?> rounded-full'></span> : <span class="text-sm ml-1"><?= $ticket['estat'] ?></span></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="m-auto fa-solid fa-envelope"></i> : <span class="text-sm"><?= $ticket['correu_contacte'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="m-auto fa-solid fa-user"></i> : <span class="text-sm"><?= $ticket['nom_contacte'] ?></span></p>
        </div>


        <div class=" text-secundario min-w-64 max-w-72 rounded-lg overflow-hidden">
            <h3 class="bg-primario font-semibold text-lg p-3"><?= lang('forms.description'); ?></h3>
            <p class="bg-terciario-2 p-3 text-terciario-1  min-h-auto max-h-32 overflow-y-auto break-words"><?= $ticket['descripcio'] ?></p>
        </div>

    </section>

    <article class="flex flex-col gap-2 w-full">
    
        <div class="flex flex-row justify-between gap-4">
            <div>
                <?php if ((session()->get('user')['role'] == "prof" || session()->get('user')['role'] == "sstt" || session()->get('user')['role'] == "ins") && in_array($ticket['id_estat'], $estatsFiltrats)) : ?>

                    <form action="<?= base_url('savestate/' . $ticket['id']) ?>" id="stateform" method="post">

                        <select name="selectType" id="selectType" class="py-1.5 border border-terciario-1 cursor-pointer <?= 'estat_'.$ticket['id_estat'] ?> rounded-lg ">
                            <?php foreach ($estatsFiltrats as $filtrat): ?>
                                <option <?=($filtrat['id'] == $ticket['id_estat'])?'selected':''?> style='color: #003049 !important;' class='bg-secundario text-terciario-1 cursor-pointer px-2'  value='<?=$filtrat["id"]?>'><?=$filtrat["nom"]?></option>
                            <?php endforeach; ?>
                        </select>

                        <button id="save" onclick="document.getElementById('stateform').submit()" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-green-700 transition hover:ease-in ease-out duration-250"><?= lang('buttons.save'); ?></button>

                    </form>

                <?php elseif(session()->get('user')['role'] == "admin"): ?>

                    <form action="<?= base_url('savestate/' . $ticket['id']) ?>" id="stateform" method="post">

                        <select name="selectType" id="selectType"  class="py-1.5 border border-terciario-1 cursor-pointer <?= 'estat_'.$ticket['id_estat'] ?> rounded-lg ">
                            <?php foreach ($estatsFiltrats as $filtrat): ?>
                                <option <?=($filtrat['id'] == $ticket['id_estat'])?'selected':''?> style='color: #003049 !important;' class='bg-secundario text-terciario-1 cursor-pointer'  value='<?=$filtrat["id"]?>'><?=$filtrat["nom"]?></option>
                            <?php endforeach; ?>
                        </select>

                        <button id="save" onclick="document.getElementById('stateform').submit()" class=" bg-primario text-secundario px-8 py-1 border border-terciario-4  rounded-lg  hover:bg-green-700 transition hover:ease-in ease-out duration-250"><?= lang('buttons.save'); ?></button>

                    </form>
                <?php endif ?>
            </div>

            <?php if ((session()->get('user')['role'] == "prof") || (session()->get('user')['role'] == "sstt") || (session()->get('user')['role'] == "admin")) : ?>
                <div class="self-center">
                    <a href="<?= base_url('pdf/' . $ticket['id'] . '') ?>">
                        <button id="pdf" class="bg-primario text-secundario px-8 py-1 border border-terciario-4 rounded-lg hover:bg-red-800 transition hover:ease-in ease-out duration-250">Imprimir PDF</button>
                    </a>
                </div>
            <?php endif ?>

        </div>

        <div>

            <div class="flex justify-between bg-primario font-semibold text-secundario text-left p-3 pr-8 text-3xl rounded-t-2xl">
                <h1><?= mb_strtoupper(lang('titles.int')); ?></h1>

                    <?php if (((session()->get('user')['role'] == "prof") && (session()->get('user')['code'] == $ticket['codi_reparador'])) || ((session()->get('user')['role'] == "alumn") && (session()->get('user')['code'] == $ticket['codi_reparador'])) || (session()->get('user')['role'] == "admin")) : ?>

                        <div class="hover:bg-green-700 cursor-pointer hover:text-secundario p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250">
                            <a href="<?= base_url('intervention/form/' . $ticket['id']) ?>"><i class="fa-icon fa-solid fa-plus "></i></a>
                        </div>

                    <?php endif ?>

            </div>

            <?=$table->generate();?>

            <p class="bg-primario text-secundario text-right py-2 rounded-b-lg text-3xl"> Total: <?=$totalPrice?>€ &nbsp;</p>
        </div>

    </article>
</main>
<?= $this->endSection() ?>