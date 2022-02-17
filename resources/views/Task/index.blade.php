<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-5">
                <h3>{{ $owner }}'s Task</h3>

                <div class="card">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="tasks" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="task" class="form-control" placeholder="Create New task" min="2" max="5" required="true">
                                <div class="invalid-feedback">
                                    Please insert Task.
                                  </div>
                            </div>


                            <button class="btn btn-sm btn-primary float-end mt-2" type="submit">Create</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            @forelse ($tasks as $task)
                            <div class="col-6">
                                @if ($task->status == 1)
                                <p><strong><strike>{{ $task->name }}</strike></strong></p>
                                @else
                                <p><strong>{{ $task->name }}</strong></p>
                                @endif
                                
                            </div>
                            <div class="col-6">
                                <form  class="mx-2" action="tasks/{{ $task->id }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button class="btn btn-outline-primary" type="submit">Done</button>
                                </form>

                                <form  class="mx-2" action="tasks/{{ $task->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                            @empty
                                <p class="text-danger"> No tasks for today</p>
                            @endforelse
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>