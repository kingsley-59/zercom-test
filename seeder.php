<?php

require_once './vendor/autoload.php';

use App\Model\Database;

$conn = (new Database())->getConnection();
$faker = Faker\Factory::create();

$subjects = ["Maths", "English", "Biology", "Chemistry", "Physics", "Economics", "Agriculture", "Computer", "Geography", "Commerce"];
$centres = ["Ikeja", "Surulere", "Ikoyi", "Lekki"];
$categories = ["Science", "Art", "Comercial"];

// Call seeder functions
// populateCategories();
// populateCenters();
// populateSubjects();
// populateCandidates();


// Define seeder functions
function populateCandidates()
{
    global $conn;
    global $faker;
    global $centres;
    global $categories;
    $table = "candidates";

    for ($i = 0; $i < 10; $i++) {
        $name = $faker->name();
        $centreId = random_int(1, 4);;
        $categoryId = random_int(1, 3);

        $query = "INSERT INTO $table (name, centre_id, category_id) VALUES (:name, :centre_id, :category_id); ";
        try {
            $statement = $conn->prepare($query);
            $statement->execute(array(
                'name' => $name,
                'centre_id' => $centreId,
                'category_id' => $categoryId
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }   
    }
}

function getAllSubjectIds()
{
    global $conn;
    $table = "subjects";
    $query = "
            SELECT * FROM $table ORDER BY id DESC;
        ";

    try {
        $statement = $conn->query($query);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $ids = [];
        foreach($result as $subject) {
            array_push($ids, $subject['id']);
        }
        var_dump($ids);
    } catch (\PDOException $e) {
        return 'Error:' . $e->getMessage();
    }
}

function populateSubjects()
{
    global $conn;
    global $subjects;
    $table = "subjects";


    foreach ($subjects as $subject) {
        $categoryId = random_int(1, 3);
        $query = "
            INSERT INTO $table (name, category_id) VALUES (:name, :category_id);
        ";
        try {
            $statement = $conn->prepare($query);
            $statement->execute(array(
                'name' => $subject,
                'category_id' => $categoryId
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }   
    }
}

function populateCenters()
{
    global $conn;
    global $centres;
    $table = "centres";

    foreach ($centres as $centre) {
        $query = "
            INSERT INTO $table (name, created_at) VALUES (:name, now());
        ";
        try {
            $statement = $conn->prepare($query);
            $statement->execute(array(
                'name' => $centre,
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }
    }
}

function populateCategories()
{
    global $conn;
    global $categories;
    $table = "categories";

    foreach ($categories as $category) {
        $query = "
            INSERT INTO $table (name) VALUES (:name);
        ";
        try {
            $statement = $conn->prepare($query);
            $statement->execute(array(
                'name' => $category,
            ));
            $statement->rowCount();
        } catch (\PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }
    }
}