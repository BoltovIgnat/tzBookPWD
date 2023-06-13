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

class AuthorTable extends DataManager
{
    public static function getTableName()
    {
        return 'ibc_author';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => 'id',
            )),
            new StringField('FIRST_NAME', array(
                'required' => false,
            )),
            new StringField('LAST_NAME', array(
                'required' => false,
            )),
            new StringField('SECOND_NAME', array(
                'required' => false,
            )),
            new StringField('CITY', array(
                'required' => false,
            )),
        );
    }
}
