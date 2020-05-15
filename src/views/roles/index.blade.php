<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Default listing site for Salyam\Permissions package">
    <meta name="author" content="Salyamosy, Andras">

    <title>Roles</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

<main role="main" class="container">

    <h1>Roles</h1>
    <hr/>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-primary" onclick="openCreateModal();">Create new role</button>
            </li>
            @foreach($roles as $role)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <h2>{{ $role->label }}</h2>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary" onclick="openEditModal('{{ $role->id }}', '{{ $role->name }}', '{{ $role->label }}');">Edit</button>
                        <button type="button" class="btn btn-outline-danger">Delete</button>
                    </div>
                    <br/>
                    <p>
                        @foreach($role->permissions() as $permission)
                            {{ permission->label }}
                        @endforeach
                    </p>
                </li>
        @endforeach
    </div>
    </div>

    <div class="modal fade" id="role-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="role-title">Create new role</h2>
                </div>
                <div class="modal-body">
                    <form action="/roles/store" method="post" id="role-form">
                        @csrf
                        <div class="form-group">
                            <label for="role-id-create">Role id</label>
                            <input type="text" class="form-control" id="role-id" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="role-name-create">Role display name</label>
                            <input type="text" class="form-control" id="role-name" name="label"/>
                        </div>
                        <button type="btutton" class="btn btn-outline-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
    function openCreateModal(){
        $("#role-id").val("");
        $("#role-name").val("");
        $("#role-title").val("Create new role");
        $("#role-form").attr("action", "/roles/store/");
        $("#role-modal").modal();
    }

    function openEditModal(id, label, name){
        $("#role-id").val(label);
        $("#prole-name").val(name);
        $("#role-title").val("Edit role");
        $("#role-form").attr("action", "/roles/update/" + id);
        $("#role-modal").modal();
    }
</script>
</body>
</html>
