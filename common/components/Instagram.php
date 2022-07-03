<?php
namespace common\components;

use Yii;
use yii\base\Component;
use common\models\InstagramToken;
use common\integrations\Instagram\InstagramBasicDisplay;

class Instagram extends Component
{
  public $clientId;
  public $clientSecret;
  public $redirectUri ;

  public $api = false;

  public function __construct($config = null)
  {
    parent::__construct($config);
    if (!Yii::$app->user->isGuest) {
      $this->init();

      $user = Yii::$app->user->identity;
      if ($user->hasInstagramToken()) {

        if (!$user->instagramToken->check()) {
          $token = $this->refreshToken($user->instagramToken->token, true);
          $instagramToken = $user->instagramToken;
          $instagramToken->token = $token;
          $instagramToken->save();
        }

        $this->api->setAccessToken($user->instagramToken->token);
      }

    }
  }

  public function getOAuthToken($code, $tokenOnly = false)
  {
    if (!$this->api) $this->init();
    return $this->api->getOAuthToken($code, $tokenOnly);
  }

  public function getLongLivedToken($token, $tokenOnly = false)
  {
    if (!$this->api) $this->init();
    return $this->api->getLongLivedToken($token, $tokenOnly);
  }

  public function getLoginUrl()
  {
    if (!$this->api) $this->init();
    return $this->api->getLoginUrl();
  }

  public function getUserProfile($id = 0)
  {
    if (!$this->api) $this->init();
    // $this->api->setUserFields([]);
    return $this->api->getUserProfile($id);
  }

  public function getUserMedia($id = 'me', $limit = 0, $before = null, $after = null)
  {
    if (!$this->api) $this->init();
    return $this->api->getUserMedia($id, $limit, $before, $after);
  }

  public function refreshToken($token, $tokenOnly = false)
  {
    if (!$this->api) $this->init();
    return $this->api->refreshToken($token, $tokenOnly);
  }


  public function init()
  {
    $this->api = new InstagramBasicDisplay([
      'appId' => $this->clientId,
      'appSecret' => $this->clientSecret,
      'redirectUri' => $this->redirectUri,
    ]);
  }
}
