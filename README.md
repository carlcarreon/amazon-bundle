Amazon Bundle
============

This bundle is the connector for AWS services to be a bit more readable

## Copyright

Copyright (c) 2013 Underground Elephant

## License

Licensed under Apache License version 2.0.

See LICENSE-2.0.txt.

## Installation

1. Add to composer.json under `require`

	```
	"uecode/amazon-bundle": "dev-master",
	```

2. Register in `AppKernel`

	``` php
		$bundles = array(
		// ...
		new Uecode\Bundle\UecodeBundle\UecodeBundle()
		new Uecode\Bundle\AmazonBundle\AmazonBundle()
	```

3. Add Account info to your config.yml

	```yml
	uecode:
	    amazon:
	        accounts:
	            connections:
	                main:
	                    key: somekey
	                    secret: somesecret
	```
	
## Usage

In your code, after doing the above, you should be able to get the amazon factory with:

```php
$amazonFactory = $container->get( 'ue.amazon.main_factory' );
// Example to get swf object
$swf = $amazonFactory->build( 'AmazonSWF', array( 'domain' => 'uePoc' ) );
```
