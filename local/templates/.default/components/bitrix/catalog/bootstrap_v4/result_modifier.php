<? global $arrTags, $APPLICATION;

$rsSection = \Bitrix\Iblock\SectionTable::getList([
    'filter' => [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'CODE'      => $arResult['VARIABLES']['SECTION_CODE'],
    ],
    'select' => ['ID'],
]);
if ($section = $rsSection->fetch()) {
    $sectionId = $section['ID'];
}

$arrTags = ["PROPERTY_CATEGORY" => $sectionId];

if ($filter = $arResult['VARIABLES']['SMART_FILTER_PATH']) {
    $tags = \Bitrix\Iblock\Elements\ElementTagsTable::getList([
        'select' => [
            'NAME',
            'PREVIEW_TEXT',
            'URL_'        => 'URL',
            'META_TITLE_' => 'META_TITLE',
            'META_DESC_'  => 'META_DESC',
            'CATEGORY_'   => 'CATEGORY',
        ],
        'filter' => ['CATEGORY_VALUE' => $sectionId],
    ])->fetchAll();

    foreach ($tags as $tag) {
        if (strpos($tag['URL_VALUE'], $filter)) {
            $arResult['TAG'] = $tag;
        }
    }
}
