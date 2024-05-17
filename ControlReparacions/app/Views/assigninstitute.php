<?php helper('cookie'); ?>
<!DOCTYPE html>
<html lang="en" class=" h-screen">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KeepYourSoftware</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
</head>

<style>
    body {
        font-family: system-ui;   
    }
</style>

<body class="h-screen flex flex-col justify-center items-center" style="background-image: url('<?=base_url()?>/assets/img/login.jpg') ; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

    <section class="bg-[#ffffff] text-terciario-4 flex flex-col gap-5 items-center border-2 border-secundario rounded-md px-20 py-10">
        <div class="flex items-center" style="user-select: none">
            <img src="/assets/img/logo.png" alt="Logo">
            <b>KeepYourSoftware</b>
        </div>

        <form class=" flex flex-col gap-5   w-full " method="POST" action="addprof">

            <!-- Agafar Institutes -->
            <div>
                <div class="relative flex items-center">
                    <p><?=lang('login.text')?></p>                    
                </div>
            </div>
            <div>
            <div class='relative searchable-device-list'>
                <input name="d" type='text' class='data-device-list peer w-full h-10 rounded-sm bg-secundario cursor-pointer outline-none text-primario
                        caret-gray-800 pl-2 pr-7 focus:bg-gray-200 font-bold transition-all duration-300 text-sm text-overflow-ellipsis ' spellcheck="false"  placeholder="<?=lang('forms.s_ins')?>">
                <svg class="outline-none cursor-pointer fill-gray-400 absolute transition-all duration-200 h-full w-4 -rotate-90 right-2 top-[50%] -translate-y-[50%]"
                    viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path d="M0 256l512 512L1024 256z"></path>
                </svg>
                <ul class='absolute option-device-list overflow-y-scroll max-h-64 min-h-[0px] flex flex-col top-12 
                        left-0 w-full bg-secundario rounded-sm scale-0 opacity-0 
                        transition-all 
                        duration-200 origin-top-left'>
                </ul>
                </div>
            </div>

            <!-- BOTON LOGIN -->
            <input class="mb-5 text-lg py-2 rounded-2xl bg-primario text-secundario hover:cursor-pointer hover:bg-terciario-2 hover:text-terciario-1 transition hover:ease-in ease-out duration-250" type="submit" value="<?= lang('titles.register') ?>">


        </form>

        

    </section>

</body>
<script src="/assets/js/dataList.js"></script>

<script>
     // CREADOR DE DATALIST DISPOSITIVOS
  const dataList_device = new DataList('searchable-device-list', 'data-device-list', 'option-device-list', 'option-device');
  // Inicializamos
  dataList_device.init();
  // Generamos el array de opciones 
  var devicesJSON = `<?php echo json_encode($institutes)?>`;
  console.log(devicesJSON);
  var devices = JSON.parse(devicesJSON);
  var arrDevices = [];
  devices.forEach(element => {
    arrDevices.push(element['nom']+" ("+element['codi']+")")
  });
  // Añadimos cada elemento al dataList_device
  arrDevices.forEach(v=>(dataList_device.append(v)));

</script>
</html>