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
 *				'token' => 'userToken',
 *				'title' => 'title',
 *              'message' => 'message',
 *				'priority' => 0,
 *			),
 *		),
 * 
 * And immediately send a push notification:
 * 
 * Yii::app()->Jeapie->personalSend();
 * 
 * Or define/redefine in program
 * 
 * Yii::app()->Jeapie
 *     ->setToken('tokenKey')          // require
 *     ->setTitle('titleOfMessage')    // not require
 *     ->setMessage('bodyOfMessage')   // require
 *     ->setPriority(0)                // not require. can be -1, 0, 1
 *     ->personalSend();               // return true or false
 *
 * Yii::app()->Jeapie
 *     ->setEmails(array('login@exmple.com'))       // require for users send
 *     ->sendUsers();                   // return true or false
 * 
 * Yii::app()->Jeapie
 *     ->broadcastSend();               // return true or false
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

		if (!empty($this->configs['token']))
			$this->_pushMessage->setToken($this->configs['token']);

		if (!empty($this->configs['title']))
			$this->_pushMessage->setTitle($this->configs['title']);

        if (!empty($this->configs['message']))
            $this->_pushMessage->setMessage($this->configs['message']);

        if (!empty($this->configs['device']))
            $this->_pushMessage->setDevice($this->configs['device']);

		if (!empty($this->configs['priority']))
			$this->_pushMessage->setPriority($this->configs['priority']);
	}
}