<?php
namespace App\Helpers\Errors;

class ServerErrors {
    const ERROR_1001 = "SERV1001";
    const ERROR_1002 = "SERV1002";
    const ERROR_1003 = "SERV1003";
    const ERROR_1004 = "SERV1004";
    const ERROR_1005 = "SERV1005";
    const ERROR_1006 = "SERV1006";
    const ERROR_1007 = "SERV1007";
    const ERROR_1008 = "SERV1008";
    const ERROR_1009 = "SERV1009";
    const ERROR_1010 = "SERV1010";
    const ERROR_1011 = "SERV1011";
    const ERROR_1012 = "SERV1012";
    const ERROR_1013 = "SERV1013";
    const ERROR_1014 = "SERV1014";


    private static $errors = array(
        self::ERROR_1001 => "Error on User Registration!",
        self::ERROR_1002 => "Error on User Login!",
        self::ERROR_1003 => "Error on create User Profile!",
        self::ERROR_1004 => "Error on update User Profile!",
        self::ERROR_1005 => "Error on get User Profile!",
        self::ERROR_1006 => "Error on create Merchant Profile!",
        self::ERROR_1007 => "Error on update Merchant Profile!",
        self::ERROR_1008 => "Error on get Merchant Profile!",
        self::ERROR_1009 => "Error on create Product!",
        self::ERROR_1010 => "Error on update Product!",
        self::ERROR_1011 => "Error on delete Product!",
        self::ERROR_1012 => "Error on show Merchant Product!",
        self::ERROR_1013 => "Error on show Product!",
        self::ERROR_1014 => "Error on show all Products!",

    );

    public static function getError(string $errorCode){
        return self::$errors[$errorCode];
    }
}
