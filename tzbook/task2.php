<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("tzbook");


\Bitrix\Main\Loader::IncludeModule("ibc.bookauth");
use Ibc\Bookauth\IbcTzordertabHelper;

$params = [
 'ID' => 2
];
$rez = IbcTzordertabHelper::arGetAomuntProfitAuthorByBookId($params);

echo '<pre>';
print_r($rez);
echo '</pre>';

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>