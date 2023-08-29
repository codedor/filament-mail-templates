# Mail Templates for Filament

A package to quickly create customizable mail templates in Filament

## Installation

You can install the package via composer:

```bash
composer require codedor/filament-mail-templates
```

## Defining Mail Templates

When adding mail templates there are a few things to do, first you'll need to add the `Codedor\FilamentMailTemplates\Models\Traits\HasMails` trait models that you want to have mail templates.

```php
namespace App\Models;

use Codedor\FilamentMailTemplates\Models\Traits\HasMails;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasMails;
}
```

After doing this, you'll also need to define what fields you want to be able to use in the mail template. To do this you'll need to define the fields in the `getPlaceholderVariables` method of the model. This method should return an array of `Codedor\FilamentPlaceholderInput\PlaceholderVariable` objects.

```php
namespace App\Models;

use Codedor\FilamentMailTemplates\Models\Traits\HasMails;
use Codedor\FilamentPlaceholderInput\PlaceholderVariable;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasMails;

    public function getPlaceholderVariables(): array
    {
        return [
            PlaceholderVariable::make('first name', 'First name', $this->first_name),
            PlaceholderVariable::make('last name', 'Last name', $this->last_name),
            PlaceholderVariable::make('e-mail', 'E-mail', $this->email),
            PlaceholderVariable::make('message body', 'Message content', $this->message),
            PlaceholderVariable::make('inquiry type', 'Used inquiry type', $this->inquiryType?->working_title),
        ];
    }

    public function inquiryType()
    {
        return $this->belongsTo(InquiryType::class);
    }
}
```

Lastly, you need to define the actual mail template. To do this you'll need to add the following to any Provider in your project:

```php
use App\Models;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Models\Inquiry::registerMail('inquiry-admin')
            ->description('Send an email to the admin when a new inquiry is made');

        Models\Inquiry::registerMail('inquiry-user')
            ->view('mail.inquiry-new')
            ->description('Send an email to the user when a new inquiry is made');
    }
}
```

The `registerMail` method takes a string as the first argument, this is the name/identifier of the mail template and should be kebabcase. A description can be given as well, this is optional but will provide the admin additional information about the mail template in the Filament resource.

If your template does not need a target e-mail field, you can add `disableTargetField` to your template:

```php
Models\Inquiry::registerMail('inquiry-user')
    ->disableTargetField();
```

## Saving the Mail Templates

When you are done defining your templates, run the following command:

```bash
php artisan filament-mail-templates:create
```

This will loop over all your defined mail templates and create them in the database. It is recommended that you add this command in your deployment process, so that the mail templates are always up to date.

## Sending Mail Templates from the front-end

After filling in all data in the CMS, you can get the mail object in the front-end by using the `mail` method of the model. For example, this contact form:

```php
class ContactForm extends Component
{
    public array $fields = [];

    public function submit()
    {
        $this->validate();

        /** @var Inquiry $inquiry */
        $inquiry = Inquiry::create($this->fields);

        Mail::send($inquiry->mail('inquiry-admin')->to($inquiry->inquiryType?->to_email));
        Mail::send($inquiry->mail('inquiry-user')->to($inquiry->email));
    }
}
```

This example will send a mail to the admin and the user.

The `mail` method returns a Laravel Mailable object, so you can use all the methods that are available on that object.

## Customizing Mail Templates

The config file comes with the following:

```php
return [
    'default' => [
        'view' => 'filament-mail-templates::mail.template',
        'to_email' => null,
    ],
    'navigation' => [
        'templates' => [
            'icon' => 'heroicon-o-inbox',
            'group' => 'Mails',
            'shown' => true,
        ],
        'history' => [
            'icon' => 'heroicon-o-mail',
            'group' => 'Mails',
            'shown' => true,
        ],
    ],
];
```

Here you can define some default values and customize the navigation icon/groups of the resources. The `shown` key can be used to hide the resource from the navigation completely.
