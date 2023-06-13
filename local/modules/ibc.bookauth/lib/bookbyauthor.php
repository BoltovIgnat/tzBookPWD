<?php

namespace Ibc\Bookauth;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Bitrix\Main\ORM;

Loc::loadMessages(__FILE__);

class BookbyauthorTable extends DataManager
{
    public static function getTableName()
    {
        return 'ibc_book_by_author';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => 'id',
            )),
            new IntegerField('ID_AUTHOR', array(
                'required' => false,
            )),
            new IntegerField('ID_BOOK', array(
                'required' => false,
            )),
        );
    }
}
