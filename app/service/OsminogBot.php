<?php

namespace App\service;


class OsminogBot
{
    protected $dbn;
    protected $hash;

    public function __construct()
    {
        $this->dbn = ibase_connect(
            config('app.bot_firebird_db'),
            config('app.bot_db_username'),
            config('app.bot_db_password')
        );
        $this->hash = config('app.bot_hash');
    }

    public function authorize(){

        //$sql = "select * from AUTORIZE('sitebot','sitebot', '12345678911234567892123456789012')";
        $sql = "select * from ADD_KEY_FROM_SITE('12345678911234567892123456789012','login','password')";
        $rc = ibase_query($this->dbn, $sql);
        while ($row = ibase_fetch_object($rc)) {
            print_r($row);
        }
        echo "<br/>";
print_r($rc);

        die;
        return ibase_free_result($rc);
    }

}
