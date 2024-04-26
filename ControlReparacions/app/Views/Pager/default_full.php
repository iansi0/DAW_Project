
<div class="flex items-center justify-center border-t border-primario  px-4 py-3 sm:px-6">

    <a href="<?=$pager->getFirst()?>" class="relative mr-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 hover:bg-secundario-50">&lt;&lt;</a>
    <!-- <a href="<?=$pager->getPrevious()?>" class="relative mr-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 hover:bg-secundario-50">&lt;</a> -->

    <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

            <?php foreach($pager->links() as $key => $link): ?>

                <?php if (($key <= ($pager->getCurrentPageNumber()-5)) || ($key <= ($pager->getCurrentPageNumber()+5))): ?>
                    <?php if($link["active"]): ?>
                        <a href="<?=str_replace('index.php/', '', $link['uri'])?>" aria-current="page" class="relative z-10 inline-flex items-center bg-primario px-4 py-2 text-sm font-semibold text-secundario focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primario-600"><?=$link["title"]?></a>
                    <?php else:?>
                        <a href="<?=str_replace('index.php/', '', $link['uri'])?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-secundario-900 ring-1 ring-inset ring-secundario-300 hover:bg-secundario-50 focus:z-20 focus:outline-offset-0"><?=$link["title"]?></a>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>

        </nav>
    </div>

    <!-- <a href="<?=$pager->getNext()?>" class="relative ml-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 hover:bg-secundario-50">&gt;</a> -->
    <a href="<?=$pager->getLast()?>" class="relative mr-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 hover:bg-secundario-50">&gt;&gt;</a>

</div>