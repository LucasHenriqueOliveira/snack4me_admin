<?php


use Doctrine\DBAL\Types\Type;
use App\DoctrineExtensions\DBAL\Types\UTCDateTimeType;

try{
    Type::overrideType('datetime', UTCDateTimeType::class);
    Type::overrideType('datetimetz', UTCDateTimeType::class);

}catch (Exception $e){
    echo $e;
}
