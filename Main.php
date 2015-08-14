<?php

    namespace IdnoPlugins\Recipe {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/recipe/edit/?', '\IdnoPlugins\Recipe\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/recipe/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Recipe\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/recipe/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Recipe\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/recipe/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
            }
        }

    }
