<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    <title>To-Do List</title>
</head>

<body style="background-color: rgb(208, 159, 255);">
    <div class="card bg-white mx-auto mt-4" style="max-width: 32%; border-radius: 10px;">
        <div class="d-flex justify-content-center">
            <form class="w-80" action="" method="post">
                @csrf
                <p class="fs-1 fw-bold text-center">Time To Check!</p>
                <input type="text" id="addtask" name="task_text" placeholder="Things to do..." required
                    class="form-control bg-light rounded-pill ps-3 mb-3" style="width: 85%;">
                <button type="submit" id="addtask-btn" class="btn text-white mt-4 mb-4 ms-2"
                    style="background-color: blueviolet; border-radius: 20px;">
                    Add
                </button>
            </form>
        </div>

        <div class="d-flex ms-3 align-items-start">
            <ul class="list">

                <li class="task-item d-flex mb-2"
                    style="background-color: rgba(215, 172, 255, 0.8); padding-left: 13px; border-radius: 10px; max-width: 350px;">
                    <p id="item" class="flex-grow-1"></p>
                    <form action="" method="post" class="d-inline">
                        @csrf
                        <button type="submit" id="finish" class="btn text-white me-2"
                            style="background-color: rgb(178, 117, 235); border-radius: 5px;">
                            Finish
                        </button>
                    </form>
                    <form action="" method="post" class="d-inline">
                        @csrf
                        <button type="submit" id="delete" class="btn text-white"
                            style="background-color: rgb(178, 117, 235); border-radius: 5px;">
                            Delete
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</body>

</html>
