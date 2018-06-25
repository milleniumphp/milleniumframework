<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <?php if (isset($category['childs'])): ?>
                <a data-toggle="collapse" data-parent="#accordian" href="#<?= $category['title']. '_' . $id; ?>">
            <?php else:?>
                <a href="/examples/shop/category?id=<?=$id?> ">
            <?php endif;?>
                
                    <?php if (isset($category['childs'])): ?>
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    <?php endif;?>
                    <?= $category['title']; ?>
                </a>
        </h4>
    </div>
    <?php if (isset($category['childs'])): ?>
        <div id="<?= $category['title']. '_' . $id; ?>" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <?=$this->getMenuHtml($category['childs'])?>
                    
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
