<?php

    namespace IdnoPlugins\Recipe\Pages {

        use Idno\Core\Autosave;

        class Edit extends \Idno\Common\Page {

            function getContent() {

                $this->createGatekeeper();    // This functionality is for logged-in users only

                // Are we loading an entity?
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Recipe\Recipe::getByID($this->arguments[0]);
                } else {
                    $object = new \IdnoPlugins\Recipe\Recipe();
                }

                $t = \Idno\Core\site()->template();
                $body = $t->__(array(
                    'object' => $object
                ))->draw('entity/Recipe/edit');

                if (empty($vars['object']->_id)) {
                    $title = 'Write a recipe';
                } else {
                    $title = 'Edit recipe';
                }

                if (!empty($this->xhr)) {
                    echo $body;
                } else {
                    $t->__(array('body' => $body, 'title' => $title))->drawPage();
                }
            }

            function postContent() {
                $this->createGatekeeper();

                $new = false;
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Recipe\Recipe::getByID($this->arguments[0]);
                }
                if (empty($object)) {
                    $object = new \IdnoPlugins\Recipe\Recipe();
                }

                if ($object->saveDataFromInput($this)) {
                    (new \Idno\Core\Autosave())->clearContext('recipe');
                    //$this->forward(\Idno\Core\site()->config()->getURL() . 'content/all/');
                    //$this->forward($object->getDisplayURL());
                    $forward = $this->getInput('forward-to', $object->getDisplayURL());
                    $this->forward($forward);
                }

            }

        }

    }
