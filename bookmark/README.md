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

Acceptance Tests (23) -------------------------------------------------------------------------------------------
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
 I fill field "[test=description-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus..."
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
 I don't see element "[test=book-link-the-great-gatsby]"
 PASSED 

BookShowPageCest: Book not found
Signature: BookShowPageCest:bookNotFound
Test: tests/acceptance/BookShowPageCest.php:bookNotFound
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/slug-does-not-exist"
 I see "Book not found."
 I see element "[test=all-books-heading]"
 PASSED 

ListFeatureCest: Remove book from list from book page
Signature: ListFeatureCest:removeBookFromListFromBookPage
Test: tests/acceptance/ListFeatureCest.php:removeBookFromListFromBookPage
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/books/the-great-gatsby"
 I click "[test=the-great-gatsby-remove-from-list-button]"
 I see element "[test=add-to-list-button]"
 PASSED 

ListFeatureCest: Shows empty list
Signature: ListFeatureCest:showsEmptyList
Test: tests/acceptance/ListFeatureCest.php:showsEmptyList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/list"
 I see element "[test=no-books-message]"
 PASSED 

ListFeatureCest: Adds book to list
Signature: ListFeatureCest:addsBookToList
Test: tests/acceptance/ListFeatureCest.php:addsBookToList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/books/the-great-gatsby"
 I click "[test=add-to-list-button]"
 I fill field "[test=notes-textarea]","Lorem ipsum dolor sit amet, consectetur adipiscing elit."
 I click "[test=add-to-list-button]"
 I see "Lorem ipsum dolor sit amet, consectetur adipiscing elit.","[test=the-great-gatsby-notes-textarea]"
 PASSED 

ListFeatureCest: Removes book from list
Signature: ListFeatureCest:removesBookFromList
Test: tests/acceptance/ListFeatureCest.php:removesBookFromList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/books/the-great-gatsby"
 I click "[test=the-great-gatsby-remove-from-list-button]"
 I see "The book The Great Gatsby was removed from your list"
 I don't see element "[test=the-great-gatsby-remove-from-list-button]"
 I see element "[test=add-to-list-button]"
 PASSED 

ListFeatureCest: Update book on list
Signature: ListFeatureCest:updateBookOnList
Test: tests/acceptance/ListFeatureCest.php:updateBookOnList
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/list"
 I fill field "[test="the-great-gatsby-notes-textarea"]","Some new note..."
 I click "[test="the-great-gatsby-update-button"]"
 I see "Your note for The Great Gatsby was updated."
 I see "Some new note...","[test="the-great-gatsby-notes-textarea"]"
 PASSED 

UserFeatureCest: User can register
Signature: UserFeatureCest:userCanRegister
Test: tests/acceptance/UserFeatureCest.php:userCanRegister
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","test@email.com"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I see "Test User"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: Registration is validated
Signature: UserFeatureCest:registrationIsValidated
Test: tests/acceptance/UserFeatureCest.php:registrationIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I see "The email has already been taken."
 PASSED 

UserFeatureCest: User can log in
Signature: UserFeatureCest:userCanLogIn
Test: tests/acceptance/UserFeatureCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

UserFeatureCest: User can logout
Signature: UserFeatureCest:userCanLogout
Test: tests/acceptance/UserFeatureCest.php:userCanLogout
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I click "[test=logout-button]"
 I see element "[test=login-link]"
 PASSED 

UserFeatureCest: Login is validated
Signature: UserFeatureCest:loginIsValidated
Test: tests/acceptance/UserFeatureCest.php:loginIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","bad-password"
 I click "[test=login-button]"
 I see "These credentials do not match our records."
 PASSED 

UserFeatureCest: Guests cant visit restricted pages
Signature: UserFeatureCest:guestsCantVisitRestrictedPages
Test: tests/acceptance/UserFeatureCest.php:guestsCantVisitRestrictedPages
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/books"
 I see element "[test=login-button]"
 PASSED 

DuplicatePageCest: Search yields results
Signature: DuplicatePageCest:searchYieldsResults
Test: tests/acceptance/WelcomePageCest.php:searchYieldsResults
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I fill field "[test=search-input]","Harry Potter"
 I click "[test=search-button]"
 I see "Harry Potter and the Philosopher’s Stone"
 I grab multiple "[test=search-result-link]"
 I assert equals 3,3
 PASSED 

-----------------------------------------------------------------------------------------------------------------


Time: 29.24 seconds, Memory: 18.99 MB

OK (23 tests, 33 assertions)
```