
<div class="flex items-center justify-center border-t border-primario  px-4 py-3 sm:px-6">

    <a href="<?=$pager->getFirst()?>" class="relative inline-flex items-center rounded-l-lg border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700   hover:bg-terciario-4 cursor-pointer hover:text-secundario transition hover:ease-in ease-out duration-250">&lt;&lt;</a>
    <!-- <a href="<?=$pager->getPrevious()?>" class="relative mr-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 border  hover:bg-terciario-4 cursor-pointer hover:text-secundario transition hover:ease-in ease-out duration-250">&lt;</a> -->

    <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

            <?php foreach($pager->links() as $key => $link): ?>

                <?php if (($key >= ($pager->getCurrentPageNumber()-3)) && ($key <= ($pager->getCurrentPageNumber()+1))): ?>
                    <?php if($link["active"]): ?>
                        <a href="<?=str_replace('index.php/', '', $link['uri'])?>" aria-current="page" class="relative z-10 inline-flex items-center border-secundario-300 bg-primario px-4 py-2 text-sm font-semibold text-secundario focus:z-20 hover:bg-terciario-4 hover:text-primario transition hover:ease-in ease-out duration-250 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primario-600"><?=$link["title"]?></a>
                    <?php else:?>
                        <a href="<?=str_replace('index.php/', '', $link['uri'])?>" class="relative inline-flex items-center px-4 py-2 border-secundario-300 text-sm font-semibold text-secundario-900 ring-1 ring-inset ring-secundario-300   hover:bg-terciario-4 hover:text-secundario transition hover:ease-in ease-out duration-250 focus:z-20 focus:outline-offset-0"><?=$link["title"]?></a>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>

        </nav>
    </div>

    <!-- <a href="<?=$pager->getNext()?>" class="relative ml-1 inline-flex items-center rounded-md border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700 border  hover:bg-terciario-4 cursor-pointer hover:text-secundario transition hover:ease-in ease-out duration-250">&gt;</a> -->
    <a href="<?=$pager->getLast()?>" class="relative mr-1 inline-flex items-center rounded-r-lg border border-secundario-300 bg-secundario px-4 py-2 text-sm font-medium text-secundario-700    hover:bg-terciario-4 hover:text-secundario transition hover:ease-in ease-out duration-250">&gt;&gt;</a>

</div>