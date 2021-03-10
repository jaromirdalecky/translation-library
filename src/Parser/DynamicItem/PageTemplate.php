<?php

namespace C5TL\Parser\DynamicItem;

class PageTemplate extends DynamicItem
{
    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::getParsedItemNames()
     */
    public function getParsedItemNames()
    {
        return function_exists('t') ? t('Page template names') : 'Page template names';
    }

    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::parseManual()
     */
    protected function parseManual(\Gettext\Translations $translations, $concrete5version)
    {
        if (class_exists('\Concrete\Core\Page\Template', true) && method_exists('\Concrete\Core\Page\Template', 'getList')) {
            foreach (\Concrete\Core\Page\Template::getList() as $pt) {
                $this->addTranslation($translations, $pt->getPageTemplateName(), 'PageTemplateName');
            }
        }
    }
}