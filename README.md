push-message-for-yii
====================

It's a wrapper for the standard library [Jeapie](http://jeapie.com/ "Jeapie").
 In the config can set default values ​​token, title, priority

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
                'token' => 'userToken',
                'title' => 'title',
                'message' => 'message',
                'priority' => 0,
            ),
        ),
          ...

 And immediately send a native mobile push notification:

`Yii::app()->Jeapie->personalSend();`

 Or define/redefine in program
    
    
    // send to yourself
    Yii::app()->Jeapie
        ->setToken('tokenKey')          // required
        ->setTitle('titleOfMessage')    // optional
        ->setMessage('bodyOfMessage')   // required
        ->setPriority(0)                // optional. can be -1, 0, 1
        ->disableSslVerification()      // optional
        ->personalSend();                       // return true or false
    
    // send to your provider subscriber
    
    Yii::app()->Jeapie
        ->setEmails(array('login@exmple.com'))       // required for users send
        ->sendUsers();                   // return true or false
    // send to all provider subscribers
    Yii::app()->Jeapie
        ->broadcastSend();               // return true or false

If you have error **"SSL certificate problem: unable to get local issuer certificate"** on your local server
please use the method disableSslVerification().

If you are not familiar with Jeapie - visit http://jeapie.com

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
