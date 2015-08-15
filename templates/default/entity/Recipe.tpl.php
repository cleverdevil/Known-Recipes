<article class="h-recipe known-recipe">
    <?php

        if (\Idno\Core\site()->template()->getTemplateType() == 'default') {
            ?>
            <h2 class="p-name"><a
                    href="<?= $vars['object']->getDisplayURL() ?>">Recipe: <?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
            </h2>
            <?php

        }

    ?>

    <h4>Ingredients</h4>
    <ul>
        <?php
            foreach ($vars['object']->getIngredients() as $ingredient) {
                ?>
                <li class="p-ingredient"><?= $ingredient ?></li>
                <?php
            }
        ?>
    </ul>

    <p>
        <?php
            if ($duration = $vars['object']->getDuration()) { ?>
            Takes
            <time class="dt-duration"
                  datetime="<?= $duration ?>"><?= $duration ?></time>.
        <?php } ?>
        <?php if ($yield = $vars['object']->getYield()) { ?>
            Serves
            <data class="p-yield" value="<?= $yield ?>"><?= $yield ?></data>.
        <?php } ?>
    </p>

    <div class="e-instructions">
        <?= $this->__(['value' => $vars['object']->body, 'object' => $vars['object'], 'rel' => $rel])->draw('forms/output/richtext'); ?>
    </div>
</article>
