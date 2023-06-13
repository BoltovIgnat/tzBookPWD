<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("tzbook");


\Bitrix\Main\Loader::IncludeModule("ibc.bookauth");
use Ibc\Bookauth\IbcTzordertabHelper;

$params = [
    'LAST_NAME' => 'Last',
    'PUBLISHING_TITLE' => 'Title',
];
$rez = IbcTzordertabHelper::arGetCountBookByAuthorAndPublising($params);

echo '<pre>';
print_r($rez);
echo '</pre>';

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>