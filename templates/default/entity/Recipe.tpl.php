<article class="h-recipe known-recipe">
    <?php

        if (\Idno\Core\site()->template()->getTemplateType() == 'default') {
            ?>
            <h2 class="p-name"><a
                    href="<?= $vars['object']->getDisplayURL() ?>">Recipe: <?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
            </h2>
            <?php

        }

        if ($attachments = $vars['object']->getAttachments()) {
            foreach ($attachments as $attachment) {
                $mainsrc = $attachment['url'];
                if (!empty($vars['object']->thumbnail_large)) {
                    $src = $vars['object']->thumbnail_large;
                } else if (!empty($vars['object']->thumbnail)) { // Backwards compatibility
                    $src = $vars['object']->thumbnail;
                } else {
                    $src = $mainsrc;
                }
                
                // Patch to correct certain broken URLs caused by https://github.com/idno/known/issues/526
                $src = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $src);
                $mainsrc = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\site()->config()->getDisplayURL(), $mainsrc);
                
                ?>
                <p style="text-align: center">
                    <a href="<?= $this->makeDisplayURL($mainsrc) ?>"><img src="<?= $this->makeDisplayURL($src) ?>" class="u-photo"/></a>
                </p>
                <br>
            <?php
            }
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
        <?= $this->__(['value' => $vars['object']->body, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
    </div>
</article>
