<?php

namespace App\service;


use Egulias\EmailValidator\Exception\ExpectingCTEXT;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class OsminogBot
{
    protected $dbn;
    protected $hash;

    public function __construct()
    {
        try {
            $this->dbn = ibase_connect(
                config('app.bot_firebird_db'),
                config('app.bot_db_username'),
                config('app.bot_db_password')
            );
            $hash = \Illuminate\Support\Str::random(32);
            $this->hash = $hash;
        } catch (\Exception $e) {
            Log::emergency('unable connect to firebird of bot');
        }
    }

    /**
     * 1. ваша система должна авторизоваться
     * генерируете хэш - рандомная строка на 32символа из набора 0..9a..f, далее hash
     * запрос: select * from AUTORIZE('sitebot','sitebot', hash)
     * ответ поля: RESULT (-1 не удалось, 1-ок) остальные поля не имеют в данном случае значения
     * @return bool
     */
    public function authorize()
    {
        try {
            $sql = "select * from AUTORIZE('sitebot','sitebot', '$this->hash' )";
            $rc = ibase_query($this->dbn, $sql);
            $response = ibase_free_result($rc);
            Log::debug($response);
        } catch (\Exception $e) {
            Log::emergency('unable to authorize osminog bot');
        }
    }

    /**
     * 2. добавление ключа:
     * генерируете логин для бота первая часть ключа - далее login
     * генерируете пароль для бота вторая часть ключа - далее password
     * select * from ADD_KEY_FROM_SITE(:hash,login,password)
     * в ответе PROC_RESULT строковое поле 2 варианта ответа:
     * {"status":"error:procedure execution failed"}
     * {"status":"ok"}
     * @param $login
     * @param $password
     * @return bool|resource
     */
    public function addKey($login, $password)
    {
        try {
            $sql = "select * from ADD_KEY_FROM_SITE('$this->hash', '$login', '$password')";
            $rc = ibase_query($this->dbn, $sql);
            $res = ibase_free_result($rc);
            Log::debug($res);
        } catch (\Exception $e) {
            Log::emergency('unable add a key to osminog bot');
        }

    }

    /**
     * @param $login
     * @param $password
     * @param $status
     * 0-заблокировать (остается в базе)
     * 1-активировать
     * 2-заморозить
     * 3-разморозить
     * 4-удалить
     * 5-добавить активных минут (add_minutes_count значение целое в минутах сколько добавить)
     * @param $addMinutes
     * @return bool|resource
     * в ответе PROC_RESULT строковое поле 2 варианта ответа:
     * {"status":"error:procedure execution failed"}
     * {"status":"ok"}
     */
    public function updateKey($login, $password, $status, $addMinutes = 0)
    {
        try {
            $sql = "select * from SET_USER_STATE('$this->hash', '$login', '$password', $status, $addMinutes)";
            $rc = ibase_query($this->dbn, $sql);
            $res = ibase_free_result($rc);
            Log::debug($res);
        } catch (\Exception $exception) {
            Log::emergency('unable to update key of osminogbot');
        }
    }

}
