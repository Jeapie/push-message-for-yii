push-message-for-yii
====================

It's a wrapper for the standard library [Jeapie](http://jeapie.com/ "Jeapie"). 
 In the config can set default values ​​user, token, title, priority

    'import'=>array(
          ...
        'application.extentions.Jeapie.*'
          ...
    ),
    
         ....
    
    'components'=>array(
         ...
        'Jeapie' => array(
            'class' => 'ext.Jeapie.PushMessageComponent',
            'configs' => array(        //optional parameter
                'user' => 'userKey',
                'token' => 'userToken',
                'title' => 'title',
                'device' => 'htcsensation',
                'message' => 'message',
                'priority' => 0,
            ),
        ),
          ...
 
 And immediately send a native mobile push notification:
 
`Yii::app()->Jeapie->send();`
 
 Or define/redefine in program
 
    Yii::app()->Jeapie
        ->setUser('userKey')            // require
        ->setToken('tokenKey')          // require
        ->setTitle('titleOfMessage')    // not require
        ->setMessage('bodyOfMessage')   // require
        ->setDevice('htcsensation')     // not require
        ->setPriority(0)      // not require. can be -1, 0, 1
        ->send();             // return true or false

If you are not familiar with Jeapie - visit http://jeapie.com
