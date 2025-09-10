<?php

// $books = [
//     [
//         'title' => 'The Great Gatsby',
//         'author' => 'F. Scott Fitzgerald'
//     ],
//     [
//         'title' => '1984',
//         'author' => 'George Orwell'
//     ],
//     [
//         'title' => 'Pride and Prejudice',
//         'author' => 'Jane Austen'
//     ]
// ];

function csv_to_array_from_string($csv_string)
{
    $lines = explode("\n", $csv_string);
    $header = str_getcsv(array_shift($lines));
    $data = [];

    foreach ($lines as $line) {
        if (!empty($line)) {
            $data[] = array_combine($header, str_getcsv($line));
        }
    }

    return $data;
}

function array_to_csv_string($array)
{
    $csv = [];
    $csv[] = implode(',', array_keys($array[0]));

    foreach ($array as $row) {
        $csv[] = implode(',', $row);
    }

    return implode("\n", $csv);
}

// $json = file_get_contents("data.json");
$csv = file_get_contents('data.csv');

// $books = json_decode($json, true);
$books = csv_to_array_from_string($csv);

function showAllBooks($books)
{
    foreach ($books as $id => $book) {
        displayBook($id, $book);
    }
}

function showBook($books)
{
    $id = readline("Enter book id: ");
    if (!isset($books[$id])) {
        echo "Book not found.\n";
        return;
    }
    displayBook($id, $books[$id]);
}

function addBook(&$books)
{
    $title = readline("Enter title: ");
    $author = readline("Enter author: ");
    $books[] = ['title' => $title, 'author' => $author];
}

function deleteBook(&$books)
{
    $id = readline("Enter book ID you want to delete: ");
    if (!isset($books[$id])) {
        echo "Book not found.\n";
        return;
    }
    unset($books[$id]);
    echo "no more book";
}

function displayBook($id, $book)
{
    echo "ID: {$id} // Title: " . $book['title'] . " // Author: " . $book['author'] . "\n\n";
}


echo "\n\nWelcome to the Library\n";
while (true) {
    echo "\n\n";
    echo "1 - show all books\n";
    echo "2 - show a book\n";
    echo "3 - add a book\n";
    echo "4 - delete a book\n";
    echo "5 - quit\n\n";
    $choice = readline();

    switch ($choice) {
        case 1:
            showAllBooks($books);
            break;
        case 2:
            showBook($books);
            break;
        case 3:
            addBook($books);
            break;
        case 4:
            deleteBook($books);
            break;
        case 5:
            echo "Goodbye!\n";
            break 2;
        case 13:
            print_r($books); // hidden option to see full $books content
            break;
        default:
            echo "Invalid choice\n";
    };
}
