<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Ibc\Bookauth\BookTable;
use Ibc\Bookauth\BookbyauthorTable;
use Ibc\Bookauth\AuthorTable;
use Ibc\Bookauth\PublishingTable;


Loc::loadMessages(__FILE__);

class ibc_bookauth extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'ibc.bookauth';
        $this->MODULE_NAME = '!Модуль ';
        $this->MODULE_DESCRIPTION =  'Модуль ';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = 'ibc';
        $this->PARTNER_URI = 'ibc';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();

    }

    public function doUninstall()
    {
        $this->uninstallDB();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            PublishingTable::getEntity()->createDbTable();
            $publishingtable = PublishingTable::createObject();
            $publishingtable->setTitle('Title');
            $publishingtable->setCity('City');
            $publishingtable->setAuthorProfit('77999');
            $publishingtable->save();

            BookTable::getEntity()->createDbTable();
            $booktable = BookTable::createObject();
            $booktable->setTitle('Title');
            $booktable->setYear('Year');
            $booktable->setCopiesCnt('1');
            $booktable->setPublishingId('1');
            $booktable->save();

            $booktable1 = BookTable::createObject();
            $booktable1->setTitle('Гордость и предубеждение');
            $booktable1->setYear('1956');
            $booktable1->setCopiesCnt('55');
            $booktable1->setPublishingId('1');
            $booktable1->save();

            AuthorTable::getEntity()->createDbTable();
            $authortable = AuthorTable::createObject();
            $authortable->setFirstName('First');
            $authortable->setLastName('Last');
            $authortable->setSecondName('Second');
            $authortable->setCity('City');
            $authortable->save();


            $authortable1 = AuthorTable::createObject();
            $authortable1->setFirstName('Джейн');
            $authortable1->setLastName('Остин');
            $authortable1->setSecondName('Тест');
            $authortable1->setCity('Лондон');
            $authortable1->save();

            BookbyauthorTable::getEntity()->createDbTable();
            $bookbyauthor = BookbyauthorTable::createObject();
            $bookbyauthor->setIdAuthor(1);
            $bookbyauthor->setIdBook(1);
            $bookbyauthor->save();

            $bookbyauthor1 = BookbyauthorTable::createObject();
            $bookbyauthor1->setIdAuthor(2);
            $bookbyauthor1->setIdBook(2);
            $bookbyauthor1->save();

            $bookbyauthor2 = BookbyauthorTable::createObject();
            $bookbyauthor2->setIdAuthor(1);
            $bookbyauthor2->setIdBook(2);
            $bookbyauthor2->save();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();

           $connection->dropTable(BookTable::getTableName());
           $connection->dropTable(AuthorTable::getTableName());
           $connection->dropTable(PublishingTable::getTableName());
           $connection->dropTable(BookbyauthorTable::getTableName());


        }
    }

}
