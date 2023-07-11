<?php $pager->setSurroundCount(2) ?>

<div class="col-12 mb-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                        <!-- <span aria-hidden="true">«</span> -->
                        <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                        <span class="sr-only">First</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                        <!-- <span aria-hidden="true">«</span> -->
                        <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active"' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                        <!-- <span aria-hidden="true">»</span> -->
                        <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                        <!-- <span aria-hidden="true">«</span> -->
                        <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>