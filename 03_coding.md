# Coding
[<img src="images/Coding.svg" align="center" width="500" height="60">](https://vikbert.github.io/#/03_coding)

How to write awecome code? First step is deciding to become a awesome programmer.
Since you already did that, the main step would be to keep yourself motivated to 
become an awesome programmer that you have always wanted to be.

There are some factors, I take always into consideration:


## HowTo Code
- think about always if I have solved the problem exactly
- prefer to write good commits
    - the comment is capitalized, in short message (80 char or less)
    - the comment begins always with ticket number, if existing
    - the commit message is written in the imperative
        - `good` Fix bugs
        - `bad` Fixed bug or Fixes bug
    - the further pragraphs come after blank lines
    - `Example`: Add jcsv dependency to fix IntelliJ compilation


## HowTo PR
- do self-reviewed commits(by `diff`)
    - Every change should have a specific reason.
    - Function and classes should exist for a reason.
    - 
- Only submit complete, self-reviewed(by `diff`), and self-tested PR.
- Be sure PR passes all builds, i.e. all tests, all checks
- spash the non-informative commits `git rebase -i origin/develop` by updating `pick` to `squash`
- the code should NOT contain commented-out code.


## HowTo CodeReview

<p class="tip">
    Code Review will be helpful, if the following agreements are clarified in the team.
</p>

`Agreements of coding review`

- code review are classless:


### Check Visiblity Levels
- should `constants` be public?
- should `variables`be public?
- should `function` be public?
- should `contruct` be public?

### Check PHPDoc
- use `PHPDoc` block, only if really necessary
- declare returned array in `PHPDoc`
    - @return String[]
    - @return float[]
    - @return Customer[]
    - @return int[]

### Check Tests & Assertions
- prefer to use `$this->assertSame()`
- perfer to use concret string or constant for assertion. $this->assertSame('iteration_edited', $formData[$key]);

### Check Function
- Do NOT `presist` the function parameter to database, because the input variable might be modified from outside the function. It causes inconsistence.
- define always the return value in PHP7 function
    -  `self` for short form within the same Class
    -  `array`
    -  `int` `float`
    -  `string`
    -  `bool`

### Check Something Else
- in_array($value, $stack, `true`) explicit to check the type
- `constants` with scale value, only if the value is reused in code.
- Do NOT use alias, if not necessary in SQL query
- `use` block for library at the beginning of file should be alphabet sorted



#### Articles
- [Code Review Best Practice](https://medium.com/palantir/code-review-best-practices-19e02780015f)