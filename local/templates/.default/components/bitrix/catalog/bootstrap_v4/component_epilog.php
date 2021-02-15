<?

if ($tag = $arResult['TAG']) {
    $APPLICATION->SetTitle($tag['NAME']);
    $APPLICATION->SetPageProperty("title", $tag['META_TITLE_VALUE']);
    $APPLICATION->SetPageProperty("description", $tag['META_DESC_VALUE']);

    $canonical = $tag['URL_VALUE'];
}else{
    $canonical = $APPLICATION->GetCurPage();
}

if (!strpos($canonical, SITE_SERVER_NAME)){
    $protocol = 'http';
    if ($_SERVER['HTTPS']) {
        $protocol .= 's';
    }
    $url = "${protocol}://". SITE_SERVER_NAME . $canonical;
}

$APPLICATION->SetPageProperty("canonical", $url);