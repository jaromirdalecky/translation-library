<?php

namespace C5TL\Parser\DynamicItem;

/**
 * Extract translatable data from AuthenticationTypes.
 */
class BlockTypeSet extends DynamicItem
{
    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::getParsedItemNames()
     */
    public function getParsedItemNames()
    {
        return function_exists('t') ? t('Block type set names') : 'Block type set names';
    }

    /**
     * {@inheritdoc}
     *
     * @see \C5TL\Parser\DynamicItem\DynamicItem::parseManual()
     */
    public function parseManual(\Gettext\Translations $translations, $concrete5version)
    {
        if (class_exists('\Concrete\Core\Block\BlockType\Set', true) && method_exists('\Concrete\Core\Block\BlockType\Set', 'getList')) {
            foreach (\Concrete\Core\Block\BlockType\Set::getList() as $bts) {
                $this->addTranslation($translations, $bts->getBlockTypeSetName(), 'BlockTypeSetName');
            }
        }
    }
}
