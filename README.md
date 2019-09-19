# mpunit
Mini PHP xUnit Testing Framework

## Demonstration
On success...

```
$ ./bin/mpunit example/tests
Mini PHP xUnit Testing.

....

OK (2 tests 4 assertions)
```

On failure...

```
$ ./bin/mpunit
Mini PHP xUnit Testing.

F...

FAILED
Failed assertion FizzBuzz1Test::testFizzBuzz_FizzBuzz actual: FizzBuzz, expected: FizzBuzzs
#0 /Users/user/src/github.com/hgsgtk/mpunit/src/Assert.php(15): assert(false, 'actual: FizzBuz...')
#1 /Users/user/src/github.com/hgsgtk/mpunit/src/Assert.php(24): MPUnit\TestCase->assertThat(false, 'actual: FizzBuz...')
#2 /Users/user/src/github.com/hgsgtk/mpunit/example/tests/FizzBuzz1Test.php(12): MPUnit\TestCase->assertSame('FizzBuzzs', 'FizzBuzz')
#3 /Users/user/src/github.com/hgsgtk/mpunit/src/Command.php(62): FizzBuzz1Test->testFizzBuzz_FizzBuzz()
#4 /Users/user/src/github.com/hgsgtk/mpunit/bin/mpunit(20): MPUnit\Command->run()
#5 {main}

FAILURE!
Tests: 2 Assertions: 4, Failures: 1
```

## Features

- Collection TestCases
- Assertion
- Error Reporting
