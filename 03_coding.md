# Coding

## Code Review
### Visiblity Levels
- should `constants` be public?
- should `variables`be public?
- should `function` be public?
- should `contruct` be public?

### PHPDoc
- use `PHPDoc` block, only if really necessary
- declare returned array in `PHPDoc`
    - @return String[]
    - @return float[]
    - @return Customer[]
    - @return int[]

### Tests & Assertions
- prefer to use `$this->assertSame()`
- perfer to use concret string or constant for assertion. $this->assertSame('iteration_edited', $formData[$key]);
- 

### Function
- Do NOT `presist` the function parameter to database, because the input variable might be modified from outside the function. It causes inconsistence.
- define always the return value in PHP7 function
    -  `self` for short form within the same Class
    -  `array`
    -  `int` `float`
    -  `string`
    -  `bool`

### Something Else
- in_array($value, $stack, `true`) explicit to check the type
- `constants` with scale value, only if the value is reused in code.
- Do NOT use alias, if not necessary in SQL query
- `use` block for library at the beginning of file should be alphabet sorted