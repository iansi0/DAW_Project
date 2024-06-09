<?= $this->extend('layouts/master.php') ?>
<?= $this->section('content') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="flex gap-16 items-center  text-primario p-3 rounded-lg pl-5 w-full mb-3">

    <a href="<?= strpos(previous_url(), 'institutes?') !== false
                    ? str_replace('index.php/', '', previous_url())
                    : base_url('/institutes'); ?>">
        <button id="" class="hover:bg-[#FFB053] hover:text-terciario-1 p-2 px-3 rounded-xl transition hover:ease-in ease-out duration-250"><i class="fa-solid fa-arrow-left text-3xl"></i></button>
    </a>

    <h1 class=" text-left text-5xl ml-72"> <?= $institute['nom'] ?></h1>
</div>

<main class="flex gap-7 py-1 ">

    <section class="flex flex-col min-w-[400px]">

        <div class="p-5">
            <iframe  class="w-full h-72 border shadow-lg rounded-lg" src="https://www.google.com/maps/embed/v1/place?q=<?=$institute['nom']?>, <?=$institute['adreca']?>,<?=$institute['poblacio']?>&key=AIzaSyCee3Q2FSeZD6kb9V32r7lb5_39jFarwP4" ></iframe>
            
        </div>


        <div class=" text-secundario w-full  rounded-t-lg overflow-hidden">
            <h3 class="bg-primario text-lg p-3"> Datos </h3>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-hashtag"></i> : <span class="text-sm"><?= $institute['codi'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-envelope"></i> : <span class="text-sm"><?= $institute['correu'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-person"></i> : <span class="text-sm"><?= $institute['persona'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-phone"></i> : <span class="text-sm"><?= $institute['telefon'] ?></span></p>
            <p class="bg-terciario-2 p-2 text-terciario-1 overflow-auto"><i class="fa-solid fa-location-dot"></i> : <span class="text-sm"><?= $institute['adreca'] ?></span></p>
        </div>

    </section>

    <article class="flex flex-col gap-2 w-full">

        <div>
            <div class="flex justify-between bg-primario text-secundario text-left p-3 pr-8 text-3xl rounded-t-2xl">
                <h1><?= lang('titles.ticket'); ?></h1>
                <div class="  flex align-middle mt-2 gap-3">
                    <a class="hover:font-bold <?= $filter == 'sender' ? " font-bold" : "" ?>" href="<?= base_url('institutes/' . $institute['codi'] . '/filterSender') ?>"><?= lang('titles.sender') ?></a>
                    <span>&nbsp;|&nbsp;</span>
                    <a class="hover:font-bold <?= $filter == 'receiver' ? " font-bold" : "" ?>" href="<?= base_url('institutes/' . $institute['codi'] . '/filterReceiver') ?>"><?= lang('titles.receiver') ?></a>
                </div>
            </div>

            <?php
            echo $table->generate();
            ?>
        </div>

    </article>
</main>


<?= $this->endSection() ?>