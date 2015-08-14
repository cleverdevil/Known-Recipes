<article class="h-recipe known-recipe">
    <?php
        if (\Idno\Core\site()->template()->getTemplateType() == 'default') {
            ?>
            <h2 class="p-name"><a
                    href="<?= $vars['object']->getURL() ?>">Recipe: <?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
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
  <?php if (!empty($vars['object']->getDuration())) { ?> 
    Takes <time class="dt-duration" datetime="<?= $vars['object']->getDuration() ?>"><?= $vars['object']->getDuration() ?></time>.
  <?php } ?>
  <?php if (!empty($vars['object']->getYield())) { ?> 
    Serves <data class="p-yield" value="<?= $vars['object']->getYield() ?>"><?= $vars['object']->getYield() ?></data>.
  <?php } ?>
  </p>
 
  <div class="e-instructions">
    <?=  $this->__(['value' => $vars['object']->body, 'object' => $vars['object'], 'rel' => $rel])->draw('forms/output/richtext'); ?>
  </div>
</article>
