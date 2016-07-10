Injector
========

Simple constructor and method argument injector.

You can pass a context to the injector to resolve parameters into injectable values.

## Supported contexts:

* ArrayContext: Resolves by a simple associative array's key/value
* RequestContext: Uses a PSR7 ServerRequest to resolve values from request attributes
* InteropContainerContext: Add support for DI containers implementing `Interop\Container\ContainerInterface`
* PsrContainerContext: Add support for DI containers implementing `Psr\Container\ContainerInterface`
* MultiContext: Pass an array of one or more of the above contexts to resolve from multiple contexts.

It's simple to add your own contexts by implementing `InteroPhp\Injector\Context\ContextInterface`

## Examples and usage

Please check the included `example/` directory for usage examples.

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
