<?php
session_start();

class TodoList {
    private $tasks = [];

    // Constructor
    public function __construct() {
        if (!isset($_SESSION['tasks'])) {
            $_SESSION['tasks'] = [];
        }
        $this->tasks = $_SESSION['tasks'];
    }

    // Method untuk menambahkan task baru
    public function addTask($task) {
        $this->tasks[] = $task;
        $_SESSION['tasks'] = $this->tasks;
    }

    // Method untuk menampilkan semua tasks
    public function displayTasks() {
        foreach ($this->tasks as $index => $task) {
            echo "<li>$task 
                    <form method='post' id='form$index' style='display: inline-block;'>
                        <input type='hidden' name='taskIndex' value='$index'>";
            // Tampilkan tombol Complete dan Delete
            echo "<button type='submit' name='completeTask'>Complete</button> 
                  <button type='submit' name='deleteTask'>Delete</button>";
            echo "</form></li>";
        }
    }

    // Method untuk menandai task sebagai selesai
    public function markTaskAsCompleted($taskIndex) {
        if (isset($this->tasks[$taskIndex])) {
            $this->tasks[$taskIndex] = "<s>" . $this->tasks[$taskIndex] . "</s>";
            $_SESSION['tasks'] = $this->tasks;
        }
    }

    // Method untuk menghapus task
    public function deleteTask($taskIndex) {
        if (isset($this->tasks[$taskIndex])) {
            array_splice($this->tasks, $taskIndex, 1);
            $_SESSION['tasks'] = $this->tasks;
        }
    }
}

$todoList = new TodoList();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addTask']) && !empty($_POST['task'])) {
        $todoList->addTask($_POST['task']);
    } elseif (isset($_POST['completeTask']) && isset($_POST['taskIndex'])) {
        $todoList->markTaskAsCompleted($_POST['taskIndex']);
    } elseif (isset($_POST['deleteTask']) && isset($_POST['taskIndex'])) {
        $todoList->deleteTask($_POST['taskIndex']);
    }
}

$todoList->displayTasks();
?>
