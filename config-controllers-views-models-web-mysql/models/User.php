<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * User is the model.
 *
 */


class User extends Model
{
  /**
   * @return array|\yii\db\ActiveRecord[]
   * registered users by referral
   */
    public function getBindToUsers()
    {

      $list = Users::find(['email'])
            ->where(['bind_to_user' => Yii::$app->user->identity->id])
            ->all();

      return $list;
    }

    /**
     * @return the user from which the registered
     */
    public function getFromUser()
    {
        $user = false;

        if(Yii::$app->user->identity->bind_to_user){
          $user = Users::findOne(
              ['id' => Yii::$app->user->identity->bind_to_user]
          );
        }

        return $user;
    }

}