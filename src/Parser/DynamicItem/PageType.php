<?php

namespace C5TL\Parser\DynamicItem;

class PageType extends DynamicItem
{
    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::getParsedItemNames()
     */
    public function getParsedItemNames()
    {
        return function_exists('t') ? t('Page types names and composer form controls') : 'Page type names and composer form controls';
    }

    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::parseManual()
     */
    protected function parseManual(\Gettext\Translations $translations, $concrete5version)
    {
        if (class_exists('\Concrete\Core\Page\Type\Type', true) && method_exists('\Concrete\Core\Page\Type\Type', 'getList')) {
            foreach (\Concrete\Core\Page\Type\Type::getList() as $pt) {
                $this->addTranslation($translations, $pt->getPageTypeName(), 'PageTypeName');

                if (class_exists('\Concrete\Core\Page\Type\Composer\FormLayoutSet') && method_exists('\Concrete\Core\Page\Type\Composer\FormLayoutSet', 'getList')) {
                    foreach (\Concrete\Core\Page\Type\Composer\FormLayoutSet::getList($pt) as $fls) {
                        $name = $fls->getPageTypeComposerFormLayoutSetName();
                        if ((string)$name !== '') {
                            $this->addTranslation($translations, $name, 'PageTypeComposerFormLayoutSetName');
                        }
                        $description = $fls->getPageTypeComposerFormLayoutSetDescription();
                        if ((string)$description !== '') {
                            $this->addTranslation($translations, $description, 'PageTypeComposerFormLayoutSetDescription');
                        }

                        if (class_exists('\Concrete\Core\Page\Type\Composer\FormLayoutSetControl') && method_exists('\Concrete\Core\Page\Type\Composer\FormLayoutSetControl', 'getList')) {
                            foreach (\Concrete\Core\Page\Type\Composer\FormLayoutSetControl::getList($fls) as $flsc) {
                                $customLabel = $flsc->getPageTypeComposerFormLayoutSetControlCustomLabel();
                                if ((string)$customLabel !== '') {
                                    $this->addTranslation($translations, $customLabel, 'PageTypeComposerFormLayoutSetControlCustomLabel');
                                }
                                $description = $flsc->getPageTypeComposerFormLayoutSetControlDescription();
                                if ((string)$description !== '') {
                                    $this->addTranslation($translations, $description, 'PageTypeComposerFormLayoutSetControlDescription');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}