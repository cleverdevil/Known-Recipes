<?php

    namespace IdnoPlugins\Recipe {

        class ContentType extends \Idno\Common\ContentType {

            public $title = 'Recipe';
            public $category_title = 'Recipes';
            public $entity_class = 'IdnoPlugins\\Recipe\\Recipe';
            public $logo = '<i class="icon-align-left"></i>';
            public $indieWebContentType = array('article','recipe');

        }

    }
