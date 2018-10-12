# Laravel 5 Memail
   This package for send multiple email in laravel 5
## Install and Configuration
   Using composer command
   ```
    composer require megaads/memail
```
   After composer install package complete, open file app.php and add below line to `providers`: 
   ```
    Megaads\Memail\MemailServiceProvider::class
   ```
   After, add to botton file ``config/mail.php``. It see like this: 
   
   ```
  
'config-send-email' => [
        'default' => [
            'to' => ['emaildefault1@gmail.com', 'emaildefault2@gmail.com'],
            'subject' => 'Subject default',
            'name' => 'Name default'
        ],
        'groups' => [
            'developers' => ['developers1@gmail.com', 'developers2@gmail.com'],
            'managers' => ['managers1@gmail.com', 'managers2@gmail.com']
        ]
    ]
  
```

Then, config mail info in file ``.env``. It see like this: 
   
   ```
  
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=myemail@gmail.com
MAIL_PASSWORD=mypassword
MAIL_ENCRYPTION=tls
  
```
  
   Finally, to call function send email, add this line: 
   ```
   use Megaads\Memail\Services\EmailService;
   ```
   and call:
   ```
   EmailService::send($option);
   ```
   
   ``$option`` is array, example: 
   ```
   [
            'to' => ['first email', 'second email'],
            'view' => 'emails.hello', // or 'content' => $content
            'data' => $data, // pass to $dataEmail in view
            'subject' => 'subject',
            'group' => 'developers',
            'name' => 'sender name'
        ]
   ```
   
