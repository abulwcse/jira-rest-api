# jira-api

JIRA supports REST API, It can be very useful, for example, during automation job creation and notification sending.

## Usage

* JIRA Rest API Documents: https://docs.atlassian.com/jira/REST/latest/

```php
<?php
use Jira\Client;
use Jira\Authentication\BasicAuthenticationService

$api = new Client(
    'https://your-jira-project.net',
    new BasicAuthenticationService('yourname', 'password')
);

$issues = $api->get('issue')->search('project = "YOURPROJECT" AND (status != "closed" AND status != "resolved") ORDER BY priority DESC');

foreach ( $issues as $issue ) {
    var_dump($issue);
}
```

## Installation

```
php composer.phar require abul/jira-php-client ^1.0@dev
```

## Requirements

* [Composer](https://getcomposer.org/download/)

## License

JIRA PHP Client is released under the MIT License. See the bundled [LICENSE](LICENSE) file for details.
