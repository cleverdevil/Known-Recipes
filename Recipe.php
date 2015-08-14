<?php

    namespace IdnoPlugins\Recipe {

        use Idno\Core\Autosave;

        class Recipe extends \Idno\Common\Entity
        {

            function getTitle()
            {
                if (empty($this->title)) return 'Untitled';

                return $this->title;
            }

            function getDescription()
            {
                if (!empty($this->body)) return $this->body;

                return '';
            }

            function getIngredients()
            {
                if (empty($this->ingredients)) $this->ingredients = '';

                return explode("\n", $this->ingredients);
            }

            function getYield()
            {
                if (!empty($this->yield)) return $this->yield;

                return '';
            }
 
            function getDuration()
            {
                if (!empty($this->duration)) return $this->duration;

                return '';
            }

            function getURL()
            {

                // If we have a URL override, use it
                if (!empty($this->url)) {
                    return $this->url;
                }

                if (!empty($this->canonical)) {
                    return $this->canonical;
                }

                if (!$this->getSlug() && ($this->getID())) {
                    return \Idno\Core\site()->config()->url . 'recipe/' . $this->getID() . '/' . $this->getPrettyURLTitle();
                } else {
                    return parent::getURL();
                }

            }

            /**
             * Recipe objects have type 'recipe'
             * @return 'recipe'
             */
            function getActivityStreamsObjectType()
            {
                return 'recipe';
            }

            /**
             * Retrieve icon
             * @return mixed|string
             */
            function getIcon()
            {
                $xpath = new \DOMXPath(@\DOMDocument::loadHTML($this->getDescription()));
                $src   = $xpath->evaluate("string(//img/@src)");
                if (!empty($src)) {
                    return $src;
                }

                return parent::getIcon();
            }

            function saveDataFromInput()
            {

                if (empty($this->_id)) {
                    $new = true;
                } else {
                    $new = false;
                }
                $body = \Idno\Core\site()->currentPage()->getInput('body');
                if (!empty($body)) {

                    $this->body        = $body;
                    $this->title       = \Idno\Core\site()->currentPage()->getInput('title');
                    $this->ingredients = \Idno\Core\site()->currentPage()->getInput('ingredients');
                    $this->yield       = \Idno\Core\site()->currentPage()->getInput('yield');
                    $this->duration    = \Idno\Core\site()->currentPage()->getInput('duration');
                    $access            = \Idno\Core\site()->currentPage()->getInput('access');
                    $this->setAccess($access);

                    if ($time = \Idno\Core\site()->currentPage()->getInput('created')) {
                        if ($time = strtotime($time)) {
                            $this->created = $time;
                        }
                    }

                    if ($this->save($new)) {

                        $autosave = new Autosave();
                        $autosave->clearContext('recipe');

                        \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getTitle() . ' ' . $this->getDescription()));

                        return true;
                    }
                } else {
                    \Idno\Core\site()->session()->addErrorMessage('You can\'t save an empty entry.');
                }

                return false;

            }

            function deleteData()
            {
                \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getTitle() . ' ' . $this->getDescription()));
            }

        }

    }
