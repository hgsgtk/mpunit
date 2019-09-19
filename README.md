# mpunit
Mini PHP xUnit Testing Framework

On success...

```bash
$ ./bin/mpunit
Mini PHP xUnit Testing.

...

OK (3 assertions)

```

On failure...

```bash
$ ./bin/mpunit
Mini PHP xUnit Testing.

F..

FAILED
FILE: /Users/hgsgtk/src/github.com/hgsgtk/mpunit/bin/fizzbuzz1_test.php (5)
CODE: assert('1' === $actual = fizzbuzz(2), 'テスト失敗');
DESC: テスト失敗

FAILURE!

```
