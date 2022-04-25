# Bookmark
+ By: Susan Buck
+ Production URL: <http://bookmark.hesweb.xyz>

## Feature summary
+ Visitors can register/log in
+ Users can add/update/delete books
+ Users can add/remove books from a personal list, with an accompanying note
+ The home page includes the ability to search for books by title or author
  
## Database summary
+ My application has 4 tables in total (`users`, `books`, `authors`, `book_user`)
+ There’s a one-to-many relationship between `authors` and `books`
+ There’s a many-to-many relationship between `books` and `users`

## Outside resources
n/a

## Notes for instructor
n/a

## Tests
```
Codeception PHP Testing Framework v4.1.31 https://helpukrainewin.org
Powered by PHPUnit 8.5.24 #StandWithUkraine

Acceptance Tests (15) -----------------------------------------------------------------------------------------------------------------------------------
BookCreatePageCest: Adds a new book
Signature: BookCreatePageCest:addsANewBook
Test: tests/acceptance/BookCreatePageCest.php:addsANewBook
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/create"
 I fill field "[test=title-input]","Test Book"
 I fill field "[test=slug-input]","test-book"
 I select option "[test=author-dropdown]",1
 I fill field "[test=published-year-input]",2000
 I fill field "[test=cover-url-input]","https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png"
 I fill field "[test=purchase-url-input]","https://www.barnesandnoble.com/test-book"
 I fill field "[test=info-url-input]","https://en.wikipedia.org/wiki/test-book"
 I fill field "[test=description-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in pulvinar libero. Pellentesque habita..."
 I click "[test=submit-button]"
 I see "Your book was added"
 I am on page "/books/test-book"
 I see "Test Book"
 PASSED 

BookCreatePageCest: Shows validation
Signature: BookCreatePageCest:showsValidation
Test: tests/acceptance/BookCreatePageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/create"
 I click "[test=submit-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-title]"
 PASSED 

BookCreatePageCest: Prevents duplicate slugs
Signature: BookCreatePageCest:preventsDuplicateSlugs
Test: tests/acceptance/BookCreatePageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/create"
 I fill field "[test=slug-input]","the-great-gatsby"
 I click "[test=submit-button]"
 I see "The Short URL has already been taken.","[test=error-field-slug]"
 PASSED 

BookEditPageCest: Edits book
Signature: BookEditPageCest:editsBook
Test: tests/acceptance/BookEditPageCest.php:editsBook
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby/edit"
 I fill field "[test=title-input]","Some new title..."
 I click "[test=update-book-button]"
 I see "Some new title..."
 PASSED 

BookEditPageCest: Shows validation
Signature: BookEditPageCest:showsValidation
Test: tests/acceptance/BookEditPageCest.php:showsValidation
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby/edit"
 I fill field "[test=title-input]",""
 I click "[test=update-book-button]"
 I see element "[test=global-error-feedback]"
 I see element "[test=error-field-title]"
 PASSED 

BookEditPageCest: Prevents duplicate slugs
Signature: BookEditPageCest:preventsDuplicateSlugs
Test: tests/acceptance/BookEditPageCest.php:preventsDuplicateSlugs
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby/edit"
 I fill field "[test=slug-input]","the-bell-jar"
 I click "[test=update-book-button]"
 I see "The Short URL has already been taken.","[test=error-field-slug]"
 PASSED 

BookIndexPageCest: Shows books
Signature: BookIndexPageCest:showsBooks
Test: tests/acceptance/BookIndexPageCest.php:showsBooks
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books"
 I click "[test=book-link-the-great-gatsby]"
 I see "The Great Gatsby"
 PASSED 

BookIndexPageCest: Shows new books
Signature: BookIndexPageCest:showsNewBooks
Test: tests/acceptance/BookIndexPageCest.php:showsNewBooks
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books"
 I grab multiple "[test=new-book-link]"
 I assert equals 3,3
 PASSED 

BookShowPageCest: Shows book
Signature: BookShowPageCest:showsBook
Test: tests/acceptance/BookShowPageCest.php:showsBook
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby"
 I see "The Great Gatsby"
 PASSED 

BookShowPageCest: Deletes book
Signature: BookShowPageCest:deletesBook
Test: tests/acceptance/BookShowPageCest.php:deletesBook
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby"
 I click "[test=delete-button]"
 I click "[test=confirm-delete-button]"
 I don't see "The Great Gatsby"
 PASSED 

ListPageCest: Shows empty list
Signature: ListPageCest:showsEmptyList
Test: tests/acceptance/ListPageCest.php:showsEmptyList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I see element "[test=no-books-message]"
 PASSED 

ListPageCest: Adds book to list
Signature: ListPageCest:addsBookToList
Test: tests/acceptance/ListPageCest.php:addsBookToList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby"
 I click "[test=add-to-list-button]"
 I fill field "[test=notes-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit."
 I click "[test=add-to-list-button]"
 I see "Lorem ipsum dolor sit amet, consectetur adipiscing elit.","[test=the-great-gatsby-notes-textarea]"
 PASSED 

ListPageCest: Removes book from list
Signature: ListPageCest:removesBookFromList
Test: tests/acceptance/ListPageCest.php:removesBookFromList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/books/the-great-gatsby"
 I click "[test=the-great-gatsby-remove-from-list-button]"
 I see "The book The Great Gatsby was removed from your list"
 I don't see element "[test=the-great-gatsby-remove-from-list-button]"
 I see element "[test=add-to-list-button]"
 PASSED 

LoginPageCest: Page loads
Signature: LoginPageCest:pageLoads
Test: tests/acceptance/LoginPageCest.php:pageLoads
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I see "Login"
 I see element "#email"
 PASSED 

LoginPageCest: User can log in
Signature: LoginPageCest:userCanLogIn
Test: tests/acceptance/LoginPageCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

---------------------------------------------------------------------------------------------------------------------------------------------------------


Time: 22.32 seconds, Memory: 26.99 MB

OK (15 tests, 22 assertions)
```