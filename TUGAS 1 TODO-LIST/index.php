<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="post">
            <input type="text" name="task" placeholder="Enter your task...">
            <button type="submit" name="addTask">Add Task</button>
        </form>
        <ul id="task-list">
            <!-- Tasks will be added dynamically here -->
            <?php include 'todo.php'; ?>
        </ul>
    </div>

</body>
</html>
