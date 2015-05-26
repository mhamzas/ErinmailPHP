ErinmailPHP
=================

A PHP class built to interface with the erinmail API ([http://erinmail.com](http://erinmail.com))

## Installation

### Using Composer

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `mhamzas/erinmailphp`.

	"require": {
		"mhamzas/erinmailphp": "dev-master"
	}

Next, update Composer from the Terminal:

    composer update

### Old School (alternative option)

* Place ErinmailPHP.php into your file structure
* Include or require ErinmailPHP in the location you would like to utilize it

```php
	require('ErinmailPHP\ErinmailPHP.php');
```

#Usage

Create an instance of the class while passing in an array including your API key and the List ID you wish to work with.
```php

	$config = array(
		'api_key' => 'yourapiKEYHERE', //your API key is available in Settings
		'list_id' => 'your_list_id_goes_here'
	);
	
	$erinmail = new erinmailPHP($config);
	
	//you can change the list_id you are referring to at any point
	$erinmail->setListId("a_different_list_id");
```

#Methods
After creating a new instance of ErinmailPHP call any of the methods below 

##Return Values
The return value of any of these functions will include both a status, and a message to go with that status.

The status is a boolean value of `true` or `false` and the message will vary based on the type of action being performed.

```php
	//example of a succesful return value
	array(
		'status'=>true,
		'message'=>'Already Subscribed'
	)
	
	//example of a UNsuccesful return value
	array(
		'status'=>false,
		'message'=>'Some fields are missing.'
	)
```

I have commented and organized the code so as to be readable, if you have further questions on the status or messages being returned, please refer to the library comments.

##subscribe(array $values)

This method takes an array of `$values` and will attempt to add the `$values` into the list specified in `$list_id`

```php
	$results = $erinmail->subscribe(array(
						'name'=>'Jim',
						'email' => 'Jim@gmail.com', //this is the only field required by erinmail
						'customfield1' => 'customValue'
						));
```
__Note:__ Be sure to add any custom fields to the list in erinmail before utilizing them inside this library.
__Another Note:__ If a user is already subscribed to the list, the library will return a status of `true`. Feel free to edit the code to meet your needs.

##unsubscribe($email)

Unsubscribes the provided e-mail address (if it exists) from the current list.
```php
	$results = $erinmail->unsubscribe('test@testing.com');
```

##substatus($email)

Returns the status of the user with the provided e-mail address (if it exists) in the current list.
```php
	$results = $erinmail->substatus('test@testing.com');
```
__Note:__ refer to the code or see http://erinmail.com/api for the types of return messages you can expect.

##subcount()

Returns the number of subscribers to the current list.
```php
	$results = $erinmail->subcount();
```

##setListId($list_id) and getListId()

Change or get the list you are currently working with.
```php
	
	//set or switch the list id
	$erinmail->setListId('another_list_id');
	
	//get the current list id
	echo $erinmail->getListId();
```

#Unit tests
All unit tests are located under src/test directory. To run the tests type in the below from the project root.
```shell
		php vendor/bin/phpunit src/test/ErinmailPHPTest.php
```

Ensure that the API keys are setup for testing :
```php

		$config = [
			'api_key' => 'xxx', //your API key is available in Settings
			'list_id' => 'xxx'// List ID
		];
```
