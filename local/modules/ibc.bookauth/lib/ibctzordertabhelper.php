<?php

namespace Ibc\Bookauth;

use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Diag\Debug;
use \Bitrix\Crm;

use Ibc\Bookauth\AuthorTable;
use Ibc\Bookauth\BookbyauthorTable;
use Ibc\Bookauth\BookTable;
use Ibc\Bookauth\PublishingTable;



Loc::loadMessages(__FILE__);

class IbcTzordertabHelper
{

    public static function arGetCountBookByAuthorAndPublising($params)
    {
        \Bitrix\Main\Loader::IncludeModule("ibc.bookauth");

        $rows = array();
        $result = BookTable::getList(array(
            'select' => array('CNT'),
            'filter' => array(
             'AUTHOR.LAST_NAME' => $params['LAST_NAME'],//'Last',
             'PUBLISHING.TITLE' => $params['PUBLISHING_TITLE'],//'Title',
            ),
            'order' => array('ID'),
            'runtime' => [
             new \Bitrix\Main\ORM\Fields\Relations\Reference(
                 'BBA',
                 BookbyauthorTable::class,
                 \Bitrix\Main\ORM\Query\Join::on('this.ID', 'ref.ID_BOOK'),
             ),
             new \Bitrix\Main\ORM\Fields\Relations\Reference(
                 'AUTHOR',
                 AuthorTable::class,
                 \Bitrix\Main\ORM\Query\Join::on('this.BBA.ID_AUTHOR', 'ref.ID'),
             ),
             new \Bitrix\Main\ORM\Fields\Relations\Reference(
                 'PUBLISHING',
                 PublishingTable::class,
                 \Bitrix\Main\ORM\Query\Join::on('this.PUBLISHING_ID', 'ref.ID'),
             ),
             new \Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)')
            ],
        ));
        while ($row = $result->fetch())
        {
            $rows[] = $row;
        }

        return $rows;
    }

    public static function arGetAomuntProfitAuthorByBookId($params)
    {
        \Bitrix\Main\Loader::IncludeModule("ibc.bookauth");

        $rows = array();
        $result = BookTable::getList(array(
             'select' => array('COPIES_CNT', 'PUBLISHING.AUTHOR_PROFIT', 'CNT'),
             'filter' => array(
                 'ID' => $params['ID'],
             ),
             'order' => array('ID'),
             'runtime' => [
                 new \Bitrix\Main\ORM\Fields\Relations\Reference(
                     'BBA',
                     BookbyauthorTable::class,
                     \Bitrix\Main\ORM\Query\Join::on('this.ID', 'ref.ID_BOOK'),
                 ),
                 new \Bitrix\Main\ORM\Fields\Relations\Reference(
                     'AUTHOR',
                     AuthorTable::class,
                     \Bitrix\Main\ORM\Query\Join::on('this.BBA.ID_AUTHOR', 'ref.ID'),
                 ),
                 new \Bitrix\Main\ORM\Fields\Relations\Reference(
                     'PUBLISHING',
                     PublishingTable::class,
                     \Bitrix\Main\ORM\Query\Join::on('this.PUBLISHING_ID', 'ref.ID'),
                 ),
                 new \Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)')
             ],
        ));
        while ($row = $result->fetch())
        {
            $rez = ($row['IBC_BOOKAUTH_BOOK_PUBLISHING_AUTHOR_PROFIT']/$row['CNT'])*$row['COPIES_CNT'];
        }


        return $rez;
    }
}
