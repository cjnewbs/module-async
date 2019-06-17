# module-async
Magento 2 module for running tasks in a separate thread

## Summary
This module is intended to allow you to run a task on a separate thread to the calling process allowing you to perform an action that may cause a delay in the response from the Magento application. For example if a customer were to login and you need to synchronise data from an ERP system, but it is not immediacy required by the customer on login and you do not wish them to wait until a response is received from the ERP and subsequently processed.

## Usage
Inject `\Newbury\Async\Api\DispatchInterface` into your class as normal then call the `dispatch()` method passing in the class, method and any arguments needed. For example you could call `\Namespace\Package\SomeClass::someTask()` with the arguments 'some_arg' and 'some_other_arg' like so:
```
$this->dispatcher->dispatch(\Namespace\Package\SomeClass::class, 'someTask', ['some_arg', 'some_other_arg');
```

## Questions
What about MessageQueues?
- I originally came up with this idea before the message queue functionality was available in the Magento core (To my knowledge).
- I also believe this is a much simpler way of implementing asynchronous task running.
- When I started thinking about actually getting around to writing this module a couple weeks ago I was also trying to solve a problem where I did not want to persist some of the data to a table for various reasons.