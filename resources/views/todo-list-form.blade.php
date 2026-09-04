<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .add-form input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        .add-form button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background: black;
            color: white;
            cursor: pointer;
        }

        .todo-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .todo-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .delete-btn {
            border: none;
            background: #e53935;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .empty-message {
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            color: #777;
            background: #f8f8f8;
            border: 1px dashed #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Todo List</h1>

    <form class="add-form" method="POST" action="{{ route('todo_list_create_form') }}">
        @csrf
        <input type="text" placeholder="Enter a new todo..." name="todo-input">
        <button type="submit">Add</button>
    </form>
    @if($todos->isEmpty())
        <div class="empty-message">There Is No  Todo Here Please Add Your First Todo</div>
    @else
        <div class="todo-list">

            @foreach($todos as $todo)
                <div class="todo-item">
                    <span>{{$todo->text}}</span>
                    <form method="POST" action="{{ route('todo_list_delete', $todo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>

