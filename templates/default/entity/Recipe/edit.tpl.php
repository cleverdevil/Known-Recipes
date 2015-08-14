<?= $this->draw('entity/edit/header'); ?>
<?php

    $autosave = new \Idno\Core\Autosave();
    if (!empty($vars['object']->body)) {
        $body = $vars['object']->body;
    } else {
        $body = $autosave->getValue('recipe', 'bodyautosave');
    }
    if (!empty($vars['object']->title)) {
        $title = $vars['object']->title;
    } else {
        $title = $autosave->getValue('recipe', 'title');
    }
    if (!empty($vars['object']->ingredients)) {
        $ingredients = $vars['object']->ingredients;
    } else {
        $ingredients = $autosave->getValue('recipe', 'ingredients');
    }
    if (!empty($vars['object']->yield)) {
        $yield = $vars['object']->yield;
    } else {
        $yield = $autosave->getValue('recipe', 'yield');
    }
    if (!empty($vars['object']->duration)) {
        $duration = $vars['object']->duration;
    } else {
        $duration = $autosave->getValue('recipe', 'duration');
    }
    if (!empty($vars['object'])) {
        $object = $vars['object'];
    } else {
        $object = false;
    }

    /* @var \Idno\Core\Template $this */

?>
    <form action="<?= $vars['object']->getURL() ?>" method="post">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 edit-pane">


                <?php

                    if (empty($vars['object']->_id)) {

                        ?>
                        <h4>New Recipe</h4>
                    <?php

                    } else {

                        ?>
                        <h4>Edit Recipe</h4>
                    <?php

                    }

                ?>
                
                <div class="content-form">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Give it a title" value="<?= htmlspecialchars($title) ?>" class="form-control"/>                    
                
                    <label for="ingredients">Ingredients</label>
                    <textarea name="ingredients" placeholder="List of ingredients. One per line." class="form-control content-entry"><?= htmlspecialchars($ingredients); ?></textarea>
                    
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" placeholder="Four hours" value="<?= htmlspecialchars($duration) ?>" class="form-control" /> 
                    
                    <label for="duration">Yield</label>
                    <input type="text" name="yield" placeholder="Six servings" value="<?= htmlspecialchars($yield) ?>" class="form-control" /> 
                </div>
                
                <label for="body">Instructions</label>
                <?= $this->__([
                    'name' => 'body',
                    'value' => $body,
                    'object' => $object,
                    'wordcount' => true
                ])->draw('forms/input/richtext')?>
                <?= $this->draw('entity/tags/input'); ?>

                <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('article'); ?>
                <?php if (empty($vars['object']->_id)) { ?><input type="hidden" name="forward-to" value="<?= \Idno\Core\site()->config()->getDisplayURL() . 'content/all/'; ?>" /><?php } ?>
                
                <?= $this->draw('content/access'); ?>

                <p class="button-bar ">
	                
                    <?= \Idno\Core\site()->actions()->signForm('/recipe/edit') ?>
                    <input type="button" class="btn btn-cancel" value="Cancel" onclick="tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'body'); hideContentCreateForm();"/>
                    <input type="submit" class="btn btn-primary" value="Publish"/>

                </p>

            </div>

        </div>
    </form>
    <div id="bodyautosave" style="display:none"></div>
<?= $this->draw('entity/edit/footer'); ?>
