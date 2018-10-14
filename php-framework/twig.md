# Twig

## Twig Extension
unset the array in twig
```php
 final class AppBundleExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter(
                'my_filte',
                [$this, 'myFilter']
            ),
        ];
    }

    public function myFilter(array $target, $optional): array
    {
        if ($optional === true) {
            unset($target['deactivate']);
        }

        return $target;
    }
```
