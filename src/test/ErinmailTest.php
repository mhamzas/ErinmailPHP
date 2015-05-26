<?php
use ErinmailPHP\ErinmailPHP;

/**
 * 	@author : Gayan Hewa
 */
class ErinmailTest extends PHPUnit_Framework_TestCase
{
	protected $erinmail;

	public function setUp()
	{

		$config = [
			'api_key' => 'xxx', //your API key is available in Settings
			'list_id' => 'xxx'//Users - vEpmBm892Lq3bp1f8Ebzg0NQ' //Users list
		];

		$erinmail = new erinmailPHP($config);
		$this->erinmail = $erinmail;
	}

	/**
	 * Test Subscribe status
	 * @return void
	 */
	public function test_failed_substatus()
	{
		//test@test.com - does not exist
		$result = $this->erinmail->substatus('test@test.com');

		//var_dump($result);

		$this->assertEquals($result['message'], 'Email does not exist in list');
		$this->assertEquals($result['status'], false);

	}

	/**
	 * Subscribe new user test
	 * @return void
	 */
	public function test_subscribe()
	{
		$user =		array(
				        'name'=>'Gayan',
				        'email' => 'gayanhewa@gmail.com'
		          );

		$result = $this->erinmail->subscribe($user);

		//var_dump($result);

		$this->assertEquals($result['message'], 'Subscribed');
		$this->assertEquals($result['status'], true);

	}

	/**
	 * Unsubscribe test
	 * @return void
	 */
	public function test_unsubscribe()
	{

		$result = $this->erinmail->unsubscribe('gayanhewa@gmail.com');

		//var_dump($result);

		$this->assertEquals($result['message'], 'Unsubscribed');
		$this->assertEquals($result['status'], true);
	}

	public function test_subcount()
	{

		$result = $this->erinmail->subcount();

		//var_dump($result);

		//Number of subscribesin the list
		$this->assertEquals($result['message'], '2');
	}

}
?>