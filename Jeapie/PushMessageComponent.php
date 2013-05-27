<?php
Yii::import('ext.Jeapie.PushMessage');
Yii::import('ext.Jeapie.exceptions.JeapieException');
/**
 * It's a wrapper for the standard library Jeapie. 
 * In the config can set default values ​​user, token, title, priority
 * 
 * 'Jeapie' => array(
 *			'class' => 'ext.Jeapie.PushMessageComponent',
 *			'configs' => array(        //optional parameter
 *				'user' => 'userKey',
 *				'token' => 'userToken',
 *				'title' => 'title',
 *              'device' => 'htcsensation',
 *              'message' => 'message',
 *				'priority' => 0,
 *			),
 *		),
 * 
 * And immediately send a push notification:
 * 
 * Yii::app()->Jeapie->send();
 * 
 * Or define/redefine in program
 * 
 * Yii::app()->Jeapie
 *     ->setUser('userKey')            // require
 *     ->setToken('tokenKey')          // require
 *     ->setTitle('titleOfMessage')    // not require
 *     ->setMessage('bodyOfMessage')   // require
 *     ->setDevice('htcsensation')     // not require
 *     ->setPriority(0)                // not require. can be -1, 0, 1
 *     ->send();                       // return true or false
 * 
 * */
class PushMessageComponent extends CComponent
{
	public $configs;

	private $_pushMessage;

	public function __call($name, $arguments)
	{
		if (method_exists($this->_pushMessage, $name))
		{
			return $this->_pushMessage->$name( !empty($arguments) ? $arguments[0] : array() );
		}
		else
			throw new JeapieException("Not found \"$name\" method", 1);			
	}

	public function init()
	{
		$this->_pushMessage = PushMessage::init();

		if (!empty($this->configs['user']))
			$this->_pushMessage->setUser($this->configs['user']);

		if (!empty($this->configs['token']))
			$this->_pushMessage->setToken($this->configs['token']);

		if (!empty($this->configs['title']))
			$this->_pushMessage->setTitle($this->configs['title']);

        if (!empty($this->configs['message']))
            $this->_pushMessage->setMessage($this->configs['message']);

		if (!empty($this->configs['priority']))
			$this->_pushMessage->setPriority($this->configs['priority']);
	}
}