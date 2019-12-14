const removeTask = taskId => {
	var sendObj = {
		taskToRemove: taskId
	};

	fetch("./remove_task.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json"
		},
		body: JSON.stringify(sendObj)
	})
		.then(function(response) {
			return response.json();
		})
		.then(function(data) {
			// console.log(data);
			// Refresh page
			window.location.href = window.location.href;
		});
};
