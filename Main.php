<?php

    namespace IdnoPlugins\Recipe {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/recipe/edit/?', '\IdnoPlugins\Recipe\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/recipe/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Recipe\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/recipe/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Recipe\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/recipe/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
            }

            /**
             * Get the total file usage
             * @param bool $user
             * @return int
             */
            function getFileUsage($user = false) {

                $total = 0;

                if (!empty($user)) {
                    $search = ['user' => $user];
                } else {
                    $search = [];
                }

                if ($recipes = Recipe::get($search,[],9999,0)) {
                    foreach($recipes as $recipe) {
                        /* @var Recipe $recipe */
                        if ($recipe instanceof Recipe) {
                            if ($attachments = $recipe->getAttachments()) {
                                foreach($attachments as $attachment) {
                                    $total += $attachment['length'];
                                }
                            }
                        }
                    }
                }

                return $total;
            }

        }

    }
