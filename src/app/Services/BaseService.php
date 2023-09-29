<?php
/**
 * Created by PhpStorm.
 * User: aki
 * Date: 2019-01-14
 * Time: 11:25
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseService
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * バリデーションエラーで表示されるフィールド名を置換する。
     * 例: ['name' => '会員名'] -> '会員名 は、255文字以下で指定してください。'
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * バリデーションエラーで表示されるエラーメッセージを変更する。
     * 例：required_ifのメッセージを変える場合
     * rulesでの指定：['aaa' => required_if:bbb,X]
     * 通常のrequired_ifのメッセージ： 'bbbがXの場合、aaaも指定してください。'
     * 変更時の個別ServiceでのcustomMessages()設定：
     *   return [aaa.required_if => 'Xを選択したときは、aaaの入力も必須です']
     * 変更後のrequired_ifのメッセージ： 'Xを選択したとき、aaaの入力も必須です'
     *
     * @return array
     */
    public function customMessages()
    {
        return [];
    }

    /**
     * Validate all documents in an account.
     *
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data): bool
    {
        Validator::make($data, $this->rules(), $this->customMessages(), $this->attributes())
            ->validate();

        return true;
    }

    /**
     * get validator.
     *
     * @param array $data
     * @return mixed
     * @throws ValidationException
     */
    public function validator(array $data)
    {
        return Validator::make($data, $this->rules(), $this->customMessages(), $this->attributes());
    }

    /**
     * Checks if the value is empty or null.
     *
     * @param mixed $data
     * @param mixed $index
     * @return mixed
     */
    protected function nullOrValue($data, $index)
    {
        if (empty($data[$index])) {
            return null;
        }

        return $data[$index] == '' ? null : $data[$index];
    }

    /**
     * Checks if the value is empty or null and returns a date from a string.
     *
     * @param mixed $data
     * @param mixed $index
     * @return mixed
     */
    protected function nullOrDate($data, $index)
    {
        if (empty($data[$index])) {
            return null;
        }

        return $data[$index] == '' ? null : Carbon::parse($data[$index]);
    }
}
