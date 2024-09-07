<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <style>
        /* Simple CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            /* Allows the user to resize the textarea vertically */
            height: 100px;
        }

        .form-group button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <form action="{{route('package.store')}}" method="post" enctype="multipart/form-data">
          @csrf
            <!-- Text input -->
            <div class="form-group">
                <label for="name">name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" required  >
            </div>

            <div class="form-group">
                <label for="price">price:</label>
                <input type="text" id="price" name="price" required  >
            </div>

            <!-- Submit button -->
            <div class="form-group">
                <button type="submit">Add</button>
            </div>
        </form>
    </div>

</body>

</html>