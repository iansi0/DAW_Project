<!DOCTYPE html>
<html>
<head>
    <title>Ticket: <?=$ticket['id']?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    <style>
        body {
            /* font-family: monospace; */
            font-family: system-ui, Arial, Helvetica;
            /*montserrat para titulos con bold
            lato y popins para textos medium */
        }

        .bold{
            font-weight: 700;
        }
    </style>
</head>
<body>

<div>

    <!-- HEADER  -->
    <div style="background-color: #003049; color: #F2F2F2;padding: 5px 12px;">
        <h1 class=""><?= mb_strtoupper(lang('titles.id_ticket'), 'utf-8'); ?>: <?= explode("-", $ticket['id'])[4] ?></h1>
    </div>

    <!-- CONTENT -->
    <div style="margin-top: 28px;">
        <!-- INFO -->
        <div style="position: relative; border: 1px solid black;">
            <h2 style="position: absolute; top: -40px; left: 20px; background-color: #FFFFFF; padding: 2px 8px;width: 140px;"><?= lang('forms.info'); ?></h2>
            <div style="line-height: 8px; margin-top: 25px;">
                <p style="margin-left: 20px"><span class="bold"><?=lang('titles.id')?>: </span><?=$ticket['id']?></p>
                <p style="margin-left: 20px"><span class="bold"><?=lang('forms.contact')?>: </span><?=$ticket['correu_contacte']?></p>
                <p style="margin-left: 20px"><span class="bold"><?=lang('forms.create_date')?>: </span><?=date( 'd/m/Y H:i', strtotime($ticket['created']))?></p>
                <p style="margin-left: 20px"><span class="bold"><?=lang('titles.ins_2')?> <?=lang('titles.sender')?>: </span><?=$ticket['emissor']?></p>
                <p style="margin-left: 20px"><span class="bold"><?=lang('titles.ins_2')?> <?=lang('titles.receiver')?>: </span><?=$ticket['receptor']?> (<?=$ticket['codi_reparador']?>)</p>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div style="position: relative; border: 1px solid black;margin-top: 50px;">
            <h2 style="position: absolute; top: -40px; left: 20px; background-color: #FFFFFF; padding: 2px 8px;width: 140px;"><?= lang('forms.description'); ?></h2>
            <div style="line-height: 8px; margin-top: 25px;">
                <p style="margin-left: 20px"><?=$ticket['descripcio']?></p>
            </div>
        </div>

        <!-- INTERVENTIONS -->
        <div style="position: relative; border: 1px solid black;margin-top: 50px;">
            <h2 style="position: absolute; top: -40px; left: 20px; background-color: #FFFFFF; padding: 2px 8px;width: 170px;"><?= lang('titles.int'); ?></h2>
            <div style="line-height: 8px; margin-top: -8px;">
                <p style="margin-left: 20px"><?=$table->generate();?></p>
            </div>
        </div>


    </div>
</div>
</body>
</html>
