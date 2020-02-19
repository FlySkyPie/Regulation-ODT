Regulation ODT
===
To generate Open Document Text file of regulation.

### Regulation Array
The Chapter, Article, Paragraph, Subsection and Item should be key of array, and the value which been pointed been array, even there has not sub-regulation.
```php
$regulationArray = [
    'Chapter 1' => [
        'Article 1' => [
            'Paragraph 1' => [
                'Subsection 1' => [
                    'Item 1' => [
                        'Item 1-1' => []
                    ]
                ]
            ]
        ],
        'Article 1' => []
    ]
];
```


### Usage
```php
use FlySkyPie\RegulationODText\ODText;
$document = new ODText();
$document->setName('Name of Ragulation');
$document->setHistories(['amendment event', 'amendment event']);
$document->setCaptered(true);
$document->setRagulations($regulationArray);
```

#### Captered
If the regulation doesn't chaptered, please `setCaptered` to false,
the array of regulation you provided may look like:
```php
$array = [
  'Article 1' => [],
  'Article 2' => [],
  'Article 3' => [],
  'Article 4' => []
  ];
```