<div class="row justify-content-between align-items-end">
    <div class="col-xs-auto">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item <?php echo ($this->isFirstPage()) ? "disabled" : "" ?>">
                    <a class="page-link" href="<?php echo $this->prevPageUrl() ?>">Anterior</a>
                </li>
                <?php foreach ($this->getPages() as $page){ ?>
                    <li class="page-item <?php echo ($page['active']) ? "active" : "" ?>">
                        <a class="page-link" href="<?php echo $page['url']; ?>">
                            <?php echo $page['number'] ?>
                        </a>
                    </li>
                <?php } ?>
                <li class="page-item <?php echo ($this->isLastPage()) ? "disabled" : "" ?>">
                    <a class="page-link" href="<?php echo $this->nextPageUrl() ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-xs-auto">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="<?php echo $this->getSizeUrl(5) ?>" class="btn btn-secondary btn-outline-secondary">5</a>
            <a href="<?php echo $this->getSizeUrl(10) ?>" class="btn btn-secondary btn-outline-secondary">10</a>
            <a href="<?php echo $this->getSizeUrl(20) ?>" class="btn btn-secondary btn-outline-secondary">20</a>
        </div>
    </div>
</div>
