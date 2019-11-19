<?php

$data = [
    1 => ['title' => 'Home Page', 'body' => 'Lorem ipsum.', 'published' => false,],
    2 => ['title' => 'Installing Laravel', 'body' => 'Lorem ipsum.', 'published' => true]
];

/* Interface that Page Class must implement.
   All of the defined method signatures must be implemented for Page class.*/
interface Template {

  const ACCESSIBLE_BY = 'administrator'; // Interface constants can't be overridden!

  public function __construct(array $data, int $postId); // Must be implemented with the same signature!

  public function getTitle(): string; // Return types must match!
  public function getBody(): string;
  public function publish(): void;

}

/* You can use implement more interfaces ( multiple inheritance ), for example:
class Page implemens Template, Layout */
class Page implements Template {

    private $postId;

    // const ACCESSIBLE_BY = 'manager'; // Doesn't work!

    public function __construct(array $data, int $postId) {
        $this->data = $data;
        $this->postId = $postId;
    }

    public function getTitle(): string { // Return types must match!
        return $this->data[$this->postId]['title'];
    }

    public function getBody(): string {
        return $this->data[$this->postId]['body'];
    }

    public function publish(): void {
        $this->data[$this->postId]['publish'] = true;
    }
}

$page = new Page($data, 1);
var_dump($page::ACCESSIBLE_BY); // Works, but can't be changed!
var_dump($page->getTitle());

/* Notes: */

/*  Constants can't be changed:
    PHP Fatal error:  Cannot inherit previously-inherited or override constant ACCES
    SIBLE_BY from interface Template in C:\Users\Work\Code\PHP\php-abstract-class-vs
    -interface\interface.php on line 23
*/

/*  Defining an empty Page class that implements the Template interface
    will result in a PHP Fatal error:
        Class Page contains 5 abstract methods and must
        therefore be declared abstract or implement the remaining methods
        (Template::__construct, Template::getTitle, Template::getBody, …)
        in C:\Users\Work\Code\test.php on line 15.
*/

/*  Return types must match, don't mix them, otherwise you will result in another PHP Fatal error:
        Declaration of Page::getTitle() must be compatible with Template::getTitle():
        string in C:\Users\Work\Code\abstract_vs_interface.php on line 14 */

?>
