<p>
paste in vendor php ofice php word phpword.php this


<p>

<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
*/

namespace PhpOffice\PhpWord;

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Exception\Exception;

/**
 * PHPWord main class
 *
 * @method Collection\Titles getTitles()
 * @method Collection\Footnotes getFootnotes()
 * @method Collection\Endnotes getEndnotes()
 * @method Collection\Charts getCharts()
 * @method Collection\Comments getComments()
 * @method int addBookmark(Element\Bookmark $bookmark)
 * @method int addTitle(Element\Title $title)
 * @method int addFootnote(Element\Footnote $footnote)
 * @method int addEndnote(Element\Endnote $endnote)
 * @method int addChart(Element\Chart $chart)
 * @method int addComment(Element\Comment $comment)
 *
 * @method Style\Paragraph addParagraphStyle(string $styleName, mixed $styles)
 * @method Style\Font addFontStyle(string $styleName, mixed $fontStyle, mixed $paragraphStyle = null)
 * @method Style\Font addLinkStyle(string $styleName, mixed $styles)
 * @method Style\Font addTitleStyle(mixed $depth, mixed $fontStyle, mixed $paragraphStyle = null)
 * @method Style\Table addTableStyle(string $styleName, mixed $styleTable, mixed $styleFirstRow = null)
 * @method Style\Numbering addNumberingStyle(string $styleName, mixed $styles)
 */
class PhpWord
{
    /**
     * Default font settings
     *
     * @deprecated 0.11.0 Use Settings constants
     *
     * @const string|int
     */
    const DEFAULT_FONT_NAME = Settings::DEFAULT_FONT_NAME;
    /**
     * @deprecated 0.11.0 Use Settings constants
     */
    const DEFAULT_FONT_SIZE = Settings::DEFAULT_FONT_SIZE;
    /**
     * @deprecated 0.11.0 Use Settings constants
     */
    const DEFAULT_FONT_COLOR = Settings::DEFAULT_FONT_COLOR;
    /**
     * @deprecated 0.11.0 Use Settings constants
     */
    const DEFAULT_FONT_CONTENT_TYPE = Settings::DEFAULT_FONT_CONTENT_TYPE;

    /**
     * Collection of sections
     *
     * @var \PhpOffice\PhpWord\Element\Section[]
     */
    private $sections = array();

    /**
     * Collections
     *
     * @var array
     */
    private $collections = array();

    /**
     * Metadata
     *
     * @var array
     * @since 0.12.0
     */
    private $metadata = array();

    /**
     * Create new instance
     *
     * Collections are created dynamically
     */
    public function __construct()
    {
        // Reset Media and styles
        Media::resetElements();
        Style::resetStyles();

        // Collection
        $collections = array('Bookmarks', 'Titles', 'Footnotes', 'Endnotes', 'Charts', 'Comments');
        foreach ($collections as $collection) {
            $class = 'PhpOffice\\PhpWord\\Collection\\' . $collection;
            $this->collections[$collection] = new $class();
        }

        // Metadata
        $metadata = array('DocInfo', 'Settings', 'Compatibility');
        foreach ($metadata as $meta) {
            $class = 'PhpOffice\\PhpWord\\Metadata\\' . $meta;
            $this->metadata[$meta] = new $class();
        }
    }

    /**
     * Dynamic function call to reduce static dependency
     *
     * @since 0.12.0
     *
     * @param mixed $function
     * @param mixed $args
     *
     * @throws \BadMethodCallException
     *
     * @return mixed
     */
    public function __call($function, $args)
    {
        $function = strtolower($function);

        $getCollection = array();
        $addCollection = array();
        $addStyle = array();

        $collections = array('Bookmark', 'Title', 'Footnote', 'Endnote', 'Chart', 'Comment');
        foreach ($collections as $collection) {
            $getCollection[] = strtolower("get{$collection}s");
            $addCollection[] = strtolower("add{$collection}");
        }

        $styles = array('Paragraph', 'Font', 'Table', 'Numbering', 'Link', 'Title');
        foreach ($styles as $style) {
            $addStyle[] = strtolower("add{$style}Style");
        }

        // Run get collection method
        if (in_array($function, $getCollection)) {
            $key = ucfirst(str_replace('get', '', $function));

            return $this->collections[$key];
        }

        // Run add collection item method
        if (in_array($function, $addCollection)) {
            $key = ucfirst(str_replace('add', '', $function) . 's');

            /** @var \PhpOffice\PhpWord\Collection\AbstractCollection $collectionObject */
            $collectionObject = $this->collections[$key];

            return $collectionObject->addItem(isset($args[0]) ? $args[0] : null);
        }

        // Run add style method
        if (in_array($function, $addStyle)) {
            return forward_static_call_array(array('PhpOffice\\PhpWord\\Style', $function), $args);
        }

        // Exception
        throw new \BadMethodCallException("Method $function is not defined.");
    }

    /**
     * Get document properties object
     *
     * @return \PhpOffice\PhpWord\Metadata\DocInfo
     */
    public function getDocInfo()
    {
        return $this->metadata['DocInfo'];
    }

    /**
     * Get protection
     *
     * @return \PhpOffice\PhpWord\Metadata\Protection
     * @since 0.12.0
     * @deprecated Get the Document protection from PhpWord->getSettings()->getDocumentProtection();
     * @codeCoverageIgnore
     */
    public function getProtection()
    {
        return $this->getSettings()->getDocumentProtection();
    }

    /**
     * Get compatibility
     *
     * @return \PhpOffice\PhpWord\Metadata\Compatibility
     * @since 0.12.0
     */
    public function getCompatibility()
    {
        return $this->metadata['Compatibility'];
    }

    /**
     * Get compatibility
     *
     * @return \PhpOffice\PhpWord\Metadata\Settings
     * @since 0.14.0
     */
    public function getSettings()
    {
        return $this->metadata['Settings'];
    }

    /**
     * Get all sections
     *
     * @return \PhpOffice\PhpWord\Element\Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Returns the section at the requested position
     *
     * @param int $index
     * @return \PhpOffice\PhpWord\Element\Section|null
     */
    public function getSection($index)
    {
        if (array_key_exists($index, $this->sections)) {
            return $this->sections[$index];
        }

        return null;
    }

    /**
     * Create new section
     *
     * @param array $style
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public function addSection($style = null)
    {
        $section = new Section(count($this->sections) + 1, $style);
        $section->setPhpWord($this);
        $this->sections[] = $section;

        return $section;
    }

    /**
     * Sorts the sections using the callable passed
     *
     * @see http://php.net/manual/en/function.usort.php for usage
     * @param callable $sorter
     */
    public function sortSections($sorter)
    {
        usort($this->sections, $sorter);
    }

    /**
     * Get default font name
     *
     * @return string
     */
    public function getDefaultFontName()
    {
        return Settings::getDefaultFontName();
    }

    /**
     * Set default font name.
     *
     * @param string $fontName
     */
    public function setDefaultFontName($fontName)
    {
        Settings::setDefaultFontName($fontName);
    }

    /**
     * Get default font size
     *
     * @return int
     */
    public function getDefaultFontSize()
    {
        return Settings::getDefaultFontSize();
    }

    /**
     * Set default font size.
     *
     * @param int $fontSize
     */
    public function setDefaultFontSize($fontSize)
    {
        Settings::setDefaultFontSize($fontSize);
    }

    /**
     * Set default paragraph style definition to styles.xml
     *
     * @param array $styles Paragraph style definition
     * @return \PhpOffice\PhpWord\Style\Paragraph
     */
    public function setDefaultParagraphStyle($styles)
    {
        return Style::setDefaultParagraphStyle($styles);
    }

    /**
     * Load template by filename
     *
     * @deprecated 0.12.0 Use `new TemplateProcessor($documentTemplate)` instead.
     *
     * @param  string $filename Fully qualified filename
     *
     * @throws \PhpOffice\PhpWord\Exception\Exception
     *
     * @return TemplateProcessor
     *
     * @codeCoverageIgnore
     */
    public function loadTemplate($filename)
    {
        if (file_exists($filename)) {
            return new TemplateProcessor($filename);
        }
        throw new Exception("Template file {$filename} not found.");
    }

    /**
     * Save to file or download
     *
     * All exceptions should already been handled by the writers
     *
     * @param string $filename
     * @param string $format
     * @param bool $download
     * @return bool
     */
    public function save($filename, $format = 'Word2007', $download = false)
    {
        $mime = array(
            'Word2007'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'ODText'    => 'application/vnd.oasis.opendocument.text',
            'RTF'       => 'application/rtf',
            'HTML'      => 'text/html',
            'PDF'       => 'application/pdf',
        );

        $writer = IOFactory::createWriter($this, $format);

        if ($download === true) {
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Type: ' . $mime[$format]);
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $filename = 'php://output'; // Change filename to force download
        }

        $writer->save($filename);

        return true;
    }

    /**
     * Create new section
     *
     * @deprecated 0.10.0
     *
     * @param array $settings
     *
     * @return \PhpOffice\PhpWord\Element\Section
     *
     * @codeCoverageIgnore
     */
    public function createSection($settings = null)
    {
        return $this->addSection($settings);
    }

    /**
     * Get document properties object
     *
     * @deprecated 0.12.0
     *
     * @return \PhpOffice\PhpWord\Metadata\DocInfo
     *
     * @codeCoverageIgnore
     */
    public function getDocumentProperties()
    {
        return $this->getDocInfo();
    }

    /**
     * Set document properties object
     *
     * @deprecated 0.12.0
     *
     * @param \PhpOffice\PhpWord\Metadata\DocInfo $documentProperties
     *
     * @return self
     *
     * @codeCoverageIgnore
     */
    public function setDocumentProperties($documentProperties)
    {
        $this->metadata['Document'] = $documentProperties;

        return $this;
    }
}
</p>

</p>
<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full-featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2basic_test` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
#� �p�r�o�j�e�c�t�_�u�p�d�a�t�e�
�
�
