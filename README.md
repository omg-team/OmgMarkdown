# OmgMarkdown

Парсер Маркдовн на языке пхп

Версия: 0.1 Beta

## Пример использования

```php
$parser = MdParser::create($text);
$parser->parse();
echo $parser->render();
```