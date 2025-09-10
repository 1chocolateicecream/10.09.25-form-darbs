<?php

$tasks = [
    ['id' => '1', 'status' => 'done', 'priority' => 2, 'content' => 'konsultācija 15:10'],
    ['id' => '2', 'status' => 'inprogress', 'priority' => 5, 'content' => 'aizbraukt uz veikalu 19:00'],
    ['id' => '3', 'status' => 'new', 'priority' => 5, 'content' => 'aizbraukt uz veikalu 19:00']
];

function displayTask($tasks)
{
    foreach ($tasks as $task) {
        echo "ID: " . $task['id'] . ", CONTENT: " . $task['content'] . ", STATUS: " . $task['status'] . "\n";
    }
}

function viewTask(&$tasks)
{
    $id = readline("Ievadi uzdevuma ID: ");
    if (isset($tasks[$id])) {
        displayTask($tasks[$id]);
    } else {
        echo "Uzdevums nav atrasts\n";
    }
}

function addTask(&$tasks)
{
    $newContent = readline("Ievadiet jaunu uzdevumu: ");
    $tasks[] = ['status' => 'new', 'priority' => 5, 'content' => $newContent];
    echo "Uzdevums pievienots\n";
}

function deleteTask(&$tasks)
{
    $id = readline("Ievadiet dzēšamā uzdevuma ID: ");
    if (isset($tasks[$id])) {
        unset($tasks);
        echo "Uzdevums dzēsts\n";
    } else {
        echo "Uzdevums nav atrasts\n";
    }
}

function editTask(&$tasks)
{
    $id = readline("Ievadi uzdevuma ID, kuru vēlies mainīt: ");
    if (isset($tasks[$id])) {
        $newContent = readline("Ievadīt jaunu saturu: ");
        if (!empty($newContent)) {
            $tasks[$id]['content'] = $newContent;
            echo "Uzdevums rediģēts\n";
        } else {
            echo "Saturs nav ievadīts\n";
        }
    } else {
        echo "Uzdevums nav atrasts\n";
    }
}

function setStatus(&$tasks)
{
    $id = readline("Ievadi uzdevuma ID, kuram vēlies mainīt statusu: ");
    if (isset($tasks[$id])) {
        $newStatus = readline("Ievadi jauno statusu (new, done, inprogress): ");
        if (in_array($newStatus, ['new', 'done', 'inprogress'])) {
            $tasks[$id]['status'] = $newStatus;
            echo "Statuss uzstādīts\n";
        } else {
            echo "Nederīgs statusa nosaukums\n";
        }
    } else {
        echo "Uzdevums nav atrasts\n";
    }
}

function displayAllTasks(&$tasks)
{
    foreach ($tasks as $task) {
        displayTask($task);
    }
}

while (true) {
    echo "UZDEVUMU PĀRVALDNIEKS\n";
    echo "Apskatīt => 1\n"; // ???
    echo "Pievienot => 2\n";
    echo "Dzēst => 3\n";
    echo "Rediģēt => 4\n";
    echo "Rādīt visus => 5\n"; // ???
    echo "Iziet => 6\n";
    $choice = readline("Izvēlies darbības numuru: ");

    switch ($choice) {
        case 1:
            viewTask($tasks);
            break;
        case 2:
            addTask($tasks);
            break;
        case 3:
            deleteTask($tasks);
            break;
        case 4:
            editTask($tasks);
            break;
        case 5:
            displayAllTasks($tasks);
            break;
        case 6:
            echo "Uz redzēšanos!\n";
            break 2;
        default:
            echo "Invalid option selected\n";
    }
}
