<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
			integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="./styles.css" />
		<title>MTapia Task Manager</title>
	</head>
	<body style="background-color: #000000;">
		<h1 class="text-center text-white mt-3">MTasker</h1>
		<div class="container">
			<div class="row">
				<div class="col-md-6 bg-add-task p-3">
					<h3 class="text-center">Add a Task</h3>
					<form id="add-task" class="text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<div class="my-3">
							<label for="theTask">Task Name</label>
							<input
								class="d-block mx-auto"
								id="theTask"
								type="text"
								name="taskName"
							/>
						</div>
						<div class="my-3">
							<label for="theDate">Due Date</label>
							<input
								class="d-block mx-auto"
								id="theDate"
								type="date"
								name="dueDate"
							/>
						</div>
						<div class="my-3">
							<label for="female">Low</label>
							<input
								type="radio"
								name="priority"
								id="lowPriority"
								value="1"
							/>
							<label for="female">Medium</label>
							<input
								type="radio"
								name="priority"
								id="mediumPriority"
								value="2"
							/>
							<label for="female">High</label>
							<input
								type="radio"
								name="priority"
								id="highPriority"
								value="3"
							/>
						</div>
						<div class="my-3">
							<button name="add-task" class="p-2" type="submit">Add Task</button>
						</div>
					</form>
                    <?php
                        if (isset($_POST["add-task"])) {
                            $conn = new mysqli("localhost", "mtapia", "MiguelTapia", "mtasker");
                            
                            /* check connection */
                            if (mysqli_connect_errno()) {
                                printf("Connect failed: %s\n", mysqli_connect_error());
                                exit();
                            }

                            $sql = "INSERT INTO task_list(`task_name`, `priority`, `task_date`) VALUES ('{$_POST["taskName"]}', {$_POST["priority"]}, '{$_POST["dueDate"]}');";

                            
                            if ($conn -> query($sql) === TRUE) {
                                echo "<center>Task Added</center>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn -> error;
                            }

                            $conn -> close();
                        }
                    ?>
				</div>
				<div class="col-md-6 bg-upcoming-tasks p-3">
					<h3 class="text-center">Upcoming Tasks</h3>
					<div class="px-3">
						<table class="table">
                            <!-- <thead>
                                <tr>
                                    <th scope="col">Task Name</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Task Date</th>
                                </tr>
                            </thead> -->
                            <tbody>
                                <?php
                                    $conn = new mysqli("localhost", "mtapia", "MiguelTapia", "mtasker");

                                    /* check connection */
                                    if (mysqli_connect_errno()) {
                                        printf("Connect failed: %s\n", mysqli_connect_error());
                                        exit();
                                    }

                                    $sql = "SELECT task_id, task_name, priority, task_date FROM task_list ORDER BY priority DESC;";

                                    $result = $conn -> query($sql);

                                    if ($result -> num_rows > 0) {
                                        while($row = $result -> fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row["task_name"]}</td>
                                                    <td>{$row["priority"]}</td> 
                                                    <td>{$row["task_date"]}</td>
                                                    <td>
                                                        <span onClick=\"removeTask({$row["task_id"]});\" class='remove-task'>X</span>
                                                    </td>    
                                                </tr>";
                                        }
                                    } else {
                                        echo "No tasks";
                                    }

                                    $conn -> close();
                                ?>
                            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
        <script
			src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
			integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
			crossorigin="anonymous"
		></script>
		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
			integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
			integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
			crossorigin="anonymous"
        ></script>
        <script src="./app.js"></script>
	</body>
</html>
