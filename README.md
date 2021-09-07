# gestionnaire-ecole-de-musique
Logiciel de gestion d'une moyenne école de musique développé avec Symfony

# symfony/mailer  instructions:
```
* You're ready to send emails.

* If you want to send emails via a supported email provider, install
the corresponding bridge.
For instance, composer require mailgun-mailer for Mailgun.

* If you want to send emails asynchronously:

1. Install the messenger component by running composer require messenger;
2. Add 'Symfony\Component\Mailer\Messenger\SendEmailMessage': amqp to the
   config/packages/messenger.yaml file under framework.messenger.routing
   and replace amqp with your transport name of choice.

* Read the documentation at https://symfony.com/doc/master/mailer.html
```

# symfonycasts/reset-password-bundle
```
created: src/Controller/ResetPasswordController.php
created: src/Entity/ResetPasswordRequest.php
updated: src/Entity/ResetPasswordRequest.php
created: src/Repository/ResetPasswordRequestRepository.php
updated: src/Repository/ResetPasswordRequestRepository.php
updated: config/packages/reset_password.yaml
created: src/Form/ResetPasswordRequestFormType.php
created: src/Form/ChangePasswordFormType.php
created: templates/reset_password/check_email.html.twig
created: templates/reset_password/email.html.twig
created: templates/reset_password/request.html.twig
created: templates/reset_password/reset.html.twig
           
  Success! 
           

 Next:
   1) Run "php bin/console make:migration" to generate a migration for the new "App\Entity\ResetPasswordRequest" entity.
   2) Review forms in "src/Form" to customize validation and labels.
   3) Review and customize the templates in `templates/reset_password`.
   4) Make sure your MAILER_DSN env var has the correct settings.
   5) Create a "forgot your password link" to the app_forgot_password_request route on your login form.

 Then open your browser, go to "/reset-password" and enjoy!
```
